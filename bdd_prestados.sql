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
a.id as id_amistad,
a.amigo_1,
a.amigo_2 as id_amigo,
concat(RTRIM(u.nombre),' ',u.apellido) as amigo,
u.email as emailamigo
from
usuarios as u,
amigos as a
where
u.id = a.amigo_2;


create view misPrestamos as
select
p.id,
p.id_usuario_prestador,
p.fecha as FechaPrestamo,
concat(u.nombre,' ',u.apellido) as usuario_recibidor,
u.email as emailRecibidor,
o.nombre as nombreObjeto,
p.fecha_devolucion,
p.cantidad_prestada,
p.estado
from
usuarios as u,
prestamos as p,
objetos as o
where
p.id_usuario_recibidor = u.id and
p.id_objeto = o.id;





select string_agg(concat('{','id:',cast(id as text),',',
                              "\'fecha_xprestamo:\'",fechaprestamo,',',
                              'email_usuario_recibidor:',emailrecibidor,',',
                              'nombre_objeto:',nombreobjeto,',',
                              'fecha_devolucion:',fecha_devolucion,',',
                              'cantidad_prestada:',cantidad_prestada,'}'),'|') as datos

select string_agg(concat(cast(id as text),',',
                              fechaprestamo,',',
                              emailrecibidor,',',
                              nombreobjeto,',',
                              fecha_devolucion,',',
                              cantidad_prestada),'|') as datos
 from misprestamos where id_usuario_prestador = 27;

select json_agg(misprestamos.*) from misprestamos where id_usuario_prestador = 27;


select json_build_object('fecha_prestamo',fechaprestamo,'email_usuario_recibidor',emailrecibidor) from misprestamos;
