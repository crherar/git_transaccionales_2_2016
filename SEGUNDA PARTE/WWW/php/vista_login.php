<?php
session_start();
//$_SESSION["resp"] = "";
//var_dump($_SESSION["resp"]);
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel='stylesheet', href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet', type='text/css', href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css'>
    <link rel="stylesheet" type="text/css" href="../css/app.css">
    <script type="text/javascript"  src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">
function base_url()
{
  localStorage.setItem('base_url','http://200.14.84.235/~17957132/www_transaccionales_2_2016/');
}
</script>
<script type="text/javascript">
function WebSocketTest()
     {
        if ("WebSocket" in window)
        {
           alert("WebSocket is supported by your Browser!");

           // Let us open a web socket
           var ws = new WebSocket("ws://localhost:3000/");

           ws.onopen = function()
           {
             var msg = {
               cabecera:{
                 'formulario':'loginn',
                 'id_usuario_logueado':0,
                 'email':''
               },
               datos:{
                 'email':pad('matias@gmail.com',40),
                 'password': pad('123',10)
               }
             };
              // Web Socket is connected, send data using send()
              ws.send(msg);
              alert("Message is sent...");
           };

           ws.onmessage = function (evt)
           {
              var received_msg = evt.data;
              alert("Message is received...");
           };

           ws.onclose = function()
           {
              // websocket is closed.
              alert("Connection is closed...");
           };
        }

        else
        {
           // The browser doesn't support WebSocket
           alert("WebSocket NOT supported by your Browser!");
        }
     }
</script>
  </head>
  <body onload="base_url()">
    <?php
      if($_SESSION["resp"] == "02")
      {
      ?>
        <div class="alert alert-danger">
          Usuario o contraseña incorrecto
        </div>
     <?php
     $_SESSION["resp"] = "";
   } ?>
    <div class = "col-md-4 remove-float center-block  big-top-space">
      <form action='c_login.php', method='POST'>
        <div clas='form-group'>
          <label for="email">Email</label>
          <input class="form-control", type='text', required='true', name='email', placeholder='email',id='email'>
        </div>
        <div>
          <label for="password">Password</label>
          <input class="form-control" type='password', required='true', name='password', placeholder='password',id='password'>
        </div>
        <div class="top-space">
          <input class="btn btn-info" type="submit" name="name" value="Iniciar sesión">
        </div>
      </form>
    </div>
  </body>
</html>
