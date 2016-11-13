import json
import monitor
import codigostx
import procesospx
import objs_json

class objetos:

    def __init__(self):
        self.mensaje = ""
        self.id = 0
        self.nombre = ""
        self.id_usuario_dueno = 0
        self.mtx = monitor.monitor()

        self.codtx = codigostx.codigostx()
        self.procpx = procesospx.procesospx()
        self.objson = objs_json.objs_json()

    def insertar_objeto(self,data):
        self.nombre = data["datos"]["nombre_objeto"]
        self.id_usuario_dueno = data["cabecera"]["id_usuario_logueado"]
        self.mensaje = self.nombre+str(self.id_usuario_dueno).ljust(5)
        respuesta = self.mtx.enviar(self.procpx.insertar_objeto(),self.codtx.insertar_objeto(),"00",self.mensaje)
        return json.dumps({'cabecera':{'formulario':data['cabecera']['formulario'],'id_usuario_logueado':data["cabecera"]["id_usuario_logueado"],'email':''},'datos':respuesta})
