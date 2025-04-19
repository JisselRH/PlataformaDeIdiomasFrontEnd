import { getToken } from '../requests.js';

const SpeechSDK = window.SpeechSDK;

function showModalError(tipo) {

  if (tipo == 1) {
    $('#error').modal('show');
  } else {
    $('#error-conexion').modal('show');
  }
}

async function synthAudioElement(text, voice) {

  // console.log(voice);
  // console.log(text);
  const tokenObj = await getToken();
  if (tokenObj != 503 && tokenObj != 400 && tokenObj != 408) {

    const speechConfig = SpeechSDK.SpeechConfig.fromAuthorizationToken(tokenObj.token, tokenObj.region);

    //const token = "";
    //const region = "eastus";
    //const speechConfig = SpeechSDK.SpeechConfig.fromAuthorizationToken(token, region);

    if (voice) {
      speechConfig.speechSynthesisVoiceName = voice;
    }

    const synthesizer = new SpeechSDK.SpeechSynthesizer(speechConfig, null);

    const generatedAudio = new Promise((resolve, reject) => {
      synthesizer.speakTextAsync(
        text,
        (result) => {
          if (result.reason === SpeechSDK.ResultReason.SynthesizingAudioCompleted) {
            const audioData = result.audioData;
            resolve(audioData);
          } else {
            console.error('Speech synthesis error:', result.errorDetails);
            reject(result.errorDetails);
          }
        }
      );
    });
    var audioBuffer;
    try {
      audioBuffer = await generatedAudio;
    } catch (error) {
      console.log(error);
    }

    // take an array buffer, transform it to a blob and the create an audio element with the audio blob
    const blob = new Blob([audioBuffer], { type: 'audio/wav' });
    const url = URL.createObjectURL(blob);
    const audioElement = document.createElement('audio');
    audioElement.src = url;

    return audioElement;
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

const reproducerManager = { currentAudio: null };

function playBubble(bubble) {
  const audio = $(bubble).find('audio')[0];
  const { currentAudio } = reproducerManager;

  if (currentAudio) {
    currentAudio.pause();
  }

  reproducerManager.currentAudio = audio;
  audio.play();
}

function stopAudio() {
  const { currentAudio } = reproducerManager;
  if (currentAudio) {
    currentAudio.pause();
  }

}



export {
  stopAudio,
  synthAudioElement,
  playBubble,
}