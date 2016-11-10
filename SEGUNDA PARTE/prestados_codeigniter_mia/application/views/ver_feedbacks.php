<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/css/jquery-ui.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.min.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/jquery-ui/jquery-ui.min.js"></script>
     
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Recursos/css/data-tables/jquery.dataTables.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" type="text/css" />
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
                <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" type="text/css" />
         <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/mis_js/feedbacks.js"></script>
        
        	<script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>
    
    </head>
    
    <body>
        
        <ul>
             <li>
                <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                <?php echo " ".$clasificaciones['clasif5'];?>                   
            </li>
            <li>
                <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                <?php echo " ".$clasificaciones['clasif4'];?>      
            </li>            
            <li>
                <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                <?php echo " ".$clasificaciones['clasif3'];?>
            </li>
            <li>
                <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                <?php echo " ".$clasificaciones['clasif2'];?>  
            </li>
            <li>
                <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                <?php echo " ".$clasificaciones['clasif1'];?>
            </li>            
        </ul>
        
        
        <div>
            <center>
                <?php if($id) 
                {
                ?>
                <button onclick = "frmRegistro()">Nuevo Feedback</button>
                <?php 
                } 
                ?>
            </center>
        </div>
<div class="container">
        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <th>Usuario</th>
                <th>Clasificación</th>
                <th>Comentario</th>
            </thead>
            <tbody>
                <?php foreach($data as $dat)
                {
                ?>
                <tr>
                    <td><?php echo $dat->usuario; ?></td>
                    <td>
                    
                    <?php if($dat->clasificacion == 1)
                    {
                    ?>
                            <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                    <?php
                    }
                    ?>
                    
                    <?php if($dat->clasificacion == 2)
                    {
                    ?>
                            <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                            <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                    <?php
                    }
                    ?>
                    
                    <?php if($dat->clasificacion == 3)
                    {
                    ?>
                            <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                            <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                            <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                    <?php
                    }
                    ?>
                    
                    <?php if($dat->clasificacion == 4)
                    {
                    ?>
                            <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                            <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                            <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                            <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                    <?php
                    }
                    ?>
                    
                    <?php if($dat->clasificacion == 5)
                    {
                    ?>
                            <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                            <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                            <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                            <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                            <img src="<?php echo base_url(); ?>Recursos/img/estrella.jpg" >
                    <?php
                    }
                    ?>
               
                    </td>
                    <td><?php echo $dat->comentario; ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
</div>

