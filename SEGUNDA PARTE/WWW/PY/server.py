import socket  
 
# Create a TCP/IP socket  
sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)  
 
# Bind the socket to the port  
server_address = ('localhost', 3000)  
#print 'Starting up on %s port %s' % server_address  
sock.bind(server_address)  
 
# Listen for incoming connections  
sock.listen(5)  
 
while True:  
 # Wait for a connection  
 print 'Esperando para conectarse'  
 connection, client_address = sock.accept()  
 try:  
   print 'Conexion desde: ', client_address  
   # Receive the data in small chunks  
   try:  
     all_data = ''  
     while True:  
       data = ''  
       try:  
         data = connection.recv(16, socket.MSG_DONTWAIT)        
       except:  
         pass  
       if data:  
         all_data += data  
       else:  
         break  
     print 'Received "%s"' % all_data  
     if all_data:    
       # -------------------  
       # Process input data and generate your output info  
       # -------------------  
 
       print '** Sending info to the client **'  
       print info  
       connection.sendall(info)  
 except:  
     break    
 #finally:  
   #try:  
     #connection.close()  
   #except:  
   #  pass  