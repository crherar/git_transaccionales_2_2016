/* Processed by ecpg (4.9.0) */
/* These include files are added by the preprocessor */
#include <ecpglib.h>
#include <ecpgerrno.h>
#include <sqlca.h>
/* End of automatic include section */

#line 1 "dbm_usuarios.pgc"
#include <stdlib.h>
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

#line 4 "dbm_usuarios.pgc"

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


#line 9 "dbm_usuarios.pgc"

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
#line 10 "dbm_usuarios.pgc"



int logueo(char *email, char *password)
{
/* exec sql begin declare section */

  
  // Se puede definir con el largo real ya que el argumento se ha pasado por parametro en el demonio (VERIFICAR).
  // Se puede definir con el largo real ya que el argumento se ha pasado por parametro en el demonio (VERIFICAR).


#line 17 "dbm_usuarios.pgc"
 int SQL_output ;
 
#line 18 "dbm_usuarios.pgc"
 char SQL_email [ 40 ] ;
 
#line 19 "dbm_usuarios.pgc"
 char SQL_password [ 10 ] ;
/* exec sql end declare section */
#line 21 "dbm_usuarios.pgc"


strcpy(SQL_email,email);
strcpy(SQL_password,password);

{ ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "select count ( * ) from usuarios where email = $1  and password = $2 ", 
	ECPGt_char,(SQL_email),(long)40,(long)1,(40)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_char,(SQL_password),(long)10,(long)1,(10)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EOIT, 
	ECPGt_int,&(SQL_output),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EORT);}
#line 26 "dbm_usuarios.pgc"


printf(sqlca.sqlerrm.sqlerrmc );
printf("\n");

db_commit();
ASSERT(SQL_output);
return SQL_output;
}

int get_id_usuario_por_nombre_apellido(char *nombre, char *apellido)
{
/* exec sql begin declare section */
  
  // ¿CON 20 o 21?
  // ¿CON 20 o 21?

#line 39 "dbm_usuarios.pgc"
 int SQL_output ;
 
#line 40 "dbm_usuarios.pgc"
 char SQL_nombre [ 21 ] ;
 
#line 41 "dbm_usuarios.pgc"
 char SQL_apellido [ 21 ] ;
/* exec sql end declare section */
#line 42 "dbm_usuarios.pgc"

printf("select id del nombre de usuario: %s \n",nombre);
printf("select id del apellido de usuario: %s \n",apellido);
//SQL_output = (Usuario*) malloc(sizeof(Usuario));
//memset(SQL_output, 0, sizeof(Usuario));
strcpy(SQL_nombre,nombre);
strcpy(SQL_apellido,apellido);
{ ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "select id from usuarios where nombre = $1  and apellido = $2 ", 
	ECPGt_char,(SQL_nombre),(long)21,(long)1,(21)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_char,(SQL_apellido),(long)21,(long)1,(21)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EOIT, 
	ECPGt_int,&(SQL_output),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EORT);}
#line 49 "dbm_usuarios.pgc"

printf(sqlca.sqlerrm.sqlerrmc );
printf("\n");
db_commit();

ASSERT(SQL_output);
return SQL_output;
}

int get_id_usuario_por_email(char *email)
{
/* exec sql begin declare section */
  
  

#line 61 "dbm_usuarios.pgc"
 int SQL_output ;
 
#line 62 "dbm_usuarios.pgc"
 char SQL_email [ 40 ] ;
/* exec sql end declare section */
#line 63 "dbm_usuarios.pgc"

printf("select id del email de usuario: %s \n",email);
 
//SQL_output = (Usuario*) malloc(sizeof(Usuario));
//memset(SQL_output, 0, sizeof(Usuario));
strcpy(SQL_email,email);
{ ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "select id from usuarios where email = $1 ", 
	ECPGt_char,(SQL_email),(long)40,(long)1,(40)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EOIT, 
	ECPGt_int,&(SQL_output),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EORT);}
#line 69 "dbm_usuarios.pgc"


db_commit();

ASSERT(SQL_output);
return SQL_output;
}

Usuario *insertar_usuario(char *email,char *nombre, char *apellido, char *password)
{
/* exec sql begin declare section */
 
 
 
 
 


#line 80 "dbm_usuarios.pgc"
 Usuario * SQL_output ;
 
#line 81 "dbm_usuarios.pgc"
 char SQL_email [ 40 ] ;
 
#line 82 "dbm_usuarios.pgc"
 char SQL_nombre [ 20 ] ;
 
#line 83 "dbm_usuarios.pgc"
 char SQL_apellido [ 20 ] ;
 
#line 84 "dbm_usuarios.pgc"
 char SQL_password [ 10 ] ;
/* exec sql end declare section */
#line 86 "dbm_usuarios.pgc"



strcpy(SQL_email,email);
strcpy(SQL_nombre,nombre);
strcpy(SQL_apellido,apellido);
strcpy(SQL_password,password);


SQL_output = (Usuario*) malloc(sizeof(Usuario));
memset(SQL_output, 0, sizeof(Usuario));

{ ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "insert into usuarios ( email , nombre , apellido , password ) values ( $1  , $2  , $3  , $4  )", 
	ECPGt_char,(SQL_email),(long)40,(long)1,(40)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_char,(SQL_nombre),(long)20,(long)1,(20)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_char,(SQL_apellido),(long)20,(long)1,(20)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_char,(SQL_password),(long)10,(long)1,(10)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EOIT, ECPGt_EORT);}
#line 98 "dbm_usuarios.pgc"

printf(sqlca.sqlerrm.sqlerrmc );
printf("\n");
SQL_output->verificador_error = sqlca.sqlcode;

db_commit();

ASSERT(SQL_output);
return SQL_output;

}

char *get_email_usuario_por_id(int id)
{
	/* exec sql begin declare section */
        
	 
	
#line 113 "dbm_usuarios.pgc"
 char * SQL_output ;
 
#line 114 "dbm_usuarios.pgc"
 int SQL_id ;
/* exec sql end declare section */
#line 115 "dbm_usuarios.pgc"

    SQL_id = id;

    { ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "select email from usuarios where usuarios . id = $1 ", 
	ECPGt_int,&(SQL_id),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EOIT, 
	ECPGt_char,&(SQL_output),(long)0,(long)1,(1)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EORT);}
#line 118 "dbm_usuarios.pgc"

    
	//SQL_output->verificador_error = sqlca.sqlcode;

	db_commit();

	ASSERT(SQL_output);
	return SQL_output;

}

int validar_registro_usuario(char *email_usuario)
{
    /* exec sql begin declare section */
     
     
    
#line 132 "dbm_usuarios.pgc"
 int SQL_output ;
 
#line 133 "dbm_usuarios.pgc"
 char SQL_email_usuario ;
/* exec sql end declare section */
#line 134 "dbm_usuarios.pgc"

    strcpy(SQL_email_usuario,email_usuario);

   // memset(SQL_output,' ',strlen(SQL_output));
   // printf("antes de select nombre objeto \n");
    
    { ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "select count ( * ) from usuarios where usuarios . email = $1 ", 
	ECPGt_char,&(SQL_email_usuario),(long)1,(long)1,(1)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EOIT, 
	ECPGt_int,&(SQL_output),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EORT);}
#line 140 "dbm_usuarios.pgc"


   // printf("despues de select nombre objeto \n");
    //SQL_output->verificador_error = sqlca.sqlcode;

    db_commit();

    ASSERT(SQL_output);
    return SQL_output;

}
