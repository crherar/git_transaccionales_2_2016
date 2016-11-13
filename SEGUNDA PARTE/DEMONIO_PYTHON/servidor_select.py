#!/usr/bin/env python


import json
import select
import socket
import usuarios
import objetos
import amigos
import sys
from pprint import pprint

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
                    print "respuesta 2: "
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
                    print "respuesta 2: "
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
                    print "respuesta 2: "
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
                    print "respuesta 2: "
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
                    print "respuesta 2: "
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
                    print "respuesta 2: "
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
                respuesta = amig.ver_mis_amigos(data)
                del amig
                if respuesta:
                    print "respuesta 2: "
                    print respuesta
                    s.send(respuesta)
                    input.remove(s)
                else:
                    print "NO EXISTE RESPUESTA"
                    s.close()
                    input.remove(s)
#
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
