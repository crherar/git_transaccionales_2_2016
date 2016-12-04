
function get_reputacion_editar(idbtn)
{
  console.log(idbtn.id);
  var btn = idbtn.id.split('_');
  console.log(btn[2]);
  var idreputacionx = $("#td_idreputacion_"+btn[2]).html();
  console.log(idreputacionx);

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
