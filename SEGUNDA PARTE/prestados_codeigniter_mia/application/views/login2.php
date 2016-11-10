<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login, Register form</title>
   

   
            <link rel="stylesheet" href="<?php echo base_url(); ?>Recursos/css/login/normalize.css">

    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

        <link rel="stylesheet" href="<?php echo base_url(); ?>Recursos/css/login/style.css">
        



    
    
    
  </head>

  <body>

    
  <div class="login-box">
    <div class="lb-header">
      <a href="#" class="active" id="login-box-link">Login</a>
      <a href="#" id="signup-box-link">Sign Up</a>
    </div>
    <div class="social-login">
      <a href="#">
        <i class="fa fa-facebook fa-lg"></i>
        Login in with facebook
      </a>
      <a href="#">
        <i class="fa fa-google-plus fa-lg"></i>
        log in with Google
      </a>
    </div>
   
    <form  class="email-login" method="post" action=<?php echo base_url()."index.php/loginc/login"; ?> >
      <div class="u-form-group">
        <input name="usuario" type="email" placeholder="Email"/>
      </div>
      <div class="u-form-group">
        <input name="password" type="password" placeholder="Password"/>
      </div>
      <div class="u-form-group">
        <button>Log in</button>
      </div>
      <div class="u-form-group">
        <a href="#" class="forgot-password">Forgot password?</a>
      </div>
    </form>
  
    <form class="email-signup" method="post" action=<?php echo base_url()."index.php/usuariosc/guardar"; ?>>
        <div class="u-form-group">
        <input id="nombre" name="nombre" type="email" placeholder="Nombre"/>
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
        <input id="passowrd" name="passowrd"  type="password" placeholder="Confirm Password"/>
      </div>
      <div class="u-form-group">
        <button>Sign Up</button>
      </div>
    </form>
  </div>


    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>  
          <script src="<?php echo base_url(); ?>Recursos/js/login/index.js"></script> 
  
    
  </body>
</html>
