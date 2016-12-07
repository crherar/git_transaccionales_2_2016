import json
import monitor
import codigostx
import procesospx
import objs_json
import usuarios

class reputaciones:

    def __init__(self):
        self.mensaje = ""
        self.id = 0
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

    def get_reputacion_por_id(self,data):

        #print "get reputacion por id"
        self.id = data["datos"]["id_reputacion"]
        respuesta = self.mtx.enviar(self.procpx.get_reputacion_por_id(),self.codtx.get_reputacion_por_id(),"00",str(self.id).ljust(5)).split('-')
        print respuesta
        if len(respuesta) > 0:
            print "respuesta"
            usr = usuarios.usuarios()
            objrep = self.objson.reputacion(respuesta)
            usr_clasificado = usr.get_usuario_por_id2(objrep['id_usuario_clasificado'])
            del usr
            return json.dumps({'cabecera':data["cabecera"],'datos':objrep,'usuario_clasificado':usr_clasificado})
        else:
            print "la respueta tiene largo 0"
            return json.dumps({'cabecera':data["cabecera"],'datos':'02'})


    def actualizar_reputacion(self,data):
        self.id_usuario_clasificador = data["cabecera"]["id_usuario_logueado"]
        self.id_usuario_clasificado = data["datos"]["id_usuario_clasificado"]
        self.clasificacion = data["datos"]["clasificacion"]
        self.comentario = data["datos"]["comentario"]
        self.id = data["datos"]["id_reputacion"]
        self.mensaje = str(self.id)+"-"+str(self.id_usuario_clasificador)+"-"+str(self.id_usuario_clasificado)+"-"+str(self.clasificacion)+"-"+self.comentario
        respuesta = self.mtx.enviar(self.procpx.actualizar_reputacion(),self.codtx.actualizar_reputacion(),"00",self.mensaje)
        return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})

    def perfil_usuario_reputaciones(self,data):
        usr = usuarios.usuarios()
        self.id_usuario_clasificado = data["datos"]["id_usuario_clasificado"]
        usr_clasificado = usr.get_usuario_por_id2(data["datos"]["id_usuario_clasificado"])
        del usr
        respuesta = self.mtx.enviar(self.procpx.ver_reputaciones_de_usuario(),self.codtx.ver_reputaciones_de_usuario(),"00",str(self.id_usuario_clasificado))
        return json.dumps({'cabecera':data["cabecera"],'datos':self.objson.reputaciones(respuesta),'usuario_perfil':usr_clasificado})

    def mi_perfil_mis_reputaciones(self,data):
        self.id_usuario_clasificado = data["cabecera"]["id_usuario_logueado"]
        respuesta = self.mtx.enviar(self.procpx.ver_mis_reputaciones(),self.codtx.ver_mis_reputaciones(),"00",str(self.id_usuario_clasificado))
        return json.dumps({'cabecera':data["cabecera"],'datos':self.objson.reputaciones(respuesta)})

    def eliminar_reputacion(self,data):
        self.id = data["datos"]["id_reputacion"]
        respuesta = self.mtx.enviar(self.procpx.eliminar_reputacion(),self.codtx.eliminar_reputacion(),"00",str(self.id))
        return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})

    def total_reputaciones_de_usuario(self,data):
        self.id_usuario_clasificado = data["datos"]["id_usuario_clasificado"]
        respuesta = self.mtx.enviar(self.procpx.total_reputaciones_de_usuario(),self.codtx.total_reputaciones_de_usuario(),"00",str(self.id_usuario_clasificado))
        return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})

    def total_mis_reputaciones(self,data):
        self.id_usuario_clasificado = data["cabecera"]["id_usuario_logueado"]
        respuesta = self.mtx.enviar(self.procpx.total_mis_reputaciones(),self.codtx.total_mis_reputaciones(),"00",str(self.id_usuario_clasificado))
        return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})
