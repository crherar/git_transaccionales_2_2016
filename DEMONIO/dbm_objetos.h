#ifndef _DBM_OBJETOS_H
#define _DBM_OBJETOS_H
#include "modelo.h"
#include "dbm_conectar.h"


int get_id_objeto(char *nombre_objeto);
Objeto *insertar_objeto(int id_usuario_dueno,char *nombre_objeto);
char *get_listado_objetos(int pagina);
int borrar_objeto(int id_objeto);

#endif
