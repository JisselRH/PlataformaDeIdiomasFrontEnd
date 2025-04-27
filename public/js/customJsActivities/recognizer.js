import {
    getToken
} from "./requests.js";

const speechsdk = window.SpeechSDK;

var currentBubble;
var recognizer;
var generatedText = [];


var currentPromise = null;

function promiseAndSolver() {
    var resolveFunction = null;
    const promise = new Promise((resolve, reject) => {
        resolveFunction = resolve;
    });
    return promise, resolveFunction;
}


function onRecognizing(sender, recognitionEventArgs) {
    var result = recognitionEventArgs.result;
    // console.log(result.json);
}

function onRecognized(sender, recognitionEventArgs) {
    var result = recognitionEventArgs.result;
    console.log("## RECOGNIZED ##");
    if (result) {
        // console.log(result.json);
    }
}




async function doContinuousRecognition(recognizingFunction) {
    console.log("starting continuous recognition")

    const tokenObj = await getToken();
    const speechConfig = speechsdk.SpeechConfig.fromAuthorizationToken(tokenObj.token, tokenObj.region);
    //console.log(tokenObj);

    /*const token = "";
    const region = "eastus";
    const speechConfig = SpeechSDK.SpeechConfig.fromAuthorizationToken(token, region);*/

    speechConfig.speechRecognitionLanguage = 'en-US';

    const audioConfig = speechsdk.AudioConfig.fromDefaultMicrophoneInput();
    recognizer = new speechsdk.SpeechRecognizer(speechConfig, audioConfig);

    // applyCommonConfigurationTo(recognizer);

    recognizer.recognizing = function (sender, recognitionEventArgs) {
        var result = recognitionEventArgs.result;
        if (result) {
            // console.log(result.json);
            recognizingFunction(result);
        }
    }

    var pronunciationAssessmentConfig = getPronunciationAssessmentConfig('');
    pronunciationAssessmentConfig.applyTo(recognizer);

    recognizer.recognizeOnceAsync();
    return recognizer;
}

function applyCommonConfigurationTo(recognizer, context) {
    var solveFunction = null;

    context.promise = new Promise((resolve, reject) => {
        solveFunction = resolve;
    });



    recognizer.recognized = function (sender, recognitionEventArgs) {
        var result = recognitionEventArgs.result;
        console.log("## RECOGNIZED ##");
        if (result) {
            // console.log(result.json);
            solveFunction(JSON.parse(result.json));
        }
    };
}

function getPronunciationAssessmentConfig(referenceText) {
    /*var pronunciationAssessmentConfig = new SpeechSDK.PronunciationAssessmentConfig(referenceText,
        SpeechSDK.PronunciationAssessmentGradingSystem.HundredMark,
        SpeechSDK.PronunciationAssessmentGranularity.Word, true);*/

    var pronunciationAssessmentConfig = new SpeechSDK.PronunciationAssessmentConfig(referenceText,
        SpeechSDK.PronunciationAssessmentGradingSystem.HundredMark,
        SpeechSDK.PronunciationAssessmentGranularity.Phoneme, true);

    return pronunciationAssessmentConfig;
}

var context = {
    promise: null,
};

function showModalError(tipo) {
  
    if (tipo == 1) {
        $('#error').modal('show');
    } else {
        $('#error-conexion').modal('show');
    }
}

async function pronRecognition(referenceText = '', customFunction) {
    console.log("starting recognition")

    const tokenObj = await getToken();

    if (tokenObj != 503 && tokenObj != 400 && tokenObj != 408) {

        const speechConfig = speechsdk.SpeechConfig.fromAuthorizationToken(tokenObj.token, tokenObj.region);

        /*const token = "";
        const region = "eastus";
        const speechConfig = SpeechSDK.SpeechConfig.fromAuthorizationToken(token, region);*/

        speechConfig.speechRecognitionLanguage = 'en-US';

        const audioConfig = speechsdk.AudioConfig.fromDefaultMicrophoneInput();

        var pronunciationAssessmentConfig = getPronunciationAssessmentConfig(referenceText);
        const recognizer = new SpeechSDK.SpeechRecognizer(speechConfig, audioConfig);
        if (customFunction) {
            console.log("custom function");
            recognizer.recognizing = customFunction;
            applyCommonConfigurationTo(recognizer, context);

        } else {
            recognizer.recognizing = onRecognizing;
            applyCommonConfigurationTo(recognizer, context);
        }
        pronunciationAssessmentConfig.applyTo(recognizer);


        // recognizer.startContinuousRecognitionAsync();
        recognizer.recognizeOnceAsync();

        return recognizer;

    } else {
        if (tokenObj == 503) {
            //problemas de conexion
            console.log("Error request, sin respuesta del servidor");
            showModalError(2);
        } else {
            console.log("Error configuracion de la solicitud");
            showModalError(1);
        }
    }

}


function stopRecognition(recognizer) {
    recognizer.close();

    return context.promise;
}

function stopContinuousRecognition(recognizer) {
    recognizer.close();
    // recognizer.stopContinuousRecognitionAsync(
    //     function () {
    //         recognizer.close();
    //     },
    //     function (err) {
    //         recognizer.close();
    //     });
}

// function continuousRecognitionDialog(onRecognized) {


// }


export {
    pronRecognition,
    doContinuousRecognition,
    stopContinuousRecognition,
    stopRecognition,
}