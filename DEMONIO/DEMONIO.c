#include <stdio.h>
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

int main() {

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
    int id_usuario_dueno_objeto;
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


    /* *****************************************************************************************************************
     *                                                    FORMULARIOS                                                  *
     * *****************************************************************************************************************/


    while (10) // While Infinito
    {

        memset(&mensaje, 0, sizeof mensaje);
        memset(&respuesta, 0, sizeof respuesta);

        printf("----------------- ESPERANDO NUEVO MENSAJE -----------------\n");

        int largo_mensaje = msgrcv(idcola, &mensaje, 2000, 1, 0);

        printf("largo del mensaje: %d \n", largo_mensaje);

        if (largo_mensaje > 0) {

            int id_proceso_destinatario = mensaje.texto.idproceso;

            strcpy(formulario_actual, mensaje.formulario_actual);

            printf("------------------------------------------------ \n");
            printf("    Llamada al demonio desde formulario: %s      \n", formulario_actual);
            printf("------------------------------------------------ \n");

            /**************************************
                    FORMULARIO "loginn"
             **************************************/

            if (strcmp(formulario_actual, "loginn") == 0) {

                printf("************************** Formulario 'loginn' **************************\n");

                printf("-----> Logeo de usuario <-----\n");

                printf("El mensaje de recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                sscanf(mensaje.texto.datos_formulario, "%40s%10s", email, password);

                printf("El email recibido desde loginn es: %s \n", email);

                printf("La password recibida desde loggin es: %s \n", password);

                int resp = logueo(email, password);

                printf("Valor recibido del logueo: %d \n", resp);

                if (resp == 1) {
                    strcpy(respuesta.texto.datos_formulario, "01");
                } else if (resp == 0) {
                    strcpy(respuesta.texto.datos_formulario, "02");
                } else {
                    strcpy(respuesta.texto.datos_formulario, "03");
                }
                printf("************************** FIN Formulario 'loginn' **************************\n");
            }

            /* ********************************************************************************************************* */

            /**************************************
                    FORMULARIO "regusr"
             **************************************/

            if (strcmp(formulario_actual, "regusr") == 0) {

                printf("************************** Formulario 'regusr' **************************\n");

                printf("-----> Registro de nuevo usuario <-----\n");

                printf("El mensaje de recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                sscanf(mensaje.texto.datos_formulario, "%40s%20s%20s%10s", email, nombre, apellido, password);

                printf("El email recibido desde regusr es: %s \n", email);

                printf("El nombre recibido desde regusr es: %s \n", nombre);

                printf("El apellido recibida desde regusr es: %s \n", apellido);

                printf("La password recibida desde regusr es: %s \n", password);

                usr = insertar_usuario(email, nombre, apellido, password);

                printf("La respuesta de insertar usuario es: %d \n", usr->verificador_error);

                if (usr->verificador_error == 0) {
                    strcpy(respuesta.texto.datos_formulario, "01");
                } else {
                    strcpy(respuesta.texto.datos_formulario, "02");
                }



                printf("************************** FIN Formulario 'regusr' **************************\n");
            }


            /* ********************************************************************************************************* */

            /**************************************
                    FORMULARIO "hprest"
             **************************************/

            if (strcmp(formulario_actual, "hprest") == 0) {

                printf("************************** Formulario 'hprest' **************************\n");

                printf("-----> Registro de nuevo prestamo <-----\n");

                printf("El mensaje recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                sscanf(mensaje.texto.datos_formulario, "%4d%2d%2d%40s%15s%3d%40s%4d%2d%2d", &anio_prestamo, &mes_prestamo, &dia_prestamo, email_usuario_prestador, nombre_objeto,
                        &cantidad_prestada, email_usuario_recibidor, &anio_devolucion, &mes_devolucion, &dia_devolucion);

                sprintf(fecha_prestamo, "%d-%d-%d", anio_prestamo, mes_prestamo, dia_prestamo);

                sprintf(fecha_devolucion, "%d-%d-%d", anio_devolucion, mes_devolucion, dia_devolucion);

                printf("Fecha del prestamo recibido es: %s \n", fecha_prestamo);
                printf("Cantidad prestada recibida es: %d \n", cantidad_prestada);
                printf("El email del usuario prestador recibido es: %s \n", email_usuario_prestador);
                printf("El email del usuario recibidor es: %s \n", email_usuario_recibidor);
                printf("Dia fecha de devolucion recibido es: %d \n", dia_devolucion);
                printf("fecha devolucion recibida es: %s \n", fecha_devolucion);

                id_usuario_prestador = get_id_usuario_por_email(email_usuario_prestador);
                id_usuario_recibidor = get_id_usuario_por_email(email_usuario_recibidor);

                id_objeto = get_id_objeto(nombre_objeto);

                printf("La id del objeto prestado es: %d \n", id_objeto);
                printf("La id del usuario prestador es %d y la del usuario recibidor es %d \n", id_usuario_prestador, id_usuario_recibidor);

                prest = insertar_prestamo(fecha_prestamo, id_usuario_prestador, id_objeto, cantidad_prestada,
                        id_usuario_recibidor, fecha_devolucion);

                printf("La respuesta luego de insertar el prestamo es: %d \n", prest->verificador_error);

                if (prest->verificador_error == 0) {
                    strcpy(respuesta.texto.datos_formulario, "01");
                } else {
                    strcpy(respuesta.texto.datos_formulario, "02");
                }

                printf("************************** FIN Formulario 'hprest' **************************\n");

            }

            /* ********************************************************************************************************* */

            /**************************************
                    FORMULARIO "regobj"
             **************************************/

            if (strcmp(formulario_actual, "regobj") == 0) {

                printf("************************** Formulario 'regobj' **************************\n");

                printf("-----> Registro nuevo objeto <-----\n");

                printf("El mensaje recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                sscanf(mensaje.texto.datos_formulario, "%40s%15s", email_usuario_dueno_objeto, nombre_objeto);

                printf("El email del dueño objeto es: %s \n", email_usuario_dueno_objeto);
                printf("El nombre del objeto recibido es: %s \n", nombre_objeto);

                id_usuario_dueno_objeto = get_id_usuario_por_email(email_usuario_dueno_objeto);

                obj = insertar_objeto(id_usuario_dueno_objeto, nombre_objeto);

                printf("La respuesta luego de insertar objeto es: %d \n", obj->verificador_error);
                if (obj->verificador_error == 0) {
                    strcpy(respuesta.texto.datos_formulario, "01");
                } else {
                    strcpy(respuesta.texto.datos_formulario, "02");
                }
                printf("************************** FIN Formulario 'regobj' **************************\n");

            }

            /* ********************************************************************************************************* */

            /**************************************
                    FORMULARIO "verobj"
             **************************************/

            if (strcmp(formulario_actual, "verobj") == 0) {

                printf("************************** Formulario 'verobj' **************************\n");

                printf("-----> Ver objetos <-----\n");

                printf("El mensaje recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                char mis_objetos[170] = "";
                int pagina;

                sscanf(mensaje.texto.datos_formulario, "%2d", &pagina);
                strcpy(mis_objetos, get_listado_objetos(pagina));

                printf("Los objetos son: %s \n", mis_objetos);
                printf("despues de obtener los objetos \n");

                if (strcmp(mis_objetos, "no hay datos") == 0) { //char error[153];
                    //respuesta.texto.datos_formulario[151] = '0'
                    //respuesta.texto.datos_formulario[152] = '1';
                    strcpy(respuesta.texto.datos_formulario, "01");
                } else {
                    strcpy(respuesta.texto.datos_formulario, mis_objetos);
                }
                //printf("tamaño de obj: %d \n", sizeof (obj));
                //printf("nombre objeto [0]: %s \n",obj[0].nombre);
                //printf("nombre objeto [1]: %s \n",obj[1].nombre);
                //printf("nombre objeto [2]: %s \n",obj[2].nombre);

                printf("************************** FIN Formulario 'verobj' **************************\n");

            }

            /* ********************************************************************************************************* */

            /**************************************
                    FORMULARIO "delobj"
             **************************************/

            if (strcmp(formulario_actual, "delobj") == 0) {

                printf("************************** Formulario 'delobj' **************************\n");

                printf("-----> Borrar objeto <-----\n");

                printf("El mensaje de recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                sscanf(mensaje.texto.datos_formulario, "%15d", &id_objeto);

                printf("El id recibido desde delobj es: %d \n", id_objeto);

                int resp = borrar_objeto(id_objeto);

                printf("RESP: %d \n", resp);

               if (resp == 0) {
                    strcpy(respuesta.texto.datos_formulario, "01");
                } else if (resp != 0) {
                    strcpy(respuesta.texto.datos_formulario, "02");
                }


                printf("************************** FIN Formulario 'delobj' **************************\n");
            }

            /* ********************************************************************************************************* */


            printf("***** FIN PROCESAMIENTO DE MENSAJE - INICIO ENVIO DE RESPUESTA A FORMULARIO *****\n");

            respuesta.mtype = id_proceso_destinatario;
            respuesta.texto.idproceso = idproceso;

            printf("idproceso (respuesta.mtype) antes de enviar: %d \n", id_proceso_destinatario);

            printf("idcola antes de enviar a %s: %d \n", formulario_actual, idcola);

            printf("id_proceso_destinatario (respuesta.texto.idproceso) antes de enviar a %s: %d \n", formulario_actual, idproceso);

            printf("Enviando a %s: %s \n", formulario_actual, respuesta.texto.datos_formulario);

            msgsnd(idcola, &respuesta, strlen(respuesta.texto.datos_formulario) + 20, 0);

            printf("Enviado a %s: %s \n", formulario_actual, respuesta.texto.datos_formulario);

            printf("*********** FIN PROCESAR RESPUESTA ***************** \n");
            printf("------------------ FIN - SIGIUIENTE MENSAJE ------------- \n");

            // mensaje.mtype = mensaje.texto.idproceso;                                 
            //  mensaje.texto.pid = idproceso;
            // msgsnd (qid, &mensaje, strlen(mensaje.texto.datos_formulario) + 12, 0);

        }// if largo mensaje mayor a cero
    }

}
