#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <string.h>
#include <unistd.h>
#include <sys/ipc.h>
#include <sys/msg.h>
#include <sys/types.h>
#include "dbm_conectar.h"
#include "dbm_prestamos.h"
#include "dbm_usuarios.h"
#include "dbm_objetos.h"
//#include "dbm_conectar.h"

int main()
{
  struct monitor_demonio {
      long mtype;
      char formulario_actual[7];

      struct {
          int idproceso;

          char datos_formulario[2000];
      } texto;
  } mensaje, respuesta;

  int idcola, idproceso;
  char formulario_actual[7];

  //idcola = msgget (6300451, IPC_CREAT|0666);
  idcola = msgget(0070, IPC_CREAT | 0666);

  idproceso = getpid();

  printf("inicio demonio \n");
  printf("--------------------------\n");
  printf("|id cola    |id proceso   |\n");
  printf("|  %d   | %d        |\n", idcola, idproceso);
  printf("--------------------------\n");
  //printf ("id cola: %d \n",idcola);
  //printf("id proceso: %d \n",idproceso);

  if (db_conectar("b17957132_prestamo", "b17957132_prestamo", "prestados")) {
      printf("%s\n", "Failed to connect to database");
      return 1;
  }
  printf("despues de conectar \n");
  strcpy(formulario_actual, "");

  char fecha_prestamo[10]; // Recordar sumar +1 si el formulario esta definido con largo 10.
  int anio_prestamo;
  int mes_prestamo;
  int dia_prestamo;

  int id_usuario_prestador;
  int id_usuario_recibidor;
  int id_usuario;
  int id_usuario_dueno_objeto;
  int id_usuario_logueado;
  int id_objeto;

  int estado;

  char *fecha_devolucion[10]; //la deje como puntero porque me tomaba el dia de la fecha como 37 aunque mandara cualquier otro numero, y provocaba error al insertar en la base de datos.
  int anio_devolucion;
  int mes_devolucion;
  int dia_devolucion;

  //char *nombre_usuario_prestador[10]; //esta como puntero porque por alguna razon que no puede encontrar, al recibir los datos de hprest, en el valor de esta variable se guardaba el 52. Entre probar y probar le puse el * y funciono
  //char apellido_usuario_prestador[10] = "";
  char email_usuario_prestador[41];
  char *nombre_objeto[15];
  int cantidad_prestada;
  char email_usuario_recibidor[41];
  char email_usuario_dueno_objeto[30];
  //char nombre_usuario_recibidor[10];
  //char apellido_usuario_recibidor[10];

  Usuario *usr;
  Prestamo *prest;
  Objeto *obj;

  char email[41];
  char password[11];
  char nombre[21];
  char apellido[21];

  char id_obj[16]; // delobj
  char confirmacion[2]; // delobj
  // char id_prestamo[16];
  int id_prestamo; //editar prestamo

  char *resp[200];


  while(10)
  {
    memset(&mensaje, '\0', sizeof mensaje);
    memset(&respuesta, '\0', sizeof respuesta);

    printf("----------------- ESPERANDO NUEVO MENSAJE -----------------\n");

    int largo_mensaje = msgrcv(idcola, &mensaje, 2000, 1, 0);

    printf("largo del mensaje: %d \n", largo_mensaje);

    if (largo_mensaje > 0) {
      int id_proceso_destinatario = mensaje.texto.idproceso;

      strcpy(formulario_actual, mensaje.formulario_actual);

      printf("------------------------------------------------ \n");
      printf("    Llamada al demonio desde formulario: %s      \n", formulario_actual);
      printf("------------------------------------------------ \n");

      if (strcmp(formulario_actual, "loginn") == 0) {

        printf("************************** Formulario 'loginn' **************************\n");

        printf("-----> Logeo de usuario <-----\n");

        printf("El mensaje de recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

        char formulario[6];
        memset(email,'\0',sizeof email);
        memset(password,'\0',sizeof password);

        sscanf(mensaje.texto.datos_formulario, "%40c%10c", email, password);

        printf("El email recibido desde loginn es: %s \n", email);

        printf("La password recibida desde loggin es: %s \n", password);

        usr = logueo(email, password);

        printf("Valor recibido del logueo: %d \n", usr->verificador_error);

        if (usr->verificador_error == 0) {
          printf("ID USUARIO LOGUEADO: %d \n",usr->id);
          sprintf(respuesta.texto.datos_formulario,"%d-%s",usr->id,usr->email);

        }
        else
        {
            strcpy(respuesta.texto.datos_formulario, "01");
          }
        printf("************************** FIN Formulario 'loginn' **************************\n");

      }
    }//fin largo mensaje mayor a cero
  }//fin while

}
