<!DOCTYPE html>

<head>
    <meta charset="UTF8">
    <link rel="stylesheet" href="<?php echo base_url(); ?>Recursos/css/bootstrap-paper.min.css" />  
    
    
  <!--  <link rel="stylesheet" href = "<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.css">-->
  <!--  <script   src = "<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.js"></script>-->
  <!--  <link rel="stylesheet"  href = "<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.min.css">-->
  <!--  <script    src = "<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.theme.min.js"></script> -->
  <!-- <link rel="stylesheet"  href = "<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.structure.css">-->
  <!-- <link rel="stylesheet"  href = "<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.structure.min.css">-->
  <!-- <link rel="stylesheet"  href = "<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.theme.css">-->
  <!-- <link rel="stylesheet"  href = "<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.theme.min.css">-->
    

  <!-- <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">-->
  <!--<script src="http://code.jquery.com/jquery-1.10.2.js"></script>-->
  <!-- <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>  -->
  
   
  <!--  <link rel="stylesheet" href = "<?php echo base_url(); ?>Recursos/js/jquery-ui/South-Street/jquery-ui.css">-->
  <!--   <script   src = "<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-1.11.2.min.js"></script>-->
  <!--  <script   src = "<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.js"></script>  -->
 
 <script>
 function aviso()
 {
     var resultado = "<?php print($mensaje) ?>";
     if(resultado)
     {
     alert("Datos guardados correctamente");
     window.location = "<?php echo base_url() ?>index.php/loginc";
     }
}
 </script>
</head>
<body onload="aviso()">
     
<form class="form-horizontal" role="form" method="post" action=<?php echo base_url()."index.php/usuariosc/guardar"; ?>>


  <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Nombre</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
    </div>
  </div>
  
    <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Apellido</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
    </div>
  </div>
  
    <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Correo</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="correo" name="correo" placeholder="Correo">
    </div>
  </div>
  
    <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Password</label>
    <div class="col-lg-10">
      <input type="password" class="form-control" id="passowrd" name="passowrd" placeholder="Contraseña">
    </div>
  </div>
      <div style="margin-left:200px">
<button class="btn btn-default">Guardar</button>
    
  
    </div>
 
  
  
</form>
</body>
 </html>
