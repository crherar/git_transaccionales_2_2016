#ifndef
#define _DBM_AMIGOS_H
#include "modelo.h"
#include "dbm_conectar.h"
Amigo *insertar_amigos(int id_usuario_logueado,id_amigo);
Amigo *actualizar_amigos(int id_usuario_logueado,id_amigo,id_amistad);
int eliminar_amistad(id_amistad);
#endif
