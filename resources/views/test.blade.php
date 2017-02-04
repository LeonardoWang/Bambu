<!doctype html>
<html>
  <head>
    <script src="/Flat-UI-master/dist/js/vendor/jquery.min.js"></script>
    <script src="http://localhost:6001/socket.io/socket.io.js"></script>
  
  </head>
  <body>
    <p id="dialog"></p>


  </body>
    <script>
    var socket = io('http://localhost:6001');
    socket.on('connection', function (data) {
      console.log(data);
      });
    socket.on('1:App\\Events\\NotifEvent', function(message){
      console.log(message);
      document.getElementById("dialog").append(message.user_id + message.message);
    });
    console.log(socket);
    

  </script>

</html>