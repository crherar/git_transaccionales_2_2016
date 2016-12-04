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
<?php include '../base/header.php';?>

<script type="text/javascript">
function base_url()
{
  localStorage.setItem('base_url','http://200.14.84.235/~17957132/www_transaccionales_2_2016/');
}
</script>
  <body onload="base_url()">
    <?php
    if(isset($_SESSION["resp"]))
    {
      if($_SESSION["resp"] == "Usuario registrado correctamente, ahora puede iniciar sesión")
      {
      ?>
      <div class="alert alert-success">
        <?php print_r($_SESSION["resp"]); ?>
      </div>
      <?php
      }
      ?>
      <?php
      if($_SESSION["resp"] == "Usuario o contraseña incorrecto")
      {
       ?>
      <div class="alert alert-danger">
        <?php print_r($_SESSION["resp"]); ?>
      </div>
      <?php
      }
    }
    ?>
    <div class = "col-md-4 remove-float center-block  big-top-space">
      <form action='c_login.php', method='POST'>
        <div clas='form-group'>
          <label for="email">Email</label>
          <input maxlength="40" class="form-control", type='email', required='true', name='email', placeholder='email',id='email'>
        </div>
        <div>
          <label for="password">Password</label>
          <input maxlength="10" class="form-control" type='password', required='true', name='password', placeholder='password',id='password'>
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
