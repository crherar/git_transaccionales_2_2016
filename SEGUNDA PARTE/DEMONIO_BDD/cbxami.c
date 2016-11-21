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


//idcola =  msgget (6300451, 0666);
idcola = msgget(0070, 0666);
idproceso = getpid();
printf ("id cola: %d \n",idcola);
printf("id proceso: %d \n",idproceso);
//-----------------------PARA TODOS LOS FORMULARIOS HASTA AQUI------------------------------------

//se limpia mensaje antes de llenarlo con los datos traidos del formulario
memset (&mensaje, 0, sizeof mensaje);
strcpy(mensaje.texto.datos_formulario,tx_in->datos);
printf("copia de datos formulario a mensaje \n");
strcpy(mensaje.formulario_actual,"cbxami");
mensaje.mtype = 1;
mensaje.texto.idproceso = idproceso;
//se envia el mensaje al demonio

//msgsnd (idcola, &mensaje, strlen (mensaje.texto.datos_formulario), 0);
msgsnd (idcola, &mensaje, strlen (mensaje.texto.datos_formulario)+20, 0);
//memset (&mensaje, 0, sizeof mensaje);
//se recibe el mensaje del demonio
//msgrcv (idcola, &mensaje, 2000, 1, 0);

memset(&respuesta, 0, sizeof respuesta);
strcpy(respuesta.texto.datos_formulario,"");
idproceso = getpid();
respuesta.mtype = idproceso;
int valor_recibido = msgrcv (idcola, &respuesta, 2000, idproceso, 0);
//printf(" respuesta: %s \n",respuesta);
//if(strcmp(respuesta.texto.datos_formulario,"01") == 0)
//aci[7] = '0021121';
//tx_out->len = 2;
//memset(tx_out->datos,' ',2);
//sscanf(respuesta.texto.datos_formulario,"%2s",tx_out->datos);
tx_out->len= sprintf(tx_out->datos,"%s", respuesta.texto.datos_formulario);


return;

}