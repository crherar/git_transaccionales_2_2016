<!DOCTYPE html>
<html>
  <head>
    <link rel='stylesheet', href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
  <link rel='stylesheet', type='text/css', href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css'>
<link rel="stylesheet" type="text/css" href="../css/app.css">
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
  <body>
    <div class = "col-md-4 remove-float center-block  big-top-space">
      <form action='login.php', method='POST'>
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
