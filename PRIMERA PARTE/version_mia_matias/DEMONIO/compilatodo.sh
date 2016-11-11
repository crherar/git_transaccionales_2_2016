#!/bin/bash

echo "*************** usuarios *************** ";
gmon regusr.inp 
gmon regusr.c

echo "****************************************** ";

echo "*************** login ***************";
gmon loginn.inp 
gmon loginn.c

echo "****************************************** ";

echo "*************** prestamos ***************";
gmon registrar_prestamo.inp 
gmon hprest.c

echo "****************************************** ";

echo "*************** objetos ***************";
gmon registrar_objeto.inp 
gmon regobj.c 
gmon delobj.inp 
gmon delobj.c
gmon cdeobj.inp
gmon cdeobj.c

echo "****************************************** ";

echo "*************** menus ***************\n";
gmon menu_principal.inp 
gmon menu objetos.inp 
gmon menpri.c 
gmon menobj.c

echo "****************************************** ";

rm DEMONIO
ecpg dbm_conectar.pgc dbm_prestamos.pgc dbm_usuarios.pgc dbm_objetos.pgc  
gcc -I /usr/include/postgresql dbm_conectar.c dbm_usuarios.c dbm_prestamos.c dbm_objetos.c DEMONIO.c -o DEMONIO -L /usr/lib/postgresql/9.0/lib -lecpg

