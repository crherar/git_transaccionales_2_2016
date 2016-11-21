class objs_json:
    def usuario(self,data):
        return {'id':data[0],'nombre':data[1],'apellido':data[2],'email':data[3],'password':data[4]}

    def objeto(self,data):
        return {'id_objeto':data[0],'nombre_objeto':data[1],'id_usuario_dueno':data[2]}

    def prestamo(self,data):
        return {'id_prestamo':data[0],'fecha_prestamo':data[1],'correo_usuario_prestador':data[2],'correo_usuario_recibidor':data[5],'nombre_objeto':data[3],'cantidad':data[4],'fecha_devolucion':data[6],'estado':data[7]}

    def prestamos(self,data):
        if data != "02":
            datos = list()
            arr = data.split('|')

            for i in range(len(arr)):
                prest = arr[i].split(',')
                #if len(prest) > 0:
                #[0] 87,
                #[1] 2016-11-20,
                #[2] nombre del uusario
                #[3] matias@gmail.com,
                #[4] cuatro,
                #[5] 2016-11-30,
                #[6] 1
                datos.append({'id':prest[0],'fpre':prest[1],'ur':prest[2],'cur':prest[3],'obj':prest[4],'cant':prest[6],'fdev':prest[5]})
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

    def usuarios(self,data):
        if data != "02":
            datos = list()
            arr = data.split('|')

            for i in range(len(arr)):
                print arr[i]
                print "\n"
                usr = arr[i].split(',')
                #if len(prest) > 0:
                #datos.append({"id":obj[0],"nombre_objeto":obj[1]})
                datos.append({"id":usr[0],"usr":usr[1],'email':usr[2]})
                #print prest
                #print "\n"
            return datos
        else:
            return "02"
