import { getToken } from "../requests.js";
import { getCookieValue } from "../exercise-cookie.js";
import { pronRecognition, stopRecognition } from "../recognizer.js";

// --- Variables Globales ---
var globalStream = null;
var reco = null;
const currentState = { recording: false };
const isMobileApp = window.hasOwnProperty('cordova') || 
                   window.hasOwnProperty('Capacitor') || 
                   /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

// --- Funciones de Utilidad ---
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

function handleAudioError(error) {
    console.error("Error accessing audio devices:", error.name, error.message, error);
    globalStream = null;

    let userMessage = "Ocurrió un error inesperado con el micrófono.";
    let showMobileSettingsBtn = false;

    switch (error.name) {
        case 'NotAllowedError':
        case 'PermissionDeniedError':
            userMessage = isMobileApp 
                ? "Permiso denegado. Habilita el micrófono en ajustes de la aplicación." 
                : "Permiso denegado. Habilita el micrófono en los ajustes de tu navegador.";
            showMobileSettingsBtn = isMobileApp;
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

    if (showMobileSettingsBtn && $('#open-settings-btn').length === 0) {
        $('body').append(`
            <button id="open-settings-btn" class="btn btn-settings" style="
                position: fixed;
                bottom: 20px;
                left: 50%;
                transform: translateX(-50%);
                padding: 10px 20px;
                background: #4285f4;
                color: white;
                border: none;
                border-radius: 5px;
                z-index: 1000;
            ">
                Abrir Configuración
            </button>
        `);
        
        $('#open-settings-btn').click(() => {
            if (window.cordova && cordova.plugins.diagnostic) {
                cordova.plugins.diagnostic.switchToSettings();
            } else {
                alert('Por favor, ve a Configuración > Aplicaciones > [Esta app] > Permisos');
            }
        });
    }
}

function selectedWord() {
    return $('.active-word').find('.word-content').text();
}

function processScore(result) {
    try {
        if (!result || !result.NBest || !result.NBest[0] || !result.NBest[0].PronunciationAssessment) {
            console.error("Resultado del reconocimiento incompleto o inválido:", result);
            updateUserFeedback("No se pudo obtener el puntaje.", true);
            return null;
        }
        const score = result.NBest[0].PronunciationAssessment.PronScore;
        console.log("Score obtained:", score);
        return score;
    } catch (error) {
        console.error("Error al procesar el puntaje:", error, result);
        updateUserFeedback("Error al procesar el puntaje.", true);
        return null;
    }
}

// --- Función optimizada para verificar permisos ---
async function checkMicrophonePermissions() {
    try {
        // 1. Verificar si el navegador soporta la API
        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
            throw new Error('API de medios no soportada');
        }

        // 2. Verificar si ya tenemos permisos
        let hasPermission = false;
        try {
            const devices = await navigator.mediaDevices.enumerateDevices();
            hasPermission = devices.some(device => 
                device.kind === 'audioinput' && device.deviceId !== '');
        } catch (e) {
            console.warn("No se pudo enumerar dispositivos:", e);
        }

        // 3. Si es móvil y no tiene permisos, manejar diferente
        if (isMobileApp && !hasPermission) {
            // Primero intentar obtener permisos del WebView
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                stream.getTracks().forEach(track => track.stop());
                return true;
            } catch (error) {
                console.log("Error al solicitar permisos en móvil:", error);
                updateUserFeedback("Por favor, habilita los permisos del micrófono en la configuración de tu navegador también.", true);
                
                // Mostrar botón para reintentar
                showMobilePermissionHelp();
                return false;
            }
        }

        // 4. Para navegadores normales
        if (!hasPermission) {
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
            stream.getTracks().forEach(track => track.stop());
        }

        return true;
    } catch (error) {
        console.error("Error en checkMicrophonePermissions:", error);
        handleAudioError(error);
        return false;
    }
}

// --- Mostrar ayuda para móviles ---
function showMobilePermissionHelp() {
    // Eliminar cualquier panel existente primero
    $('.mobile-permission-help').remove();
    
    const helpPanel = `
        <div class="mobile-permission-help" style="
            position: fixed;
            bottom: 20px;
            left: 10px;
            right: 10px;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            z-index: 1000;
        ">
            <h3 style="margin-top: 0;">Permisos requeridos</h3>
            <p>Para que funcione el micrófono:</p>
            <ol>
                <li>Abre la configuración de tu navegador</li>
                <li>Busca la sección de permisos</li>
                <li>Habilita el acceso al micrófono</li>
            </ol>
            <button id="retry-mic-btn" style="
                background: #4285f4;
                color: white;
                border: none;
                padding: 10px 15px;
                border-radius: 5px;
                margin-top: 10px;
                width: 100%;
            ">Reintentar</button>
        </div>
    `;
    
    $('body').append(helpPanel);
    
    $('#retry-mic-btn').click(async function() {
        $('.mobile-permission-help').remove();
        await initializeMicrophone();
    });
}
// --- Modifica tu initializeMicrophone ---
async function initializeMicrophone() {
    const hasPermissions = await checkMicrophonePermissions();
    if (!hasPermissions) return false;

    try {
        globalStream = await navigator.mediaDevices.getUserMedia({ 
            audio: {
                echoCancellation: true,
                noiseSuppression: true,
                autoGainControl: true
            }, 
            video: false 
        });

        globalStream.getAudioTracks().forEach(track => {
            track.onended = () => {
                console.log("El track de audio ha terminado");
                handleAudioError(new Error("El acceso al micrófono fue revocado"));
            };
        });

        enableRecordingFeatures(true);
        return true;
    } catch (error) {
        handleAudioError(error);
        return false;
    }
}

// --- Flujo Principal ---
$(document).ready(async function () {
    updateUserFeedback("Inicializando ejercicio...");

    // 1. Obtener Token
    let token;
    try {
        token = await getToken();
        if (!token) throw new Error("Token no recibido.");
        console.log("Token obtained successfully.");
    } catch (error) {
        console.error("Error al obtener el token:", error);
        updateUserFeedback("Error de autenticación. No se puede continuar.", true);
        showModalError(1);
        return;
    }

    // 2. Obtener Palabras
    const words = getCookieValue('words');
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
        return;
    }

    // 3. Inicializar Micrófono
    const micInitialized = await initializeMicrophone();
    
    if (!micInitialized) {
        const retryHtml = `
            <div class="mic-retry-panel" style="
                text-align: center;
                padding: 20px;
                background: #f8f9fa;
                border-radius: 8px;
                margin: 20px 0;
            ">
                <p>No se pudo acceder al micrófono</p>
                <button class="btn-retry-mic" style="
                    margin: 10px;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 4px;
                    background-color: #4285f4;
                    color: white;
                    cursor: pointer;
                ">
                    Reintentar
                </button>
                ${isMobileApp ? `
                <button class="btn-open-settings" style="
                    margin: 10px;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 4px;
                    background-color: #34a853;
                    color: white;
                    cursor: pointer;
                ">
                    Abrir Configuración
                </button>` : ''}
            </div>
        `;
        
        $('.mic-container').html(retryHtml);
        
        $('.btn-retry-mic').click(async () => {
            $('.mic-retry-panel').html('<p>Intentando nuevamente...</p>');
            await initializeMicrophone();
        });
        
        if (isMobileApp) {
            $('.btn-open-settings').click(() => {
                if (window.cordova && cordova.plugins.diagnostic) {
                    cordova.plugins.diagnostic.switchToSettings();
                } else {
                    alert('Por favor, habilita los permisos manualmente en configuración');
                }
            });
        }
        
        return;
    }

    // 4. Configurar Event Listener del Botón
    $('.btn-talk-clic').click(async function () {
        const $thisButton = $(this);

        if (!globalStream || !globalStream.active || globalStream.getAudioTracks().length === 0) {
            updateUserFeedback("El micrófono no está disponible o el permiso fue revocado.", true);
            handleAudioError(new Error("Stream not available or inactive."));
            return;
        }

        currentState.recording = !currentState.recording;
        changeTalkBtn($thisButton, currentState);

        if (!currentState.recording) {
            updateUserFeedback("Procesando audio...");
            try {
                if (!reco) {
                    console.warn("Attempted to stop recognition, but 'reco' was null.");
                    updateUserFeedback("No se había iniciado ninguna grabación.", true);
                    return;
                }
                const result = await stopRecognition(reco);
                reco = null;

                if (!result) {
                    throw new Error("El reconocimiento no devolvió resultado.");
                }

                console.log("Recognition successful:", result);
                updateUserFeedback("Grabación procesada.");

                const score = processScore(result);

                if (score !== null) {
                    const wordDiv = $('.active-word');
                    wordDiv.find('.word-feedback').text(`${score}/100`);
                    const btn = wordDiv.find('.btn-content .btn');
                    btn.removeClass("btn-talk-active").addClass("btn-talk-finished");
                    nextWord();
                }

            } catch (error) {
                console.error("Error durante la detención o procesamiento del reconocimiento:", error);
                updateUserFeedback(`Error al procesar: ${error.message || 'Desconocido.'}`, true);
                reco = null;
                currentState.recording = false;
                changeTalkBtn($thisButton, currentState);
            }

        } else {
            updateUserFeedback("Escuchando...");
            const text = selectedWord();
            console.log("Starting recognition for:", text);

            try {
                const btn = $('.active-word').find('.btn-content .btn');
                btn.removeClass("btn-talk").addClass("btn-talk-active");

                reco = await pronRecognition(text);
                if (!reco) throw new Error("No se pudo iniciar el reconocedor.");
                console.log("Recognition started.");

            } catch (error) {
                console.error("Error al iniciar el reconocimiento:", error);
                updateUserFeedback(`Error al iniciar: ${error.message || 'Desconocido.'}`, true);
                currentState.recording = false;
                changeTalkBtn($thisButton, currentState);
                reco = null;
            }
        }
    });

    // 5. Botón 'Send'
    $('.btn-send').click(function () {
        nextWord();
    });

    // --- Funciones Auxiliares ---
    function showModalError(tipo) {
        console.log("showModal ERROR type:", tipo);
        $('#modal-fullscreen-xl').modal('hide');
        const modalId = (tipo === 1) ? '#error' : '#error-conexion';
        $(modalId).modal('show');
    }

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
        }
    }

    function changeTalkBtn(talkBtn, state) {
        console.log("Changing button state:", state.recording);
        if (!state.recording) {
            talkBtn.removeClass('talking');
            $('.active-word .btn').removeClass("btn-talk-active").addClass("btn-talk");
        } else {
            talkBtn.addClass('talking');
            $('.active-word .btn').removeClass("btn-talk").addClass("btn-talk-active");
        }
    }
});