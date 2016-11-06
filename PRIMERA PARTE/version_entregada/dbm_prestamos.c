/* Processed by ecpg (4.9.0) */
/* These include files are added by the preprocessor */
#include <ecpglib.h>
#include <ecpgerrno.h>
#include <sqlca.h>
/* End of automatic include section */

#line 1 "dbm_prestamos.pgc"
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

#line 3 "dbm_prestamos.pgc"

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


#line 8 "dbm_prestamos.pgc"

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
#line 9 "dbm_prestamos.pgc"


Prestamo * insertar_prestamo(char *fecha_prestamo ,int id_usuario_prestador,int id_objeto,int cantidad,int id_usuario_recibidor,char  *fecha_devolucion){
        printf("inicio insertar prestamo \n");
	/* exec sql begin declare section */
	 
	 	
	 
	 
         
	 
	 
	 
	
#line 14 "dbm_prestamos.pgc"
 Prestamo * SQL_output ;
 
#line 15 "dbm_prestamos.pgc"
 char SQL_fecha_prestamo [ 11 ] ;
 
#line 16 "dbm_prestamos.pgc"
 int SQL_id_usuario_prestador ;
 
#line 17 "dbm_prestamos.pgc"
 int SQL_id_objeto ;
 
#line 18 "dbm_prestamos.pgc"
 int SQL_cantidad ;
 
#line 19 "dbm_prestamos.pgc"
 int SQL_estado ;
 
#line 20 "dbm_prestamos.pgc"
 int SQL_id_usuario_recibidor ;
 
#line 21 "dbm_prestamos.pgc"
 char SQL_fecha_devolucion [ 11 ] ;
/* exec sql end declare section */
#line 22 "dbm_prestamos.pgc"

	printf("fin declaracion variables \n");
	//char* fecha_prest = 
	//strcpy(SQL_fecha_prestamo,strcat(fecha_prestamo->anio,"-",fecha_prestamo->mes,"-",fecha_prestamo->dia));
	//strcpy(SQL_fecha_prestamo,fecha_prestamo->anio+"-"+fecha_prestamo->mes+"-"+fecha_prestamo->dia);
        strcpy(SQL_fecha_prestamo,fecha_prestamo);
	printf("strcpy fecha_prestamo \n");
        SQL_id_usuario_prestador = id_usuario_prestador;
	SQL_id_objeto = id_objeto;
	SQL_cantidad = cantidad;
	SQL_id_usuario_recibidor = id_usuario_recibidor;
	SQL_estado = 0;
	printf("strcpy fecha_devolucion \n");
         
        memset(SQL_fecha_devolucion,' ',11);
        strcpy(SQL_fecha_devolucion,fecha_devolucion);
	printf("fin strcpy \n");
        //strcpy(SQL_id_usuario_prestador,id_usuario_prestador);
	//strcpy(SQL_id_objeto,id_objeto);
	//strcpy(SQL_cantidad,cantidad);
	//strcpy(SQL_id_usuario_recibidor,id_usuario_recibidor);
	//strcpy(SQL_fecha_devolucion,fecha_devolucion->anio+"-"+fecha_devolucion->mes+"-"+fecha_devolucion->dia);
        //strcpy(SQL_fecha_devolucion,strcat(fecha_devolucion->anio,"-",fecha_devolucion->mes,"-",fecha_devolucion->dia));

	 

	SQL_output = (Prestamo*) malloc(sizeof(Prestamo));
	memset(SQL_output, 0, sizeof(Prestamo));
	//printf(SQL_fecha_prestamo + "\n");
	//printf(SQL_id_usuario_prestador + "\n");
	//printf(SQL_id_usuario_recibidor + "\n");
	//printf(SQL_fecha_devolucion + "\n");
	{ ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "insert into prestamos ( fecha , id_usuario_prestador , id_usuario_recibidor , id_objeto , estado , fecha_devolucion , cantidad_prestada ) values ( $1  , $2  , $3  , $4  , $5  , $6  , $7  )", 
	ECPGt_char,(SQL_fecha_prestamo),(long)11,(long)1,(11)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_int,&(SQL_id_usuario_prestador),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_int,&(SQL_id_usuario_recibidor),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_int,&(SQL_id_objeto),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_int,&(SQL_estado),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_char,(SQL_fecha_devolucion),(long)11,(long)1,(11)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_int,&(SQL_cantidad),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EOIT, ECPGt_EORT);}
#line 55 "dbm_prestamos.pgc"

	

	printf("\n");
	SQL_output->verificador_error = sqlca.sqlcode;
	printf("\ns\nqlca:%s\n\n", sqlca.sqlerrm.sqlerrmc);
	printf("antes de hacer commit \n");
        
    db_commit();
	ASSERT(SQL_output);
	return SQL_output;

}

Prestamo * actualizar_prestamo(char *fecha_prestamo ,int id_usuario_prestador,int id_objeto,int id_usuario_recibidor,char  *fecha_devolucion,int estado,int cantidad_prestada,int id_prestamo){
        printf("inicio actualizar prestamo\n");
	/* exec sql begin declare section */
	 
	 	
	 
	 
     
	 
	 
	 
	 
	
#line 72 "dbm_prestamos.pgc"
 Prestamo * SQL_output ;
 
#line 73 "dbm_prestamos.pgc"
 char SQL_fecha_prestamo [ 11 ] ;
 
#line 74 "dbm_prestamos.pgc"
 int SQL_id_usuario_prestador ;
 
#line 75 "dbm_prestamos.pgc"
 int SQL_id_objeto ;
 
#line 76 "dbm_prestamos.pgc"
 int SQL_cantidad_prestada ;
 
#line 77 "dbm_prestamos.pgc"
 int SQL_estado ;
 
#line 78 "dbm_prestamos.pgc"
 int SQL_id_usuario_recibidor ;
 
#line 79 "dbm_prestamos.pgc"
 char SQL_fecha_devolucion [ 11 ] ;
 
#line 80 "dbm_prestamos.pgc"
 int SQL_id_prestamo ;
/* exec sql end declare section */
#line 81 "dbm_prestamos.pgc"

	printf("fin declaracion variables \n");

        strcpy(SQL_fecha_prestamo,fecha_prestamo);
	printf("strcpy fecha_prestamo \n");
    SQL_id_usuario_prestador = id_usuario_prestador;
	SQL_id_objeto = id_objeto;
	SQL_cantidad_prestada = cantidad_prestada;
	SQL_id_usuario_recibidor = id_usuario_recibidor;
	SQL_estado = estado;
	SQL_id_prestamo = id_prestamo;
	printf("strcpy fecha_devolucion \n");
         
        memset(SQL_fecha_devolucion,' ',11);
        strcpy(SQL_fecha_devolucion,fecha_devolucion);
	//printf("fin strcpy \n");
        //strcpy(SQL_id_usuario_prestador,id_usuario_prestador);
	//strcpy(SQL_id_objeto,id_objeto);
	//strcpy(SQL_cantidad,cantidad);
	//strcpy(SQL_id_usuario_recibidor,id_usuario_recibidor);
	//strcpy(SQL_fecha_devolucion,fecha_devolucion->anio+"-"+fecha_devolucion->mes+"-"+fecha_devolucion->dia);
        //strcpy(SQL_fecha_devolucion,strcat(fecha_devolucion->anio,"-",fecha_devolucion->mes,"-",fecha_devolucion->dia));

	 

	SQL_output = (Prestamo*) malloc(sizeof(Prestamo));
	memset(SQL_output, 0, sizeof(Prestamo));
	//printf(SQL_fecha_prestamo + "\n");
	//printf(SQL_id_usuario_prestador + "\n");
	//printf(SQL_id_usuario_recibidor + "\n");
	//printf(SQL_fecha_devolucion + "\n");
	printf("\n\nSQL_ID_PRESTAMO:%d\n\n", SQL_id_prestamo);
    { ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "update PRESTAMOS set fecha = $1  , id_usuario_prestador = $2  , id_usuario_recibidor = $3  , id_objeto = $4  , estado = $5  , fecha_devolucion = $6  , cantidad_prestada = $7  where id = $8 ", 
	ECPGt_char,(SQL_fecha_prestamo),(long)11,(long)1,(11)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_int,&(SQL_id_usuario_prestador),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_int,&(SQL_id_usuario_recibidor),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_int,&(SQL_id_objeto),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_int,&(SQL_estado),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_char,(SQL_fecha_devolucion),(long)11,(long)1,(11)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_int,&(SQL_cantidad_prestada),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_int,&(SQL_id_prestamo),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EOIT, ECPGt_EORT);}
#line 121 "dbm_prestamos.pgc"


	
	



	printf(sqlca.sqlerrm.sqlerrmc );

	printf("\n");
	SQL_output->verificador_error = sqlca.sqlcode;
	printf("antes de hacer commit \n");
        
    db_commit();
	ASSERT(SQL_output);
	return SQL_output;

}

Prestamo *get_prestamo_por_id(int id)
{
	printf("Inicio get prestamo por id \n");
	/* exec sql begin declare section */
	 
	 
	
#line 144 "dbm_prestamos.pgc"
 Prestamo * SQL_output ;
 
#line 145 "dbm_prestamos.pgc"
 int SQL_id ;
/* exec sql end declare section */
#line 146 "dbm_prestamos.pgc"

	SQL_id = id;
    printf("id del prestamo: %d \n",id);
	SQL_output = (Prestamo*) malloc(sizeof(Prestamo));
	memset(SQL_output, 0, sizeof(Prestamo));
  //  printf ("antes del select \n");
   // SQL_output->estado = 0;
   // SQL_output->cantidad_prestada = 0;
	{ ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "select to_char ( prestamos . fecha , 'yyyymmdd' ) , prestamos . id_usuario_prestador , prestamos . id_usuario_recibidor , prestamos . id_objeto , prestamos . cantidad_prestada , to_char ( prestamos . fecha_devolucion , 'yyyymmdd' ) , prestamos . estado from prestamos where prestamos . id = $1 ", 
	ECPGt_int,&(SQL_id),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EOIT, 
	ECPGt_char,(SQL_output->fecha_prestamo),(long)11,(long)1,(11)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_int,&(SQL_output->id_usuario_prestador),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_int,&(SQL_output->id_usuario_recibidor),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_int,&(SQL_output->id_objeto),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_int,&(SQL_output->cantidad_prestada),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_char,(SQL_output->fecha_devolucion),(long)11,(long)1,(11)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_int,&(SQL_output->estado),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EORT);}
#line 172 "dbm_prestamos.pgc"

	puts(SQL_output->fecha_devolucion);
	printf("fecha devolucion sql_output: %s \n",SQL_output->fecha_devolucion);
   // printf("despues del select \n");
    printf(sqlca.sqlerrm.sqlerrmc );
    printf("\n");
	SQL_output->verificador_error = sqlca.sqlcode;
	db_commit();
	//ASSERT(SQL_output);
    printf("antes del return \n");
	return SQL_output;
}




