<?php
session_start();
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
    <link rel='stylesheet', href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
  <link rel='stylesheet', type='text/css', href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css'>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/app.css">
    <title></title>
  </head>
  <body>
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
            <li><a href="#">Nuevo prestamo</a></li>
            <li class="active"><a href="#">Ver prestamos pendientes <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Ver prestamos devueltos</a></li>
            <li><a href="#">Administrar mis objetos</a></li>

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
      if($_SESSION["resp"] == "01")
      {
      ?>
        <div class="alert alert-success">
          Objecto registrado correctamente
        </div>
     <?php

    }
    ?>

    <div>
    <a href="vista_registrar_objeto.php">Registrar objeto</a>
  </div>
  <table>
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
      foreach ($datos as $value) {
      ?>
      <tr>
        <td id="td_pos_"<?php echo $cont; ?>><?php echo $cont; ?></td>
        <td id="td_idobjeto_"<?php echo $cont; ?>></td>
        <td id="td_nombre_objeto_"<?php echo $cont; ?>><?php echo $value; ?></td>
        <td>
          <ul>
          <button id="btn_editar_<?php echo $cont; ?>"  onclick="editarPrestamo(this)">Editar</button>
          <button id="btn_devuelto_<?php echo $cont; ?>" onclick="marcarPrestamoDevuelto(this)">Devuelto</button>
          <button id="btn_eliminar_<?php echo $cont; ?>"  onclick = "eliminarPrestamo(this)">Eliminar</button>
        </ul>
        <td>
      </tr>

      <?php
        $cont++;
      }
       ?>
    </tbody>
  </table>
  <?php
  //unset($_SESSION["datos"]);
unset($_SESSION["resp"]);
   ?>
  </body>
</html>
