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
		self.nombre = data['nombre']
		self.apellido = data['apellido']
		self.email = data['email']
		self.password = data['password']
		self.mensaje = str(self.nombre+self.apellido+self.email+self.password)
		return self.mtx.enviar(self.procpx.insertar_usuario(),self.codtx.insertar_usuario(),"00",self.mensaje)


	#def actualizar_usuario(self,data):

	#def actualizar_usuario(data):


	#@staticmethod
	def iniciar_sesion(self,data):
		print 'dentro del metodo login de usuarios'
		print 'data dentro del metodo login de usuarios "%s"' % data
		#datos = json.loads(data)#data.split("-")
		self.email = data["email"]
		self.password = data["password"]
		mensaje = str(self.email+self.password)
		print 'datos para el monitor: "%s"' % mensaje
		print "codigo tx"+self.codtx.iniciar_sesion()
		return self.mtx.enviar(self.procpx.iniciar_sesion(),self.codtx.iniciar_sesion(),"00",mensaje)
