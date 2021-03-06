#ifndef _DBM_USUARIOS_H
#define _DBM_USUARIOS_H
#include "modelo.h"
#include "dbm_conectar.h"

int get_id_usuario_por_nombre_apellido(char *nombre,char *apellido);
int get_id_usuario_por_email(char *email);
//int logueo(char *email,char *password);
Usuario *logueo(char *email, char *password);
Usuario *insertar_usuario(char *email,char *nombre, char *apellido, char *password);
char *get_usuario_por_id(int id_usuario);
Usuario *actualizar_usuario(char *email,char *nombre, char *apellido, char *password,int id_usuario);
int eliminar_usuario(int id_usuario);
char* get_email_usuario_por_id(int id);
int validar_registro_usuario(char *email_usuario);
Usuario *get_listado_usuarios_registrados();
int get_total_usuarios_registrados(int id_usuario_logueado);
#endif
