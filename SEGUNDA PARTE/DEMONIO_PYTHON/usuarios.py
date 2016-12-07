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
		return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})

	def get_usuario_por_id(self,data):
		self.id = int(data['datos']['id_usuario'])
		respuesta = self.mtx.enviar(self.procpx.get_usuario_por_id(),self.codtx.get_usuario_por_id(),"00",str(self.id)).split('-')

		#resp = respuesta.split('-')
		#print "tamanio respuesta: "+str(len(respuesta))
		#print json.loads(respuesta)
		if len(respuesta) > 0:
			return json.dumps({'cabecera':data["cabecera"],'datos':self.objson.usuario(respuesta)})
		else:
			return json.dumps({'cabecera':data["cabecera"],'datos':'02'})

	def get_usuario_por_id2(self,id_usuario):
		#self.id = int(data['datos']['id_usuario'])
		respuesta = self.mtx.enviar(self.procpx.get_usuario_por_id(),self.codtx.get_usuario_por_id(),"00",str(id_usuario)).split('-')
		return self.objson.usuario(respuesta)
		#resp = respuesta.split('-')
		#print "tamanio respuesta: "+str(len(respuesta))
		#print json.loads(respuesta)
		# if len(respuesta) > 0:
		# 	return json.dumps({'cabecera':data["cabecera"],'datos':self.objson.usuario(respuesta)})
		# else:
		# 	return json.dumps({'cabecera':data["cabecera"],'datos':'02'})

	def actualizar_usuario(self,data):
		self.nombre = data["datos"]['nombre']
		self.apellido = data["datos"]['apellido']
		self.email = data["datos"]['email']
		self.password = data["datos"]['password']
		self.id = data['cabecera']['id_usuario_logueado']
		self.mensaje = str(self.nombre+self.apellido+self.email+self.password+str(self.id).ljust(5))
		respuesta = self.mtx.enviar(self.procpx.actualizar_usuario(),self.codtx.actualizar_usuario(),"00",self.mensaje)
		return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})

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
		respuesta =  self.mtx.enviar(self.procpx.iniciar_sesion(),self.codtx.iniciar_sesion(),"00",mensaje)
		print "respuesta:"+respuesta
		datos = respuesta.split('-')
		if len(datos) > 1:
			return json.dumps({'cabecera':{'formulario':data['cabecera']['formulario'],'id_usuario_logueado':datos[0],'email':datos[1]},'datos':''})
		else:
			return json.dumps({'cabecera':{'formulario':data['cabecera']['formulario'],'id_usuario_logueado':'','email':''},'datos':respuesta})


	def ver_usuarios_registrados(self,data):
		self.id = data['cabecera']['id_usuario_logueado']
		respuesta = self.mtx.enviar(self.procpx.ver_usuarios_registrados(),self.codtx.ver_usuarios_registrados(),"00",str(self.id))
	    #print respuesta
	    #return json.dumps({'cabecera':[data["cabecera"]["formulario"],data["cabecera"]["id_usuario_logueado"]],'datos':respuesta})[""]
	    #print data["cabecera"]
	    #print "\n"
	    #print json.dumps(respuesta)
		return json.dumps({'cabecera':data["cabecera"],'datos':self.objson.usuarios(respuesta)})

	def total_usuarios_registrados(self,data):
		self.id = data['cabecera']['id_usuario_logueado']
		respuesta = self.mtx.enviar(self.procpx.total_usuarios_registrados(),self.codtx.total_usuarios_registrados(),"00",str(self.id))
		return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})
