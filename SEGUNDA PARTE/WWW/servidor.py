import socket  
import json 
# Create a TCP/IP socket  
socket_php = socket.socket(socket.AF_INET, socket.SOCK_STREAM)  
 
# Bind the socket to the port  
server_address = ('localhost', 3000)  
#print 'Starting up on %s port %s' % server_address  
socket_php.bind(server_address)  
 
# Listen for incoming connections  
socket_php.listen(10)  
 
while True:  
 # Wait for a connection  
 print 'Esperando para conectarse'  
 #(connection, client_address) = socket_php.accept()  
 connection, client_address = socket_php.accept() 
 datos_cliente = client_address
 print 'Conexion desde: ', client_address
 print 'Puerto cliente: ', datos_cliente[1]  
   # Receive the data in small chunks  
  
 
       
 data = ''  
       
 data = connection.recv(2000,socket.MSG_DONTWAIT)        
 print 'data recibida "%s"' % data
 print 'la direccion del cliente es: '+json.dumps(client_address)#str(connection)#str(client_address)
# socket_php.send(str(int(datos_cliente[1])))
 connection.send("hola desde python")  
 # -------------------  
 # Process input data and generate your output info  
 # -------------------  

 print '** Sending info to the client **'  
  
 #connection.sendall(info)  
