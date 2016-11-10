
        <body id="body">
    
     <div id="vnt"  style="display:none" title="Informacion Modificada">
	<p>La informacion se guardo sin problemas</p>
</div>

     <div id="vnt_guardar"  style="display:none" title="Informacion Guardada">
	<p>La informacion se guardo sin problemas</p>
</div>

     <div id="vnteliminar"  style="display:none" title="Eliminar prestamo">
	<p>¿Seguro que quiere eliminar el prestamo?</p>
</div>


<!--    <div class="form-horizontal" id="frmDatos"  style="display: none"  tittle="Editar prestamo">-->
      
<!--          <div class="form-group">-->
<!--    <label for="inputPassword" class="col-lg-2 control-label">Fecha prestamo</label>-->
<!--    <div class="col-lg-10">-->
<!--       <input type="text" id="fecha_prestamo" name="fecha_prestamo">-->
<!--    </div>-->
<!--  </div>-->
            
            
            
<!--              <div class="form-group">-->
<!--    <label for="inputPassword" class="col-lg-2 control-label">Tipo de prestamo</label>-->
<!--    <div class="col-lg-10">-->
<!--      <input type="text" class="form-control" id="tipoprestamo" name="tipoprestamo" placeholder="Tipo de prestamo">-->
<!--    </div>-->
<!--  </div>-->

<!--  <div class="form-group">-->
<!--    <label for="inputPassword" class="col-lg-2 control-label">Cantidad</label>-->
<!--    <div class="col-lg-10">-->
<!--      <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad">-->
<!--    </div>-->
<!--  </div>-->

<!--   <div class="form-group">-->
<!--    <label for="inputPassword" class="col-lg-2 control-label">Quien recibe</label>-->
<!--    <div class="col-lg-10">-->
      
<!--      <select class="form-control" id="lista_usuarios" name="lista_usuarios">-->
<!--          <?php  
         
           $length = count($dat[0]);
            for ($i = 0; $i < $length; $i++) {
            ?>-->
<!--              <option>-->
<!--                  <?php  echo $dat[0][$i]; ?>-->
<!--                  </option>-->
<!--            <?php
           }
            ?>-->
 
<!--</select>-->
      
<!--    </div>-->
<!--  </div>-->

<!--            <div class="form-group">-->
<!--    <label for="inputPassword" class="col-lg-2 control-label">Fecha devolución</label>-->
<!--    <div class="col-lg-10">-->
<!--       <input type="text" id="fecha_devolucion" name="fecha_devolucion">-->
<!--    </div>-->
<!--  </div>-->
  
<!--</div>  style="display: none" -->

            <!------------------------------>
<div  id="frmDatos" style="display: none"  tittle="Editar prestamo">
    <form >
              <fieldset>
  
    <label for="inputPassword" class="text ui-widget-content ui-corner-all">Fecha prestamo:</label>
       
 <div id="fecha_prestamo" name="fecha_prestamo"></div>
            
            
            
             
    <label for="inputPassword" class="text ui-widget-content ui-corner-all">Tipo de prestamo:</label>
      <input type="text" class="form-control" id="tipoprestamo" name="tipoprestamo" placeholder="Tipo de prestamo">
 

 
    <label for="inputPassword" class="text ui-widget-content ui-corner-all">Cantidad:</label>
      <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad">
 

 
    <label for="inputPassword" class="text ui-widget-content ui-corner-all">Quien recibe:</label>
      <select class="form-control" id="lista_usuarios" name="lista_usuarios">
          <?php  
           //var_dump($dat);
            //$length = count($dat[0]);
             foreach($dat as $d)
             //for ($i = 0; $i < $length; $i++) 
             {
            ?>
              <option>
                  <?php  echo $d; ?>
                  </option>
            <?php
            }
            ?>
</select>
      
   
 

            
      <label for="inputPassword" class="text ui-widget-content ui-corner-all">Fecha devolución:</label>
       <!--<input type="text" id="fecha_devolucion" name="fecha_devolucion">-->
      <div id="fecha_devolucion" name="fecha_devolucion"></div>
 </fieldset>
 </form>
</div>
            <!----------------------------->
             
            <div>
                <center>
                    <button onclick="guardarPrestamos()">Nuevo préstamo</button>
                </center>
            </div>

            
<div class="container">
<!--<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">-->
<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th style="display: none;">idPrestamo</th>
                 <th style="display: none;">idOPrestamo</th>
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
           // var_dump($datos[0]);
           $cont = 1;
           foreach($datos as $data)
           {
               if(($data->total_dias) == 1)
               {
                   
           ?>
           <tr style="background-color:#FF0000" id="tr_<?php echo $cont; ?>">
               <?php 
               }
               else
               {
               ?>
               <tr id="tr_<?php echo $cont; ?>">
               
               <?php 
               }
               ?>
               <td id="td_idprestamo_<?php echo $cont; ?>" style="display: none;"><?php echo $data->idPrestamo; ?></td>
               <td id="td_idoprestamo_<?php echo $cont; ?>" style="display: none;"><?php echo $data->idOPrestamo; ?></td>
                <td id="td_pos_<?php echo $cont; ?>"> <?php echo $cont ?> </td>
               <td id="td_fechaprestamo_<?php echo $cont; ?>"><?php echo $data->fecha_prestamo; ?></td>
               <td id="td_tipoprestamo_<?php echo $cont; ?>"><?php echo $data->tipo_prestamo; ?></td>
               <td id="td_cantidad_<?php echo $cont; ?>"><?php echo $data->cantidad."- ".$data->total_dias; ?></td>
               <td id="td_quienrecibe_<?php echo $cont; ?>"><?php echo $data->quienrecibe; ?></td>
               <td id="td_fechadevolucion_<?php echo $cont; ?>"><?php echo $data->fecha_devolucion; ?></td>
                
               <td>
               <ul>
                   <!--<input id="btn_devuelto_<?php echo $cont; ?>"  type="button" name="devuelto" value="Devuelto" onclick="marcarDevuelto(this)">-->
                   <!--<input id="btn_editar_<?php echo $cont; ?>" type="button" onclick="editar(this)" name="editar" value="Editar" >-->
                   <button id="btn_editar_<?php echo $cont; ?>"  onclick="editarPrestamo(this)">Editar</button>
                   <!--<input id="btn_eliminar_<?php echo $cont; ?>" type="button" name="eliminar" value="Eliminar" >-->
                   
                   
                   <button id="btn_devuelto_<?php echo $cont; ?>" onclick="marcarPrestamoDevuelto(this)">Devuelto</button>
                   
                   <button id="btn_eliminar_<?php echo $cont; ?>"  onclick = "eliminarPrestamo(this)">Eliminar</button>
                   <button id="btn_clasif_<?php echo $cont; ?>"  onclick = "registroClasificacionUsuarios(this)">Clasificar a usuario recibidor</button>
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
 
 <!--</html> -->
 <!--</html> -->
