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
    int id_amigo;
    int id_usuario_clasificado;
    int clasificacion;
    char comentario_clasificacion[100];
    //char nombre_usuario_recibidor[10];
    //char apellido_usuario_recibidor[10];
    Amigo *amig;
    Usuario *usr;
    Prestamo *prest;
    Objeto *obj;
    Misamigos *misamigos;
    Reputacion *rep;
    MisPrestamos *mprest;
    MisObjetos *mobj;
    char email[41];
    char password[11];
    char nombre[21];
    char apellido[21];

    char id_obj[16]; // delobj
    char confirmacion[2]; // delobj
    // char id_prestamo[16];
    int id_prestamo; //editar prestamo

    char *resp[200];


    /* *****************************************************************************************************************
     *                                                    FORMULARIOS                                                  *
     * *****************************************************************************************************************/


    while (10) // While Infinito
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

            /**************************************
                    FORMULARIO "loginn"
             **************************************/

            /* ----------> LISTO <---------- */

            // if (strcmp(formulario_actual, "loginn") == 0) {
            //
            //     printf("************************** Formulario 'loginn' **************************\n");
            //
            //     printf("-----> Logeo de usuario <-----\n");
            //
            //     printf("El mensaje de recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);
            //
            //     char formulario[6];
            //     memset(email,'\0',sizeof email);
            //     memset(password,'\0',sizeof password);
            //
            //     sscanf(mensaje.texto.datos_formulario, "%40c%10c", email, password);
            //
            //     printf("El email recibido desde loginn es: %s \n", email);
            //
            //     printf("La password recibida desde loggin es: %s \n", password);
            //
            //     int resp = logueo(email, password);
            //
            //     printf("Valor recibido del logueo: %d \n", resp);
            //
            //     if (resp == 1) {
            //         strcpy(respuesta.texto.datos_formulario, "01");
            //     } else if (resp == 0) {
            //         strcpy(respuesta.texto.datos_formulario, "02");
            //     } else {
            //         strcpy(respuesta.texto.datos_formulario, "03");
            //     }
            //     printf("************************** FIN Formulario 'loginn' **************************\n");
            // }

            if (strcmp(formulario_actual, "loginn") == 0) {

                printf("************************** Formulario 'loginn' **************************\n");

                printf("-----> Logeo de usuario <-----\n");

                printf("El mensaje de recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                char formulario[6];
                memset(email, '\0', sizeof email);
                memset(password, '\0', sizeof password);

                sscanf(mensaje.texto.datos_formulario, "%40c%10c", email, password);

                printf("El email recibido desde loginn es: %s \n", email);

                printf("La password recibida desde loggin es: %s \n", password);

                usr = logueo(email, password);

                printf("Valor recibido del logueo: %d \n", usr->verificador_error);

                if (usr->verificador_error == 0) {
                    printf("ID USUARIO LOGUEADO: %d \n", usr->id);
                    sprintf(respuesta.texto.datos_formulario, "%d-%s", usr->id, usr->email);
                    //   strcpy(respuesta.texto.datos_formulario, usr->id);
                    //   printf("1 \n");
                    //   strcat(respuesta.texto.datos_formulario, "-");
                    //   printf("2");
                    //   strcat(respuesta.texto.datos_formulario, usr->email);
                    //   printf("3");
                } else {
                    strcpy(respuesta.texto.datos_formulario, "02");
                }

                printf("************************** FIN Formulario 'loginn' **************************\n");
                //printf("el verificador_error de usuario es 1 \n");
            }
            //     strcpy(respuesta.texto.datos_formulario, "01");
            // } else if (resp == 0) {
            //     strcpy(respuesta.texto.datos_formulario, "02");
            // } else {
            //     strcpy(respuesta.texto.datos_formulario, "03");
            // }



            /* ********************************************************************************************************* */

            /**************************************
                    FORMULARIO "regusr"
             **************************************/

            /* ----------> LISTO <---------- */

            else if (strcmp(formulario_actual, "regusr") == 0) {

                printf("************************** Formulario 'regusr' **************************\n");

                printf("-----> Registro de nuevo usuario <-----\n");

                printf("El mensaje de recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                memset(email, '\0', sizeof email);
                memset(nombre, '\0', sizeof nombre);
                memset(apellido, '\0', sizeof apellido);
                memset(password, '\0', sizeof password);

                sscanf(mensaje.texto.datos_formulario, "%20c%20c%40c%10c", nombre, apellido,email, password);

                printf("El email recibido desde regusr es: %s \n", email);

                printf("El nombre recibido desde regusr es: %s \n", nombre);

                printf("El apellido recibida desde regusr es: %s \n", apellido);

                printf("La password recibida desde regusr es: %s \n", password);

                printf("\n\nANTES VALIDACION\n\n");

                printf("\n\nDESPUES VALIDACION\n\n");

                usr = insertar_usuario(email, nombre, apellido, password);

                printf("\n\nDESPUES  INSERTAR_USUARIO\n\n");

                printf("La respuesta de insertar usuario es: %d \n", usr->verificador_error);

                if (usr->verificador_error == 0) {
                    printf("\n\nDENTRO VERF_ERR\n\n");
                    strcpy(respuesta.texto.datos_formulario, "01");
                } else {
                    strcpy(respuesta.texto.datos_formulario, "02");
                }

                printf("************************** FIN Formulario 'regusr' **************************\n");
            }

            else if (strcmp(formulario_actual,"modusr") == 0){
                printf("************************** FIN Formulario 'modusr' **************************\n");
                sscanf(mensaje.texto.datos_formulario, "%5d", &id_usuario);
                //char usuario[90] = "";
                printf("Usuario para actualizar : %s\n", get_usuario_por_id(id_usuario));
                strcpy(respuesta.texto.datos_formulario,get_usuario_por_id(id_usuario));
                printf("************************** Formulario 'modusr' **************************\n");
            }

            else if (strcmp(formulario_actual, "actusr") == 0) {

            printf("************************** Formulario 'actusr' **************************\n");

            printf("-----> Actualizar usuario <-----\n");

              memset(email,'\0',sizeof email);
              memset(nombre,'\0',sizeof nombre);
              memset(apellido,'\0',sizeof apellido);
              memset(password,'\0',sizeof password);

              sscanf(mensaje.texto.datos_formulario, "%20c%20c%40c%10c%5d", nombre, apellido, email,  password,&id_usuario);
              printf("El email recibido desde regusr es: %s \n", email);

              printf("El nombre recibido desde regusr es: %s \n", nombre);

              printf("El apellido recibida desde regusr es: %s \n", apellido);

              printf("La password recibida desde regusr es: %s \n", password);

              printf("id usuario recibido para actualizar: %d\n", id_usuario);
              usr = actualizar_usuario(email,nombre,apellido,password,id_usuario);

              if (usr->verificador_error == 0) {
                      printf("\n\nDENTRO VERF_ERR\n\n");
                      strcpy(respuesta.texto.datos_formulario, "01");
              } else {
                  strcpy(respuesta.texto.datos_formulario, "02");
              }

              printf("************************** FIN Formulario 'actusr' **************************\n");
            }

            else if (strcmp(formulario_actual, "actusr") == 0) {

            printf("************************** Formulario 'actusr' **************************\n");

            printf("-----> Actualizar usuario <-----\n");

              memset(email,'\0',sizeof email);
              memset(nombre,'\0',sizeof nombre);
              memset(apellido,'\0',sizeof apellido);
              memset(password,'\0',sizeof password);

              sscanf(mensaje.texto.datos_formulario, "%20c%20c%40c%10c%5d", nombre, apellido, email,  password,&id_usuario);
              printf("El email recibido desde regusr es: %s \n", email);

              printf("El nombre recibido desde regusr es: %s \n", nombre);

              printf("El apellido recibida desde regusr es: %s \n", apellido);

              printf("La password recibida desde regusr es: %s \n", password);

              printf("id usuario recibido para actualizar: %d\n", id_usuario);
              usr = actualizar_usuario(email,nombre,apellido,password,id_usuario);

              if (usr->verificador_error == 0) {
                      printf("\n\nDENTRO VERF_ERR\n\n");
                      strcpy(respuesta.texto.datos_formulario, "01");
              } else {
                  strcpy(respuesta.texto.datos_formulario, "02");
              }

              printf("************************** FIN Formulario 'actusr' **************************\n");
            }



            else if (strcmp(formulario_actual, "delusr") == 0) {
                printf("************************** Formulario 'delusr' **************************\n");
                printf("-----> Eliminar usuario <-----\n");
                sscanf(mensaje.texto.datos_formulario, "%5d", &id_usuario);
                int resp = eliminar_usuario(id_usuario);

                if (resp == 0) {
                    strcpy(respuesta.texto.datos_formulario, "01");
                } else {
                    strcpy(respuesta.texto.datos_formulario, "02");
                }

                printf("************************** FIN Formulario 'delusr' **************************\n");
            }

            else if(strcmp(formulario_actual,"verusr") == 0){
              printf("************************** Formulario 'verusr' **************************\n");
              printf("-----> Ver usuarios registrados <-----\n");
              sscanf(mensaje.texto.datos_formulario, "%d", &id_usuario_logueado);
              usr = get_listado_usuarios_registrados(id_usuario_logueado);
              strcpy(respuesta.texto.datos_formulario,usr->listado);
              printf("************************** FIN Formulario 'verusr' **************************\n");
            }


            else if(strcmp(formulario_actual,"regami") == 0){
                printf("************************** Formulario 'regami' **************************\n");
                printf("-----> Registrar amigo <-----\n");
                printf("mensaje recibido: %s\n", mensaje.texto.datos_formulario);
                sscanf(mensaje.texto.datos_formulario,"%d-%d",&id_usuario_logueado,&id_amigo);
                printf("id usuario logueado: %d\n", id_usuario_logueado);
                printf("id amigo: %d\n", id_amigo);
                amig = insertar_amigos(id_usuario_logueado,id_amigo);

                if (amig->verificador_error == 0) {
                        printf("\n\nDENTRO VERF_ERR\n\n");
                        strcpy(respuesta.texto.datos_formulario, "01");
                } else {
                    strcpy(respuesta.texto.datos_formulario, "02");
                }
                printf("************************** FIN Formulario 'regami' **************************\n");
            }

            else if (strcmp(formulario_actual, "cbxami") == 0) {

                printf("************************** Formulario 'cbxami' **************************\n");

                printf("-----> Ver mis amigos <-----\n");
                //id_usuario_logueado = 9;
                printf("id usuario logueado: %d \n",id_usuario_logueado);
                sscanf(mensaje.texto.datos_formulario, "%d", &id_usuario_logueado);
                printf("id usuario logueado: %d \n",id_usuario_logueado);
                printf("despues de sscanf \n");

            //    char mis_amigos[sizeof (get_mis_amigos(id_usuario_logueado))];
            //    printf("hola \n");
                //strcpy(mis_amigos, get_mis_amigos(id_usuario_logueado));
                //printf("\n mis amigos:  \n %s \n", get_mis_amigos(id_usuario_logueado));
                //printf("Los amigos son: %s\n",get_mis_amigos_combobox(id_usuario_logueado));

                //char mis_amigos[2000];
                //strcpy(mis_amigos,get_mis_amigos_combobox(id_usuario_logueado));
                printf("antes de copiar datos a respuesta\n");
                //strcpy(respuesta.texto.datos_formulario,"hola mundo");
                misamigos = get_mis_amigos_combobox(id_usuario_logueado);
                strcpy(respuesta.texto.datos_formulario,misamigos->listado);
                printf("4\n" );
                printf("************************** FIN Formulario 'cbxami' **************************\n");
            }

            else if (strcmp(formulario_actual, "verami") == 0) {

                printf("************************** Formulario 'verami' **************************\n");

                printf("-----> Ver mis amigos <-----\n");
                //id_usuario_logueado = 9;
                printf("id usuario logueado: %d \n",id_usuario_logueado);
                sscanf(mensaje.texto.datos_formulario, "%d", &id_usuario_logueado);
                printf("id usuario logueado: %d \n",id_usuario_logueado);
                printf("despues de sscanf \n");

            //    char mis_amigos[sizeof (get_mis_amigos(id_usuario_logueado))];
            //    printf("hola \n");
                //strcpy(mis_amigos, get_mis_amigos(id_usuario_logueado));
                //printf("\n mis amigos:  \n %s \n", get_mis_amigos(id_usuario_logueado));
                //printf("Los amigos son: %s\n",get_mis_amigos_combobox(id_usuario_logueado));

                //char mis_amigos[2000];
                //strcpy(mis_amigos,get_mis_amigos_combobox(id_usuario_logueado));
                printf("antes de copiar datos a respuesta\n");
                //strcpy(respuesta.texto.datos_formulario,"hola mundo");
                misamigos = get_mis_amigos_tabla(id_usuario_logueado);
                strcpy(respuesta.texto.datos_formulario,misamigos->listado);
                printf("4\n" );
                printf("************************** FIN Formulario 'verami' **************************\n");
            }



            /* ********************************************************************************************************* */

            /**************************************
                    FORMULARIO "hprest"
             **************************************/

            else if (strcmp(formulario_actual, "regpre") == 0) {

                printf("************************** Formulario 'regpre' **************************\n");

                printf("-----> Registro de nuevo prestamo <-----\n");

                printf("El mensaje recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                memset(email_usuario_prestador, '\0', sizeof email_usuario_prestador);
                memset(nombre_objeto, '\0', sizeof nombre_objeto);
                memset(email_usuario_recibidor, '\0', sizeof email_usuario_recibidor);

                sscanf(mensaje.texto.datos_formulario, "%4d%2d%2d%40c%15c%3d%40c%4d%2d%2d",
                        &anio_prestamo, &mes_prestamo, &dia_prestamo, email_usuario_prestador, nombre_objeto,
                        &cantidad_prestada, email_usuario_recibidor, &anio_devolucion, &mes_devolucion, &dia_devolucion);

                sprintf(fecha_prestamo, "%d-%d-%d", anio_prestamo, mes_prestamo, dia_prestamo);

                sprintf(fecha_devolucion, "%d-%d-%d", anio_devolucion, mes_devolucion, dia_devolucion);

                printf("Fecha del prestamo recibido es: %s \n", fecha_prestamo);
                printf("Cantidad prestada recibida es: %d \n", cantidad_prestada);
                printf("El email del usuario prestador recibido es: %s \n", email_usuario_prestador);
                printf("El email del usuario recibidor es: %s \n", email_usuario_recibidor);
                printf("Dia fecha de devolucion recibido es: %d \n", dia_devolucion);
                printf("fecha devolucion recibida es: %s \n", fecha_devolucion);
                printf("Nombre objeto recibido: %s \n",nombre_objeto);
                id_usuario_prestador = 0;
                id_usuario_recibidor = 0;
                id_usuario_prestador = get_id_usuario_por_email(email_usuario_prestador);
                id_usuario_recibidor = get_id_usuario_por_email(email_usuario_recibidor);

                id_objeto = get_id_objeto(nombre_objeto);

                printf("La id del objeto prestado es: %d \n", id_objeto);
                printf("La id del usuario prestador es %d  \n", id_usuario_prestador);
                printf("La id del usuario recibidor es %d  \n", id_usuario_recibidor);
                prest = insertar_prestamo(fecha_prestamo, id_usuario_prestador, id_objeto, cantidad_prestada,
                        id_usuario_recibidor, fecha_devolucion);

                printf("La respuesta luego de insertar el prestamo es: %d \n", prest->verificador_error);

                if (prest->verificador_error == 0) {
                    strcpy(respuesta.texto.datos_formulario, "01");
                } else {
                    strcpy(respuesta.texto.datos_formulario, "02");
                }

                printf("************************** FIN Formulario 'regpre' **************************\n");

            }





            else if (strcmp(formulario_actual, "delpre") == 0) {
                printf("************************** Formulario 'delpre' **************************\n");
                printf("-----> Eliminar prestamo <-----\n");
                sscanf(mensaje.texto.datos_formulario, "%d", &id_prestamo);
                printf("La id del prestamo es: %d \n", id_prestamo);
                int resp = eliminar_prestamo(id_prestamo);

                if (resp == 0) {
                    strcpy(respuesta.texto.datos_formulario, "01");
                } else {
                    strcpy(respuesta.texto.datos_formulario, "02");
                }


                printf("************************** FIN Formulario 'delpre' **************************\n");
            }
            /* ********************************************************************************************************* */

            /**************************************
                    FORMULARIO "eprest"
             **************************************/


            else if (strcmp(formulario_actual, "actpre") == 0) {
                printf("************************** Formulario 'actpre' **************************\n");

                printf("-----> Editar prestamo <-----\n");

                printf("El mensaje recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                memset(email_usuario_prestador, '\0', sizeof email_usuario_prestador);
                memset(nombre_objeto, '\0', sizeof nombre_objeto);
                memset(email_usuario_recibidor, '\0', sizeof email_usuario_recibidor);

                sscanf(mensaje.texto.datos_formulario, "%4d%2d%2d%40c%15c%3d%40c%4d%2d%2d%1d%d", &anio_prestamo, &mes_prestamo,
                                                            &dia_prestamo, email_usuario_prestador, nombre_objeto,
                                            &cantidad_prestada, email_usuario_recibidor, &anio_devolucion, &mes_devolucion,
                                            &dia_devolucion, &estado, &id_prestamo);

                sprintf(fecha_prestamo, "%d-%d-%d", anio_prestamo, mes_prestamo, dia_prestamo);

                sprintf(fecha_devolucion, "%d-%d-%d", anio_devolucion, mes_devolucion, dia_devolucion);

                printf("Fecha del prestamo recibido es: %s \n", fecha_prestamo);
                printf("Cantidad prestada recibida es: %d \n", cantidad_prestada);
                printf("El email del usuario prestador recibido es: %s \n", email_usuario_prestador);
                printf("El email del usuario recibidor es: %s \n", email_usuario_recibidor);
                printf("Dia fecha de devolucion recibido es: %d \n", dia_devolucion);
                printf("fecha devolucion recibida es: %s \n", fecha_devolucion);
                printf("Estado del prestamo recibido %d \n",estado);
                id_usuario_recibidor = get_id_usuario_por_email(email_usuario_recibidor);
                id_usuario_prestador = get_id_usuario_por_email(email_usuario_prestador);
                id_usuario_recibidor = get_id_usuario_por_email(email_usuario_recibidor);

                id_objeto = get_id_objeto(nombre_objeto);

                printf("La id del objeto prestado es: %d \n", id_objeto);
                printf("La id del usuario prestador es %d y la del usuario recibidor es %d \n", id_usuario_prestador, id_usuario_recibidor);
                printf("La id del prestamo es: %d \n", id_prestamo);

                prest = actualizar_prestamo(fecha_prestamo, id_usuario_prestador, id_objeto,
                        id_usuario_recibidor, fecha_devolucion, estado, cantidad_prestada, id_prestamo);

                printf("La respuesta luego de actualizar el prestamo es: %d \n", prest->verificador_error);

                if (prest->verificador_error == 0) {
                    strcpy(respuesta.texto.datos_formulario, "01");
                } else {
                    strcpy(respuesta.texto.datos_formulario, "02");
                }


                printf("************************** FIN Formulario 'actpre' **************************\n");
            }

            else if (strcmp(formulario_actual, "predev") == 0) {
                printf("************************** Formulario 'prepen' **************************\n");

                printf("-----> Marcar prestamo como devuelto <-----\n");

                printf("El mensaje recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                memset(email_usuario_prestador, '\0', sizeof email_usuario_prestador);
                memset(nombre_objeto, '\0', sizeof nombre_objeto);
                memset(email_usuario_recibidor, '\0', sizeof email_usuario_recibidor);

                sscanf(mensaje.texto.datos_formulario, "%d", &id_prestamo);

                printf("La id del prestamo es: %d \n", id_prestamo);

                prest = marcar_prestamo_como_devuelto(id_prestamo);

                printf("La respuesta luego de marcar prestamo como devuelto es: %d \n", prest->verificador_error);

                if (prest->verificador_error == 0) {
                    strcpy(respuesta.texto.datos_formulario, "01");
                } else {
                    strcpy(respuesta.texto.datos_formulario, "02");
                }


                printf("************************** FIN Formulario 'predev' **************************\n");
            }

            else if (strcmp(formulario_actual, "prepen") == 0) {
                printf("************************** Formulario 'prepen' **************************\n");

                printf("-----> Marcar prestamo como pendiente <-----\n");

                printf("El mensaje recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                memset(email_usuario_prestador, '\0', sizeof email_usuario_prestador);
                memset(nombre_objeto, '\0', sizeof nombre_objeto);
                memset(email_usuario_recibidor, '\0', sizeof email_usuario_recibidor);

                sscanf(mensaje.texto.datos_formulario, "%d", &id_prestamo);

                printf("La id del prestamo es: %d \n", id_prestamo);

                prest = marcar_prestamo_como_pendiente(id_prestamo);

                printf("La respuesta luego de marcar prestamo como pendiente es: %d \n", prest->verificador_error);

                if (prest->verificador_error == 0) {
                    strcpy(respuesta.texto.datos_formulario, "01");
                } else {
                    strcpy(respuesta.texto.datos_formulario, "02");
                }


                printf("************************** FIN Formulario 'prepen' **************************\n");
            }

            else if (strcmp(formulario_actual, "vprepe") == 0) {
                printf("************************** Formulario 'vprepe' **************************\n");

                printf("-----> Ver prestamos pendientes <-----\n");

                printf("El mensaje recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                sscanf(mensaje.texto.datos_formulario, "%d", &id_usuario_prestador);

                printf("La id del usuario prestador es: %d \n", id_usuario_prestador);

                mprest = get_prestamos_pendientes(id_usuario_prestador);
                printf("%s \n",mprest->listado);

            //    printf("La respuesta luego de marcar prestamo como pendiente es: %d \n", prest->verificador_error);

                 if (mprest->verificador_error == 0) {
                    strcpy(respuesta.texto.datos_formulario, mprest->listado);
                    printf("%s\n",respuesta.texto.datos_formulario );
               } else {
                   strcpy(respuesta.texto.datos_formulario, "02");
                }


                printf("************************** FIN Formulario 'vprepe' **************************\n");
            }

            else if (strcmp(formulario_actual, "vprede") == 0) {
                printf("************************** Formulario 'vprede' **************************\n");

                printf("-----> Ver prestamos devueltos <-----\n");

                printf("El mensaje recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                sscanf(mensaje.texto.datos_formulario, "%d", &id_usuario_prestador);

                printf("La id del usuario prestador es: %d \n", id_usuario_prestador);

                //printf("%s \n",get_prestamos_devueltos(id_usuario_prestador));
                mprest = get_prestamos_devueltos(id_usuario_prestador);
                printf("%s \n",mprest->listado);
            //    printf("La respuesta luego de marcar prestamo como pendiente es: %d \n", prest->verificador_error);

                if (mprest->verificador_error == 0) {
                    strcpy(respuesta.texto.datos_formulario, mprest->listado);
                    printf("%s\n",respuesta.texto.datos_formulario );
               } else {
                   strcpy(respuesta.texto.datos_formulario, "02");
                }


                printf("************************** FIN Formulario 'vprede' **************************\n");
            }

            /* ********************************************************************************************************* */
            /* ********************************************************************************************************* */

            /**************************************
                    FORMULARIO "modpre"
             **************************************/

            else if (strcmp(formulario_actual, "modpre") == 0) {

                printf("************************** Formulario 'modpre' **************************\n");
                printf("Mensaje recibido: %s \n", mensaje.texto.datos_formulario);
                sscanf(mensaje.texto.datos_formulario, "%d", &id_prestamo);
                printf("La id del prestamo recibida es: %d \n", id_prestamo);
                prest = get_prestamo_por_id(id_prestamo);
                printf("despues de asignar a prest \n");
                printf("id usuario prestador: %d \n", prest->id_usuario_prestador);
                printf("id usuario recibidor: %d \n", prest->id_usuario_recibidor);
                printf("\nDESPUES DE ID USARIO RECIBIDOR\n");
                strcpy(email_usuario_prestador, get_email_usuario_por_id(prest->id_usuario_prestador));
                printf("\nDESPUES DE em us prest\n"); //get_id_usuario_por_email(prest->id_usuario_prestador);
                strcpy(email_usuario_recibidor, get_email_usuario_por_id(prest->id_usuario_recibidor));
                printf("\nDESPUES DE em us rec\n");
                strcpy(fecha_prestamo, prest->fecha_prestamo);
                //  anio_prestamo = atoi(strtok(fecha_prestamo,"-"));
                // mes_prestamo = atoi(strtok(NULL,"-"));
                //  dia_prestamo = atoi(strtok(NULL,"-"));
                //printf("\nDESPUES DE atoi\n");
                //printf("año: %d,mes: %d,dia: %d \n",anio_prestamo,mes_prestamo,dia_prestamo);
                //int fecha_prestamo2 = atoi(fecha_prestamo);
                // printf("fecha prestamo 2: %d \n",fecha_prestamo2);
                // sscanf(fecha_prestamo, "%4d%2d%2d", &anio_prestamo, &mes_prestamo, &dia_prestamo);
                // printf("anio prestamo: %d \n", anio_prestamo);
                // printf("mes prestamo: %d \n", mes_prestamo);
                // printf("dia prestamo: %d \n", dia_prestamo);
                strcpy(fecha_devolucion, prest->fecha_devolucion);
                strcpy(nombre_objeto, get_nombre_objeto_por_id(prest->id_objeto));

                //yyyy-mm-dd

                cantidad_prestada = prest->cantidad_prestada;
                printf("\nDESPUES DE definir cant prestada\n");
                estado = prest->estado;
                printf("cantidad prestada: %d \n", cantidad_prestada);
                printf("estado prestamo: %d \n", estado);
                printf("fecha prestamo: %s\n", fecha_prestamo);
                printf("id objeto: %d \n", prest->id_objeto);

                printf("nombre objeto: %s \n", nombre_objeto);
                printf("email usuario prestador: %s \n", email_usuario_prestador);
                printf("email_usuario_recibidor: %s \n", email_usuario_recibidor);
                printf("fecha devolucion: %s \n", fecha_devolucion);
                // int largo_correo_prestador = strlen(email_usuario_prestador);
                // int num_espacios_correo_prestador = 40 - largo_correo_prestador;
                // int largo_correo_recibidor = strlen(email_usuario_recibidor);
                // int num_espacios_correo_recibidor = 40 - largo_correo_recibidor;
                // int largo_nombre_objeto = strlen(nombre_objeto);
                // int num_espacios_nombre_objeto = 15 - largo_nombre_objeto;

                // int i;
                // for (i = 0; i < num_espacios_correo_prestador; i++) {
                //     strcat(email_usuario_prestador, " ");
                // }
                //
                // //int j;
                // for (i = 0; i < num_espacios_correo_recibidor; i++) {
                //     strcat(email_usuario_recibidor, " ");
                // }
                //
                // for (i = 0; i < num_espacios_nombre_objeto; i++) {
                //     strcat(nombre_objeto, " ");
                // }
                // char espacios_correo_prestador[40]
                //email@email.email => largo 17
                //                         40
                //email@email.email
            //    printf("despues de los for \n");
                char nueva_cantidad_prestada[3];
                //  memset(nueva_cantidad_prestada,' ',3);
                sprintf(nueva_cantidad_prestada, "%d", cantidad_prestada);
                //  strcpy(nueva_cantidad_prestada,itoa(cantidad_prestada));
               if (cantidad_prestada < 10) {
                   strcat(nueva_cantidad_prestada, " ");
                   strcat(nueva_cantidad_prestada, " ");
                    nueva_cantidad_prestada[0] = '0';
                    nueva_cantidad_prestada[1] = '0';
                //    nueva_cantidad_prestada[2] = itoa(cantidad_prestada);
               }

               if (cantidad_prestada > 10) {
                   strcat(nueva_cantidad_prestada, " ");

                    nueva_cantidad_prestada[0] = '0';
                    nueva_cantidad_prestada[1] = '0';
                //    nueva_cantidad_prestada[2] = itoa(cantidad_prestada);
               }
                // sprintf(respuesta.texto.datos_formulario, "%4s%2s%2s%40s%15s%3d%40s%4d%2d%2d", anio_prestamo, mes_prestamo, dia_prestamo, email_usuario_prestador, nombre_objeto,
                // &cantidad_prestada, email_usuario_recibidor, &anio_devolucion, &mes_devolucion, &dia_devolucion);
                //  sprintf(respuesta.texto.datos_formulario, "%8s%40s%15s%3d%40s%8s%1d",fecha_prestamo, email_usuario_prestador, nombre_objeto,
                //  &cantidad_prestada, email_usuario_recibidor, fecha_devolucion,&estado);
                //    sprintf(respuesta.texto.datos_formulario, "%s%s%s%d%s%s%d",fecha_prestamo, email_usuario_prestador, nombre_objeto,
                //   &cantidad_prestada, email_usuario_recibidor, fecha_devolucion,&estado);
                sprintf(respuesta.texto.datos_formulario, "%d-%s-%s-%s-%d-%s-%s-%d", prest->id,fecha_prestamo, email_usuario_prestador, nombre_objeto,
                        prest->cantidad_prestada, email_usuario_recibidor, fecha_devolucion, estado);

                printf("-----> Modificar prestamo <-----\n");

                printf("El mensaje recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                //   sscanf(mensaje.texto.datos_formulario, "%15s", id_prestamo);

                // printf("\n\nid_prestamo: %s\n\n", id_prestamo);

                //printf("El email del dueño objeto es: %s \n", email_usuario_dueno_objeto);

                // prest = get_id_usuario_por_email(email_usuario_dueno_objeto);

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

            /* ----------> LISTO <---------- */

            else if (strcmp(formulario_actual, "regobj") == 0) {

                printf("************************** Formulario 'regobj' **************************\n");

                printf("-----> Registro nuevo objeto <-----\n");

                printf("El mensaje recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                memset(email_usuario_recibidor, '\0', sizeof email_usuario_dueno_objeto);
                memset(nombre_objeto, '\0', sizeof nombre_objeto);

                sscanf(mensaje.texto.datos_formulario, "%15c%5d", nombre_objeto,&id_usuario_dueno_objeto);

                printf("El id del dueño del objeto recibido es: %d \n", id_usuario_dueno_objeto);
                printf("El nombre del objeto recibido es: %s \n", nombre_objeto);

                //id_usuario_dueno_objeto = get_id_usuario_por_email(email_usuario_dueno_objeto);



                int cuantos = validar_registro_objeto(nombre_objeto, id_usuario_dueno_objeto);

                if (cuantos == 0) {

                    obj = insertar_objeto(id_usuario_dueno_objeto, nombre_objeto);
                    printf("La respuesta luego de insertar objeto es: %d \n", obj->verificador_error);
                    if (obj->verificador_error == 0) {
                        strcpy(respuesta.texto.datos_formulario, "01");
                    } else {
                        strcpy(respuesta.texto.datos_formulario, "02");
                    }

                } else {
                    strcpy(respuesta.texto.datos_formulario, "03");
                }


                printf("************************** FIN Formulario 'regobj' **************************\n");

            }

            else if(strcmp(formulario_actual,"modobj") == 0){
            printf("************************** Formulario 'modobj' **************************\n");
            printf("%s\n",mensaje.texto.datos_formulario );
            sscanf(mensaje.texto.datos_formulario,"%5d",&id_objeto);
            printf("El id del objeto para actualizar es: %d\n", id_objeto);
            printf("Enviando al python: %s\n", get_objeto_por_id(id_objeto));
            strcpy(respuesta.texto.datos_formulario,get_objeto_por_id(id_objeto));

            printf("************************** FIN Formulario 'modobj' **************************\n");
            }

            else if(strcmp(formulario_actual,"actobj") == 0){
                printf("************************** Formulario 'actobj' **************************\n");

                printf("-----> Actualizar objeto <-----\n");

                printf("El mensaje recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                memset(email_usuario_recibidor, '\0', sizeof email_usuario_dueno_objeto);
                memset(nombre_objeto, '\0', sizeof nombre_objeto);

                sscanf(mensaje.texto.datos_formulario, "%15c%5d%5d", nombre_objeto,&id_objeto);

                printf("El id del objeto para actualizar: %5d \n", id_objeto);
                printf("El nombre del objeto recibido es: %s \n", nombre_objeto);

                //id_usuario_dueno_objeto = get_id_usuario_por_email(email_usuario_dueno_objeto);



                int cuantos = validar_registro_objeto(nombre_objeto, id_usuario_dueno_objeto);

                if (cuantos == 0) {

                    obj = actualizar_objeto(nombre_objeto,id_objeto);
                    printf("La respuesta luego de insertar objeto es: %d \n", obj->verificador_error);
                    if (obj->verificador_error == 0) {
                        strcpy(respuesta.texto.datos_formulario, "01");
                    } else {
                        strcpy(respuesta.texto.datos_formulario, "02");
                    }

                } else {
                    strcpy(respuesta.texto.datos_formulario, "03");
                }


                printf("************************** FIN Formulario 'actobj' **************************\n");
            }
            /* ********************************************************************************************************* */

            /**************************************
                    FORMULARIO "cbxobj"
             **************************************/

            else if (strcmp(formulario_actual, "cbxobj") == 0) {

                printf("************************** Formulario 'cbxobj' **************************\n");

                printf("-----> Listado objetos combobox <-----\n");

                printf("El mensaje recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                char mis_objetos[170] = "";
                int pagina;

                sscanf(mensaje.texto.datos_formulario, "%d", &id_usuario_dueno_objeto);
                //strcpy(mis_objetos, get_listado_objetos_combobox(id_usuario_dueno_objeto));
                mobj = get_listado_objetos_combobox(id_usuario_dueno_objeto);
                printf("Los objetos son: %s \n", mobj->listado);
                printf("despues de obtener los objetos \n");

                strcpy(respuesta.texto.datos_formulario, mobj->listado);
                // if (strcmp(mis_objetos, "no hay datos") == 0) { //char error[153];
                //     //respuesta.texto.datos_formulario[151] = '0'
                //     //respuesta.texto.datos_formulario[152] = '1';
                //     strcpy(respuesta.texto.datos_formulario, "01");
                // } else {
                //     strcpy(respuesta.texto.datos_formulario, get_listado_objetos_combobox(id_usuario_dueno_objeto));
                // }
                //printf("tamaño de obj: %d \n", sizeof (obj));
                //printf("nombre objeto [0]: %s \n",obj[0].nombre);
                //printf("nombre objeto [1]: %s \n",obj[1].nombre);
                //printf("nombre objeto [2]: %s \n",obj[2].nombre);

                printf("************************** FIN Formulario 'cbxobj' **************************\n");

            }

            /**************************************
                    FORMULARIO "verobj"
             **************************************/

            else if (strcmp(formulario_actual, "verobj") == 0) {

                printf("************************** Formulario 'verobj' **************************\n");

                printf("-----> Ver objetos <-----\n");

                printf("El mensaje recibido de %s es: %s \n", formulario_actual, mensaje.texto.datos_formulario);

                char mis_objetos[170] = "";
                int pagina;

                sscanf(mensaje.texto.datos_formulario, "%d", &id_usuario_logueado);
                //strcpy(mis_objetos, get_listado_objetos_tabla(id_usuario_dueno));
                mobj =  get_listado_objetos_tabla(id_usuario_logueado);
                printf("Los objetos son: %s \n", mobj->listado);
                printf("despues de obtener los objetos \n");

        //        if (strcmp(mis_objetos, "no hay datos") == 0) { //char error[153];
                    //respuesta.texto.datos_formulario[151] = '0'
                    //respuesta.texto.datos_formulario[152] = '1';
        //            strcpy(respuesta.texto.datos_formulario, "01");
        //        } else {
                    strcpy(respuesta.texto.datos_formulario, mobj->listado);
                //}
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

            /* ----------> LISTO <---------- */

            else if (strcmp(formulario_actual, "delobj") == 0) {

                printf("************************** Formulario 'delobj' **************************\n");

                //printf("-----> Confirmar borrar objeto <-----\n");

                //printf("El mensaje de recibido de %s es: %s\n", formulario_actual, mensaje.texto.datos_formulario);

                sscanf(mensaje.texto.datos_formulario, "%5d", &id_objeto);

                //if (sizeof (id_obj) == 0) {
                //    strcpy(respuesta.texto.datos_formulario, "03");
                //}

                printf("\n\n El id_objeto es: %5d \n\n", id_objeto);

                //int num = atoi(id_obj);

                //printf("\nNum:%d \n", num);

                //printf("\nlakalkalakalkal \n");

                //printf("\n\n ANTES DE LA LLAMADA A FUNCION \n\n");

                //printf("size of resp: %d\n", sizeof (resp));

                //memset(resp, '\0', sizeof(resp));
                // obj = get_nombre_objeto_por_id2(num);
                // printf("nombre objeto: %s\n", obj->nombre);
                // printf("vef err objeto: %d\n", obj->verificador_error);
                // printf("id objeto: %d\n", obj->id);
                //strcpy(resp, get_nombre_objeto_por_id(num));

                // printf("Resp:%s\n", resp);

                printf("\n\n DESPUES DE LA LLAMADA A FUNCION \n\n");
                int resp = borrar_objeto(id_objeto);
                if(resp == 0){
                    sprintf(respuesta.texto.datos_formulario, "%s", "01");
                }else{
                    sprintf(respuesta.texto.datos_formulario, "%s", "02");
                }
                // if (obj->verificador_error == 0 && obj->id > 0) {
                //
                //     sprintf(respuesta.texto.datos_formulario, "%15d%15s", obj->id, obj->nombre);
                //     printf("\n\nrespuesta.texto.datos_formulario:\n\n%s\n", respuesta.texto.datos_formulario);
                // } else {
                //     strcpy(respuesta.texto.datos_formulario, "02");
                // }
                printf("************************** FIN Formulario 'delobj' **************************\n");
            }


            else if (strcmp(formulario_actual, "regrep") == 0) {

                printf("************************** Formulario 'regrep' **************************\n");
                printf("---->Registrar reputacion<------\n");
                sscanf(mensaje.texto.datos_formulario, "%d-%d-%d-%100c", &id_usuario_logueado,&id_usuario_clasificado,&clasificacion,comentario_clasificacion);
                printf("id del usuario clasificador recibido: %d\n", id_usuario_logueado);
                printf("id del usuario clasificado recibido: %d\n", id_usuario_clasificado);
                printf("clasificacion recibida: %d\n", clasificacion);
                printf("comentario recibido: %s\n", comentario_clasificacion);



                printf("\n\n DESPUES DE LA LLAMADA A FUNCION \n\n");
                rep = insertar_reputacion(id_usuario_clasificado,id_usuario_logueado,clasificacion,comentario_clasificacion);

                if(rep->verificador_error == 0){
                    sprintf(respuesta.texto.datos_formulario, "%s", "01");
                }else{
                    sprintf(respuesta.texto.datos_formulario, "%s", "02");
                }

                printf("************************** FIN Formulario 'regrep' **************************\n");
            }

            else if (strcmp(formulario_actual, "veorep") == 0) {

                printf("************************** Formulario 'veorep' **************************\n");
                printf("---->Ver reputaciones (perfil) de un usuario<------\n");
                sscanf(mensaje.texto.datos_formulario, "%d", &id_usuario_clasificado);

                printf("id del usuario clasificado recibido: %d\n", id_usuario_clasificado);




                printf("\n\n DESPUES DE LA LLAMADA A FUNCION \n\n");
                rep = get_perfil_usuario_reputaciones(id_usuario_clasificado);

                if(rep->verificador_error == 0){
                    sprintf(respuesta.texto.datos_formulario, "%s", rep->listado);
                }else{
                    sprintf(respuesta.texto.datos_formulario, "%s", "02");
                }

                printf("************************** FIN Formulario 'veorep' **************************\n");
            }

            /* ********************************************************************************************************* */

            /**************************************
                    FORMULARIO "cdeobj"
             **************************************/

            // else if (strcmp(formulario_actual, "cdeobj") == 0) {
            //
            //     printf("************************** Formulario 'cdeobj' **************************\n");
            //
            //     printf("-----> Confirmar borrado de objeto <-----\n");
            //
            //     printf("El mensaje de recibido de %s es: %s\n", formulario_actual, mensaje.texto.datos_formulario);
            //
            //     sscanf(mensaje.texto.datos_formulario, "%15s%1s", id_obj, confirmacion);
            //
            //     printf("\n\nEl id_objeto es:%s\nEl caracter es:%s\n\n", id_obj, confirmacion);
            //
            //     printf("\nTamaño de id_obj:%d\n\n", (int) sizeof (id_obj));
            //     printf("\nTamaño de confirmacion:%d\n\n", (int) sizeof (confirmacion));
            //
            //     int num = atoi(id_obj);
            //     printf("Num:%d\n", num);
            //
            //     if (strcmp(confirmacion, "s") == 0) {
            //         int resp = borrar_objeto(num);
            //         printf("RESP: %d \n", resp);
            //         if (resp == 0) {
            //             sprintf(respuesta.texto.datos_formulario, "%s", "01");
            //         } else if (resp != 0) {
            //             sprintf(respuesta.texto.datos_formulario, "%s", "02");
            //         }
            //     } else if (strcmp(confirmacion, "n") == 0) {
            //         sprintf(respuesta.texto.datos_formulario, "%s", "03");
            //     } else {
            //         sprintf(respuesta.texto.datos_formulario, "%s", "04");
            //     }
            //     printf("************************** FIN Formulario 'cdeobj' **************************\n");
            // }




            else{
              printf("PROCESO FORMULARIO NO ENCONTRADO \n");
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
            id_usuario_logueado = 0;
            msgctl(idcola, 0666, NULL);
            printf("*********** FIN PROCESAR RESPUESTA ***************** \n");
            printf("------------------ FIN - SIGIUIENTE MENSAJE ------------- \n");

            // mensaje.mtype = mensaje.texto.idproceso;
            //  mensaje.texto.pid = idproceso;
            // msgsnd (qid, &mensaje, strlen(mensaje.texto.datos_formulario) + 12, 0);

        }// if largo mensaje mayor a cero
    }
}
//}
