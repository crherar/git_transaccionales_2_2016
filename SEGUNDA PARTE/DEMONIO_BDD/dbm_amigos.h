#ifndef
#define _DBM_AMIGOS_H
#include "modelo.h"
#include "dbm_conectar.h"
Amigo *insertar_amigos(int id_usuario_logueado,int id_amigo);
Amigo *actualizar_amigos(int id_usuario_logueado,int id_amigo,int id_amistad);
int eliminar_amistad(id_amistad);
char *get_mis_amigos(int id_usuario_logueado);
Misamigos *get_mis_amigos_combobox(int id_usuario_logueado);
Misamigos *get_mis_amigos_tabla(int id_usuario_logueado);
int get_total_amigos(int id_usuario_logueado);
#endif
