<!-- <!DOCTYPE html>-->
<!-- <html>-->
<!--    <head>-->
<!--        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/css/jquery-ui.css">-->
<!--        <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/jquery-2.1.4.min.js"></script>-->
<!--        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.min.css">-->
<!--        <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.min.js"></script>-->
     
<!--        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/css/data-tables/jquery.dataTables.css">-->
<!--        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" type="text/css" />-->
<!--        <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>-->
              
<!--                      <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" type="text/css" />-->
<!--         <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css" type="text/css" />-->
              
<!--              <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/misfunciones.js"></script>-->
    <!-- DataTables CSS -->


<!--   	<script type="text/javascript">-->
<!--	    function marcarPendiente(idbtn)-->
<!--	    {-->

<!--	        var data=idbtn.id.split("_");-->
<!--	        var idprestamo=$("#td_idp_"+data[2]).html();-->
<!--	        $("#id").val(idprestamo);-->

<!--            var url = "/index.php/prestamosc/pendientes";-->
<!--             var postData = {-->
<!--               'id' : idprestamo-->
              
<!--             };-->
<!--             var funcion = function(data){-->
<!--            alert(data); -->
<!--             window.location = "<?php echo base_url() ?>index.php/prestamosc/verDevueltos";-->
<!--            		  };-->
<!--            $.post(url,postData,funcion);	-->

<!--	    }-->
	    
<!--	</script>-->
	
<!--	<script type="text/javascript" language="javascript" class="init">-->
<!--        $(document).ready(function() {-->
<!--    $('#example').DataTable();-->
<!--} );-->
<!--    </script>-->
    
<!--    </head>-->
        <body>

<div class="container">
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th style="display: none;">idPrestamo</th>
                <th>N°</th>
                <th>Fecha prestamo</th>
                <th>Tipo de prestamo</th>
                <th>Cantidad</th>
                <th>Quien recibe el prestamo</th>
                <th>Fecha devolucion</th>
               
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
           <?php 
            
           $cont = 1;
           foreach($datos as $data)
           {
           ?>
           <tr id="tr_<?php echo $cont; ?>">
               <td id="td_idp_<?php echo $cont; ?>" style="display: none;"><?php echo $data->idPrestamo; ?></td>
                <td id="td_pos_<?php echo $cont; ?>"> <?php echo $cont ?> </td>
               <td><?php echo $data->fecha_prestamo; ?></td>
               <td><?php echo $data->tipo_prestamo; ?></td>
               <td><?php echo $data->cantidad; ?></td>
               <td><?php echo $data->quienrecibe; ?></td>
               <td><?php echo $data->fecha_devolucion; ?></td>
                
               <td>
               <ul>
                   <button id="btn_devuelto_<?php echo $cont; ?>" onclick="marcarPrestamoPendiente(this)">Pendiente</button>
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