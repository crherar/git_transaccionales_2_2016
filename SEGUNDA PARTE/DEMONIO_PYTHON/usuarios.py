import json
import monitor
#from monitor import*


class usuarios:

	def __init__(self):
		self.nombre = ""
		self.apellido = ""
		self.email = ""
		self.password = ""
		self.mtx = monitor.monitor()


	def insertar_usuario(data):
		self.nombre = datos[0]
		self.apellido = datos[1]
		self.email = datos[2]
		self.password = datos[3]
		self.mensaje = str(nombre+apellido+email+password)		
		return monitor.enviar("regusr","123456","00",mensaje)

	#def actualizar_usuario(data):


	#@staticmethod
	def login(self,data):
		print 'dentro del metodo login de usuarios'
		print 'data dentro del metodo login de usuarios "%s"' % data
		datos = data.split("-")
		self.email = datos[0]
		self.password = datos[1]
		self.mensaje = str(self.email+self.password)
		print 'datos para el monitor: "%s"' % mensaje
		return self.mtx.enviar("loginn","020506","00",mensaje)
		#return ""