 
	    function registroClasificacionUsuarios(idbtn)
	    {
	    // 	   $(function() {
			  //  $( "#comentario_recibidor" ).resizable({
			  //    handles: "se"
			  //  });
			  //});	
	    	
	      $( "#frm_datos_clasificacion_usuarios" ).dialog({
	      resizable: false,
	      height:400,
	      with: 500,
	      modal: true,
	      buttons: {
	        "Guardar": function() {
        //    grabarModificacionPrestamo(idprestamox,idoprestamox);
            guardarClasificaciones(idbtn);
            $(this).dialog('close');
	          $( "#vnt" ).dialog({
	          		      buttons: {
	       					 "OK": function() {
	       					     
	       					     $(this).dialog('close');
	       					     debugger;
	       					     location.reload();
	       				//	      window.location = "<?php echo base_url() ?>index.php/prestamosc";
	          						//window.location="index.php";
	        						}
	          					}
	      			});
	        }
	      }
	    });
	  
	 }
	 
	 function guardarClasificaciones(idbtn)
	 {
	      var clasificacionx = document.getElementById("val_clasif_usuarios");
	      var comentariox = $("#comentario_recibidor").val();
	      var btn=idbtn.id.split("_");
	      var aquienx=$("#td_quienrecibe_"+btn[2]).html();
	      
	      
	      var miurl = sessionStorage.getItem('url_base')+"index.php/clasifusuariosc/guardar";
	        
	       var postData = {
  		      clasificacion : clasificacionx.value,
  		      comentario : comentariox,
  		      aquien : aquienx 
  		  };
  	 debugger;
  		  	     $.ajax({
                     url: miurl,
                     type: "POST",
                     data: postData,
                    
                     success: function(data) {
                         
                         console.log(data);
                     }
	             
	         });
	 }
	    