<!DOCTYPE html>
<html>
    <head>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/css/jquery-ui.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.min.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.min.js"></script>
     
     
     
        <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/css/data-tables/jquery.dataTables.css">-->
        <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" type="text/css" />-->
        <!--<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>-->
 
       
        <!-- <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/data-tables/dataTables.jqueryui.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/data-tables/dataTables.jqueryui.min.js"></script>-->
 
 
         <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/css/data-tables/dataTables.jqueryui.min.css">
<!--        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" type="text/css" />-->
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
         <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/data-tables/dataTables.jqueryui.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/data-tables/dataTables.jqueryui.min.js"></script>
 
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/css/bootstrap.min.css">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/css/data-tables/dataTables.bootstrap.min.css">
 
        <!--<script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/moment.min.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/bootstrap-datetimepicker.min.js"></script>-->
        <!--<link rel="stylesheet"  href = "<?php echo base_url(); ?>Recursos/css/bootstrap.min.css">-->
        <link rel="stylesheet"  href = "<?php echo base_url(); ?>Recursos/css/bootstrap-datetimepicker.min.css">
        
        <!--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" type="text/css" />-->
        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css" type="text/css" />-->
       
       <script type="text/javascript" src="https://mandrillapp.com/api/docs/js/mandrill.js"></script>
       <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/mis_js/loginfacebook.js"></script>
       <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/mis_js/usuarios.js"></script>
       <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/mis_js/enviarmail.js"></script>   
       <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/mis_js/prestamos.js"></script>
       <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/mis_js/clasif-usuarios.js"></script>
       <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/mis_js/amigos.js"></script>
       <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/mis_js/feedbacks.js"></script>
    </head>
    <body>
        
        <div class="container">
        <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th>Nombre del metodo</th>
                <th> Qué es lo que hace</th>
                <th>Parámetros que recibe (en formato json)</th>
                <th>Retorno</th>
                <th>Url</th>
                </tr>
            </thead>
            <tr>
                <td> login </td>
                <td>login a prestadosweb</td>
                <td>correo_usuario,password</td>
                <td>json, llave 'respuesta' valor 1 correcto o 0 incorrecto</td>
                <td>http://www.prestadosweb.com/index.php/apipwc/login</td>
            </tr>
            <tr>
                <td>guardarAmistad</td>
                <td>agrega amigo del usuario logueado</td>
                <td>id_usuario_logueado,id_amigo</td>
                <td>string true o false</td>
                <td>http://www.prestadosweb.com/index.php/apipwc/guardarAmistad</td>
            </tr>
            <tr>
                <td>obtenerAmigos</td>
                <td>retorna todos los amigos del usuario logueado</td>
                <td>id_usuario_logueado</td>
                <td>json con todos los amigos</td>
                <td>http://www.prestadosweb.com/index.php/apipwc/obtenerAmigos</td>
            </tr>
            <tr>
                <td>clasifUsuarios</td>
                <td>clasifica al usuario recibidor</td>
                <td>id_usuario_logueado,aquien (nombre del usuario),comentario</td>
                <td>string true o false</td>
                <td>http://www.prestadosweb.com/index.php/apipwc/clasifUsuarios</td>
            </tr>
            <tr>
                <td>guardarUsuario</td>
                <td>registra un nuevo usuario en prestadosweb</td>
                <td>nombre,apellido,correo,password</td>
                <td>string true o false</td>
                <td>http://www.prestadosweb.com/index.php/apipwc/guardarUsuario</td>
            </tr>    
            <tr>
                <td>actualizarContrasenia</td>
                <td>actualiza la contraseña del usuario en caso de olvido</td>
                <td>email,password</td>
                <td>string ok,error o false</td>
                <td>http://www.prestadosweb.com/index.php/apipwc/actualizarContrasenia</td>
            </tr>
            <tr>
                <td>guardarPrestamo</td>
                <td>registra un nuevo prestamo</td>
                <td>id_usuario_logueado,fecha_prestamo,tipo_prestamo,quien_recibe,cantidad,fecha_devolucion</td>
                <td>string true o false</td>
                <td>http://www.prestadosweb.com/index.php/apipwc/guardarPrestamo</td>
            </tr>
            <tr>
                <td>actualizarPrestamo</td>
                <td>registra un nuevo prestamo</td>
                <td>id_usuario_logueado,idPrestamo,idOPrestamo,fecha_prestamo,tipo_prestamo,quien_recibe,cantidad,fecha_devolucion</td>
                <td>string true o false</td>
                <td>http://www.prestadosweb.com/index.php/apipwc/actualizarPrestamo</td>
            </tr>
            <tr>
                <td>eliminarPrestamo</td>
                <td>elimina un prestamo</td>
                <td>idPrestamo,idOPrestamo</td>
                <td>string true o false</td>
                <td>http://www.prestadosweb.com/index.php/apipwc/eliminaPrestamo</td>
            </tr>
            <tr>
                <td>prestamosPendientes</td>
                <td>cambia el estado de un prestamo a pendiente</td>
                <td>id_usuario_logueado,id_prestamo</td>
                <td>string true o false</td>
                <td>http://www.prestadosweb.com/index.php/apipwc/prestamosPendientes</td>
            </tr>
            <tr>
                <td>prestamosDevuelto</td>
                <td>cambia el estado de un prestamo a devuelto</td>
                <td>id_usuario_logueado,id_prestamo</td>
                <td>string true o false</td>
                <td>http://www.prestadosweb.com/index.php/apipwc/prestamosDevueltos</td>
            </tr>
            <tr>
                <td>guardarFeedback</td>
                <td>registra feedback dado por un usuario</td>
                <td>id_usuario_logueado,clasificacion,comentario</td>
                <td>string true o false</td>
                <td>http://www.prestadosweb.com/index.php/apipwc/guardarFeedback</td>
            </tr>
        </table>
        </div>
    </body>
</html>