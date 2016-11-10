function sendMailArecibidor(fecha_prestamo,usuario_prestador, correo_recibidor, tipo_prestamo,cantidad,fecha_devolucion){
 //debugger;
  $.ajax({
    type: "POST",
    url: "https://mandrillapp.com/api/1.0/messages/send.json",
    data: {
      'key': 'belyC1dRFISpaWsCHhZ3RA',
      'message': {
        'from_email': 'prestados.app@gmail.com',
        'to': [
          {
            'email': correo_recibidor,
            'name': 'YOUR_RECEIVER_NAME',
            'type': 'to'
          }
        ],
        'subject': 'NUEVO PRESTAMO REALIZADO DE '+usuario_prestador + ' - PRESTADOSWEB',
        'html': 'El usuario <strong>'+usuario_prestador + '</strong> te ha hecho un prestamo con los sigueintes detalles <br> '+
        '<ul>'+
        '<li> Fecha prestamo: ' + fecha_prestamo+'</li>'+
        '<li> Tipo de prestamo: '+tipo_prestamo+'</li>'+
        '<li> Cantidad: '+cantidad+'</li>'+
        '<li> Fecha devolución: '+fecha_devolucion+'</li>'+
        '</ul>'+
        '<br>' 
         + 'En caso que el prestamo no corresponda ponerse en contacto con prestadosweb <br><br><br>'
          
      }
    }
  }).done(function(response) {
   console.log(response); // if you're into that sorta thing
 });
}
 function sendMailAprestador(fecha_prestamo,usuario_recibidor, correo_prestador, tipo_prestamo,cantidad,fecha_devolucion){
// debugger;
  $.ajax({
    type: "POST",
    url: "https://mandrillapp.com/api/1.0/messages/send.json",
    data: {
      'key': 'belyC1dRFISpaWsCHhZ3RA',
      'message': {
        'from_email': 'prestados.app@gmail.com',
        'to': [
          {
            'email': correo_prestador,
            'name': 'YOUR_RECEIVER_NAME',
            'type': 'to'
          }
        ],
        'subject': 'NUEVO PRESTAMO REALIZADO A '+usuario_recibidor + ' - PRESTADOSWEB',
        'html': 'Le has hecho un prestado a <strong>'+usuario_recibidor + '</strong> con los sigueintes detalles <br> '+
        '<ul>'+
        '<li> Fecha prestamo: ' + fecha_prestamo+'</li>'+
        '<li> Tipo de prestamo: '+tipo_prestamo+'</li>'+
        '<li> Cantidad: '+cantidad+'</li>'+
        '<li> Fecha devolución: '+fecha_devolucion+'</li>'+
        '</ul>'+
        '<br>' +
        'Recuerda clasificar al usuario que le hiciste el prestamo una vez cumplida la fecha de vencimiento <br>'+
        'En caso que el prestamo no corresponda ponerse en contacto con prestadosweb <br><br><br>'
          
      }
    }
  }).done(function(response) {
   console.log(response); // if you're into that sorta thing
 });
  //debugger;
}


 function avisoDeRegistro(usuario,correo){
 
  $.ajax({
    type: "POST",
    url: "https://mandrillapp.com/api/1.0/messages/send.json",
    data: {
      'key': 'belyC1dRFISpaWsCHhZ3RA',
      'message': {
        'from_email': 'prestados.app@gmail.com',
        'to': [
          {
            'email': correo,
            'name': 'YOUR_RECEIVER_NAME',
            'type': 'to'
          }
        ],
        'subject': 'REGISTRADO EN PRESTADOSWEB',
        'html': 
        'Hola <strong>'+usuario + '</strong>. Gracias por registrarte en prestadosweb. '+
        '<br>' +
        '<br>' +
        '<br>' +
        'Prestadosweb'
          
      }
    }
  }).done(function(response) {
   console.log(response); // if you're into that sorta thing
 });
  
}



function correosAutomaticos()
{
   
  var miurl = sessionStorage.getItem('url_base')+"index.php/prestamos_pendientesc/todos";
  $.ajax({
    url:miurl,
    type:"POST",
    success:function(data)
    {
         var json = JSON.parse(data);
         for(var i = 0,length = json.length;i<length;i++)
         {
           if(json[i].total_dias>0)
           {
              enviarCorreosAutomaticos(json[i].recibidor,json[i].prestador,json[i].correo_recibidor,json[i].fecha_prestamo,json[i].fecha_devolucion,json[i].tipo_prestamo,json[i].cantidad,json[i].total_dias);
              break;
          //   debugger;
           }//console.log(json[i]);
         }
    }
  });
}
function enviarCorreosAutomaticos(nombre_recibidor,nombre_prestador,correo_recibidor,fecha_prestamo,fecha_devolucion,tipo_prestamo,cantidad,total_dias)
{
  $.ajax({
    type: "POST",
    url: "https://mandrillapp.com/api/1.0/messages/send.json",
    data: {
      'key': 'belyC1dRFISpaWsCHhZ3RA',
      'message': {
        'from_email': 'prestados.app@gmail.com',
        'to': [
          {
            'email': 'matialvarezs@gmail.com',
            'name': 'YOUR_RECEIVER_NAME',
            'type': 'to'
          }
        ],
        'subject': 'RECORDATORIO DEVOLUCION PRÉSTAMO - PRESTADOSWEB',
        'html': 
         'Hola '+nombre_recibidor+': <br>'+
         'Te recordamos que <strong>'+nombre_prestador + '</strong> te ha hecho un prestamo con los sigueintes detalles <br> '+
        '<ul>'+
        '<li> Fecha prestamo: ' + fecha_prestamo+'</li>'+
        '<li> Tipo de prestamo: '+tipo_prestamo+'</li>'+
        '<li> Cantidad: '+cantidad+'</li>'+
        '<li> Fecha devolución: '+fecha_devolucion+'</li>'+
        '</ul>'+
        '<br>' + 
        'Este prestamo vence en <strong>'+' '+total_dias +' días <br>'+ '</strong>'+
        'En caso que el prestamo no corresponda ponerse en contacto con prestadosweb <br><br><br>' 
          
      }
    }
  }).done(function(response) {
   console.log(response);
   
      //var printContents = document.getElementById("mensaje").innerHTML;
     //var originalContents = document.body.innerHTML;

     //document.body.innerHTML = printContents;

    // window.print();

     document.getElementById("mensaje").innerHTML += response[0].status;//JSON.parse(response);
 //  document.getElementById("mensaje").innerText += JSON.parse(response);
   // if you're into that sorta thing
 });
}