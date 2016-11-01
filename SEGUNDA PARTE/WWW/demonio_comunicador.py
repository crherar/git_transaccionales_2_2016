import socket
'''
import sys
sock=socket.socket(socket.AF_INET,socket.SOCK_STREAM)

server_address = ('localhost', 8000)  

sock.bind(server_address)  
sock.listen(5)  

conn,addr =sock.accept()

print (conn,addr)

data=conn.recv(8000)
data=data.decode("utf-8")
sock.close()

'''



socket_php = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
server_address = ('localhost', 80)  
socket_php.bind(server_address)
sock.listen(5) 
while True:
	socket_php.connect(("127.0.0.1",80))
	socket_php.listen()
	mensaje = socket_php.recv(1024)
	#print "hola mundo"
	print str(mensaje)
	socket_php.close()
	#
   	#print "mensaje: "+mensaje+"\n"
   # print "mensaje: "+mensaje+"\n"


def preparar_mensaje():
	
socket = socket.socket()
print "hola mundo"
#respuesta = ""
socket.connect(("127.0.0.1", 5000))
print "hola mundo"
#socket.connect(("200.14.84.74", 5000))
socket.recv(1024)
socket.send("HOLA MUNDO! 17957132")
print socket.recv(1024)
socket.send("DIRPRG /home/alumnos/17957132/")
print  socket.recv(1024)
socket.send("TXIN 000020506loginn00matias@gmail.com123")
respuesta =  socket.recv(1024)
print "hola mundo"
print respuesta
#preparar_mensaje()             

