<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
              
      <!--'prestador' => string 'matias ' (length=7)-->
      <!--'fecha_prestamo' => string '2015-10-16 00:00:00' (length=19)-->
      <!--'fecha_devolucion' => string '2015-10-31 00:00:00' (length=19)-->
      <!--'tipo_prestamo' => string 'cosas' (length=5)-->
      <!--'cantidad' => string '20' (length=2)-->
      <!--'recibidor' => string 'matias ' (length=7)-->
        
        <table>
            <thead>
                <th>Prestador</th>
                <th>Fecha prestamo</th>
                <th>Fecha devolucion</th>
                <th>tipo prestamo</th>
                <th>cantidad</th>
                <th>recibidor</th>
                <th>correo prestador</th>
                <th>correo recibidor</th>
                <th>total dias</th>
            </thead>
            <?php 
            foreach($datas as $dat)
            {
            ?>
            <tr>
         
                <td><?php echo $dat['prestador']; ?></td>   
                <td><?php echo $dat['fecha_prestamo']; ?></td>  
                <td><?php echo $dat['fecha_devolucion']; ?></td>                  
                <td><?php echo $dat['tipo_prestamo']; ?></td>   
                <td><?php echo $dat['cantidad']; ?></td>  
                <td><?php echo $dat['recibidor']; ?></td>    
                <td><?php echo $dat['correo_prestador']; ?></td>   
                <td><?php echo $dat['correo_recibidor']; ?></td>   
                <td><?php echo $dat['total_dias']; ?></td>   
            </tr>
            <?php 
            }
            ?>
        </table>
        
    </body>
</html>