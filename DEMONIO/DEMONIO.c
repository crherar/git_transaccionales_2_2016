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

    char id_obj[16]; // delobj
    char confirmacion[2]; // delobj
    // char id_prestamo[16];
    int id_prestamo; //editar prestamo

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


            if (strcmp(formulario_actual, "eprest") == 0) {
                printf("************************** Formulario 'eprest' **************************\n");

                printf("-----> Editar prestamo <-----\n");

                printf("El mensaje recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                sscanf(mensaje.texto.datos_formulario, "%4d%2d%2d%40s%15s%3d%40s%4d%2d%2d%1d%15d", &anio_prestamo, &mes_prestamo, &dia_prestamo, email_usuario_prestador, nombre_objeto,
                        &cantidad_prestada, email_usuario_recibidor, &anio_devolucion, &mes_devolucion, &dia_devolucion,&estado,&id_prestamo);

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

                prest = actualizar_prestamo(fecha_prestamo, id_usuario_prestador, id_objeto,
                        id_usuario_recibidor, fecha_devolucion,cantidad_prestada,estado,id_prestamo);
               
                printf("La respuesta luego de actualizar el prestamo es: %d \n", prest->verificador_error);

                if (prest->verificador_error == 0) {
                    strcpy(respuesta.texto.datos_formulario, "01");
                } else {
                    strcpy(respuesta.texto.datos_formulario, "02");
                }


                printf("************************** FIN Formulario 'eprest' **************************\n");
            }
            /* ********************************************************************************************************* */
            /* ********************************************************************************************************* */

            /**************************************
                    FORMULARIO "modpre"
             **************************************/

            if (strcmp(formulario_actual, "modpre") == 0) {

                printf("************************** Formulario 'modpre' **************************\n");
                printf("Mensaje recibido: %s \n", mensaje.texto.datos_formulario);
                sscanf(mensaje.texto.datos_formulario, "%15d", &id_prestamo);
                printf("La id del prestamo recibida es: %d \n", id_prestamo);
                prest = get_prestamo_por_id(id_prestamo);
                printf("despues de asignar a prest \n");
                printf("id usuario prestador: %d \n", prest->id_usuario_prestador);
                printf("id usuario recibidor: %d \n", prest->id_usuario_recibidor);
                strcpy(email_usuario_prestador, get_email_usuario_por_id(prest->id_usuario_prestador)); //get_id_usuario_por_email(prest->id_usuario_prestador);
                strcpy(email_usuario_recibidor, get_email_usuario_por_id(prest->id_usuario_recibidor));
                strcpy(fecha_prestamo, prest->fecha_prestamo);
                //  anio_prestamo = atoi(strtok(fecha_prestamo,"-"));
                // mes_prestamo = atoi(strtok(NULL,"-"));
                //  dia_prestamo = atoi(strtok(NULL,"-"));

                //printf("año: %d,mes: %d,dia: %d \n",anio_prestamo,mes_prestamo,dia_prestamo);
                //int fecha_prestamo2 = atoi(fecha_prestamo);
                // printf("fecha prestamo 2: %d \n",fecha_prestamo2);
                sscanf(fecha_prestamo, "%4d%2d%2d", &anio_prestamo, &mes_prestamo, &dia_prestamo);
                printf("anio prestamo: %d \n", anio_prestamo);
                printf("mes prestamo: %d \n", mes_prestamo);
                printf("dia prestamo: %d \n", dia_prestamo);
                strcpy(fecha_devolucion, prest->fecha_devolucion);
                strcpy(nombre_objeto, get_nombre_objeto_por_id(prest->id_objeto));

                //yyyy-mm-dd

                cantidad_prestada = prest->cantidad_prestada;
                estado = prest->estado;
                printf("cantidad prestada: %d \n", cantidad_prestada);
                printf("estado prestamo: %d \n", estado);
                printf("fecha prestamo: %s\n", fecha_prestamo);
                printf("id objeto: %d \n", prest->id_objeto);

                printf("nombre objeto: %s \n", nombre_objeto);
                printf("email usuario prestador: %s \n", email_usuario_prestador);
                printf("email_usuario_recibidor: %s \n", email_usuario_recibidor);
                printf("fecha devolucion: %s \n", fecha_devolucion);
                int largo_correo_prestador = strlen(email_usuario_prestador);
                int num_espacios_correo_prestador = 40 - largo_correo_prestador;
                int largo_correo_recibidor = strlen(email_usuario_recibidor);
                int num_espacios_correo_recibidor = 40 - largo_correo_recibidor;
                int largo_nombre_objeto = strlen(nombre_objeto);
                int num_espacios_nombre_objeto = 15 - largo_nombre_objeto;

                int i;
                for (i = 0; i < num_espacios_correo_prestador; i++) {
                    strcat(email_usuario_prestador, " ");
                }

                //int j;
                for (i = 0; i < num_espacios_correo_recibidor; i++) {
                    strcat(email_usuario_recibidor, " ");
                }

                for (i = 0; i < num_espacios_nombre_objeto; i++) {
                    strcat(nombre_objeto, " ");
                }
                // char espacios_correo_prestador[40]
                //email@email.email => largo 17
                //                         40
                //email@email.email
                printf("despues de los for \n");
                char nueva_cantidad_prestada[3];
                //  memset(nueva_cantidad_prestada,' ',3);
                sprintf(nueva_cantidad_prestada, "%d", cantidad_prestada);
                //  strcpy(nueva_cantidad_prestada,itoa(cantidad_prestada));
                if (cantidad_prestada < 10) {
                    strcat(nueva_cantidad_prestada, " ");
                    strcat(nueva_cantidad_prestada, " ");
                    //nueva_cantidad_prestada[0] = '0';
                    //nueva_cantidad_prestada[1] = '0';
                    //nueva_cantidad_prestada[2] = itoa(cantidad_prestada);
                }

                if (cantidad_prestada > 10) {
                    strcat(nueva_cantidad_prestada, " ");

                    //nueva_cantidad_prestada[0] = '0';
                    //nueva_cantidad_prestada[1] = '0';
                    //nueva_cantidad_prestada[2] = itoa(cantidad_prestada);
                }
                // sprintf(respuesta.texto.datos_formulario, "%4s%2s%2s%40s%15s%3d%40s%4d%2d%2d", anio_prestamo, mes_prestamo, dia_prestamo, email_usuario_prestador, nombre_objeto,
                // &cantidad_prestada, email_usuario_recibidor, &anio_devolucion, &mes_devolucion, &dia_devolucion);
                //  sprintf(respuesta.texto.datos_formulario, "%8s%40s%15s%3d%40s%8s%1d",fecha_prestamo, email_usuario_prestador, nombre_objeto,
                //  &cantidad_prestada, email_usuario_recibidor, fecha_devolucion,&estado);     
                //    sprintf(respuesta.texto.datos_formulario, "%s%s%s%d%s%s%d",fecha_prestamo, email_usuario_prestador, nombre_objeto,
                //   &cantidad_prestada, email_usuario_recibidor, fecha_devolucion,&estado);
                sprintf(respuesta.texto.datos_formulario, "%s%s%s%s%s%s%d", fecha_prestamo, email_usuario_prestador, nombre_objeto,
                        nueva_cantidad_prestada, email_usuario_recibidor, fecha_devolucion, estado);

                //                printf("-----> Modificar prestamo <-----\n");
                //
                //              printf("El mensaje recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                //            sscanf(mensaje.texto.datos_formulario, "%15s", id_prestamo);

                //          printf("\n\nid_prestamo: %s\n\n", id_prestamo);

                // printf("El email del dueño objeto es: %s \n", email_usuario_dueno_objeto);

                // prestamo = get_id_usuario_por_email(email_usuario_dueno_objeto);

                // obj = insertar_objeto(id_usuario_dueno_objeto, nombre_objeto);

                // printf("La respuesta luego de insertar objeto es: %d \n", obj->verificador_error);
                // if (obj->verificador_error == 0) {
                //     strcpy(respuesta.texto.datos_formulario, "01");
                // } else {
                //     strcpy(respuesta.texto.datos_formulario, "02");
                // }
                printf("************************** FIN Formulario 'modpre' **************************\n");

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
                    FORMULARIO "cdeobj"
             **************************************/

            if (strcmp(formulario_actual, "cdeobj") == 0) {

                printf("************************** Formulario 'cdeobj' **************************\n");

                printf("-----> Confirmar borrado de objeto <-----\n");

                printf("El mensaje de recibido de %s es: %s\n", formulario_actual, mensaje.texto.datos_formulario);

                sscanf(mensaje.texto.datos_formulario, "%15s%1s", id_obj, confirmacion);

                printf("\n\nEl id_objeto es:%s\nEl caracter es:%s\n\n", id_obj, confirmacion);

                printf("\nTamaño de id_obj:%d\n\n", (int) sizeof (id_obj));
                printf("\nTamaño de confirmacion:%d\n\n", (int) sizeof (confirmacion));

                int num = atoi(id_obj);
                printf("Num:%d\n", num);

                if (strcmp(confirmacion, "s") == 0) {
                    int resp = borrar_objeto(num);
                    printf("RESP: %d \n", resp);
                    if (resp == 0) {
                        strcpy(respuesta.texto.datos_formulario, "10");
                    } else if (resp != 0) {
                        strcpy(respuesta.texto.datos_formulario, "12");
                    }
                } else if (strcmp(confirmacion, "n") == 0) {
                    strcpy(respuesta.texto.datos_formulario, "13");
                } else {
                    strcpy(respuesta.texto.datos_formulario, "14");
                }
                printf("************************** FIN Formulario 'cdeobj' **************************\n");
            }



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
