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
	    
	    
	    function grabarModif(idprestamo,idoprestamo)
	    {
	       var fecha_prestamo = $("#fecha_prestamo").val();
	       var tipo_prestamo =  $("#tipoprestamo").val();
	       var cantidad = $("#cantidad").val();
	   
	       var fecha_devolucion = $("#fecha_devolucion").val();
	       var lista = document.getElementById("lista_usuarios");
	       var combo=document.getElementById("lista_usuarios");
	       var quien_recibe = combo.value; 
	       
	        var miurl = "<?php echo base_url() ?>index.php/prestamosc/actualizarPrestamo";
	        
	       var postData = {
  		      idPrestamo : idprestamo,
  		      idOPrestamo : idoprestamo,
  		      fecha_prestamo : fecha_prestamo,
  		      tipo_prestamo : tipo_prestamo,
  		      cantidad : cantidad,
  		      quien_recibe: quien_recibe,
  		      fecha_devolucion :fecha_devolucion 
  		  };
  		 // debugger;
  		  	     $.ajax({
                     url: miurl,
                     type: "POST",
                     data: postData,
                    
                     success: function(data) {
                         console.log(data);
                     }
	             
	         });
	    }
	    
	    
	    function editar(idbtn)
	    {
	      var btn=idbtn.id.split("_");
	      var idprestamox=$("#td_idprestamo_"+btn[2]).html();
	      var idoprestamox=$("#td_idoprestamo_"+btn[2]).html();
	      var fechaprestamox=$("#td_fechaprestamo_"+btn[2]).html();
  		  var tipoprestamox=$("#td_tipoprestamo_"+btn[2]).html();
  		  var cantidadx=$("#td_cantidad_"+btn[2]).html();
  		  var quienrecibex=$("#td_quienrecibe_"+btn[2]).html();
  		  var fechadevolucionx=$("#td_fechadevolucion_"+btn[2]).html();
  		  
  		  
  		  
  		  $("#fecha_prestamo").val(fechaprestamox);
  		  $("#tipoprestamo").val(tipoprestamox);
  		  $("#cantidad").val(cantidadx);
  		  $("#lista_usuarios").val(quienrecibex);
  		  $("#fecha_devolucion").val(fechadevolucionx);
  		  

  		 
	   var miurl = "/index.php/prestamosc/actualizarPrestamo";
  		  

    var form = $("#formDatos");
	     $(function() {
	    $( "#frmDatos" ).dialog({
	      resizable: false,
	      height:400,
	      with: 500,
	      modal: true,
	      buttons: {
	        "Aceptar Cambios": function() {
            grabarModif(idprestamox,idoprestamox);
            $(this).dialog('close');
	          $( "#vnt" ).dialog({
	          		      buttons: {
	       					 "OK": function() {
	       					     
	       					     $(this).dialog('close');
	       					     location.reload();
	       				//	      window.location = "<?php echo base_url() ?>index.php/prestamosc";
	          						//window.location="index.php";
	        						}
	          					}
	      			});
	        }
	      }
	    });
	  });
	        
	    }
	    
	</script>
	
	
	<script type="text/javascript" language="javascript" class="init">
//         $(document).ready(function() {
//     $('#example').DataTable();
    
// } );
    </script>
                	<script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {
    $('#example').DataTable({
    
                scrollY:        '50vh',
        scrollCollapse: true,
        paging:         true
    });
} );
    </script>
    
       	<script type="text/javascript">
   	
	    function marcarDevuelto(idbtn)
	    {
	        //$("#txtRut").val();
	        var data=idbtn.id.split("_");
	        var idprestamo=$("#td_idprestamo_"+data[2]).html();
	        $("#id").val(idprestamo);

            var url = "/index.php/prestamosc/devueltos";
             var postData = {
               'id' : idprestamo
              
             };
             var funcion = function(data){
            //alert(data);
             window.location = "<?php echo base_url() ?>index.php/prestamosc";
            		  };
            $.post(url,postData,funcion);		  
	    }
	    
	</script>
          <script>
//   $(function() {
//     $( "#tabs" ).tabs({
//       collapsible: true
//     });
//   });
  </script>
  
    <script>
  $(function() {
    $( "#menu" ).menu({
      items: "> :not(.ui-widget-header)"
    });
  });
  </script>
  <style>
  .ui-menu { width: 200px; }
  .ui-widget-header { padding: 0.2em; }
  </style>
  
  
 
  
    </head>