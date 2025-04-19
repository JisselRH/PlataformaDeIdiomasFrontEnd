var base64_characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
var base64_charactersArray = base64_characters.split("");

var base64_charactersRandom = "uxlD6KUVWd=be3wHvCcPZTaIM+rqzOhm8A/BSXLpFi7NoJs2fG5tQnjkYgE01R49y";
var base64_charactersRandomArray = base64_charactersRandom.split("");
var ArrayFinal

function encodeWord(x){
    var palabraArray = btoa(x).split("");
    for (let i = 0; i < palabraArray.length; i++) {
        for (let j = 0; j < base64_charactersArray.length; j++) {
            if (palabraArray[i] == base64_charactersRandomArray[j]) {
                salida += base64_charactersArray[j];
            }
        }
    }
    var salidax="";
    var salida = ""
    for (let i = 0; i < palabraArray.length; i++) {
        for (let j = 0; j < base64_charactersArray.length; j++) {
            if(palabraArray[i] == base64_charactersArray[j]){
                salida += base64_charactersRandomArray[j];
            }
        }
    }
    salida = salida.match(/.{1,4}/g);
    for (let i = 0; i < salida.length; i++) {
        if(i < salida.length -1){
            salidax += salida[i] + "-";
        }else{
             salidax += salida[i];
        }
    }
    return salidax;
}

function decodeWord(x) {
    var palabraArray = x.split("-");
    var palabrajuntada = "";
    for (let i = 0; i < palabraArray.length; i++) {
            palabrajuntada += palabraArray[i];
    }
    palabraseparada = palabrajuntada.split("");
    var salida = "";
    for (let i = 0; i < palabraseparada.length; i++) {
        for (let j = 0; j < base64_charactersArray.length; j++) {
            if (palabraseparada[i] == base64_charactersRandomArray[j]) {
                salida += base64_charactersArray[j];
            }
        }
    }
    salida = atob(salida);
    return salida;
}
