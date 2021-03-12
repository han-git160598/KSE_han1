var socket = io('http://192.168.100.16:3001/');
socket.on('coordinates_real',function (params) {
    console.log(params);
});