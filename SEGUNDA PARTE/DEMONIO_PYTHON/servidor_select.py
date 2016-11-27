#!/usr/bin/env python


import json
import select
import socket
import usuarios
import objetos
import amigos
import prestamos
import sys
from pprint import pprint
import reputaciones

host = '127.0.0.1'
port = 3000
backlog = 100
size = 1024
server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
server.bind((host,port))
server.listen(backlog)
input = [server,sys.stdin]
running = 1

while running:
    inputready,outputready,exceptready = select.select(input,[],[])

    for s in inputready:
        # print s
        # break
        if s == server:
            print "s:"
            #pprint(s)
            # handle the server socket
            client, address = server.accept()
            input.append(client)

        else:
            # handle all other sockets
            data = json.loads(s.recv(size))
            print "data recibida: "
            print data
            #datsplit = data.split('|')
            print "formulario recibido"
            formulario = data["cabecera"]["formulario"]
            #datsplit[0]
            print formulario


            if formulario == "loginn":
                usr = usuarios.usuarios()
                print formulario
                #respuesta = usr.iniciar_sesion(datsplit[1])
                respuesta = usr.iniciar_sesion(data)
                del usr
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "regusr":
                usr = usuarios.usuarios()
                print formulario
                respuesta = usr.insertar_usuario(data)
                del usr
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "modusr":
                usr = usuarios.usuarios()
                print formulario
                respuesta = usr.get_usuario_por_id(data)
                del usr
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "actusr":
                usr = usuarios.usuarios()
                print formulario
                respuesta = usr.actualizar_usuario(data)
                del usr
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "verusr":
                usr = usuarios.usuarios()
                print formulario
                respuesta = usr.ver_usuarios_registrados(data)
                del usr
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "regobj":
                obj = objetos.objetos()
                print formulario
                respuesta = obj.insertar_objeto(data)
                del obj
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "modobj":
                obj = objetos.objetos()
                print formulario
                respuesta = obj.get_objeto_por_id(data)
                del obj
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "regpre":
                prest = prestamos.prestamos()
                print formulario
                respuesta = prest.insertar_prestamo(data)
                del prest
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "modpre":
                prest = prestamos.prestamos()
                print formulario
                respuesta = prest.get_prestamo_por_id(data)
                del prest
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "prepen":
                prest = prestamos.prestamos()
                print formulario
                respuesta = prest.marcar_prestamo_como_pendiente(data)
                del prest
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "predev":
                prest = prestamos.prestamos()
                print formulario
                respuesta = prest.marcar_prestamo_como_devuelto(data)
                del prest
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "actpre":
                prest = prestamos.prestamos()
                print formulario
                respuesta = prest.actualizar_prestamo(data)
                del prest
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "vprepe":
                prest = prestamos.prestamos()
                print formulario
                respuesta = prest.ver_prestamos_pendientes(data)
                del prest
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "vprede":
                prest = prestamos.prestamos()
                print formulario
                respuesta = prest.ver_prestamos_devueltos(data)
                del prest
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "delpre":
                prest = prestamos.prestamos()
                print formulario
                respuesta = prest.eliminar_prestamo(data)
                del prest
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "actobj":
                obj = objetos.objetos()
                print formulario
                respuesta = obj.actualizar_objeto(data)
                del obj
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "delobj":
                obj = objetos.objetos()
                print formulario
                respuesta = obj.eliminar_objeto(data)
                del obj
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "cbxobj":
                obj = objetos.objetos()
                print formulario
                respuesta = obj.ver_mis_objetos_combobox(data)
                del obj
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "verobj":
                obj = objetos.objetos()
                print formulario
                respuesta = obj.ver_mis_objetos_tabla(data)
                del obj
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "regami":
                amig = amigos.amigos()
                print formulario
                respuesta = amig.insertar_amigos(data)
                del amig
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "verami":
                amig = amigos.amigos()
                print formulario
                respuesta = amig.ver_mis_amigos_tabla(data)
                del amig
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "cbxami":
                amig = amigos.amigos()
                print formulario
                respuesta = amig.ver_mis_amigos_combobox(data)
                del amig
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "delami":
                amig = amigos.amigos()
                print formulario
                respuesta = amig.eliminar_amistad(data)
                del amig
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "regrep":
                rep = reputaciones.reputaciones()
                print formulario
                respuesta = rep.insertar_reputacion(data)
                del rep
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            if formulario == "veorep":
                rep = reputaciones.reputaciones()
                print formulario
                respuesta = rep.perfil_usuario_reputaciones(data)
                del rep
                if respuesta:
                    print "respuesta al php: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)

            del data

                # if len(respuesta) != 0:
                #     s.send(respuesta)
                # else:
                #     s.close()
                #     input.remove(s)
            # print data
            # if respuesta:
            #     s.send(respuesta)
            # else:
            #     s.close()
            #     input.remove(s)
server.close()
