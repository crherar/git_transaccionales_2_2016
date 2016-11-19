
function get_objeto_editar(idbtn)
{
  console.log(idbtn.id);
  var btn = idbtn.id.split('_');
  console.log(btn[2]);
  var idobjetox = $("#td_idobjeto_"+btn[2]).html();
  console.log(idobjetox);

  $.ajax({
    url: "c_get_objeto_por_id.php",
    type: "POST",
    data:{id_objeto:idobjetox}
    ,
    success: function(data){
      console.log(data);
      if(data != "02")
        window.location = localStorage.getItem('base_url')+"php/vista_actualizar_objeto.php";
    }
  });
}

function get_objeto_eliminar(idbtn)
{

}
