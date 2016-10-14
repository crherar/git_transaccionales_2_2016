#!/bin/bash
rm DEMONIO
ecpg dbm_conectar.pgc dbm_prestamos.pgc dbm_usuarios.pgc dbm_objetos.pgc  
gcc -I /usr/include/postgresql dbm_conectar.c dbm_usuarios.c dbm_prestamos.c dbm_objetos.c DEMONIO.c -o DEMONIO -L /usr/lib/postgresql/9.0/lib -lecpg

