#include <stdio.h>
#include <string.h>
#include <unistd.h>
#include <sys/ipc.h>
#include <sys/msg.h>
#include <sys/types.h>

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


             //sscanf(tx_in->datos,"%10s%10s%10s%15s%3d%10s%10s% 10s",fecha_prestamo,nombre_usuario_prestador,apellido_usuario_prestador,nombre_objeto,
 // &cantidad_prestada,nombre_usuario_recibidor,apellido_usuario_recibidor,fecha_devolucion);




strcpy(mensaje.texto.datos_formulario,tx_in->datos);
printf("copia de datos formulario a mensaje \n");
strcpy(mensaje.formulario_actual,"loginn");
mensaje.mtype = 1;
mensaje.texto.idproceso = idproceso;
//se envia el mensaje al demonio
printf("antes de enviar mensaje desde hprest \n");
//msgsnd (idcola, &mensaje, strlen (mensaje.texto.datos_formulario), 0);

msgsnd (idcola, &mensaje, strlen (mensaje.texto.datos_formulario)+20, 0);

printf("despues de enviar mensaje desde hprest \n");
//memset (&mensaje, 0, sizeof mensaje);
//se recibe el mensaje del demonio
//msgrcv (idcola, &mensaje, 2000, 1, 0);

memset(&respuesta, 0, sizeof respuesta);
strcpy(respuesta.texto.datos_formulario,"");
idproceso = getpid();
printf("idproceso antes de recibir del demonio: %d \n",idproceso);
printf("idcola antes de reciibir del demonio: %d \n",idcola);
respuesta.mtype = idproceso;
printf("idproceso (respuesta.mtype) antes de recibir %d \n",respuesta.mtype);
printf("respuesta antes del demonio: %s \n",respuesta.texto.datos_formulario);

int valor_recibido = msgrcv (idcola, &respuesta, 2000, idproceso, 0);
printf("respuesta despues de  del demonio: %s \n",respuesta.texto.datos_formulario);
printf("idproceso (respuesta.mtype) despues de recibir %d \n",respuesta.mtype);
printf("id proceso respuesta (respuesta.texto.idproceso) despues de recibir del demonio: %d \n",respuesta.texto.idproceso);
 perror("msgrcv");
//printf(" respuesta: %s \n",respuesta);
printf("valor recibido de la respuesta msgrcv: %d \n", valor_recibido);
printf("largo de la respuesta recibida %d \n",sizeof(respuesta.texto.datos_formulario));
printf("datos tx_out->datos: %s \n",tx_out->datos);

 if(strcmp(respuesta.texto.datos_formulario,"01") == 0)
 {
 
 aci[7]='1';
//printf("if form loginn \n");
 // strcpy(aci,"afmenpri00");
//tx_out->len = 8;
//strcpy(tx_out->datos,"menpri00"); 
}
 else
{
tx_out->len = 2;
memset(tx_out->datos,' ',2);
tx_out->len= sprintf(tx_out->datos,"%s", respuesta.texto.datos_formulario);
 }
//printf("fin form loginn \n");

//if(strcmp(respuesta.texto.datos_formulario,"01") == 0)
//aci[7] = '0021121';


//sscanf(respuesta.texto.datos_formulario,"%2s",tx_out->datos);



}
