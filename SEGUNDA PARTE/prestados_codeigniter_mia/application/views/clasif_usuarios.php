<!DOCTYPE html>

<head>
    <meta charset="UTF8">
          <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/css/jquery-ui.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.min.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.min.js"></script>

     <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/misfunciones.js"></script>
  
   <script>
 function aviso()
 {
     var resultado = "<?php print($mensaje) ?>";
     if(resultado)
     {
     alert("Datos guardados correctamente");
     }
}
 </script>
  

 
</head>
<body onload="registroClasificacionUsuarios()">

     <div id="form"  style="display:none" title="Informacion Modificada">
	<p>La informacion se guardo sin problemas</p>
</div>

     <div id="vnteliminar"  style="display:none" title="Eliminar prestamo">
	<p>¿Seguro que quiere eliminar el prestamo?</p>
</div>


    <div class="form-horizontal" id="formulario"  style="display: none"  tittle="Editar prestamo">
      

            
        
   <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Clasificacion</label>
    <div class="col-lg-10">
      
      <select class="form-control" id="lista_usuarios" name="lista_usuarios">
         <option>1</option>
         <option>2</option>
         <option>3</option>
         <option>4</option>
         <option>5</option>
         <option>6</option>
         <option>7</option>
     </select>
      
    </div>
  </div>

 <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Comentario</label>
    <div class="col-lg-10">
      <input type="textarea" class="form-control" id="tipoprestamo" name="tipoprestamo" placeholder="Tipo de prestamo">
    </div>
  </div>
  
</div>


</body>
 </html>
