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

    def get_objeto_por_id(self,data):
        self.id = str(data["datos"]["id_objeto"])
        respuesta = self.mtx.enviar(self.procpx.get_objeto_por_id(),self.codtx.get_objeto_por_id(),"00",str(self.id).ljust(5)).split('-')
        if len(respuesta) > 0:
            print "respuesta"
            return json.dumps({'cabecera':data["cabecera"],'datos':self.objson.objeto(respuesta)})
        else:
            print "la respueta tiene largo 0"
            return json.dumps({'cabecera':data["cabecera"],'datos':'02'})

    def actualizar_objeto(self,data):
        self.nombre = data["datos"]["nombre_objeto"]
        self.id = data["datos"]["id_objeto"]
        self.mensaje = self.nombre+str(self.id).ljust(5)
        respuesta = self.mtx.enviar(self.procpx.actualizar_objeto(),self.codtx.actualizar_objeto(),"00",self.mensaje)
        return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})


    def eliminar_objeto(self,data):
        self.id = data["datos"]["id_objeto"]
        respuesta = self.mtx.enviar(self.procpx.eliminar_objeto(),self.codtx.eliminar_objeto(),"00",str(self.id).ljust(5))
        return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})

    def ver_mis_objetos_combobox(self,data):
        self.id_usuario_dueno = data["cabecera"]["id_usuario_logueado"]
        respuesta = self.mtx.enviar(self.procpx.ver_mis_objetos_combobox(),self.codtx.ver_mis_objetos_combobox(),"00",str(self.id_usuario_dueno).ljust(5)).split(',')
        #return json.dumps({'cabecera':[data["cabecera"]["formulario"],data["cabecera"]["id_usuario_logueado"]],'datos':respuesta})
        print data["cabecera"]
        return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})

    def ver_mis_objetos_tabla(self,data):
        self.id_usuario_dueno = data["cabecera"]["id_usuario_logueado"]
        respuesta = self.mtx.enviar(self.procpx.ver_mis_objetos_tabla(),self.codtx.ver_mis_objetos_tabla(),"00",str(self.id_usuario_dueno).ljust(5))
        print respuesta
        #return json.dumps({'cabecera':[data["cabecera"]["formulario"],data["cabecera"]["id_usuario_logueado"]],'datos':respuesta})[""]
        #print data["cabecera"]
        print "\n"
        #print json.dumps(respuesta)
        return json.dumps({'cabecera':data["cabecera"],'datos':self.objson.objetos(respuesta)})
