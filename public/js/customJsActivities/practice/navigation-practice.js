import { getCurrentExercise } from '../exercise-cookie.js';
$(document).ready(function () {

    $('.btn-words').click(async function () {
        window.location.href = "/exercise/practice/words";
    });

    $('.btn-phrase').click(async function () {
        window.location.href = "/exercise/practice/phrases";
    });

    $('.btn-dialog').click(async function () {
        window.location.href = "/exercise/practice/dialog";
    });

});