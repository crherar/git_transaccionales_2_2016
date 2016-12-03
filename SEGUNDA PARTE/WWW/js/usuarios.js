function ver_perfil_usuario_amigo(idbtn)
{
    var data=idbtn.id.split("_");
    var idusuariox=$("#td_idusuario_"+data[2]).html();
    var url = "vista_perfil_usuario_reputaciones.php";
    var postData = {
         'id_usuario_clasificado' : idusuariox
       };
      debugger;
       //debugger;
       var funcion = function(data){
//debugger;
              window.location = localStorage.getItem('base_url')+"php/vista_perfil_usuario_reputaciones.php";
        //      debugger;
            };
    $.post(url,postData,funcion);
}
