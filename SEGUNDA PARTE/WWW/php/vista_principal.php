<?php
session_start();
/*
print_r(session_id());
print_r("\n");
print_r($_SESSION["id_usuario_logueado"]);
print_r("\n");
print_r($_SESSION["email"]);
//$_SESSION["resp"] = "";
//var_dump($_SESSION["resp"]);
*/
 ?>
<!DOCTYPE html>
<html>
 <?php include '../base/header.php';?>
  <body class="body">
    <nav>
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <div class="list-group list-class">
            <a href="vista_registrar_prestamo.php" class="list-group-item">Nuevo prestamo</a>
            <a href="c_ver_prestamos_pendientes.php" class="list-group-item">Ver prestamos pendientes</a>
            <a href="c_ver_prestamos_devueltos.php" class="list-group-item">Ver prestamos devueltos</a>
            <a href="c_ver_mis_objetos.php" class="list-group-item">Administrar mis objetos</a>
            <a href="c_ver_usuarios_registrados.php" class="list-group-item">Usuarios registrados</a>
            <a href="c_ver_mis_amigos.php" class="list-group-item">Mis amigos</a>
            <a href="#" class="dropdown-toggle list-group-item" data-toggle="dropdown" role="button" ><?php echo $_SESSION["email"] ?></a>
              <ul class="dropdown-menu">
                <li><a href="c_ver_mi_perfil_mis_reputaciones.php">Mi perfil</a></li>
                <li><a href="c_cerrar_sesion.php">Salir</a></li>
              </ul>
          </div>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav>
  </body>
</html>
