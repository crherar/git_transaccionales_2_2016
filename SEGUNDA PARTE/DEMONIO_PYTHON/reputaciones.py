import json
import monitor
import codigostx
import procesospx
import objs_json


class reputaciones:

    def __init__(self):
        self.mensaje = ""
        self.id_usuario_clasificador = 0
        self.id_usuario_clasificado = 0
        self.clasificacion = 0
        self.comentario = ""
        self.mtx = monitor.monitor()
        self.codtx = codigostx.codigostx()
        self.procpx = procesospx.procesospx()
        self.objson = objs_json.objs_json()

    def insertar_reputacion(self,data):
        self.id_usuario_clasificador = data["cabecera"]["id_usuario_logueado"]
        self.id_usuario_clasificado = data["datos"]["id_usuario_clasificado"]
        self.clasificacion = data["datos"]["clasificacion"]
        self.comentario = data["datos"]["comentario"]
        self.mensaje = str(self.id_usuario_clasificador)+"-"+str(self.id_usuario_clasificado)+"-"+str(self.clasificacion)+"-"+self.comentario
        respuesta = self.mtx.enviar(self.procpx.insertar_reputacion(),self.codtx.insertar_reputacion(),"00",self.mensaje)
        return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})
