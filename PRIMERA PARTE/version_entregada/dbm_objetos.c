/* Processed by ecpg (4.9.0) */
/* These include files are added by the preprocessor */
#include <ecpglib.h>
#include <ecpgerrno.h>
#include <sqlca.h>
/* End of automatic include section */

#line 1 "dbm_objetos.pgc"
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

#line 4 "dbm_objetos.pgc"

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


#line 9 "dbm_objetos.pgc"

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
#line 10 "dbm_objetos.pgc"


int get_id_objeto(char *nombre_objeto)
{
/* exec sql begin declare section */
  
 


#line 15 "dbm_objetos.pgc"
 int SQL_output ;
 
#line 16 "dbm_objetos.pgc"
 char SQL_nombre_obj [ 15 ] ;
/* exec sql end declare section */
#line 18 "dbm_objetos.pgc"


//SQL_output = (Usuario*) malloc(sizeof(Usuario));
//memset(SQL_output, 0, sizeof(Usuario));
strcpy(SQL_nombre_obj,nombre_objeto);
 
{ ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "select id from objetos where nombre = $1 ", 
	ECPGt_char,(SQL_nombre_obj),(long)15,(long)1,(15)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EOIT, 
	ECPGt_int,&(SQL_output),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EORT);}
#line 24 "dbm_objetos.pgc"

db_commit();

ASSERT(SQL_output);
return SQL_output;
}


Objeto *insertar_objeto(int id_usuario_dueno,char *nombre_objeto)
{
/* exec sql begin declare section */
  
  
 


#line 35 "dbm_objetos.pgc"
 Objeto * SQL_output ;
 
#line 36 "dbm_objetos.pgc"
 int SQL_id_usuario_dueno ;
 
#line 37 "dbm_objetos.pgc"
 char SQL_nombre_obj [ 15 ] ;
/* exec sql end declare section */
#line 39 "dbm_objetos.pgc"


strcpy(SQL_nombre_obj,nombre_objeto);
SQL_id_usuario_dueno = id_usuario_dueno;

SQL_output = (Objeto*) malloc(sizeof(Objeto));
memset(SQL_output, 0, sizeof(Objeto));

{ ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "insert into objetos ( nombre , id_usuario_dueno ) values ( $1  , $2  )", 
	ECPGt_char,(SQL_nombre_obj),(long)15,(long)1,(15)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_int,&(SQL_id_usuario_dueno),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EOIT, ECPGt_EORT);}
#line 47 "dbm_objetos.pgc"

printf(sqlca.sqlerrm.sqlerrmc );
printf("\n");
SQL_output->verificador_error = sqlca.sqlcode;
	//printf("antes de hacer commit \n");
        
db_commit();
ASSERT(SQL_output);
return SQL_output;
}

char *get_listado_objetos(int pagina)//debe venir por parametro la id del usuario
{
/* exec sql begin declare section */
  
 
 
//int  SQL_id_usuario_dueno;
//char SQL_nombre_obj[15];


#line 61 "dbm_objetos.pgc"
 Objeto * SQL_output ;
 
#line 62 "dbm_objetos.pgc"
 int SQL_pagina ;
 
#line 63 "dbm_objetos.pgc"
 int SQL_count ;
/* exec sql end declare section */
#line 67 "dbm_objetos.pgc"


SQL_pagina = (pagina-1)*10;
{ ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "select count ( * ) from objetos limit 10 offset $1 ", 
	ECPGt_int,&(SQL_pagina),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EOIT, 
	ECPGt_int,&(SQL_count),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EORT);}
#line 70 "dbm_objetos.pgc"


if(SQL_count == 0) return "no hay datos";


//if(SQL_count == 0)
    //char datos[1] = "";
//else
//char datos[200] = "";

SQL_output = (Objeto*) malloc(sizeof(Objeto) * (SQL_count + 1));
//SQL_output[SQL_count].SQL_CODE = 0;
//memset(SQL_output, 0, sizeof(Objeto));


ECPGset_var( 0, &( SQL_pagina ), __LINE__);\
 /* declare RESULT_SET cursor for select concat ( id , ' - ' , nombre ) from objetos order by id limit 10 offset $1  */
#line 86 "dbm_objetos.pgc"

{ ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "declare RESULT_SET cursor for select concat ( id , ' - ' , nombre ) from objetos order by id limit 10 offset $1 ", 
	ECPGt_int,&(SQL_pagina),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EOIT, ECPGt_EORT);}
#line 87 "dbm_objetos.pgc"


int resultset_pos = 0;

//EXEC SQL SELECT nombre INTO :SQL_output->nombre FROM objetos;



char nombre_obj[15] = "";
char datos[200] = "";
printf("antes del while \n");
while(!sqlca.sqlcode && resultset_pos < SQL_count){
	{ ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "fetch next from RESULT_SET", ECPGt_EOIT, 
	ECPGt_char,(SQL_output[resultset_pos].nombre),(long)15,(long)1,(15)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EORT);}
#line 99 "dbm_objetos.pgc"

        printf("nombre: %s \n",SQL_output[resultset_pos].nombre);
        int tamanio = strlen(SQL_output[resultset_pos].nombre);
        if(tamanio <=15)
        {
         //if(tamanio >0)
         printf("tamanio: %d \n",tamanio);
         int num_espacios = 15 - tamanio; 
         printf("num_espacios: %d \n",num_espacios);
         char espacios[15 - tamanio];
         printf("largo espacios: %d \n",strlen(espacios));
        
        

        //memset(espacios,' ',num_espacios);
        
        //for(int i = 0;i<num_espacios;i++){
        //  espacios[i] = ' ';
        //}
        
         strcpy(nombre_obj, SQL_output[resultset_pos].nombre);
        //strcat(nombre_obj,espacios);
        //memset(nombre_obj, ' ', espacios);
         int i;
         for(i = 0;i<num_espacios;i++){
          strcat(nombre_obj," ");
         }
         strcat(datos,nombre_obj);
        //char espacios[15 - tamanio];
        //memset(espacios,' ',sizeof(espacios));
        //char nombre = 
        //strcat(datos,SQL_output[resultset_pos].nombre);
        //strcat(datos,espacios);
	//SQL_output[resultset_pos].SQL_CODE = 1;
	 
         } 
         
	}

{ ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "close RESULT_SET", ECPGt_EOIT, ECPGt_EORT);}
#line 138 "dbm_objetos.pgc"

printf("despues del while \n");

printf(sqlca.sqlerrm.sqlerrmc );
printf("\n");
SQL_output->verificador_error = sqlca.sqlcode;
	//printf("antes de hacer commit \n");
       
db_commit();
ASSERT(SQL_output);
printf("datos en el sql %s \n",datos);
printf("largo datos en el sql %d \n",strlen(datos));
return datos;
}

int borrar_objeto(int id_objeto)
{

    /* exec sql begin declare section */
    
      

    
#line 158 "dbm_objetos.pgc"
 int SQL_id_objeto ;
/* exec sql end declare section */
#line 160 "dbm_objetos.pgc"


    SQL_id_objeto = id_objeto;

    { ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "delete from objetos where objetos . id = $1 ", 
	ECPGt_int,&(SQL_id_objeto),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EOIT, ECPGt_EORT);}
#line 164 "dbm_objetos.pgc"


    printf("\n\n Sqlca Sqlcode: %d\n\n", sqlca.sqlcode);

    printf(sqlca.sqlerrm.sqlerrmc );

    int resp;
    resp = sqlca.sqlcode;

    db_commit();
    
    return resp;
}



char *get_nombre_objeto_por_id(int id)
{
    /* exec sql begin declare section */
     
     
    
#line 183 "dbm_objetos.pgc"
 char * SQL_output ;
 
#line 184 "dbm_objetos.pgc"
 int SQL_id ;
/* exec sql end declare section */
#line 185 "dbm_objetos.pgc"

    SQL_id = id;

    memset(SQL_output,' ',strlen(SQL_output));

    { ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "select objetos . nombre from objetos where objetos . id = $1 ", 
	ECPGt_int,&(SQL_id),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EOIT, 
	ECPGt_char,&(SQL_output),(long)0,(long)1,(1)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EORT);}
#line 190 "dbm_objetos.pgc"


   // printf("despues de select nombre objeto \n");

    db_commit();

    ASSERT(SQL_output);
    return SQL_output;

}



Objeto *get_nombre_objeto_por_id2(int id)
{
    /* exec sql begin declare section */
     
     
    
#line 206 "dbm_objetos.pgc"
 Objeto * SQL_output ;
 
#line 207 "dbm_objetos.pgc"
 int SQL_id ;
/* exec sql end declare section */
#line 208 "dbm_objetos.pgc"

    SQL_id = id;
    SQL_output = (Objeto*) malloc(sizeof(Objeto));
    memset(SQL_output,' ',strlen(SQL_output));
   // printf("antes de select nombre objeto \n");
    
    { ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "select objetos . id , objetos . nombre from objetos where objetos . id = $1 ", 
	ECPGt_int,&(SQL_id),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EOIT, 
	ECPGt_int,&(SQL_output->id),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_char,(SQL_output->nombre),(long)15,(long)1,(15)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EORT);}
#line 214 "dbm_objetos.pgc"


   // printf("despues de select nombre objeto \n");
 
    SQL_output->verificador_error = sqlca.sqlcode;
    db_commit();

    ASSERT(SQL_output);
    return SQL_output;

}

int validar_registro_objeto(char *nombre_objeto, int id_dueno_objeto)
{
    /* exec sql begin declare section */
     
     
     
    
#line 229 "dbm_objetos.pgc"
 int SQL_output ;
 
#line 230 "dbm_objetos.pgc"
 char SQL_nombre_objeto [ 15 ] ;
 
#line 231 "dbm_objetos.pgc"
 int SQL_id_dueno_objeto ;
/* exec sql end declare section */
#line 232 "dbm_objetos.pgc"

    strcpy(SQL_nombre_objeto,nombre_objeto);
    SQL_id_dueno_objeto = id_dueno_objeto;
   // memset(SQL_output,' ',strlen(SQL_output));
   // printf("antes de select nombre objeto \n");
    { ECPGdo(__LINE__, 0, 1, NULL, 0, ECPGst_normal, "select count ( * ) from objetos where objetos . nombre = $1  and objetos . id_usuario_dueno = $2 ", 
	ECPGt_char,(SQL_nombre_objeto),(long)15,(long)1,(15)*sizeof(char), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, 
	ECPGt_int,&(SQL_id_dueno_objeto),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EOIT, 
	ECPGt_int,&(SQL_output),(long)1,(long)1,sizeof(int), 
	ECPGt_NO_INDICATOR, NULL , 0L, 0L, 0L, ECPGt_EORT);}
#line 238 "dbm_objetos.pgc"


   // printf("despues de select nombre objeto \n");
    //SQL_output->verificador_error = sqlca.sqlcode;

    db_commit();

    ASSERT(SQL_output);
    return SQL_output;
}







