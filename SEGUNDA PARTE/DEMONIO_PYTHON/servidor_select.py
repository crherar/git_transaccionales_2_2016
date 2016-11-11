#!/usr/bin/env python

"""
An echo server that uses select to handle multiple clients at a time.
Entering any line of input at the terminal will exit the server.
"""

import select
import socket
import sys
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
usr = usuarios.usuarios()
while running:
    inputready,outputready,exceptready = select.select(input,[],[])

    for s in inputready:

        if s == server:
            print "s:"
            #pprint(s)
            # handle the server socket
            client, address = server.accept()
            input.append(client)

        # elif s == sys.stdin:
        #     # handle standard input
        #     junk = sys.stdin.readline()
        #     running = 0

        else:
            # handle all other sockets
            data = s.recv(size)
            datsplit = data.split('|')
            print "data recibida"
            formulario = datsplit[0]

            if formulario == "loginn":
                print formulario
                respuesta = usr.login(datsplit[1])
            print data
            if data:
                s.send(data)
            else:
                s.close()
                input.remove(s)
server.close()