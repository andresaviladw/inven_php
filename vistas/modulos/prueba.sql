SET @fecha='';
SET @fecha1='';
SET @total:=0;
SET @total1:=0;

SET @entrada1=0;
SET @salida1=0;
(SELECT e.id AS 'Entradaid', ' - ' AS 'Salidaid', p.nombre AS 'Producto', p.precio AS 'Precio', ed.cantidad AS 'Entrada1', 0 AS 'Salida1', @fecha:=CONCAT_WS('',e.fecha) AS 'Fecha' FROM productos p 
LEFT JOIN entradadetalle ed ON p.id=ed.id_producto 

LEFT JOIN ventadetalle vd ON p.id=vd.id_producto 

LEFT JOIN entrada e ON ed.id_entrada=e.id 

LEFT JOIN venta v ON vd.id_venta=v.id WHERE p.id=1) 

UNION

(SELECT ' - ' AS 'Entradaid', v.id AS 'Salidaid', p.nombre AS 'Producto', p.precio AS 'Precio', 0 AS 'Entrada', vd.cantidad) AS 'Salida', @fecha1:=CONCAT_WS('',v.fecha) AS 'Fecha'  FROM productos p 
RIGHT JOIN entradadetalle ed ON p.id=ed.id_producto 

RIGHT JOIN ventadetalle vd ON p.id=vd.id_producto 

RIGHT JOIN entrada e ON ed.id_entrada=e.id 

RIGHT JOIN venta v ON vd.id_venta=v.id WHERE p.id=1) ORDER BY Fecha;


/* Prueba de cantidad salida y entrada */


SET @total:=0;

SELECT entrada, salida, @total:=@total+entrada-salida AS 'Saldo', @total AS 'total' FROM entradasalida;

/* Cantidad Entrada, Salida y Autoconsumos  */


SET @fecha='';
SET @fecha1='';
SET @total:=0;

(SELECT de.cantidad AS 'Entrada', 0 AS 'Salida', @fecha:=CONCAT_WS('',de.fecha_emision) AS 'Fecha' FROM productos p 

LEFT JOIN detalle_entrada de ON p.id=de.id_producto 

LEFT JOIN detalle_autoconsumo da ON p.id=da.id_producto

LEFT JOIN detalle_venta dv ON p.id=dv.id_producto 

LEFT JOIN entradas e ON de.id_entrada=e.id 

LEFT JOIN ventas v ON dv.id_venta=v.id 

LEFT JOIN autoconsumos a ON da.id_autoconsumo=a.id WHERE p.id=1) 

UNION

(SELECT 0 AS 'Entrada', da.cantidad AS 'Salida', @fecha:=CONCAT_WS('',dv.fecha_emision) AS 'Fecha' FROM productos p 
RIGHT JOIN detalle_entrada de ON p.id=de.id_producto 
RIGHT JOIN detalle_autoconsumo da ON p.id=da.id_producto 
LEFT JOIN detalle_venta dv ON p.id=dv.id_producto 
RIGHT JOIN entradas e ON de.id_entrada=e.id 
RIGHT JOIN autoconsumos a ON da.id_autoconsumo=a.id
LEFT JOIN ventas v ON dv.id_venta=v.id WHERE p.id=1)
UNION

(SELECT 0 AS 'Entrada', dv.cantidad AS 'Salida', @fecha:=CONCAT_WS('',dv.fecha_emision) AS 'Fecha' FROM productos p 
RIGHT JOIN detalle_entrada de ON p.id=de.id_producto 
RIGHT JOIN detalle_autoconsumo da ON p.id=da.id_producto 
LEFT JOIN detalle_venta dv ON p.id=dv.id_producto 
RIGHT JOIN entradas e ON de.id_entrada=e.id 
RIGHT JOIN autoconsumos a ON da.id_autoconsumo=a.id
LEFT JOIN ventas v ON dv.id_venta=v.id WHERE p.id=1)

 ORDER BY Fecha;


 /* Insertar segun UNIO SELECT */

SET @fecha='';
SET @fecha1='';
SET @idprd='';
INSERT INTO entradasalida (entradaid, salidaid,productoid,entrada,salida, fecha)(SELECT e.id , ' - ',@idprd:=CONCAT_WS('',ed.id_producto), ed.cantidad, 0, @fecha:=CONCAT_WS('',e.fecha) AS 'Fecha' FROM productos p 
LEFT JOIN entradadetalle ed ON p.id=ed.id_producto 

LEFT JOIN ventadetalle vd ON p.id=vd.id_producto 

LEFT JOIN entrada e ON ed.id_entrada=e.id 

LEFT JOIN venta v ON vd.id_venta=v.id) 

UNION

(SELECT ' - ' , v.id,@idprd:=CONCAT_WS('',vd.id_producto),0, vd.cantidad, @fecha1:=CONCAT_WS('',v.fecha) AS 'Fecha'  FROM productos p 
RIGHT JOIN entradadetalle ed ON p.id=ed.id_producto 

RIGHT JOIN ventadetalle vd ON p.id=vd.id_producto 

RIGHT JOIN entrada e ON ed.id_entrada=e.id 

RIGHT JOIN venta v ON vd.id_venta=v.id) ORDER BY Fecha;
