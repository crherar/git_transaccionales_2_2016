import socket
import json
from pprint import pprint
import time
class monitor:
	def __init__(self):
		self.socket=socket.socket()
		self.respuesta=""


	def enviar(self,formulario,nro_tx,aci,datos):
		self.preparar_mensaje()
		mensaje = "TXIN 000"+nro_tx+formulario+aci+datos
		print "mensaje a enviar al monitor: "+mensaje

		self.socket.send(mensaje)
		resp = str(self.socket.recv(1024))
		print "respuesta del monitor"
		print resp
		print resp[12:]

		#pprint(self.socket.recv(1024))
		self.socket.close()
		return resp[12:]

	def preparar_mensaje(self):
		try:
			print "*****inicio preparacion de mensaje*****"
			#self.socket = socket.socket()
			#print "hola mundo"
			#respuesta = ""
			self.socket.connect(("127.0.0.1", 5000))
		 # print "hola mundo"
			#socket.connect(("200.14.84.74", 5000))
			self.socket.recv(1024)
			self.socket.send("HOLA MUNDO! 17957132")
			print self.socket.recv(1024)
			self.socket.send("DIRPRG /home/alumnos/17957132/transaccionales_2_2016/SEGUNDA_PARTE/DEMONIO_BDD/")

			print self.socket.recv(1024)
			#print "hola mundo"
			#self.socket.send("TXIN 000020506loginn00matias@gmail.com                        123       ")
			#respuesta = self.socket.recv(1024)
			#print "respuesta fin preparar mensaje"
			#print respuesta
			print "******fin preparacion de mensaje*******"
			#print "hola mundo"
			#print respuesta
		except Exception, e:
			print "E"
			print e
