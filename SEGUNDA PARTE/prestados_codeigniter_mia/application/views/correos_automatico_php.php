<!DOCTYPE html>
<html>
    <head>
         <script type="text/javascript" src="https://prestados-ci-matias-matialvarezs.c9.io/Recursos/js/jquery-2.1.4.min.js"></script>
               <script type="text/javascript" src="https://mandrillapp.com/api/docs/js/mandrill.js"></script>
        <script type="text/javascript" src="https://prestados-ci-matias-matialvarezs.c9.io/Recursos/js/mis_js/enviarmail.js"></script>
    </head>
    <body>
        <button onclick= "correosAutomaticos()" id="boton" name="boton">Boton</button>
        <form name="form" action="post">
        <input type="button" value="enviar" onclick= "correosAutomaticos()" id="boton" name="boton"/>
        <input id="check" onclick= "correosAutomaticos()" type="checkbox" name=""/>
        <input onclick= "correosAutomaticos()" type="submit" name="boton"/>
        </form>
    <div id="mensaje">
        
    </div>
    
    </body>
</html>

// <?php
// $to = "matialvarezs@gmail.com";
// $subject = "My subject";
// $txt = "Hello world!";
// $headers = "From: matialvarezs@gmail.com";

// $result = mail($to,$subject,$txt,$headers);
// echo $result;
// ?>