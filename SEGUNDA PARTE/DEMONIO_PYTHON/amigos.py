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
        self.pocpx = procesospx.procesospx()

    def ver_mis_amigos(self,data):
        self.amigo_1 = data
        datos = mtx.enviar(self.procpx.ver_mis_amigos(),codtx.ver_mis_amigos(),"",self.amigo_1)
        mis_amigos = datos[:-1].split('-')
        return json.dumps(mis_amigos)
