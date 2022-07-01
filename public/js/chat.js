$(document).ready(function () {
    var conn = new WebSocket('ws://localhost:8081');
    var chatform= $('.chatform'), messaageInputForm= chatform.find("#message"),
    messageList= $('#messages-list');

    chatform.on("submit", function (e) {
        e.preventDefault();
        var message= messaageInputForm.val();
        conn.send(message);
        messageList.prepend('<li>'+message+'</li>');
    });

    conn.onopen = function (e) {
        console.log('connection stablished');
    }

    conn.onmessage = function (e) {
        console.log(e.data);
        messageList.prepend('<li>'+e.data+'</li>');
    };
});