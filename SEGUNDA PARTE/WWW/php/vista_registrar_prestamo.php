<?php
session_start();
echo "datos: \n";

//$_SESSION["resp"] = "";
//var_dump($_SESSION["resp"]);
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

   <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" />
   <link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />

<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel='stylesheet', href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
  <link rel='stylesheet', type='text/css', href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css'>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/app.css">

<link rel="stylesheet"  href = "../css/bootstrap-datetimepicker.min.css">
 <script type="text/javascript" src="../js/moment.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
    <title></title>
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="vista_registrar_prestamo.php">Nuevo prestamo</a></li>
            <li class="active"><a href="#">Ver prestamos pendientes <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Ver prestamos devueltos</a></li>
            <li><a href="#">Administrar mis objetos</a></li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["email"] ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav>
    <?php
    if(isset($_SESSION["resp"]))
    {
      ?>
      <div class="alert alert-danger">
      <?php echo $_SESSION["resp"]; ?>
      </div>
      <?php
    }
    ?>
         <div class = "col-md-4 remove-float center-block  big-top-space">
           <form action="c_registrar_prestamo.php" method="POST">

             <div class="container">
                 <div class="row">
                     <div class='col-sm-6'>
                         <div class="form-group">
                             <div class='input-group date' id='datetimepicker1'>
                                 <input type='text' class="form-control" />
                                 <span class="input-group-addon">
                                     <span class="glyphicon glyphicon-calendar"></span>
                                 </span>
                             </div>
                         </div>
                     </div>
                     <script type="text/javascript">
                         $(function () {
                             $('#datetimepicker1').datetimepicker();
                         });
                     </script>
                 </div>
             </div>

             <div clas='form-group'>
               <label for="email">Nombre objeto:</label>
               <input class="form-control", type='text', required='true', name='nombre_objeto', placeholder='Nombre objeto',id='nombre_objeto'>
             </div>
             <div class="top-space">
               <input class="btn btn-info" type="submit" name="name" value="Guardar">
             </div>
           </form>
         </div>
  </body>
</html>