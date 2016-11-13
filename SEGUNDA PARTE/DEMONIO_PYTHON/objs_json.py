class objs_json:
    def usuarios(self,data):
        return {'id':data[0],'nombre':data[1],'apellido':data[2],'email':data[3],'password':data[4]}

    def objetos(self,data):
        return {'id_objeto':data[0],'nombre':data[1],'id_usuario_dueno':data[2]}
