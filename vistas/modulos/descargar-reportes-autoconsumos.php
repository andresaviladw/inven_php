<?php

require_once "../../controladores/autoconsumos.controlador.php";
require_once "../../modelos/autoconsumos.modelo.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";


$reporteAutoconsumos = new ControladorAutoconsumos();
$reporteAutoconsumos -> ctrDescargarReporte();

