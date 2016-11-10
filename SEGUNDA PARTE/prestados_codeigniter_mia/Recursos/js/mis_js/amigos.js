	    function agregarAmigo(idbtn)
	    {
	        //$("#txtRut").val();
	        var data=idbtn.id.split("_");
	        var idusuario=$("#td_idusuario_"+data[2]).html();
	       // $("#id").val(idprestamo);

            var url = "/index.php/amigosc/guardarAmistad"; //por ajax y metodo post se envia los datos al metodo guardarAmistad del controlador amigosc
             var postData = {
               'id' : idusuario
             };
             var funcion = function(data){
            //alert(data);
             window.location = sessionStorage.getItem('url_base')+"index.php/amigosc";
            		  };
            $.post(url,postData,funcion);		  
	    }