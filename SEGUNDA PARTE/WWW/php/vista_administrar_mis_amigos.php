<?php
session_start();
print_r(session_id());
print_r("\n");
print_r($_SESSION["id_usuario_logueado"]);
print_r("\n");
print_r($_SESSION["email"]);
print_r(" total_amigos: ".$_SESSION["tnrami"]);
//echo "datos: \n";
//var_dump($_SESSION["datos"]);
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
<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="../css/jquery-ui.min.css">
    <script type="text/javascript" src="../js/jquery-ui.min.js"></script>
    <link rel='stylesheet', href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
  <link rel='stylesheet', type='text/css', href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css'>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/amigos.js"></script>
<script type="text/javascript" src="../js/usuarios.js"></script>
<link rel="stylesheet" type="text/css" href="../css/app.css">
    <title></title>
  </head>
  <body >
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->

        <!-- <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Brand</a>
        </div> -->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="vista_registrar_prestamo.php">Nuevo prestamo</a></li>
            <li><a href="c_ver_prestamos_pendientes.php">Ver prestamos pendientes</a></li>
            <li><a href="c_ver_prestamos_devueltos.php">Ver prestamos devueltos</a></li>
            <li><a href="c_ver_mis_objetos.php">Administrar mis objetos</a></li>
            <li><a href="vista_usuarios_registrados.php">Usuarios registrados</a></li>
            <li class="active"><a href="c_ver_mis_amigos.php">Mis amigos</a></li>
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
        <div class="alert alert-success">
          <?php print_r($_SESSION["resp"]); ?>
        </div>
     <?php

    }
    ?>

    <div>

  </div>
  <h1>Mis Amigos</h1>
  <table class="table table-bordered">
    <thead>
      <th style="display: none;">id_amistad</th>
      <th style="display: none;">id_usuario</th>
      <!-- id_amigo = id_usuario -->
      <th style="display: none;">id_amigo</th>
      <th> N° </th>
      <th> Nombre amigo </th>
      <th> Email amigo </th>
      <th> Accion</th>
    </thead>
    <tbody>
      <?php
      $cont = 1;
      //echo "antes de llenar la tabla: \n";
      //var_dump($_SESSION["datos"]);
      $datos = $_SESSION["datos"];
//style="display: none;"
      foreach ($datos as $value) {
      ?>
      <tr>
        <td style="display: none;" id="td_idamistad_<?php echo $cont; ?>"><?php echo $value->id_amistad; ?></td>
        <td style="display: none;" id="td_idusuario_<?php echo $cont; ?>"><?php echo $value->id_amigo; ?></td>
        <td style="display: none;" id="td_idamigo_<?php echo $cont; ?>"><?php echo $value->id_amigo; ?></td>
        <td id="td_pos_<?php echo $cont; ?>"><?php echo $cont; ?></td>
        <td id="td_nombreamigo_<?php echo $cont; ?>"><?php echo $value->ami; ?></td>
        <td id="td_emailamigo_<?php echo $cont; ?>"><?php echo $value->emailami; ?></td>
        <td>
          <ul>
          <button id="btn_perfil_<?php echo $cont; ?>"  onclick="ver_perfil_usuario_amigo(this)">Ver perfil</button>
          <button id="btn_clasificar_<?php echo $cont; ?>" onclick="agregar_reputacion(this)">Agregar reputación</button>
          <button id="btn_eliminar_<?php echo $cont; ?>"  onclick = "get_amigo_eliminar(this)">Eliminar</button>
        </ul>
      </td>
      </tr>

      <?php
        $cont++;
      }
       ?>
    </tbody>
  </table>

  <div id="vnteliminar"  style="display:none" title="Eliminar amigo">
<p>¿Seguro que quiere eliminar el amigo?</p>
</div>

  <?php
//unset($_SESSION["datos"]);
unset($_SESSION["resp"]);
   ?>
  </body>
</html>
