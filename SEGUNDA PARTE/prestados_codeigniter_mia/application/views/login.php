<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login, Register form</title>

   
       
       
                   <link rel="stylesheet" href="<?php echo base_url(); ?>Recursos/css/login/normalize.css">

    <link rel='stylesheet prefetch' href= 'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
        <link rel="stylesheet" href="<?php echo base_url(); ?>Recursos/css/login/style.css">
     <!--<script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/misfunciones.js"></script>-->
     <script type="text/javascript" src="https://mandrillapp.com/api/docs/js/mandrill.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/mis_js/enviarmail.js"></script>  
         <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/mis_js/usuarios_fb.js"></script>
          <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/mis_js/loginfacebook.js"></script>
         <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/mis_js/usuarios.js"></script>

    
     
    <!--//   function verificaRegistroUsuario()-->
	   <!--// {-->
	   <!--// 	$( "#vnt" ).dialog({-->
	   <!--// 	// 		      resizable: false,-->
	   <!--//  // height:400,-->
	   <!--//  // with: 500,-->
	   <!--//  // modal: true,-->
	   <!--//           buttons: {-->
	   <!--//    				  "OK": function() {-->
	   <!--//    			       //$(this).dialog('close');-->
	   <!--//    				  //     text: "aviso"-->
	   <!--//    			     	  // location.reload();-->
	   <!--//     						}-->
	   <!--//       			   }-->
	   <!--//   			});-->
	   <!--// }-->
	    
	   <!--// function alerta()-->
	   <!--// {-->
	   <!--//   debugger;-->
	   <!--//  alert("hola"); -->
	   <!--// }-->
       
   <script type="text/javascript">
             
      function guardarUrl()
      {
      sessionStorage.setItem("url_base","<?php echo base_url(); ?>" );
       
      }
     </script>
    
  </head>

  <body onload="guardarUrl()">

   
     <div id="vnt"  style="display:none" title="Informacion guardada">
	<p>Datos guardados correctamente</p>
</div>

     <div id="login_incorrecto" name="login_incorrecto"  style="display:none" title="Datos incorrectos">
	<p>Usuario o contraseña incorrecta</p>
</div>
     <div id="correo_ya_registrado" name="correo_ya_registrado"  style="display:none" title="Datos ya registrados">
	<p>El correo ingresado ya se encuentra registrado en prestados</p>
	     </div>
	     
	     <div id="gracias" name="gracias"  style="display:none" title="Datos guardados">
	<p>Gracias por registrarte en Prestados</p>
</div>

	     <div id="error" name="error"  style="display:none" title="Error al registrar">
	<p>Error al registrarte. Intenta nuevamente o ponerse en contacto con prestados (prestados.app@gmail.com)</p>
</div>
    
	     <div id="aviso_facebook" name="aviso_facebook"  style="display:none" title="En desarrollo">
	<p>Ésta opción de registro se encuentra en desarrollo. Para registrarse, click en Sign Up</p>
</div>    
    
  <div  class="login-box">
    <div class="lb-header">
      <a href="#" class="active" id="login-box-link">Login</a>
      <a href="#" id="signup-box-link">Sign Up</a>
    </div>
    
    <div class="social-login">
     <!-- <a   href="<?php //echo base_url(); ?>index.php/welcome/login">--> 
     <a onclick="LoginFacebook()">
      <!--<a onclick="avisoFacebook()">-->
     <i  class="fa fa-facebook fa-lg"></i> 
    
        Login in with facebook
      </a>
      <a onclick="avisoFacebook()" href="#">
        <i class="fa fa-google-plus fa-lg"></i>
        log in with Google
      </a>
    </div>
   
      <div class="email-login">
      <div class="u-form-group">
        <input  id = "usuario" name="usuario" type="email" placeholder="Email"/>
      </div>
      <div class="u-form-group">
        <input id = "password" name="password" type="password" placeholder="Password"/>
      </div>

      <div class="u-form-group">
        <button onclick="login()" id="btn_login" >Log in</button>
      </div>
      <div class="u-form-group">
        <a href="#" onclick="recuperarContraseña()" class="forgot-password">Forgot password?</a>
      </div>
            <div class="u-form-group">
        <a href="<?php echo base_url()."index.php/feedbackc"; ?>" class="forgot-password">Ver feedbacks</a>
      </div>
    </div>
  
        <div class="email-signup">
        <div class="u-form-group">
        <input id="nombre" name="nombre" type="text" placeholder="Nombre"/>
      </div>
            <div class="u-form-group">
        <input id="apellido" name="apellido" type="text" placeholder="Apellido"/>
      </div>
      <div class="u-form-group">
        <input id="correo" name="correo" type="email" placeholder="Email"/>
      </div>
      <div class="u-form-group">
        <input type="password" placeholder="Password"/>
      </div>
      <div class="u-form-group">
        <input id="reg_password" name="reg_password"  type="password" placeholder="Confirm Password"/>
      </div>
      <div class="u-form-group">
        <button onclick="registrarUsuario()">Sign Up</button>
      </div>
    </div>
  </div>
  <!--<div class="social">-->
  <!--  <a href="javascript:void(0)" class="facebook"></a>-->
  <!--  <a href="javascript:void(0)" class="twitter"></a>-->
  <!--  <a href="javascript:void(0)" class="googleplus"></a>-->
  <!--</div>-->

        <!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>  -->
        <!--<script src="<?php echo base_url(); ?>Recursos/js/login/index.js"></script> -->
        <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/css/jquery-ui.css">-->
        <!--<script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/jquery-2.1.4.min.js"></script>-->
        <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.min.css">-->
        <!--<script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.min.js"></script>-->
  
<!--  </body>-->
<!--</html>-->

