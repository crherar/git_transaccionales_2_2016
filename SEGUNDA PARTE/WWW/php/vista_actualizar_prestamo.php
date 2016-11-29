<?php
session_start();
print_r(session_id());
print_r("\n");
print_r($_SESSION["id_usuario_logueado"]);
print_r("\n");
print_r($_SESSION["email"]);
$host = "127.0.0.1";
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$socket2 = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$puerto = 3000;
$email = "";
$id_usuario = "";
if (socket_connect($socket, $host, $puerto) &&
   socket_connect($socket2, $host, $puerto))
{


$cabecera = array('formulario' => 'cbxobj',
									'id_usuario_logueado' => $_SESSION["id_usuario_logueado"],
									 'email'=>$_SESSION["email"]);

$msg = json_encode(array('cabecera'=>$cabecera,'datos'=>''));//"loginn|".$email."-".$password;

$sock_data = socket_write($socket, $msg, strlen($msg));
$resp = json_decode(socket_read($socket, 8192));
$objetos = $resp->datos;
//var_dump($objetos);

$cabecera = array('formulario' => 'cbxami',
									'id_usuario_logueado' => $_SESSION["id_usuario_logueado"],
									 'email'=>$_SESSION["email"]);
$msg = json_encode(array('cabecera'=>$cabecera,'datos'=>''));
//var_dump($msg);
$sock_data = socket_write($socket2, $msg, strlen($msg));
$resp = json_decode(socket_read($socket2, 8192));
$amigos = $resp->datos;
//var_dump($amigos);

//$_SESSION["resp"] = "";
//var_dump($_SESSION["resp"]);
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
                <!-- <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">One more separated link</a></li> -->
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
            <h1>Actualizar Prestamo</h1>
           <form action="c_actualizar_prestamo.php" method="POST">

             <div class="form-group">
                <label for="email">Fecha prestamo:</label>
                 <div class='input-group date' id='fecha_prestamo'>
<!-- <?php print_r(date($_SESSION["datos"]->fecha_prestamo)); ?> -->
                     <input name="fecha_prestamo"  placeholder="Fecha prestamo" type='text' class="form-control" value=<?php print_r($_SESSION["datos"]->fecha_prestamo); ?>/>
                     <script type="text/javascript">
                         $(function () {

                             $('#fecha_prestamo').datetimepicker({
                             format: "DD/MM/YYYY"
                            //    autoclose: true
                             });
                             //$('#fecha_prestamo').datetimepicker('setStartDate', '2012-01-01');
                         });
                     </script>
                     <span class="input-group-addon">
                         <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                 </div>
             </div>

             <div clas='form-group'>
               <label for="email">Usuario recibidor:</label>
               <select name="usuario_recibidor" class="selectpicker form-control" data-live-search="true" title=<?php print_r($_SESSION["datos"]->correo_usuario_recibidor); ?> >
                 <?php foreach($amigos as $value)
                 {
                   if($value != $_SESSION["datos"]->correo_usuario_recibidor)
                   {
                  ?>
                  <option data-tokens="ketchup mustard"><?php print_r($value); ?></option>
              <?php
                  }
                }
                  ?>
                  <option selected="selected"><?php print_r($_SESSION["datos"]->correo_usuario_recibidor); ?> </option>
               </select>
           </div>

             <div clas='form-group'>
               <label for="email">Nombre objeto:</label>
               <select name="nombre_objeto" class="selectpicker form-control" data-live-search="true" title=<?php print_r($_SESSION["datos"]->nombre_objeto); ?>>
                 <?php foreach($objetos as $value)
                 {
                   if($value != $_SESSION["datos"]->nombre_objeto)
                   {
                  ?>
                  <option data-tokens="ketchup mustard"><?php print_r($value); ?></option>
              <?php
                    }
                }
                  ?>
                  <option selected="selected"><?php print_r($_SESSION["datos"]->nombre_objeto); ?></option>
               </select>
             </div>
             <div clas='form-group'>
               <label for="email">Cantidad:</label>
               <input  class="form-control", type='text', required='true', name='cantidad', placeholder='Canitdad',id='cantidad' value=<?php print_r($_SESSION["datos"]->cantidad); ?>>
             </div>

             <div class="form-group">
                <label for="email">Fecha devolución:</label>
                 <div class='input-group date' id='fecha_devolucion'>

                     <input name="fecha_devolucion" placeholder="Fecha devolución" type='text' class="form-control" value=<?php print_r($_SESSION["datos"]->fecha_devolucion); ?>/>
                     <script type="text/javascript">
                         $(function () {
                             $('#fecha_devolucion').datetimepicker({
                               format: "DD/MM/YYYY"
                             });
                         });
                     </script>
                     <span class="input-group-addon">
                         <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                 </div>
             </div>

             <div class="top-space">
               <input class="btn btn-info" type="submit" name="name" value="Guardar">
             </div>
           </form>
         </div>
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
