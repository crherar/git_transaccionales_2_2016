<!--    <div class="form-horizontal" id="frm_datos_clasificacion_usuarios"  style="display: none"  tittle="Clasificar usuarios">-->
      
<!--   <div class="form-group">-->
<!--    <label for="inputPassword" class="col-lg-2 control-label">Clasificacion</label>-->
<!--    <div class="col-lg-10">-->
      
<!--      <select class="form-control" id="val_clasif_usuarios" name="val_clasif_usuarios">-->
<!--         <option>1</option>-->
<!--         <option>2</option>-->
<!--         <option>3</option>-->
<!--         <option>4</option>-->
<!--         <option>5</option>-->
<!--     </select>-->
      
<!--    </div>-->
<!--  </div>-->

<!-- <div class="form-group">-->
<!--    <label for="inputPassword" class="col-lg-2 control-label">Comentario</label>-->
<!--    <div class="col-lg-10">-->
<!--      <input type="textarea" class="form-control" id="comentario_recibidor" name="comentario_recibidor" placeholder="Tipo de prestamo">-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->


<div style="display: none" id="frm_datos_clasificacion_usuarios" title="Clasificación usuario recibidor">
  <p class="validateTips">Clasifica y comenta sobre el usuario que le hiciste el prestamo.</p>
 
  <form>
    <fieldset>
<div> 
 <label for="text">Clasificación:</label>
      <select class="text ui-widget-content ui-corner-all" id="val_clasif_usuarios" name="val_clasif_usuarios">
         <option>1</option>
         <option>2</option>
         <option>3</option>
         <option>4</option>
         <option>5</option>
     </select>
<div>

      <label for="text">Comentario:</label>
    <textarea id="comentario_recibidor" name ="comentario_recibidor" rows="7" cols="30" ></textarea>
    </fieldset>
  </form>
</div>