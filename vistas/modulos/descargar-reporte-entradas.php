<?php

require_once "../../controladores/comprobantes.controlador.php";
require_once "../../modelos/comprobantes.modelo.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
require_once "../../controladores/entradas.controlador.php";
require_once "../../modelos/entradas.modelo.php";
require_once "../../controladores/proveedores.controlador.php";
require_once "../../modelos/proveedores.modelo.php";


$reporteEntradas = new ControladorEntradas();
$reporteEntradas -> ctrDescargarReporteEntradas();