import socket

class monitor:
	def __init__(self):
		self.socket=socket.socket()
        self.respuesta=""


    def enviar(formulario,nro_tx,aci,datos):
    	preparar_mensaje()
    	mensaje = "TXIN 000"+nro_tx+formulario+aci+datos
    	self.socket.send(mensaje)
    	return socket.recv(2000)

	def preparar_mensaje():
		#self.socket = socket.socket()
		#print "hola mundo"
		#respuesta = ""
		self.socket.connect(("127.0.0.1", 5000))
		#print "hola mundo"
		#socket.connect(("200.14.84.74", 5000))
		self.socket.recv(2000)
		self.socket.send("HOLA MUNDO! 17957132")
		#print socket.recv(1024)
		self.socket.send("DIRPRG /home/alumnos/17957132/")
		#print  socket.recv(1024)
		#self.socket.send("TXIN 000020506loginn00matias@gmail.com                        123       ")
		socket.recv(2000)
		#print "hola mundo"
		#print respuesta		
