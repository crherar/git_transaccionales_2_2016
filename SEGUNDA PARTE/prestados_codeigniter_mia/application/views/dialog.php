<!DOCTYPE html>
<html>
    <head>
         <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/css/jquery-ui.css">
         <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/jquery-2.1.4.min.js"></script>
          <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.min.css">
        
         <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.min.js"></script>
     
     
  <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/moment.min.js"></script>
  <!--<script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/bootstrap.min.js"></script>-->
  <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/bootstrap-datetimepicker.min.js"></script>
   <!--<link rel="stylesheet"  href = "<?php echo base_url(); ?>Recursos/css/bootstrap.min.css">-->
   <link rel="stylesheet"  href = "<?php echo base_url(); ?>Recursos/css/bootstrap-datetimepicker.min.css">
	
	
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
  
	<script type="text/javascript">
	    
	    function editar()
	    {
	   //   var data=idbtn.id.split("_");
	   //   var idprestamox=$("#td_idprestamo_"+data[2]).html();
	   //   var idoprestamox=$("#td_idoprestamo_"+data[2]).html();
	   //   var fechaprestamox=$("#td_fechaprestamo_"+data[2]).html();
  		//   var tipoprestamox=$("#td_tipoprestamo_"+data[2]).html();
  		//   var cantidadx=$("#td_cantidad_"+data[2]).html();
  		//   var quienrecibex=$("#td_quienrecibe_"+data[2]).html();
  		//   var fechadevolucionx=$("#td_fechadevolucion_"+data[2]).html();
	    
	   //   $(function() {
	   //       $("#frmDatos").dialog('open');
	   //   })
	      
	     $(function() {
	    $( "#frmDatos" ).dialog({
	      resizable: false,
	      height:400,
	      modal: true,
	      buttons: {
	        "Aceptar Cambios": function() {
	        //	grabarModif();
	          $( "#vnt" ).dialog({
	          		      buttons: {
	       					 "OK": function() {
	          						//window.location="index.php";
	        						}
	          					}
	      			});
	        }
	      }
	    });
	  });
	        
// 	      $.post("../index.php/prestamosc/de",  {id:idprestamo },
// 		  function(data){
// 		     //window.location.href = data.redirect;
// 		  //  alert("Data Loaded: " + data);
// //	window.location = "../index.php/prestamosc/devueltos";
// 		  });
	    }
	    
	</script>
        
    </head>
    <body onload="editar()">
        
                  <div id="vnt" style="display:none" title="Informacion Modificada">
	<p>La informacion se guardo sin problemas</p>
</div>
    <div class="form-horizontal" id="frmDatos" style="display: none"  tittle="Editar prestamo">
      
            <label for="inputPassword" class="col-lg-2 control-label">Fecha prestamo</label>
            <input type="text" id="fecha_prestamo" name="fecha_prestamo">
            
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

   <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Quien recibe</label>
    <div class="col-lg-10">
      
      <select class="form-control" name="lista_usuarios">
          <?php  
          
            //           $length = count($dat[0]);
            // for ($i = 0; $i < $length; $i++) {
            ?>
              <option>
                  <?php // echo $dat[0][$i]; ?>
                  </option>
            <?php
            //}
            ?>
 
</select>
      
    </div>
  </div>

            <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Fecha devolución</label>
    <div class="col-lg-10">
       <input type="text" id="fecha_devolucion" name="fecha_devolucion">
    </div>
  </div>
  
</div>
    </body>
</html>