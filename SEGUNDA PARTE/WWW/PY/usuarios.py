import json
import monitor
#from monitor import*

mtx = monitor.monitor()
class usuarios:

#	def __init__(self):
#		nombre = ""
#		apellido = ""
#		email = ""
#		password = ""



	def insertar_usuario(data):
		nombre = datos[0]
		apellido = datos[1]
		email = datos[2]
		password = datos[3]
		mensaje = str(nombre+apellido+email+password)		
		return monitor.enviar("regusr","123456","00",mensaje)

	#@staticmethod
	def login(self,data):
		print 'dentro del metodo login de usuarios'
		print 'data dentro del metodo login de usuarios "%s"' % data
		datos = data.split("-")
		email = datos[0]
		password = datos[1]
		mensaje = str(email+password)
		print 'datos para el monitor: "%s"' % mensaje
		return mtx.enviar("loginn","020506","00",mensaje)
		#return ""