	  function guardarFeedback()
	  {
	      var clasificacionx = document.getElementById("clasificacion");
	      var comentariox = $("#comentario_prestados").val();
	      
	      var miurl = sessionStorage.getItem('url_base')+"index.php/feedbackc/guardar";
	        
	       var postData = {
  		      clasificacion : clasificacionx.value,
  		      comentario : comentariox
  		  };
  	 
  		  	     $.ajax({
                     url: miurl,
                     type: "POST",
                     data: postData,
                    
                     success: function(data) {
                         
                         console.log(data);
                     }
	             
	         });
	    
	  }
	  
	  
	    function frmRegistro()
	    {
	 //   	  $(function() {
  //  $( "#comentario_prestados" ).resizable({
  //    handles: "se"
  //  });
  //});
  
 
	        
	      $( "#frm_datos_clasificacion_prestados" ).dialog({
	      resizable: false,
	      height:400,
	      with: 1000,
	      modal: true,
	      buttons: {
	        "Guardar": function() {
             guardarFeedback()
            $(this).dialog('close');
	          $( "#vnt_datos_guardados" ).dialog({
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