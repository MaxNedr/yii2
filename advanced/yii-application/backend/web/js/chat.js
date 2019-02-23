var websocketPort = wsPort ? wsPort : 8080,
    conn = new WebSocket('ws://localhost:' + websocketPort),
    idMessages = 'ChatMessages';

conn.onopen = function () {
    console.log('Connect established!');
};
conn.onerror = function () {
    console.log('Connect fail!');
};
conn.onmessage = function (e) {
    document.getElementById(idMessages).value = e.data + '\n' + document.getElementById(idMessages).value;
    console.log(e.data);
    var $el = $('li.messages-menu ul.menu li:first').clone();
    $el.find('p').text(e.data);
    $el.find('h4').text('Websocket user');
    $el.prependTo('li.messages-menu ul.menu');

    var cnt = $('li.messages-menu ul.menu li').length;
    $('li.messages-menu span.label-success').text(cnt);
    $('li.messages-menu li.header').text('You have ' + cnt + ' messages');
};



