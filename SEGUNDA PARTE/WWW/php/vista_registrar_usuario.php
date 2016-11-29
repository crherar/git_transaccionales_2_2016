<?php
session_unset();
session_start();
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
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <link rel="stylesheet" type="text/css" href="../css/app.css">
     <title></title>
   </head>
   <body>

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
   <div class = "col-md-4 remove-float center-block  big-top-space">
     <h1>Registrar usuario</h1>
      <form action="c_registrar_usuario.php" method="POST">
     <!--<form action=""></form> -->
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
        <div>
           <input type="submit" value="Registrarse" class="btn btn-info">
        </div>
        <br><br>

     </form>
   </div>
   <?php
 //unset($_SESSION["datos"]);
 unset($_SESSION["resp"]);
    ?>
 </body>
</html>
