class procesospx:

    #USUARIOS
    def iniciar_sesion(self):
        return "loginn"

    def insertar_usuario(self):
        return "regusr"

    def get_usuario_por_id(self):
        return "modusr"
        
    def actualizar_usuario(self):
        return "actusr"

    def eliminar_usuario(self):
        return "delusr"

    def ver_usuarios_registrados(self):
        return "verusr"
    #PRESTAMOS
    def insertar_prestamo(self):
        return "hprest"

    def actualizar_prestamo(self):
        return "eprest"

    def eliminar_prestamo(self):
        return "delpre"

    def prestamo_pendiente(self):
        return "prepen"

    def prestamo_devuelto(self):
        return "predev"

    def ver_prestamos_pendientes(self):
        return "vprepe"

    def ver_prestamos_devueltos(self):
        return "vprede"

    #OBJETOS
    def insertar_objeto(self):
        return "regobj"

    def actualizar_objeto(self):
        return "actobj"

    def eliminar_objeto(self):
        return "delobj"

    def ver_mis_objetos(self):
        return "verobj"

    #AMIGOS
    def insertar_amigos(self):
        return "inami"

    def actualizar_amigos(self):
        return "actami"

    def eliminar_amigos(self):
        return "delami"

    def ver_mis_amigos(self):
        return "verami"


    #REPUTACIONES
    def isertar_reputacion(self):
        return "inrep"

    def actualizar_reputacion(self):
        return "actrep"

    def ver_mis_reputaciones(self):
        return "vemrep"

    def ver_reputacion_de_usuario(self):
        return "veorep"
