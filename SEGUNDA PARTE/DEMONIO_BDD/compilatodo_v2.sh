#!/bin/bash

echo "*************** usuarios *************** ";
#gmon regusr.inp
gmon regusr.c
gmon modusr.c
gmon actusr.c
gmon verusr.c
echo "****************************************** ";

echo "*************** login ***************";
#gmon loginn.inp
gmon loginn.c

echo "****************************************** ";

echo "*************** prestamos ***************";
#gmon registrar_prestamo.inp
gmon regpre.c
gmon modpre.c
#gmon modpre.inp
gmon actpre.c
#gmon eprest.inp
gmon prepen.c
gmon predev.c
gmon delpre.c
gmon vprepe.c
gmon vprede.c
echo "****************************************** ";

echo "*************** objetos ***************";
#gmon registrar_objeto.inp
gmon regobj.c
gmon modobj.c
gmon actobj.c
gmon cbxobj.c
gmon verobj.c
#gmon delobj.inp
gmon delobj.c
#gmon cdeobj.inp
gmon cdeobj.c
#gmon mdeobj.inp
#gmon mdeobj.c

echo "****************************************** ";


echo "*************** amigos ******************";
gmon cbxami.c
gmon verami.c
gmon regami.c
gmon delami.c

echo "*****************************************";

echo "*************** menus ***************\n";
#gmon menpri.inp
#gmon menobj.inp
#gmon menpri.c
#gmon menobj.c

echo "****************************************** ";


echo "****************************************";
gmon regrep.c
gmon modrep.c
gmon actrep.c
gmon vemrep.c
gmon veorep.c
echo "*****************************************";

rm DEMONIO_V_2_0
ecpg dbm_conectar.pgc dbm_amigos.pgc dbm_reputaciones.pgc dbm_prestamos.pgc dbm_usuarios.pgc dbm_objetos.pgc
gcc -I /usr/include/postgresql dbm_conectar.c dbm_amigos.c dbm_reputaciones.c dbm_usuarios.c dbm_prestamos.c dbm_objetos.c DEMONIO_V_2_0.c -o DEMONIO_V_2_0 -L /usr/lib/postgresql/9.0/lib -lecpg
