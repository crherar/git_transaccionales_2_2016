#include <stdio.h>
#include <string.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/ipc.h>
#include <sys/msg.h>

struct trans
{
    int len;
    char datos[2000];
};

void proceso (char *aci, struct trans *tx_in, struct trans *tx_out,struct trans *tx_sa)
{

//int id_usuario_prestador;
//int id_usuario_recibidor;
//int id_objeto;
//int estado;
//char fecha_devolucion[10];

//char nombre_usuario_prestador[10];
//char apellido_usuario_prestador[10];
//char nombre_objeto[15];
//int cantidad_prestada;
//char nombre_usuario_recibidor[10];
//char apellido_usuario_recibidor[10];

//-------------PARA TODOS LOS FORMULARIOS DESDE AQUI--------------------------------
int idcola, idproceso;

struct monitor_demonio
{
long mtype;
char formulario_actual[7];
	struct
	{
	  int idproceso;

	  char datos_formulario[2000];
	} texto;
} mensaje, respuesta;

idcola = msgget(0070, 0666);
idproceso = getpid();
printf ("id cola: %d \n",idcola);
printf("id proceso: %d \n",idproceso);
memset (&mensaje, 0, sizeof mensaje);
strcpy(mensaje.texto.datos_formulario,tx_in->datos);
printf("copia de datos formulario a mensaje \n");
strcpy(mensaje.formulario_actual,"delami");
mensaje.mtype = 1;
mensaje.texto.idproceso = idproceso;
msgsnd (idcola, &mensaje, strlen (mensaje.texto.datos_formulario)+20, 0);
memset(&respuesta, 0, sizeof respuesta);
strcpy(respuesta.texto.datos_formulario,"");
idproceso = getpid();
respuesta.mtype = idproceso;
int valor_recibido = msgrcv (idcola, &respuesta, 2000, idproceso, 0);
tx_out->len= sprintf(tx_out->datos,"%s", respuesta.texto.datos_formulario);


return;

}
