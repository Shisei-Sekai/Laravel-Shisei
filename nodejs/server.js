let app = require('express')();
let server = require('http').Server(app);
let io = require('socket.io')(server);
let redis = require('redis');


server.listen(9998);
io.on('connection',(socket)=>{

    console.log('Connected');
    
    let redisClient = redis.createClient();
    redisClient.subscribe('message');

    redisClient.on('message',(channel,data)=>{
        console.log(`New message added in queue ${channel} channel by ${JSON.parse(data).user}`);
        socket.emit(channel,data);
    });

    socket.on("disconnect",()=>{
        redisClient.quit();
    });
});