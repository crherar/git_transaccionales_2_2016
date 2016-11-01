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

void proceso (char *aci , struct trans *tx_in, struct trans *tx_out, struct trans *tx_sa)
{

 int rut;
 char nombre[31];

memset (nombre, 0, sizeof nombre);

printf("\n-------- RECIBIDO --------\n\n");

// tx_in tiene la tx de entrada
sscanf (tx_in->datos, "%30c%9d", nombre, &rut);
printf( "Llego desde el formulario: %s\n", tx_in->datos);

printf("Nombre:  %s\n", nombre);
printf("Rut:  %9d\n", rut);

// Comunicacion con el demonio


int qid,pid;

	struct msgbuf {
		long mtype;
		struct {
			int pid;
			char dat[2000];
		} texto;
	} mensaje, respuesta;

	qid = msgget(5942016, 0666);
	pid = getpid();

	// Limpiamos la estructura del mensaje
	memset(&mensaje, 0, sizeof mensaje);

	// guardamos en la estructura mensaje lo que se quiere enviar al demonio
	sprintf(mensaje.texto.dat, "%6s%s%d", "formej", nombre, rut);

	mensaje.mtype = 1;
	mensaje.texto.pid = pid;
	msgsnd(qid, &mensaje, strlen(mensaje.texto.dat)+4,0);

	// Limpiamos la estructura de respuesta
	memset(&respuesta, 0, sizeof respuesta);

	msgrcv(qid, &respuesta, 2000, pid, 0);
	
	printf("\n\n -------- RESPUESTA --------\n\n");

	printf("respuesta demonio: %s\n\n", respuesta.texto.dat);

	// en tx out se debe dejar la tx se salida
	tx_out->len= sprintf (tx_out->datos,"%s", respuesta.texto.dat);


}



