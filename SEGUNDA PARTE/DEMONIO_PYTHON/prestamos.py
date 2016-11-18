import json
import monitor
import codigostx
import procesospx
import objs_json

class prestamos:

    def __init__(self):
        self.mensaje = ""
        self.id = 0
        self.dia_prestamo = ""
        self.mes_prestamo = ""
        self.anio_prestamo = ""
        self.correo_usuario_prestador = ""
        self.id_usuario_prestador = 0
        self.objeto = ""
        self.cantidad = ""
        self.correo_usuario_recibidor = ""
        self.dia_devolucion = ""
        self.mes_devolucion = ""
        self.anio_devolucion = ""
        self.estado = ""
        self.mtx = monitor.monitor()
        self.codtx = codigostx.codigostx()
        self.procpx = procesospx.procesospx()
        self.objson = objs_json.objs_json()

    def insertar_prestamo(self,data):
        self.dia_prestamo = data["datos"]["dia_prestamo"]
        self.mes_prestamo = data["datos"]["mes_prestamo"]
        self.anio_prestamo = data["datos"]["anio_prestamo"]
        self.correo_usuario_prestador = data["datos"]["correo_usuario_prestador"]
        self.objeto = data["datos"]["objeto"]
        self.cantidad = data["datos"]["cantidad"]
        self.correo_usuario_recibidor = data["datos"]["correo_usuario_recibidor"]
        self.dia_devolucion = data["datos"]["dia_devolucion"]
        self.mes_devolucion = data["datos"]["mes_devolucion"]
        self.anio_devolucion = data["datos"]["anio_devolucion"]
        self.estado = data["datos"]["estado"]
        self.mensaje = self.anio_prestamo+self.mes_prestamo+self.dia_prestamo+self.correo_usuario_prestador+self.objeto+self.cantidad.ljust(3)+self.correo_usuario_recibidor+self.anio_devolucion+self.mes_devolucion+self.dia_devolucion+self.estado
        respuesta = self.mtx.enviar(self.procpx.insertar_prestamo(),self.codtx.insertar_prestamo(),"00",self.mensaje)
        return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})

    def get_prestamo_por_id(self,data):
        print "get prestamo por id"
        self.id = data["datos"]["id_prestamo"]
        respuesta = self.mtx.enviar(self.procpx.get_prestamo_por_id(),self.codtx.get_prestamo_por_id(),"00",str(self.id).ljust(5)).split('-')
        print respuesta
        if len(respuesta) > 0:
            print "respuesta"
            return json.dumps({'cabecera':data["cabecera"],'datos':self.objson.prestamo(respuesta)})
        else:
            print "la respueta tiene largo 0"
            return json.dumps({'cabecera':data["cabecera"],'datos':'02'})

    def marcar_prestamo_como_pendiente(self,data):
        self.id = data["cabecera"]["id_prestamo"]

        respuesta = self.mtx.enviar(self.procpx.marcar_prestamo_como_pendiente(),self.codtx.marcar_prestamo_como_pendiente(),"00",str(self.id).ljust(5))
        print respuesta
        return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})

    def marcar_prestamo_como_devuelto(self,data):
        self.id = data["datos"]["id_prestamo"]
        respuesta = self.mtx.enviar(self.procpx.marcar_prestamo_como_devuelto(),self.codtx.marcar_prestamo_como_devuelto(),"00",str(self.id).ljust(5))
        print respuesta
        return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})

    def actualizar_prestamo(self,data):
        self.id = data["datos"]["id_prestamo"]
        self.dia_prestamo = data["datos"]["dia_prestamo"]
        self.mes_prestamo = data["datos"]["mes_prestamo"]
        self.anio_prestamo = data["datos"]["anio_prestamo"]
        self.correo_usuario_prestador = data["datos"]["correo_usuario_prestador"]
        self.objeto = data["datos"]["objeto"]
        self.cantidad = data["datos"]["cantidad"]
        self.correo_usuario_recibidor = data["datos"]["correo_usuario_recibidor"]
        self.dia_devolucion = data["datos"]["dia_devolucion"]
        self.mes_devolucion = data["datos"]["mes_devolucion"]
        self.anio_devolucion = data["datos"]["anio_devolucion"]
        self.estado = data["datos"]["estado"]
        self.mensaje = self.anio_prestamo+self.mes_prestamo+self.dia_prestamo+self.correo_usuario_prestador+self.objeto+self.cantidad.ljust(3)+self.correo_usuario_recibidor+self.anio_devolucion+self.mes_devolucion+self.dia_devolucion+self.estado+str(self.id).ljust(5)
        respuesta = self.mtx.enviar(self.procpx.actualizar_prestamo(),self.codtx.actualizar_prestamo(),"00",self.mensaje)
        return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})

    def ver_prestamos_pendientes(self,data):
        self.id_usuario_prestador = data["cabecera"]["id_usuario_logueado"]
        respuesta = self.mtx.enviar(self.procpx.ver_prestamos_pendientes(),self.codtx.ver_prestamos_pendientes(),"00",str(self.id_usuario_prestador))
        #print "r: "+respuesta
        return json.dumps({'cabecera':data["cabecera"],'datos':self.objson.prestamos(respuesta)})


    def eliminar_prestamo(self,data):
        self.id = data["datos"]["id_prestamo"]
        respuesta = self.mtx.enviar(self.procpx.eliminar_prestamo(),self.codtx.eliminar_prestamo(),"00",str(self.id).ljust(5))
        print respuesta
        return json.dumps({'cabecera':data["cabecera"],'datos':respuesta})
