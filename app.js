var http = require('http');
var app = http.createServer();
app.listen(8000);

var io=require ('socket.io').listen(app);
var mysql =require('mysql');

var connectionsArray = [];
var POLLING_INTERVAL = 3000;

connection = mysql.createConnection({
    host: 'localhost',
    user: 'ozgeyazi_gls',
    password: 'Gold1905',
    database:'ozgeyazi_Getlondonservices'
   
});

    connection.connect();
    var pollingLoop = function(){
        var query = connection.query('select * from messages where is_read = 0 order by date desc');
        messages = [];
        query
        .on('error', function(err) {
          console.log(err);
          updateSockets(err);
        })
        .on('result', function(message) {
          messages.push(message);
        }).   
        on('end', function() {
            if(connectionsArray.length){
                pollingTimer = setTimeout(pollingLoop,POLLING_INTERVAL);
                updateSockets({messages});
            }
        });
    }
    
    io.sockets.on('connection', function(socket) {
        console.log('New socket');
          if (!connectionsArray.length) {
             pollingLoop();
          }
        
          socket.on('disconnect', function() {
            console.log('Socket Disconnected');
            var socketIndex = connectionsArray.indexOf(socket);
              connectionsArray.splice(socketIndex, 1);           
          });
          connectionsArray.push(socket);
    });
    
    var updateSockets = function(data) {
        connectionsArray.forEach(function(tmpSocket) {
        tmpSocket.volatile.emit('message', data);
        });
    };