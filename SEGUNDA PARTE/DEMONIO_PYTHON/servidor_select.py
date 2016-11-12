#!/usr/bin/env python



import select
import socket
import usuarios
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
            data = s.recv(size)
            datsplit = data.split('|')
            print "data recibida"
            formulario = datsplit[0]
            print formulario
            if formulario == "loginn":
                usr = usuarios.usuarios()
                print formulario
                respuesta = usr.login(datsplit[1])
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
