#ifndef _DBM_OBJETOS_H
#define _DBM_OBJETOS_H
#include "modelo.h"
#include "dbm_conectar.h"


int get_id_objeto(char *nombre_objeto);
Objeto *insertar_objeto(int id_usuario_dueno,char *nombre_objeto);
char *get_listado_objetos(int pagina);
// char *get_listado_objetos_combobox(int id_usuario_dueno);
// char *get_listado_objetos_tabla(int id_usuario_dueno);
MisObjetos *get_listado_objetos_combobox(int id_usuario_dueno);
MisObjetos *get_listado_objetos_tabla(int id_usuario_dueno);
Objeto *actualizar_objeto(char *nombre_objeto,int id_objeto);
int borrar_objeto(int id_objeto);
char *get_nombre_objeto_por_id(int id);
Objeto *get_nombre_objeto_por_id2(int id);
char *get_objeto_por_id(int id);
int validar_registro_objeto(char *nombre_objeto, int id_dueno_objeto);

#endif
