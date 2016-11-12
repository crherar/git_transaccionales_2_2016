import socket

socket = socket.socket()
print "hola mundo"
#respuesta = ""
socket.connect(("127.0.0.1", 5000))
print "hola mundo"
#socket.connect(("200.14.84.74", 5000))
socket.recv(1024)
socket.send("HOLA MUNDO! 17957132")
print socket.recv(1024)
socket.send("DIRPRG /home/alumnos/17957132/transaccionales_2_2016/SEGUNDA_PARTE/DEMONIO_BDD/")
print  socket.recv(1024)
#socket.send("TXIN 000020506loginn00matias@gmail.com                        123       ")
socket.send("TXIN 000020510verami009")
respuesta =  socket.recv(1024)
print "hola mundo"
print respuesta
