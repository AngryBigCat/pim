var ws = new WebSocket("ws://111.230.26.237:9501");

// jssdk设计
// todo



// pim 客户端Api
/* 
pim.conn({
  key: 'qwqeqasdasdasd',
  host: '111.230.26.237',
});

// 使用json格式head + body模式，作为数据传输协议
pim.send({
  head: {
    
  },
  body: {

  },
})
 */


// 原型实现
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

  document.title = 'socket已链接';
};

ws.onmessage = function(evt) {
  console.log( "Received Message: " + evt.data);


  document.body.append('<div>'+ evt.data +'</div>')
  // ws.close();
};

ws.onclose = function(evt) {
  console.log("Connection closed.");
  document.title = 'socket关闭';
};


var btn = document.getElementById('submit');

btn.onclick = function () {
  var input = document.getElementById('input');

  ws.send(input.value);
}