#include <stdio.h>

#include <string.h>
#include <unistd.h>
#include <sys/ipc.h>
#include <sys/msg.h>
#include <sys/types.h>
//#include "dbm_conectar.h"
#include "dbm_conectar.h"
#include "dbm_prestamos.h"
#include "dbm_usuarios.h"
#include "dbm_objetos.h" 


int main()
{




struct msgbuf 
{
long mtype;
char formulario_actual[7];
	struct 
	{
	  int idproceso;
          
	  char datos_formulario[2000];
	} texto;
} mensaje, respuesta;

int idcola, idproceso;
char formulario_actual[7];

//idcola = msgget (6300451, IPC_CREAT|0666);
idcola = msgget (123456, IPC_CREAT|0666);


idproceso = getpid ();
printf("inicio demonio \n");
printf("--------------------------\n");
printf("|id cola    |id proceso   |\n");
printf("|  %d   | %d        |\n",idcola,idproceso);  
printf("--------------------------\n");


while(10)
{
   memset(&mensaje, 0, sizeof mensaje);
   memset (&respuesta, 0, sizeof respuesta);
printf("****************************************** \n");
printf("msgrcv (idcola, &mensaje, 2000, 1, 0); \n");
int largo_mensaje = msgrcv (idcola, &mensaje, 2000, idproceso, 0);
printf("idcola: %d \n",idcola);
printf("largo del mensaje: %d \n",largo_mensaje);
printf("mensaje.mtype: %d \n",mensaje.mtype);
printf("mensaje.datos.idproceos: %d \n",mensaje.texto.idproceso);
printf("mensaje: %s \n",mensaje.texto.datos_formulario);
printf("------------------------------------------- \n");
printf("msgrcv (idcola, &respuesta, 2000, idproceso, 0); \n");
int largo_respuesta = msgrcv (idcola, &respuesta, 2000, idproceso, 0);
printf("idcola: %d \n",idcola);
printf("largo de respuesta: %d \n",largo_respuesta);
printf("respuesta.mtype: %d \n",respuesta.mtype);
printf("respuesta.datos.idproceos: %d \n",respuesta.texto.idproceso);
printf("respuesta: %s \n",respuesta.texto.datos_formulario);

}




}
