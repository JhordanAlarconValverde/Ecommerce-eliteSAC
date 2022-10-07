/* CREACION DE LA DATABASE */
create database bd_elite;

/* USAR LA DATABASE CREADA */
use bd_elite;

/* CREACION DE TABLAS */
create table if not exists Departamento
(
id varchar(20) not null,
nombre VARCHAR(90) not null,
primary key (id)
);

create table if not exists Provincia
(
id varchar(20) not null,
idDepartamento varchar(20) not null,
nombre VARCHAR(90) not null,
primary key (id),
foreign key (idDepartamento) references Departamento(id) on delete cascade on update cascade
);

create table if not exists Distrito
(
id varchar(20) not null,
idProvincia varchar(20) not null,
nombre varchar(90) not null,
primary key (id),
foreign key (idProvincia) references Provincia(id) on delete cascade on update cascade
);

create table if not exists Usuario
(
id int not null auto_increment,
idDistrito varchar(20) not null,
nombre varchar(90) not null,
apellido varchar(90) not null,
telefono varchar(20) not null,
direccion varchar(90) not null,
referencia varchar(90) not null,
correo varchar(90) not null,
clave varchar(45) not null,
usuario varchar(45) not null,
primary key (id),
foreign key (idDistrito) references Distrito(id) on update cascade
);

alter table Usuario add column foto text not null after usuario;

create table if not exists Categoria
(
id int not null auto_increment,
nombre varchar(90) not null,
primary key (id)
);

create table if not exists Producto
(
id int not null auto_increment,
idCategoria int not null,
idUsuario int not null,
nombre varchar(90) not null,
descripcion varchar(120) not null,
cantidad int not null,
estado varchar(45) not null,
precio float not null,
precioDescuento float not null,
imagen text not null,
primary key (id),
foreign key (idCategoria) references Categoria(id) on delete cascade on update cascade,
foreign key (idUsuario) references Usuario(id) on delete cascade on update cascade
);

alter table Producto add column estatus varchar(45) not null after imagen;

create table if not exists MetodoPago
(
id int not null auto_increment,
nombre varchar(90) not null,
primary key (id)
);

create table if not exists Compra
(
id int not null auto_increment,
idUsuario int not null,
idMetodoPago int,
total float,
fechaDePago datetime,
fechaDeEntrega datetime,
primary key (id),
foreign key (idUsuario) references Usuario(id) on delete cascade on update cascade,
foreign key (idMetodoPago) references MetodoPago(id) on delete cascade on update cascade
);

create table if not exists DetalleCompra
(
id int not null auto_increment,
idCompra int not null,
idProducto int not null,
precioProducto float not null,
cantidad int not null,
descuento float not null,
subtotal float not null,
primary key (id),
foreign key (idCompra) references Compra(id) on delete cascade on update cascade,
foreign key (idProducto) references Producto(id) on delete cascade on update cascade
);

create table if not exists Turno
(
id int not null auto_increment,
turno varchar(45) not null,
primary key (id)
);

create table if not exists Empleado
(
id int not null auto_increment,
idTurno int not null,
nombre varchar(90) not null,
apellido varchar(90) not null,
telefono varchar(90) not null,
correo varchar(90) not null,
clave varchar(45) not null,
usuario varchar(45) not null,
primary key (id),
foreign key (idTurno) references Turno(id) on delete cascade on update cascade
);

alter table Empleado add column foto text not null after usuario;
alter table Empleado add column rol varchar(45) not null after foto;

create table if not exists Incidencia
(
id int not null auto_increment,
idCompra int not null,
idEmpleado int not null,
descripcion varchar(120) not null,
imagen text not null,
fecha date not null,
hora time not null,
primary key (id),
foreign key (idCompra) references Compra(id) on delete cascade on update cascade,
foreign key (idEmpleado) references Empleado(id) on delete cascade on update cascade
);