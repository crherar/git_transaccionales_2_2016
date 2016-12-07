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
        return "regpre"

    def get_prestamo_por_id(self):
        return "modpre"

    def actualizar_prestamo(self):
        return "actpre"

    def eliminar_prestamo(self):
        return "delpre"

    def marcar_prestamo_como_pendiente(self):
        return "prepen"

    def marcar_prestamo_como_devuelto(self):
        return "predev"

    def ver_prestamos_pendientes(self):
        return "vprepe"

    def ver_prestamos_devueltos(self):
        return "vprede"

    #OBJETOS
    def insertar_objeto(self):
        return "regobj"

    def get_objeto_por_id(self):
        return "modobj"

    def actualizar_objeto(self):
        return "actobj"

    def eliminar_objeto(self):
        return "delobj"

    def ver_mis_objetos_combobox(self):
        return "cbxobj"

    def ver_mis_objetos_tabla(self):
        return "verobj"

    def total_registros_objetos(self):
        return "tnrobj"

    #AMIGOS
    def insertar_amigos(self):
        return "regami"

    def actualizar_amigos(self):
        return "actami"

    def eliminar_amistad(self):
        return "delami"

    def ver_mis_amigos_combobox(self):
        return "cbxami"

    def ver_mis_amigos_tabla(self):
        return "verami"

    #REPUTACIONES
    def insertar_reputacion(self):
        return "regrep"

    def get_reputacion_por_id(self):
        return "modrep"

    def actualizar_reputacion(self):
        return "actrep"

    def ver_mis_reputaciones(self):
        return "vemrep"

    def ver_reputaciones_de_usuario(self):
        return "veorep"

    def eliminar_reputacion(self):
        return "delrep"
