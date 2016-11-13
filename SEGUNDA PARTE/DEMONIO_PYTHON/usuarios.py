import json
import monitor
import codigostx
import procesospx
#from monitor import*


class usuarios:

	def __init__(self):
		self.nombre = ""
		self.apellido = ""
		self.email = ""
		self.password = ""
		self.id = 0
		self.mtx = monitor.monitor()
		self.codtx = codigostx.codigostx()
		self.procpx = procesospx.procesospx()

	def insertar_usuario(self,data):
		self.nombre = datos[0]
		self.apellido = datos[1]
		self.email = datos[2]
		self.password = datos[3]
		self.mensaje = str(nombre+apellido+email+password)
		return mtx.enviar(self.procpx.insertar_usuario(),codtx.insertar_usuario(),"00",mensaje)


	#def actualizar_usuario(self,data):

	#def actualizar_usuario(data):


	#@staticmethod
	def iniciar_sesion(self,data):
		print 'dentro del metodo login de usuarios'
		print 'data dentro del metodo login de usuarios "%s"' % data
		datos = data.split("-")
		self.email = datos[0]
		self.password = datos[1]
		mensaje = str(self.email+self.password)
		print 'datos para el monitor: "%s"' % mensaje
		print "codigo tx"+self.codtx.iniciar_sesion()
		return self.mtx.enviar(self.procpx.iniciar_sesion(),self.codtx.iniciar_sesion(),"00",mensaje)
