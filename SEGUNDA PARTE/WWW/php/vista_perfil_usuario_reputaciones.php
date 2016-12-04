<?php
// session_start();
// print_r(session_id());
// print_r("\n");
// print_r($_SESSION["id_usuario_logueado"]);
// print_r("\n");
// print_r($_SESSION["email"]);

 ?>



<?php
session_start();
print_r(session_id());
print_r("\n");
print_r($_SESSION["id_usuario_logueado"]);
print_r("\n");
print_r($_SESSION["email"]);

$host = "127.0.0.1";
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$puerto = 3000;

if (socket_connect($socket, $host, $puerto))
{
$cabecera = array('formulario' => 'veorep',
									'id_usuario_logueado' => $_SESSION["id_usuario_logueado"],
								  'email'=>$_SESSION["email"]);

$usuario = array('id_usuario_clasificado'=>$_POST["id_usuario_clasificado"]);
//var_dump($usuario);
$msg = json_encode(array('cabecera'=>$cabecera,'datos'=>$usuario));//"loginn|".$email."-".$password;

//$sock_data = socket_write($socket, "HOLA MUNDO! 17957132", strlen("HOLA MUNDO! 17957132"));
//echo "ENVIANDO AL PYTHON: \n";
//echo $msg."\n";
$sock_data = socket_write($socket, $msg, strlen($msg));
//echo "RESPUESTA DEL PYTHON: \n";
$resp = json_decode(socket_read($socket, 2048));
$_SESSION["datos"] = $resp->datos;
$_SESSION["usuario_perfil"] = $resp->usuario_perfil->nombre." ".$resp->usuario_perfil->apellido." - ".$resp->usuario_perfil->email;
//var_dump($resp);
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
<script type="text/javascript" src="../js/reputaciones.js"></script>
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
            <li><a href="c_ver_usuarios_registrados.php">Usuarios registrados</a></li>
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
        <div class="alert alert-success">
          <?php print_r($_SESSION["resp"]); ?>
        </div>
     <?php

    }
    ?>

    <div>

  </div>
  <?php //var_dump($_SESSION); ?>
  <h1>Perfil de <?php print_r($_SESSION["usuario_perfil"]); ?></h1>
  <table class="table table-bordered">
    <thead>
      <th style="display: none;">id_reputacion</th>
      <th style="display: none;">id_usuario_clasificado</th>
      <th style="display: none;">id_usuario_clasificador</th>
      <th> N° </th>
      <th> Usuario clasificador </th>
      <th> Email usuario clasificador </th>
      <th> Clasificacion </th>
      <th> Comentario </th>
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
        <td style="display: none;" id="td_idreputacion_<?php echo $cont; ?>"><?php echo $value->id_reputacion; ?></td>
        <td style="display: none;" id="td_idusuarioclasificador_<?php echo $cont; ?>"><?php echo $value->id_usuario_clasificador; ?></td>
        <td style="display: none;" id="td_idusuarioclasificado_<?php echo $cont; ?>"><?php echo $value->id_usuario_clasificado; ?></td>

        <td id="td_pos_<?php echo $cont; ?>"><?php echo $cont; ?></td>
        <td id="td_nombre_usuarioclasificador_<?php echo $cont; ?>"><?php echo $value->usuario_clasificador; ?></td>
        <td id="td_email_usuarioclasificador_<?php echo $cont; ?>"><?php echo $value->email_usuario_clasificador; ?></td>
        <td id="td_clasificacion_<?php echo $cont; ?>">

          <?php if($value->clasificacion == 1)
          {
          ?>
                  <img src="../img/estrella.jpg" >
          <?php
          }
          ?>

          <?php if($value->clasificacion == 2)
          {
          ?>
                  <img src="../img/estrella.jpg" >
                  <img src="../img/estrella.jpg" >
          <?php
          }
          ?>

          <?php if($value->clasificacion == 3)
          {
          ?>
          <img src="../img/estrella.jpg" >
          <img src="../img/estrella.jpg" >
            <img src="../img/estrella.jpg" >
          <?php
          }
          ?>

          <?php if($value->clasificacion == 4)
          {
          ?>
          <img src="../img/estrella.jpg" >
          <img src="../img/estrella.jpg" >
          <img src="../img/estrella.jpg" >
          <img src="../img/estrella.jpg" >
          <?php
          }
          ?>

          <?php if($value->clasificacion == 5)
          {
          ?>
          <img src="../img/estrella.jpg" >
          <img src="../img/estrella.jpg" >
          <img src="../img/estrella.jpg" >
          <img src="../img/estrella.jpg" >
          <img src="../img/estrella.jpg" >
          <?php
          }
          ?>


        </td>
        <td id="td_comentario_<?php echo $cont; ?>"><?php echo $value->comentario; ?></td>
        <td>
          <ul>
            <?php if($value->id_usuario_clasificador == $_SESSION["id_usuario_logueado"])
            { ?>
          <!-- <button id="btn_agregarmisamigos_<?php echo $cont; ?>" onclick="agregar_amigo(this)">Agregar como amigo</button> -->
          <button id="btn_verperfil_<?php echo $cont; ?>"  onclick = "get_reputacion_editar(this)">Editar</button>
          <button id="btn_verperfil_<?php echo $cont; ?>"  onclick = "ver_perfil_usuario_amigo(this)">Eliminar</button>
          <?php }
          else {
            print_r("No puedes editar esta reputación");
          }
           ?>
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
<p>¿Seguro que quiere eliminar la reputación?</p>
</div>

  <?php
//unset($_SESSION["datos"]);
unset($_SESSION["resp"]);
   ?>
  </body>
</html>
<?php
}
else
{
	echo "\nLa conexion TCP no se pudo realizar, puerto: ".$puerto;
}
socket_close($socket);
?>
