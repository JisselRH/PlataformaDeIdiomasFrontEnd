import {
    getExerciseCookie,
    assignCookieValue,
    printCookie,
    getCookieValue,
    assignCurrentExercise,
} from "./exercise-cookie.js";


import { getWords, getCharacter } from "./requests.js";

var errorRequest = null;

const audio = new Audio("/sounds/computer-click.mp3");

$(document).ready(function () {
    console.log("Navigation imported!!");

    console.log(errorRequest);

    const sequence = ['create', 'words', 'character'];

    const current = currentPathName();

    const onLoadFun = onLoadFunctions[current];
    if (onLoadFun) { onLoadFun(); }

    $('.btn-next').click(async function () {
        console.log('.btn-next current--> ', current);

        errorRequest = false;

        //desabilitar boton
        this.classList.add('inactive');

        $("#modal-body-fullscreen").addClass("modal-body-xl");

        const index = sequence.indexOf(current);
        const next = sequence[index + 1];

        audioPlay(next);

        const btnNextFun = btnNextFunctions[current];

        if (btnNextFun) {
            await btnNextFun();
            console.log("listo btnNextFun");
            goNextView(next);
        } else {
            console.log(" error btnNextFun");
        }
    });

    $('.btn-prev').click(function () {
        this.classList.add('inactive');
        const index = sequence.indexOf(current);
        const prev = sequence[index - 1];
        audioPlay(prev);
        setTimeout(() => { window.location.href = "/exercise/" + prev; }, 2000);
        //window.location.href = "/exercise/" + prev;
    });


    $('.btn-finish-create').click(async function () {
        console.log("FINISH CREATE");
        this.classList.add('inactive');
        audioPlay('menu');
        const newExercise = getExerciseCookie();

        assignCurrentExercise(newExercise);

        console.log(newExercise);

        setTimeout(() => { window.location.href = "/exercise/menu"; }, 2000);

        //window.location.href = "/exercise/menu";

    });

    const navs = document.querySelectorAll(".nav-tabs a");

    $('#myTab a').on('click', function (e) {

        this.querySelector('.btn').classList.add("active");

        navs.forEach(element => {
            if (this != element)
                element.querySelector('.btn').classList.remove("active")
        });

        e.preventDefault();
        $(this).tab('show');
    });

    function showModalLoading() {
        console.log("showModal LOADING");
        console.log(errorRequest);

        if (!errorRequest)
            $('#modal-fullscreen-xl').modal('show');
    }

    function goNextView(path){
        console.log("*** gonNextView *****");
        console.log(errorRequest);
        
        if (!errorRequest) {
            if (path == 'character')
                setTimeout(() => { window.location.href = "/exercise/" + path; }, 15000);
            else
                setTimeout(() => { window.location.href = "/exercise/" + path; }, 2000);
        }
    }

    function audioPlay(path) {

        audio.play();
        audio.addEventListener("ended", () => {

            showModalLoading();
            console.log("Audio Play");
            console.log(errorRequest);
            
            /*if (!errorRequest) {
                if (path == 'character')
                    setTimeout(() => { window.location.href = "/exercise/" + path; }, 15000);
                else
                    setTimeout(() => { window.location.href = "/exercise/" + path; }, 8000);
            }*/

        });
    }

});


function currentPathName() {
    const pathname = window.location.pathname;

    const parts = pathname.split('/');
    const current = parts[parts.length - 1];
    return current;
}


function showModalError(tipo) {
    console.log("showModal ERROR");
    $('#modal-fullscreen-xl').modal('hide');

    if (errorRequest) {
        if (tipo == 1) {
            $('#error').modal('show');
        } else {
            $('#error-conexion').modal('show');
        }
    }

}


const btnNextFunctions = {

    'create': async function () {
        console.log('btnNextFunctions create');
        const input = $('.context-input').val();
        assignCookieValue('context', input);

        const words = await getWords(input);

        console.log(words);

        if (words != 503 && words != 400 && words != 408) {
            assignCookieValue('words', words);
            printCookie();
        } else {
            errorRequest = true;
            console.log(errorRequest);
            if (words == 503) {
                //problemas de conexion
                console.log("Error request, sin respuesta del servidor");
                showModalError(2);
            } else {
                console.log("Error configuracion de la solicitud");
                showModalError(1);
            }
        }

    },
    'words': async function () {
        console.log('btnNextFunctions character');

        const words = getCookieValue('words');
        const context = getCookieValue('context');

        console.log('words ', words);
        console.log('context ', context);

        const character = await getCharacter(context, words);
        
        if (character != 503 && character != 400 && character != 408) {
            //assignCookieValue('character', character);
            assignCookieValue('characterName', character.name);
            assignCookieValue('characterDescription', character.description);
            assignCookieValue('image', character.image);
        } else {
            errorRequest = true;
            if (character == 503) {
                //problemas de conexion
                console.log("Error request, sin respuesta del servidor");
                showModalError(2);
            } else {
                console.log("Error configuracion de la solicitud");
                showModalError(1);
            }
        }


    }
}

const onLoadFunctions = {
    'create': function () {
        const context = getCookieValue('context');
        $('.context-input').val(context);
    },
    'words': function () {
        console.log('onLoadFunctions words ');
        printCookie();
        const words = getCookieValue('words');
        const wordsContainer = $('.word-container');
        words.forEach(word => {
            const div = $('<div class="one-word-container"><br><br><br></div>');
            div.text(word);
            wordsContainer.append(div);
        });
    },
    'character': function () {
        console.log('onLoadFunctions character');
        // const character = getCookieValue('character');
        const character = getExerciseCookie();
        $('.character-name').text(character.characterName);
        $('.character-description').text(character.characterDescription);

        const url = location.href + "/saveimage";

        const data = {
            name: character.characterName,
            url: character.image
        }

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            //dataType: "json",
            success: function (data) {

                //solo para pruebas
                assignCookieValue('image', '/filesimages/' + character.characterName.trim() + '.png');

                assignCookieValue('wordsready', false);
                assignCookieValue('phrasesready', false);
                assignCookieValue('allexercises', false);
            },
            error: function (e) {
                console.log("error--> ", e);
            }

        });

        /*assignCookieValue('wordsready', false);
        assignCookieValue('phrasesready', false);
        assignCookieValue('allexercises', false);*/

        const characterAux = getExerciseCookie();
        console.log(characterAux);

        $('.image-holder').attr("src", characterAux.image);

    }
}


