

import { getToken } from "../requests.js";
import { genPhrases } from "../requests.js";
import { getCookieValue } from "../exercise-cookie.js";
import { pronRecognition, stopRecognition } from "../recognizer.js";

const currentWord = {
    words: null,
    index: 0,
}

function selectedWord() {
    return $('.active-word').find('.word-content').text();
}

function getScore(object) {
    const score = object.NBest[0].PronunciationAssessment.PronScore;
    console.log(score);

    return score;
}

function showModalLoading() {
    console.log("showModal LOADING");

    $('#modal-fullscreen-xl').modal('show');
}

function hideModalLoading() {
    console.log("hideModal LOADING");

    $('#modal-fullscreen-xl').modal('hide');
}

var globalStream = null;

$(document).ready(async function () {

    navigator.mediaDevices
    .getUserMedia({ audio: true, video: false })
    .then((stream) => {
        globalStream = stream;
    });
    
    
    const words = getCookieValue('words');
    const context = getCookieValue('context');

    showModalLoading();

    const phrases = await genPhrases(context, words);

    setTimeout(() => { hideModalLoading();  }, 2000);

    const wordsContainer = $('.exercise-word-container');
    const sample = wordsContainer.find('.exercise-word');

    var first = true;

    //if(phrases) {
    if (phrases != 503 && phrases != 400 && phrases != 408) {
        phrases.forEach(phrase => {
            const wordElement = sample.clone();
            wordElement.find('.word-content').text(cleanPhrase(phrase));
            wordsContainer.append(wordElement);

            if(first) {
                wordElement.addClass('active-word');
                first = false;
                const btn = wordElement.find('.btn');
                btn.removeClass("btn-talk-disabled");
                btn.addClass("btn-talk");
            }
        });

    }else{
        console.log("Else de Phrases");
        if (phrases == 503) {
            //problemas de conexion
            console.log("Error request, sin respuesta del servidor");
            showModalError(2);
        } else {
            console.log("Error configuracion de la solicitud");
            showModalError(1);
        }
    }
    sample.remove();

    //const token = await getToken();
    //console.log(token)


    const currentState = {recording: false};
    var reco = null;

    $('.btn-talk-clic').click(async function () {
        console.log('talk button clicked');

        changeTalkBtn($(this), currentState);

        if (currentState.recording) {
            console.log("DONE RECORDING");
            try {
                const result = await stopRecognition(reco);
                const score = getScore(result);
                const wordDiv = $('.active-word');
                wordDiv.find('.word-feedback').text(`${score}/100`);

                var btn = wordDiv.find('.btn-content');
                btn.find('.btn').removeClass("btn-talk-active");
                btn.find('.btn').addClass("btn-talk-finished");

                nextWord();
            } catch (error) {
            }

        }
        else {
            console.log("START RECORDING");

            var btn = $('.active-word').find('.btn-content');
            btn.find('.btn').removeClass("btn-talk");
            btn.find('.btn').addClass("btn-talk-active");

            const text = selectedWord();
            console.log(text);
            reco = await pronRecognition(text);

        }

        currentState.recording = !currentState.recording;

    });

    $('.btn-send').click(function () {
        nextWord();

    });


    function showModalError(tipo) {
        console.log("showModal ERROR");
        $('#modal-fullscreen-xl').modal('hide');
    
    
        if (tipo == 1) {
            $('#error').modal('show');
        } else {
            $('#error-conexion').modal('show');
        }
    }
});

function nextWord() {
    const activeWord = $('.active-word');
    const nextWord = activeWord.next('.exercise-word');
    
    var btn = $('.active-word').find('.btn-content');
    btn.find('.btn').removeClass("btn-talk");
    btn.find('.btn').addClass("btn-talk-disabled");

    activeWord.removeClass('active-word');
    activeWord.addClass('done-word');

    if (nextWord.length > 0) {
        nextWord.addClass('active-word');
        var btn = $('.active-word').find('.btn-content');

        btn.find('.btn').removeClass("btn-talk-disabled");
        btn.find('.btn').addClass("btn-talk");
    }
    else {
        console.log("FINISHED");
        /*$('.btn-talk').addClass('disabled');
        const btn = wordElement.find('.btn');
        btn.removeClass("btn-talk");
        btn.addClass("btn-talk-disabled");*/
        
    }
}

function changeTalkBtn(talkBtn, currentState) {
    console.log(currentState);
    if (currentState.recording) {
        console.log("REMOVING CLASS");
        talkBtn.removeClass('talking');
    }
    else {
        talkBtn.addClass('talking');
    }
    // change the button source image set by css
}

function getCurrentSelectedWord() {
    return $('.active-word').find('.word-content').text();
}

function cleanPhrase(phrase) {
    const noSkip = phrase.replace(/\n/g, "");
    return noSkip.slice(1, -1);
}