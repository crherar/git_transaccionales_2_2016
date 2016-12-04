<?php
session_unset();
session_start();
/*
print_r(session_id());
print_r("\n");
unset($_SESSION["id_usuario_logueado"]);
unset($_SESSION["email"]);
print_r($_SESSION["id_usuario_logueado"]);
print_r("\n");
print_r($_SESSION["email"]);
//unset($_SESSION["datos"]);
//$_SESSION["resp"] = "";
//var_dump($_SESSION["resp"]);
*/
 ?>

 <!DOCTYPE html>
 <html>
  <?php include '../base/header.php';?>
   <body class="registro-usuario">
   <div class = "col-md-4 remove-float center-block  big-top-space cont-registro">
      <h4>Registro de Usuario</h4>
      <form action="c_registrar_usuario.php" method="POST">
        <div clas="form-group">
           <label for="nombre">Nombre:</label>
           <input maxlength="20" type="text" required="true" name="nombre" placeholder="nombre" id="nombre" class="form-control">
        </div>
        <div >
           <label for="email">Apellido:</label>
           <input maxlength="20" type="text"  required="true" name="apellido" placeholder="apellido" id="apellido" class="form-control">
        </div>
        <div >
           <label for="email">Email:</label>
           <input maxlength="40" type="email"  required="true" name="email" placeholder="email" id="email" class="form-control">
        </div>
        <div >
           <label for="email">Password:</label>
           <input maxlength="10" type="password"  required="true" name="password" placeholder="password" id="password" class="form-control">
        </div>
            <?php
         if(isset($_SESSION["resp"]))
         {
            ?>
            <div class="alert alert-danger">
            <?php print_r($_SESSION["resp"]); ?>
            </div>
            <?php
         }
         ?>
        <div>
           <input type="submit" value="Registrarse" class="btn btn-info submit">
        </div>
        <br><br>

     </form>
   </div>
   <?php
 unset($_SESSION["resp"]);
    ?>
 </body>
</html>
