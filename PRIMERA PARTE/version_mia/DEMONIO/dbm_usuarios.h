#ifndef _DBM_USUARIOS_H
#define _DBM_USUARIOS_H
#include "modelo.h"
#include "dbm_conectar.h"

int get_id_usuario_por_nombre_apellido(char *nombre,char *apellido);
int get_id_usuario_por_email(char *email);
int logueo(char *email,char *password);
Usuario *insertar_usuario(char *email,char *nombre, char *apellido, char *password);
char* get_email_usuario_por_id(int id);
#endif
