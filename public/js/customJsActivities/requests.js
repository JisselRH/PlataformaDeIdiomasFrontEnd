//const localUrl = 'http://api.plataformaidiomas.edutecno.com';
//const localUrl = 'https://0af7-45-182-141-188.ngrok-free.app/';

var iduser = localStorage.getItem('iduser');

const localUrl = 'https://idiomas.edutecno.cl/api';

async function getWords(context) {
    var res = null;

    await axios.post(
        'https://idiomas.edutecno.cl/api/exercise/gen-words',
        { context, iduser }
    ).then((response) => {
        res = response.data.words.slice(0, 20);

    }).catch(function (error) {
        if (error.response) {
            // The request was made and the server responded with a status code
            // that falls out of the range of 2xx
            console.log(error.response.data);
            //res = error.response.status;
            res = '408';//El servidor se agotó esperando el resto de la petición del navegador
            console.log(error.response.headers);
        } else if (error.request) {
            // The request was made but no response was received
            // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
            // http.ClientRequest in node.js
            res = '503';//El servidor no está disponible para manejar esta solicitud en este momento
            console.log(error.request);
        } else {
            // Something happened in setting up the request that triggered an Error
            res = '400';//Mala petición
            console.log('Error', error.message);
        }
        console.log(error.config);
    });
    console.log(res);
    return res;
}

async function getCharacter(context, words) {
    var res = null;

    await axios.post(
        'https://idiomas.edutecno.cl/api/exercise/gen-character',
        { context, words, iduser }
    )
        .then((response) => {
            res = response.data;
            console.log(response.data);
        })
        .catch(function (error) {
            if (error.response) {
                console.log(error.response.data);
                //res = error.response.status;
                res = '408';//El servidor se agotó esperando el resto de la petición del navegador
                console.log(error.response.headers);
            } else if (error.request) {
                res = '503';//El servidor no está disponible para manejar esta solicitud en este momen0
                console.log(error.request);
            } else {
                // Something happened in setting up the request that triggered an Error
                res = '400';//Mala petición
                console.log('Error', error.message);
            }
            console.log(error.config);
        });
    return res;
}

async function genPhrases(context, words) {

    var res = null;

    await axios.post(
        'https://idiomas.edutecno.cl/api/exercise/gen-phrases',
        { context, words, iduser }
    )
        .then((response) => {
            const { phrases } = response.data;
            res = phrases;
            console.log(response.data);
        })
        .catch(function (error) {
            if (error.response) {
                console.log(error.response.data);
                //res = error.response.status;
                res = '408';//El servidor se agotó esperando el resto de la petición del navegador
                console.log(error.response.headers);
            } else if (error.request) {
                res = '503';//El servidor no está disponible para manejar esta solicitud en este momen0
                console.log(error.request);
            } else {
                // Something happened in setting up the request that triggered an Error
                res = '400';//Mala petición
                console.log('Error', error.message);
            }
            console.log(error.config);
        });
    return res
}

async function getToken() {
    const speechToken = Cookies.get('speech-token');
    //const speechToken = null;
    /*var objeto = [];

    objeto = {
        token: "eyJhbGciOiJFUzI1NiIsImtpZCI6ImtleTEiLCJ0eXAiOiJKV1QifQ.eyJyZWdpb24iOiJlYXN0dXMiLCJzdWJzY3JpcHRpb24taWQiOiIyZDFjNmRhZTQzMzE0YTMxOTY2OTFmMzkxMjU4NzAyYSIsInByb2R1Y3QtaWQiOiJTcGVlY2hTZXJ2aWNlcy5GMCIsImNvZ25pdGl2ZS1zZXJ2aWNlcy1lbmRwb2ludCI6Imh0dHBzOi8vYXBpLmNvZ25pdGl2ZS5taWNyb3NvZnQuY29tL2ludGVybmFsL3YxLjAvIiwiYXp1cmUtcmVzb3VyY2UtaWQiOiIvc3Vic2NyaXB0aW9ucy8zODA2NTBhNC0zMWRmLTRlZjItODE1My1lZjA3MDUxOTE1ZTAvcmVzb3VyY2VHcm91cHMvUGxhdGFmb3JtYUlkaW9tYS9wcm92aWRlcnMvTWljcm9zb2Z0LkNvZ25pdGl2ZVNlcnZpY2VzL2FjY291bnRzL1NTLUlkaW9tYSIsInNjb3BlIjoic3BlZWNoc2VydmljZXMiLCJhdWQiOiJ1cm46bXMuc3BlZWNoc2VydmljZXMuZWFzdHVzIiwiZXhwIjoxNjk0NDY2OTY2LCJpc3MiOiJ1cm46bXMuY29nbml0aXZlc2VydmljZXMifQ.j2YBoOvrR3QmZSxlHkFztz-Y6Qv5wQDAI1zKyBz1OlXjw1nzGxyXkw-AEhzov7_019btdaZsrrm5a2Yl8h8iFg",
        region: "eastus"
    };
    const speechToken = objeto;*/

    if (speechToken) {
        console.log("Token fetched from cookie");
        console.log(speechToken);
        //return speechToken;
        return JSON.parse(speechToken);
    } else {

        var res = null;

        const nodeUrl = 'https://idiomas.edutecno.cl/api';

        await axios.get(`${nodeUrl}/token/get-speech-token`)
            .then((response) => {

                const tokenInfo = response.data;

                const expirationDate = new Date();
                expirationDate.setTime(expirationDate.getTime() + (540 * 1000));
                Cookies.set('speech-token', JSON.stringify(tokenInfo), { expires: expirationDate, path: '/' })
                res = tokenInfo;
            })
            .catch(function (error) {
                if (error.response) {
                    console.log(error.response.data);
                    //res = error.response.status;
                    res = '408';//El servidor se agotó esperando el resto de la petición del navegador
                    console.log(error.response.headers);
                } else if (error.request) {
                    res = '503';//El servidor no está disponible para manejar esta solicitud en este momen0
                    console.log(error.request);
                } else {
                    // Something happened in setting up the request that triggered an Error
                    res = '400';//Mala petición
                    console.log('Error', error.message);
                }
                console.log(error.config);
            });
        return res

    }
}

async function getConversationContext(context) {
    const url = `${localUrl}/dialog/context/${context}`;
    const res = await axios.get(url);
    console.log(res);
    return res.data;
}

async function dialogRequest(conversationManager) {
    // const url = `${localUrl}/speech/dialog`;
    console.log("IN DIALOG REQ");

    var res = null;
    const url = `${localUrl}/dialog/dialog`;

    const messages = conversationManager.buildMessages();
    console.log(messages);
    var formData = {
        'messages': messages,
        'context': conversationManager.context,
        'system': conversationManager.system,
        'order': 'aiFirst',
    }

    console.log(formData);

    await axios.post(url, formData)
        .then((response) => {
            res = response.data;
        })
        .catch(function (error) {
            if (error.response) {
                console.log(error.response.data);
                //res = error.response.status;
                res = '408';//El servidor se agotó esperando el resto de la petición del navegador
                console.log(error.response.headers);
            } else if (error.request) {
                res = '503';//El servidor no está disponible para manejar esta solicitud en este momen0
                console.log(error.request);
            } else {
                // Something happened in setting up the request that triggered an Error
                res = '400';//Mala petición
                console.log('Error', error.message);
            }
            console.log(error.config);
        });
    return res
}

async function getExercises() {
    const url = `${localUrl}/exercise`;
    const res = await axios.get(url);
    return res.data;
}

async function saveExercise(exercise) {
    const url = `${localUrl}/exercise/create`;
    const res = await axios.post(url, exercise);
    return res.data;
}

async function firstResponse(exercise) {

    var res = null;

    const url = `${localUrl}/dialog/first-response`;

    await axios.post(url, exercise)
        .then((response) => {

            res = response.data;
        })
        .catch(function (error) {
            if (error.response) {
                console.log(error.response.data);
                //res = error.response.status;
                res = '408';//El servidor se agotó esperando el resto de la petición del navegador
                console.log(error.response.headers);
            } else if (error.request) {
                res = '503';//El servidor no está disponible para manejar esta solicitud en este momen0
                console.log(error.request);
            } else {
                // Something happened in setting up the request that triggered an Error
                res = '400';//Mala petición
                console.log('Error', error.message);
            }
            console.log(error.config);
        });
    return res

}

export {
    getConversationContext,
    firstResponse,
    dialogRequest,
    saveExercise,
    getExercises,
    getCharacter,
    genPhrases,
    getWords,
    getToken,
}