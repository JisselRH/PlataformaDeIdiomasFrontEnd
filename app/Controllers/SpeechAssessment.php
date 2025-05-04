<?php

namespace App\Controllers;

helper('requests');
helper('training_session');

class SpeechAssessment extends BaseController
{
    public function scripted()
    {
        // log_message('level', 'message');
        $referenceText = $_POST['reference_text'];
        $encodedAudioFile = $_POST['audio'];
        $excerciseType = $_POST['excerciseType'];
        $phraseNumber = $_POST['phraseNumber'];

        // log_message('info', 'phrase number:'.$phraseNumber);

        $url = "https://idiomas.edutecno.cl/api/speechassessment/scripted";
        //$url = "http://localhost:8081/speechassessment/scripted";
        //$url = "https://backend.chacota.cl/speechassessment/scripted";
        
        $headers = ['Content-type: multipart/form-data'];
        $body = array("reference_text" => $referenceText, "audio" => $encodedAudioFile);

        $response = curlPostRequest($url, $headers, $body);

        if ($response == false) {
            $data = array("message" => "problem consuming server");
            return json_encode(['code' => 500, $data, 400]);
        }

        if ($excerciseType == 'training') {
            $jsonResults = json_decode($response, true, 512);
            log_message(1, "hello");
            //session()->currentTrainingResult = $jsonResults;
            editTrainingSession($jsonResults, $phraseNumber);

        }

        $data = array("text" => $referenceText, "response" => $response);
        return json_encode(['success' => 'success', 'csrf' => csrf_hash(), 'respuesta' => $data]);
    }

}
