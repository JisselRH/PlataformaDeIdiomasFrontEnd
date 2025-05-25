import { getToken } from "../requests.js";
import { getCookieValue } from "../exercise-cookie.js";
import { pronRecognition, stopRecognition } from "../recognizer.js";

// --- Variables Globales ---
var globalStream = null; // Guardará el stream del micrófono
var reco = null; // Guardará la instancia del reconocedor
const currentState = { recording: false }; // Estado actual de la grabación

// --- Funciones de Utilidad ---

// Muestra mensajes de estado/error al usuario
function updateUserFeedback(message, isError = false) {
    const feedbackElement = document.querySelector('.texto-prueba');
    if (feedbackElement) {
        feedbackElement.textContent = message;
        feedbackElement.style.color = isError ? 'red' : 'black'; 
        console.log(`Feedback: ${message}`);
        if (isError) {
            console.error(`Error Feedback: ${message}`);
        }
    }
}

// Habilita/Deshabilita UI de grabación
function enableRecordingFeatures(enable = true) {
    const talkButtons = $('.btn-talk-clic'); 
    if (enable) {
        talkButtons.removeClass('disabled');
        $('.active-word').find('.btn-talk-disabled').removeClass('btn-talk-disabled').addClass('btn-talk');
        updateUserFeedback("Micrófono listo. Puedes empezar.");
    } else {
        talkButtons.addClass('disabled');
        $('.btn').removeClass('btn-talk btn-talk-active').addClass('btn-talk-disabled');
        console.log("Recording features disabled.");
    }
}

// Maneja errores de audio específicos
function handleAudioError(error) {
    console.error("Error accessing audio devices:", error.name, error.message, error);
    globalStream = null;

    let userMessage = "Ocurrió un error inesperado con el micrófono.";

    switch (error.name) {
        case 'NotAllowedError':
        case 'PermissionDeniedError':
            userMessage = "Permiso denegado. Habilita el micrófono en los ajustes de tu navegador.";
            break;
        case 'NotFoundError':
        case 'DevicesNotFoundError':
            userMessage = "No se encontró un micrófono conectado. Por favor, verifica tu hardware.";
            break;
        case 'NotReadableError':
        case 'TrackStartError':
            userMessage = "No se pudo leer el micrófono. Puede que otro programa lo esté usando o haya un problema de hardware.";
            break;
        case 'OverconstrainedError':
        case 'ConstraintNotSatisfiedError':
            userMessage = "No se encontró un micrófono que cumpla los requisitos solicitados.";
            break;
        case 'AbortError':
            userMessage = "Se canceló el acceso al micrófono.";
            break;
        case 'TypeError':
            userMessage = "Error de configuración. No se solicitaron pistas de audio o video.";
            break;
        case 'SecurityError':
             userMessage = "Acceso al micrófono bloqueado por razones de seguridad. Usa una conexión HTTPS.";
             break;
        default:
            userMessage = `Error de micrófono: ${error.name}. Revisa la consola para más detalles.`;
    }

    updateUserFeedback(userMessage, true);
    enableRecordingFeatures(false); 
}

// Obtiene la palabra activa
function selectedWord() {
    return $('.active-word').find('.word-content').text();
}

// Procesa el puntaje (con validación)
function processScore(result) {
    try {
        // Validación robusta
        if (!result || !result.NBest || !result.NBest[0] || !result.NBest[0].PronunciationAssessment) {
            console.error("Resultado del reconocimiento incompleto o inválido:", result);
            updateUserFeedback("No se pudo obtener el puntaje.", true);
            return null; // Devuelve null si no se puede obtener
        }
        const score = result.NBest[0].PronunciationAssessment.PronScore;
        console.log("Score obtained:", score);
        return score;
    } catch (error) {
        console.error("Error al procesar el puntaje:", error, result);
        updateUserFeedback("Error al procesar el puntaje.", true);
        return null; // Devuelve null en caso de error
    }
}

// --- Flujo Principal (jQuery Ready) ---
$(document).ready(async function () {
    updateUserFeedback("Inicializando ejercicio...");

    // 1. Obtener Token (con manejo de errores)
    let token;
    try {
        token = await getToken();
        if (!token) throw new Error("Token no recibido.");
        console.log("Token obtained successfully.");
    } catch (error) {
        console.error("Error al obtener el token:", error);
        updateUserFeedback("Error de autenticación. No se puede continuar.", true);
        showModalError(1); // O un modal específico para token
        return; // Detener ejecución si no hay token
    }

    // 2. Obtener Palabras (con manejo de errores)
    const words = getCookieValue('words'); // Asumiendo que esto devuelve null/undefined/503 en error
    const wordsContainer = $('.exercise-word-container');
    const sample = wordsContainer.find('.exercise-word');

    if (words && words !== 503) {
        let first = true;
        words.forEach(word => {
            const wordElement = sample.clone();
            wordElement.find('.word-content').text(word);
            wordsContainer.append(wordElement);
            if (first) {
                wordElement.addClass('active-word');
                first = false;
                // No habilitar botón aquí, esperar a tener micro
            }
        });
        sample.remove();
    } else {
        console.error("Error al obtener las palabras:", words);
        const errorType = (words === 503) ? 2 : 1;
        const message = (words === 503) ? "Error de conexión al cargar palabras." : "Error al cargar palabras.";
        updateUserFeedback(message, true);
        showModalError(errorType);
        sample.remove();
        return; // Detener si no hay palabras
    }

    // 3. Solicitar Acceso al Micrófono (con manejo de errores mejorado)
    try {
        console.log("Requesting microphone access...");
        globalStream = await navigator.mediaDevices.getUserMedia({ audio: true, video: false });
        console.log("Microphone access granted and stream obtained.");
        enableRecordingFeatures(true); // Habilitar UI AHORA
    } catch (error) {
        handleAudioError(error); // Usar la función centralizada
        return; // Detener si no hay micro
    }

    // 4. Configurar Event Listener del Botón (con manejo de errores)
    $('.btn-talk-clic').click(async function () {
        const $thisButton = $(this); // Guardar referencia al botón

        // Chequeo robusto antes de actuar
        if (!globalStream || !globalStream.active || globalStream.getAudioTracks().length === 0) {
            updateUserFeedback("El micrófono no está disponible o el permiso fue revocado.", true);
            // Intentar obtenerlo de nuevo o mostrar un error más permanente
            handleAudioError(new Error("Stream not available or inactive."));
            return;
        }

        currentState.recording = !currentState.recording; // Cambiar estado ANTES
        changeTalkBtn($thisButton, currentState); // Actualizar UI del botón

        if (!currentState.recording) {
            // --- Detener Grabación ---
            updateUserFeedback("Procesando audio...");
            try {
                if (!reco) {
                     console.warn("Attempted to stop recognition, but 'reco' was null.");
                     updateUserFeedback("No se había iniciado ninguna grabación.", true);
                     return; // No hay nada que detener
                }
                const result = await stopRecognition(reco);
                reco = null; // Limpiar 'reco' después de detener

                if (!result) {
                    throw new Error("El reconocimiento no devolvió resultado.");
                }

                console.log("Recognition successful:", result);
                updateUserFeedback("Grabación procesada.");

                const score = processScore(result); // Usar función con validación

                if (score !== null) {
                    const wordDiv = $('.active-word');
                    wordDiv.find('.word-feedback').text(`${score}/100`);
                    const btn = wordDiv.find('.btn-content .btn');
                    btn.removeClass("btn-talk-active").addClass("btn-talk-finished");
                    nextWord();
                } else {
                     // El error ya se mostró en processScore o stopRecognition
                     // Opcional: Revertir el estado del botón si es necesario
                }

            } catch (error) {
                console.error("Error durante la detención o procesamiento del reconocimiento:", error);
                updateUserFeedback(`Error al procesar: ${error.message || 'Desconocido.'}`, true);
                reco = null; // Asegurarse de limpiar 'reco'
                // Revertir UI si es necesario
                currentState.recording = false; // Asegurar estado correcto
                changeTalkBtn($thisButton, currentState);
            }

        } else {
            // --- Iniciar Grabación ---
            updateUserFeedback("Escuchando...");
            const text = selectedWord();
            console.log("Starting recognition for:", text);

            try {
                // Actualizar UI del botón específico
                const btn = $('.active-word').find('.btn-content .btn');
                btn.removeClass("btn-talk").addClass("btn-talk-active");

                // Iniciar reconocimiento (con try...catch)
                reco = await pronRecognition(text); // Asumiendo que esto inicia y devuelve el 'reco'
                if (!reco) throw new Error("No se pudo iniciar el reconocedor.");
                console.log("Recognition started.");

            } catch (error) {
                console.error("Error al iniciar el reconocimiento:", error);
                updateUserFeedback(`Error al iniciar: ${error.message || 'Desconocido.'}`, true);
                currentState.recording = false; // Revertir estado
                changeTalkBtn($thisButton, currentState); // Revertir UI
                reco = null; // Limpiar
            }
        }
    });

    // 5. Botón 'Send' (si aún lo necesitas)
    $('.btn-send').click(function () {
        nextWord();
    });

    // --- Funciones Auxiliares (ya definidas en tu código) ---
    function showModalError(tipo) {
        console.log("showModal ERROR type:", tipo);
        $('#modal-fullscreen-xl').modal('hide');
        const modalId = (tipo === 1) ? '#error' : '#error-conexion';
        $(modalId).modal('show');
    };

    function nextWord() {
        const activeWord = $('.active-word');
        const nextWordElement = activeWord.next('.exercise-word');

        activeWord.find('.btn').removeClass("btn-talk btn-talk-active").addClass("btn-talk-disabled");
        activeWord.removeClass('active-word').addClass('done-word');

        if (nextWordElement.length > 0) {
            nextWordElement.addClass('active-word');
            const nextBtn = nextWordElement.find('.btn');
            nextBtn.removeClass("btn-talk-disabled").addClass("btn-talk");
            updateUserFeedback("Siguiente palabra. Presiona para hablar.");
        } else {
            updateUserFeedback("¡Ejercicio completado!");
            console.log("FINISHED");
            // Aquí podrías mostrar un botón de "Finalizar" o "Reintentar"
        }
    }

    function changeTalkBtn(talkBtn, state) {
        console.log("Changing button state:", state.recording);
        if (!state.recording) { // Si NO está grabando (o sea, se detuvo)
            talkBtn.removeClass('talking'); // Quitar clase 'talking'
             $('.active-word .btn').removeClass("btn-talk-active").addClass("btn-talk");
        } else { // Si SÍ está grabando
            talkBtn.addClass('talking'); // Poner clase 'talking'
             $('.active-word .btn').removeClass("btn-talk").addClass("btn-talk-active");
        }
    }
});