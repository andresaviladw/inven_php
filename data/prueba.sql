-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-10-2019 a las 20:29:00
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autoconsumos`
--

DROP TABLE IF EXISTS `autoconsumos`;
CREATE TABLE IF NOT EXISTS `autoconsumos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `codigo` float NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `total` float NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_emision` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `autoconsumos`
--

INSERT INTO `autoconsumos` (`id`, `id_usuario`, `codigo`, `descripcion`, `productos`, `total`, `fecha_creacion`, `fecha_emision`, `estado`) VALUES
(1, 1, 1, 'Nuevo Productoiooo', '[{\"id\":\"2\",\"codigo\":\"01VIGV-8\",\"descripcion\":\"VIGA V-8 15X15 12mm.\",\"cantidad\":\"1\",\"motivo\":\"Utiliza alguien por ahi\",\"stock\":\"13\",\"precio\":\"31.7\",\"total\":\"31.7\"},{\"id\":\"3\",\"codigo\":\"14PIFL52\",\"descripcion\":\"PISO FLOTANTE PECAN 7800 CAJA (1.91M2)\",\"cantidad\":\"1\",\"motivo\":\"Lleva para sembrar\",\"stock\":\"207\",\"precio\":\"20.83\",\"total\":\"20.83\"}]', 52.53, '2019-10-21 11:10:58', '2019-10-21 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `estado`, `fecha`) VALUES
(1, 'Producto Agricola', 1, '2019-07-30 19:59:56'),
(2, 'Categoria 2', 1, '2019-09-02 17:39:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8mb4_spanish_ci,
  `tipoDocumento` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `documento` text COLLATE utf8mb4_spanish_ci,
  `email` text COLLATE utf8mb4_spanish_ci,
  `telefono` text COLLATE utf8mb4_spanish_ci,
  `celular` text COLLATE utf8mb4_spanish_ci,
  `direccion` text COLLATE utf8mb4_spanish_ci,
  `ultima_compra` datetime DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `codigo`, `nombre`, `tipoDocumento`, `documento`, `email`, `telefono`, `celular`, `direccion`, `ultima_compra`, `estado`, `fecha`) VALUES
(1, 'a555', 'Nestle Ecuador Sa', 'ruc_privada', '0990032246001', 'ivonneBaido@ec.nestle.com', '23986500', '23986500', 'Guayaquil', '2019-10-20 22:18:47', 1, '2019-07-30 20:23:46'),
(2, 'dsass', 'Andres Avila', 'cedula', '0106548316', 'aandres@gmail.com', '4175277', '0969788144', 'Ricaurte', '2019-10-21 06:45:39', 1, '2019-09-03 17:09:25'),
(3, 'Alv0s', 'Alvisa', 'ruc_natural', '0106548316002', 'admin@admnn.com', '4175269', '097723542', 'Por Ahi', '2019-10-21 06:47:36', 1, '2019-09-25 15:47:47'),
(4, 'Cleinn', 'Cliente 645', 'ruc_natural', '0106548316003', 'admin@admnn.com', '4175269', '0064961213', 'Por Ahi', '2019-10-17 08:42:45', 1, '2019-09-25 17:33:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_por_pagar`
--

DROP TABLE IF EXISTS `compras_por_pagar`;
CREATE TABLE IF NOT EXISTS `compras_por_pagar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_entrada` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_entrada` (`id_entrada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobantes`
--

DROP TABLE IF EXISTS `comprobantes`;
CREATE TABLE IF NOT EXISTS `comprobantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comprobantes`
--

INSERT INTO `comprobantes` (`id`, `codigo`, `nombre`, `estado`) VALUES
(1, '01', 'Factura', 1),
(2, '02', 'Nota De Venta', 1),
(3, '03', 'Liquidacion De Compra', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_autoconsumo`
--

DROP TABLE IF EXISTS `detalle_autoconsumo`;
CREATE TABLE IF NOT EXISTS `detalle_autoconsumo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_autoconsumo` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` float NOT NULL,
  `motivo` text COLLATE utf8_spanish_ci NOT NULL,
  `total` float NOT NULL,
  `fecha_emision` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_autoconsumo` (`id_autoconsumo`,`id_producto`),
  KEY `id_producto` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_entrada`
--

DROP TABLE IF EXISTS `detalle_entrada`;
CREATE TABLE IF NOT EXISTS `detalle_entrada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `id_entrada` int(11) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci,
  `comprobante` text COLLATE utf8_spanish_ci,
  `secuencia` int(11) DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `cantidad` float DEFAULT NULL,
  `fecha_emision` datetime DEFAULT CURRENT_TIMESTAMP,
  `impuesto` float(16,2) DEFAULT NULL,
  `valor_impuesto` float(16,2) DEFAULT NULL,
  `impuesto_total` float(16,2) DEFAULT NULL,
  `total` float(16,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_entrada` (`id_producto`),
  KEY `id_entrada_2` (`id_entrada`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_entrada`
--

INSERT INTO `detalle_entrada` (`id`, `id_producto`, `id_entrada`, `codigo`, `comprobante`, `secuencia`, `descripcion`, `cantidad`, `fecha_emision`, `impuesto`, `valor_impuesto`, `impuesto_total`, `total`) VALUES
(1, 1, 1, '1', '001002000000788', 788, 'Nuevo Productoiooo', 144223, '2019-10-19 00:00:00', 2.36, 12.00, 340250.91, 2835424.25),
(2, 2, 1, '1', '001002000000788', 788, 'Nuevo Productoiooo', 1125, '2019-10-19 00:00:00', 3.80, 12.00, 4279.50, 35662.50),
(3, 3, 1, '1', '001002000000788', 788, 'Nuevo Productoiooo', 1893, '2019-10-19 00:00:00', 2.50, 12.00, 4731.74, 39431.19),
(4, 1, 2, '2', '001002000000056', 56, 'Nuevo Ingreso', 100000, '2019-10-20 00:00:00', 2.36, 12.00, 235920.00, 1966000.00),
(5, 3, 2, '2', '001002000000056', 56, 'Nuevo Ingreso', 180003000, '2019-10-20 00:00:00', 2.50, 12.00, 449934880.00, 3749457408.00),
(6, 1, 3, '3', '001002000000056', 56, 'Sdsa', 500, '2019-10-20 00:00:00', 2.36, 12.00, 1179.60, 9830.00),
(7, 2, 3, '3', '001002000000056', 56, 'Sdsa', 600, '2019-10-20 00:00:00', 3.80, 12.00, 2282.40, 19020.00),
(8, 3, 3, '3', '001002000000056', 56, 'Sdsa', 563, '2019-10-20 00:00:00', 2.50, 12.00, 1407.27, 11727.29),
(9, 3, 4, '4', '000001263', 1263, 'Entrada', 5, '2019-09-13 00:00:00', 2.50, 12.00, 12.50, 104.15),
(10, 1, 4, '4', '000001263', 1263, 'Entrada', 28, '2019-09-13 00:00:00', 2.36, 12.00, 66.06, 550.48),
(11, 2, 4, '4', '000001263', 1263, 'Entrada', 28, '2019-09-13 00:00:00', 3.80, 12.00, 106.51, 887.60),
(12, 1, 5, '5', '001002000000056', 56, 'VIGA V-6 15x15 9mm', 100000, '2019-10-20 00:00:00', 2.36, 12.00, 235920.00, 1966000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

DROP TABLE IF EXISTS `detalle_venta`;
CREATE TABLE IF NOT EXISTS `detalle_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` float NOT NULL,
  `precio_venta` float(16,2) NOT NULL,
  `impuesto` float(16,2) NOT NULL,
  `valor_impuesto` float(16,2) NOT NULL,
  `impuesto_total` float(16,2) NOT NULL,
  `precioIva` float(16,2) NOT NULL,
  `precioSinIva` float(16,2) NOT NULL,
  `utilidad` float(16,2) NOT NULL,
  `utilidadTotal` float(16,2) NOT NULL,
  `fecha_emision` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_venta` (`id_venta`,`id_producto`),
  KEY `id_producto` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id`, `id_venta`, `id_producto`, `codigo`, `descripcion`, `cantidad`, `precio_venta`, `impuesto`, `valor_impuesto`, `impuesto_total`, `precioIva`, `precioSinIva`, `utilidad`, `utilidadTotal`, `fecha_emision`) VALUES
(1, 1, 1, '000000005', 'Venta 5', 1556, 20.83, 2.50, 12.00, 3889.38, 36300.86, 32411.48, 1.17, 1820.52, '2019-10-20 12:00:00'),
(2, 1, 2, '000000005', 'Venta 5', 14, 32.00, 3.84, 12.00, 53.76, 501.76, 448.00, 0.30, 4.20, '2019-10-20 12:00:00'),
(3, 1, 3, '000000005', 'Venta 5', 1, 21.23, 2.55, 12.00, 2.55, 23.78, 21.23, 0.40, 0.40, '2019-10-20 12:00:00'),
(4, 2, 1, '000000006', 'Venta 6', 1, 20.83, 2.50, 12.00, 2.50, 23.33, 20.83, 1.17, 1.17, '2019-10-20 12:00:00'),
(5, 2, 3, '000000006', 'Venta 6', 1, 21.23, 2.55, 12.00, 2.55, 23.78, 21.23, 0.40, 0.40, '2019-10-20 12:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emisor`
--

DROP TABLE IF EXISTS `emisor`;
CREATE TABLE IF NOT EXISTS `emisor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipoDocumento` text COLLATE utf8_spanish_ci NOT NULL,
  `documento_id` text COLLATE utf8_spanish_ci NOT NULL,
  `razon_social` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre_comercial` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `celular` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `codigo_establecimiento` text COLLATE utf8_spanish_ci NOT NULL,
  `punto_emision` text COLLATE utf8_spanish_ci NOT NULL,
  `secuencia_factura` int(11) DEFAULT NULL,
  `numero_autorizacion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `emisor`
--

INSERT INTO `emisor` (`id`, `tipoDocumento`, `documento_id`, `razon_social`, `nombre_comercial`, `direccion`, `telefono`, `celular`, `email`, `codigo_establecimiento`, `punto_emision`, `secuencia_factura`, `numero_autorizacion`) VALUES
(1, 'ruc_natural', '0106548316002', 'Agricola Aviher CIA LTDA', 'Aviher', 'Batan Y Charles Darwin', '4175690', '0987656000', 'avihercuenca12@hotmail.com', '001', '500', 5, '454545648');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

DROP TABLE IF EXISTS `entradas`;
CREATE TABLE IF NOT EXISTS `entradas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_proveedor` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_responsable` int(11) NOT NULL,
  `id_comprobante` int(11) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci,
  `comprobante` text COLLATE utf8_spanish_ci,
  `secuencia` text COLLATE utf8_spanish_ci,
  `descripcion` text COLLATE utf8_spanish_ci,
  `productos` text COLLATE utf8_spanish_ci,
  `impuesto` float(16,2) DEFAULT NULL,
  `neto` float DEFAULT NULL,
  `total_pagar` float DEFAULT NULL,
  `fecha_entrada` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_emision` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_vencimiento` datetime DEFAULT CURRENT_TIMESTAMP,
  `forma_cobro` text COLLATE utf8_spanish_ci,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_responsable` (`id_proveedor`,`id_responsable`,`id_comprobante`),
  KEY `id_responsable_2` (`id_responsable`),
  KEY `id_comprobante` (`id_comprobante`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id`, `id_proveedor`, `id_responsable`, `id_comprobante`, `codigo`, `comprobante`, `secuencia`, `descripcion`, `productos`, `impuesto`, `neto`, `total_pagar`, `fecha_entrada`, `fecha_emision`, `fecha_vencimiento`, `forma_cobro`, `estado`) VALUES
(1, 'SBAM004', 1, 1, '1', '001002000000788', '788', 'Nuevo Productoiooo', '[{\"id\":\"1\",\"codigo\":\"01VIGV-6\",\"descripcion\":\"VIGA V-6 15x15 9mm\",\"cantidad\":\"144223\",\"stock\":\"229221\",\"precio\":\"19.66\",\"impuesto\":\"2.3592\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"340250.9\",\"total\":\"2835424.18\"},{\"id\":\"2\",\"codigo\":\"01VIGV-8\",\"descripcion\":\"VIGA V-8 15X15 12mm.\",\"cantidad\":\"1125\",\"stock\":\"77649\",\"precio\":\"31.7\",\"impuesto\":\"3.804\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"4279.5\",\"total\":\"35662.5\"},{\"id\":\"3\",\"codigo\":\"14PIFL52\",\"descripcion\":\"PISO FLOTANTE PECAN 7800 CAJA (1.91M2)\",\"cantidad\":\"1893\",\"stock\":\"77210\",\"precio\":\"20.83\",\"impuesto\":\"2.4996\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"4731.74\",\"total\":\"39431.19\"}]', 349262.12, 2910520, 3259780, '2019-10-19 22:37:56', '2019-10-19 00:00:00', '2019-10-19 00:00:00', NULL, 1),
(2, 'prov556a', 1, 2, '2', '001002000000056', '56', 'Nuevo Ingreso', '[{\"id\":\"1\",\"codigo\":\"01VIGV-6\",\"descripcion\":\"VIGA V-6 15x15 9mm\",\"cantidad\":\"100000\",\"precio\":\"19.66\",\"impuesto\":\"2.3592\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"235920\",\"total\":\"1966000\"},{\"id\":\"3\",\"codigo\":\"14PIFL52\",\"descripcion\":\"PISO FLOTANTE PECAN 7800 CAJA (1.91M2)\",\"cantidad\":\"180002756\",\"stock\":\"180452286\",\"precio\":\"20.83\",\"impuesto\":\"2.4996\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"449934888.9\",\"total\":\"3749457407.48\"}]', 450170816.00, 3751420000, 4201590000, '2019-10-19 22:39:03', '2019-10-20 00:00:00', '2019-10-20 00:00:00', NULL, 1),
(3, 'prov556a', 1, 1, '3', '001002000000056', '56', 'Sdsa', '[{\"id\":\"1\",\"codigo\":\"01VIGV-6\",\"descripcion\":\"VIGA V-6 15x15 9mm\",\"cantidad\":\"500\",\"stock\":\"500\",\"precio\":\"19.66\",\"impuesto\":\"2.3592\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"1179.6\",\"total\":\"9830\"},{\"id\":\"2\",\"codigo\":\"01VIGV-8\",\"descripcion\":\"VIGA V-8 15X15 12mm.\",\"cantidad\":\"600\",\"stock\":\"600\",\"precio\":\"31.7\",\"impuesto\":\"3.804\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"2282.4\",\"total\":\"19020\"},{\"id\":\"3\",\"codigo\":\"14PIFL52\",\"descripcion\":\"PISO FLOTANTE PECAN 7800 CAJA (1.91M2)\",\"cantidad\":\"563\",\"stock\":\"563\",\"precio\":\"20.83\",\"impuesto\":\"2.4996\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"1407.27\",\"total\":\"11727.29\"}]', 4869.27, 40577.3, 45446.6, '2019-10-20 16:11:56', '2019-10-20 00:00:00', '2019-10-20 00:00:00', NULL, 1),
(4, 'SBAM004', 1, 1, '4', '000001263', '1263', 'Entrada', '[{\"id\":\"3\",\"codigo\":\"14PIFL52\",\"descripcion\":\"PISO FLOTANTE PECAN 7800 CAJA (1.91M2)\",\"cantidad\":\"5\",\"precio\":\"20.83\",\"impuesto\":\"2.4996\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"12.498\",\"total\":\"104.15\"},{\"id\":\"1\",\"codigo\":\"01VIGV-6\",\"descripcion\":\"VIGA V-6 15x15 9mm.\",\"cantidad\":\"28\",\"precio\":\"19.66\",\"impuesto\":\"2.3592\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"66.0576\",\"total\":\"550.48\"},{\"id\":\"2\",\"codigo\":\"01VIGV-8\",\"descripcion\":\"VIGA V-8 15X15 12mm.\",\"cantidad\":\"28\",\"precio\":\"31.7\",\"impuesto\":\"3.804\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"106.512\",\"total\":\"887.6\"}]', 185.07, 1542.23, 1727.3, '2019-10-20 16:12:20', '2019-09-13 00:00:00', '2019-09-13 00:00:00', NULL, 1),
(5, 'prov556a', 1, 2, '5', '001002000000056', '56', 'VIGA V-6 15x15 9mm', '[{\"id\":\"1\",\"codigo\":\"01VIGV-6\",\"descripcion\":\"VIGA V-6 15x15 9mm\",\"cantidad\":\"100000\",\"stock\":\"100428\",\"precio\":\"19.66\",\"impuesto\":\"2.3592\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"235920\",\"total\":\"1966000\"}]', 235920.00, 1966000, 2201920, '2019-10-20 20:46:29', '2019-10-20 00:00:00', '2019-10-20 00:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuestos`
--

DROP TABLE IF EXISTS `impuestos`;
CREATE TABLE IF NOT EXISTS `impuestos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `valor` float NOT NULL,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `impuestos`
--

INSERT INTO `impuestos` (`id`, `codigo`, `nombre`, `valor`, `estado`) VALUES
(1, 'iva', 'Impuesto Al Valor Agregado', 12, 1),
(2, 'NoIm', 'Impuesto 0', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preciosventas`
--

DROP TABLE IF EXISTS `preciosventas`;
CREATE TABLE IF NOT EXISTS `preciosventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `precio_venta` float NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_producto` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `preciosventas`
--

INSERT INTO `preciosventas` (`id`, `id_producto`, `precio_venta`, `estado`) VALUES
(1, 3, 21.23, 1),
(2, 2, 32, 1),
(3, 1, 20.83, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) DEFAULT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `id_impuesto` int(11) NOT NULL,
  `codigo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `imagen` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `stock` decimal(16,2) DEFAULT '0.00',
  `precio_compra` float DEFAULT NULL,
  `ventas` float DEFAULT '0',
  `entradas` float DEFAULT '0',
  `autoconsumos` float NOT NULL DEFAULT '0',
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_id_categoria` (`id_categoria`),
  KEY `id_subcategoria` (`id_subcategoria`),
  KEY `id_impuesto` (`id_impuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `id_subcategoria`, `id_impuesto`, `codigo`, `descripcion`, `imagen`, `stock`, `precio_compra`, `ventas`, `entradas`, `autoconsumos`, `fecha`, `estado`) VALUES
(1, 1, 1, 1, '01VIGV-6', 'VIGA V-6 15x15 9mm', 'vistas/img/productos/default/anonymous.png', '98718.00', 19.66, 1805, 100528, 5, '2019-10-20 15:47:32', 1),
(2, 1, 1, 1, '01VIGV-8', 'VIGA V-8 15X15 12mm.', 'vistas/img/productos/default/anonymous.png', '13.00', 31.7, 614, 628, 1, '2019-10-20 15:49:04', 0),
(3, 1, 1, 1, '14PIFL52', 'PISO FLOTANTE PECAN 7800 CAJA (1.91M2)', 'vistas/img/productos/default/anonymous.png', '205.00', 20.83, 7, 568, -40, '2019-10-20 15:49:34', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `codigo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `documentoId` text COLLATE utf8_spanish_ci NOT NULL,
  `tipoDocumento` text COLLATE utf8_spanish_ci NOT NULL,
  `proveedor` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `celular` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre_referencia` text COLLATE utf8_spanish_ci NOT NULL,
  `movil_referencia` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`codigo`, `documentoId`, `tipoDocumento`, `proveedor`, `direccion`, `telefono`, `celular`, `email`, `nombre_referencia`, `movil_referencia`, `fecha`, `estado`) VALUES
('prov556a', '0106548316001', 'ruc_natural', 'Proveedor 668', 'Por Ahi', '4175269', '0064961213', 'admin@admnn.com', 'Proveedor 668', '0969788144', '2019-10-04 21:28:17', 1),
('SBAM004', '0106548316002', 'ruc_natural', 'Proveedor 668as', 'Por Ahi', '4175269', '0064961213', 'admin@admnn.com', 'Proveedor 668', '0969788144', '2019-10-09 21:58:28', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

DROP TABLE IF EXISTS `subcategorias`;
CREATE TABLE IF NOT EXISTS `subcategorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) DEFAULT NULL,
  `subcategoria` text COLLATE utf8mb4_spanish_ci,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `id_categoria`, `subcategoria`, `estado`) VALUES
(1, 1, 'Cacao Comercio', 1),
(2, 1, 'Cacao Producción', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `ultimo_login` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(1, 'Admin', 'admin', '$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy', 'Administrador', 'vistas/img/usuarios/admin/998.jpg', 1, '2019-10-21 16:32:10', '2019-10-21 21:32:10'),
(2, 'Especial', 'especial', '$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy', 'Especial', '', 1, '2019-09-05 12:56:22', '2019-09-05 21:08:05'),
(3, 'Vendedor', 'vendedor', '4da47cd8c9da987779c51f2278c93ab1', 'Vendedor', '', 1, '2019-07-30 14:59:20', '2019-09-10 18:01:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `id_vendedor` int(11) DEFAULT NULL,
  `codigo` text COLLATE utf8_spanish_ci,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `detalle` text COLLATE utf8_spanish_ci NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `neto` float(16,2) DEFAULT NULL,
  `impuesto` float(16,2) DEFAULT NULL,
  `descuento` float(16,2) DEFAULT NULL,
  `total` float(16,2) DEFAULT NULL,
  `utilidad` float(16,2) NOT NULL DEFAULT '0.00',
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fecha_emision` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_vencimiento` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `forma_pago` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_venta_cliente` (`id_cliente`),
  KEY `fk_venta_vendedor` (`id_vendedor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `id_cliente`, `id_vendedor`, `codigo`, `descripcion`, `detalle`, `productos`, `neto`, `impuesto`, `descuento`, `total`, `utilidad`, `fecha_creacion`, `fecha_emision`, `fecha_vencimiento`, `forma_pago`, `estado`) VALUES
(1, 2, 1, '000000005', 'Venta 5', '001 500', '[{\"id\":\"1\",\"idVenta\":\"1\",\"descripcion\":\"VIGA V-6 15x15 9mm\",\"codigo\":\"01VIGV-6\",\"cantidad\":\"1\",\"stock\":\"98869\",\"precio_compra\":\"19.66\",\"precio\":\"20.83\",\"precioSinIva\":\"20.83\",\"precioIva\":\"23.33\",\"impuesto\":\"2.4995999999999996\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"2.5\",\"utilidad\":1.17,\"utilidadTotal\":1.17},{\"id\":\"3\",\"idVenta\":\"1\",\"descripcion\":\"PISO FLOTANTE PECAN 7800 CAJA (1.91M2)\",\"codigo\":\"14PIFL52\",\"cantidad\":\"1\",\"stock\":\"217\",\"precio_compra\":\"20.83\",\"precio\":\"21.23\",\"precioSinIva\":\"21.23\",\"precioIva\":\"23.7776\",\"impuesto\":\"2.5476\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"2.5476\",\"utilidad\":0.40000000000000213,\"utilidadTotal\":0.40000000000000213}]', 42.06, 5.05, 0.00, 47.11, 1.57, '2019-10-21 10:53:15', '2019-10-21 17:00:00', '2019-10-21 17:00:00', NULL, 1),
(2, 2, 1, '000000006', 'Venta 6', '001 500', '[{\"id\":\"1\",\"idVenta\":\"1\",\"descripcion\":\"VIGA V-6 15x15 9mm\",\"codigo\":\"01VIGV-6\",\"cantidad\":\"144\",\"stock\":\"98725\",\"precio_compra\":\"19.66\",\"precio\":\"20.83\",\"precioSinIva\":\"2999.52\",\"precioIva\":\"3359.46\",\"impuesto\":\"2.4995999999999996\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"359.94\",\"utilidad\":1.17,\"utilidadTotal\":168.48},{\"id\":\"3\",\"idVenta\":\"1\",\"descripcion\":\"PISO FLOTANTE PECAN 7800 CAJA (1.91M2)\",\"codigo\":\"14PIFL52\",\"cantidad\":\"1\",\"stock\":\"216\",\"precio_compra\":\"20.83\",\"precio\":\"21.23\",\"precioSinIva\":\"21.23\",\"precioIva\":\"23.7776\",\"impuesto\":\"2.5476\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"2.5476\",\"utilidad\":0.40000000000000213,\"utilidadTotal\":0.40000000000000213}]', 3020.75, 362.49, 0.00, 3383.24, 168.88, '2019-10-21 10:53:39', '2019-10-21 17:00:00', '2019-10-21 17:00:00', NULL, 1),
(3, 2, 1, '000000007', 'Venta 7', '001 500', '[{\"id\":\"1\",\"idVenta\":\"1\",\"descripcion\":\"VIGA V-6 15x15 9mm\",\"codigo\":\"01VIGV-6\",\"cantidad\":\"1\",\"stock\":\"98719\",\"precio_compra\":\"19.66\",\"precio\":\"20.83\",\"precioSinIva\":\"20.83\",\"precioIva\":\"23.33\",\"impuesto\":\"2.4995999999999996\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"2.5\",\"utilidad\":1.17,\"utilidadTotal\":1.17},{\"id\":\"3\",\"idVenta\":\"1\",\"descripcion\":\"PISO FLOTANTE PECAN 7800 CAJA (1.91M2)\",\"codigo\":\"14PIFL52\",\"cantidad\":\"1\",\"stock\":\"206\",\"precio_compra\":\"20.83\",\"precio\":\"21.23\",\"precioSinIva\":\"21.23\",\"precioIva\":\"23.7776\",\"impuesto\":\"2.5476\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"2.5476\",\"utilidad\":0.40000000000000213,\"utilidadTotal\":0.40000000000000213}]', 42.06, 5.05, 0.00, 47.11, 1.57, '2019-10-21 11:45:38', '2019-10-21 17:00:00', '2019-10-21 17:00:00', NULL, 1),
(4, 3, 1, '000000008', 'Venta 8', '001 500', '[{\"id\":\"1\",\"idVenta\":\"1\",\"descripcion\":\"VIGA V-6 15x15 9mm\",\"codigo\":\"01VIGV-6\",\"cantidad\":\"1\",\"stock\":\"98718\",\"precio_compra\":\"19.66\",\"precio\":\"20.83\",\"precioSinIva\":\"20.83\",\"precioIva\":\"23.33\",\"impuesto\":\"2.4995999999999996\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"2.5\",\"utilidad\":1.17,\"utilidadTotal\":1.17},{\"id\":\"3\",\"idVenta\":\"1\",\"descripcion\":\"PISO FLOTANTE PECAN 7800 CAJA (1.91M2)\",\"codigo\":\"14PIFL52\",\"cantidad\":\"1\",\"stock\":\"205\",\"precio_compra\":\"20.83\",\"precio\":\"21.23\",\"precioSinIva\":\"21.23\",\"precioIva\":\"23.7776\",\"impuesto\":\"2.5476\",\"valorImpuesto\":\"12\",\"impuestoTotal\":\"2.5476\",\"utilidad\":0.40000000000000213,\"utilidadTotal\":0.40000000000000213}]', 42.06, 5.05, 0.00, 47.11, 1.57, '2019-10-21 11:56:10', '2019-10-21 17:00:00', '2019-10-21 17:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_por_cobrar`
--

DROP TABLE IF EXISTS `ventas_por_cobrar`;
CREATE TABLE IF NOT EXISTS `ventas_por_cobrar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_venta` (`id_venta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autoconsumos`
--
ALTER TABLE `autoconsumos`
  ADD CONSTRAINT `autoconsumos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `detalle_autoconsumo`
--
ALTER TABLE `detalle_autoconsumo`
  ADD CONSTRAINT `detalle_autoconsumo_ibfk_1` FOREIGN KEY (`id_autoconsumo`) REFERENCES `autoconsumos` (`id`),
  ADD CONSTRAINT `detalle_autoconsumo_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `detalle_entrada`
--
ALTER TABLE `detalle_entrada`
  ADD CONSTRAINT `detalle_entrada_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `detalle_entrada_ibfk_3` FOREIGN KEY (`id_entrada`) REFERENCES `entradas` (`id`);

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`);

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`id_responsable`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `entradas_ibfk_2` FOREIGN KEY (`id_comprobante`) REFERENCES `comprobantes` (`id`),
  ADD CONSTRAINT `entradas_ibfk_3` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`codigo`);

--
-- Filtros para la tabla `preciosventas`
--
ALTER TABLE `preciosventas`
  ADD CONSTRAINT `preciosventas_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategorias` (`id`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_impuesto`) REFERENCES `impuestos` (`id`);

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `subcategorias_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_venta_vendedor` FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
