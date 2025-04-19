import {
    assignCookieValue,
    getCookieValue,
} from "./exercise-cookie.js";

$(document).ready(function () {
    console.log("Hereee");

    $('.btn-practice-words').click(function () {

        this.classList.remove('btn-play');
        this.classList.add('btn-play-disabled');

        audioPlay("practice/words");
        //window.location.href = "/exercise/practice/words";
    });

    $('.btn-practice-phrases').click(async function () {
        this.classList.remove('btn-play');
        this.classList.add('btn-play-disabled');
        //setTimeout(() => { window.location.href = "/exercise/practice/phrases";  }, 12000);

        audioPlay("practice/phrases");

    });

    $('.btn-practice-dialog').click(function () {
        this.classList.remove('btn-play');
        this.classList.add('btn-play-disabled');
        //window.location.href = "/exercise/practice/dialog";
        audioPlay("practice/dialog");

    });

    function showModalLoading() {
        console.log("showModal LOADING");

        $('#modal-fullscreen-xl').modal('show');
    }

    function audioPlay(path) {
        const audio = new Audio("/sounds/computer-click.mp3");
        audio.play();
        audio.addEventListener("ended", () => {

            showModalLoading();

            window.location.href = "/exercise/" + path;
        });
    }


    $('.btn-all-exercises').click(function () {
        this.classList.add('inactive');
        assignCookieValue('allexercises', true);
        //window.location.href = "/exercise/practice/words";
        audioPlay("practice/words");
    });

    const btnDialog = $('.btn-practice-dialog');
    const btnWords = $('.btn-practice-words');
    const btnPhrases = $('.btn-practice-phrases');

    if (getCookieValue('wordsready')) {

        btnWords.removeClass("btn-play");
        btnWords.addClass("btn-play-ready");

        btnDialog.removeClass("btn-play-disabled");
        btnDialog.addClass("btn-play");
    }

    if (getCookieValue('phrasesready')) {

        btnDialog.removeClass("btn-play-disabled");
        btnDialog.addClass("btn-play");

        btnPhrases.removeClass("btn-play");
        btnPhrases.addClass("btn-play-ready");
    }

});