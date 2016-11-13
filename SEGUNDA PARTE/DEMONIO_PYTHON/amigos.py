import json
import monitor
import codigostx
import procesospx

class amigos:

    def __init__(self):
        self.amigo_1 = 0
        self.amigo_2 = 0
        self.id = 0
        self.mtx = monitor.monitor()
        self.codtx = codigostx.codigostx()
        self.procpx = procesospx.procesospx()

    def ver_mis_amigos(self,data):
        self.amigo_1 = str(data['id_usuario_logueado'])
        print "id usuario logueado dentro del metodo ver mis amigos: "+self.amigo_1
        datos = self.mtx.enviar(self.procpx.ver_mis_amigos(),self.codtx.ver_mis_amigos(),"00",self.amigo_1)
        print "datos recibidos del monitor: "+datos
        mis_amigos = datos[:-1].split('-')
        return json.dumps({'cabecera':{'id_usuario_logueado':self.amigo_1,'email':''},'data':mis_amigos})
