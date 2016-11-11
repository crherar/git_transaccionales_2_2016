<!DOCTYPE html>
<html>
  <head>
    <link rel='stylesheet', href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
  <link rel='stylesheet', type='text/css', href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css'>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/css/app.css">
  </head>
  <body>
    <div class = "col-md-4 remove-float center-block  big-top-space">
      <form action='<?php echo base_url(); ?>index.php/loginc/iniciar_sesion', method='POST'>
        <div clas='form-group'>
          <label for="email">Email</label>
          <input class="form-control" type='text', required='true', name='email', placeholder='email'>
        </div>
        <div>
          <label for="password">Password</label>
          <input class="form-control" type='password', required='true', name='password', placeholder='password'>
        </div>
        <div class="top-space">
          <input class="btn btn-info" type="submit" name="name" value="Iniciar sesión">
        </div>
      </form>
    </div>
  </body>
</html>
