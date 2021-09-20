create temporary table mitabla
(select count(*)
 from pedido p join linped l on (p.numpedido=l.numpedido)
 where month(fecha) =11 and l.articulo=cod) noviembre,

 ));

select * from mitabla where octubre>0 and noviembre>0;

CREATE TEMPORARY TABLE proveedordatos(
       id INT NOT NULL AUTO_INCREMENT,
       documentoId VARCHAR(100) NOT NULL,
       nombre VARCHAR(100) NOT NULL,
       direccion VARCHAR(100) NOT NULL,
       PRIMARY KEY ( id )
    );

--->Temporary table creation from select query
CREATE TEMPORARY TABLE proveedordatos
    SELECT documentoId,proveedor,direccion FROM proveedores;
SELECT * FROM proveedordatos;


CREATE DATABASE factura;

USE factura;

CREATE TABLE productos(
    id int(11) NOT NULL AUTO_INCREMENT,
    nombre varchar(100) NOT NULL,
    precio float(10,2),
    stock float(10,2),
    CONSTRAINT pk_productos PRIMARY KEY(id) 
) ENGINE=InnoDB;
CREATE TABLE proveedores(
    id int(11) NOT NULL AUTO_INCREMENT,
    nombre varchar(100) NOT NULL,
    CONSTRAINT pk_proveedor PRIMARY KEY(id) 
) ENGINE=InnoDB;




CREATE TABLE entrada(
    id int(11) NOT NULL AUTO_INCREMENT,
    id_proveedor int(11) NOT NULL,
    total float(10,2),
    fecha date,
    CONSTRAINT pk_entrada PRIMARY KEY(id),
    CONSTRAINT fk_proveedor FOREIGN KEY(id_proveedor) REFERENCES proveedores(id) 
) ENGINE=InnoDB;
CREATE TABLE entradadetalle(
    id int(11) NOT NULL AUTO_INCREMENT,
    id_producto int(11) NOT NULL,
    id_entrada int(11) NOT NULL,
    cantidad varchar(100) NOT NULL,
    precio float(10,2),
    rotal float(10,2),
    CONSTRAINT pk_entradadetalle PRIMARY KEY(id),
    CONSTRAINT fk_producto FOREIGN KEY(id_producto) REFERENCES productos(id), 
    CONSTRAINT fk_entrada FOREIGN KEY(id_entrada) REFERENCES entrada(id)
) ENGINE=InnoDB;




CREATE TABLE clientes(
    id int(11) NOT NULL AUTO_INCREMENT,
    nombre varchar(100) NOT NULL,
    CONSTRAINT pk_cliente PRIMARY KEY(id) 
) ENGINE=InnoDB;


CREATE TABLE venta(
    id int(11) NOT NULL AUTO_INCREMENT,
    id_cliente int(11) NOT NULL,
    total float(10,2),
    fecha date,
    CONSTRAINT pk_venta PRIMARY KEY(id),
    CONSTRAINT fk_cliente FOREIGN KEY(id_cliente) REFERENCES clientes(id) 
) ENGINE=InnoDB;
CREATE TABLE ventadetalle(
    id int(11) NOT NULL AUTO_INCREMENT,
    id_producto int(11) NOT NULL,
    id_venta int(11) NOT NULL,
    cantidad varchar(100) NOT NULL,
    precio float(10,2),
    rotal float(10,2),
    CONSTRAINT pk_ventadetalle PRIMARY KEY(id),
    CONSTRAINT fk_productosventas FOREIGN KEY(id_producto) REFERENCES productos(id), 
    CONSTRAINT fk_venta FOREIGN KEY(id_venta) REFERENCES venta(id)
) ENGINE=InnoDB;
CREATE TABLE venta_por_cobrar(
    id int(11) NOT NULL AUTO_INCREMENT,
    id_venta int(11) NOT NULL,
    valor float(100) NOT NULL,
    saldo float(10,2),
    CONSTRAINT pk_ventadetalle PRIMARY KEY(id),
    CONSTRAINT fk_venta FOREIGN KEY(id_venta) REFERENCES venta(id)
) ENGINE=InnoDB;


/*Productos*/
INSERT INTO productos VALUES(NULL,'Ferrari Spider',45,100);
INSERT INTO productos VALUES(NULL,'Spider',45,100);
INSERT INTO productos VALUES(NULL,'Carro',5,100);
INSERT INTO productos VALUES(NULL,'Clasico Spider',48,100);


/* Proveedores */
INSERT INTO proveedores VALUES(NULL,'CAO');
INSERT INTO proveedores VALUES(NULL,'WWE');
INSERT INTO proveedores VALUES(NULL,'CLARO');
INSERT INTO proveedores VALUES(NULL,'ETAPA');
/* Clientes */
INSERT INTO clientes VALUES(NULL,'Ecuaquimica');
INSERT INTO clientes VALUES(NULL,'Alvisa');
INSERT INTO clientes VALUES(NULL,'Incoa');
INSERT INTO clientes VALUES(NULL,'Agrosad');

/* Entrada */

INSERT INTO entrada VALUES(NULL,1,45,'2019-06-10');
INSERT INTO entrada VALUES(NULL,2,48,'2019-07-10');
INSERT INTO entrada VALUES(NULL,3,46,'2019-08-09');
INSERT INTO entrada VALUES(NULL,4,30,'2019-01-10');


/* Entrada detalle */

    INSERT INTO entradadetalle VALUES(NULL,1,1,45,1200,7856);
    INSERT INTO entradadetalle VALUES(NULL,2,1,45,1200,7856);
    INSERT INTO entradadetalle VALUES(NULL,3,1,45,1200,7856);
    INSERT INTO entradadetalle VALUES(NULL,4,2,45,1200,7856);
    INSERT INTO entradadetalle VALUES(NULL,3,2,45,1200,7856);
    INSERT INTO entradadetalle VALUES(NULL,2,3,45,1200,7856);
    INSERT INTO entradadetalle VALUES(NULL,4,4,45,1200,7856);
    INSERT INTO entradadetalle VALUES(NULL,1,4,45,1200,7856);

/* Venta */

INSERT INTO venta VALUES(NULL,1,45,'2019-06-10');
INSERT INTO venta VALUES(NULL,2,48,'2019-08-10');
INSERT INTO venta VALUES(NULL,3,46,'2019-07-09');
INSERT INTO venta VALUES(NULL,4,30,'2019-02-10');

INSERT INTO venta VALUES(NULL,1,0,'2019-06-10');
INSERT INTO venta VALUES(NULL,2,0,'2019-08-10');
INSERT INTO venta VALUES(NULL,3,0,'2019-07-09');
INSERT INTO venta VALUES(NULL,4,0,'2019-02-10');


/* Venta detalle */

    INSERT INTO ventadetalle VALUES(NULL,1,4,48,1240,78579);
    INSERT INTO ventadetalle VALUES(NULL,2,3,48,1240,78579);
    INSERT INTO ventadetalle VALUES(NULL,1,1,48,1240,78579);
    INSERT INTO ventadetalle VALUES(NULL,2,2,48,1240,78579);
    INSERT INTO ventadetalle VALUES(NULL,3,2,48,1240,78579);
    INSERT INTO ventadetalle VALUES(NULL,1,3,48,1240,78579);
    INSERT INTO ventadetalle VALUES(NULL,2,4,48,1240,78579);
    INSERT INTO ventadetalle VALUES(NULL,2,1,48,1240,78579);



 SELECT * FROM grupos WHERE id IN(SELECT grupo_id FROM vendedores WHERE sueldo =(SELECT MAX(sueldo) FROM vendedores));

 SELECT a.modelo AS 'Auto', cl.nombre AS 'Cliente', SUM(e.cantidad) AS 'Unidades' FROM encargos e INNER JOIN autos a ON a.id=e.auto_id INNER JOIN clientes cl ON cl.id=e.cliente_id GROUP BY e.auto_id, e.cliente_id;



/* Ver entradas y salidas de un solo producto */

SET @fecha='';
SET @fecha1='';
SET @total=0;


SELECT e.id AS 'Entradaide', ' - ' AS 'Salidaide', p.nombre AS 'Producto', p.precio AS 'Precio', ed.cantidad AS 'Entrada1', 0 AS 'Salida1', (SELECT @total:=@total +(Entrada1-Salida1)) AS saldo , @fecha:=CONCAT_WS('',e.fecha) AS 'Fecha' FROM productos p 
LEFT JOIN entradadetalle ed ON p.id=ed.id_producto 

LEFT JOIN ventadetalle vd ON p.id=vd.id_producto 

LEFT JOIN entrada e ON ed.id_entrada=e.id 

LEFT JOIN venta v ON vd.id_venta=v.id WHERE p.id=1;

SET @fecha='';
SET @fecha1='';
SET @total='';
SET @total1='';
(SELECT e.id AS 'Entradaid', ' - ' AS 'Salidaid', p.nombre AS 'Producto', p.precio AS 'Precio', ed.cantidad AS 'Entrada1', '0' AS 'Salida1', @fecha:=CONCAT_WS('',e.fecha) AS 'Fecha', @total:=@total+(ed.cantidad-vd.cantidad)-(ed.cantidad-vd.cantidad) AS 'saldo' FROM productos p 
LEFT JOIN entradadetalle ed ON p.id=ed.id_producto 

LEFT JOIN ventadetalle vd ON p.id=vd.id_producto 

LEFT JOIN entrada e ON ed.id_entrada=e.id 

LEFT JOIN venta v ON vd.id_venta=v.id WHERE p.id=1) 

UNION

(SELECT ' - ' AS 'Entradaid', v.id AS 'Salidaid', p.nombre AS 'Producto', p.precio AS 'Precio', '0' AS 'Entrada', vd.cantidad AS 'Salida', @fecha1:=CONCAT_WS('',v.fecha) AS 'Fecha', @total AS 'saldo'  FROM productos p 
RIGHT JOIN entradadetalle ed ON p.id=ed.id_producto 

RIGHT JOIN ventadetalle vd ON p.id=vd.id_producto 

RIGHT JOIN entrada e ON ed.id_entrada=e.id 

RIGHT JOIN venta v ON vd.id_venta=v.id WHERE p.id=1) ORDER BY Fecha ;



/* Inserccion de tabla de ventas  */


INSERT INTO venta (id_cliente,id_vendedor,id_asiento,codigo,detalle,impuesto,descuento,neto,total) VALUES (1,1,1,'00001','Nueva venta',0,0,10,10)
(2,1,1,'00001','Nueva venta',0,0,10,10)
(3,1,2,'00001','Nueva venta',0,0,10,10)
(1,1,2,'00001','Nueva venta',0,0,10,10)
;



/* IMPORTANTE  */



SELECT JSON_EXTRACT(Address, "$[*].precio") FROM tbl_TestJSON;
/* ---------------------------------------------------- */
SET fecha='';
SET fecha1='';
(select json_extract(e.productos, '$[*].id') AS idEntrada, ' - ' AS idSalida, json_extract(e.productos, '$[*].descripcion') AS descEntrada,' - ' AS descSalida, json_extract(e.productos, '$[*].precio') AS precioEntrada, ' - ' AS precioSalida, @fecha:=CONCAT_WS('',e.fecha) AS 'Fecha'  FROM ventas ve
LEFT JOIN entradas e ON e.id=e.id 
LEFT JOIN ventas v  ON ve.id=v.id)
UNION
(select ' - ' AS idEntrada, json_extract(v.productos, '$[*].id') AS idSalida, ' - ' AS descEntrada,json_extract(v.productos, '$[*].descripcion') AS descSalida, ' - ' AS precioEntrada, json_extract(v.productos, '$[*].precio') AS precioSalida , @fecha1:=CONCAT_WS('',v.fecha) AS 'Fecha' FROM ventas ve
RIGHT JOIN entradas e ON e.id=e.id 

RIGHT JOIN ventas v  ON ve.id=v.id)




SET @fecha='';
SET @fecha1='';
(select json_extract(e.productos, '$[*].id') AS idEntrada, ' - ' AS idSalida, json_extract(e.productos, '$[*].descripcion') AS descEntrada,' - ' AS descSalida, json_extract(e.productos, '$[*].precio') AS precioEntrada, ' - ' AS precioSalida, @fecha:=CONCAT_WS('',en.fecha_entrada) AS 'Fecha' FROM entradas en LEFT JOIN entradas e ON en.id=e.id LEFT JOIN ventas v ON v.id=v.id) 
UNION 
(select ' - ' AS idEntrada, json_extract(v.productos, '$[*].id') AS idSalida, ' - ' AS descEntrada,json_extract(v.productos, '$[*].descripcion') AS descSalida, ' - ' AS precioEntrada, json_extract(v.productos, '$[*].precio') AS precioSalida , @fecha1:=CONCAT_WS('',ve.fecha) AS 'Fecha' FROM ventas ve RIGHT JOIN entradas e ON e.id=e.id RIGHT JOIN ventas v ON v.id=ve.id) ORDER BY Fecha;

/* ------------------------------------------------------------- */



union
(select json_extract(productos, '$[*].id') AS id, json_extract(productos, '$[*].descripcion') AS descripcion, json_extract(productos, '$[*].precio') AS precio, json_extract(productos, '$[*].stock') AS stock from entradas);





(select json_extract(productos, '$[*].descripcion') AS descripcion from ventas)
union
(select json_extract(productos, '$[*].precio') AS Precio from ventas);


/* Casi Solucionado */

