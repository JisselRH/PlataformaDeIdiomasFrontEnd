const ans1 = `{"Confidence":0.8680299,"Lexical":"i'm not feeling very fine","ITN":"i'm not feeling very fine","MaskedITN":"i'm not feeling very fine","Display":"I'm not feeling very fine.","AccuracyScore":85,"FluencyScore":100,"CompletenessScore":100,"PronScore":91,"Words":[{"Word":"i'm","Offset":11300000,"Duration":2900000,"Confidence":0,"AccuracyScore":80,"ErrorType":"None","Syllables":[{"Syllable":"aɪm","Offset":11300000,"Duration":2900000,"AccuracyScore":80}],"Phonemes":[{"Phoneme":"aɪ","Offset":11300000,"Duration":2100000,"AccuracyScore":79},{"Phoneme":"m","Offset":13500000,"Duration":700000,"AccuracyScore":82}]},{"Word":"not","Offset":14300000,"Duration":2100000,"Confidence":0,"AccuracyScore":79,"ErrorType":"None","Syllables":[{"Syllable":"nɑt","Offset":14300000,"Duration":2100000,"AccuracyScore":79}],"Phonemes":[{"Phoneme":"n","Offset":14300000,"Duration":500000,"AccuracyScore":100},{"Phoneme":"ɑ","Offset":14900000,"Duration":400000,"AccuracyScore":100},{"Phoneme":"t","Offset":15400000,"Duration":1000000,"AccuracyScore":58}]},{"Word":"feeling","Offset":16500000,"Duration":2900000,"Confidence":0,"AccuracyScore":86,"ErrorType":"None","Syllables":[{"Syllable":"fi","Offset":16500000,"Duration":1300000,"AccuracyScore":100},{"Syllable":"lɪŋ","Offset":17900000,"Duration":1500000,"AccuracyScore":73}],"Phonemes":[{"Phoneme":"f","Offset":16500000,"Duration":700000,"AccuracyScore":100},{"Phoneme":"i","Offset":17300000,"Duration":500000,"AccuracyScore":100},{"Phoneme":"l","Offset":17900000,"Duration":300000,"AccuracyScore":100},{"Phoneme":"ɪ","Offset":18300000,"Duration":500000,"AccuracyScore":100},{"Phoneme":"ŋ","Offset":18900000,"Duration":500000,"AccuracyScore":29}]},{"Word":"very","Offset":19500000,"Duration":2300000,"Confidence":0,"AccuracyScore":88,"ErrorType":"None","Syllables":[{"Syllable":"vɛ","Offset":19500000,"Duration":900000,"AccuracyScore":74},{"Syllable":"ri","Offset":20500000,"Duration":1300000,"AccuracyScore":98}],"Phonemes":[{"Phoneme":"v","Offset":19500000,"Duration":400000,"AccuracyScore":48},{"Phoneme":"ɛ","Offset":20000000,"Duration":400000,"AccuracyScore":100},{"Phoneme":"r","Offset":20500000,"Duration":500000,"AccuracyScore":100},{"Phoneme":"i","Offset":21100000,"Duration":700000,"AccuracyScore":96}]},{"Word":"fine","Offset":21900000,"Duration":6100000,"Confidence":0,"AccuracyScore":93,"ErrorType":"None","Syllables":[{"Syllable":"faɪn","Offset":21900000,"Duration":6100000,"AccuracyScore":93}],"Phonemes":[{"Phoneme":"f","Offset":21900000,"Duration":1300000,"AccuracyScore":84},{"Phoneme":"aɪ","Offset":23300000,"Duration":700000,"AccuracyScore":74},{"Phoneme":"n","Offset":24100000,"Duration":3900000,"AccuracyScore":100}]}]}`;
// const ans2 = 


class ResultsManager {
  constructor(length) {
    this.results = createResultsObject(length);
  }

  append(key, value) {
    this.results[key].push(value);
  }

  getAttempts(key) {
    return this.results[key].length;
  }

  getPartialResults(key) {
    console.log("get PARTIAL  Results");
    const partialResults = this.results[key];
    return sessionResultsSummary(partialResults);
  }

  getResultsArray(key) {
    return this.results[key];
  }

  getAllResultsSummary() {
    console.log("get ALL Results");
    const allResults = groupDataResults(this.results);
    return sessionResultsSummary(allResults);
  }
}
  
function createResultsObject(length) {
    var resultsArray = {}
    console.log(JSON.parse(ans1));
    for(var i = 0; i < length; i++) {
      // JSON.parse(ans1)
        resultsArray[i] = [];
    }

    return resultsArray;
}


export {
    ResultsManager,
}


function arrayAverage(array) {
  if (array.length == 0){
      return 0;
  }

  let sum = array.reduce(function (accumulator, currentValue) {
      return accumulator + currentValue;
  }, 0);

  return sum / array.length;
}


function groupDataResults(resultsData) {
  let allSessionsResults = [];

  Object.keys(resultsData).forEach(function(key) {
      const resultsArray = resultsData[key];
      allSessionsResults = allSessionsResults.concat(resultsArray);
  });
  return allSessionsResults;
}

function reduceArraysToAverage(bigArray) {
  let newBigArray = {};

  Object.keys(bigArray).forEach(function(key) {
      let smallArray = bigArray[key];
      newBigArray[key] = arrayAverage(smallArray);
  });

  return newBigArray;
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

function sessionResultsSummary(resultsArray) {
  console.log(resultsArray);

  let wordSummary = {};
  let phonemeSummary = {};
  let scoreSummary = [];
  let fluencySummary = [];
  let accSummary = [];
  let completeSummary = [];


  let wordDistribution = baseDistribution();
  let phonemeDistribution = baseDistribution();

  resultsArray.forEach(function(data) {
      console.log("data", data)
      fluencySummary.push(data['FluencyScore']);
      scoreSummary.push(data['PronScore']);
      accSummary.push(data['AccuracyScore']);
      completeSummary.push(data['CompletenessScore']);

      data['Words'].forEach(function(wordArray) {
          let word = wordArray['Word'];
          let accuracy = wordArray['AccuracyScore'];

          wordDistribution = changeDistribution(wordDistribution, accuracy);

          if (!wordSummary[word]) {
              wordSummary[word] = [accuracy];
          } else {
              wordSummary[word].push(accuracy);
          }

          wordArray['Phonemes'].forEach(function(phonemeArray) {
              let phoneme = phonemeArray['Phoneme'];
              let accuracy = phonemeArray['AccuracyScore'];

              phonemeDistribution = changeDistribution(phonemeDistribution, accuracy);

              if (!phonemeSummary[phoneme]) {
                  phonemeSummary[phoneme] = [accuracy];
              } else {
                  phonemeSummary[phoneme].push(accuracy);
              }
          });
      });
  });

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
