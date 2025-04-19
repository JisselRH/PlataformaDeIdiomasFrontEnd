<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

helper('training_session');

class Pronunciation extends BaseController
{
    public function __construct()
    {
    }

    public function testTake()
    {

        $string = '{"Confidence":0.93394834,"Lexical":"Hello how are you I would like to know something more about you","ITN":"Hello how are you I would like to know something more about you","MaskedITN":"hello how are you i would like to know something more about you","Display":"Hello, how are you? I would like to know something more about you.","AccuracyScore":82,"FluencyScore":63,"CompletenessScore":85,"PronScore":71.2,"Words":[{"Word":"Hello","Offset":7100000,"Duration":1700000,"Confidence":0,"AccuracyScore":3,"ErrorType":"Mispronunciation","Syllables":[{"Syllable":"h\u025b","Offset":7100000,"Duration":500000,"AccuracyScore":3},{"Syllable":"lo\u028a","Offset":7700000,"Duration":1100000,"AccuracyScore":5}],"Phonemes":[{"Phoneme":"h","Offset":7100000,"Duration":200000,"AccuracyScore":0},{"Phoneme":"\u025b","Offset":7400000,"Duration":200000,"AccuracyScore":6},{"Phoneme":"l","Offset":7700000,"Duration":500000,"AccuracyScore":10},{"Phoneme":"o\u028a","Offset":8300000,"Duration":500000,"AccuracyScore":0}]},{"Word":"how","Offset":13900000,"Duration":2300000,"Confidence":0,"AccuracyScore":60,"ErrorType":"None","Syllables":[{"Syllable":"ha\u028a","Offset":13900000,"Duration":2300000,"AccuracyScore":60}],"Phonemes":[{"Phoneme":"h","Offset":13900000,"Duration":1600000,"AccuracyScore":57},{"Phoneme":"a\u028a","Offset":15600000,"Duration":600000,"AccuracyScore":68}]},{"Word":"are","Offset":16300000,"Duration":1800000,"Confidence":0,"AccuracyScore":80,"ErrorType":"None","Syllables":[{"Syllable":"\u0251r","Offset":16300000,"Duration":1800000,"AccuracyScore":51}],"Phonemes":[{"Phoneme":"\u0251","Offset":16300000,"Duration":600000,"AccuracyScore":5},{"Phoneme":"r","Offset":17000000,"Duration":1100000,"AccuracyScore":78}]},{"Word":"you","Offset":18200000,"Duration":2100000,"Confidence":0,"AccuracyScore":100,"ErrorType":"None","Syllables":[{"Syllable":"ju","Offset":18200000,"Duration":2100000,"AccuracyScore":59}],"Phonemes":[{"Phoneme":"j","Offset":18200000,"Duration":700000,"AccuracyScore":100},{"Phoneme":"u","Offset":19000000,"Duration":1300000,"AccuracyScore":35}]},{"Word":"I","Offset":27300000,"Duration":2000000,"Confidence":0,"AccuracyScore":100,"ErrorType":"None","Syllables":[{"Syllable":"a\u026a","Offset":27300000,"Duration":2000000,"AccuracyScore":100}],"Phonemes":[{"Phoneme":"a\u026a","Offset":27300000,"Duration":2000000,"AccuracyScore":100}]},{"Word":"would","Offset":29400000,"Duration":1700000,"Confidence":0,"AccuracyScore":100,"ErrorType":"None","Syllables":[{"Syllable":"w\u028ad","Offset":29400000,"Duration":1700000,"AccuracyScore":100}],"Phonemes":[{"Phoneme":"w","Offset":29400000,"Duration":700000,"AccuracyScore":100},{"Phoneme":"\u028a","Offset":30200000,"Duration":300000,"AccuracyScore":100},{"Phoneme":"d","Offset":30600000,"Duration":500000,"AccuracyScore":100}]},{"Word":"like","Offset":31200000,"Duration":2300000,"Confidence":0,"AccuracyScore":100,"ErrorType":"None","Syllables":[{"Syllable":"la\u026ak","Offset":31200000,"Duration":2300000,"AccuracyScore":100}],"Phonemes":[{"Phoneme":"l","Offset":31200000,"Duration":700000,"AccuracyScore":100},{"Phoneme":"a\u026a","Offset":32000000,"Duration":600000,"AccuracyScore":100},{"Phoneme":"k","Offset":32700000,"Duration":800000,"AccuracyScore":100}]},{"Word":"to","Offset":33600000,"Duration":1100000,"Confidence":0,"AccuracyScore":100,"ErrorType":"None","Syllables":[{"Syllable":"t\u028a","Offset":33600000,"Duration":1100000,"AccuracyScore":50}],"Phonemes":[{"Phoneme":"t","Offset":33600000,"Duration":500000,"AccuracyScore":100},{"Phoneme":"\u028a","Offset":34200000,"Duration":500000,"AccuracyScore":1}]},{"Word":"know","Offset":34800000,"Duration":4700000,"Confidence":0,"AccuracyScore":98,"ErrorType":"None","Syllables":[{"Syllable":"no\u028a","Offset":34800000,"Duration":4700000,"AccuracyScore":98}],"Phonemes":[{"Phoneme":"n","Offset":34800000,"Duration":1100000,"AccuracyScore":100},{"Phoneme":"o\u028a","Offset":36000000,"Duration":3500000,"AccuracyScore":98}]},{"Word":"something","Offset":39800000,"Duration":8800000,"Confidence":0,"AccuracyScore":93,"ErrorType":"None","Syllables":[{"Syllable":"s\u028cm","Offset":39800000,"Duration":3700000,"AccuracyScore":100},{"Syllable":"\u03b8\u026a\u014b","Offset":43600000,"Duration":5000000,"AccuracyScore":87}],"Phonemes":[{"Phoneme":"s","Offset":39800000,"Duration":1900000,"AccuracyScore":100},{"Phoneme":"\u028c","Offset":41800000,"Duration":900000,"AccuracyScore":100},{"Phoneme":"m","Offset":42800000,"Duration":700000,"AccuracyScore":100},{"Phoneme":"\u03b8","Offset":43600000,"Duration":1300000,"AccuracyScore":100},{"Phoneme":"\u026a","Offset":45000000,"Duration":500000,"AccuracyScore":100},{"Phoneme":"\u014b","Offset":45600000,"Duration":3000000,"AccuracyScore":79}]},{"Word":"more","Offset":50000000,"Duration":2900000,"Confidence":0,"AccuracyScore":98,"ErrorType":"None","Syllables":[{"Syllable":"m\u0254r","Offset":50000000,"Duration":2900000,"AccuracyScore":98}],"Phonemes":[{"Phoneme":"m","Offset":50000000,"Duration":1800000,"AccuracyScore":100},{"Phoneme":"\u0254","Offset":51900000,"Duration":600000,"AccuracyScore":100},{"Phoneme":"r","Offset":52600000,"Duration":300000,"AccuracyScore":85}]},{"Word":"about","Offset":53000000,"Duration":4700000,"Confidence":0,"AccuracyScore":35,"ErrorType":"Mispronunciation","Syllables":[{"Syllable":"\u0259","Offset":53000000,"Duration":1100000,"AccuracyScore":57},{"Syllable":"ba\u028at","Offset":54200000,"Duration":3500000,"AccuracyScore":28}],"Phonemes":[{"Phoneme":"\u0259","Offset":53000000,"Duration":1100000,"AccuracyScore":57},{"Phoneme":"b","Offset":54200000,"Duration":1100000,"AccuracyScore":11},{"Phoneme":"a\u028a","Offset":55400000,"Duration":700000,"AccuracyScore":38},{"Phoneme":"t","Offset":56200000,"Duration":1500000,"AccuracyScore":36}]},{"Word":"you","Offset":58000000,"Duration":3400000,"Confidence":0,"AccuracyScore":99,"ErrorType":"None","Syllables":[{"Syllable":"ju","Offset":58000000,"Duration":3400000,"AccuracyScore":96}],"Phonemes":[{"Phoneme":"j","Offset":58000000,"Duration":1700000,"AccuracyScore":100},{"Phoneme":"u","Offset":59800000,"Duration":1600000,"AccuracyScore":92}]}]}';
      
        $phrases = [];

        
        $total_exercises = count(glob('./data/{*.json}', GLOB_BRACE));
        $exerciseNumber = rand(1, $total_exercises);
        $url = "./data/exercise" . $exerciseNumber . ".json";
        $data = file_get_contents($url);
        $phrasesA = json_decode($data, true);

        foreach ($phrasesA as $phrase) {
            array_push($phrases, $phrase["phrase"]);
        }

        $myboolean = !session()->trainingSession;

        if (true) {
            $trainingArray = array();
            foreach ($phrases as $key => $phrase) {
                $phraseInfo = array(
                    "phrase" => $phrase,
                    // "results" => [json_decode($string, true, 1024)],
                    "results" => [],
                    "attempts" => 0,
                    "totalAttempts" => 3
                );
                array_push($trainingArray, $phraseInfo);
            }
            session()->trainingSession = $trainingArray;
        }

        // print_r(session()->trainingSession);
        return view('pronunciation/test_take');
    }

}
