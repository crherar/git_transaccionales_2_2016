<!-- <!DOCTYPE html>-->
<!-- <html>-->
<!--         <head>-->
                 
      
<!--        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/css/jquery-ui.css">-->
<!--         <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/jquery-2.1.4.min.js"></script>-->
<!--          <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.min.css">-->
        
<!--         <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.min.js"></script>-->
     

<!--        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/css/data-tables/jquery.dataTables.css">-->
<!--        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" type="text/css" />-->
     
<!--        <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>-->
 

<!--        <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/moment.min.js"></script>-->
<!--        <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/bootstrap-datetimepicker.min.js"></script>-->
   <!--<link rel="stylesheet"  href = "<?php echo base_url(); ?>Recursos/css/bootstrap.min.css">-->
<!--        <link rel="stylesheet"  href = "<?php echo base_url(); ?>Recursos/css/bootstrap-datetimepicker.min.css">-->
   
   


  


	
<!--		  <script>-->
<!--  $(function() {-->
<!--    $( "#fecha_prestamo" ).datepicker();-->
<!--  });-->
<!--  </script>-->
  
<!--    <script>-->
<!--  $(function() {-->
<!--    $( "#fecha_devolucion" ).datepicker();-->
<!--  });-->
<!--  </script>-->

	
	
<!--	<script type="text/javascript" language="javascript" class="init">-->
<!--        $(document).ready(function() {-->
<!--    $('#example').DataTable();-->
<!--} );-->

<!--    </script>-->
    

        
<!--    </head>-->
    
    
        <body>
            <!--<div style="dislay: none;">-->
            
            <!--<form id = "invisible"  method="post" action="<?php echo base_url() ?>index.php/prestamosc/devueltos">-->
            <!--    <input type="text"  style="display:block; " name="id" id ="id" />-->
            <!--</form>-->
            <!--</div>-->
            
            <?php //var_dump($datos); ?>
            <!--------------------------->
            
     <div id="vnt"  style="display:none" title="Informacion Modificada">
	<p>La informacion se guardo sin problemas</p>
</div>
    <div class="form-horizontal" id="frmDatos" style="display: none"  tittle="Editar prestamo">
      
          <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Fecha prestamo</label>
    <div class="col-lg-10">
       <input type="text" id="fecha_prestamo" name="fecha_prestamo">
    </div>
  </div>
            
            
            
              <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Tipo de prestamo</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="nombre" name="tipo_prestamo" placeholder="Tipo de prestamo">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Cantidad</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="apellido" name="cantidad" placeholder="Cantidad">
    </div>
  </div>

   <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Quien recibe</label>
    <div class="col-lg-10">
      
      <select class="form-control" id="lista_usuarios" name="lista_usuarios">
          <?php  
          
            $length = count($dat[0]);
             for ($i = 0; $i < $length; $i++) {
            ?>
              <option>
                  <?php  echo $dat[0][$i]; ?>
                  </option>
            <?php
            }
            ?>
 
</select>
      
    </div>
  </div>

            <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Fecha devolución</label>
    <div class="col-lg-10">
       <input type="text" id="fecha_devolucion" name="fecha_devolucion">
    </div>
  </div>
  
</div>

            
            
            <!--------------------------->
            

            
<div class="container">
<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th style="display: none;">idUsuario</th>
                 <th>N°</th>
                <th>Usuarios</th>
                <th>Es amigo</th>
            </tr>
        </thead>
        <tbody>
           <?php 
            
           $cont = 1;
           foreach($datos as $data)
           {
           ?>
           <tr id="tr_<?php echo $cont; ?>">
               <td id="td_idusuario_<?php echo $cont; ?>" style="display: none;"><?php echo $data['id']; ?></td>
             
                <td id="td_pos_<?php echo $cont; ?>"> <?php echo $cont; ?> </td>
               <td id="td_usuario_<?php echo $cont; ?>"><?php echo $data['nombreusuario']; ?></td>
               <td>
               <ul>
                <?php if($data['esamigo'] == "SI")
               {
               ?>
                 <img style="with: 1px height:1px" src="<?php echo base_url(); ?>Recursos/img/tick.png"></img>
               <?php 
               }
               else 
               {
               ?>
               <button  id="btn_agregaramigo_<?php echo $cont; ?>" onclick="agregarAmigo(this)">Agregar amigo</button>
               <?php 
               }
               ?>
               </ul>
               </td>

           </tr>
           <?php 
           $cont ++;
           }
           ?>
        </tbody>
    </table>
</div>


        
 <!--   </body>-->
 
 <!--</html>-->