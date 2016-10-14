#!/bin/bash



echo "*************** usuarios *************** ";
gmon regusr.inp regusr.c

echo "****************************************** ";

echo "*************** login ***************";
gmon loginn.inp loginn.c

echo "****************************************** ";

echo "*************** prestamos ***************";
gmon registrar_prestamo.inp hprest.c

echo "****************************************** ";

echo "*************** objetos ***************";
gmon registrar_objeto.inp regobj.c

echo "****************************************** ";

echo "*************** menus ***************\n";
gmon menu_principal.inp menu objetos.inp menpri.c menobj.c

echo "****************************************** ";

rm DEMONIO
ecpg dbm_conectar.pgc dbm_prestamos.pgc dbm_usuarios.pgc dbm_objetos.pgc  
gcc -I /usr/include/postgresql dbm_conectar.c dbm_usuarios.c dbm_prestamos.c dbm_objetos.c DEMONIO.c -o DEMONIO -L /usr/lib/postgresql/9.0/lib -lecpg

