<?php
session_start();
print_r(session_id());
print_r("\n");
print_r($_SESSION["id_usuario_logueado"]);
print_r("\n");
print_r($_SESSION["email"]);
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
<script type="text/javascript" src="../js/objetos.js"></script>
<script type="text/javascript" src="../js/prestamos.js"></script>
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
            <li class="active"><a href="c_ver_prestamos_pendientes.php">Ver prestamos pendientes </a></li>
            <li><a href="c_ver_prestamos_devueltos.php">Ver prestamos devueltos</a></li>
            <li><a href="c_ver_mis_objetos.php">Administrar mis objetos</a></li>
            <li><a href="vista_usuarios_registrados.php">Usuarios registrados</a></li>
            <li><a href="c_ver_mis_amigos.php">Mis amigos</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["email"] ?> </a>
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
  <h1>Prestamos pendientes hechos por mi</h1>
  <table class="table table-bordered">
    <thead>
      <th style="display: none;">id</th>
      <th> N° </th>
      <th> Fecha prestamo </th>
      <th> Usuario recibidor </th>
      <th> Correo usuario recibidor </th>
      <th> Objeto prestado </th>
      <th> Cantidad prestada </th>
      <th> Fecha devolución </th>
      <th> Accion</th>
    </thead>
    <tbody>
      <?php //style="display: none;"
      $cont = 1;
      //echo "antes de llenar la tabla: \n";
      //var_dump($_SESSION["datos"]);
      $datos = $_SESSION["datos"];
//style="display: none;"
      foreach ($datos as $value) {
      ?>
      <tr>
        <td style="display: none;"  id="td_idprestamo_<?php echo $cont; ?>"><?php echo $value->id; ?></td>
        <td id="td_pos_<?php echo $cont; ?>"><?php echo $cont; ?></td>
        <td id="td_fecha_prestamo_<?php echo $cont; ?>"><?php echo $value->fpre; ?></td>
        <td id="td_usuario_recibidor_<?php echo $cont; ?>"><?php echo $value->ur; ?></td>
        <td id="td_correo_usuario_recibidor_<?php echo $cont; ?>"><?php echo $value->cur; ?></td>
        <td id="td_objeto_prestado_<?php echo $cont; ?>"><?php echo $value->obj; ?></td>
        <td id="td_cantidad_prestada_<?php echo $cont; ?>"><?php echo $value->cant; ?></td>
        <td id="td_fecha_devolucion_<?php echo $cont; ?>"><?php echo $value->fdev; ?></td>
        <td>
          <ul>
          <button id="btn_editar_<?php echo $cont; ?>"  onclick="get_prestamo_editar(this)">Editar</button>
          <button id="btn_devuelto_<?php echo $cont; ?>" onclick="marcarPrestamoDevuelto(this)">Devuelto</button>
          <button id="btn_eliminar_<?php echo $cont; ?>"  onclick = "get_prestamo_eliminar(this)">Eliminar</button>
        </ul>
      </td>
      </tr>

      <?php
        $cont++;
      }
       ?>
    </tbody>
  </table>

  <div id="vnteliminar"  style="display:none" title="Eliminar prestamo">
<p>¿Seguro que quiere eliminar el prestamo?</p>
</div>

  <?php
//unset($_SESSION["datos"]);
unset($_SESSION["resp"]);
   ?>
  </body>
</html>
