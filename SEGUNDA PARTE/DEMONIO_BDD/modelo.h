#ifndef MODELO.H
#define MODELO.H


struct Usuario{
    int verificador_error;
    int id;
    char nombre[21];
    char apellido[21];
    char email[41];
    char password[11];
    char listado[2000];
};

 struct Objeto{
    int verificador_error;
    int id;
    char nombre[15];
};

struct Fecha{
  int anio;
   int mes;
    int dia;
};

struct Prestamo{
    int verificador_error;
    int id;
    char fecha_prestamo[11];
   //int anio_prestamo;
    //int mes_prestamo;
    //int dia_prestamo;
     //struct fecha fecha_prestamo;
    //struct fecha_prestamo{
    // int anio;
    // int mes;
    // int dia;
    // };

    int id_usuario_prestador;
    int id_usuario_recibidor;
    int id_objeto;
    int cantidad_prestada;
    int estado;
    //int anio_devolucion
    char fecha_devolucion[11];
    // struct fecha fecha_devolucion;
     //struct fecha_devolucion{
     //int anio;
    // int mes;
    // int dia;
    // };
}Prestamos;

struct MisPrestamos{
  int verificador_error;
  int id;
  char fecha_prestamo[11];
  char email_usuario_recibidor[40];
  char nombre_objeto[15];
  int cantidad_prestada;
  char fecha_devolucion[11];
};

struct Amigo{
    int verificador_error;
    int id;
    int id_amigo1;
    int id_amigo2;
};

struct Misamigos{
    int id_usuario_logueado;
    char emailamigo[40];
    char listado[2000];
};

struct Reputacion{
    int verificador_error;
    int id_usuario_clasificador;
    int clasificacion;
    char comentario[100];
    char listado[2000];
};

typedef struct Objeto Objeto;
typedef struct Usuario Usuario;
typedef struct Fecha Fecha;
typedef struct Prestamo Prestamo;
typedef struct MisPrestamos MisPrestamos;
typedef struct Amigo Amigo;
typedef struct Misamigos Misamigos;
typedef struct Reputacion Reputacion;
#endif
