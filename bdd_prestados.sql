create table Usuarios
(
id serial primary key,
nombre varchar(20),
apellido varchar(20),
email varchar(40),
password varchar(10)
);

alter table prestamos alter column fecha set default ;
create table Objetos
(
id serial primary key,
nombre varchar(15),
id_usuario_dueno int,
constraint fk_usuario_dueno foreign key (id_usuario_dueno) REFERENCES Usuarios (id)
);

create table Prestamos
(
id serial primary key,
fecha date,
--fecha varchar(10),
id_usuario_prestador int,
id_usuario_recibidor int,
id_objeto int,
estado int,
fecha_devolucion date,
cantidad_prestada int,
--fecha_devolucion varchar(10),
constraint fk_usuario_prestador foreign key (id_usuario_prestador) REFERENCES Usuarios (id),
constraint fk_usuario_recibicdor foreign key (id_usuario_recibidor) REFERENCES Usuarios (id),
constraint fk_objeto foreign key (id_objeto) REFERENCES Objetos (id)
);


create table Amigos
(
id serial primary key,
amigo_1 int,
amigo_2 int,
constraint fk_amigo_1 foreign key (amigo_1) REFERENCES Usuarios (id),
constraint fk_amigo_2 foreign key (amigo_2) REFERENCES Usuarios (id)
);


create table ReputacionUsuarios
(
id serial primary key,
id_usuario_clasificado int,
clasificacion int,
constraint fk_usuario_clasificado foreign key (id_usuario_clasificado) REFERENCES Usuarios (id)
);

create view misAmigos as
select
a.amigo_1,
u.email
from
usuarios as u,
amigos as a
where
u.id = a.amigo_2;
