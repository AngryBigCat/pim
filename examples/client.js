var ws = new WebSocket("wss://127.0.0.1");

switch (ws.readyState) {
    case WebSocket.CONNECTING:
        // do something
        break;
    case WebSocket.OPEN:
        // do something
        break;
    case WebSocket.CLOSING:
        // do something
        break;
    case WebSocket.CLOSED:
        // do something
        break;
    default:
        // this never happens
        break;
}

ws.onopen = function(evt) { 
  console.log("Connection open ..."); 
  ws.send("Hello WebSockets!");
};

ws.onmessage = function(evt) {
  console.log( "Received Message: " + evt.data);
  ws.close();
};

ws.onclose = function(evt) {
  console.log("Connection closed.");
};
