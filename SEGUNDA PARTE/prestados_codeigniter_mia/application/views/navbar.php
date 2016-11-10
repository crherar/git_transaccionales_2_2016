<?php 
// if($id >0)
// {
?>
<!--<div style="display:none"  id="barra_navegacion">-->
  <?php 
  // } 
  // else
  // {
  ?>
<!--<div id="barra_navegacion">-->
  <?php
  // }
  ?>
  <div id="barra_navegacion">
    <link rel="stylesheet" href="<?php echo base_url(); ?>Recursos/css/bootstrap-paper.min.css" />  
     <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/misfunciones.js"></script>
    <nav class="navbar navbar-default" role="navigation">
   <!--El logotipo y el icono que despliega el menú se agrupan-->
   <!--    para mostrarlos mejor en los dispositivos móviles -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-ex1-collapse">
      <span class="sr-only">Desplegar navegación</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <!--<a class="navbar-brand" href="#">Logotipo</a>-->
  </div>
 
  <div id="tabs" class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li><a id = "prestamo_pendiente" onclick = "cambiarColor(this)" href="<?php echo base_url()."index.php/prestamosc/verPendientes"; ?>">Préstamos pendientes</a></li>
      <li><a id = "prestamos_devuelto" onclick = "cambiarColor(this)" href="<?php echo base_url()."index.php/prestamosc/verDevueltos"; ?>">Préstamos devueltos</a></li>
       <li><a id = "usuarios_prestados" onclick = "cambiarColor(this)" href="<?php echo base_url()."index.php/amigosc"; ?>">Usuarios de prestados</a></li>
       <li><a id = "clasificar_prestados" onclick = "cambiarColor(this)" href="<?php echo base_url()."index.php/feedbackc"; ?>">Clasificar prestados, deja tus comentarios (Feedback)</a></li>
    <li><a id = "clasificar_prestados" onclick = "cerrarSesionPrestados()" >Salir</a></li>
    </ul>
  </div>
</nav>
</div>

  <!--<div id="tabs" >-->
    <!--<ul id="menu">-->
      <!--<li class="active"><a id = "nuevo_prestamo" onclick = "cambiarColor(this)" href=<?php echo base_url()."index.php/prestamosc/registrar"; ?>>Nuevo prestamo</a></li>-->
    <!--  <li class="ui-widget-header">Prestamos</li>-->
    <!--  <li><a id = "prestamo_pendiente" onclick = "cambiarColor(this)" href="<?php echo base_url()."index.php/prestamosc/verPendientes"; ?>">Préstamos pendientes</a></li>-->
    <!--  <li><a id = "prestamos_devuelto" onclick = "cambiarColor(this)" href="<?php echo base_url()."index.php/prestamosc/verDevueltos"; ?>">Préstamos devueltos</a></li>-->
    <!--   <li><a id = "usuarios_prestados" onclick = "cambiarColor(this)" href="<?php echo base_url()."index.php/amigosc"; ?>">Usuarios de prestados</a></li>-->
    <!--   <li><a id = "clasificar_prestados" onclick = "cambiarColor(this)" href="<?php echo base_url()."index.php/feedbackc"; ?>">Clasificar prestados, deja tus comentarios (Feedback)</a></li>-->
    <!--</ul>-->
  <!--</div>-->
 
    
