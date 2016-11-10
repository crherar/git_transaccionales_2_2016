// function validar(usuariox,passwordx)
// {
//      var miurl = "/index.php/loginc/login";
//          var postData = {
//         usuario:usuariox,
//         passwordx:passwordx
//     };
//     var respuesta = "";
    
//      $.ajax({
//           url:miurl,        
//           type: "POST",
//           data:postData,
//           success:function(data)
//           {
//               //console.log(data);
//              //   debugger;
//              //  alert(data);
//               respuesta = data;
//           }
//           });
//           debugger;
//          //  alert(respuesta);
           
//          //  return respuesta;
// }



function registrarUsuario()
{
    var nombrex = $("#nombre").val();
    var apellidox = $("#apellido").val();
    var correox = $("#correo").val();
    var passwordx = $("#reg_password").val();
    
    var postData = {
        nombre:nombrex,
        apellido:apellidox,
        correo:correox,
        password:passwordx
    };
    debugger;
    var miurl = "/index.php/usuariosc/guardar ";
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
                 $( "#correo_ya_registrado" ).dialog({
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
              if(data == "ok")
              {
                   
                 $( "#gracias" ).dialog({
                                     modal: true,
	          		                 buttons: {
            	       					 "OK": function() {
            	       					     $("#usuario").val("");
            	       					     $("#password").val("");
            	       					     avisoDeRegistro(nombrex+" "+apellidox,correox);
            	       					     $(this).dialog('close');
            	       					     location.reload();
            	       					     
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

function login()
{
 
    var usuariox = $("#usuario").val();
    var passwordx = $("#password").val();
    
    var postData = {
        usuario:usuariox,
        password:passwordx
    };
    
    var miurl = sessionStorage.getItem('url_base')+"index.php/loginc/login";
    var respuesta = "";
    var html_pagina = "";
   
    $.ajax({
          url:miurl,        
          type: "POST",
          data:postData,
          //async: false,
          success:function(data)
          {
              var res = JSON.parse(data);
              debugger;
              if(res.respuesta == 1)
              {
                //   sessionStorage.setItem("id_usuario_logueado",res.id);
                //   var miurl = sessionStorage.getItem('url_base')+"index.php/prestamosc";
                //   postData = {id_usuario_log:res.id};
                //   $.post(miurl,
                //   postData,
                //   function(data){
                //       location.href = sessionStorage.getItem('url_base')+"index.php/prestamosc";
                //      //debugger;
                //      //$("#div").html(data);
                //      //html_pagina = data.html();
                //      //document.write(html_pagina);  
                //       //var tabla = data.getElementById("example");
                //       //console.log(tabla);
                      
                //   }
                //   );
                 // debugger;
                  //location.href = sessionStorage.getItem('url_base')+"index.php/prestamosc";
                // document.write(html_pagina);
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

// function verificar(mensaje)
// {
//     if(mensaje == "Usuario o contraseña incorrecta" || mensaje == "Correo ya registrado")
//         alert(mensaje);
        
//     if(mensaje == "Correo ya registrado")
//     {
//                          $( "#login_incorrecto" ).dialog({
// 	          		                 buttons: {
//             	       					 "OK": function() {
//             	       					     $("#usuario").val("");
//             	       					     $("#password").val("");
//             	       					     $(this).dialog('close');
//             	       					     location.reload();
            	       					     
//             	       				//	      window.location = "<?php echo base_url() ?>index.php/prestamosc";
//             	          						//window.location="index.php";
//             	        						}
//             	          					}
// 	      			});
//     }    
//         //              $("#login_incorrecto").dialog({
// 	       //   		                 buttons: {
//         //     	       					 "OK": function() {
            	       			 
//         //     	       					     $(this).dialog('close');
//         //     	       					     location.reload();
            	       					     
//         //     	       				//	      window.location = "<?php echo base_url() ?>index.php/prestamosc";
//         //     	          						//window.location="index.php";
//         //     	        						}
//         //     	          					}
// 	      	// 		});
// }

 var actualizaContraseña = function ()
{
    var resp = "";
    var emailx = $("#recup_email").val();
    var passwordx = $("#recup_password").val();
    
    var miurl = sessionStorage.getItem('url_base')+"index.php/usuariosc/actualizarContrasenia";
    
    var postData = {
        email:emailx,
        password:passwordx
    };
   
    $.ajax({
        url:miurl,
        type: "POST",
        data:postData,
        success:function(data)
        {
            console.log(data);
  
            if(data == "ok")
            {
        	          $( "#recup_pass_ok" ).dialog({
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
                    
            if(data == "error")
            {
        	          $( "#error_recup_pass" ).dialog({
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
     
    //return resp;
    //debugger;
}

function recuperarContraseña()
{	      
    $( "#frm_recuperar_contrasenia" ).dialog({
	      resizable: false,
	      height:400,
	      with: 1000,
	      modal: true,
	      buttons: {
        	        "Guardar": function() {
                    actualizaContraseña();
                  
                    $(this).dialog('close');

        	     }
	           }
	    });
    
}

function avisoFacebook()
{
                     $( "#aviso_facebook" ).dialog({
                                     modal: true,
	          		                 buttons: {
            	       					 "OK": function() {
            	       					     $(this).dialog('close');
            	       					     location.reload();
            	       					     
            	        						}
            	          					}
	      			});
}


function cerrarSesionPrestados()
{ 
    var miurl = sessionStorage.getItem('url_base')+"index.php/usuariosc/cerrarSesionPrestados";
    
    $.post(miurl,function(data){
        LogoutFacebook();
        var url_principal = sessionStorage.getItem('url_base');
        sessionStorage.clear();
        location.href = url_principal;
    })
}