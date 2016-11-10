function loginFB(usuariox)
{
 
 

    var postData = {
        usuario:usuariox
    };
    
    var miurl = sessionStorage.getItem('url_base')+"index.php/loginc/loginFacebook";
    var respuesta = "";

    $.ajax({
          url:miurl,        
          type: "POST",
          data:postData,
          //async: false,
          success:function(data)
          {
              console.log(data);
             
              if(data == 1)
              {
                  location.href = sessionStorage.getItem('url_base')+"index.php/prestamosc";
              }
              else
              {
                  
                 $( "#login_incorrecto" ).dialog({
                                     modal: true,
	          		                 buttons: {
            	       					 "OK": function() {
            	       					     $("#usuario").val("");
            	       					     $("#password").val("");
            	       					     $(this).dialog('close');
            	       					     location.reload();
            	       					     
            	        						}
            	          					}
	      			});
              }
          }
          });
 
}


function registrarUsuarioConFacebook(nombrex,correox)
{
   
    var apellidox = "";
   
    var passwordx = "";
    
    var postData = {
        nombre:nombrex,
        apellido:apellidox,
        correo:correox,
        password:passwordx
    };
  
    var miurl = sessionStorage.getItem('url_base')+"index.php/usuariosc/guardar";
    var respuesta = "";

    $.ajax({
          url:miurl,        
          type: "POST",
          data:postData,
          //async: false,
          success:function(data)
          {
           
              if(data == "ya_registrado")
              {
                  loginFB(correox); 
              }
              if(data == "ok" )
              {
                   
                 $( "#gracias" ).dialog({
                                     modal: true,
	          		                 buttons: {
            	       					 "OK": function() {
            	       					     $("#usuario").val("");
            	       					     $("#password").val("");
            	       					     avisoDeRegistro(nombrex,correox);
            	       					     $(this).dialog('close');
            	       					     loginFB(correox); 
            	       					     
            	        						}
            	          					}
	      			});
              }
              if(data == "error")
              {
                  
                 $( "#error" ).dialog({
                                     modal: true,
	          		                 buttons: {
            	       					 "OK": function() {
            	       					     $("#usuario").val("");
            	       					     $("#password").val("");
            	       					     $(this).dialog('close');
            	       					     location.reload();
            	       					     
            	        						}
            	          					}
	      			});
              }              
          }
          });
}