var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

server.listen(5656);

io.on('connection', function (socket) {

  var redisClient = redis.createClient();

  redisClient.subscribe('nasabah_transaksi');

  redisClient.on('message', function(channel, message) {
    socket.emit(channel, message);
    console.log(channel);
    //console.log(message);
  });

  socket.on('disconnect', function() {
    redisClient.quit();
  });

  console.log('Running http://localhost:5656/');

});