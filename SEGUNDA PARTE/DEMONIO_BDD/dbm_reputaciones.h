#ifndef _DBM_REPUTACION_H
#define _DBM_REPUTACION_H
#include "modelo.h"
#include "dbm_conectar.h"

Reputacion *insertar_reputacion(int id_usuario_clasificado,int id_usuario_clasificador,int clasificacion,char *comentario);
Reputacion *actualizar_reputacion(int id_usuario_clasificado,int clasificacion,char *comentario,int id_reputacion);
Reputacion *get_perfil_usuario_reputaciones(int id_usuario_clasificado);
Reputacion *get_reputacion_por_id(int id_reputacion);
#endif
