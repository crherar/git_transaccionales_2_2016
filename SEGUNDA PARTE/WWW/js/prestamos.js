function get_prestamo_editar(idbtn)
{
  console.log(idbtn.id);
  var btn = idbtn.id.split('_');
  console.log(btn[2]);
  var idprestamox = $("#td_idprestamo_"+btn[2]).html();
  console.log(idprestamox);

  $.ajax({
    url: "c_get_prestamo_por_id.php",
    type: "POST",
    data:{id_prestamo:idprestamox}
    ,
    success: function(data){
      console.log(data);
      //debugger;
      if(data != "02")
        window.location = localStorage.getItem('base_url')+"php/vista_actualizar_prestamo.php";
    }
  });
}



function marcarPrestamoDevuelto(idbtn)
{
    //$("#txtRut").val();
    var data=idbtn.id.split("_");
    var idprestamo=$("#td_idprestamo_"+data[2]).html();
    $("#id").val(idprestamo);

      var url = localStorage.getItem('base_url')+"php/c_marcar_prestamo_como_devuelto.php";

       var postData = {
         'id_prestamo' : idprestamo

       };
       var funcion = function(data){
      //alert(data);
        window.location = localStorage.getItem('base_url')+"php/c_ver_prestamos_pendientes.php";
       //window.location = "<?php echo base_url() ?>index.php/prestamosc";
            };
      $.post(url,postData,funcion);
}

function marcarPrestamoPendiente(idbtn)
{

    var data=idbtn.id.split("_");
    var idprestamo=$("#td_idprestamo_"+data[2]).html();
    $("#id").val(idprestamo);
        //debugger;
      var url = localStorage.getItem('base_url')+"php/c_marcar_prestamo_como_pendiente.php";
       var postData = {
         'id_prestamo' : idprestamo

       };
       var funcion = function(data){
      //alert(data);
       window.location = localStorage.getItem('base_url')+"php/c_ver_prestamos_devueltos.php";
       //window.location = '<?php echo base_url() ?>'+"index.php/prestamosc/verDevueltos";

            };
      $.post(url,postData,funcion);

}


function get_prestamo_eliminar(idbtn)
{
  $( "#vnteliminar" ).dialog({
  buttons: {
"SI": function() {
          var btn=idbtn.id.split("_");
                    var idprestamox=$("#td_idprestamo_"+btn[2]).html();
                      console.log(idprestamox);
                             var postData = {
                                            id_prestamo : idprestamox

                                            };



                    $.ajax({
                             url: "c_eliminar_prestamo.php",
                             type: "POST",
                             data: postData,

                             success: function(data) {
                              // debugger;
                               console.log(data);
                               if(data == "01")
                               {
                               $(this).dialog('close');
                               window.location = localStorage.getItem('base_url')+"php/c_ver_prestamos_pendientes.php";

                               }

                                if(data == "02")
                                {
                                  alert("error al eliminar");
                                  $(this).dialog("close");
                                }
                              }

});
          //$(this).dialog('close');
          window.location = localStorage.getItem('base_url')+"php/c_ver_prestamos_pendientes.php";
          //location.reload();

  },

"NO": function() {

   $(this).dialog('close');

  }
  }
});
}
