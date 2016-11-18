class objs_json:
    def usuarios(self,data):
        return {'id':data[0],'nombre':data[1],'apellido':data[2],'email':data[3],'password':data[4]}

    def objetos(self,data):
        return {'id_objeto':data[0],'nombre':data[1],'id_usuario_dueno':data[2]}

    def prestamos(self,data):
        return{'id_prestamo':data[0],'fecha_prestamo':data[1],'correo_usuario_prestador':data[2],'correo_usuario_recibidor':data[5],'nombre_objeto':data[3],'cantidad':data[4],'fecha_devolucion':data[6],'estado':data[7]}
