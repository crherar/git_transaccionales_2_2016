function agregar_amigo(idbtn)
{
    //$("#txtRut").val();
    var data=idbtn.id.split("_");
    var idusuariox=$("#td_idusuario_"+data[2]).html();
//    $("#id").val(idprestamo);

      var url = localStorage.getItem('base_url')+"php/c_registrar_amigo.php";

       var postData = {
         'id_amigo' : idusuariox

       };
       //debugger;
       var funcion = function(data){
           if(data == "01")
           {
               alert("Amigo agregado correctamente");
               window.location = localStorage.getItem('base_url')+"php/c_ver_usuarios_registrados.php";
           }
      //alert(data);
     // debugger;
        //window.location = localStorage.getItem('base_url')+"php/c_ver_amigos.php";
       //window.location = "<?php echo base_url() ?>index.php/prestamosc";
            };
      $.post(url,postData,funcion);
}


function agregar_reputacion(idbtn)
{
    //$("#txtRut").val();
    var data=idbtn.id.split("_");
    var idusuariox=$("#td_idamigo_"+data[2]).html();
//    $("#id").val(idprestamo);

      var url = localStorage.getItem('base_url')+"php/c_get_usuario_por_id_reputacion.php";

       var postData = {
         'id_amigo' : idusuariox

       };
      // debugger;
       //debugger;
       var funcion = function(data){
        //   if(data == "01")
         //  {
        // debugger;
             //  alert("Amigo agregado correctamente");
               window.location = localStorage.getItem('base_url')+"php/vista_registrar_reputacion.php";
         //  }
      //alert(data);
     // debugger;
        //window.location = localStorage.getItem('base_url')+"php/c_ver_amigos.php";
       //window.location = "<?php echo base_url() ?>index.php/prestamosc";
            };
      $.post(url,postData,funcion);
}


function get_amigo_eliminar(idbtn)
{
  $( "#vnteliminar" ).dialog({
  buttons: {
"SI": function() {
          var btn=idbtn.id.split("_");
                    var idamistadx=$("#td_idamistad_"+btn[2]).html();
                      console.log(idamistadx);
                             var postData = {
                                            id_amistad : idamistadx

                                          };
                    $.ajax({
                             url: "c_eliminar_amigo.php",
                             type: "POST",
                             data: postData,

                             success: function(data) {
                              // debugger;
                               console.log(data);
                               if(data == "01")
                               {
                              // $(this).dialog('close');
                               window.location = localStorage.getItem('base_url')+"php/c_ver_mis_amigos.php";

                               }

                                if(data == "02")
                                {
                                  alert("error al eliminar");
                                //  $(this).dialog("close");
                                }
                              }

});
          //$(this).dialog('close');
          window.location = localStorage.getItem('base_url')+"php/c_ver_mis_amigos.php";
          //location.reload();

  },

"NO": function() {

   $(this).dialog('close');

  }
  }
});
}
