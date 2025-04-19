"use strict";
import { initMixedWidget10b } from "../graphs.js";
import { ResultsManager } from "../results-manager.js";
import { getCurrentExercise } from "../exercise-cookie.js";

var resultsManager = new ResultsManager(1);

function renderResults(results, id) {
    console.log(results);
    resultsManager = results;

    const megacontainer = $('.mega-container');

    const element = $('.container-dialog').clone();
    $('.container-dialog').empty();

    const partialResultsPanel = megacontainer.clone();

    partialResultsPanel.appendTo(element);
    setUpResults(partialResultsPanel, results, id);

    setUpColorBubbles(megacontainer, results, id);
}

var dataTotal = null;

function setUpResults(panel, results, id) {

    //const resultsSummary = results.getPartialResults(id);
    const resultsSummary = getPartialResults(results, "todas");
    const pronScore = resultsSummary.finalScores.pronScore;
    const graphContainer = panel.find(".graph-container");

    //var s = pronScore.toString();
    var s = Math.trunc(pronScore).toString();
    $("#pron-score").text(s);

    //const data = extractValuesArray(resultsSummary);
    dataTotal = extractValuesArray(resultsSummary);
    initMixedWidget10b(dataTotal);
}

function extractValuesArray(results) {
    const values = ['pronScore', 'fluencyScore', 'accuracyScore', 'completenessScore'];
    const finalValues = [];
    values.forEach(function (value) {
        finalValues.push(results.finalScores[value]);

    });

    const data = {
        'score': finalValues,
        'categories': ['Pronunciación', 'Fluidez', 'Precisión', 'Completitud'],
        'hoverText': ['Score, ', 'a', 'b', 'c']
    }
    console.log(data);

    return data;
}

function extractValuesArrayByKey(results, key) {
    const values = ['pronScore', 'fluencyScore', 'accuracyScore', 'completenessScore'];
    const finalValues = [];

    console.log(results['results']['0'][key]);

    finalValues.push(results['results']['0'][key]['PronunciationAssessment']['PronScore']);
    finalValues.push(results['results']['0'][key]['PronunciationAssessment']['FluencyScore']);
    finalValues.push(results['results']['0'][key]['PronunciationAssessment']['AccuracyScore']);
    finalValues.push(results['results']['0'][key]['PronunciationAssessment']['CompletenessScore']);


    /*values.forEach(function (value) {
        finalValues.push(results.finalScores[value]);

    });*/

    const data = {
        'score': finalValues,
        'categories': ['Pronunciación', 'Fluidez', 'Precisión', 'Completitud'],
        'hoverText': ['Score, ', 'a', 'b', 'c']
    }
    console.log(data);

    return data;
}


async function setUpColorBubbles(panel, results, id) {

    var conversationsBot = JSON.parse(localStorage.getItem('conversationsBot'));
    await createBubbles(results['results']['0'][0]['Lexical'], conversationsBot);

    const userBubbles = document.querySelectorAll('.displayed-bubble');
    const arrayResults = results['results']['0'];
    /*console.log("arr results: ", arrayResults);
    console.log("id: ", id);
    console.log("arrayResults.length: ", arrayResults.length);
    console.log("userBubbles.length: ", userBubbles.length);*/


    if (arrayResults.length != userBubbles.length) {
        console.log("Error: number of results and number of bubbles don't match");
        return;
    }

    for (let i = 0; i < arrayResults.length; i++) {
        const textSection = $(userBubbles[i]).find('.text');
        const result = arrayResults[i];
        colorWords(textSection, result.Words);
    }
}

async function createBubbles(user, bot) {

    const exercise = getCurrentExercise();
    const { context, characterName, characterDescription, image } = exercise;

    const chatContainer = $('.js-chat-container');

    for (let index = 0; index < bot.length; index++) {

        const firstDialog = bot[index];

        const botBubble = $('#js-bot-sample');
        botBubble.find('.js-d-name').text(characterName);
        botBubble.find('.js-d-text').text(firstDialog);
        botBubble.find('.js-c-char').attr("src", image);

        const bubble = addBotBubble(firstDialog);

        chatContainer.append(bubble);

        //User Bubble
        if (index < (bot.length - 1)) {

            var userBubble = $('#js-user-sample').clone();

            userBubble.removeAttr('id');
            userBubble.removeClass('hide');
            chatContainer.append(userBubble);
            scrollDown(chatContainer);

            userBubble.find('.js-d-text').text(user);
            userBubble.addClass("displayed-bubble");
        }

    }

    return 0;

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

function scrollDown(chatPanel) {
    chatPanel.scrollTop(chatPanel[0].scrollHeight);
}

function createInfoWindow() {
    const infoWindow = jQuery('<div>', {
        id: 'info-window',
        class: 'card px-3 py-3 g-0',
        style: 'position: absolute; z-index: 9; border: 2px #FFC300 solid; height:fit-content; display: none',
    })

    $('body').append(infoWindow);

}

function definColor(score) {
    if (score > 90) {
        return "#4AF000";
    } else if (score > 80) {
        return "#FFC300";
    }
    else {
        return "#FF0000";
    }
}

function onWordHover(span, infoWindow) {
    var thisSpan = $(span);
    const htmlInfoWindowContent = thisSpan.attr('bubbleContent');
    thisSpan.css("background-color", "#E0E0E0");
    var position = thisSpan.offset();
    infoWindow.html(htmlInfoWindowContent);
    position.top -= (infoWindow.outerHeight() + thisSpan.innerHeight());
    infoWindow.css(position);
    infoWindow.show();
}

function colorWords(wordsDiv, words) {
    var infoWindow = $('#info-window');

    if (!infoWindow.length) {
        createInfoWindow();
        infoWindow = $('#info-window');
    }

    var finalObject = jQuery('<div>', {})

    words.forEach(word => {

        var score = word['PronunciationAssessment']["AccuracyScore"];
        var wordString = word['Word'];
        var color = definColor(score);

        const phonemeArray = [];
        word["Phonemes"].forEach(phoneme => {
            phonemeArray.push(phoneme["Phoneme"] + ": " + phoneme['PronunciationAssessment']["AccuracyScore"]);

        });

        const stringPhonemeScore = phonemeArray.join(' ');


        var newSpan = jQuery('<span>', {
            style: `color: ${color}; cursor: pointer; border-radius: 3px;`,
            html: wordString + ' '
        })

        newSpan.attr('json-as-string', JSON.stringify(word));

        finalObject.append(newSpan);

        /*const bubbleContent = `<div>Score: ${score}</div> <div>${stringPhonemeScore}</div>`;

        newSpan.attr('bubbleContent', bubbleContent);*/


        newSpan.hover(
            function () {
                //onWordHover(this, infoWindow);
            }, function () {
                $(this).css("background-color", "transparent");
                infoWindow.hide()

            })

        newSpan.click(function () {
            const wordJson = JSON.parse($(this).attr('json-as-string'));
            setUpDetailSection($(this), wordJson);
        })
    });
    wordsDiv.html(finalObject);
}

function setUpDetailSection(spanElement, word) {

    $('.left-description').removeClass('hide');

    const panel = $('#word-detail');

    const wordField = panel.find('.selected-word');

    const scoreField = panel.find('.selected-word-score');

    wordField.html(word['Word']);
    scoreField.html(`${word['PronunciationAssessment']['AccuracyScore']}%`);

    const phonemesInfo = panel.find('.phonemes-info');

    setUpPhonemeDiv(phonemesInfo, word);

}

function setUpPhonemeDiv(phonemesInfo, word) {
    phonemesInfo.html("");
    for (var index in word['Phonemes']) {
        const phoneme = word['Phonemes'][index];
        const html = `
        <div class="text-center d-flex flex-column" style="margin-right: 3px; width:fit-content;">
            
            <div class="small-square bahnschriftBold" style="font-size: 3vw;">
                ${phoneme['PronunciationAssessment']['AccuracyScore']}
            </div>
            <div class="bahnschriftRegular" style="font-size: 3vw;">
                ${phoneme['Phoneme']}
            </div>
        </div>
        `
        phonemesInfo.append(html);
    }
}

function getPartialResults(results, key) {
    const partialResults = results['results']['0'];
    console.log(partialResults);

    return sessionResultsSummary(partialResults);
}

function sessionResultsSummary(resultsArray) {

    let wordSummary = {};
    let phonemeSummary = {};
    let scoreSummary = [];
    let fluencySummary = [];
    let accSummary = [];
    let completeSummary = [];

    let wordDistribution = baseDistribution();
    let phonemeDistribution = baseDistribution();

    //resultsArray.forEach((element) => console.log(element));
    //let data = resultsArray[0][0];
    for (let index = 0; index < resultsArray.length; index++) {

        const data = resultsArray[index];
        console.log(data);

        fluencySummary.push(data['PronunciationAssessment']['FluencyScore']);
        scoreSummary.push(data['PronunciationAssessment']['PronScore']);
        accSummary.push(data['PronunciationAssessment']['AccuracyScore']);
        completeSummary.push(data['PronunciationAssessment']['CompletenessScore']);

        data['Words'].forEach(function (wordArray) {
            let word = wordArray['Word'];
            let accuracy = wordArray['PronunciationAssessment']['AccuracyScore'];

            wordDistribution = changeDistribution(wordDistribution, accuracy);

            if (!wordSummary[word]) {
                wordSummary[word] = [accuracy];
            } else {
                wordSummary[word].push(accuracy);
            }

            wordArray['Phonemes'].forEach(function (phonemeArray) {
                let phoneme = phonemeArray['Phoneme'];
                let accuracy = phonemeArray['PronunciationAssessment']['AccuracyScore'];

                phonemeDistribution = changeDistribution(phonemeDistribution, accuracy);

                if (!phonemeSummary[phoneme]) {
                    phonemeSummary[phoneme] = [accuracy];
                } else {
                    phonemeSummary[phoneme].push(accuracy);
                }
            });
        });

    }

    /*resultsArray.forEach(function (data) {
        console.log(data[0]);
        
        fluencySummary.push(data['PronunciationAssessment']['FluencyScore']);
        scoreSummary.push(data['PronunciationAssessment']['PronScore']);
        accSummary.push(data['PronunciationAssessment']['AccuracyScore']);
        completeSummary.push(data['PronunciationAssessment']['CompletenessScore']);

        data['Words'].forEach(function (wordArray) {
            let word = wordArray['Word'];
            let accuracy = wordArray['PronunciationAssessment']['AccuracyScore'];

            wordDistribution = changeDistribution(wordDistribution, accuracy);

            if (!wordSummary[word]) {
                wordSummary[word] = [accuracy];
            } else {
                wordSummary[word].push(accuracy);
            }

            wordArray['Phonemes'].forEach(function (phonemeArray) {
                let phoneme = phonemeArray['Phoneme'];
                let accuracy = phonemeArray['PronunciationAssessment']['AccuracyScore'];

                phonemeDistribution = changeDistribution(phonemeDistribution, accuracy);

                if (!phonemeSummary[phoneme]) {
                    phonemeSummary[phoneme] = [accuracy];
                } else {
                    phonemeSummary[phoneme].push(accuracy);
                }
            });
        });
    });*/

    let averageSummary = {
        'words': reduceArraysToAverage(wordSummary),
        'phonemes': reduceArraysToAverage(phonemeSummary),
        'finalScores': {
            'pronScore': arrayAverage(scoreSummary),
            'attemptsNumber': resultsArray.length,
            'fluencyScore': arrayAverage(fluencySummary),
            'accuracyScore': arrayAverage(accSummary),
            'completenessScore': arrayAverage(completeSummary)
        },
        'distributions': {
            'words': wordDistribution,
            'phonemes': phonemeDistribution
        }
    };

    return averageSummary;
}

function baseDistribution() {
    return {
        "complete": 0,
        "incomplete": 0,
        "null": 0
    };
}

function changeDistribution(distribution, value) {
    if (value > 94) {
        distribution["complete"] = distribution["complete"] + 1;
    }
    else if (value > 30) {
        distribution["incomplete"] += 1;
    }
    else {
        distribution["null"] += 1;
    }
    return distribution;
}

function reduceArraysToAverage(bigArray) {
    let newBigArray = {};

    Object.keys(bigArray).forEach(function (key) {
        let smallArray = bigArray[key];
        newBigArray[key] = arrayAverage(smallArray);
    });

    return newBigArray;
}

function arrayAverage(array) {
    if (array.length == 0) {
        return 0;
    }

    let sum = array.reduce(function (accumulator, currentValue) {
        return accumulator + currentValue;
    }, 0);

    return sum / array.length;
}


$(document).ready(async function () {

    var value = JSON.parse(localStorage.getItem('resultsManager'));

    const select = document.getElementById("order-selector");

    //agregar opciones a select segun la cantidad de frases
    console.log(value['results']['0'].length);

    for (let index = 0; index < value['results']['0'].length; index++) {
 
     const option = document.createElement('option');
     option.value = index;
     option.text = "sobre la frase " +(index+1);
     option.classList.add("bahnschriftRegular");
     option.style.fontSize = "1.5vw";
     
     select.appendChild(option);
     
    }

    renderResults(value, 0);


    $(".overall-results-selector").change(function () {
        if (this.value != "todas") {
            const data = extractValuesArrayByKey(value, this.value);
            initMixedWidget10b(data);
        }
        else {
            console.log(dataTotal);
            initMixedWidget10b(dataTotal);
        }

    });
    
});




