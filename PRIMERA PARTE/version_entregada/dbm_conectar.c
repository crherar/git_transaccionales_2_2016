/* Processed by ecpg (4.9.0) */
/* These include files are added by the preprocessor */
#include <ecpglib.h>
#include <ecpgerrno.h>
#include <sqlca.h>
/* End of automatic include section */

#line 1 "dbm_conectar.pgc"
#include <stdio.h>
#include <unistd.h>
#include <string.h>
#include <stdlib.h>
#include <math.h>
 



 
 
#include <sqlca.h>
 

#line 1 "/usr/include/postgresql/sqlca.h"
#ifndef POSTGRES_SQLCA_H
#define POSTGRES_SQLCA_H

#ifndef PGDLLIMPORT
#if  defined(WIN32) || defined(__CYGWIN__)
#define PGDLLIMPORT __declspec (dllimport)
#else
#define PGDLLIMPORT
#endif   /* __CYGWIN__ */
#endif   /* PGDLLIMPORT */

#define SQLERRMC_LEN	150

#ifdef __cplusplus
extern		"C"
{
#endif

struct sqlca_t
{
	char		sqlcaid[8];
	long		sqlabc;
	long		sqlcode;
	struct
	{
		int			sqlerrml;
		char		sqlerrmc[SQLERRMC_LEN];
	}			sqlerrm;
	char		sqlerrp[8];
	long		sqlerrd[6];
	/* Element 0: empty						*/
	/* 1: OID of processed tuple if applicable			*/
	/* 2: number of rows processed				*/
	/* after an INSERT, UPDATE or				*/
	/* DELETE statement					*/
	/* 3: empty						*/
	/* 4: empty						*/
	/* 5: empty						*/
	char		sqlwarn[8];
	/* Element 0: set to 'W' if at least one other is 'W'	*/
	/* 1: if 'W' at least one character string		*/
	/* value was truncated when it was			*/
	/* stored into a host variable.             */

	/*
	 * 2: if 'W' a (hopefully) non-fatal notice occurred
	 */	/* 3: empty */
	/* 4: empty						*/
	/* 5: empty						*/
	/* 6: empty						*/
	/* 7: empty						*/

	char		sqlstate[5];
};

struct sqlca_t *ECPGget_sqlca(void);

#ifndef POSTGRES_ECPG_INTERNAL
#define sqlca (*ECPGget_sqlca())
#endif

#ifdef __cplusplus
}
#endif

#endif

#line 14 "dbm_conectar.pgc"

//#include EXEC SQL INCLUDE SQLCA;
#define ASSERT(ptr) if(sqlca.sqlcode != 0){free(ptr);ptr=NULL;}

/* exec sql begin declare section */

#line 1 "./modelo.h"


 
     
     
     
     
     
     



  
     
     
     


 
   
    
      


 
     
     
      
   //int anio_prestamo;
    //int mes_prestamo;
    //int dia_prestamo;
     //struct fecha fecha_prestamo;
    //struct fecha_prestamo{
    // int anio;
    // int mes;
    // int dia;
    // };
    
     
     
     
     
     
    //int anio_devolucion
     
    // struct fecha fecha_devolucion;
     //struct fecha_devolucion{
     //int anio;
    // int mes;
    // int dia;
    // };


 
     
     
     
     


   typedef struct Objeto  Objeto ;

#line 63 "./modelo.h"

   typedef struct Usuario  Usuario ;

#line 64 "./modelo.h"

   typedef struct Fecha  Fecha ;

#line 65 "./modelo.h"

   typedef struct Prestamo  Prestamo ;

#line 66 "./modelo.h"

   typedef struct Amigo  Amigo ;

#line 67 "./modelo.h"


#line 19 "dbm_conectar.pgc"

#ifndef MODELO.H
 #define MODELO.H
 struct Usuario { 
#line 6 "./modelo.h"
 int verificador_error ;
 
#line 7 "./modelo.h"
 int id ;
 
#line 8 "./modelo.h"
 char nombre [ 21 ] ;
 
#line 9 "./modelo.h"
 char apellido [ 21 ] ;
 
#line 10 "./modelo.h"
 char email [ 41 ] ;
 
#line 11 "./modelo.h"
 char password [ 11 ] ;
 } ; struct Objeto { 
#line 16 "./modelo.h"
 int verificador_error ;
 
#line 17 "./modelo.h"
 int id ;
 
#line 18 "./modelo.h"
 char nombre [ 15 ] ;
 } ; struct Fecha { 
#line 22 "./modelo.h"
 int anio ;
 
#line 23 "./modelo.h"
 int mes ;
 
#line 24 "./modelo.h"
 int dia ;
 } ; 
#line 54 "./modelo.h"
 struct Prestamo { 
#line 28 "./modelo.h"
 int verificador_error ;
 
#line 29 "./modelo.h"
 int id ;
 
#line 30 "./modelo.h"
 char fecha_prestamo [ 11 ] ;
 
#line 41 "./modelo.h"
 int id_usuario_prestador ;
 
#line 42 "./modelo.h"
 int id_usuario_recibidor ;
 
#line 43 "./modelo.h"
 int id_objeto ;
 
#line 44 "./modelo.h"
 int cantidad_prestada ;
 
#line 45 "./modelo.h"
 int estado ;
 
#line 47 "./modelo.h"
 char fecha_devolucion [ 11 ] ;
 } Prestamos ;
 struct Amigo { 
#line 57 "./modelo.h"
 int verificador_error ;
 
#line 58 "./modelo.h"
 int id ;
 
#line 59 "./modelo.h"
 int id_amigo1 ;
 
#line 60 "./modelo.h"
 int id_amigo2 ;
 } ; 
#endif
/* exec sql end declare section */
#line 20 "dbm_conectar.pgc"


//int db_conectar(char *base_de_datos, char *usuario, char *pass) {
int db_conectar() {
    printf("metodo conectar \n");
    /* exec sql begin declare section */
       
       
       
    
#line 26 "dbm_conectar.pgc"
 char SQL_bdd [ 19 ] = "b17957132_prestamo" ;
 
#line 27 "dbm_conectar.pgc"
 char SQL_usuario_bdd [ 19 ] = "b17957132_prestamo" ;
 
#line 28 "dbm_conectar.pgc"
 char SQL_password_bdd [ 10 ] = "prestados" ;
/* exec sql end declare section */
#line 29 "dbm_conectar.pgc"

   // printf(SQL_bdd);
   // memset(SQL_bdd,' ',sizeof(base_de_datos));
   // memset(SQL_usuario_bdd,' ',sizeof(usuario));
   // memset(SQL_password_bdd,' ',sizeof(pass));
   // strcpy(SQL_bdd, base_de_datos);
   // strcpy(SQL_usuario_bdd, usuario);
   // strcpy(SQL_password_bdd, pass);
    printf("antes de ejecutar la conexion \n");
    { ECPGconnect(__LINE__, 0, SQL_bdd , SQL_usuario_bdd , SQL_password_bdd , NULL, 0); }
#line 38 "dbm_conectar.pgc"

   // EXEC SQL CONNECT TO :"b17957132_prestamo" USER :"b17957132_prestamo" IDENTIFIED BY :"prestados";
   // EXEC SQL CONNECT TO :SQL_bdd USER :SQL_usuario_bdd USING :SQL_password_bdd;
    return sqlca.sqlcode;
}

void db_close() {
    { ECPGdisconnect(__LINE__, "ALL");}
#line 45 "dbm_conectar.pgc"

}

void db_commit() {
    { ECPGtrans(__LINE__, NULL, "commit");}
#line 49 "dbm_conectar.pgc"

}
