import { getExercises } from "./requests.js";
// import { getCurrentExercise } from "./exercise-cookie.js";
//import { assignCurrentExercise } from "./exercise-cookie.js";

$(document).ready(async function () {

    var iduser = uuid.v4();

    localStorage.setItem('iduser', iduser);
    console.log('UUID v1:', iduser);

    /*console.log('1 UUID v1:', uuid.v1());
    console.log('2 UUID v4:', uuid.v4());*/

    let audio = new Audio();

    $('.dialog-btn').click(function () {
        window.location.href = "/dialog";
    });

    $('.pronunciation-btn').click(function () {
        window.location.href = "/pronunciation";
    });

    $('.exercise-btn').click(function () {
        this.classList.add('inactive');
        audioPlay();
    });

    function audioPlay() {
        const audio = new Audio("/sounds/computer-click.mp3");
        audio.play();
        audio.addEventListener("ended", () => {
            window.location.href = "/exercise/create";
        });
    }

    const items = document.querySelectorAll(".item-radio");

    $(".item-radio").click(function () {


        for (var i = 0; i < items.length; i++) {

            if (items[i] != this || items[i].classList.contains("active")) {

                items[i].style.backgroundColor = "#FFFFFF";
                items[i].classList.remove("justify-content-center");
                items[i].classList.remove("active");
                items[i].getElementsByTagName("svg")[0].style.color = "#EBE3E3";
                items[i].getElementsByTagName("svg")[0].style.filter = "brightness(100%)";
                items[i].getElementsByTagName("label")[0].setAttribute('class', 'bahnschriftBold text-black h1 display-6');

            } else {

                items[i].style.backgroundColor = "#000000";
                items[i].classList.add("justify-content-center");
                items[i].classList.add("active");
                items[i].getElementsByTagName("svg")[0].style.color = "#FFC300";
                items[i].getElementsByTagName("svg")[0].style.filter = "brightness(100%)";
                items[i].getElementsByTagName("label")[0].setAttribute('class', 'bahnschriftBold text-white h1 display-6');
            }
        }


    });

    /*const { exercises } = await getExercises();
    addExercises(exercises);
    console.log(exercises);*/

});

function addExercises(exercises) {
    /*const exerciseSample =  $('#js-exercise-sample');
    exerciseSample.remove();
    const exerciseList = $('#js-exercise-list');
    console.log(exercises)
    exercises.forEach(exercise => {
        const newExercise = exerciseSample.clone();
        newExercise.removeClass('hide');

        newExercise.removeAttr('id');
        newExercise.find('.js-exercise-name').text(exercise.characterName);
        exerciseList.append(newExercise);
        newExercise.find('').click(function(){

        });
    });*/

}