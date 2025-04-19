function getExerciseCookie() {
    var cookie = Cookies.get('new-excercise');
    if (cookie) {
        return JSON.parse(cookie);
    }
    
    const json = {}
    Cookies.set('new-excercise', JSON.stringify(json), { expires: 7 })
    var cookie = Cookies.get('new-excercise');
    console.log(cookie);
    
    return cookie;
}

function assignCookieValue(key, value) {
    const cookie = getExerciseCookie();
    cookie[key] = value;
    Cookies.set('new-excercise', JSON.stringify(cookie), { expires: 7 })
}

function getCookieValue(key) {
    const cookie = getExerciseCookie();
    return cookie[key];
}

function resetCookie() {
    Cookies.set('new-excercise', JSON.stringify({}), { expires: 7 })
}

function printCookie() {
    const cookie = getExerciseCookie();
    console.log(cookie);
}



// 2 tipos de cookies:
// 1. Ejercicio actual
// 2. Ejercicios en creación

// function statusCookie() {
//     var cookie = Cookies.get('status-cookie');
//     if (cookie) {
//         return JSON.parse(cookie);
//     }
    
//     const json = {}
//     Cookies.set('status-cookie', JSON.stringify(json), { expires: 7 })
//     var cookie = Cookies.get('status-cookie');
//     console.log(cookie);
    
//     return cookie;
// }

function assignCurrentExercise(exercise) {
    const { context, words, characterName, characterDescription, image, saved } = exercise;

    const cleanExercise = {context, words, characterName, characterDescription, image, saved};

    if (!context || !words || !characterName || !characterDescription) {
        throw new Error('Exercise is not valid');
    } else {
        Cookies.set('current-excercise', JSON.stringify(cleanExercise), { expires: 7 })
    }
}


function getCurrentExercise() {
    const cookie = Cookies.get('current-excercise');
    if (cookie) {
        return JSON.parse(cookie);
    } else {
        return null;
    }
}


export {
    getExerciseCookie,
    assignCookieValue,
    printCookie,
    getCookieValue,
    assignCurrentExercise,
    getCurrentExercise,
    resetCookie
}