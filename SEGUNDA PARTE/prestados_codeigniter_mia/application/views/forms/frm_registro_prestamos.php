<div id="frm_registro_prestamos" style="display:none">

  <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Fecha prestamo</label>
    <div class="col-lg-10">
       <input type="text" id="fecha_prestamo" name="fecha_prestamo">
    </div>
  </div>
  
  
<!-- <div class="container">-->
<!--    <label for="inputPassword" class="col-lg-2 control-label">Fecha prestamo</label>-->
<!--    <div class="row">-->
<!--        <div class='col-sm-6'>-->
<!--            <div class="form-group">-->
<!--                <div class='input-group date' id='fecha_prestamo' >-->
<!--                    <input type='text' class="form-control" name="fecha_prestamo"/>-->
<!--                    <span class="input-group-addon">-->
<!--                        <span class="glyphicon glyphicon-calendar"></span>-->
<!--                    </span>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--    </div>-->
<!--</div>-->


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
  
  <!--  <div class="form-group">-->
  <!--  <label for="inputPassword" class="col-lg-2 control-label">Tipo prestamo</label>-->
  <!--  <div class="col-lg-10">-->
  <!--    <input type="text" class="form-control" id="correo" name="tipo_prestamo" placeholder="Correo">-->
  <!--  </div>-->
  <!--</div>-->
  
    <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Quien recibe</label>
    <div class="col-lg-10">
      
      <select class="form-control" name="lista_usuarios">
          <?php  
          
                      $length = count($dat[0]);
            for ($i = 0; $i < $length; $i++) {
            ?>
              <option>
                  <?php echo $dat[0][$i]; ?>
                  </option>
            <?php
            }
            ?>
 
</select>
      
    </div>
  </div>
      <div style="margin-left:200px">
          
          

            <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Fecha devolución</label>
    <div class="col-lg-10">
       <input type="text" id="fecha_devolucion" name="fecha_devolucion">
    </div>
  </div>
<button class="btn btn-default">Guardar</button>
    
  
    </div>
 
  
  
</div>