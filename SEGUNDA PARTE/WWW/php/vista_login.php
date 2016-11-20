<?php
session_unset();
session_start();
print_r(session_id());
print_r("\n");
print_r($_SESSION["id_usuario_logueado"]);
print_r("\n");
print_r($_SESSION["email"]);
//unset($_SESSION["datos"]);
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

  </head>
  <body onload="base_url()">
    <?php
    if(isset($_SESSION["resp"]))
    {
      ?>
      <div class="alert alert-success">
        <?php print_r($_SESSION["resp"]); ?>
      </div>
      <?php
    }
    ?>
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
        <div>
          <a href="vista_registrar_usuario.php">Registrarse</a>
        </div>
      </form>
    </div>
    <?php
  //unset($_SESSION["datos"]);
  unset($_SESSION["resp"]);
     ?>
  </body>
</html>
