<!DOCTYPE html>

<head>
    <meta charset="UTF8">
  
          <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/css/jquery-ui.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.min.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet"  href = "<?php echo base_url(); ?>Recursos/css/bootstrap-datetimepicker.min.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/misfunciones.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/mis_js/prestamos.js"></script>

  <script>
  $(function() {
    $( "#fecha_prestamo" ).datepicker();
  });
  </script>
  
    <script>
  $(function() {
    $( "#fecha_devolucion" ).datepicker();
  });
  </script>
  
 
</head>
<body onload="guardarPrestamos()">
    
   <?php //var_dump(count($dat[0])); ?>
<!--<form class="form-horizontal" role="form" s method="post" action=<?php echo base_url()."index.php/prestamosc/guardar"; ?>>-->
<div id="frm_registro_prestamos" style="display:none">

  <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Fecha prestamo</label>
    <div class="col-lg-10">
       <input type="text" id="fecha_prestamo" name="fecha_prestamo">
    </div>
  </div>
  


  <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Tipo de prestamo</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="nombre" name="tipo_prestamo" placeholder="Tipo de prestamo">
    </div>
  </div>
  
    <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Cantidad</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="apellido" name="cantidad" placeholder="Cantidad">
    </div>
  </div>
  
  <!--  <div class="form-group">-->
  <!--  <label for="inputPassword" class="col-lg-2 control-label">Tipo prestamo</label>-->
  <!--  <div class="col-lg-10">-->
  <!--    <input type="text" class="form-control" id="correo" name="tipo_prestamo" placeholder="Correo">-->
  <!--  </div>-->
  <!--</div>-->
  
    <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Quien recibe</label>
    <div class="col-lg-10">
      
      <select class="form-control" name="lista_usuarios">
          <?php  
          
                      $length = count($dat[0]);
            for ($i = 0; $i < $length; $i++) {
            ?>
              <option>
                  <?php echo $dat[0][$i]; ?>
                  </option>
            <?php
            }
            ?>
 
</select>
      
    </div>
  </div>
      <div style="margin-left:200px">
          
          

            <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Fecha devolución</label>
    <div class="col-lg-10">
       <input type="text" id="fecha_devolucion" name="fecha_devolucion">
    </div>
  </div>
<button class="btn btn-default">Guardar</button>
    
  
    </div>
 
  
  
</div>

</body>
 </html>
