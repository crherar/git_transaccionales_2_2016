import json
import monitor
import codigostx
import procesospx
import objs_json

class amigos:

    def __init__(self):
        self.amigo_1 = 0
        self.amigo_2 = 0
        self.id = 0
        self.mtx = monitor.monitor()
        self.codtx = codigostx.codigostx()
        self.procpx = procesospx.procesospx()
        self.objson = objs_json.objs_json()

    def insertar_amigos(self,data):
        self.amigo_1 = str(data["cabecera"]['id_usuario_logueado'])
        self.amigo_2 = str(data["datos"]["id_amigo"])
        mensaje = str(self.amigo_1)+"-"+str(self.amigo_2)
        respuesta = self.mtx.enviar(self.procpx.insertar_amigos(),self.codtx.insertar_amigos(),"00",mensaje)
        return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})

    def ver_mis_amigos_combobox(self,data):
        self.amigo_1 = str(data["cabecera"]['id_usuario_logueado'])
        print "id usuario logueado dentro del metodo ver mis amigos: "+self.amigo_1
        datos = self.mtx.enviar(self.procpx.ver_mis_amigos_combobox(),self.codtx.ver_mis_amigos_combobox(),"00",self.amigo_1)
        print "datos recibidos del monitor: "+datos
        mis_amigos = datos.split(',')
        return json.dumps({'cabecera':{'id_usuario_logueado':self.amigo_1,'email':''},'datos':mis_amigos})

    def ver_mis_amigos_tabla(self,data):
        self.amigo_1 = data["cabecera"]["id_usuario_logueado"]
        respuesta = self.mtx.enviar(self.procpx.ver_mis_amigos_tabla(),self.codtx.ver_mis_amigos_tabla(),"00",str(self.amigo_1))
        print respuesta
        #return json.dumps({'cabecera':[data["cabecera"]["formulario"],data["cabecera"]["id_usuario_logueado"]],'datos':respuesta})[""]
        #print data["cabecera"]
        print "\n"
        #print json.dumps(respuesta)
        return json.dumps({'cabecera':data["cabecera"],'datos':self.objson.amigos(respuesta)})

    def eliminar_amistad(self,data):
        self.id = data["datos"]["id_amistad"]
        respuesta = self.mtx.enviar(self.procpx.eliminar_amistad(),self.codtx.eliminar_amistad(),"00",str(self.id))
        return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})

    def total_amigos_registrados(self,data):
        self.amigo_1 = data["cabecera"]["id_usuario_logueado"]
        respuesta = self.mtx.enviar(self.procpx.total_amigos_registrados(),self.codtx.total_amigos_registrados(),"00",str(self.amigo_1))
        return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})
