		function guardarPrestamos()
	    {

	      $( "#frmDatos" ).dialog({
	      resizable: false,
	      height:"auto",
	      with: "auto",
	      modal: true,
	      
	      //position: "center",
	      buttons: {
	        "Guardar": function() {
        //    grabarModificacionPrestamo(idprestamox,idoprestamox);
        debugger;
            grabarPrestamo();
            $(this).dialog('close');
	          $( "#vnt_guardar" ).dialog({
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
	  
	 }
	
	
	
	   function grabarPrestamo()
	    {
	        
	       var fecha_prestamox = $("#fecha_prestamo").val();
	       var tipo_prestamox =  $("#tipoprestamo").val();
	       var cantidadx = $("#cantidad").val();
	   
	       var fecha_devolucionx = $("#fecha_devolucion").val();
	       var lista = document.getElementById("lista_usuarios");
	       var combo=document.getElementById("lista_usuarios");
	       var quien_recibex = combo.value; 
	       
	        var miurl = sessionStorage.getItem('url_base')+"index.php/prestamosc/guardar";
	        debugger;
	       var postData = {
  		      fecha_prestamo : fecha_prestamox,
  		      tipo_prestamo : tipo_prestamox,
  		      cantidad : cantidadx,
  		      quien_recibe: quien_recibex,
  		      fecha_devolucion :fecha_devolucionx 
  		  };
  		  
  		 var datos_usuarios = '';
  		  	     $.ajax({
                     url: miurl,
                     type: "POST",
                     data: postData,
                    //fecha_prestamo,usuario_prestador, correo_recibidor, tipo_prestamo,cantidad,fecha_devolucion
                     success: function(data) {
                         console.log(data);
                         if(data == "true")
                         {
                         	 debugger;
                         	$.ajax(
                         		{
                         			url: sessionStorage.getItem('url_base')+'index.php/usuariosc/correoDeUsuario',
                         			type: "POST",
                         			data: {quien_recibe:quien_recibex},
                         			
                         			success: function(data){
                         				debugger;
                                        datos_usuarios = JSON.parse(data);       
                           	            sendMailArecibidor(fecha_prestamox,datos_usuarios.nombre,datos_usuarios.correo_recibidor,tipo_prestamox,cantidadx,fecha_devolucionx);
                         		        sendMailAprestador(fecha_prestamox,quien_recibex,datos_usuarios.correo_prestador,tipo_prestamox,cantidadx,fecha_devolucionx);
                         			}
                         		});
                         }
                     }
	         });
	    }


	   function grabarModificacionPrestamo(idprestamo,idoprestamo)
	    {
	        
	       var fecha_prestamo = $("#fecha_prestamo").val();
	       var tipo_prestamo =  $("#tipoprestamo").val();
	       var cantidad = $("#cantidad").val();
	   
	       var fecha_devolucion = $("#fecha_devolucion").val();
	       var lista = document.getElementById("lista_usuarios");
	       var combo=document.getElementById("lista_usuarios");
	       var quien_recibe = combo.value; 
	       
	        var miurl = sessionStorage.getItem('url_base')+"index.php/prestamosc/actualizarPrestamo";
	        
	       var postData = {
  		      idPrestamo : idprestamo,
  		      idOPrestamo : idoprestamo,
  		      fecha_prestamo : fecha_prestamo,
  		      tipo_prestamo : tipo_prestamo,
  		      cantidad : cantidad,
  		      quien_recibe: quien_recibe,
  		      fecha_devolucion :fecha_devolucion 
  		  };
  		//  debugger;
  		  	     $.ajax({
                     url: miurl,
                     type: "POST",
                     data: postData,
                    
                     success: function(data) {
                         console.log(data);
                     }
	             
	         });
	    }
	   
	    function editarPrestamo(idbtn)
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
  		  

  		 
	   var miurl = sessionStorage.getItem('url_base')+"index.php/prestamosc/actualizarPrestamo";
  		  

    var form = $("#formDatos");
	     $(function() {
	    $( "#frmDatos" ).dialog({
	      resizable: false,
	      height:"auto",
	      with: "auto",
	      modal: true,
	      buttons: {
	        "Guardar cambios": function() {
            grabarModificacionPrestamo(idprestamox,idoprestamox);
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
	    
	    
	    function marcarPrestamoDevuelto(idbtn)
	    {
	        //$("#txtRut").val();
	        var data=idbtn.id.split("_");
	        var idprestamo=$("#td_idprestamo_"+data[2]).html();
	        $("#id").val(idprestamo);

            var url = sessionStorage.getItem('url_base')+"index.php/prestamosc/devueltos";
             var postData = {
               'id' : idprestamo
              
             };
             var funcion = function(data){
            //alert(data);
              location.reload();
             //window.location = "<?php echo base_url() ?>index.php/prestamosc";
            		  };
            $.post(url,postData,funcion);		  
	    }
	    
	   function marcarPrestamoPendiente(idbtn)
	    {

	        var data=idbtn.id.split("_");
	        var idprestamo=$("#td_idp_"+data[2]).html();
	        $("#id").val(idprestamo);

            var url = sessionStorage.getItem('url_base')+"index.php/prestamosc/pendientes";
             var postData = {
               'id' : idprestamo
              
             };
             var funcion = function(data){
            //alert(data);
             location.reload();
             //window.location = '<?php echo base_url() ?>'+"index.php/prestamosc/verDevueltos";
             
            		  };
            $.post(url,postData,funcion);	

	    }
	    
	    function eliminarPrestamo(idbtn)
	    {
	        	          $( "#vnteliminar" ).dialog({
	          		      buttons: {
	       					 "SI": function() {
	       					     	      var btn=idbtn.id.split("_");
	                                      var idprestamox=$("#td_idprestamo_"+btn[2]).html();
	                                      var idoprestamox=$("#td_idoprestamo_"+btn[2]).html();
	                                      	       var postData = {
                                                      		      idPrestamo : idprestamox,
                                                      		      idOPrestamo : idoprestamox,

  		                                                          };
  		                                                          
  		                                var miurl = sessionStorage.getItem('url_base')+"index.php/prestamosc/eliminarPrestamo";
  		                                
  		                                  $.ajax({
                                                 url: miurl,
                                                 type: "POST",
                                                 data: postData,
                                                
                                                 success: function(data) {
                                                     console.log(data);
                     }
	             
	         });                        
	                            $(this).dialog('close');
  		                        location.reload();                                  
	       					    // $(this).dialog('close');
	       					     //location.reload();
	       				//	      window.location = "<?php echo base_url() ?>index.php/prestamosc";
	          						//window.location="index.php";
	        						},
	        						
	        				  "NO": function() {
	       					     
	       					     $(this).dialog('close');
	       					     //location.reload();
	       				//	      window.location = "<?php echo base_url() ?>index.php/prestamosc";
	          						//window.location="index.php";
	        						}		
	          					}
	      			});
	    }
	    
	    
	    function cambiarColor(control)
	    {
	        control.fontcolor("red");
	    }
	    
	    function verificaRegistroUsuario()
	    {
	    	$( "#vnt" ).dialog({
	    			      resizable: false,
	      height:400,
	      with: 500,
	      modal: true,
	              buttons: {
	       				  "OK": function() {
	       			       //$(this).dialog('close');
	       				  //     text: "aviso"
	       			     	   location.reload();
	        						}
	          			   }
	      			});
	    }
	    

	 	    

