var websocketPort = wsPort ? wsPort : 8080,
    conn = new WebSocket('ws://localhost:' + websocketPort),
    idMessages = 'ChatMessages', name = Name;

conn.onopen = function () {
    console.log('Connect established!');
};
conn.onerror = function () {
    console.log('Connect fail!');
};

(($) => {
    $(() => {

$('#sendMessage').on('click', () => {
    var $newMessage = $('#newMessage').val();
    if ($newMessage) {
        conn.send(`${name}: ${$newMessage}`);
        $('#newMessage').val('');
    }


});

/*conn.onmessage = function (e) {
    document.getElementById(idMessages).value = e.data + '\n' + document.getElementById(idMessages).value;
    console.log(e.data);
    var $el = $('li.messages-menu ul.menu li:first').clone();
    $el.find('p').text(e.data);
    $el.find('h4').text('websocket message');
    $el.prependTo('li.messages-menu ul.menu');

    var cnt = $('li.messages-menu ul.menu li').length;
    $('li.messages-menu span.label-success').text(cnt);
    $('li.messages-menu li.header').text('You have ' + cnt + ' messages');
};*/

/**
 * Receives message and places it into DOM-elements
 * @param e
 */
conn.onmessage = (e) => {
    const data = e.data.split(/:/);
    const message = data[1];
    const senderName = data[0];

    const chat = new ChatBox( senderName, message);
    chat.addMessageToBox();
    chat.addMessageToDropdownBox();
};

/**
 * Class for creating message containers
 */
class ChatBox {
    constructor( senderName, message) {

        this.senderName = senderName;
        this.message = message;

    }

    /**
     * Adds received message to all messages container
     */
    addMessageToBox() {

        var text = $('#ChatMessages').text();
        $('#ChatMessages').text(`User ${this.senderName}:  ${this.message}`+ '\n' + text)   ;

    }

    /**
     * Adds received message to dropdown container
     */
    addMessageToDropdownBox() {

            const $li = $('<li />');
            const $a = $('<a />', {href: '#'});
            const $div = $('<div />', {class: 'pull-left'});
            const $img = $('<img />', {
                src: `/assets/f92dcf79/img/avatar.png`,
                class: 'img-circle',
                alt: 'User Image',
            });
            $div.append($img);
            const $h4 = $('<h4 />').text(`nickname: ${this.senderName}`);
            const $small = $('<small />');
            const $i = $('<i />', {class: 'fa fa-clock-o'});
            $small.append($i).append(new Date().toLocaleString('ru', {
                day: 'numeric',
                month: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
            }));
            $h4.append($small);
            const $p = $('<p />', {class: 'messageText'}).text(this.message);
            $a.append($div).append($h4).append($p);
            $li.append($a);
            $('ul.menu').prepend($li);

            const cnt = $('li.messages-menu ul.menu li').length;
            $('li.messages-menu span.label-success').text(cnt);
            $('li.messages-menu li.header').text(`You have ${cnt} messages`);

    }
}
});
})(jQuery);



