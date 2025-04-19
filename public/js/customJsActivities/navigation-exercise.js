"use strict";

import {
    getCookieValue,
    assignCookieValue,
} from "./exercise-cookie.js";


$(document).ready(async function () {


    $('.btn-prev-exercise').click(function () {
        this.classList.add('inactive');
        audioPlay('menu');

        //window.location.href = "/exercise/menu";

    });

    

    $('.btn-send-word').click(function () {
        this.classList.add('inactive');

        assignCookieValue('wordsready', true);

        //si estamos en ejercitar todo
        if (getCookieValue('allexercises')) {
            audioPlay('practice/phrases');
            //window.location.href = "/exercise/practice/phrases";
        } else {
            audioPlay('menu');
            //window.location.href = "/exercise/menu";
        }

    });

    $('.btn-send-phrase').click(function () {

        /*for (var obj of head) {
            obj.classList.remove("position-relative");
            obj.classList.add("position-absolute");
        }*/

        assignCookieValue('phrasesready', true);

        if (getCookieValue('allexercises')) {
            //window.location.href = "/exercise/practice/dialog";
            audioPlay('practice/dialog');
        } else {
            audioPlay('menu');
            //window.location.href = "/exercise/menu";
        }
    });

    $('.btn-send-dialog').click(function () {
        this.classList.add('disabled');
        audioPlay('practice/dialogResults');
        
        //window.location.href = "/exercise/practice/dialogResults";
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
            //setTimeout(() => { window.location.href = "/exercise/" + path;  }, 1000);
        });
    }
    
});