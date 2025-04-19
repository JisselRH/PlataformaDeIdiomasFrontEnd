import { getToken, dialogRequest, firstResponse } from "../requests.js";
import { pronRecognition, stopRecognition } from "../recognizer.js";
import { synthAudioElement, playBubble, stopAudio } from "./audio-producer-manager.js";
import { ConversationManager } from "./dialog/conversation-manager.js";

import { getCurrentExercise } from "../exercise-cookie.js";
import { ResultsManager } from "../results-manager.js";

var conversationManagers = [];
var conversationsBot = [];
const excercises = [1];
var resultsManager = new ResultsManager(excercises.length);

var index = 0;

function setScore(index, object) {
    console.log(index);
    console.log(object.NBest[0]);
    resultsManager.append(index, object.NBest[0]);
}

function showModalLoading() {
    console.log("showModal LOADING");

    $('#modal-fullscreen-xl').modal('show');
}

var globalStream = null;

$(document).ready(async function () {

    const audio = new Audio("/sounds/computer-click.mp3");

    navigator.mediaDevices
    .getUserMedia({ audio: true, video: false })
    .then((stream) => {
        globalStream = stream;
    });

    // getExerciseCookie();
    const exercise = getCurrentExercise();

    var timeoutVariable = null;
    var timerStopper = null;
    const maxRecDuration = 30;

    const { characterName, characterDescription, image } = exercise;

    const personaje = $('#kt_job_4_2');
    personaje.find('.text-character').text(characterName);
    personaje.find('.js-c-char').attr("src", image);

    const situacion = $('#kt_job_4_3');
    situacion.find('.text-context').text(characterDescription);
    situacion.find('.js-c-char').attr("src", image);

    const conversationManager = new ConversationManager('');
    await setUpChat(conversationManager, exercise);


    $('.btn-talk-dialog').removeClass('disabled');
    playBubble($('.chat-chunk').eq(2));

    //const token = await getToken(); 

    const currentState = { recording: false };

    var reco = null;
    var currentBubble = null;

    function audioPlay(end) {
        audio.play();
        if (end) {
            audio.addEventListener("ended", () => {

                showModalLoading();
                stopAudio();
                window.location.href = "/exercise/practice/dialogResults";
            });
        }

    }

    $('.btn-talk-dialog').click(async function () {
        var detectedText = { text: "" };
        stopAudio();

        audioPlay(false);

        changeTalkBtn($(this), currentState);

        if (currentState.recording) {
            console.log("DONE RECORDING");

            clearTimeout(timeoutVariable);
            clearTimeout(timerStopper);
            resetTimer($("#timer-text-id"), maxRecDuration);

            try {
                $(this).addClass('disabled');

                const answer = await stopRecognition(reco);

                //setScore(0, answer); //guarda el puntaje

                const text = answer.DisplayText;

                /*currentBubble.find('.js-d-text').text(answer.DisplayText);
                currentBubble.addClass("displayed-bubble");

                conversationManager.addUserSentence(text);*/
                const response = await dialogRequest(conversationManager);

                if (response != 503 && response != 400 && response != 408) {

                    //guardar respuest bot
                    currentBubble.find('.js-d-text').text(answer.DisplayText);
                    currentBubble.addClass("displayed-bubble");

                    setScore(0, answer); //guarda el puntaje

                    conversationManager.addUserSentence(text);
                    console.log(response.message);

                    const botBubble = addBubble('bot');
                    conversationsBot.push(response.message);
                    setTextBotBubble(botBubble, response.message, conversationManager);

                    //guardar intento, si es el 3ero-4to,etc desabilitar boton y habilitar el de enviar
                    if (index == 2) {
                        $('.btn-send').removeClass('disabled');
                        $('.btn-go-tables').removeClass('inactive');
                    } else {
                        $(this).removeClass('disabled');
                    }

                    index++;

                } else {

                    if (response == 503) {
                        //problemas de conexion
                        console.log("Error request, sin respuesta del servidor");
                        showModalError(2);
                    } else {
                        console.log("Error configuracion de la solicitud");
                        showModalError(1);
                    }

                }

            } catch (error) {
                console.log(error);
            }



        }
        else {
            console.log("START RECORDING");

            timerStopper = startTimer(maxRecDuration);

            timeoutVariable = setTimeout(() => {
                //si se terminan los segundos establecidos
                StopRecordingLimitExceeded($(this))

            }, maxRecDuration * 1000);
            // const text = selectedWord();
            // console.log(text);

            //aqui
            currentBubble = addBubble('user');

            reco = await pronRecognition('',
                function (sender, result) {
                    console.log(result)
                    const text = result.privResult.privText;
                    try {
                        onRecognizing(text, currentBubble)
                    } catch (error) {
                        console.log(error);
                    }
                },
            );

        }

        currentState.recording = !currentState.recording;
    });

    //inicio btn send
    $('.btn-send').click(async function () {

        this.classList.add('disabled');

        localStorage.setItem('resultsManager', JSON.stringify(resultsManager));
        localStorage.setItem('conversationsBot', JSON.stringify(conversationsBot));

        console.log();

        audioPlay(true);

        //window.location.href = "/exercise/practice/dialogResults";
    });
    //fin btn send

    async function StopRecordingLimitExceeded(button) {
        index++;
        try {
            button.addClass('disabled');
            const answer = await stopRecognition(reco);
            const text = answer.DisplayText;

            currentBubble.find('.js-d-text').text(answer.DisplayText);

            conversationManager.addUserSentence(text);

            const response = await dialogRequest(conversationManager);

            if (response != 503 && response != 400 && response != 408) {

                console.log(response.message);

                const botBubble = addBubble('bot');
                setTextBotBubble(botBubble, response.message, conversationManager)
                button.removeClass('disabled');

                clearTimeout(timeoutVariable);
                clearTimeout(timerStopper);
                resetTimer($("#timer-text-id"), maxRecDuration);
            } else {

                if (response == 503) {
                    //problemas de conexion
                    console.log("Error request, sin respuesta del servidor");
                    showModalError(2);
                } else {
                    console.log("Error configuracion de la solicitud");
                    showModalError(1);
                }

            }

        } catch (error) {
            console.log(error);
        }
    }
});


async function setTextBotBubble(botBubble, text, convManager) {

    botBubble.find('.js-d-text').text(text);
    const chatContainer = $('.js-chat-container')
    scrollDown(chatContainer);
    const audioElement = await synthAudioElement(text, convManager.neuralVoice);
    //validar error
    botBubble.append(audioElement);
    playBubble(botBubble);
}


function onRecognizing(text, currentBubble) {
    currentBubble.find('.js-d-text').text(text);
}

function addBubble(type) {

    const chatContainer = $('.js-chat-container');
    var bubble;

    if (type === 'user') {
        bubble = $('#js-user-sample').clone();
    }
    else if (type === 'bot') {
        bubble = $('#js-bot-sample').clone();
    }
    else {
        // 0/0;
    }

    bubble.removeAttr('id');
    bubble.removeClass('hide');
    chatContainer.append(bubble);
    scrollDown(chatContainer);
    return bubble;
}

function changeTalkBtn(talkBtn, currentState) {
    //console.log(currentState);
    if (currentState.recording) {
        //console.log("REMOVING CLASS");
        talkBtn.removeClass('talking');
    }
    else {
        talkBtn.addClass('talking');
    }
    // change the button source image set by css
}

function scrollDown(chatPanel) {
    chatPanel.scrollTop(chatPanel[0].scrollHeight);
}

function showModalError(tipo) {

    if (tipo == 1) {
        $('#error').modal('show');
    } else {
        $('#error-conexion').modal('show');
    }
}

async function setUpChat(conversationManager, exercise) {
    const { context, characterName, characterDescription, image } = exercise;
    console.log("setUpChat");

    const initialData = await firstResponse(exercise);

    if (initialData != 503 && initialData != 400 && initialData != 408) {

        const system = buildSystem(characterName, characterDescription);

        const botBubble = $('#js-bot-sample');
        botBubble.find('.js-d-name').text(characterName);
        botBubble.find('.js-c-char').attr("src", image);
        const { neuralVoice } = initialData;
        const { firstDialog } = initialData;

        //guardado firstDialog del bot
        conversationsBot.push(firstDialog);

        conversationManager.addSystemParam(system);
        conversationManager.addBotSentence(firstDialog);
        conversationManager.addVoice(neuralVoice);

        const chatContainer = $('.js-chat-container');
        const bubble = addBotBubble(firstDialog);
        const audioElement = await synthAudioElement(firstDialog, neuralVoice);
        bubble.append(audioElement);

        chatContainer.append(bubble);

        return 0;
    } else {

        if (initialData == 503) {
            //problemas de conexion
            console.log("Error request, sin respuesta del servidor");
            showModalError(2);
        } else {
            console.log("Error configuracion de la solicitud");
            showModalError(1);
        }

    }
}

function addBotBubble(text) {
    const chatContainer = $('.js-chat-container');
    const bubble = $('#js-bot-sample').clone();
    bubble.removeClass('hide');
    bubble.find('.js-d-text').text(text);
    bubble.removeAttr('id');
    chatContainer.append(bubble);
    scrollDown(chatContainer);
    return bubble;
}

function buildSystem(characterName, characterDescription) {
    return `pretend to be ${characterName}. ${characterDescription}`;
};


function formatTime(timeInSeconds) {
    const hours = Math.floor(timeInSeconds / 3600);

    // calculate the hours, minutes, and seconds
    const minutes = Math.floor((timeInSeconds - hours * 3600) / 60);
    const seconds = timeInSeconds - hours * 3600 - minutes * 60;

    // format the time as HH:MM:SS
    const formattedTime = `${seconds
        .toString()
        .padStart(2, "0")}`;
    return formattedTime;
}

function startTimer(timeout) {
    const timer = $("#timer-text-id");
    // set the start time
    resetTimer(timer, timeout);
    let startTime = 0;

    // update the timer every second
    const timerStopper = setInterval(() => {
        // get the current time
        const currentTime = new Date().getTime();

        // calculate the time elapsed in seconds
        const remainingTime =
            timeout - Math.floor((currentTime - startTime) / 1000);
        const formattedTime = formatTime(remainingTime);

        // update the timer element
        timer.html(formattedTime);
    }, 1000);

    // start the timer
    startTime = new Date().getTime();

    // this variable stops the timer
    return timerStopper;
}

function resetTimer(timer, time) {
    const formattedTime = formatTime(time);
    timer.html(formattedTime);
}
