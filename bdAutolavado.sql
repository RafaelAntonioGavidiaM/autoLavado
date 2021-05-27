create database autolavado;
use autolavado;

create table dueño(
idDueño int not null auto_increment,
documento varchar(30),
nombre varchar(30),
apellidos varchar(30),
direccion varchar(30),
telefono varchar(30),
email varchar(30),
primary key(iddueño)
);



create table carro(
idCarro int not null auto_increment,
modelo varchar(30),
idDueño int,
color varchar(30),
placa varchar(30),
imagen varchar(100),
primary key(idCarro)
);

create table lavado(
idLavado int not null auto_increment,
fecha date,
idCarro int,
idPersonal int,
valorPagar float,
primary key(idLavado);

);

create table parqueadero(
idParqueadero int not null auto_increment,
fecha date,
idCarro int,
horaEntrada time,
horaSalida time,
idPersonal int,
primary key(idParqueadero)

);

create table personal(
idPersonal int not null auto_increment,
documento varchar(20),
nombre varchar(30),
apellidos varchar(30),
contraseña varchar(20),
primary key(idPersonal)

);

alter table carro add foreign key (idDueño) references dueño(idDueño);
alter table lavado add foreign key (idPersonal) references personal(idPersonal);
alter table parqueadero add foreign key (idPersonal) references personal(idPersonal);
alter table parqueadero add foreign key(idCarro) references carro(idCarro);
alter table lavado add foreign key(idCarro) references carro(idCarro);






