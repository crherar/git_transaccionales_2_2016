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
              <li class="active"><a href="c_ver_prestamos_pendientes.php">Ver prestamos pendientes</a></li>
            <li><a href="c_ver_prestamos_devueltos.php">Ver prestamos devueltos</a></li>
            <li><a href="c_ver_mis_objetos.php">Administrar mis objetos</a></li>
            <li><a href="c_ver_usuarios_registrados.php">Usuarios registrados</a></li>
            <li><a href="c_ver_mis_amigos.php">Mis amigos</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["email"] ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">One more separated link</a></li>
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
    <a href="vista_registrar_objeto.php">Registrar objeto</a>
  </div>
  <table class="table table-bordered">
    <thead>
      <th style="display: none;">id</th>
      <th> N° </th>
      <th> Objeto </th>
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
        <td style="display: none;" id="td_idobjeto_<?php echo $cont; ?>"><?php echo $value->id; ?></td>
        <td id="td_pos_<?php echo $cont; ?>"><?php echo $cont; ?></td>
        <td id="td_nombre_objeto_<?php echo $cont; ?>"><?php echo $value->nombre_objeto; ?></td>
        <td>
          <ul>
          <button id="btn_editar_<?php echo $cont; ?>"  onclick="get_objeto_editar(this)">Editar</button>
          <!-- <button id="btn_devuelto_<?php echo $cont; ?>" onclick="marcarPrestamoDevuelto(this)">Devuelto</button> -->
          <button id="btn_eliminar_<?php echo $cont; ?>"  onclick = "get_objeto_eliminar(this)">Eliminar</button>
        </ul>
      </td>
      </tr>

      <?php
        $cont++;
      }
       ?>
    </tbody>
  </table>

  <div id="vnteliminar"  style="display:none" title="Eliminar objeto">
<p>¿Seguro que quiere eliminar el objeto?</p>
</div>

  <?php
//unset($_SESSION["datos"]);
unset($_SESSION["resp"]);
   ?>
  </body>
</html>
