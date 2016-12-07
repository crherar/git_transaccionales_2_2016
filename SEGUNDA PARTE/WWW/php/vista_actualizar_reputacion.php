<?php
session_start();
print_r(session_id());
print_r("\n");
print_r($_SESSION["id_usuario_logueado"]);
print_r("\n");
print_r($_SESSION["email"]);
print_r($_SESSION["datos"]);
//echo "<pre>";
print_r($_SESSION);


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

   <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" />
   <link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />

<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel='stylesheet', href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
  <link rel='stylesheet', type='text/css', href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css'>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.0/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.0/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.0/js/i18n/defaults-*.min.js"></script> -->


<link rel="stylesheet" type="text/css" href="../css/app.css">

<link rel="stylesheet"  href = "../css/bootstrap-datetimepicker.min.css">
 <script type="text/javascript" src="../js/moment.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
    <title></title>
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="vista_registrar_prestamo.php">Nuevo prestamo</a></li>
              <li class="active"><a href="c_ver_prestamos_pendientes.php">Ver prestamos pendientes</a></li>
            <li><a href="c_ver_prestamos_devueltos.php">Ver prestamos devueltos</a></li>
            <li><a href="c_ver_mis_objetos.php">Administrar mis objetos</a></li>
            <li><a href="vista_usuarios_registrados.php">Usuarios registrados</a></li>
            <li><a href="c_ver_mis_amigos.php">Mis amigos</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["email"] ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="c_ver_mi_perfil_mis_reputaciones.php">Mi perfil</a></li>
                <li><a href="c_cerrar_sesion.php">Salir</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav>
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
           <h1> Actualizar reputación </h1>
           <form action="c_actualizar_reputacion.php" method="POST">

             <div clas='form-group'>
               <label for="email">Usuario por clasificar: <?php print_r($_SESSION["usuario_clasificado"]->nombre." ".$_SESSION["usuario_clasificado"]->apellido); ?></label>
             </div>
             <div clas='form-group'>
               <label for="email">Email usuario por clasificar: <?php printf($_SESSION["usuario_clasificado"]->email); ?></label>
             </div>
             <div clas='form-group'>
               <label for="email">Clasificacion:</label>
               <select name="clasificacion" class="selectpicker form-control" data-live-search="true" title="Clasificación...">

                  <?php
                  for ($i=1; $i <= 5 ; $i++) {
                  if ($_SESSION["datos"]->clasificacion == $i) {

                  ?>
                    <option selected = "selected" data-tokens="ketchup mustard"><?php print_r($i); ?></option>

                  <?php
                    }
                    else{
                    ?>
                    <option data-tokens="ketchup mustard"><?php print_r($i); ?></option>

                <?php  }
                  }
                   ?>

               </select>
           </div>
             <div clas='form-group'>
               <label for="email">Comentario</label>
               <textarea  class="form-control", type='text', required='true', name='comentario', placeholder='Comentario',id='comentario'><?php print_r($_SESSION["datos"]->comentario); ?></textarea>
               <input style="display: none;" name="id_reputacion" id="id_reputacion" value=<?php print_r($_SESSION["datos"]->id); ?>>
             </div>

             <div class="top-space">
               <input class="btn btn-info" type="submit" name="name" value="Guardar">
             </div>
           </form>
         </div>
         <?php
       //unset($_SESSION["datos"]);
       unset($_SESSION["resp"]);
          ?>
  </body>
</html>
