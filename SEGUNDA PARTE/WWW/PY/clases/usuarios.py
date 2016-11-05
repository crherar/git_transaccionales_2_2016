import json
import monitor
class usuarios:
	def __init__(self):
		self.nombre = ""
		self.apellido = ""
		self.email = ""
		self.password = ""
        self.monitor = monitor.monitor()
	def insertar_usuario(data):

		self.nombre = datos[0]
		self.apellido = datos[1]
		self.email = datos[2]
		self.password = datos[3]
        mensaje = self.nombre+self.apellido+self.email+self.password
        return monitor.enviar("regusr","123456",00,mensaje)
