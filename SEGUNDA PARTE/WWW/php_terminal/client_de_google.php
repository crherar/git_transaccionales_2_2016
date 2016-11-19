 <?php  
 error_reporting(E_ALL);  
 $address = gethostbyname('localhost');  
 $service_port = 8000;  
   
 /* Create a TCP/IP socket */  
 $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);  
   
 if ($socket === false) {  
   echo "socket_create() fails: Reason: " . socket_strerror(socket_last_error()) . "<br/>";  
 } else {  
   echo "Socket created.<br/>";  
 }  
   
 echo "Trying connect to '$address' in port '$service_port'...";  
 $result = socket_connect($socket, $address, $service_port);  
 if ($result === false) {  
   echo "socket_connect() fails. Reason: $result " . socket_strerror(socket_last_error($socket)) . "\n";  
 } else {  
   echo "OK.<br/>";  
 }  
   
 $in = "OLAKASE, I'm your POU oversized to fill more than 16 characters";  
 socket_write($socket, $in, strlen($in));  
   
 echo "Receiving...<br/>";  
 $all_out = '';  
 while ($out = socket_read($socket, 2048)) {  
   $all_out .= $out;  
 }  
   
 echo "Received: ". $all_out . "<br/>";  
   
 echo "Closing socket...<br/>";  
 socket_close($socket);  
 echo "Closed.";  
   
 ?>  