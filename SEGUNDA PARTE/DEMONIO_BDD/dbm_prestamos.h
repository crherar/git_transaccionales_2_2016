#ifndef _DBM_PRESTAMOS_H
#define _DBM_PRESTAMOS_H
#include "modelo.h"
#include "dbm_conectar.h"
Prestamo * insertar_prestamo(char *fecha_prestamo ,int id_usuario_prestador,int id_objeto,int cantidad,int id_usuario_recibidor,char  *fecha_devolucion);
Prestamo * actualizar_prestamo(char *fecha_prestamo ,int id_usuario_prestador,int id_objeto,int id_usuario_recibidor,char  *fecha_devolucion,int estado,int cantidad_prestada,int id_prestamo);
Prestamo * marcar_prestamo_como_devuelto(id_prestamo);
Prestamo * marcar_prestamo_como_pendiente(id_prestamo);
int eliminar_prestamo(int id_prestamo);
#endif
