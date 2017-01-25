<!doctype html>
<html>
  <head>
   <script src="http://localhost:6001/socket.io/socket.io.js"></script>
  </head>
  <body>
    TEST!
  </body>
  <script>
    var socket = io('http://localhost:6001');
    socket.on('connection', function (data) {
      console.log(data);
      });
    socket.on('2:App\\Events\\SomeEvent', function(message){
      console.log(message);
    });
    console.log(socket);
  </script>
</html>