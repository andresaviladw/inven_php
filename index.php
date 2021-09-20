<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/proveedores.controlador.php";
require_once "controladores/subcategorias.controlador.php";
require_once "controladores/entradas.controlador.php";
require_once "controladores/emisor.controlador.php";
require_once "controladores/comprobantes.controlador.php";
require_once "controladores/impuestos.controlador.php";
require_once "controladores/preciosventas.controlador.php";
require_once "controladores/autoconsumos.controlador.php";
require_once "controladores/importar-entradas.controlador.php";
require_once "controladores/tamporal.controlador.php";



require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/proveedores.modelo.php";
require_once "modelos/subcategorias.modelo.php";
require_once "modelos/entradas.modelo.php";
require_once "modelos/emisor.modelo.php";
require_once "modelos/comprobantes.modelo.php";
require_once "modelos/impuestos.modelo.php";
require_once "modelos/preciosventas.modelo.php";
require_once "modelos/autoconsumos.modelo.php";
require_once "modelos/importar-entradas.modelo.php";
require_once "modelos/temporal.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();