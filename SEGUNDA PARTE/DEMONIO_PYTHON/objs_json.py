class objs_json:
    def usuario(self,data):
        return {'id':data[0],'nombre':data[1],'apellido':data[2],'email':data[3],'password':data[4]}

    def objeto(self,data):
        return {'id_objeto':data[0],'nombre':data[1],'id_usuario_dueno':data[2]}

    def prestamo(self,data):
        return {'id_prestamo':data[0],'fecha_prestamo':data[1],'correo_usuario_prestador':data[2],'correo_usuario_recibidor':data[5],'nombre_objeto':data[3],'cantidad':data[4],'fecha_devolucion':data[6],'estado':data[7]}

    def prestamos(self,data):
        if data != "02":
            datos = list()
            arr = data.split('|')

            for i in range(len(arr)):
                prest = arr[i].split(',')
                #if len(prest) > 0:
                datos.append({'id_prestamo':data[0],'fecha_prestamo':data[1],'correo_usuario_recibidor':data[2],'nombre_objeto':data[3],'cantidad':data[5],'fecha_devolucion':data[4]})
                #print prest
                #print "\n"
            return datos
        else:
            return "02"

    def objetos(self,data):
        if data != "02":
            datos = list()
            arr = data.split('|')

            for i in range(len(arr)):
                print arr[i]
                print "\n"
                obj = arr[i].split(',')
                #if len(prest) > 0:
                #datos.append({"id":obj[0],"nombre_objeto":obj[1]})
                datos.append({"id":obj[0],"nombre_objeto":obj[1]})
                #print prest
                #print "\n"
            return datos
        else:
            return "02"
