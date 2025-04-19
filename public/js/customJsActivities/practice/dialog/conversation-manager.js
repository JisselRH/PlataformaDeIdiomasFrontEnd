function buildMessagesExtern(userArray, botArray) {
    var messagesArray = [];
    console.log("user", userArray);
    for (var i = 0; i < Math.max(userArray.length, botArray.length); i++) {
        if (botArray[i]) {
            messagesArray.push(botArray[i]);
        }
        if (userArray[i]) {
            messagesArray.push(userArray[i]);
        }
    }
    return messagesArray;

}


class ConversationManager {
    constructor(context) {
        this.botChat = [];
        this.userChat = [];
        this.system = "";
        this.context = context;
        this.neuralVoice = ""
    }

    addTwoResponses(userText, botText) {
        this.addUserSentence(userText);
        this.addBotSentence(botText);
    }

    addBotSentence(text) {
        this.botChat.push(text);
    }

    addUserSentence(text) {
        this.userChat.push(text);
    }

    parseConversation() {
        return {
            bot: this.botChat,
            user: this.userChat,
        }
    }
    addSystemParam(system) {
        this.system = system;
    }
    addVoice(neuralVoice) {
        this.neuralVoice = neuralVoice;
    }
    getVoice() {
        return this.neuralVoice;
    }
    buildMessages() {
        return buildMessagesExtern(this.userChat, this.botChat);
    }
}


export {
    ConversationManager,
}