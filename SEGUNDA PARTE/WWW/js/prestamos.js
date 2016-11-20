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
