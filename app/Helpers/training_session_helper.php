<?php

function editTrainingSession($jsonResults, $phraseNumber)
{
    // print_r(session()->training);
    // log_message('info', json_encode(session()->trainingSession, JSON_PRETTY_PRINT));

    $phraseId = $phraseNumber - 1; 
    $trainingSession = session()->trainingSession;
    // log_message('info', json_encode($jsonResults, JSON_PRETTY_PRINT));

    array_push($trainingSession[$phraseId]["results"], $jsonResults);
    // log_message('info', json_encode($trainingSession, JSON_PRETTY_PRINT));
    // if ($trainingSession['currentAttempt'] == $trainingSession['attempts'])
    // {
    //     $trainingSession['currentAttempt'] = 0;
    //     $trainingSession['currentPhrase'] += 1;

    // }
    session()->trainingSession = $trainingSession;
    // log_message('info', json_encode(session()->trainingSession, JSON_PRETTY_PRINT));

    // $trainingHistory = session()->trainingDataHistory;
    // array_push($trainingHistory, $jsonResults);
    // session()->trainingDataHistory = $trainingHistory;

    return;
}

function arrayAverage($array) {
    if (count($array) == 0){
        return 0;
    }

    $sum = array_reduce($array, function ($carry, $new) {
        return $carry + $new;
    }, 0);

    return $sum / count($array);

}

function reduceArraysToAverage($bigArray) {
    $newBigArray = array();
    foreach (array_keys($bigArray) as $key => $value) {
        $smallArray = $bigArray[$value];
        $newBigArray[$value] = arrayAverage($smallArray);
    }

    return $newBigArray;
}

// groups all session results in a big array 
function groupSessionResults() {
    $trainingSession = session()->trainingSession;
    $allSessionsResults = array();
    foreach ($trainingSession as $key => $currentSession) {
        $currentResults = $currentSession['results'];
        $allSessionsResults = array_merge($allSessionsResults, $currentResults);
    }
    return $allSessionsResults; 
}

function baseDistribution() {
    return array(
        "complete" => 0,
        "incomplete" => 0,
        "null" => 0
    );
}

function changeDistribution($distribution, $value) {
    // print "change dist";
    if ($value > 94) {
        $distribution["complete"] = $distribution["complete"] + 1;

    }
    else if ($value > 30) {
        $distribution["incomplete"] += 1;
    }
    else {
        $distribution["null"] += 1;
    }
    return $distribution;
}

function sessionResultsSummary($dataHistory)
{


    $wordSummary = array();
    $phonemeSummary = array();
    $scoreSummary = array();

    $wordDistribution = baseDistribution();
    $phonemeDistribution = baseDistribution();


    foreach ($dataHistory as $key => $data) {
        array_push($scoreSummary, $data['PronScore']);

        foreach ($data['Words'] as $key => $wordArray) {
            $word = $wordArray['Word'];
            $accuracy = $wordArray['AccuracyScore'];

            $wordDistribution = changeDistribution($wordDistribution, $accuracy);

            if (!isset($wordSummary[$word]))
            {
                $wordSummary[$word] = [$accuracy];
            }
            else 
            {
                array_push($wordSummary[$word], $accuracy);
            }

            foreach ($wordArray['Phonemes'] as $key => $phonemeArray) {
                $phoneme = $phonemeArray['Phoneme'];
                $accuracy = $phonemeArray['AccuracyScore'];

                $phonemeDistribution = changeDistribution($phonemeDistribution, $accuracy);
    
                if (!isset($phonemeSummary[$phoneme]))
                {
                    $phonemeSummary[$phoneme] = [$accuracy];
                }
                else 
                {
                    array_push($phonemeSummary[$phoneme], $accuracy);
                }


            }

        }
    }


    $averageSummary = array(
        'words' => reduceArraysToAverage($wordSummary),
        'phonemes' => reduceArraysToAverage($phonemeSummary),
        'finalScores' => array(
            'overallAccuaracy' => arrayAverage($scoreSummary),
            'attemptsNumber' => count($dataHistory)
        ),
        'distributions' => array(
            'words' => $wordDistribution,
            'phonemes' => $phonemeDistribution
        )
    );


    // echo "Hello word";
    return $averageSummary;

}