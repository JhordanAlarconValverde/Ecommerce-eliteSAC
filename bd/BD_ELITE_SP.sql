use bd_elite;

/******************* UBIGEO *********************/
delimiter $$
create procedure sp_ListarDepartamentos()
begin
	select * from departamento;
end; $$

delimiter $$
create procedure sp_ListarProvPorDep(in _codDepartamento varchar(20))
begin
	select tbp.id, tbp.nombre  from provincia tbp inner join departamento tbd 
    on(tbp.idDepartamento = tbd.id) where idDepartamento = _codDepartamento;
end; $$

delimiter $$
create procedure sp_ListarDisPorProv(in _codProvincia varchar(20))
begin
	select tbd.id, tbd.nombre  from distrito tbd inner join provincia tbp 
    on(tbd.idProvincia = tbp.id) where idProvincia = _codProvincia;
end; $$

call sp_ListarDepartamentos();
call sp_ListarProvPorDep(14);
call sp_ListarDisPorProv(1401);


/******************* USUARIO *********************/
delimiter $$
create procedure sp_ListarUsuario()
begin
	select tbu.id, tbu.nombre, tbu.apellido, tbu.usuario, tbu.correo, tbu.telefono, tbu.direccion, tbu.referencia, tbd.nombre 'distrito'  
    from usuario tbu inner join distrito tbd on(tbu.idDistrito = tbd.id);
end; $$

delimiter $$
create procedure sp_ListarUsuarioLimit(in limit1 int, in limit2 int)
begin
	select tbu.id, tbu.nombre, tbu.apellido, tbu.usuario, tbu.correo, tbu.telefono, tbu.direccion, tbu.referencia, tbd.nombre 'distrito'  
    from usuario tbu inner join distrito tbd on(tbu.idDistrito = tbd.id) limit limit1, limit2;
end; $$

delimiter $$
create procedure sp_BuscarUsuarioPorCodigo(in _id int)
begin
	select * from usuario where id = _id;
end; $$

delimiter $$
create procedure sp_FiltrarUsuario(in _nombre varchar(90))
begin
	select tbu.id, tbu.nombre, tbu.apellido, tbu.usuario, tbu.correo, tbu.telefono, tbu.direccion, tbu.referencia, tbd.nombre 'distrito'  
    from usuario tbu inner join distrito tbd on(tbu.idDistrito = tbd.id) where tbu.nombre like concat('%', _nombre, '%');
end; $$

delimiter $$
create procedure sp_InsertarUsuario(
in _idDistrito varchar(20),
in _nombre varchar(90),
in _apellido varchar(90),
in _telefono varchar(20),
in _direccion varchar(90),
in _referencia varchar(90),
in _correo varchar(90),
in _clave varchar(45),
in _usuario varchar(45),
in _foto text
)
begin
	insert into Usuario(idDistrito,nombre,apellido,telefono,direccion,referencia,correo,clave,usuario,foto) values
    (_idDistrito,_nombre,_apellido,_telefono,_direccion,_referencia,_correo,_clave,_usuario,_foto);
end; $$

delimiter $$
create procedure sp_ActualizarUsuario(
in _id int,
in _nombre varchar(90),
in _apellido varchar(90),
in _telefono varchar(20),
in _direccion varchar(90),
in _referencia varchar(90),
in _correo varchar(90),
in _clave varchar(45),
in _usuario varchar(45),
in _idDistrito varchar(20),
in _foto text
)
begin
	update usuario set nombre = _nombre, apellido = _apellido, telefono = _telefono, direccion = _direccion, 
						referencia = _referencia, correo = _correo, clave = _clave, usuario = _usuario,
						idDistrito = _idDistrito, foto = _foto where id = _id;
end; $$

delimiter $$
create procedure sp_EliminarUsuario(in _id int)
begin
	delete from usuario where id = _id;
end; $$

call sp_ListarUsuario();
call sp_ListarUsuarioLimit(2,12);
call sp_BuscarUsuarioPorCodigo(1);
call sp_FiltrarUsuario('c');
call sp_InsertarProducto('1','3','Carpeta','Carpeta para estudiante','10','R',800,790,'#');
call sp_ActualizarProducto(9,'Carpetas','Carpetas paras estudiantes',10,'S',900,290,'foto.png',3,4);
call sp_EliminarProducto(9);


/******************* CATEGORIA *********************/
delimiter $$
create procedure sp_ListarCategoria()
begin
	select * from categoria;
end; $$

delimiter $$
create procedure sp_BuscarCategoriaPorCodigo(in _id int)
begin
	select * from categoria where id = _id;
end; $$

delimiter $$
create procedure sp_FiltrarCategoria(in _nombre varchar(90))
begin
	select * from categoria where nombre like concat('%', _nombre, '%');
end; $$

delimiter $$
create procedure sp_InsertarCategoria(in _nombre varchar(90))
begin
	insert into categoria(nombre) values(_nombre);
end; $$

delimiter $$
create procedure sp_ActualizarCategoria(in _id int, in _nombre varchar(90))
begin
	update categoria set nombre = _nombre where id = _id;
end; $$

delimiter $$
create procedure sp_EliminarCategoria(in _id int)
begin
	delete from categoria where id = _id;
end; $$


/******************* EMPLEADO *********************/
delimiter $$
create procedure sp_ListarEmpleado()
begin
	select tbe.id, tbe.nombre, tbe.apellido, tbe.telefono, tbe.correo, tbe.usuario, tbt.turno 
    from empleado tbe inner join turno tbt on(tbe.idTurno = tbt.id);
end; $$

delimiter $$
create procedure sp_BuscarEmpleadoPorCodigo(in _id int)
begin
	select * from empleado where id = _id;
end; $$

delimiter $$
create procedure sp_FiltrarEmpleado(in _nombre varchar(90))
begin
	select tbe.id, tbe.nombre, tbe.apellido, tbe.telefono, tbe.correo, tbe.usuario, tbt.turno 
    from empleado tbe inner join turno tbt on(tbe.idTurno = tbt.id) where tbe.nombre like concat('%', _nombre, '%');
end; $$

delimiter $$
create procedure sp_InsertarEmpleado(
in _idTurno int,
in _nombre varchar(90),
in _apellido varchar(90),
in _telefono varchar(90),
in _correo varchar(90),
in _clave varchar(45),
in _usuario varchar(45)
)
begin
	insert into empleado(idTurno, nombre, apellido, telefono, correo, clave, usuario) values
    (_idTurno,_nombre,_apellido,_telefono,_correo,_clave,_usuario);
end; $$

delimiter $$
create procedure sp_ActualizarEmpleado(
in _id int,
in _nombre varchar(90),
in _apellido varchar(90),
in _telefono varchar(90),
in _correo varchar(90),
in _clave varchar(45),
in _usuario varchar(45),
in _idTurno int
)
begin
	update empleado set nombre = _nombre, apellido = _apellido, telefono = _telefono, correo = _correo, 
						clave = _clave, usuario = _usuario, idTurno = _idTurno
						where id = _id;
end; $$

delimiter $$
create procedure sp_EliminarEmpleado(in _id int)
begin
	delete from empleado where id = _id;
end; $$

delimiter $$
create procedure sp_ListarTurno()
begin
	select id, 
    case turno
    when 'M' then 'Mañana'
    when 'T' then 'Tarde'
    when 'N' then 'Noche'
    end 'turno' from turno;
end; $$


/******************* METODOPAGO *********************/
delimiter $$
create procedure sp_ListarMetodoPago()
begin
	select * from metodopago;
end; $$

delimiter $$
create procedure sp_BuscarMetodoPagoPorCodigo(in _id int)
begin
	select * from metodopago where id = _id;
end; $$

delimiter $$
create procedure sp_FiltrarMetodoPago(in _nombre varchar(90))
begin
	select * from metodopago where nombre like concat('%', _nombre, '%');
end; $$

delimiter $$
create procedure sp_InsertarMetodoPago(in _nombre varchar(90))
begin
	insert into metodopago(nombre) values(_nombre);
end; $$

delimiter $$
create procedure sp_ActualizarMetodoPago(in _id int, in _nombre varchar(90))
begin
	update metodopago set nombre = _nombre where id = _id;
end; $$

delimiter $$
create procedure sp_EliminarMetodoPago(in _id int)
begin
	delete from metodopago where id = _id;
end; $$

select distinct nombre from producto where nombre like '%tablet%';
select distinct nombre, idCategoria from producto;
select * from categoria;
select * from usuario where usuario = "jhordan123";
select * from producto where estatus != "revision";
select * from producto where idCategoria = 15 and precioDescuento between 10 and 100 order by precioDescuento asc
select * from producto where idUsuario = 12 and estatus = 'revision'
/******************* PRODUCTO *********************/
/*delimiter $$
create procedure sp_ListarProducto()
begin
	select tbp.id, tbp.imagen, tbp.nombre 'producto', tbp.descripcion, tbp.cantidad, 
    case tbp.estado
		when 'R' then 'Reparado'
        when 'S' then 'Segunda mano'
    end 'estado'
    , tbp.precio, tbp.precioDescuento,
    tbc.nombre 'categoria', tbu.usuario 'usuario' from producto tbp inner join categoria tbc 
    on(tbp.idCategoria=tbc.id) inner join usuario tbu on(tbp.idUsuario = tbu.id) order by tbp.id asc;
end; $$

delimiter $$
create procedure sp_BuscarProductoPorID(in _codProducto int)
begin
	select * from producto where id = _codProducto order by id asc;
end; $$

delimiter $$
create procedure sp_BuscarProductoPorCod(in _codProducto int)
begin
	select tbp.id, tbp.idCategoria , tbp.idUsuario, tbp.nombre 'producto', tbp.descripcion, tbp.cantidad,
    tbp.estado,tbp.precio, tbp.precioDescuento, tbp.imagen  from producto tbp inner join categoria tbc 
    on(tbp.idCategoria=tbc.id) inner join usuario tbu on(tbp.idUsuario = tbu.id) where tbp.id = _codProducto;
end; $$

delimiter $$
create procedure sp_InsertarProducto(
in _idCategoria int,
in _idUsuario int,
in _nombre varchar(90),
in _descripcion varchar(120),
in _cantidad int,
in _estado varchar(45),
in _precio float,
in _precioDescuento float,
in _imagen text
)
begin
	insert into Producto(idCategoria,idUsuario,nombre,descripcion,cantidad,estado,precio,precioDescuento,imagen) values
    (_idCategoria,_idUsuario,_nombre,_descripcion,_cantidad,_estado,_precio,_precioDescuento,_imagen);
end; $$

delimiter $$
create procedure sp_ActualizarProducto(
in _id int,
in _nombre varchar(90),
in _descripcion varchar(120),
in _cantidad int,
in _estado varchar(45),
in _precio float,
in _precioDescuento float,
in _imagen text,
in _idCategoria int,
in _idUsuario int
)
begin
	update Producto set idCategoria = _idCategoria, idUsuario = _idUsuario, nombre = _nombre, descripcion = _descripcion,
    cantidad = _cantidad, estado = _estado, precio = _precio, precioDescuento = _precioDescuento, imagen = _imagen where id = _id;
end; $$

delimiter $$
create procedure sp_EliminarProducto(
in _id int
)
begin
	delete from Producto where id = _id;
end; $$

delimiter $$
create procedure sp_FiltrarProductoPorNombre(in _nombre varchar(90))
begin
	select tbp.id, tbp.imagen, tbp.nombre 'producto', tbp.descripcion, tbp.cantidad, 
    case tbp.estado
		when 'R' then 'Reparado'
        when 'S' then 'Segunda mano'
    end 'estado'
    , tbp.precio, tbp.precioDescuento,
    tbc.nombre 'categoria', tbu.usuario 'usuario' from producto tbp inner join categoria tbc 
    on(tbp.idCategoria=tbc.id) inner join usuario tbu on(tbp.idUsuario = tbu.id) where tbp.nombre like concat('%',_nombre,'%') order by tbp.id asc;
end; $$*/
select * from producto where nombre in (select tbp.nombre, count(*) from DetalleCompra tbdc inner join Producto tbp on(tbdc.idProducto = tbp.id));


select count(*) from DetalleCompra where idProducto = 4;
select count(*) from DetalleCompra where idProducto = 30;
-- Retorna los productos que han sido vendidos
select tbp.nombre from DetalleCompra tbdc inner join Producto tbp on(tbdc.idProducto = tbp.id);
-- Retorna la cantidad de cada producto que ha sido vendido
select tbp.nombre, count(*) from DetalleCompra tbdc inner join Producto tbp on(tbdc.idProducto = tbp.id) where tbp.nombre = 'Tablet Táctil';
select * from producto:

select * from compra;
select * from detallecompra;

select 
            p.id 'id',
            p.nombre 'producto',
            p.descripcion 'descripcion',
            case p.estado
            when 'R' then 'Reparado' when 'S' then 'Segunda mano' end 'estado',
            p.precio 'precio',
            p.precioDescuento 'precioDescuento',
            p.imagen 'imagen',
            sum(dc.cantidad) 'cantidadVendida' from DetalleCompra dc inner join producto p 
            on(dc.idProducto = p.id) group by p.id order by sum(dc.cantidad) desc limit 10;
            
select * from usuario order by id desc limit 10; 
select * from DetalleCompra;
select count(*) from compra;
select count(*) from producto;
select count(*) from usuario;


select * from producto where estatus = 'publicado';
-- productos vendidos
select count(*) from DetalleCompra tbdc inner join compra tbc on(tbdc.idCompra=tbc.id) 
inner join producto tbp on(tbdc.idProducto=tbp.id);

-- CATEGORIA MAS VENDIDA
select sum(tbdc.cantidad) 'cantidad vendida', tbca.nombre from DetalleCompra tbdc inner join compra tbc on(tbdc.idCompra=tbc.id) 
inner join producto tbp on(tbdc.idProducto=tbp.id) inner join categoria tbca on
(tbp.idCategoria=tbca.id) group by tbca.nombre order by sum(tbdc.cantidad) desc limit 1;

select sum(tbdc.cantidad) 'cantidad', tbca.nombre from DetalleCompra tbdc inner join compra tbc on(tbdc.idCompra=tbc.id) 
inner join producto tbp on(tbdc.idProducto=tbp.id) inner join categoria tbca on
(tbp.idCategoria=tbca.id) group by tbca.nombre order by sum(tbdc.cantidad);

select * from categoria;
select * from producto; 
select * from compra
select * from detallecompra

-- set lc_time_names = 'es_VE';
select sum(total) 'total', MONTHNAME(fechaDePago) 'mes', fechaDePago 'fecha' from compra where fechaDePago 
between '2019-01-01' and '2019-12-30' group by MONTHNAME(fechaDePago) order by fechaDePago;


select sum(total) 'total', MONTHNAME(fechaDePago) 'mes', fechaDePago 'fecha' from compra 
where YEAR(fechaDePago) = 2022 group by MONTHNAME(fechaDePago) order by fechaDePago;





select sum(tbdc.cantidad) as 'cantidad', tbp.idCategoria from DetalleCompra tbdc inner join compra tbc on(tbdc.idCompra=tbc.id) 
inner join producto tbp on(tbdc.idProducto=tbp.id) group by tbp.idCategoria;

select tbca.nombre from DetalleCompra tbdc inner join compra tbc on(tbdc.idCompra=tbc.id) 
inner join producto tbp on(tbdc.idProducto=tbp.id) 
inner join categoria tbca on(tbp.idCategoria=tbca.id);

select sum(tbdc.cantidad),tbdc.cantidad,tbdc.idProducto, tbp.nombre, tbca.nombre from DetalleCompra tbdc inner join compra tbc on(tbdc.idCompra=tbc.id) 
inner join producto tbp on(tbdc.idProducto=tbp.id) 
inner join categoria tbca on(tbp.idCategoria=tbca.id) group by tbdc.id;


select * from usuario;

select * from producto where id = 5;
select * from producto where id = 3;
select * from producto where descripcion = 'Ove Tablet FD Plus - 10.3", 32GB';
select * from producto where descripcion = 'Tableta Space S7 - 11”, 128GB Wi-Fi';


update producto set estatus = 'agotado' where id = 3;

/*

3 5
66 2
*/


select * from producto

-- 
-- update producto set cantidad =  where id = ;