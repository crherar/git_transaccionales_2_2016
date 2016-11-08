import socket  
import json 
import usuarios
# Create a TCP/IP socket  
socket_php = socket.socket(socket.AF_INET, socket.SOCK_STREAM)  
 
# Bind the socket to the port  
server_address = ('localhost', 3000)  
#print 'Starting up on %s port %s' % server_address  
socket_php.bind(server_address)  
 
# Listen for incoming connections  
socket_php.listen(10)  
usr = usuarios.usuarios()
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
 respuesta_php = ''     
 data = connection.recv(2000,socket.MSG_DONTWAIT).split('|')
 dmx = data[1]

 print 'data recibida "%s"' % data
 if data[0] == "loginn":
 	respuesta_php = usr.login(dmx)
 	print "respuesta final "+respuesta_php
 	#print "la respuesta de login es: "+str(usr.login(data[1]))
 
 print 'la direccion del cliente es: '+json.dumps(client_address)#str(connection)#str(client_address)
# socket_php.send(str(int(datos_cliente[1])))
 connection.send('hola desde python cliente: "%s"'%datos_cliente[1]+ "y la respuesta de la operacion es: "+respuesta_php)  
 # -------------------  
 # Process input data and generate your output info  
 # -------------------  

 print '** Sending info to the client **'  
  
 #connection.sendall(info)  
