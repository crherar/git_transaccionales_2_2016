
function get_reputacion_editar(idbtn)
{
  console.log(idbtn.id);
  var btn = idbtn.id.split('_');
  console.log(btn[2]);
  var idreputacionx = $("#td_idreputacion_"+btn[2]).html();
  console.log(idreputacionx);
console.log('get_reputacion_EDITADOR');
  $.ajax({
    url: "c_get_reputacion_por_id.php",
    type: "POST",
    data:{id_reputacion:idreputacionx}
    ,
    success: function(data){
      console.log(data);
      if(data != "02")
        window.location = localStorage.getItem('base_url')+"php/vista_actualizar_reputacion.php";
    }
  });
}


function get_reputacion_eliminar(idbtn)
{
  $( "#vnteliminar" ).dialog({
  buttons: {
"SI": function() {
          var btn=idbtn.id.split("_");
                    var idreputacionx=$("#td_idreputacion_"+btn[2]).html();
                      console.log(idreputacionx);
                             var postData = {
                                            id_reputacion : idreputacionx
                                          };
                    $.ajax({
                             url: "c_eliminar_reputacion.php",
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
  },

"NO": function() {

   $(this).dialog('close');

  }
  }
});
}
