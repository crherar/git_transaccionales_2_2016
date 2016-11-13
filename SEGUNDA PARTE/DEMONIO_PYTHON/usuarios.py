import json
import monitor
import codigostx
import procesospx
import objs_json
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
		self.objson = objs_json.objs_json()

	def insertar_usuario(self,data):
		self.nombre = data["datos"]['nombre']
		self.apellido = data["datos"]['apellido']
		self.email = data["datos"]['email']
		self.password = data["datos"]['password']
		self.mensaje = str(self.nombre+self.apellido+self.email+self.password)
		respuesta = self.mtx.enviar(self.procpx.insertar_usuario(),self.codtx.insertar_usuario(),"00",self.mensaje)
		return json.dumps({'cabecera':{'formulario':data['cabecera']['formulario'],'id_usuario_logueado':'','email':''},'datos':respuesta})

	def get_usuario_por_id(self,data):
		self.id = data['cabecera']['id_usuario_logueado']
		respuesta = self.mtx.enviar(self.procpx.get_usuario_por_id(),self.codtx.get_usuario_por_id(),"00",str(self.id)).split('-')

		#resp = respuesta.split('-')
		#print "tamanio respuesta: "+str(len(respuesta))
		#print json.loads(respuesta)
		if len(respuesta) > 0:
			return json.dumps({'cabecera':{'formulario':data['cabecera']['formulario'],'id_usuario_logueado':'','email':''},'datos':self.objson.usuarios(respuesta)})
		else:
			return json.dumps({'cabecera':{'formulario':data['cabecera']['formulario'],'id_usuario_logueado':'','email':''},'datos':'02'})

	def actualizar_usuario(self,data):
		self.nombre = data["datos"]['nombre']
		self.apellido = data["datos"]['apellido']
		self.email = data["datos"]['email']
		self.password = data["datos"]['password']
		self.id = data['cabecera']['id_usuario_logueado']
		self.mensaje = str(self.nombre+self.apellido+self.email+self.password+str(self.id).ljust(5))
		respuesta = self.mtx.enviar(self.procpx.actualizar_usuario(),self.codtx.actualizar_usuario(),"00",self.mensaje)
		return json.dumps({'cabecera':{'formulario':data['cabecera']['formulario'],'id_usuario_logueado':'','email':''},'datos':respuesta})

	#def actualizar_usuario(self,data):

	#def actualizar_usuario(data):


	#@staticmethod
	def iniciar_sesion(self,data):
		print 'dentro del metodo login de usuarios'
		print 'data dentro del metodo login de usuarios "%s"' % data
		#datos = json.loads(data)#data.split("-")
		self.email = data["datos"]["email"]
		self.password = data["datos"]["password"]
		mensaje = str(self.email+self.password)
		print 'datos para el monitor: "%s"' % mensaje
		print "codigo tx"+self.codtx.iniciar_sesion()
		respuesta =  self.mtx.enviar(self.procpx.iniciar_sesion(),self.codtx.iniciar_sesion(),"00",mensaje).split('-')
		return json.dumps({'cabecera':{'formulario':data['cabecera']['formulario'],'id_usuario_logueado':respuesta[0],'email':respuesta[1]},'datos':''})
