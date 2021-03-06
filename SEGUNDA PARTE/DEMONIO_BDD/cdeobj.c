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


	idcola = msgget(0070, 0666);


	idproceso = getpid();
	printf ("id cola: %d \n",idcola);
	printf("id proceso: %d \n",idproceso);

//-----------------------PARA TODOS LOS FORMULARIOS HASTA AQUI------------------------------------


	//se limpia mensaje antes de llenarlo con los datos traidos del formulario
	memset (&mensaje, 0, sizeof mensaje);

	printf("\nTX_IN->DATOS:%s\n",tx_in->datos);
	printf("\nmensaje.texto.datos_formulario: %s\n",mensaje.texto.datos_formulario);

	//strcpy(mensaje.texto.datos_formulario, tx_in->datos);

	printf("Copia de datos formulario a mensaje \n");

	strcpy(mensaje.formulario_actual,"cdeobj");

	mensaje.mtype = 1;
	mensaje.texto.idproceso = idproceso;

	//se envia el mensaje al demonio

	char men[2000];

	sprintf(men,"%15s%s",tx_sa->datos,tx_in->datos);

	puts(men);

	strcpy(mensaje.texto.datos_formulario, men);

	printf("Antes de enviar mensaje desde cdeobj\n");

	msgsnd (idcola, &mensaje, strlen (mensaje.texto.datos_formulario)+20, 0);

	printf("despues de enviar mensaje desde cdeobj\n");

	memset(&respuesta, 0, sizeof respuesta);

	strcpy(respuesta.texto.datos_formulario,"");

	idproceso = getpid();

	printf("Id proceso antes de recibir del demonio: %d \n", idproceso);

	printf("Id cola antes de reciibir del demonio: %d \n", idcola);

	respuesta.mtype = idproceso;

	printf("Idproceso (respuesta.mtype) antes de recibir %d \n",respuesta.mtype);

	printf("Respuesta antes del demonio: %s \n",respuesta.texto.datos_formulario);

	int valor_recibido = msgrcv (idcola, &respuesta, 2000, idproceso, 0);

	printf("Respuesta despues del demonio: %s \n",respuesta.texto.datos_formulario);

	printf("Idproceso (respuesta.mtype) despues de recibir %d \n",respuesta.mtype);

	printf("Id proceso respuesta (respuesta.texto.idproceso) despues de recibir del demonio: %d \n",respuesta.texto.idproceso);

	perror("msgrcv");

	printf("valor recibido de la respuesta msgrcv: %d \n", valor_recibido);
	printf("largo de la respuesta recibida %d \n",sizeof(respuesta.texto.datos_formulario));

	printf("mensaje.texto.datos_formulario = %s\n\n", mensaje.texto.datos_formulario);

	printf("mensaje.texto.datos_formulario:%s\n",mensaje.texto.datos_formulario);

	tx_out->len = sprintf(tx_out->datos,"%s", respuesta.texto.datos_formulario);

	if (strcmp(tx_out->datos, "01")==0){ // OBJETO BORRADO SATISFACTORIAMENTE
		aci[7]='2';		//LLEVA DIRECTAMENTE A MDEOBJ

	}
	if (strcmp(tx_out->datos, "02")==0){ // ERROR AL BORRAR OBJETO
		aci[7]='2'; 	//LLEVA DIRECTAMENTE A MDEOBJ

	}

	if (strcmp(tx_out->datos, "03")==0){ // MENSAJE CONFIRMACION NEGATIVO
		aci[7]='1';		//LLEVA DIRECTAMENTE A MENOBJ

	}
	if (strcmp(tx_out->datos, "04")==0){ // CARACTER INVALIDO
		aci[7]='2'; 	//LLEVA DIRECTAMENTE A MDEOBJ

	}




}
