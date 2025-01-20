-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2024 a las 23:01:39
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `zfip`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acpm`
--

CREATE TABLE `acpm` (
  `id_consecutivo` int(11) NOT NULL,
  `origen_acpm` text DEFAULT NULL,
  `fuente_acpm` enum('AI','AE','Otros') DEFAULT NULL,
  `descripcion_fuente` text DEFAULT NULL,
  `tipo_acpm` enum('AC','AP','AM') DEFAULT NULL,
  `fecha_acpm` timestamp NULL DEFAULT current_timestamp(),
  `descripcion_acpm` text DEFAULT NULL,
  `causa_acpm` text DEFAULT NULL,
  `nc_similar` enum('Si','No') DEFAULT NULL,
  `descripcion_nsc` text DEFAULT NULL,
  `correccion_acpm` text DEFAULT NULL,
  `fecha_correccion` date DEFAULT NULL,
  `estado_acpm` enum('Abierta','Proceso','Cerrada','Rechazada','Verificacion') DEFAULT NULL,
  `riesgo_acpm` enum('Si','No') DEFAULT NULL,
  `justificacion_riesgo` text DEFAULT NULL,
  `cambios_sig` enum('Si','No') DEFAULT NULL,
  `justificacion_sig` text DEFAULT NULL,
  `conforme_sig` enum('Si','No') DEFAULT NULL,
  `justificacion_conforme_sig` text DEFAULT NULL,
  `fecha_estado` date DEFAULT NULL,
  `fecha_finalizacion` date DEFAULT NULL,
  `id_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acpm_rechazada`
--

CREATE TABLE `acpm_rechazada` (
  `id_rechazada` int(11) NOT NULL,
  `fecha_rechazo` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `descripcion_rechazo` text NOT NULL,
  `tipo_movimiento` enum('Correcion','Accion') NOT NULL,
  `id_acpm_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades_acpm`
--

CREATE TABLE `actividades_acpm` (
  `id_actividad` int(11) NOT NULL,
  `fecha_actividad` date NOT NULL,
  `descripcion_actividad` text NOT NULL,
  `tipo_actividad` enum('Correccion','Actividad') NOT NULL,
  `estado_actividad` enum('Completa','Incompleta') NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `id_acpm_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activos`
--

CREATE TABLE `activos` (
  `id_activo` int(11) NOT NULL,
  `cod_renta` varchar(100) NOT NULL,
  `fecha_asignacion` datetime NOT NULL,
  `nombre_articulo` varchar(300) NOT NULL,
  `descripcion_articulo` text NOT NULL,
  `modelo_articulo` varchar(200) DEFAULT NULL,
  `referencia_articulo` varchar(200) DEFAULT NULL,
  `marca_articulo` varchar(300) DEFAULT NULL,
  `tipo_articulo` text DEFAULT NULL,
  `ip` varchar(30) NOT NULL,
  `windows` text NOT NULL,
  `office` varchar(300) NOT NULL,
  `factura_office` text NOT NULL,
  `lugar_articulo` text DEFAULT NULL,
  `observaciones_articulo` text DEFAULT NULL,
  `numero_factura` float DEFAULT NULL,
  `fecha_garantia` date DEFAULT NULL,
  `valor_articulo` float DEFAULT NULL,
  `condicion_articulo` text DEFAULT NULL,
  `id_proveedor_fk` int(11) DEFAULT NULL,
  `descripcion_proveedor` text DEFAULT NULL,
  `id_usuario_fk` int(11) DEFAULT NULL,
  `estado_activo` enum('Activo','Inactivo','Rentado','') NOT NULL,
  `recurso_tecnologico` enum('Si','No','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `activos`
--

INSERT INTO `activos` (`id_activo`, `cod_renta`, `fecha_asignacion`, `nombre_articulo`, `descripcion_articulo`, `modelo_articulo`, `referencia_articulo`, `marca_articulo`, `tipo_articulo`, `ip`, `windows`, `office`, `factura_office`, `lugar_articulo`, `observaciones_articulo`, `numero_factura`, `fecha_garantia`, `valor_articulo`, `condicion_articulo`, `id_proveedor_fk`, `descripcion_proveedor`, `id_usuario_fk`, `estado_activo`, `recurso_tecnologico`) VALUES
(1001, '', '2023-12-01 00:00:00', 'REPISAS DECORATIVAS', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1002, '', '2023-12-01 00:00:00', 'REPISAS DECORATIVAS', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1003, '', '2023-12-01 00:00:00', 'ESCRITORIO EN L', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1004, '', '2023-12-01 00:00:00', 'COMPUTADOR PORTATIL MAC', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'Si'),
(1005, '', '2023-12-01 00:00:00', 'BASE DE PORTATIL', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'ARTEMA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1006, '', '2023-12-01 00:00:00', 'PANTALLA LG PARA COMPUTADOR, CON MOUSE Y TECLADO INHALAMBRICO', 'COLOR NEGRO', 'NO APLICA', '20MK400H', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1007, '', '2023-12-01 00:00:00', 'BASE DE MADERA', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1008, '', '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'ARTEMA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1009, '', '2023-12-01 00:00:00', 'SILLA AUXILIAR EN CUERO VISITANTE', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1010, '', '2023-12-01 00:00:00', 'SILLA AUXILIAR EN CUERO VISITANTE', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2013-11-13', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1011, '', '2023-12-01 00:00:00', 'SILLA GERENCIAL ERGONOMICA NEGRA', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2013-11-13', 342360, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1012, '', '2023-12-01 00:00:00', 'SILLA AUX TERCIOPELO ', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1013, '', '2023-12-01 00:00:00', 'SILLA AUX TERCIOPELO ', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1014, '', '2023-12-01 00:00:00', 'SILLA AUX TERCIOPELO ', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1015, '', '2023-12-01 00:00:00', 'SILLA AUX TERCIOPELO ', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1016, '', '2023-12-01 00:00:00', 'MESA MADERA OVALA', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1017, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1 METRO)', 'NO APLICA', 'NO APLICA', 'PENTAGRAMA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1018, '', '2023-12-01 00:00:00', 'TABLERO', 'TABLERO', 'NO APLICA', 'NO APLICA', 'SUNTECA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1019, '', '2023-12-01 00:00:00', 'UN CAJON DE MADERA', 'COLOR BLANCO DOS PUERTAS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1020, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'MEDIDA 1 METRO Y MEDIO', 'NO APLICA', 'NO APLICA', 'PENTAGRAMA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 75918.5, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1021, '', '2023-12-01 00:00:00', 'ESCRITORIO 3 CAJONES', 'MODULO COLOR BEIGE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 22, 'Activo', 'No'),
(1022, '', '2023-12-01 00:00:00', 'PAPALERA HORIZONTAL EN  MADERA SENCILLA (UN MODULO) ARRENDADO', 'PAPELERA HORIZONTAL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'AUX. CONTABLE', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 22, 'Activo', 'No'),
(1023, '', '2023-12-01 00:00:00', 'PAPALERA HORIZONTAL EN  MADERA SENCILLA (UN MODULO) ARRENDADO', 'PAPELERA HORIZONTAL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'AUX. CONTABLE', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 22, 'Activo', 'No'),
(1024, '', '2023-12-01 00:00:00', 'TELEFONO FIJO', 'COLOR NEGRO, INHALAMBRICO', 'NO APLICA', '1DASDQ74721', 'PANASONIC', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 22, 'Activo', 'No'),
(1025, '', '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 22, 'Activo', 'No'),
(1026, '', '2023-12-01 00:00:00', 'ARCHIVADOR HORIZONTAL', 'COLOR BEIGE DE DOS CAJONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2019-04-04', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 22, 'Activo', 'No'),
(1027, '', '2023-12-01 00:00:00', 'ARCHIVADOR VERTICAL', 'COLOR BEIGE DE CUATRO CAJONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 1886610, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 22, 'Activo', 'No'),
(1028, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'COLOR AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 22, 'Activo', 'No'),
(1029, '', '2023-12-01 00:00:00', 'ESCRITORIO EN L SOLINOF', 'ESCRITORIO EN L - SOLINOF MADERA Y METAL GRIS, BEIGE Y CAFÉ 2 CAJONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'EDIFICIO PISO 1', 'Ninguna', 0, '0000-00-00', 9912050, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1030, '', '2023-12-01 00:00:00', 'ESCRITORIO EN L 6 CAJONES MADERA, 2 PUESTOS PATAS GRISES METALICAS VENTANILLA', 'BEIGE MODULAR A LA MEDIDA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'EDIFICIO PISO 1', 'Ninguna', 0, '2013-04-25', 9912050, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1031, '', '2023-12-01 00:00:00', 'ARCHIVADOR METALICO 70 CMTS Y DE MADERA 3 DIVISIONES', 'CON LLAVE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2022-11-30', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1032, '', '2023-12-01 00:00:00', 'ARCHIVADOR METALICO 50 CMTS Y DE MADERA 4 DIVISIONES', 'CON LLAVE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2022-11-30', 1080000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1033, '', '2023-12-01 00:00:00', 'ARCHIVADOR EN FORMA DE PALOMERA', 'CON LLAVE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2022-11-30', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1034, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'TERCIOPELO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1035, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO NEGRA ', 'PATAS EN ACERO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 374793, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1036, '', '2023-12-01 00:00:00', 'COMPUTADOR PORTATIL CON TECLADO Y MOUSE LENOVO', 'SIN VALIDAR', 'MPNXB25110AJ', 'MP27PQ4W', 'LENOVO', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 1790000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'Si'),
(1037, '', '2023-12-01 00:00:00', 'BASE PARA PORTATIL ARTECMA GRADUABLE', 'BUEN ESTADO ROJA', 'NO APLICA', 'NO APLICA', 'ARTECMA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1038, '', '2023-12-01 00:00:00', 'PAPELERA HORIZONTAL DEL MADERA 2 MODULOS ', 'MADERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1039, '', '2023-12-01 00:00:00', 'DIVISIÓN METALICA, VIDRIO Y MADERA 40 MODULOS CON PUERTA', '40 MODULOS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 9912050, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1040, '', '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'ARTECMA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1041, '', '2023-12-01 00:00:00', 'TABLERO EN ACRILICO', 'BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1042, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'TERCIOPELO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 289801, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1043, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'UNO X UNO', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2022-11-02', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1044, '', '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'ARTEMAC', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1045, '', '2023-12-01 00:00:00', 'IMPRESORA TERMICA EPSON ', 'VENTANILLA ENTRADA', 'M-188D', 'B3QF358497', 'EPSON', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1046, '', '2023-12-01 00:00:00', 'MICROFONO TAKSTEAR', 'VENTANILLA ENTRADA', 'NO APLICA', 'DA-237', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2013-04-30', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1047, '', '2023-12-01 00:00:00', 'IMPRESORA HP LASER JET PROMFP M428fdw', 'BLANCA IMPRESORA, COPIADORA Y ESCANER', '110-127W-AC', 'MXBPMCC17T', 'HP', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2013-08-12', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1048, '', '2023-12-01 00:00:00', 'IMPRESORA HP LASER JET P1606DN', 'HP', 'NO APLICA', 'BND3G35495', 'HP', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2013-08-12', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1049, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'VENTANILLA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1050, '', '2023-12-01 00:00:00', 'SILLA AUXILIAR EN CUERO AZUL ', 'CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1051, '', '2023-12-01 00:00:00', 'SILLA AUXILIAR EN CUERO AZUL ', 'CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1052, '', '2023-12-01 00:00:00', 'SILLA AUXILIAR EN CUERO AZUL ', 'CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1053, '', '2023-12-01 00:00:00', 'SILLA AUXILIAR EN CUERO AZUL ', 'CUERO AZUL, PASTA NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1054, '', '2023-12-01 00:00:00', 'MESA REDONDA', 'COLOR BEIGE CON PATAS GRISES METALICAS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1055, '', '2023-12-01 00:00:00', 'NEVERA MINI BAR', 'COLOR GRIS DE 90 LITROS', 'K-MB93G', 'NO APLICA', 'KALLEY', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 759899, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1056, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA 1', 'BLACK OUT-PERSIANAS ENROLLABLE (2 METRO)', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2013-04-17', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1057, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA 2', 'BLACK OUT-PERSIANAS ENROLLABLE (2 METRO)', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1058, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1059, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA 1', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'SUNTECA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1060, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA 2', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'SUNTECA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1061, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'SUNTECA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1062, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'SUNTECA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1063, '', '2023-12-01 00:00:00', 'LOCKER', 'VERTICAL DE 5 PUESTOS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1064, '', '2023-12-01 00:00:00', 'HORNO MICROHONDAS KALLEY', 'ACERO / COLOR GRIS', 'NO APLICA', 'NO APLICA', 'KALLEY', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2015-11-30', 399900, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1065, '', '2023-12-01 00:00:00', 'DIVISIÓN METALICA, VIDRIO Y MADERA', 'DIVISIÓN EN MODULO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '0000-00-00', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1066, '', '2023-12-01 00:00:00', 'ESCRITORIO EN L SOLINOF', 'ESCRITORIO EN L - SOLINOF MADERA Y METAL GRIS, BEIGE Y CAFÉ 2 CAJONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '2012-12-31', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1067, '', '2023-12-01 00:00:00', 'AIRE ACONDICIONADO', 'AIRE ACONDICIONADO CON CONTROL', 'DWALT INVERTE', '9C1GOOHM-903TAJDER028', 'LG', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1068, '', '2023-12-01 00:00:00', 'AIRE ACONDICIONADO', 'AIRE ACONDICIONADO CON CONTROL', 'INVERTE V', 'VM242CE NC2', 'LG', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS II', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1069, '', '2023-12-01 00:00:00', 'AIRE ACONDICIONADO', 'CON CONTROL', 'VIRUS DOCTOR', 'AS2TUBCXAP', 'SAMSUNG', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA 103', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1070, '', '2023-12-01 00:00:00', 'AIRE ACONDICIONADO', 'CON CONTROL', 'INVERTE V', '21KAPB0052', 'LG', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS II', 'Ninguna', 0, '0000-00-00', 3167740, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1071, '', '2023-12-01 00:00:00', 'AIRE ACONDICIONADO', 'CON CONTROL', 'NO SE IDENTIFICA', 'NO APLICA', 'ELECTROLUX', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS III', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1072, '', '2023-12-01 00:00:00', 'COMPUTADOR PORTATIL', 'COLOR NEGRO Y GRIS', 'X55Q', 'ZFIP0022020', 'ASUS', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '0000-00-00', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'Si'),
(1073, '', '2023-12-01 00:00:00', 'TABLERO', 'TABLERO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '2013-04-26', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1074, '', '2023-12-01 00:00:00', 'COMPUTADOR DE MESA', 'COLOR NEGRO', 'NO APLICA', 'CN413704F5', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '0000-00-00', 1755000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'Si'),
(1075, '', '2023-12-01 00:00:00', 'BASE DE MADERA', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '2012-12-31', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1076, '', '2023-12-01 00:00:00', 'CELULAR', 'COLOR GRIS', '220333QL', 'NO APLICA', 'XIAOMI', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1077, '', '2023-12-01 00:00:00', 'FLUNIOMETRO', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1078, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'SILLA ERGONOMICA CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '0000-00-00', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1079, '', '2023-12-01 00:00:00', 'BASE DE COMPUTADOR', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'ARTERMA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1080, '', '2023-12-01 00:00:00', 'TELEFONO FIJO PASASONIC', 'NEGRO', 'KX-TS500LX', 'NO APLICA', 'PANASONIC', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1081, '', '2023-12-01 00:00:00', 'SILLA AUXILIAR PASTA Y CUERO VISITANTE', 'NEGRA Y CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1082, '', '2023-12-01 00:00:00', 'PALOMERA ', 'MATERIAL MADERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 TECNICO', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1083, '', '2023-12-01 00:00:00', 'AIRE ACONDICIONADO CENTRAL', 'MATERIAL ACERO', 'AHR60D3XH21A', 'W1H1280607', 'YORK', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 10484400, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1084, '', '2023-12-01 00:00:00', 'MODULOS DE LOCKER X6', 'DE MADERA Y ACERO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1085, '', '2023-12-01 00:00:00', 'MODULOS DE LOCKER X6', 'DE MADERA Y ACERO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1086, '', '2023-12-01 00:00:00', 'SISTEMA PUERTA PRINCIPAL', 'MECANICO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1087, '', '2023-12-01 00:00:00', 'AIRE ACONDICIONADO', 'AIRE ACONDICIONADO CON CONTROL', 'CH2A-012-HJU1C', '10062305', 'CIAC', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1088, '', '2023-12-01 00:00:00', 'AIRE ACONDICIONADO', 'AIRE ACONDICIONADO', 'CH42A-02A-H3131C', '174', 'CIAC', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2013-03-18', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1089, '', '2023-12-01 00:00:00', 'AIRE ACONDICIONADO INVERTERV LG CON CONTROL', 'AIRE ACONDICIONADO LG CON CONTROL', 'NO APLICA', 'VM182CE MCE3', 'LG', 'CONTROL', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 2876800, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1090, '', '2023-12-01 00:00:00', 'AIRE ACONDICIONADO TIAC CON CONTROL ', '', 'NO APLICA', 'CH21V-009-H3U1C', 'CIAC', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 5749000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1091, '', '2023-12-01 00:00:00', 'AIRE ACONDICIONADO', 'COLOR BLANCO GRANDE', 'NO APLICA', 'NO APLICA', 'PANASONIC', 'MAQUINARIA Y EQUIPO', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1092, '', '2023-12-01 00:00:00', 'AIRE ACONDICIONADO ELECTROLUX', '', 'PNC 929090113', 'IS305100021', 'ELECTROLUX', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ARCHIVO', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1093, '', '2023-12-01 00:00:00', 'AIRE ACONDICIONADO', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'LG', 'EQUIPO DE OFICINA', '', '', '', '', 'CCTV', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1094, '', '2023-12-01 00:00:00', 'AIRE ACONDICIONADO YORK', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'YORK', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 3', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1095, '', '2023-12-01 00:00:00', 'ESTANTERIA METALICA DE 7 ENTREPAÑOS COLOR GRIS', '', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', 'SAN ALEJO', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1096, '', '2023-12-01 00:00:00', 'GUADAÑA STIHN', 'COLOR GRIS Y NARANJA', 'FS280', '4119 967 4005A', 'STIHN', 'EQUIPO DE OFICINA', '', '', '', '', 'SAN ALEJO', 'Ninguna', 0, '0000-00-00', 1850000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1097, '', '2023-12-01 00:00:00', 'COMPRESOR', 'COLOR VERDE MILITAR Y NEGRO', '1129500990', 'CJK2622200925', 'BAUKER', 'EQUIPO DE OFICINA', '', '', '', '', 'SAN ALEJO', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1098, '', '2023-12-01 00:00:00', 'HIDROLAVADORA A GASOLINA', 'COLOR ZUL, NEGRO Y GRIS CON CUATRO BOQUILLAS', 'HYGPW2700', 'HYGPW27220704-01-0027', 'HYUNDAI', 'CONTROL', '', '', '', '', 'SAN ALEJO', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1099, '', '2023-12-01 00:00:00', 'GRAPADORA GRANDE', 'COLOR GRIS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1100, '', '2023-12-01 00:00:00', 'PAPALERA HORIZONTAL EN  MADERA SENCILLA (UN MODULO) ARRENDADO', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1101, '', '2023-12-01 00:00:00', 'PAPALERA HORIZONTAL EN  MADERA SENCILLA (UN MODULO) ARRENDADO', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1102, '', '2023-12-01 00:00:00', 'SILLA AUXILIAR CUERO AZUL Y NEGRO', 'NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1103, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'COLOR AZUL CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1104, '', '2023-12-01 00:00:00', 'PANTALLA NOC PARA COMPUTADOR, CON MOUSE Y TECLADO LENOVO', 'NEGRA', 'E970SWHEN', 'AOBH91A001492', 'NOC', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1105, '', '2023-12-01 00:00:00', 'BASE MADERA PARA COMPUTADOR NEGRA ', 'NEGRA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1106, '', '2023-12-01 00:00:00', 'PAPALERA HORIZONTAL MADERA DOBLE', 'MADERA CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1107, '', '2023-12-01 00:00:00', 'PERCHERO NEGRO Y PLATEADO TUBULAR', 'NEGRO Y PLATEADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1108, '', '2023-12-01 00:00:00', 'TELEFONO INLAMBRICO SYMPLY ', 'INHALAMBRICO', 'STI3522', 'QNUE41015B1WB', 'SYMPLI', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1109, '', '2023-12-01 00:00:00', 'TABLERO EN MADERA Y ACRILICO BLANCO', 'BLANCO Y MADERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1110, '', '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'ARTESMA', 'CONTROL', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1111, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'PENTAGRAMA', 'CONTROL', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1112, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'PENTAGRAMA', 'CONTROL', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1113, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1 METRO)', 'NO APLICA', 'NO APLICA', 'PENTAGRAMA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1114, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (3 METRO)', 'NO APLICA', 'NO APLICA', 'PENTAGRAMA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1115, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (3 METRO)', 'NO APLICA', 'NO APLICA', 'PENTAGRAMA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1116, '', '2023-12-01 00:00:00', 'ESCRITORIO EN L CAFÉ 3 CAJONES', 'DIAN', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1117, '', '2023-12-01 00:00:00', 'ESCRITORIO EN L BEIGE 3 CAJONES SIN LLAVE ABRE', 'DIAN', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1118, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'DIAN', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1119, '', '2023-12-01 00:00:00', 'ESCRITORIO EN L CAFÉ 3 CAJONES', 'CON LLAVE EN BUEN ESTADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1120, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'BUEN ESTADO ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1121, '', '2023-12-01 00:00:00', 'MESA DE VIDRIO CIRCULAR Y METAL ', 'VIDRIO Y METAL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '2014-08-13', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1122, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'TERCIOPELO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1123, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'BUEN ESTADO ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1124, '', '2023-12-01 00:00:00', 'MESA REDONDA DE MADERA Y METAL GRIS', 'MADERA BEIGE Y PATAS GRIS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1125, '', '2023-12-01 00:00:00', 'SILLAS AUXILIARES DE TERCIOPELO AZUL Y PATAS NEGRAS', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1126, '', '2023-12-01 00:00:00', 'SILLAS AUXILIARES DE TERCIOPELO AZUL Y PATAS NEGRAS', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1127, '', '2023-12-01 00:00:00', 'ESCRITORIO MODULAR EN L WENGUE 2 CAJORES CON TUBOS DE ACERO', 'LLAVE SIN USO CORRECTO', 'NO APLICA', 'NO APLICA', 'MODUART', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1128, '', '2023-12-01 00:00:00', 'ESCRITORIO EN L WENGUE 3 CAJOSES 3 METALICOS CON PATAS GRISES CON LLAVE', 'CON LLAVE BIEN', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1129, '', '2023-12-01 00:00:00', 'ESCRITORIO EN L WENGUE 3 CAJONES MADERA CON PATAS GRISES CON LLAVE', 'CON LLAVE BIEN', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1130, '', '2023-12-01 00:00:00', 'ESCRITORIO EN L WENGUE 3 CAJONES MADERA CON PATAS GRISES SIN LLAVE', 'SIN LLAVE Y CAJONES ASEGURADOS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1131, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'BUEN ESTADO ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1132, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'BUEN ESTADO ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1133, '', '2023-12-01 00:00:00', 'MESA AUXILIAR CON RODACHINES ', 'ESQUINAS EN MAL ESTADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1134, '', '2023-12-01 00:00:00', 'MUEBLE DE COCINA', '4 SUPERIORES Y 2 INFERIORES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1135, '', '2023-12-01 00:00:00', 'ESCRITORIO EN L WENGUE 3 CAJOSES 3 METALICOS CON PATAS GRISES CON LLAVE ', 'SIN LLAVE Y CAJONES ASEGURADOS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1136, '', '2023-12-01 00:00:00', 'DIVISIÓN METALICA, VIDRIO Y MADERA 24 MODULOS CON PUERTA', 'LA PUERTA CIERRA SIN LLAVE ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '2012-12-31', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1137, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'TERCIOPELO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1138, '', '2023-12-01 00:00:00', 'ARCHIVADOR DE 3 PUESTOS CAJONES SIN LLAVE', 'MADERA NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 755000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1139, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (2 METRO)', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 114812, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1140, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1 METRO)', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 114812, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1141, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '2012-12-31', 114812, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1142, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (2 METRO)', 'NO APLICA', 'NO APLICA', 'SUNTECA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 114812, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1143, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'SUNTECA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 114812, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1144, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'HORIZONTE', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 114812, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1145, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'UNO X UNO', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 114812, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1146, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1 METRO)', 'NO APLICA', 'NO APLICA', 'HORIZONTE', 'CONTROL', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 114812, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1147, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'COLOR AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', '', 'Ninguna', 0, '2013-06-05', 289801, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1148, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'COLOR AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1149, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA EN CUERO ', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 374793, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1150, '', '2023-12-01 00:00:00', 'ESCRITORIO DE DOS PUESTOS CON TRES CAJONES Y LLAVE', 'COLOR MADERA Y NEGRO', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'CONTROL', '', '', '', '', 'ACOTAR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1151, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'COLOR AZUL', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'CONTROL', '', '', '', '', 'ACOTAR', 'Ninguna', 0, '0000-00-00', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No');
INSERT INTO `activos` (`id_activo`, `cod_renta`, `fecha_asignacion`, `nombre_articulo`, `descripcion_articulo`, `modelo_articulo`, `referencia_articulo`, `marca_articulo`, `tipo_articulo`, `ip`, `windows`, `office`, `factura_office`, `lugar_articulo`, `observaciones_articulo`, `numero_factura`, `fecha_garantia`, `valor_articulo`, `condicion_articulo`, `id_proveedor_fk`, `descripcion_proveedor`, `id_usuario_fk`, `estado_activo`, `recurso_tecnologico`) VALUES
(1152, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'COLOR AZUL', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', 'ACOTAR', 'Ninguna', 0, '2012-12-31', 289801, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1153, '', '2023-12-01 00:00:00', 'ESCRITORIO PEQUEÑO CON 1 CAJON ', 'COLOR NEGRO', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', 'ACOTAR', 'Ninguna', 0, '2014-02-17', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1154, '', '2023-12-01 00:00:00', 'PUERTA DE MODULO', 'GRIS DE VIDRIO', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'CONTROL', '', '', '', '', 'ACOTAR', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1155, '', '2023-12-01 00:00:00', 'VENTILADOR DE MESA', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'BIONAIRE', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1156, '', '2023-12-01 00:00:00', 'DIVISIÓN METALICA, VIDRIO Y MADERA', 'DIVISIÓN EN MODULO DE 23 ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - JURIDICO', 'Ninguna', 0, '2012-12-31', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1157, '', '2023-12-01 00:00:00', 'PERCHERO CAFÉ', 'PERCHERO CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1158, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1159, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1160, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1161, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1162, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1163, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '2012-12-31', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1164, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1165, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1166, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1167, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '2013-06-05', 289826, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1168, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1169, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1170, '', '2023-12-01 00:00:00', 'TABLERO CON BASE PLEGABLE', 'TABLERO CON BASE PLEGABLE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1171, '', '2023-12-01 00:00:00', 'BASE DE TV EXTENSIBLE', 'CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '2012-12-31', 1977000, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1172, '', '2023-12-01 00:00:00', 'SILLAS RIMAX 1', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1173, '', '2023-12-01 00:00:00', 'SILLAS RIMAX 2', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1174, '', '2023-12-01 00:00:00', 'SILLAS RIMAX 3', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '2013-04-25', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1175, '', '2023-12-01 00:00:00', 'SILLAS RIMAX 4', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '2013-04-25', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1176, '', '2023-12-01 00:00:00', 'SILLAS RIMAX 5', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1177, '', '2023-12-01 00:00:00', 'SILLAS RIMAX 6', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1178, '', '2023-12-01 00:00:00', 'SILLAS RIMAX 7', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1179, '', '2023-12-01 00:00:00', 'SILLAS RIMAX 8', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1180, '', '2023-12-01 00:00:00', 'SILLAS RIMAX 9', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1181, '', '2023-12-01 00:00:00', 'SILLAS RIMAX 10', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1182, '', '2023-12-01 00:00:00', 'SILLAS RIMAX 11', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1183, '', '2023-12-01 00:00:00', 'SILLAS RIMAX 12', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1184, '', '2023-12-01 00:00:00', 'SILLAS RIMAX 13', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'RIMAX', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '2013-04-25', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1185, '', '2023-12-01 00:00:00', 'MESA RECTANGULAR', 'COLOR NEGRO Y COLOR MADERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 5561630, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1186, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (2 METRO)', 'NO APLICA', 'NO APLICA', 'HORIZONTE', 'CONTROL', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 193333, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1187, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'HORIZONTE', 'CONTROL', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 193333, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1188, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1 METRO)', 'NO APLICA', 'NO APLICA', 'HORIZONTE', 'CONTROL', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 193333, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1189, '', '2023-12-01 00:00:00', 'MESA OVALADA', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS II', 'Ninguna', 0, '0000-00-00', 530000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1190, '', '2023-12-01 00:00:00', 'SILLAS RIMAX 14', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1191, '', '2023-12-01 00:00:00', 'TABLERO', 'TABLERO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS II', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1192, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (2.5 METRO)', 'NO APLICA', 'NO APLICA', 'HORIZONTE', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS II', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1193, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (2.5 METRO)', 'NO APLICA', 'NO APLICA', 'PENTAGRAMA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS III', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1194, '', '2023-12-01 00:00:00', 'SILLA AUXILIAR NEGRA', 'NEGRA EN CUERO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS III', 'Ninguna', 0, '2023-05-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1195, '', '2023-12-01 00:00:00', 'SILLA AUXILIAR NEGRA', 'NEGRA EN CUERO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS III', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1196, '', '2023-12-01 00:00:00', 'SILLA AUXILIAR NEGRA', 'NEGRA EN CUERO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS III', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1197, '', '2023-12-01 00:00:00', 'MESA REDONDA DE VIDRIO Y BASE EN METAL', 'NEGRO Y PLATEADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS III', 'Ninguna', 0, '0000-00-00', 1075180, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1198, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'SALA DE JUNTAS III', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1199, '', '2023-12-01 00:00:00', 'SOFA EN CUERO NEGRO 2 PUESTOS', 'RECEPCIÓN', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'RECEPCIÓN', 'Ninguna', 0, '0000-00-00', 2538000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1200, '', '2023-12-01 00:00:00', 'PAPELERA HORIZONTAL DEL MADERA 2 MODULOS ', 'PAPALERA HORIZONTAL EN  MADERA PARA COMPUTADOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1201, '', '2023-12-01 00:00:00', 'PAPALERA HORIZONTAL EN  MADERA SENCILLA (UN MODULO)', 'PAPELERA HORIZONTAL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1202, '', '2023-12-01 00:00:00', 'PAPALERA HORIZONTAL EN  MADERA SENCILLA (UN MODULO)', 'PAPELERA HORIZONTAL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1203, '', '2023-12-01 00:00:00', 'ESCRITORIO EN L 3 CAJONERAS', 'COLOR MADERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1204, '', '2023-12-01 00:00:00', 'TELEFONO FIJO PBX PANASONIC ', 'TELEFONO FIJO PBX PANASONIC ', 'NO APLICA', 'KX-T7730X-B', 'PANASONIC', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1205, '', '2023-12-01 00:00:00', 'COMPUTADOR DE MESA', 'COMPUTADOR DE MESA', 'NO APLICA', 'MXL249147V', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'Si'),
(1206, '', '2023-12-01 00:00:00', 'ESCRITORIO PEQUEÑO', 'COLOR MADERA UN CAJON CON LLAVE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1207, '', '2023-12-01 00:00:00', 'ARCHIVADOR EN FORMA DE PALOMERA', 'ARCHIVADOR EN FORMA DE PALOMERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1208, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1209, '', '2023-12-01 00:00:00', 'BUZON', 'SUGERENCIAS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1210, '', '2023-12-01 00:00:00', 'ARCHIVADOR HORIZONTAL', 'COLOR BEIGE DE DOS CAJONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1211, '', '2023-12-01 00:00:00', 'ESCRITORIO L DE TRES CAJONES', 'NO TIENE LLAVE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 15, 'Activo', 'No'),
(1212, '', '2023-12-01 00:00:00', 'BASE GRADUABLE', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 15, 'Activo', 'No'),
(1213, '', '2023-12-01 00:00:00', 'BASE FIJA DE COMPUTADOR', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 15, 'Activo', 'No'),
(1214, '', '2023-12-01 00:00:00', 'TELEFONO', 'INHALAMBRICO', 'MOTO550D', 'MOTOXQT000V', 'MOTOROLA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 15, 'Activo', 'No'),
(1215, '', '2023-12-01 00:00:00', 'COMPUTADOR TODO EN UNO, CON MOUSE Y TECLADO', 'COLOR NEGRO', '7558-L412', 'S1DVP45', 'LENOVO/LENOVO/HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 15, 'Activo', 'Si'),
(1216, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 15, 'Activo', 'No'),
(1217, '', '2023-12-01 00:00:00', 'BICICLETA', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', ' ', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 15, 'Activo', 'No'),
(1218, '', '2023-12-01 00:00:00', 'ESCRITORIO 3 CAJONES', 'MODULO COLOR BEIGE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1219, '', '2023-12-01 00:00:00', 'COMPUTADOR DE MESA, CON MOUSE Y TECLADO', 'TODO EN UNO, COLOR NEGRO', '7558-L4S', 'S1DVV40', 'LENOVO', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2013-08-12', 1670310, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'Si'),
(1220, '', '2023-12-01 00:00:00', 'BASE DE MADERA', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2013-08-12', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1221, '', '2023-12-01 00:00:00', 'TELEFONO FIJO', 'COLOR NEGRO, INHALAMBRICO', 'NO APLICA', 'QNUE41015B1WB', 'SIMPLY', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2013-08-12', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1222, '', '2023-12-01 00:00:00', 'VENTILADOR', 'COLOR NEGRO Y GRIS', 'BT38', '60HZ120V-0.4AMPS', 'BIONAIRE', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2013-08-12', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1223, '', '2023-12-01 00:00:00', 'PAPALERA HORIZONTAL EN  MADERA SENCILLA (UN MODULO)', 'PAPELERA HORIZONTAL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2013-08-12', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1224, '', '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'ARTEMA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2013-08-12', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1225, '', '2023-12-01 00:00:00', 'ARCHIVADOR VERTICAL', 'COLOR BEIGE DE CUATRO CAJONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 1886610, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1226, '', '2023-12-01 00:00:00', 'ARCHIVADOR VERTICAL', 'COLOR BEIGE DE CUATRO CAJONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 1886610, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1227, '', '2023-12-01 00:00:00', 'MODULO DE DIVISION', 'MODULO DE DIVISION', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1228, '', '2023-12-01 00:00:00', 'ESCRITORIO EN L 3 CAJONES', 'COLOR GEIGE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1229, '', '2023-12-01 00:00:00', 'VENTILADOR OSTER VERTICAL 8 REVOLUCIONES CON CONTROL', 'NEGRO CON CONTROL', 'NO APLICA', 'OTF9115R-LA013', 'OSTER', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 189900, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1230, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1231, '', '2023-12-01 00:00:00', 'ESCRITORIO SENCILLO GEIGE CON 3 CAJONES Y LLAVE', 'PATAS GRISES EN BUEN ESTADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 3, 'Activo', 'No'),
(1232, '', '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 3, 'Activo', 'No'),
(1233, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'SUNTECA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 3, 'Activo', 'No'),
(1234, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 3, 'Activo', 'No'),
(1235, '', '2023-12-01 00:00:00', 'BICICLETA AZUL', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1236, '', '2023-12-01 00:00:00', 'ESCRITORIO EN L 3 CAJONES MADERA, PATAS GRISES METALICAS', 'BEIGE CON LLAVE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 16, 'Activo', 'No'),
(1237, '', '2023-12-01 00:00:00', 'PALOMERA GRIS CON WENGUE PEQUEÑA', 'GRIS Y WEHGUE SIN LLAVE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 16, 'Activo', 'No'),
(1238, '', '2023-12-01 00:00:00', 'PAPELERA HORIZONTAL DEL MADERA 2 MODULOS ', 'MADERA MAL ESTADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 16, 'Activo', 'No'),
(1239, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2013-04-26', 579602, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 16, 'Activo', 'No'),
(1240, '', '2023-12-01 00:00:00', 'ESCRITORIO SENCILLO GEIGE CON 3 CAJONES SIN LLAVE', 'PATAS GRISES EN BUEN ESTADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 23, 'Activo', 'No'),
(1241, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2013-04-26', 579602, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 23, 'Activo', 'No'),
(1242, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (2 METRO)', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'CCTV', 'Ninguna', 0, '0000-00-00', 129186, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1243, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'COLOR AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'CCTV', 'Ninguna', 0, '0000-00-00', 579602, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1244, '', '2023-12-01 00:00:00', 'ESCRITORIO MEDIANO', 'COLOR MADERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1245, '', '2023-12-01 00:00:00', 'UN ARCHIVADOR PEQUEÑO', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1246, '', '2023-12-01 00:00:00', 'ARCHIVADOR DE METAL', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1247, '', '2023-12-01 00:00:00', 'UNA DIVISION DE OFICINA', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1248, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'COLOR AZUL', 'NO APLICA', 'NO  APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'CCTV', 'Ninguna', 0, '0000-00-00', 579602, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1249, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA 1', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'CCTV', 'Ninguna', 0, '0000-00-00', 129186, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1250, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA 2', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'CCTV', 'Ninguna', 0, '0000-00-00', 129186, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1251, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA 3', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'HORIZONTE', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'CCTV', 'Ninguna', 0, '0000-00-00', 129186, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1252, '', '2023-12-01 00:00:00', 'ESCRITORIO SENCILLO GEIGE CON 3 CAJONES Y LLAVE', 'PATAS GRISES EN BUEN ESTADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2013-02-15', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 28, 'Activo', 'No'),
(1253, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2014-06-19', 289801, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 28, 'Activo', 'No'),
(1254, '', '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'ARTEMA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 28, 'Activo', 'No'),
(1255, '', '2023-12-01 00:00:00', 'TELEFONO', 'INHALAMBRICO', 'NO APLICA', 'QNUE4101555K6', 'SIMPLY', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 28, 'Activo', 'No'),
(1256, '', '2023-12-01 00:00:00', 'ESPEJO EN MADERA', 'UN ESPEJO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'BAÑO HOMBRES PISO I', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1257, '', '2023-12-01 00:00:00', 'ESPEJO EN MADERA', 'UN ESPEJO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'BAÑOMUJERES PISO I', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1258, '', '2023-12-01 00:00:00', 'COCINA INTEGRAL', 'COLOR CAFÉ DE 4 DIVISIONES INFERIORES, ENCIMERA EN ALUMINIO Y MUEBLE SUPERIOR DE 3 DIVISIONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO I', 'Ninguna', 0, '2012-12-31', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1259, '', '2023-12-01 00:00:00', 'UN BASURERO PLASTICO', 'COLOR BLANCO DE RESIDUOS APROVECHABLES UNA DIVISION  ', 'NO APLICA', 'NO APLICA', 'COLPLASTICO', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO I', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1260, '', '2023-12-01 00:00:00', 'UN BASURERO PLASTICO', 'COLOR BLANCO DE RESIDUOS APROVECHABLES 2 DIVISION  ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO I', 'Ninguna', 0, '2012-12-31', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1261, '', '2023-12-01 00:00:00', 'NEVERA - BLANCA', 'BLANCA', 'NO APLICA', '_ _ 058550 4164', 'LG', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINETA U:O PISO I', 'Ninguna', 0, '0000-00-00', 420000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1262, '', '2023-12-01 00:00:00', 'GRECA DE CAFE', 'PLATEADA', 'NO APLICA', 'NO APLICA', 'GRECA NACIONAL DEL CAFÉ', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINETA U:O PISO I', 'Ninguna', 0, '2012-12-31', 305000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1263, '', '2023-12-01 00:00:00', 'ESPEJO EN MADERA NEGRA', 'ESPEJO BAÑO EN MADERA NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS III', 'Ninguna', 0, '2012-12-31', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1264, '', '2023-12-01 00:00:00', 'ESPEJO EN MADERA', 'ESPEJO BAÑO EN MADERA NEGRA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'BAÑO MUJERES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1265, '', '2023-12-01 00:00:00', 'ESPEJO EN MADERA', 'ESPEJO BAÑO EN MADERA NEGRA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'BAÑO HOMBRES', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1266, '', '2023-12-01 00:00:00', 'ESPEJO DE MADERA', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1267, '', '2023-12-01 00:00:00', 'ALACENA VERTICAL 5 PUESTOS EN MADERA BEIGE', 'BEIGE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1268, '', '2023-12-01 00:00:00', 'COCINA INTEGRAL ', '2 DIVICIONES EN MADELA WENGUE, MODULO SUPERIOR 2 DIVISIONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1269, '', '2023-12-01 00:00:00', 'ESCALERA 2 PASOS RIMAX', 'AZUL PLASTICA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1270, '', '2023-12-01 00:00:00', 'CANECA DE RESIDUOS APROVECHABLES', 'COLOR NEGRO DE UN MODULO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1271, '', '2023-12-01 00:00:00', 'CANECA DE RESIDUOS APROVECHABLES', 'COLOR BLANCO DE UN MODULO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1272, '', '2023-12-01 00:00:00', 'PURIFICADOR DE AGUA OZONO HEALTH', 'BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1273, '', '2023-12-01 00:00:00', 'BANDEJA DE MADERA ', 'COLOR MADERA ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1274, '', '2023-12-01 00:00:00', 'GRECA DE CAFÉ', 'PLATEADO', 'NO APLICA', 'NO APLICA', 'LA SIMA DE LA GRECA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1275, '', '2023-12-01 00:00:00', 'NEVERA ELECTROLUX INFINITY ACERO Y METAL', 'ACERO Y METAL GRIS', 'MR125E08700155', 'ERT163EG', 'ELETROLUX', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '0000-00-00', 1462980, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1276, '', '2023-12-01 00:00:00', 'HORNO MICROHONDAS KALLEY', 'ACERO / COLOR GRIS', 'NO APLICA', 'NO APLICA', 'KALEY', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '0000-00-00', 399900, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1277, '', '2023-12-01 00:00:00', 'ESPEJO DE MADERA', 'MADERA CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1278, '', '2023-12-01 00:00:00', 'ESPEJO DE MADERA', 'MADERA CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1279, '', '2023-12-01 00:00:00', 'OZONO PURIFICADOR DE AGUA', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1280, '', '2023-12-01 00:00:00', 'COCINA INTEGRAL ', 'COLOR BLANCO DE 2 PUESTOS, METALICA Y ALUMINIO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2019-05-02', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1281, '', '2023-12-01 00:00:00', 'CANECA DE RESIDUOS APROVECHABLES', 'COLOR BLANCO DE UN MODULO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2016-12-13', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1282, '', '2023-12-01 00:00:00', 'CANECA DE RESIDUOS APROVECHABLES', 'COLOR GRIS DE DOS MODULOS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2016-12-13', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1283, '', '2023-12-01 00:00:00', 'HORNO MICROHONDAS ', 'COLOR BLANCO', 'EMDA20S3MKW', '22305474', 'ELECTROLUX', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2016-12-13', 130000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1284, '', '2023-12-01 00:00:00', 'MESA PLASTICO', 'TRES COMPARTIMENTOS COLOR AZUL Y GRIS CON RODCHINES', 'NO APLICA', 'NO APLICA', 'WINCO', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2016-12-13', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1285, '', '2023-12-01 00:00:00', 'SILLAS', 'AZULES PLASTICO Y ACERO ', 'NO APLICA ', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '2016-12-13', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1286, '', '2023-12-01 00:00:00', 'SILLAS', 'AZULES PLASTICO Y ACERO ', 'NO APLICA ', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '2016-12-13', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1287, '', '2023-12-01 00:00:00', 'SILLAS', 'AZULES PLASTICO Y ACERO ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'CONTROL', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1288, '', '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'MAQUINARIA Y EQUIPO', '', '', '', '', '', 'Ninguna', 0, '2014-08-23', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1289, '', '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2016-12-13', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1290, '', '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1291, '', '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1292, '', '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1293, '', '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2016-12-13', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1294, '', '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1295, '', '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1296, '', '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', '', 'Ninguna', 0, '2013-04-26', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1297, '', '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1298, '', '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1299, '', '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'CONTROL', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1300, '', '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2013-11-13', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1301, '', '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'CONTROL', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1302, '', '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA CON REPOSA BRAZOS ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'CONTROL', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1303, '', '2023-12-01 00:00:00', 'VENTILADOR VERTICAL ', 'COLOR NEGRO', 'VE231210', '2708', 'SAMURAI', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2012-12-31', 205350, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1304, '', '2023-12-01 00:00:00', 'VENTILADOR VERTICAL ', 'COLOR GRIS', 'BE732210', '1089', 'SAMURAI', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 205350, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1305, '', '2023-12-01 00:00:00', 'SILLAS 1', 'COLOR NEGRO Y AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No');
INSERT INTO `activos` (`id_activo`, `cod_renta`, `fecha_asignacion`, `nombre_articulo`, `descripcion_articulo`, `modelo_articulo`, `referencia_articulo`, `marca_articulo`, `tipo_articulo`, `ip`, `windows`, `office`, `factura_office`, `lugar_articulo`, `observaciones_articulo`, `numero_factura`, `fecha_garantia`, `valor_articulo`, `condicion_articulo`, `id_proveedor_fk`, `descripcion_proveedor`, `id_usuario_fk`, `estado_activo`, `recurso_tecnologico`) VALUES
(1306, '', '2023-12-01 00:00:00', 'SILLAS 2', 'COLOR NEGRO Y AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1307, '', '2023-12-01 00:00:00', 'SILLAS 3', 'COLOR NEGRO Y AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1308, '', '2023-12-01 00:00:00', 'SILLAS 4', 'COLOR NEGRO Y AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1309, '', '2023-12-01 00:00:00', 'SILLAS 5', 'COLOR NEGRO Y AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1310, '', '2023-12-01 00:00:00', 'SILLAS 6', 'COLOR NEGRO Y AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1311, '', '2023-12-01 00:00:00', 'MESA MADERA Y METAL', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1312, '', '2023-12-01 00:00:00', 'MESA MADERA Y METAL', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1313, '', '2023-12-01 00:00:00', 'MESA MADERA Y METAL', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1314, '', '2023-12-01 00:00:00', 'MESA MADERA Y METAL', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1315, '', '2023-12-01 00:00:00', 'SILLAS ', 'VERDES DE PASTICO  Y ACERO ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1316, '', '2023-12-01 00:00:00', 'SILLAS ', 'VERDES DE PASTICO  Y ACERO ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1317, '', '2023-12-01 00:00:00', 'SILLAS ', 'VERDES DE PASTICO  Y ACERO ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '2012-12-31', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1318, '', '2023-12-01 00:00:00', 'SILLAS ', 'VERDES DE PASTICO  Y ACERO ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1319, '', '2023-12-01 00:00:00', 'SILLAS ', 'VERDES DE PASTICO  Y ACERO ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1320, '', '2023-12-01 00:00:00', 'ESCRITORIO EN L SOLINOF', 'ESCRITORIO EN L - SOLINOF MADERA Y METAL GRIS, BEIGE Y CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '0000-00-00', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1321, '', '2023-12-01 00:00:00', 'DIVISIÓN METALICA, VIDRIO Y MADERA', 'DIVISIÓN EN MODULO DE 23 ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1322, '', '2023-12-01 00:00:00', 'ROUTER', 'ROUTER', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1323, '', '2023-12-01 00:00:00', 'TELEVISOR LG 70\" ', 'TELEVISOR LG 70\" CON CONTROL', 'NO APLICA', '70UK6550PDA', 'LG', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 3499900, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1324, '', '2023-12-01 00:00:00', 'ROUTER', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'TP-LINK', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS II', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1325, '', '2023-12-01 00:00:00', 'PAPELERA HORIZONTAL DEL MADERA 2 MODULOS ', 'PAPALERA HORIZONTAL EN  MADERA PARA COMPUTADOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1326, '', '2023-12-01 00:00:00', 'MONITOR LG PARA COMPUTADOR', 'MONITOR LG PARA COMPUTADOR', 'NO APLICA', '20M38HBBAWPQJVN', 'LG', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1327, '', '2023-12-01 00:00:00', 'UPS DELL OPTIPLEX 3070', 'UPS DELL OPTIPLEX 3070', '29264706543', 'DFZG833', 'DELL', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '2012-12-31', 0, '', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1328, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1 METRO)', 'NO APLICA', 'NO APLICA', 'SUNTECA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1329, '', '2023-12-01 00:00:00', 'DUPLICARDOR DISCO DURO', 'COLOR NEGRO', 'WL-ST334U REV.A', 'BG26HL0200471', 'WAVLINK', 'CONTROL', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1330, '', '2023-12-01 00:00:00', 'ARCHIVADOR EN FORMA DE PALOMERA', 'ARCHIVADOR EN FORMA DE PALOMERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1331, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'SILLA ERGONOMICA CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '0000-00-00', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1332, '', '2023-12-01 00:00:00', 'TELEFONO INLAMBRICO PANASONIC', 'NEGRO CON BASE', 'NO APLICA', 'KXTGB110LA', 'PANASONIC', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1333, '', '2023-12-01 00:00:00', 'BASE MADERA PARA COMPUTADOR NEGRA', 'BASE MADERA PARA COMPUTADOR NEGRA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1334, '', '2023-12-01 00:00:00', 'SILLA AUXILIAR PASTA Y CUERO VISITANTE', 'NEGRA Y CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1335, '', '2023-12-01 00:00:00', 'TELEVISOR SAMSUMG 32\"', 'TELEVISOR 32\" SAMSUMG', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1336, '', '2023-12-01 00:00:00', 'ROUTER', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'TP-LINK', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1337, '', '2023-12-01 00:00:00', 'IMPRESORA A COLOR ', 'BLANCA', 'NO APLICA', 'HP SMART TANK 720', 'HP', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1338, '', '2023-12-01 00:00:00', 'IMPRESORA HP LASER JET PROMFP M428fdw', 'COLOR BLANCO', 'VCVRA-1712', 'MXBPMCBOLH', 'HP', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1339, '', '2023-12-01 00:00:00', 'IMPRESORA HP LASER PEQUEÑA P1606DN', 'COLOR NEGRO', 'BOISB-0902-00', 'VNB3G04919', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1340, '', '2023-12-01 00:00:00', 'ESCRITORIO GRANDE SIN CAJON ', 'COLOR MADERA ', 'NO APLICA ', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1341, '', '2023-12-01 00:00:00', 'ESCRITORIO PEQUEÑO CON 2 CAJONES ', 'MADERA ', 'NO APLICA ', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1342, '', '2023-12-01 00:00:00', 'RACK PRINCIPAL ', 'CAJO DE ALMACENAMIENTO ELTRONICO NEGRO ', 'NO APLICA ', 'TECNI SERVICIOS ', 'SIEMON', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1343, '', '2023-12-01 00:00:00', 'ACESS POIN', 'BLANCO', 'LAPAC1750', 'NO APLICA', 'LINKSYS', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1344, '', '2023-12-01 00:00:00', 'SWITCHE', 'GRIS ', 'NO APLICA ', '130', ' ALLIED TELISIS 24 PUERTOS ', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1345, '', '2023-12-01 00:00:00', 'RACK DE COMUNICACIONES ', 'NEGRO ', 'NO APLICA ', 'NO APLICA', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1346, '', '2023-12-01 00:00:00', 'CISCO', 'SWITCHE CATALYST 2950', 'NO APLICA ', 'NO APLICA', 'CATALYST 2950', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1347, '', '2023-12-01 00:00:00', 'UPC', 'NEGRO ', 'ON-LINE MGO-10K-MAGOM', 'NO APLICA', 'NO APLICA ', 'CONTROL', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1348, '', '2023-12-01 00:00:00', 'ROUTER PORTABLE ', 'ROUTER PORTABLE 4G WIFI', 'B612 FBD9', 'NO APLICA', 'NO APLICA ', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1349, '', '2023-12-01 00:00:00', 'TELEFONO FIJO ', 'INHALAMBRICO', 'KX-T5500LX', 'NO APLICA', 'PANASONIC', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2023-05-23', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1350, '', '2023-12-01 00:00:00', 'SERVIDOR ZEUS ', 'COMPLETO', '1040-900-0092 ', 'NO APLICA', 'COMPUMAX ', 'CONTROL', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1351, '', '2023-12-01 00:00:00', 'TORRE DE COMPUTADOR', 'NEGRO ', 'HG00507', 'NO APLICA', 'HGXTREME', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'Si'),
(1352, '', '2023-12-01 00:00:00', 'DISCOS DE COPIA DE SEGURIDAD', 'NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA ', 'CONTROL', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1353, '', '2023-12-01 00:00:00', 'COMPUTADOR TODO EN UNO', 'TODO NEGRO', '100B', 'HP100BALLINONEPCSERIES', 'HP ', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'Si'),
(1354, '', '2023-12-01 00:00:00', 'COMPUTADOR PORTATIL LENOVO', 'LENOVO NEGRO THINPAD', 'L430', 'ZPI0072020', 'LEVONO', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 1790000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'Si'),
(1355, '', '2023-12-01 00:00:00', 'PARLANTES GENIOS CABINAS DE SONIDO', 'GENIOS', 'XN130XE03210', 'SP-HF2020V2', 'GENIOS', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1356, '', '2023-12-01 00:00:00', 'BASE DE MADERA FIJA ', 'NEGRA', 'NO APLICA ', 'NO APLICA', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1357, '', '2023-12-01 00:00:00', 'COMPUTADOR PORTATIL LENOVO', 'LENOVO NEGRO THINPAD', 'L430', 'NO APLICA', 'LENOVO', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2012-12-31', 1790000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'Si'),
(1358, '', '2023-12-01 00:00:00', 'TORRE DE COMPUTADOR HG XTREME', 'HG XTREM', 'HG00502', '2123374', 'HG XTREME', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'Si'),
(1359, '', '2023-12-01 00:00:00', 'TORRE DE COMPUTADOR HG XTREME', 'HG XTREM', 'HG00502', '123040', 'HG XTREME', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2019-05-28', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'Si'),
(1360, '', '2023-12-01 00:00:00', 'TORRE DE COMPUTADOR HG XTREME', 'HG XTREM', 'HG00516', '123492', 'HG XTREME', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2019-05-28', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'Si'),
(1361, '', '2023-12-01 00:00:00', 'TORRE DE COMPUTADOR HG', 'HG ANTERIOR COMPUTADOR DEL DIR CONTABLE', 'HG00469A', '116431', 'HG', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2019-05-28', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'Si'),
(1362, '', '2023-12-01 00:00:00', 'PANTALLA 14\' NOC ', 'NEGRA', '185LM0019', 'AOBH91A000321', 'NOC', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1363, '', '2023-12-01 00:00:00', 'PANTALLA 14\' NOC ', 'NEGRA', '195LM0003', 'AOXH81A000402', 'NOC', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2023-05-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1364, '', '2023-12-01 00:00:00', 'PANTALLA 14\' NOC ', 'NEGRA', '185LM0019', 'AOBHA1A000318', 'NOC', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1365, '', '2023-12-01 00:00:00', 'PANTALLA 14\' NOC ', 'NEGRA', '185LM0019', 'AOBH91A000599', 'NOC', 'CONTROL', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1366, '', '2023-12-01 00:00:00', 'PANTALLA 15\' LG', 'LG', '20M35ASA', '407NDZJ42421', 'LG', 'CONTROL', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1367, '', '2023-12-01 00:00:00', 'PANTALLA 15\' LG', 'LG', '20MP38HQ', '804NTUW6M566', 'LG', 'CONTROL', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1368, '', '2023-12-01 00:00:00', 'TABLERO EN ACRILICO', 'BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1369, '', '2023-12-01 00:00:00', 'CAMARA WEB HD 1080p', '', 'NO APLICA', 'HD 1080P', 'LOGI', 'CONTROL', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1370, '', '2023-12-01 00:00:00', 'PARLANTES CON CABLE PARA EQUIPO COMPUTO', 'ANTES DEL DIR CONTABLE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1371, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'TERCIOPELO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2012-12-31', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1372, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2012-12-31', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1373, '', '2023-12-01 00:00:00', 'TELEFONO FIJO PANASONIC', '', 'KX-TS500LXB', '2KDKH300046', 'PANASONIC', 'FLOTA Y EQUIPO DE TRANSPORTE', '', '', '', '', 'PISO 1', 'Ninguna', 0, '0000-00-00', 0, 'Buena', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1374, '', '2023-12-01 00:00:00', 'UN RACK', 'COLOR NEGRO', '16-PORTGIGANTBIT', 'TL-SG1016D', 'TP-LINK', 'FLOTA Y EQUIPO DE TRANSPORTE', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Buena', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1375, '', '2023-12-01 00:00:00', 'VIDEO BEAM', 'COLOR BLANCO Y GRIS', 'NO APLICA', 'X4YF8300534', 'EPSON', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1376, '', '2023-12-01 00:00:00', 'NVR CCTV', 'NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'CCTV', 'Ninguna', 0, '2012-12-31', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1377, '', '2023-12-01 00:00:00', 'RACK', 'COLOR NEGRO CCTV-3', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'CCTV', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1378, '', '2023-12-01 00:00:00', 'UN BOTIQUIN', 'COLOR BLACO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS II', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1379, '', '2023-12-01 00:00:00', 'ESTANTERIA', 'COLOR GRIS DE 6 ENTREPAÑOS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ALMACEN', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1380, '', '2023-12-01 00:00:00', 'ESTANTERIA', 'COLOR GRIS Y VERDE DE 5 ENTREPAÑOS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ALMACEN', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1381, '', '2023-12-01 00:00:00', 'JUEGO DE SAPO', 'JUEGO DE SAPO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ALMACEN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1382, '', '2023-12-01 00:00:00', 'TABLERO EN MADERA Y CORCHO', 'TABLERO EN MADERA Y CORCHO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PASILLO', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1383, '', '2023-12-01 00:00:00', 'ESCRITORIO 3 CAJONES', 'MODULO COLOR BEIGE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1384, '', '2023-12-01 00:00:00', 'BASE DE MADERA', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1385, '', '2023-12-01 00:00:00', 'COMPUTADOR DE MESA CON MOUSE Y TECLADO', 'COLOR NEGRO', '7558-L4S', 'S1DMB12', 'LENOVO', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 1670310, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'Si'),
(1386, '', '2023-12-01 00:00:00', 'PAPELERA HORIZONTAL DEL MADERA 2 MODULOS ', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1387, '', '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1388, '', '2023-12-01 00:00:00', 'BOTIQUIN', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1389, '', '2023-12-01 00:00:00', 'BOTIQUIN', 'PORTATIL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1390, '', '2023-12-01 00:00:00', 'ARCHIVADOR', 'COLOR BEIGE DE DOS CAJONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 1222730, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1391, '', '2023-12-01 00:00:00', 'COMPUTADOR DE MESA, CON MOUSE Y TECLADO', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'LENOVO', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'Si'),
(1392, '', '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1393, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'COLOR AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1394, '', '2023-12-01 00:00:00', 'BOTIQUIN', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1395, '', '2023-12-01 00:00:00', 'TABLERO DE INFORMACION', 'MATERIAL CORCHO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1396, '', '2023-12-01 00:00:00', 'ESCRITORIO SENCILLO GEIGE CON 3 CAJONES Y LLAVE', 'PATAS GRISES EN BUEN ESTADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2013-04-30', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 20, 'Activo', 'No'),
(1397, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2013-04-30', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 20, 'Activo', 'No'),
(1398, '', '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 20, 'Activo', 'No'),
(1399, '', '2023-12-01 00:00:00', 'ESCRITORIO EN L SOLINOF', 'ESCRITORIO EN L - SOLINOF MADERA Y METAL GRIS, BEIGE Y CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - JURIDICO', 'Ninguna', 0, '2012-12-31', 2956860, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 4, 'Activo', 'No'),
(1400, '', '2023-12-01 00:00:00', 'EQUIPO DE COMPUTO HP TODO EN UNO ', 'EQUIPO DE COMPUTO HP COMPAQ PRO 4300 CON TECLADO Y MOUSE TODO EN UNO ', 'C9G88LT#ABM', 'MXL24913TD', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - JURIDICO', 'Ninguna', 0, '0000-00-00', 1755000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 4, 'Activo', 'Si'),
(1401, '', '2023-12-01 00:00:00', 'PAPELERA HORIZONTAL DEL MADERA 2 MODULOS ', 'PAPALERA HORIZONTAL EN  MADERA PARA COMPUTADOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - JURIDICO', 'Ninguna', 0, '0000-00-00', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 4, 'Activo', 'No'),
(1402, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1 METRO)', 'NO APLICA', 'NO APLICA', 'SUNTEC', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - JURIDICO', 'Ninguna', 0, '2013-08-12', 129186, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 4, 'Activo', 'No'),
(1403, '', '2023-12-01 00:00:00', 'ARCHIVADOR GRIS CON LLAVE 4 CAJONES', 'ARCHIVADOR GRIS CON LLAVE 4 CAJONES EN MADERA Y LAMINA METALICA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - JURIDICO', 'Ninguna', 0, '2013-08-12', 1448430, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 4, 'Activo', 'No'),
(1404, '', '2023-12-01 00:00:00', 'SILLA AUXILIAR PASTA Y CUERO', 'NEGRA Y CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'MAQUINARIA Y EQUIPO', '', '', '', '', 'MODULO 1 - JURIDICO', 'Ninguna', 0, '2023-04-24', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 4, 'Activo', 'No'),
(1405, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'MAQUINARIA Y EQUIPO', '', '', '', '', 'MODULO 1 - JURIDICO', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 4, 'Activo', 'No'),
(1406, '', '2023-12-01 00:00:00', 'BASE MADERA PARA COMPUTADOR NEGRA', 'BASE MADERA PARA COMPUTADOR NEGRA', 'NO APLICA', 'C111967', 'FSC', 'MAQUINARIA Y EQUIPO', '', '', '', '', 'MODULO 1 - JURIDICO', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 4, 'Activo', 'No'),
(1407, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 4, 'Activo', 'No'),
(1408, '', '2023-12-01 00:00:00', 'ESCRITORIO SENCILLO GEIGE CON 3 CAJONES Y LLAVE', 'PATAS GRISES EN BUEN ESTADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 18, 'Activo', 'No'),
(1409, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2019-05-28', 579602, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 18, 'Activo', 'No'),
(1410, '', '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2019-05-28', 0, 'Buena', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 18, 'Activo', 'No'),
(1411, '', '2023-12-01 00:00:00', 'TELEFONO', 'INHALAMBRICO', 'STI3522', 'QNUE4101585K6', 'SIMPLY', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 18, 'Activo', 'No'),
(1412, '', '2023-12-01 00:00:00', 'UN ESCRITORIO EN L COLOR BEIGE', 'TRES CAJONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Activo', 'No'),
(1413, '', '2023-12-01 00:00:00', 'PALOMERA ', 'CAFÉ Y GRIS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '2023-11-30', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Activo', 'No'),
(1414, '', '2023-12-01 00:00:00', 'PAPELERA HORIZONTAL DEL MADERA 2 MODULOS ', 'COLOR MADERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Activo', 'No'),
(1415, '', '2023-12-01 00:00:00', 'TELEFONO FIJO ', 'COLOR NEGRO INHALAMBRICO', 'KX-TGB112LAB', '1DAFDO74721', 'PASASONIC', 'EQUIPO DE OFICINA', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Activo', 'No'),
(1416, '', '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Activo', 'No'),
(1417, '', '2023-12-01 00:00:00', 'CALCULADORA', 'CALCULADORA DE IMPRESION', 'DR-120TM', '360BL29DA085618', 'CACIO', 'CONTROL', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Activo', 'No'),
(1418, '', '2023-12-01 00:00:00', 'SILLA AUXILIAR EN CUERO VISITANTE', 'COLOR NEGRO Y AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Activo', 'No'),
(1419, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'COLOR AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Activo', 'No'),
(1420, '', '2023-12-01 00:00:00', 'CAJA FUERTE', 'COLOR NEGRO Y GRIS', 'NO APLICA', '47470', 'CAJAS FUERTES ANCLAS S.A', 'EQUIPO DE OFICINA', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '0000-00-00', 1148400, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Activo', 'No'),
(1421, '', '2023-12-01 00:00:00', 'ESCRITORIO SENCILLO GEIGE CON 3 CAJONES Y LLAVE', 'PATAS GRISES EN BUEN ESTADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 1, 'Activo', 'No'),
(1422, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 1, 'Activo', 'No'),
(1423, '', '2023-12-01 00:00:00', 'DESTRUCTORA DE PAPEL', 'COLOR NEGRO', 'NO APLICA', 'SHREDDER X6', 'PELIKAN', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 102900, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1424, '', '2023-12-01 00:00:00', 'ESCRITORIO 3 CAJONES', 'MODULO COLOR BEIGE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1425, '', '2023-12-01 00:00:00', 'PORTATIL CON MOUSE Y TECLADO', 'COLOR NEGRO', 'NO APLICA', 'ZFIP00822020', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1426, '', '2023-12-01 00:00:00', 'BASE DE PORTATIL', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1427, '', '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'ARTECA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1428, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'COLOR AZUL CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1429, '', '2023-12-01 00:00:00', 'ESTANTERIA', 'ESTANTERIA METALICA COLOR GRIS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ARCHIVO FISICO', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1430, '', '2023-12-01 00:00:00', 'ESTANTERIA', 'ESTANTERIA METALICA COLOR GRIS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ARCHIVO FISICO', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1431, '', '2023-12-01 00:00:00', 'ESTANTERIA', 'ESTANTERIA METALICA COLOR GRIS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ARCHIVO FISICO', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1432, '', '2023-12-01 00:00:00', 'ESTANTERIA', 'ESTANTERIA METALICA COLOR GRIS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ARCHIVO FISICO', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1433, '', '2023-12-01 00:00:00', 'ESTANTERIA', 'COLOR GUENGUE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ARCHIVO FISICO', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1434, '', '2023-12-01 00:00:00', 'ARCHIVADOR / ESTANTERIA', 'MATERIAL DE METAL COLOR GRIS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ARCHIVO FISICO', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1435, '', '2023-12-01 00:00:00', 'ESCRITORIO', 'TRES CAJONES COLOR BEIGE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ARCHIVO FISICO', 'Ninguna', 0, '0000-00-00', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1436, '', '2023-12-01 00:00:00', 'ESCALERA 2 PUESTOS ACERO ', 'BLANCA Y NEGRO ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ARCHIVO FISICO', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1437, '', '2023-12-01 00:00:00', 'ESTANTERIA 1 DE 1X5', '', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', 'ARCHIVO FISICO', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1438, '', '2023-12-01 00:00:00', 'ESTANTERIA 2 DE 1X5', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'CRISTIAN BENABIDES', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1439, '', '2023-12-01 00:00:00', 'ESTANTERIA 3 DE 1X5', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'NO APLICA ', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1440, '', '2023-12-01 00:00:00', 'ESTANTERIA 4 DE 1X5', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1441, '', '2023-12-01 00:00:00', 'ESTANTERIA 5 DE 1X5', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1442, '', '2023-12-01 00:00:00', 'ESTANTERIA 6 DE 1X5', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'CRISTIAN BENABIDES', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1443, '', '2023-12-01 00:00:00', 'ESCRITORIO 3 CAJONES', 'MODULO COLOR BEIGE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 10, 'Activo', 'No'),
(1444, '', '2023-12-01 00:00:00', 'COMPUTADOR DE MESA, CON TECLADO Y MOUSE', 'COLOR CAFÉ, ', '195LM003', 'KOXHA1A000382', 'NOC', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 10, 'Activo', 'Si'),
(1445, '', '2023-12-01 00:00:00', 'TORRE DE COMPUTADOR', 'COLOR NEGRO', '1040-900-0091', '200SN82689', 'COMPUMAX', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 10, 'Activo', 'Si'),
(1446, '', '2023-12-01 00:00:00', 'TELEFONO FIJO', 'INHALAMBRICO', 'NO APLICA', '1DASD74657', 'PANASONIC', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 10, 'Activo', 'No'),
(1447, '', '2023-12-01 00:00:00', 'ESCRITORIO EN L SOLINOF', 'ESCRITORIO EN L - SOLINOF MADERA Y METAL GRIS, BEIGE Y CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(1448, '', '2023-12-01 00:00:00', 'DIVISIÓN METALICA, VIDRIO Y MADERA', 'DIVISIÓN EN MODULO DE 23 ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(1449, '', '2023-12-01 00:00:00', 'PAPELERA HORIZONTAL DEL MADERA 2 MODULOS ', 'PAPALERA HORIZONTAL EN  MADERA PARA COMPUTADOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(1450, '', '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1 METRO)', 'NO APLICA', 'NO APLICA', 'SUNTECA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(1451, '', '2023-12-01 00:00:00', 'ARCHIVADOR EN FORMA DE PALOMERA', 'ARCHIVADOR EN FORMA DE PALOMERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(1452, '', '2023-12-01 00:00:00', 'TELEFONO FIJO PASASONIC', 'NEGRO', 'NO APLICA', 'KXTS500LX', 'PANASONIC', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(1453, '', '2023-12-01 00:00:00', 'PANTALLA', 'DE MESA COLOR NEGRO ', 'NO APLICA', '60RBM13', 'DELL', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(1454, '', '2023-12-01 00:00:00', 'PORTATIL', 'COLOR NEGRO CON CARGADOR', 'NO APLICA', 'NO APLICA', 'LENOVO', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 1790000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(1455, '', '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(1456, '', '2023-12-01 00:00:00', 'SILLA AUXILIAR PASTA Y CUERO VISITANTE', 'NEGRA Y CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(82305, '', '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO ', 'NEGRO TODO EN 1 ARRENDADO', '82305', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP ', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 16, 'Rentado', 'Si');
INSERT INTO `activos` (`id_activo`, `cod_renta`, `fecha_asignacion`, `nombre_articulo`, `descripcion_articulo`, `modelo_articulo`, `referencia_articulo`, `marca_articulo`, `tipo_articulo`, `ip`, `windows`, `office`, `factura_office`, `lugar_articulo`, `observaciones_articulo`, `numero_factura`, `fecha_garantia`, `valor_articulo`, `condicion_articulo`, `id_proveedor_fk`, `descripcion_proveedor`, `id_usuario_fk`, `estado_activo`, `recurso_tecnologico`) VALUES
(82306, '', '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO ', 'NEGRO TODO EN 1 ARRENDADO', '82306', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 22, 'Rentado', 'Si'),
(82307, '', '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO ', 'NEGRO TODO EN 1 ARRENDADO', '82307', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 20, 'Rentado', 'Si'),
(82308, '', '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO ', 'NEGRO TODO EN 1 ARRENDADO', '82308', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP ', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 3, 'Rentado', 'Si'),
(82309, '', '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO VENTANILLA PRNINCIPAL', 'NEGRO TODO EN 1 ARRENDADO', '82309', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2019-08-09', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Rentado', 'Si'),
(82310, '', '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO ', 'NEGRO TODO EN 1 ARRENDADO', '82310', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 1, 'Rentado', 'Si'),
(82311, '', '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO ', 'NEGRO TODO EN 1 ARRENDADO', '82311', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 23, 'Rentado', 'Si'),
(82312, '', '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO ', 'NEGRO TODO EN 1 ARRENDADO', '82312', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Rentado', 'Si'),
(82313, '', '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO ', 'NEGRO TODO EN 1 ARRENDADO', '82313', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2023-05-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 28, 'Rentado', 'Si'),
(82314, '', '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO ', 'NEGRO TODO EN 1 ARRENDADO', '82314', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 18, 'Rentado', 'Si'),
(182323, '', '0000-00-00 00:00:00', 'nombre_articulo', 'descripcion_articulo', 'modelo_articulo', 'referencia_articulo', 'marca_articulo', 'tipo_articulo', 'ip', 'windows', 'office', 'factura_office', 'lugar_articulo', 'observaciones_articulo', 0, '0000-00-00', 0, 'condicion_articulo', 0, 'descripcion_proveedor', 0, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_equipos`
--

CREATE TABLE `asignacion_equipos` (
  `id_asignacion` int(11) NOT NULL,
  `fecha_asignacion` date NOT NULL,
  `estado_asignacion` enum('Activa','Inactiva') NOT NULL,
  `id_detalles_activo` int(11) NOT NULL,
  `id_ti_fk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` bigint(20) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id_cargo` int(11) NOT NULL,
  `nombre_cargo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id_cargo`, `nombre_cargo`) VALUES
(1, 'Coordinadora Tecnologia e Informatica'),
(2, 'Auxiliar Tecnologia e Informatica'),
(3, 'Auxiliar SST'),
(4, 'Coordinador SIG'),
(5, 'Auxiliar Administrativo'),
(6, 'Director Administativo'),
(7, 'Directora Operaciones'),
(8, 'Cordinador Operaciones'),
(9, 'Analista Operaciones'),
(10, 'Auxiliar Operaciones'),
(11, 'Mensajero'),
(12, 'Directora Contable'),
(13, 'Auxiliar Contable'),
(14, 'Lider Jurico'),
(15, 'Coordinador Tecnico'),
(16, 'Auxiliar de Gestion Documental'),
(18, 'Auxiliar de Monitoreo'),
(19, 'Gerente'),
(20, 'Supernumeraria'),
(21, 'Practicante SIG'),
(22, 'Jefe de Seguridad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id` int(11) NOT NULL,
  `clase` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id`, `clase`) VALUES
(1, 'controladores/plantilla.controlador.php'),
(2, 'controladores/usuarios.controlador.php'),
(7, 'controladores/utilerias.controlador.php'),
(8, 'controladores/empresa.controlador.php'),
(9, 'controladores/perfiles.controlador.php'),
(10, 'controladores/CorreoSaliente.controlador.php'),
(13, 'modelos/usuarios.modelo.php'),
(18, 'modelos/empresa.modelo.php'),
(19, 'modelos/correo.modelo.php'),
(20, 'modelos/perfiles.modelo.php'),
(22, 'modelos/bitacora.modelo.php'),
(24, 'extensiones/vendor/autoload.php'),
(28, 'controladores/clientes.controlador.php'),
(29, 'modelos/clientes.modelo.php'),
(30, 'controladores/bascula.controlador.php'),
(31, 'modelos/bascula.modelo.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text DEFAULT NULL,
  `documento` varchar(25) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `telefono` text DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `compras` int(11) DEFAULT NULL,
  `ultima_compra` datetime DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `documento`, `email`, `telefono`, `direccion`, `fecha_nacimiento`, `compras`, `ultima_compra`, `fecha`) VALUES
(21, 'PUBLICO GENERAL', '0', '', '(12) 3123-1231', 'ASD', '1900-01-01', 84, '2024-06-25 16:40:02', '2022-08-03 05:43:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracioncorreo`
--

CREATE TABLE `configuracioncorreo` (
  `correoSaliente` varchar(75) DEFAULT NULL,
  `host` varchar(30) DEFAULT NULL,
  `SMTPDebug` int(11) DEFAULT NULL,
  `SMTPAuth` tinyint(1) DEFAULT NULL,
  `Puerto` int(11) DEFAULT NULL,
  `clave` varchar(250) DEFAULT NULL,
  `SMTPSeguridad` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `configuracioncorreo`
--

INSERT INTO `configuracioncorreo` (`correoSaliente`, `host`, `SMTPDebug`, `SMTPAuth`, `Puerto`, `clave`, `SMTPSeguridad`) VALUES
('correo@asd.com', 'smtp.gmail.com', 2, 1, 465, 'CEsar1234578@', 'ssl');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosempresa`
--

CREATE TABLE `datosempresa` (
  `id` int(11) NOT NULL,
  `NombreEmpresa` varchar(500) NOT NULL,
  `DireccionEmpresa` varchar(1000) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `correoElectronico` varchar(250) NOT NULL,
  `logo` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `datosempresa`
--

INSERT INTO `datosempresa` (`id`, `NombreEmpresa`, `DireccionEmpresa`, `Telefono`, `correoElectronico`, `logo`) VALUES
(1, 'JCLEYVA SOFTWARE', 'LOS MOCHIS', '6688612348', 'JULIOCESARLEYVARODRIGUEZ@HOTMAIL.COM', 0x89504e470d0a1a0a0000000d4948445200000200000002000806000000f478d4fa000080004944415478daecdd797c54d5dd067066e6deb93377d6ecfbbe4012421242421248420224645fd94136c19d5564df3745f67d11c51d4405f705f77da9566db5b56e6db5d6b6dafab6565181e73df72216ad6d67428064e6f9e3fbf1fdbcef2b32f79ef33bcf39f7dc73bb74e9d205444444e47778118888881800888888880180888888180088888888018088888818008888888801808888881800888888880180888888180088888888018088888818008888888801808888881800888888880180888888180088888888018088888818008888881800888888880180888888180088888888018088888818008888888801808888881800888888880180888888180088888888018088888818008888888801808888881800888888880180888888180088888888018088888818008888881800888888880180888888180088888888018088888818008888888801808888881800888888880180888888180088888888018088888818008888888801808888881800888888880180888888180088888888018088888818008888881800888888880180888888180088888888018088888818008888888801808888881800888888880180888888180088888888018088888818008888888801808888881800888888880180888888180088888888018088888818008888881800888888880180888888180088c8c7180d5d10635530292604054e15b2c1c0eb42c4004044beca20b8cc120606dab127351cefe627e3deb4488c0d772354fcef8d0c02440c0044e45b4c62708fb298715974101ecf8cc6b1c2444038569080b77ac661656208725d2aac26a31e1478cd88180088a893cffa559309f962705f2d06f9f772e370bc481bfc137ee0f38244dc9a1e85d6301782f5d5005e3b22060022eaa4cffa0d0832cb680975e1b6f4487c5110ff6f03ffa9be11c1e0f9ec184c8b0d46b2aa706f00110300117536dae09da89a71494c903ea87fdb47ccfa8b12fea76385f1f85def445c9918826c87958f0488180088a8b3508c4674b75bb02c2108ef1724e2581f31b87be9cff971b8a65b042a82ec7049265e5722060022eac81c9211a581366ce91a863ff58e05fa26b4d9d77d13f1608f4834873a11acc87c4b80880180883a22a718fcab836cb8570cda5f16278a413cfeb41ded138fa77ac6e0a2d820c459cdfadb04bcd6440c0044d42136fb75419898a10f0d77e1c1cc701ced1b0714c7b79be3c2fb05719813178878abcc1040c40040441d61f08fb1c8981a1f84b78a1271b4580cfe25f167c4ef0b62b1282108690e0b2c2623af3f110300119dabc13f5a91302b3600bf2d8cc1f15231f897c69f519f9624604f8f68140539f43704781f88180088e82c928c06c48a99ff6c31f8ffae20e68c0ffca7faaa3401073223501aa0c26ae4e300220600223a4b83bf11294e15cb5243f16151ec8981b9dfd975a4240e0733c3d02fc00a0b4300110300119df9c1bfabdb86f599d1f8b45fa2188ce3ce99af4a6271b07b284a440850180288180088e8ccd076df7773dbb1a94734fea2cdc4cbe2ceb9af4ae3705756184a02ad30330410310010517b6ff83320de6ec1faee91f8b42c01288feb308e8820706f76188a03ac90190288180088a87d6867f1875b645c9516863f69cbeffd3b1e2d04dc9f138e3e2204f04b82440c0044d40e02cd1256a406e38f25b11d72f03fe9ebf2383cd4331c052204f0be11310010d16970c946ac4c0dc427a531c080b80eef1b11041ecd8b407ea08df78f88018088da36f89bb02a35001f9746e3f84031fbef24be1241e0bede31e81ae8e47d24620020226fa866094bbb06e3a34e36f89ff459792cb6f708835be6a78489180088c8632363dcf86571348e558801b513d2fede1ff78bc6d55d03e094f8660011030011fdcf1dff756136bc501881afb5d97465e7a585800fcb63b1b447141449e2fd25620020a2ff243fcc85c78ba2f09536931ed4f97d2b82c02f8aa3d01261d7cf32e03d26620020a21f8951655c9f1d82bf0d8c06aa627cc691ca18bcd82712d591dc1448c40040443fe056646cc80ac31ffb47e3d8a0189f0a009a2f2a6270675e38126c66de6f22060022d228260326c639f14e59348e6a0366b5ef392e7ed7a703a3b1233b1441168600220600226efa43bf303b5e2a8ec0d7dae05fe3bb8e8920f0878131989c1ca8871ede7f22060022bf95e65671283f0cfff4f1c1ffa4a32204fca25f34aaa35c7af8611b20620020f23b4ed984ab3383f1d7ca681cd706c85afff08df8ad0f164520d1aeb01d10310010f9d9d2bfa10b5aa39d786f40248ed5460375fee3b8f8bdffa88ac29522fc584c46b60722060022ff112766bf4f1687e35b3f1bfcbf0f01c2871551a8d4cf07607b20620020f20356b3f6ca5f30beae8d02eaa3fdda63c51188775a794810110300916f3389d96e73ac0b9f558b59b0360836f8b7630d31589619022b1f0510310010f92a6da93bd16ec6a325e17e3ff09feaf79591a888b0c36ce42a00110300910fbeefef904d98971e882feba280c668facef1c6281cea138e64a705263e0a20620020f225b298dd0e8874e01d31db8518f0d044ff128dbf8b5034232d507f3592ed85880180c86796fea35519b71485e1b818ec38e0ffb4570744a020c4c64701440c0044bec12e66b5e39303f0599d98fd3747d17f70a4310aeb72c310a94a3c2590880180a873930c06740fb0e09981311ce43df05e55246a235558f9ad00220600a2cecc6d366172aa0b5f684bff2d51f43f1c6d8ec4b5bd4390e430f36c00220600a2cebbf1af57b08a67fa8701ad51e4a13f3644e3bce40038cddc1048c40040d4095ffb0b53652ce9198aaf5a2281c1e4a9e383a3707f7924320315be1648c40040d4b9282623fa453af0665d0c07f536f85b73342e48752340e12a0011030051279afd47d9cc589d1f8e6f8744014322c94bc785fbcac2911dc4c381881800883a09b398fd9745daf17663ac18cc2280a191d4067f6b8dc2a4ae2eb8b90a40c40040d41968cffee76787e0d8f068605824b5d5d008dc5d1e81ac200bdf0820620020eae0effd1b0d280c55f1fca070318845d069fac790284c4871f28d00220600a28e2dd822617a861bdf6a03d8706a0fb79585a37ba085a70312310050c7621085f9a775e9e25fcbb6da99ff79c10a1eaf08014644503bf9a82512ad712a2c7e773ae07feb5bac3dc40040e76497bb01b249864db1c3a9ba11600f42b0231421ceb0ef053a82e15203e0b03a61315b6132fafe126e8098fd5f9211802f874771e06e47478747607d5e00121cb21f84482314b30576ab43ef3f7adf728622d4198e10471882ec2108b005e9fd4e556c9025330cdc1f410c00743a64d90cbbe284db128484c05414c5f6c7c0f82654c70dc77919d3b0a8ef566c2ebf13db4befc3cee287706df1e3b8a5ec051c18f00a0e56be81bbabdec43dd56fe1deea5fe9ff3c34e817b8bde2e7d8d7ff25dc50fa3476171dc68ebe0f6047bffbb1b5ff21ac2abb1617e5cc477dfc6854c4b7a024a152fc77bb22c01a0cbbc5019349ea74affea5b9cdb8a92418181941ed2a1cbf6c8cc2a068bb08929d6bb0d382af5d7188701884f88014148b76aeb5f7daf851989435072bfaedc196fe07b1a3e401ececf3a0de4ff6963e855bfbbf880315afe2cecad7714f95e85735bf16fdea57b86bd02f7167c5eb7abfbba9ec39ece9fb3876f67d48f4abfbb0b1fc76ccefb309a3d3278b7e3b4cefbf05b165887527c2a5048ac0eed00303eb1d3100f831b72d108901dd50105d8ef3b2a6e0e2ee8bb1bef436ec1bf4220e0ef8051eaafc2d9eaffb3fbc5aff355eadfd46f8163faf3d8ad7ea34c7f05aed31fd9faf7feff87f70e2fffefdbff3ddbf77c251f1677e7be2cfafff062f357c81872a7e8b4315bfc06d552f6179ef3db8247b119ad2c6203bbc1091ce5858cd6a873ef8a739ce868f5a2339609f01df8c88c015992e04593a6e30b488f619e98c434e7891de6e2fce5e8865bd77e340f5cb3828daf543151fe045d1ceb5f6aeb57badfd7fdfa77ed4473cee5b3fe85747f57e7aa2cf7ea3f7dfe76b3fc70315ef897efd86debfd716efc3c5190b31266b2afac6552229204d5f51605d6400203f5091d48cbd039ec4fd55efe1f1419fe085da2ff052cd97f859edd7fa40ffaa28203fd78bd2f1b3eee7a288bd5a7754ff7bbc5c73042fd77e89676b3ec7e1411fe9057447e90398d77b3386a44d4276582182eda1fa926947b8ae5136192b7a05e0d8a87060349d090f5686a377a8b5c32cd56bed2f3ba2506f8ff345bbdc5172bf989dff028f88f6aab5db9744fbd5dab1deafeace55bf3aa6ff775fad3dd1af7e56f3b5dedfb57eff64d59ff040d5fbb869e0b3e89f58cffac80040be6e76ee06bc50f3855e147eaecf1a8e7778278281285eb547f4bffbd3d57fc5c395bfc3ed037f8ef57d6fc7f93d66a124be0a416a1824937c4e96ff4b2354bc5c1fc981fa0cfaebb0088c4c3a378f01b47615a486a238be526f6febfb1e10edef35d10e7fafb747ad5d6aed536ba79da95f6975e0e5daaf302f6f13eb230300f9329b62c3aef2874487ff4614aae39dda2ba278fd4c14db17c42cebc9aabfe2a1ca0f714bff97b0ac700f86a44f4272503a24e9ec84018b64c4b85407fe39520c54e7d199726c740436150622d179769e636bed2729301dade9e76359d1b57afbd2dad953a2bd69ed4e6b7fafe8e1b4b3f7a5a3d859f660877ec4460c00749a426c91b8afe6ddef0b976f398a97eabec63335ff87c3833ec61d037f810dc50731267306d2c37a42329eb93090e494b1a53000c739489f712f3784a322facc0d545a3b490bcdc179dda78959fe9db87dc01b7878d01ff476a5b52fad9df95adff999f84d0fd67f20ea43045f316400205f15eb4ac1e1aa3fe2656dd94f747c5ff6920839cfd67e8187c5efbd7de05bd85af6801e069202d3201bdbf7d5a98a280b5e6f0c05c686d319f6e988085c9ae1845d6e9fbd1f5a3bd0da83b629566b1f5bcaee13ede54d31e8ff11cf68fb63443bf2f5bea2d583c76a3e45942381018001807c760360d7163c53ff0f51d48efa9de7eabec403951fe1d6feaf6271c16e54260e46b82306d269be6ee8321b3125c381bf8fe2e07c367c7b5e38b6140520c9757a8f014c460921f6080c4c6ac1a2debb714bff57f080b679afee9ffaa0ef6ffde3f9faaf509e52df6136d5120300b5b3e1e997e239d1d15fac3feabf1a8ee2f1dabfe28e8a5f6173c90318d7fd0a740bce866ab6b76955a0ab5bc6eebe01383a360c1847679cb8cecfd485a022daeaf5d1c0daecd62aab480dea81f3d2676063e9bdb85db483c76bfe2adac6b77edf2f86a65f0c9381df5c600020df3bbd4f0c6e17652d11339caff0822876feee79e1e9fa7fe29e41bfc535654f626acfd5c88d2c812adbbc3afab722c62afebc500ecc67d15f4686e1d20c8718cc3d9fad6acff613dd19b82c672576f57b02770ffa40bfffcfb32f7ceffcccf96774af0c3100d039629614ac1d70bb080047f05cfd37748a671b8ee081aa8f31b3f77a84db633c7e0e6a339b70b118883e1d2506a6f174b67c2b42c08ee24024bb15cfdf80911da84d3c0f0fd47c8467ebd907fe4ddd3758557e33ac661beb250300f91aab98d95e5bf90c9e1101e0596dd0a31f6af806978ad961b01aeef135d506a06d254138aa0d4c13e86c392e3c511f86fe319ebf0d609154f48f6bc123759fb1adff14110076573d01a7e2e646400600f2b93300c40c68ef8097f1b4f6aa9ce8f0f4438fd4fd0dd549a3a08aebe4e9352d8f56f144831894cea7b3ed83e16118dbcdf34381b4a5edccd0deb8bde66d1182d9de7fca75035e84cb1cc400c000403ef5fc5f74e8207b180e54fd064fd51f11bea653895074b0f63de446f4836cf26c77b9d168c488543bde1fcec1f85cf8c7d830acc8772154f5ec2d0e83c188286722d695dec3f6fe1fecab784b3f2b845f176400201fdb00981c9a81c34d7fc593a2a3d3bfdb5cf63012dc691ebf06156031616e4f27fe4fdbfd3f3194ceb2a313c270f38020f408f67c1f80db1a8ca9f96bf064c311b6f99ff050e3a7480dedc157011900c8b702801159914578b2452b7c47f004fd90181066176ed7673f9e5ed3b420057bca83f0ad36239d144a67d97111029e6a084665ace71f0752653bea52c7e191fabfb3cdff04ad3ee44695ea6724b06e3200908fd0127d7658319e683a82c7ebe9c71ea9ff0786664c8643717bfefc3fc68ac71a42709c83f139f3c1c8505c94e9d0bfc5e0c93dd31eefe44494e0eefa3fb0ddff04ad3ef48ae80f9381018001807c2a00e4850fc063a293d3bfbbafe1cfe813530d45b2783690180d18ddd586b7878770203e873e1f1f86e5056e0459250ffb8109f1015db1a7e225b6fb9fd27004bd232a18001800c8b7028009e509da2b505fe1d17afab19babdf447a681e240f973e5d8a09b37a3af097b16220ba80ce95231343716d7900ba067abe0f20c0128a55a577b2ddff844784fe09437818100300f912ed995e53f7f3f1b0080087ebe9c7d6973d84707b9cc7af3fc5bbccd85ce2c6571343800b43e91c3adc108c7e5e9c076037bb7149de556cf73f41ab0fa372a7c36c5258371900c857482619a37a4dc743b55fe2a17afab1d945bb11600df5f87ae6475871a83618c72f1283d04521740efd7c58088676f5fc3c00ed40a0aaa4d178a8e10bb6fd1f13f5616ae95a586495759301807c29009c5fb4000f8a0efe603dfd40c397189a3e0d36b3cbc3372abaa03a41c5b3adc11c803b804fc6876266aecb8b8d800af26306e260fd276cfb3f26eac39cf25dfaa9a1ac9b0c00e44301e092d295b8bfee9f78a0814e755fd3df3130798498f5d83c1c400c98d4c389f7b5f7ff2f0ea173ecf389215855e442a0171b01e302ba61efa037d9fe7f4cd4870565d7ebaf4bb26e3200908fd05e7f9adcef6adc273af8fd0d74aa03751f212f6680feb1244f3f0034ab97037f992006a04be85cfbf69250dc581988140f37026a876285d963b0bdea79dcc7f6ff03f7d5ff13f34b6f8095018001807c2b004c295b8b7bebbe10458f4eb567d01b8877a7eb33434fae65a85dc655c501f887b609edd210ea000ed5062027ccc300d0c5a09f08b8acec00eead67fb3f95763de6953000300090cf0580a9e5eb708f0800f736d049f78882b7b3fa65443993f4d3123db9965d0365dc38c88de397310074148fb7066340bce7cfadad921d13b296b30ffc447f9857cc00c000403e1800d6e3aeba7fe0ee06fa5efd3fb06ae03d08714479fc01941ea10a6eab0910012018a00ee1ed31c1189f69f7f81e5a241b4667cfc5dd8dec033fee0f73fb3200300090ef3d02285f87432200dcd540271d122ec8b95a7f37dcd36b3930c989278685019339f07614ef8c09c2a41e36183d7c155091ac68cdb914071b3f673f38b53f880030a7f87a5818001800c8b702c065656b7067dddf71b0814e755ed662d864a7c71bc84667d8f0abb162e099421dc58713437079be4b0c5c9eede3d04ebacb892cc3adb51fb30f9caafeef985db297018001807c2d005cd2ef4a3d00dcd940271d6c1401a0d702d8cc9e078031192a7e3d3688036f07f2e5e4306c1b188430bb6747d86a67dda704e6e2fa9a0fd80f4ea50580d2bd7c04c00040be760ec0c4e225b8bdeeff7047039d747be35fd1daf35258cd768f03c0581100ded602c0d460ea208e5c168c9d031c88b479b691533b1a3b253807d7d7bfcf7e706a7f10f56156f9b50c000c00e46b016074e16cdc263af881063ae9869a8f901359aeaf9078b47bdc2c63464100fea0bd02382d883a88239383b06b801d91764f038009c9a13db0b7f95df6835368f56146ffed3c099001807c2b004868c9bd14fbeb3fc76d0d74d275d5efa35b70a1c75f3fd3ce00583f3008ff9c1a7e62f0994e1dc1912922000cf43c00689fc78e0a4ac48ec6d7d80f4eb1bfee735c547a2514d9cabac90040bef439e0411963b14f0480fd0da4d9275c5bfb1ed2420b3c0e0061aa111bcb6cf8720a07dd8ee4e8f460dcde1c82ee119e2f5ddb151716f7bb4f6f07ec0fdff50911005a722e8359b2b06e320090ef0400230ae3ea716bfddf706b039db4a7e15d740bcb6f5b0098411dc6e5c178fabc0854a47afe3aa722d930abf036f6831f298cad87c9c3fe400c00d40968a7dc658697e096a6bfe196063a694ff33be816de4b04008901a0530bc673a3825093ac7a110054cc28bc99fde054a23e648597eb6f49b06e3200900f05808cf022dcdaf237dcdcf857faceeed6df2035a2a7be2bdca300601301a05c0480a9daac933a929746bbd19062f12a005cdee726f6835368f5212bb21f03000300f95a00488fee8d5b87fe0d378a8e4e27ec6e7d1bc9e1d91e078070110036f51701605a2030933a9297ce73a331d5cb00507223fbc1296e19fa576446f7d1df9260dd6400209f090006c48775c375ad1fe186c6cf48b85ed8d1fa6b1100b23c0e00117623b60cb4e1c8740eb8be10006694dec8be708addcd1f202ea49bbe6788759301807c86012e6b10d654bd2206be4ff5c1cfdfed15b6b6be89c4b0ee1ecf78a29c12b6573a7064861874aea08ea44d01a0df8dec0ba7b8aae205b8ada1fa279359331900c88768a77b2daf781cd735fc05d78910409f626b8b0800e15e0400978ced554e7c7db91874665147f2d218ef03c0f4b21b4410643fd0357c8a65958fc1ae043000300090afb198552cadbd1f7b1afe8c6b45872711005adf1201a087c78f00221d266c1be4c0d7338380d981d481bc34d6fb0030addf0dfae0c7be208800b0b8ee1ed81497be62c89ac900403e441be4c6155e8d5d0d9f604fe35f48d82202407284777b00b656da70e48a00600e7518b303440070a1b1ab7701606ae90dec07dfb94618d37b15cc92c27ac90040bea83673327635fe11bb45672711005a7e8d94881cafde02d85ca1e2ab991c743b9a130140f12a004c29be5e1ff8d817440068fa0b6aba5fe6715f200600ea64ca32466067e31f4408f833099bb500109eebdd390003557ca90580b9d491bc2002405d8a7701e0b23e3788c18ffd40b3bbf94f284b1fa11f1bce5ac900403e283532171bebde1121e04fc29ffdda0e61639316007a7917002a4400d01e01cca38e2310cf8d0f444d57ef4e02bcace866bfef07276d6ef840f4859efa9921ac950c00e483821dd15853ff3ab68b00b0e3bb41d09fad6f781b2961791e9f7dfe7d0098c541b723392e02c0e131c1284e7478f52d80297df7b31fe8fe84754d6f22c81ec937001800c857d92c2ecca9b80f5b1b3fd64380bf5b5bf76b2487e47b1e00ec266c1ce4c097dacef3f901d4417c33371037b7b89112e2d92300ed602cb73d04f32a1e643f10b6357ea2d7055571b04e3200902fbf0930a1ef666c6af8105b9b3ef17b6b6adf466a68a1c701204095b1626000fe362b1858e0a60ee2c85c3776d5daf4d7343dfa3aa6d188e8e0645cd9f4331186d90f368b09c1843e9b7902200300f9ba9aaccbb0bee177d8223abebf5bd7f03e7a25d642f6f0fbe78a6cc265850efc4efb16c04237751047e6890050a78a0060f43000989010968935cd6fb21f081b1b3f424df664d6470600f2753de2fa636de37bd8dcf447e113bfb6b1e90fa8cab91016b3cde3a5e3b13956bc7d2907dd8ee4ab7901d851e74084c72b00121242b2b1bae12dbfef035a1dd8d0f43b64c5f6677d6400205f17ee4ec4e29a1745a7ff831800ffe8d73635ff114dbd66c36a767a1c00c6e4a8f835034087f2d9ac40aca870c16d953c7e14961a5e88abeadff6fb3eb0b1e963acac7f1d5181a9ac8f0c00e4f3df04501c98d2ff0eac6dfc5084803ffa372d00e42cf43800685a32ed78e5a22060919b3a88f7a706e092023b2493672b00b2494151d766ac69fcaddff781758d1fe1f2ca7b61b7ba591f1900c8d7492619a3faacc1ea860fb05e14007fb64e1855b001764b90c7d7af2841c5fd630281c56eea207e33d98df37b59f5151acff672a8a8cb9b8cf52d1ffb7d1fb8bae17718dd772d4c269e00c800403e4f2b9245a943b1a2ee5758dbf407e163ffd5f8316654dd852047b4c783477a988c5b8738705c1b7c96b8a80378fdd2000ccfb679dc07b44380eab367615df3c7feddfe45ff5f55ff1b14751dcadac80040fe2229a22716d4bc80ab9b3ec41a5104fc56e31f30bfee6984b9923c3e012d3958c69e6627be6500e8300e8f0f404992e701c06a766070af95feddf685ab9b3ec2a2da979114d99375910180fc85430dc2a5030ee0cac60f4411f8835f9b57f53ca20233f457c33cb9768136194b2b1cf87cbe08004b5d748e1d170e0c77a07bb8d9e31530972d14932b6fc3d58dfeddf6af6afc1da60c3c0887358875910180fc671f8084e6fc255856ff36568b59803f5bd6f016bac79643f6f033a88a64c494222b3ebe82836f47f0cd6237ae6d712231c8d3006044b0331673ea9ec0ea46ff6efb2b1ade416bfe327e01900180fc4d7e6a1316d4be8a2b9b3ec455a218f8abd52d1fa2a8eb0828b2cdc3f064c0d85e76fc664620b0cc45e7d867f3dc583cd00e87c5d333004c880a4cc39c9a17fcbadd6bfd7e71dd1be89dd2c27ac80040fe2622300533063d82954dbfc32a5110fc56f347189079a957af02962559f0c80431002da773edc3592e4ce9a3c22c79b689535be9c94e1c8415cdeffa75bbd7fafd15d54f8a3a90cc7ac80040fe4696cd18dd773b9634fc4614830ffddad8b2ed70aaa19eaf9ec49a7170b413c7963b8115742e3d779113b56916183cbc7766494561ca48ac6af1ef36bfb4e15d9c57bc4b042233eb210300f9a392f4f19857fb1a568882e0cf2e28bf1d01b668714d3c9b45863b255c5965c3178b39009f4bc785fbc73ad027def3414c555c682a58ecf76d7e7eed1be89b368675900180fc557c4436a60e7a144b9b7f8b65cdbff75b731b5f425244be7e489227d7cd6535614eb9039f2d0a00563ae91cf972a9135b9aec880bf43c0038ac219838e016bf6eef5a7f9f51f52412c2b358071900c85f296615e3caafc7c2a6df88a2f07bbfb5b0f9d7c888a9f0f8ab809aa6ee0a5e9b2206a25574aefc6db10b4b2a6c08503ddc006830213c200553aa0ffb777b6f7a071306dc0445b6b20e320090cf3078ffeff4eb311157d4bd82c5cdbff35f2def6350de54d8ad019e5fb71415872f08c4716d30ba92ce3a71dd7f31cd8921598ac7f74c3299911a5582052d6ff9757b9f55f79ae8f7179c95fa420c0074168ef735296698035d906cdea5fa98d0eeb8b8f241310bfe008b4471f0475a516c295c0b972ddcf3c72781266c6e54f1ed4a0ec6e7c23111000e4f72a12cc5f3551b8bd98ebe1963b0a0e93dbf6deb5a3fbfacf211448774f7eeec10d50a73901b468b085c1e1e9b4d0c007426077e5982393c188e8ade702d9d08dbce99700e19e0f1b9f6faae6859c1d0be1b31a7f12d511c7eeb971634fd1693eb1e1045d1f313016d1609534a6cf84cdb08789583ceb26f4500d8d1aa2229d8f3436cb48f3e3515aec2c296dffa6d5b9fdbf82b0c2fd90a5956bc9a6038069743dd71391ccb26c25e59087344088c320f106200a0b3ce685560cd4884ebfc7ad8b7cf807ce73274b96b394cb72f817dc138480e9b577f5eefb4a1985af32ce68b02e1afa6d7691b01fbeacbc49e16c5c1d956fc66b61b58eda0b3ecd3254ecce8a742554c1ede2f2342039230a9ea0ecc6ff2df763eade679e4751becddec5fd413fb9cf3201d58a2d71949d41b87080301931aa16626c364b5b02e3300d09966b28b82979f01c78ce1b05e3b1ba63b97c2709718fcef5ea13388ce69de3a0db68c24affedc205714c60db80d739bdfc5bce60ffcd2fc96f750943e1656c5e5f175cb8b537068bc13b8da4167d9db730230a2970aa387ab5d26938c84b07c4cab7bde6fdbb8d6bfcf1f781081ce48afea839a9e0865d314bdbe9c5a6bb4fa63b96e0e1c3347422de80e9343659d6600a0765de6371af5676ff6f25eb0cf1b03f375b361bc63c90f3ae3a9a41be7c1a13d06301a3d5f5110b3a38adc2b30bdfe1551243ef04b739a3e4043d14ab8ed9e17c730a784a555361c5965e7a07c161d5fedc0a17176e4c779fefa9ff6fc3fbfdb70cc6b7dc76fdbf88cfa9fa32a6faec75fbe3c597f6c2de590ae9ff393f546ab43c63b96c2bc770eec0bc6c23e200fe660b757f5871800e8273a9e253408ce4185b02f1cf73f07fe938cb72f816dd178af1f03c447f4c4f915f76176f37bc2fb7e69dc80db111690e67181349b0c1895abe0b7f35c1c98cfa223ab1c583ac88a60bbc9c3f66dd0377836142df7dbb6adf5eb0b063da4f773af4e0c75daa18a815d7bbcf8dfeace8920b044af535abd725616400909f46a3f12310090e830b2db097bff3cd8e78f8572ed2cbdf3fdaf81ff5f1d7105ccd7cc849ad3d5bb3301645514c8d598def03a668982e18f6636bf8eae3162b6e3e19701b5e3674b92153c7a8908006becc05a079d05efcc756284085eda87993c7dfe1fe24ac698fefbfdb66dcf6878038d456b6196bd5ba6b766a7c2bc73865e573cab3f27f622297b66c1366f0c6c65b9905c76be39c00040fffb551b0b6c859950af1801f3ee99301d58ecf1c07f2ad3fe85705cd00883c98ba53e314b4a8fafc0c4ca877085982df8a777d13773126c5e9c07101f246343b31dc7d66883939dceb0e32268dd35c186def1b2e7fdca644652641f4c6ffeb9dfb6ed0baa1e41f784411e1f77add7044982f3c22648fb167a5d83f42020ea97bceb72a83347e875cddb57948901c06f66fdb6eec9b05fd20c65cb54986e5bd4a681fffbce776839ac5ba641090bf4eaefe1b0056170e936cc687e0b978ba2e18f1afb6c40a033def31992d984f38b547ca69d4fbfce4e67d837573b70659d8a48b7c9e37ba45adce8db63122e6f79d72fdbb4d69f87f4db09bbea5d3d50c28260dd3805c643a7518bb420b07f11cc5ba7c27e592b6c99fcfa2003007d3ff05b2343611f361096351743ba75813e78b7b5b3fd6033e0cdf3e1a82af4ea199cd168445eb7619854fda8281aeffaa50beb1e476c58bec7e70168d7b730c18c072f7470803e0b3e5aecc0e83c33644f97ffc58c37d01987e6e22d7edba62fa8790279e923bcdbfca7bdfb5fd347df54dc1ef548ab6bd2ad0b459dbb04b6e1a2de89bac7c7020c00fefb4a9fb6dc5fde0beac27190f7ce81f1e0b276e968df6f06bc73296ccb27e98f15bcf97bb9ed11682ed98e6962d6305d148fe92dfe655acb9bc84b1b09abc5e9f1350b779ab0b8ca8aa3da20b59ecea4bb26da90172779116a2511e8f244b07bd23fdb73f3af30b8df35703ba2bc7b1c6955605b3241dfe1dfae7549d439f9fab9b02e1eafef7332a93c438001c09f76f79b4cb0a625c036a9e1c4727f3b77b0ef13b76016e9dd5990e9dd21436296d0abdb484ca87e540c86eff8a5eaa295faacd1e39dd262363a3847c11f973b810d763a43be11016b6e85154136cf97ffad169798fd9e8769ad6ff9655b3ebfe671e48bdfefe98ad6f7a726f6eeaeefe8f774f39fd7fb94ee5c0665eb34d82f6a14f530deabfd4ac400d02997fbcd014ea85585b02e3f1ff2cd0b4eeb39bf479d4c840bf7e523613479d7f9830312d1d0770b2e6dfe25a68822e26fc656df8bd8f03caf8a66cf5833eeb9c8056cb4d119f2ee22171ab32c30193d5d3a3620c8158f86d2f57ed98e2f13fdb7a9643b42447ff66a75529644dd18f13f5ffd3bed498aa87ff2ad0b605d3111d64105fadb4f7c2cc000e07b47f74a62d69f9e08dbc54d50b64f87a99d97fbff5b07b3ee99056b9297cb7f9282dcb4511857fd3026b7fcc6ef5cd6f20672ba0e834571781e9a1c26cc18a0e21f57db39589f21d78db6232dc2f3ddff269384f8c8429c5ff7885fb6e3f1358f203f638cc7c75b7fbf69323906d6dd579cf109cabf1e0b2c8759d445dbc5cdb0883a6934cb1c3718007ce3f3bc26bb158e01f9b02e190f79dfc233b6a4f61f3bd71d4be13cbfdecb646d40686032eafaaec7c5cdaf8b01f1377e452b9ed57dae4290dbf39993f64e7aff6e0a5e9ded0236d9a89dfd75b513938a455fb278be54acedfecf1303e0a52d6ffa5d1bd6fa6d43c9268405a578f7ea9fa813ce0975fa2b7c67b34e698f2ce5fd8b60593a1ef6aa22189d36ae06300074f2237c63c2601d3110d6add3da7d939f57ab00bb6642890af57a152033a5112307dd2d0ae8db7e677cfda3488c2ef1ea31406288844d43ecf8768318b436537b7a64b2037d92cd5e2cff7741b03b198dfdb6fa65fb1d35e85ef44869812c295ef57b253a1416311b6fafb791bc9eb01c5a26fefb33a08cae84392e42df33c5f18401a0732df92b66a83dbbc13a6d88be11cf700e3ad28ff702b846547abd17c0e5884479de424c6c7809178ba2e2575adf42efcc0b61b306797cbd6c8a01837b9af1c11231686da1f6f2d50607e6575b11ee3279b12263464a6c7f4c6c7cceefdaeec4c697d13f5ff4792f77fe6bf5c13ea202c6b33cfbff4fdf34b1ce180a35378d5f1b6400e83cb37e29c0094b792eec2b269eb11dfe6d5905b06f9b014b74b857cb6adaec3739b60cadfd6fc6452d6ff95511bd4868ea7f0dc283bb7bb17cda05e99112f64f7470e06e47bf5ce84255770566c9f3b6ebb487a32477860872bff6b376fb16060fdc8794b8015eeffcb7c446c0ba79ea399bfdff5b0810f5d3b6721294817990025dfcc0100340c77ebd4f8e0e853a7c20cc9b26c37857c7e844df7726ed1bde4307c0204b5efd2e9b3510053d2ec5d8ba277161cbaffdcaf8c667919edc0859f6fc08d3009b0917f5b3e3f3b54e0edeede0dbcd2a360eb1e98f57b480e5e98156d1e1bd3074d07ebf6bb3e3ea9f469feca9b0ab415e4f5e1cc32b209de19dff5e3f12b86b05e4cd53f447a992a8af06898f0418003ae092bf252311d60b1ba1b4d3c9596782ba690accd161e8e2c57354ed24b5a8d01cd4946cc5c4963730491419fff126ca0b1623d0edf9d1c0da33eadc78330e4f130160ab4aa7e9edc52a6a7b48b0c89eb7598be24456b71198d0fc33bf6aaf5affacebb743849f9e7abff5e61565253204aa98fd77e960139793b447a9ca850d50ba27c2685138ee30007490c15fb540c94b837dde18c8079674d8c1ffe45e00edd861a3c5bbd782cc6615995d876258f5bd38bfe52d51687ee53786551f42624c3faf965383ec464c1960c5e7ebc42c769b4a6df4cd16155b865991106cd4bfbce8e91b2c2181a9a82c5eeb676df52dd156ef17c167b8de5fbd9dc038445dd00ee7e9c8f54b3ab018b6f963a0e4a7c3c80f0b31009cdbe7fd0648814e58fbf782b2fcfcb3f66eff69af02ec9c096bb704af77d7ba1cd1e8933b1b631a5e1085f5577e637cf3abc8ef7131ec6ab0e71bd08cdac140121e9966c3716d30db4e6df1de72154d39667d73a5376fafa4240cc2c8bac37ed54ec734be80e25ef3e076c678bdf46fed1a0fdbae999da27e6975d62ceaad75402f48412ebd0e733c620038bb44a33385b8a13696e89beb0c9da0e37cdf81ee5a01d7c5ad90dc0eaf36046aef07c74616a0a6df2e8c6b7e1de3c58cc35fd4f7bf16d111795e7d5829d066c4e4fe16fcdf7a1b07f336f866ab8adda32c480e357afcecffd4a03abee50dbf699f5a7fac2dbb0671517dbc6aa35aff37396c705cd82ceac2f24e53c3b44dcd3651776d4dfd60d2be78cacd810c00676fb39f11c6f040c82da5b088d4dc9906ff93ac7be7c09a9f018397276e6927e365761d8621d5f7635ccb9bc25b7e6174d373c84a1fa33f5bf66615203b56c293331d38be430c6ae495f756a868cc9660337b3ea0994c32e263faa1b9f20ebf699b5a3f1c52f3007aa48d84c58b0f58e9b54c96a0f64a83e5ba399dae866975d7b27b16cc43ca618c0842177e4b8001e08c3fef171dc61c1b0ef3c80a18af99d9e93acdbf76d62e877de648487a7af66e092dd01d87e2fcb962507c116345f1f10fbf4465e9168487657935c372db8c985261c7e79becc04e2b79e8dbed2ab68fb22236d09b67ff5de07444a0a0e7749cd7fcaadfb4cd514d2fa0a4f77c04052478fd6d1229c40de7ac511dee8d25af6ad99e2b208d1c0829364cafcf1ca71800ce184b4c185c173442b97941a7ed302729fb17c33a305fdfc4e8d5ac41140e6d39bcaa7c274637bf8631ad6ffa85610d8f23336d14142fbe0fa0bd11d02d42c6bd531c38ba8303bba7debfd28141990a2cdecefe63fba1b1f25671bf7ee9176d7274cb6b7a3f8c8eccf76ee95f9bcc5814a8dafea5fd8b3b7d2d936e9c0bc7c54db0c447729c620038736cc5d970ed9ed5e93bcc49b6d517c19c12e3f5bbb526931989719568ac3a88d1adbfc079a2e0fabad1adafa37ff17a8485667a556c5531880dce53f0c95a31b8eda2ffe5abad56ac1fe142b8dbbbd99cd3118edeb95331b2e52571affca13dbe81a6ea43484eac862499bd7e8c292746c1befa629fa9658e1b17c05659c0718a01e0ccd1de41b52e9bd8299ffbff64723eb81cf671353005b9bcfef086dd16829c1e1331b4e1298c1205c91fb4d61f4646b711309b6d5e9d0e181560c4be0b551cdba502bbadf41f1c175e5da8a220d9bb53ff8c46097131c5a8adbc11a306ffc22fdae2d0c6a7909b75211cf650af97fe4d010ed8c754ebfddf17ea98568fadab2e84929dca718a01e0ccd176ce5b465640ee24affc79b421f0ba39b01476f7fa6c00fd7df7c06494f6598ae12d3fc34851947cdd88d6d7d1af782d424332bc5a055064036a72547cbcce0e5c63a5ffe08b6d2a66d7aa70abde86d150f4ca998c61cd2f887be4fbed50eb6f25a2df050725b7e9d0326b4177a87be7f84c0dd3eab1f5bc4127de6ce238c5007026df00b0146542dd365d343c1f49cfda86c045e32127447a7dd6b676384e586836faf7db8ae1adaf89e2fb0b9f365c68ae7f04ddd3477b7dd88a4b35e2ca21567cabad0270b0ff37c78547afb0233552f1ea8b7f068311b162f65f5571a3cfb7bf136df0350c28db8688f09efaca87b7effccbb1e1702c1e2f66cdcb7d24002c87ba7d3aacc559fc560003c099274786c07a49e77a6ff67f9e0d706839acc306e84b835eaf8a480a12e2fba3a9fe2e0c15c56958eb1b3eee3594976e4278580faf56018cc62e480e97f1ebab5cc01e0bfdc8dfb6aaa8cf317b75e4af3efbb787a157ee0c0c6979d1e7db9ed6bf1aeb0e89fe3640ef77def65593cb0e75487fd1df7d670553abc396cb5af4efb0707c6200380baf02cab094f7827ae37c9fe9441acb8df3602ef0fe6c007d895b712025a5110d750f63885ea87c97f6fb9a1a1f43568f895ebd11a087479301238bacf86aa7ca41ff14c7762bd835c101b7cde4f50a54424205aa07ed17f7e6759f6f778df587d12db5d5abf3284e7de7dfdcab1b2c372df0a9ba65bd611e2c15f930b6a16e112f40db360326c7c03e7faccf6c063cb991c6bdee32285d63bdde10a8b15a03d1a3c7780c6e7d51785d142c5ff61a06f4df89e8a85e5ebf7ee5b09a70cb85561cbf4e0c7ea4fbfd062752222c6240f776f61f81fcbc39686d79c9a7db9cf6db5a5b5e408fccf3a15a83bc1ffcc575b5a4c42260dd64fd919f2fd52c9ba8c34a6a2cc7250680b3b80a6051601ed41be6db16fb549ad68fd8bca8097278501bae8b010e47248a0ae78882f52a5ab5a2e5c35a9a9f436ecfe95eaf02686f05748d34e3934d168600e1d8752a8614daf5d511ef66ff125252ea515373500c8ebeddd6b4fed4b7cf02b85c317a3ff3fab1656800ec173488febdcca7ea9579ff6298ab0bf975400680b34c147139391aeac2713eb50aa077aadb97c0525b04531bbeb6a5cd86b559595efe3c3435bf82663153f6651595fb909058a16f44f3f65a4d2877e2cb5d0ab0d7e2d7ae9b648359f2be0f0605a5a06ff15ab40cf6ed36a6f5a3debd17c1e98cf17ab5e9fbaf9556e4c3dcc1bf54da96d9bfba681cccfa8a25c7240680b34c1b202dd54530ef5be4531d4b63df3d4b3ff4c8d486e76ada60e870c6a2a068259a5a7c3d04bc8c3ec557c2ed8ef1fe31926cc0bec96e7cb3478480ebfdcff1eb14bc79950d0961b2571ffbd167b4b215993dce477de3a3be3df8b7bc8ac2a25562e69fd0a690a9f55fb54f0fd8ae99e573354a9bfd5bea8b61b2ab1c8f1800cec517018d905363615d32018643cbd1e5ae153ec3a0bd57bb602ccc69f16d7ab546db9ce57627a2b46c031a4408686cfdb9cfaaaebb1fe9ddcfd38fa2f5f63aa547cb786da51d47b5d9f00d8adf382e02c067dbcc185b66f7ea95bf93ab4c31b17d513e70afb8feaffa6cbbd2fa4d71e97a0404a678fdbadfc957fecc5a7d9a3746f4671fab4fa2deaacb268afa94c057ff1800cee12a80d3066b5d31ccb72e419743ab7c8a7cdb52d82f1d0c2536bc6dfb2444d10a0eee868aaa3d6818fcaaf0739f54dffa3394f6df8588c89edebf4269326054890d1f6bfb01aef79f00f0d51e056b46da6053bc5fd2b63b42915fb8080dadcffb6c9bd2fa4b45f5b50809ebdea660a9af30c546c079d910c80796fa5e6dba55ccfe1b4bf5d71a390e31009cbb8381b455809458d8964c12295b344e1fa2fd1e69ef7c588657400a0e685b40329911169e8981a298d589a2e6ab6a9a9f426eefb9b058dd5e5f2387c58075e7d9f0f7dd16e046c5e71db94ec1c16916c4874a6d5a59ea9a3e0c157577fb747baaa8d92b02654e9bdef5d78365901b96c103205f3fdf27eb9275e92498bbc573f6cf00d0015601ec2aac554530dfbc4434d02b7dcb9da2b3ed9c037b4329e436a66d2d040487a66340f535a86df5d5a2fd0a06d61e446afae0362dd726859970db642bfeb9c7b707ffa3d72b78eb2a0b4ad365988cdeb7a5f0889e28eebf0375ad2ffb643bd2fa47f9a05d080defd1f6c1df6987bda618d61db361b87395cfd524f32d4b61a9ed0b93c3c6f18701a063ac0298e323e1983b1ec63b4423bde32a9f623cb00acad5532097f484a10ddf0b38f9a9d6e0903494556e43cde09f09aff89cead617d0a77c9bbe6cebf5f511836179a68a5757a9f8e6060b70b3e2738edd64c1ef37ab18d5d70cabd9fba57fd516889e057351d5fc844fb61f4d59e50e3d2c6ba1b94db5483143ee930de5aac97abff5b95a24eaab7dde789813a339fb6700e840ab00aa15b6b27c58f72ef1b94ea731ec5b01f3d20ba11464ea2721b6754f4060702a7a15adc0a0961751250a9eafa9687a0cd9bd67c162f1fea4369bc58861456286bcc682a3da8cf966b3cf382e7cb653c19a511604d94d6d08901252d287a0bcf64e719d5ff6bdb6d3fa327af5592542727a9b9ff91bf593fe32605e7c010cb7aef0c93a64bd7e31d4febddbf48a3231009cd95580a830d8a78e82e98068acb7aff639c69bb58f065d087b7e0f9824a98d21c004872b01d905f331a8f5590c1afc33e1151ff232ca6aef40725a4b9b5edb72d98c5838d8868fb759f441d35702c0e77b145c73818ac43093d7affc69c222b25154be15952dcffb587bd1dafff3e859b4184e57629b1e1fe9fd4af4477bcf0c38e64f82e9e615be597f6ebb0af669a3618e09e7ec9f01a0039e0ea898611109dcb27301ba1cb8da27c937ad80fd8af1b06624b7e9b8e093e704385db1c82dbc1c152d8fa1520c9a95a210fa8a8a966751d87f3b42c5a0d596eba36d8e5b37da8c4fb69f9839e396ceedc8f50a9e5868457e8a02631b067fab1a2402e35c0c687ad4a7dac989b6f224728b66c2e98e6f53603c71289901d66e8970cc180bf9c6153e5b7bac3b17c2d2bb875e6739de300074c0d3010d90025db08f6d84699f48adb7adf149d275cb60be68184c71916d5f3111d7cae98a4252fa08f4abbb0b035b5f44850802bea27fd363c8295a04d5eefd17cab4413235c284fdd3edf8bb765ceeade64eebab1bcc787ab11983b22528b2f7039c6cb6a25bd658d146ee16d7f5259f691f5a7b2fabbf072919a3c5e01fd5a613febe6f2fd1e190270dd6fba5afd61cad9edac6359d781be934ae1531009cd947019209e6d478d8ae9c01c37ed178f7aff5416b60d8b518c6092d3044879fd6f5522c6e24766b4269cdcd18d0fa1c0688e2e81b5e42bf867b91963d0166b3da861060406986190fcf53f0a51844b1aff3397a8b82d7af56d1dc5b69d3a63fed7151645c298a2aaf176de379df691ba29d9754df8c24d1ee156bc0e9ad3a4685c138b601869d8bf47ee98bf546aba3ea553360ee9628eaabc4718601a0833f0a502db05796c0bc7715baec5bebb30c3b16411edb04f9b4438013d1f1fd9057b60ee5cd8feb83677f5f2006adbe55b78841ac4c1fccbcbd2e16d980ea9e120ecf37e39f5a08d8df791c13b3ff77375930a3deaa7ffdb02dab6981a1ddd0ab740dca9a9ff489f6a0b5ebf29627d1bb7c831e6c148be3b4fa8d24067ff3e80618b72ff4e93a63be6e25d4aa1218b9f18f01a0736c0834400e0d866dfa04186e5d872e3eca70eb5a48db164319db0c5374c4692dcd99243382c3b391d1eb7294d4dd83f2c12f082f757a652d4fa157d946048565b4e92b6edaccb936d784c7172938a2bd4eb75feef08eed93f1fe663316b6ca880e36b5a93dd89de1c82cb802fd9a0e8bc1f3451f680b2fa0a4e13e74cf9f85d0c89e6ddee9fffda3c6a87028a31b216d5da4f7439fad31fbd6c136633ce488106efc6300e84421409660cdc980b249a4f35bd6fb2cc32deb601221401ad30c436c24ba184fe359a6e8e076672c527b8c4541e5f5e8d7f234cab441b4932b6d7e0c3d0ae78bdfd6b667bdaa62c0b8fe2a5e5ba3e2a8b6bc7e9bdc616983ff7b9b652c19222121b46d055b9655a4668d4571fddde2fabdd0f9ef7fcb3328187413ba664d80dd15dfa6d5a07f7d7fc400434c04246df0dfb248ef7fbe5b5fd6c1b27921acbd326130cb1c5718003adbd70255a82d5590f65e8d2e376ff06122086c5902e3d8569812634e3ba9abf66044c657a067e91a94341f463f3108948a5960e7f502fa36dc8fb4dc8b6056da769a6244a08c994d2a7eb5d18aa3da32fb01b9c3392666ffef8a99ff92a11292c28c6d5e098a49ae4461f52d286d7dae53dff77e4249f323e859b61e518955b0d9434e6f526132424a888149846de3e6c530dcb4dea7eb8a56376dadd590b413ffb8f18f01a0539e0d101e0afbec4b60bc69836f87801bd7c3b87519cc9346c09296a2bf977c5acf372505c1113948cb9b8a829a7d28697d1a259d742028d13d8fbef587109352af0f725eb725212e54c2dc164584004584808e35f81f17dedf66c6b2e13292c28dfadfd7fbfb6e4048542ef22a76e8f7bbb433df6ff1f72facd98ff4bce90889cc85249fdef36bad3f5945bf5244ff326d5daaf7375fae2706512fedb32f8639328c4bff0c009dfbad005b6e162ceb16a18b16027cd98d22b5ef5c05dbd4f361cbe9dee613034f7d55d0ee8a466cd7266497ad439fc687502c06d26251603ba7e7905f758398e1f66bd332b076808eb6ac3eb7c58cb7b410705bc7580938769b8c0fb62b583dc6826e51529b0efad10f410a4a4256e94af46d7d12c5435ee8a4f7f805f4697a58b4d70d88ebd60c8768bf86d39cbd6afd48ed910efbe4099076acd2fb99afd71265fd22a879d9faa3548e230c009dfc802005b6c62ac8d75c2d3aef469f6610e46bd688f47e29cc3999a2039ffeb33bd96c4370642fa4f69a82bcea9bd077f093e82306084ddf4ee759f4aed9055770b73686a22e880f33628e1602365970f4800801b7cbe7cc311100ded92263e528051971da077eda36d83903a29051340745ad8f75ba7b7ab22df611ed32affa6674cd9b8690a87cbddd9ef604c22c43c9ee0efbcc8b21efbe5aef5fbe5e43b43a696bae8651e5ae7f06009f3820a80ba400376cd32f80f1baf5e872c326d1d07d98f87da63d6ba1cc9d02393f0792ddd62e8f53544718a2536bd1a374157a37dc258aeeb3283ab500770acfa368f033482b5a02873ba64d6f06e82120d48439ad16fc6a8b15476f1721e00ee9ac3b76bb8477b64a583a5c424aa4b1cd337f49b6212dff1231803e26eee7f39dea7e9e687f22d435dc2ddae5958849ad17ed34e2f436fa9dbc2ea2df28f93d619933192611aa7dbe6e08c6bd1b609b36097270109ffb3300f8d629816a46375857ce8561ef8941d2d719ae5d0ff3b239b05594c3e474b4cb75d4f606b843ba21296b1c72066e4741f3c3faa051d8d98810905e3853cc7ca3db7404ec89950009339aac7879ad155fee1333f23ba5b3e6980800ef6e93b0649809c91186360ffe26d982c8e43a14343d28aecb739dea1eeaedaef9307a56ec14ed71020242d3449851daa59d6bfdc55e51068be83fc63d62d270bd1fd40bf11bd5d50ba1a6a7a20b9ffb3300f8dc7e0093098eca329837ae4097eb44a3dfbbd9e719aedb0ceba62ba1d454c21215d94ea9dea0efa60f8de98daebd2f47cfea1b5130f871148801a4b728ca9a824ea0cfd0a791513415366758db428010e434617889198f2e914508385b83bf8cf7b6cb582266fe49e186366ef8eba26f8c8b4c1a88bc8683fabdebe8f7eb5f6deb39bdbdf5acbe09dd0aae40586ce17787fa18da65a2a0887e6211fd45ddb012c6eb36fb459dd0c89b56c1593350af931c2f18007cf6b3c1f631c3216f5b2b42c016bf21ed5887800bc6434e8883c9dc3e1ff3d0365759ac01884c2c47f79225c8addb877c5198f3b525593d0c746cf9da8c77e8e348ca1903b3b5ed679c6be704d4e519717889847fee1783f4c133e7eb03327ebdcd8205c31424841bdb1ce0b433fe2393ca51d07c877e1d3ac7fd7a566f5fb975fbd1bd7499f8fb0f80450d38ed4d7edfd706d12fe4b858b82f1827fa8bffd507dbd8917a7de438c100e0d36c31d1b04dbb04a61debd1e5daad7ec374cd16d82e9f0c352f17469bda6ecff8b402acda431097568f8c7eab90230a747eeb637ac1ce1385bba3cb6dbc1761c9f59015779baf8976626055ae090f2c32e3f35b141c3f2406ec76f6d56d129ebdca8c8b6b6d880e319fc6e0af2222b118054dfb3ac5fd3931f03f26dad56d7afb8acf68fc6ed5c6d06e8f078daa2afa454fa8d32e8569f766bfaa0bc69d1b60d7ea82a88b1c1f1800fc8292920cebfc5930ee129d7dcf36bf61106c6b5741e957022934a45d3feea16dbcb239c311dbad5614ea15c8aebd15b92d87d16bc8d3c2b31d5a56ed1d084ea886a4b8da1c0214d980be190a6ebadc863fdd20e3f85d62e06e07da9ff3cf03663cb95246436f13548ba1cd83bfb6ec1f1a5b805ef57bc5ef7ea683df97a745fb7958dc9b5bf5f6149b5607bbab7d36f89dfa58500a0e86525622fac54ad13fb6fa553dd0ea9f75d11c585253382e3000f8d1ab814623dcfdcba0ac5c02c32eadd36ff723db60d9be09eaa8e150929360b45ada75c7aff63cdd6a0b4444f20074edbb10593537a167f383c81df294f06c879551b54f848041904f2304685f114c8d3261fdf966fc61af1947b5a5fbbb4c6d765cf8cb8d26dcbb484565aeac3f6e389dc13f282a1799159b913bf8e90e7c2f9e42cf9687f476d3b5ef028427f517ed29a87d0fa4d166fd160b94a444d8460c83b263d37783a2ffd401c3eead50562d857b40398c266efa6300f0b74d81661996aa4a48ab45f2df2d3aff35dbfd8a71e75638e7ce82dabb37a4808076dffca32dd19a2d0e84c61522a5600632abf620abf11ee40c7e1c3962f6d911658ad96670e22048a7f13840fbddb1a112e60db3e2ad6d32be392806f3bbbd77f490097fba51c6e60b646426c89024639b073b6dd93f383a0fdd076e44b618fc3be4f517ed22abf15e64d6ec45d7a299088bef23da8fb3fd96fa4f9df5bbddb0e6f58273ce1530897ee06f7d5fab77d29a55b0540f82b19df604110340a723d96c708d190df386b530ecda812ebbfd8b4150d7ad81ada505726cac7e6852fbbfff6bd05fcf0a084b457c8f11fa20d4a3e14e64b53c8cec214f0acf742869d5b720487f1ce03ead6be1b61930acc4849fad97f1c56dde0dfedf1e92f0f60e19cbce53911429c1686cfb4c57566c7a08eb31689b18fc9fea60d75bdc7fd10e7a341c42fa800d88cf1a85c0f0747d93627b0ffcfaac5fb46f393a1ab6a646a86bd7e8eddfeffafcaeed306f5c07e7b8f360b272d31f03809fb38486c271c10590366e40979d3bd16597ff316ddf0e75fa74312bca8349cc8eced4ab40fa9b03aa1be1097d9152381d3d6aaf4556d33de8d1721859839f40d690a73b84b4ea7d7a08902deed31a882c6603fa64c8d83f5bc6df0f48387e8f18e0effdefbebad384d7b75a30b2dc0cb7dd785ac14b1bfcc3128a9155bb5b5cdfa73ac6f51dfce489fbdd7c1f326bc56cbfef1588482cd5db455b5ec7f4ec202b134c2e17ac3db58d7ed3447bdfe697fdbccbce1d90366d84e3e28b44dd0b61fd670020fdb8db901048175e04c3a6cda293ecf24b0641b97a0d1c2346c09290708656034e795e2e4286dd1d85c8d44aa4f49d8dee35d7a17bd3bde8defa0832c5cc30530c16e7525add0184776b82a23d7f3e8d8149321990122561fd850e7c72938463f7483f39f06be1e01f2224dcb5c08cd21e6658957618fc93ca90dd7893f83d4f9dc36bf9947e3fb5fbda5d1ff46f40d792b988ee56057b400c24e90c7e6a569bf59bcd506262e118361cca55ab453bdfe9bf7d5cd437e9924b208785b1ee3300d0a9cc3131b04c11b3832d6276b06397df92b6ed846dc122d8cbca2007059d9583418c26b3bec33b2cb1048985d39159b717992df721a3f53032063f8eeeda00220692b32db3f91e24e69d0f9b2bf2b4428076529fcb66c2a46a0b3ed8abe25b6da9ffbe7f392606ff3fdf2261de700571a162b66a3ccd472e661b4213cb91d574eb39b96edafdd2ee9b76ff325bef438ffaeb9154384dbfbf5ae83399cefc7367adddca8181b09794c23e6f8168d73bfcba5f1b455d53a64d87141dc37acf00403fb53cedccc88073f65c485bc52c61fb6ebf266fda06e7e469b067e54052d5b37636b8f69a97ac3811129b83d8ac6148af582d06e203e83ef821a40f7e0ce9439e40c65031c00c7deaacc81af62892b41303dbf8ed801fac34495d909d24e1a155761c3964c0f1fb8c387a8f116f6cb760483f1536cbe95e636de66f47487225d2eaf79db56ba4dd0fedbea40f794cccf61f428fe6db9151b916b1d9c311129303d9e2d4dfbc395bc77e9bace25a6665c32902bd79f376bfefcbd2b65d70ce5b08777636cff86700a0ff1602dc39bde098bb08a66da2f36cbbc6af19b6ee8675cd26b8c74e809a98a42fdb9fedfb6134c9501d21088cca4652de581108568940b00f59239e409a1878ba89d9a6f6cf33297dc82388cc9f01c519db3e875189817ed6303bfe7cab848d1729fa46bfd39bf57f772aa12318f13dcf437af3dd67fc9a9cbceeda7dc86cd9afdf97e4fc71088ace81ea0cd1ef9be12c0f364649829a9008d779e3f476abb55f7fefc35a1db3cf5f02776eded90b61c400d099438043cc7a1db31640da2a3ad1d63d7eec1a9d71cb6e5856ad8363c80858a263daf79d6c2f6777da7f5b7bad4d7585232cb1080979e3d175c072f41c7600e983ef43f7e18f2163f813e836f409741d7282f63fffbb27bda0fd398f2165c06a0446e78ac14d6a8776d605c12e53bb0cfc7aa870c720b1682a32861d6ed3effbf1b539f5da650c7be2c47515d7b7e790dbf4c13e317f02c2c5f5b789fb202baabed1ee5ccd2eb536a14446c1d13a0c56d14e0ddfb5db2e6deabfd778a073f45fd3966be098bd10ceec9cb31ec68801a0737f38282717ce99f3206d16b3882d7b48308a6b615db61a8e96a1b0c4c4b6cb40783acbddda73796de03118257d1f81ea084244422e22ba0e44748f61c8ae5a8aee351b90387003922a77207bd83dc81e751819431f46d7c10f21b5f561a40e7e44780ca962b0fbef1e17ff7f87915ab503c189e5fa7fefb4db593b0d7eb6e014c414ce46d7d6074ffc3dffe76f79ecc46fd17fff43faf5c81a7918d9c3ef4172d56efd7a75af592faedf12711d87223c7520c2e37bc26a0fd27fb776bdf5ebaeef8b3877038b36e3d702a9a3b115d62557c2c4befa3d69f335708a498cab67afb3be72470c009dffb440515c1cd9b9704c9f0b69a348fd9baf25c1b049cc2cd6ef8475c14a385b86414d4c8651963bccea8db687c0a8070259ffdcad49b68a7b6985a4d8e10a8e4540781a9ca1e9508333e08ce889481116ba168c467ae925e8563a19a9c59391523c45972a742d9982f47e93915e720112725a1092d0075657b4fee77794df6cb1872234b10f927b0d157fcf0b9176f277f415ff3c49fc96b452edb75c8ad48251084d2a85233c07d6a074fd7a68d745bb3eb2e2d0af9776ddb4eba72fe57f3fe0778c59a4d6deac09c9708a19bf2adaa1d61eb576c9fe798269e36e3866cc83531bfc2589f59c0180da5a686c1999b05f3c0dd2ba5da2735d47dfd183c0da1d50165d09c78831b0a76540b6d93bf452e3bf560c4c3f583990c4402799454830ab3ad377a41f1003a2a47cf76cdbd8e17ed7c9c0f383df218b7f9e74ea6f397560379c723d0cc60efd684eb6d960ef2682dbf0b1b02c1433feb527077ef6c7934ceb77c17ee9e5b067668bfac553fe1800e8b4438092940265cc85305ebd035d36eda55318368a19c79a9db02cba1ace0997c091df074a60d0b9db2740bef5384eb423734020ecf945708ebf58b4b3d57a7bd3da1dfbdf0f69f5c92cea94393105860eb22a470c009dbf084912a4e8582843c742be4a84800dd7d38f18d68bd9c7d5bb605eb25ecc4066c331a801969878310be52c84dad6e714d1e71c9575b05f720594c5ebf4f6a5b533f6b77f27afde0965f87898c4353370d99f0180cec0c12291d1b0b78c8275e5567459cfa2f3d34140cc44d6ec81bc7c0b2c3397c131e27ca859bd20bb026032b130d17f3f1d5216b37d5bf6ffb777def1515dd7da66da9939d3d42b608a6d4c0783e9bd37d17b4774301dd1c1f4620cb6c136c6dd0eb8256e71aed36eaaa3e4de342757493e2721213d4ea2840817d918a4f75bfb8c8831a8cc48da07a179ff787e20ca9cb5d7d967ad679f365d1014d9f6addf25f3e80159f13f6ecd2b1e5fe5631e3c81d09439301ade8406bce18f0240344a405a067c0347c2d87c10cefb3e2322402ac279f469b80f3e0263db3d30976e4068cc5404da76849994c2179290ffa0e643b0757b04732659f344cd17f78193327f9e8a88368fa57271081ea943be4139f0a4674a7da260530088f66b92ae7022cc1efd11ccdb0bd7512950f79e2295e0b85764e0f093f0ec3d0163e3410417e721347a0acc96ede0098579bf401c1e43ee6008e66d6d11ca9962cd07efc60370ef79c89a276abef0b8a91ca7d49dc0867d307b0d84332189c7100580d8f9421a9714305fbbcef0cd5b09e31e59a91c3d45a2c071e43370499137a4d81b79fbe15bb80e81519311eadc13de8cecc89dcb3c3b502f6fa63564951aead41dfe9193e15bb016c6fa7dd63c50f3c171f4333c3ea2c438fc147cb9abe06ddf192e11681e2f1400723d5e44e3f5c168d602c149f360ec7a509adb69342051e338720aaebb9f867bd7097837dc0ddfd22d3027ce43e2e0d1f0b7ea006f722a9f63be61afe7bb6124a5c0dfb2bdeccf1c7827ccb1f6af77c321d9df0f59fb5ded7f1e07b11c2fa761ec7c1081c9b9309ab7b0ea0f9b3f05805cd71706c9ca26a321ccfe2361ae3f08c7613958ef7996c488e39ed3b2123c05f7bec7e0db711cde35fbe09db70efe290b11183c16c18edde0cb6a0cb7e98fbc819085afce9c0d53fb437d018f2fab11821dbac23f30c7da6fc6bcb5b21ff7c2b7fd385c7b1fb5f6afdacf9cefb1e3bce71402224ffe81a3606436ac332fdf2214005ed37438e10a25c0dbbe2bccdc75f01c784a44400edcc3cf916a214220bf3a0f9d925c3e0d63c743f0ae3b0863d16698b356c29f3303813ec3116cdf054676137853d2e19106a46ed2b4a01cd4fe773094e556e559e5db68d80401c9bfda0fe6a8e93067aeb0f68f77ed0118db1fb0f69bda7f8e7b22fb9373ba7aa83aa2ea897f411eccdbbbc31d4ee0f57e0a00a99322e031e055970446cf84b9f97e38ef9683f8eee7492de138fc3cdc925363f7e3f06e3906dfeafd30166c4660ce1a98e3e7c1376c1212068d85bf532fb86f6d8be02dad119055a953c981d707a7cf84cbab5e0fecb18aa8250a571227cdfc328eb22f5752f97095e547e5c915082290ddd8ca9fe7d676d2787a223c70b4955f95e7c01c59d92f94662ff9f76e3e068fec0fcfddcf59fb87f3b4f650f5c394fc06c6ce86efe696701a5ed6590a00a9db7738bb6024a7c1ec36008125dbe1d9f7341c87e480265a704aa1741f7a0eeebd4fc3d8f92802db1f9655e8dd702fdd89c0d21dd2acd6c1353617ee3173618e9b87b014d3d0900930ba0f86ab531fb86fef054330451a0242b053cf4fa1fe2cd4a20d3cc1d00d31ffd4eb9843b7b4ba622c3d101222bf8f8c538d578d5b8ddf2b7950f9088f990dbfe4c73d762edce3172030779d953f9547ef9a43f06f3f018fe4d72df3d9737724ef9c7f7a50f5c223f3d9bf680b7cdd06c24849b7cebeb0be5200c88d726f80d8bad9a22dcc9c59f06fbc1fce03cfa2c1c117884d380ebd00a7e2a034abfda7e1da770ade03a7e1dfff1998774923db700cceb547e05e73181ec1b7f6304cc12ff210e130c2ab0e2071e64a2476ee0943dd6d7d8308404287ae489ab902e1d507acb104cac6a350e354e355e376aebd071ec983ca87ca8bca8f6bff2938245f56de0e45f2c8f9641fcefdcfc2bf49f6c96859f5dfd286ab7e0a00b9914fb7ba139311e82e163f730d8c1d8fc171e0f2c1fe22a9a338f73f0763f383f0cb3e33efe8074f72da0db302b39eb14f4c81ff8ebe08cc5c0d63d383d678b85feb32225a82aa0fde596b11e839049ea4545eeba70090faf2a480a76153984326c1bb6c0fdcbb9e91559648c08117491dc2b9ff4578b73f065fee66f8fa8e86b771f31b7605a6e2f6356a065f9f51329e4d30645c6a7cdccf750b87ec13cf9e53f0ddb9cfaa0f1ed9674e83df9f410120f50e973f005febcef08d5f0cdfda7be1def32c1cfb3e8b06fbc9f544ed03cff627e05bb20781e1d3e16bde0a2e9fffc6bf31503da2e733e16bd612fe61d3602ed96d8dd3c17d7efd9139e7def31ccc75f723306929ccb65de03203ac93140052bf1f1974c09394067fd741f04f5f0363fd037049215005a10165c0fec6bfe3697897ec837fd46cf85ade0e77306c3dd659dfe69c3ba05ebddbd11aa71aaf7bc75311f9e49cb3bdf1abe35d1df7e68cb508741b6cdd34ccd3fd140012576f4a73c1ab5e20d473047cb336c0bbe1045cbb9f8763efe7a448106d487e9dfb5e82b1e319184bf6c3376a5ebd6dfce5de9322e3f48908f846cd95f1ef83b1fd19c947242f9c1f7ae79d3abe8dbc87e09b9927c7fd4818198d78773f0580c4f51901971bdeccc608f61b0b73f62678d79d807bd70b22022f49d120b5c69e97e0dcf339185b9e84b9f42002a37361deda1ecefa70aabf3a9706bc267cb7b48be44144c8d8fc84951f9527ce97dac321f974ef7c01861cd7be991b61f6ce8191de908d9f5000c85522208521d06b14fc334504563f00f7f667e1d82d8564f7cb529849cc48de1cf2ab6bd76765e5f5287cf37723347c2602cddb582f6de2bc8bbcbc2ad0ac25024367c097bb4bf2f488e4eb452b6f9c77359877827bc773f0ae79d03a9e033d4759c7b77a4f08e71da100900a1fe332125311e8d41ffe49abe05d76149e4d4fc3b9f3b3565169f01f5e21d750567c77bd2cf9fa1cdc5b4ec1b3f218ccd95b11ec370edeb46c16e04a5e60a5f213ec3b16e6accd92b7fb257f9fb1f2a8f2c97917c5bcdbfdb2759caae3d5bbfc280253d620d865100c3ed24728002456dc3e13815b3b22383217e6fc7d30d6caea6cdb7370ec9482b3eb5572152a2fae6dcfc3b3f651988b0e22387629fc6dbbc3130c733ec532effc41f85b77857ff4222b8f2a9f2aaf9c7795cdbbe7e059f708cc05fb1092e335d0a2a375fc723e110a00a9e17b04dcf0653446a8fb080426af87b1f45eb8f39e94a2f3221c77c90ae42e29443be313357e950777de53f02ebb0f81691b11ec310a667653b8dcfcc6b49ace3b95c7408f91f04fcdb3f2abf2ecdcfa82e4fde5b89d73ea7853e357f3ce23f950c7a37ff23a997723e1cbbc895f614d280044c7e35c4eb8cd00bc8d5b20d0770282b3b6c37be70370af7b0aae2d2fc2b9e315294caf4981aabf3876bc0ae7f697adf1baf39e86b1fc380233b7213c600acca62dad2fb5e15cd1f162211fcc262d11ea3f09fe699ba5e9dd0ff7faa723f34ef687da2ff57ade09ceed229b5b5eb08e37afcc3b75fc05251fbe9b5ac86adfcf6fa124140062efa95a75435ba0d7185981e4c15c760cc63a29ca1b9f97559a14e5ed52bc767cfe86478dc3b9f5256b5c9e354fc0bfe43e84a76e42a8cf78f89bb582c153fcf6ce3b9150539a5eb0e71884a66c807ff15178563f2efbe7396b3f39b6bf5a8fe6ddcbd6bc33d63e0573e931f827ad97718fb68e3bb73fc4f9402800e4fabfe845ad7cbd994d11ba7d0082437311987700bed58fc199770ace4d9f83638b120255d45e47833a8ac3e2f3706e9315d7e697e1dc28abfcf5a7e0bdf36184720f20347201021dfac09fd5d4fa5e7aaeb8ea800c784d98193721d0ae1742c3e723346fbfac8e4f58fb4ded3fc7e69722fb735bdd9d7b91b864de29b6bc02e7e6cfc1b9feb41c3f8f23907b10c1110b10ee34003e39be9c86197f8f8d120a00b9911e2974596f7e0b346909b37d5f248c5b81c0acdd084841f34861762b21d828456ecbab2206c25629cedba408da84e3325ba5316c7d550aee2b70494cc6a61761ac790ae11527604edd8af0f07930dbf58637ab193c81b0f5f224eedfbafd048b4756c5aa51fadaf44278e85c78a76c46e8ce87e059fd240c1102b59f9d22776abf3750fbbf6c2ed83af7d47c97796fcd7f390e3cd2f0dd6b9f415084393867af1c2f2be16bdf0ffea62de5380af3997d42012037f68b5f0c75ef407a23845b754142bf493087e42275fe41f816dc0bffaa27e0578570a314e60dc2c657e0d824057af36b168e2d5230b7aac2f9854fd1e0aa9f3fc596d7adfff79fcfd8f41a9c9be47337be248dfe25046565682c7d18c145f72269fa360406cd424aef31309bb6862f25132e7e0d6afdb877c06358fbd3d7f836a4f61805ff8019489aba19e145f7c1b3f80104377dd69a0f8e0d2fc1a9e6df2675f6a7f279573957cfbb5723f3593edf2d73cf2fdb33573c66cdfbd4f907e01b340749723c046f690f6f5a2378fd419e5922140052ff576bea5aae53566c0159b1855b7486af6537043a0f45fa9865489ab615c694edf0cedc8fd0d213485a7f1a89523c43b27af3cb8add27cddc2bc5d5b73982fab3e0965790208d3d79c3f34814a930e71d817bea2e59056e47da8cedc81ebb1c66c7c1b29dae486cd919de942cb8fc61b80d1f8b6e1cc9a8dbe3b556d69e845424b6e80853e683afdd0064e62c42c68c6df0cb7cf14cdd09fffca3485cf3149237ca7c124908c91cb3e6dee64fe69d2904e4cfd4df256cfa1c92f24e23b4ec048c99fb64deed9079bc0d19329fd5bcf6b6e826f3bc134c116135ef3dbc718f500008b9f66903f5664285fa5a5975fadd9798260d3b53c88647702b92cb7e2dc3230d5d35755f7206bc09c9913ba3650518f92c175f8642aa94526b9ea8f9e2f6c8fc09c01b4e96f9946ecd3de3cab9f7a979976dfd9dfa376a9e1a8184c8d738abcf71bae0e4bc231400420821845000082184104201208410420805801042082114004208218450000821841042012084104208058010420821140042082184500008218410c22410420821140042082184500008218410420120841042080580104208211400420821845000082184104201208410420805801042082114004208218450000821841042012084104208058010420821140042082184500008218410420120841042080580104208211400420821840240082184100a0021841042280084104208a10010420821840240082184100a0021841042280084104208a10010420821840240082184100a0021841042280084104208a10010420821840240082184100a0021841042280084104208a1001042082184024008218450000821e5e0107c9e06480a344056a203cd521d6891e1409b860e746ee24087c60edc96e9c02de90e344a722035e880df90ffe7888ffc38659ca68c37251819ffcde9917cb46de44097664eebd71699913f6f28f94b0d391088a3fc5cc6ed6a8044bf0399090e344989e444e5e98e660edcde24f2b3a271b203e96107823e075c4e1e7f840240886d78a450ab22dce36627a6777361ed50170e4c74e1e41c373eb3d08317967af0d2720f5e5be9c11b6b3c787db5fc7ca7079f5de6c1e9451e3c3ecf8d7ba6b8b171840bb9bd5d18d8ca6909836a92f5213f4a869a8a04f5bdcd89593d5cd830dc85bb27bbf1e85cb7357e9507958fcfaff2e04beb2279523fbf287f7e4ae527d78d2353ddd834d285457d5d18dcda89d6d92205defa2305aad9ab26ae9afb84ce4eac1cecc2ee716e3c34db8d67640e3db7349293975778f045c9d11b6b233f2b4e2ff1e0a9051edc37cd8dad392e2ceee7c2f0764e4b38c36644b8789c120a00a9114129b8b74a636a95a517b5ca09cb6aa6ceaef0a5a07aa5a9a958a77471e2ae312e3cbdc08d2f4b61febfdd06fe78c4c0b9070c7cf888171f3fe6c545e1d2e3114a1effe4f797cafeee23f977e71ff2e2aff71a787bbf816f6e8c48c3dd93220dafabac8a43be1babd9a9a6af9af4b4ae4eab91a946fef50d1efc6caf813fcb388b1e8a8cfbcadc58f979e293df5f7c3cf2f7171ef5e2dd135ebc739f815f1f30f0ed4dd208a5f11d9deac2b2012ef4b9d5699d4db8d156bf863b2246a33b38b149e4ef91b91141fcd15d1efcfe1e03ff7cc08be2cb7348e5e4890825655cfe59fd9dfa37ef498efe76bfe4e8a081fc2d911cdd37dd8de5035de8dbc2298221a2c13304840240aac3f84e4e3c25abb117a539e9e4d44237667677d6b986a7565229c106d60a74b3ac469f9795d74f764ab33f6e588daa540a319ea839ea734ae4f3de3f61e08c14f337567bac330493ee705aa782d56ab1ae8a51aae4479dc1d834c26de54709d1b907228dbcf489dac98f9523e1c3935efcee6e035f5defc1316974737bb9d02abb6e5f4e517125fa1ba07b7307560e72e1c95c0ffe679b81bf89dc28d1a9cd1c29d92c56393a6ce0bf2547c7674472a4ce0cf8bdf17749855000480d3838d18d771f94e2f2b84f2bc5b292797896bbce1428154782e9c0b0364e1c98e0c637f20c14de1f69d2b533e62a8ab9fcfd055909be25b2f1e81c0f667577d53911506728fac82a73e768b7d56cfe7e5fe40c079eb007959fb7f719228f1e2cebef42db86914b288e3a745f883a1ddfeb16914759edbfbed2833f4863bef8a87d3952c2f4fff61a385d96a3768deacf65264201209ab97ba207ef3e200deb31bd143fe4c3c9599e3a2100eafabe2a949b6545fbed0d06de13012ad531eec7bd5171511add2ff618b87f9a07c3db3a911c705cd76bbceab4bbba2cb47c800bffb5ca834269fc258f7aa31e4f6d7349f2f3db835e3c3ddf83e95d5db829d971dd4f7bab39d432d36135ddcfaff0e09da3d737476a0efdf680e428d783696539e2cd838402402a1780092200c7a5593daa97ba20006adbea3e8451ed9c38bdc08373b2e22f7d54bffc442f495e7c4b8464d520376e4e73584de67a5ce7ef7bab13c74446ce4a43b978b2eee4e7c2c33efc648781fde3dce8d6dc69dd3078bdce8c0c6ce9c403d33d38b35f35dfba93a30f4ff8f063c9d1ae316edcd1c461ed4fd639420120d757001ebcbe02a056d499610716f676e17b9b0c949cd43fe6ea502acde4f7b2dabd7ba2db7abcd0f4d8dbd8c6dfeec2eb771a387f2c124b5dccd13feff5e285451e8cebe8445ac861eb9c4a093830ad8b0bffb5d2c0bfefafbb73e8aff778f1f43c0f86b4765a37fab2d6110a00295f00a4d8e311bd143f200230f3fa08803a15aa9e3d5f3fc48ddfee9355ff49fde3ad29e7eef3e2c9b91ef4bcd969dd00a73b4789a603b3bbbbf0fdcd062e3c54f7f3f391c4f8669e81452274eabd03765c3251ef7698dfcb85ff951c7df860ddcfd1f9635e7c618507633aa8274e1cac77840240ae1280f122006a2573522fd74b005463c856cd7fb01b7f3aa87f9cd7508302fe81e4ec54ae07dd9a39e175ebcb515856fe0b7ab9f1f66e2f2e3d5cf71bdb6554ac3fdde1c5bac1911b28754a4092df213972e1c7db6e0c41ba720e7d65b5819cf62e5bcf26110a00b95104e03e1378582fc5c74d9c9c61d82a006a5bea94edd23e2efc619f4fef184feaa1f8b80f27a67bd0264bcf8d6f4a2c667575e1ec5e1f4a6a340edf75a14424e0ed5d5e4bf0b213f45c0e506760a6dde1c28fb678f1f183beeb36d6eaf281cca1375618d6bd1d7c6700a100904f04609c08c0bd52c04fe8a5f89808c0747b0540dd2436a69d0bffb7cd8bd287f48f51975c9c3beac38e916eeb3286a3962f8df46fe1c4af77fb507a42bf04eaa24462ffe9361f16f576cb4abdf62f1ff593c6f9adb55e7c78fcc6cdd17939c64fe71a6891ee64dd2314007285001c9522f1905e8aef170198669f00a83be83b3576e20bcbbc2879d086e6af9933bb7c98d9c5556b3774a9d3e5ea498337d7796ff8dc282eca3efee61a2f72dabaacb7f1d5d63cba29c981d3f30c9c3f7a03e7e7e1c8af7f3de8c3ee1c8f75b3276b1fa100907a29006a959c95e0c05d23dcd676758fcd0e4aa5c1bdbed440f766ce1a3fdfed28bbe9eff0780f2e3d503ff2a3785f56b94fcf31d02ab376ce9428915833c08dbf1cf045ce20d58339f4f36d3e8c6aebe47709100a001101186be0dd237ee041bd14df679f00a8679f87b776e21752eca056fff584f745d4b60df3203de4a8f1d99141b739f18f8351e4e7466a7212efd9dd3eac1be8aef193134a20da663bf1c38d5e5c3c5e7f24e903390e5f5964202dc8a70208058002a004e01e69d20fe8a5f85e3f4e4ed52f00eaf39ba538706c92814bc7f58fcb4e4a653cf96b7d18dad255edb3008eb2c7d99e9be7b53eafce8eb79aa279f1981faf2ff1e2f646ce1a9d055037471e1e67a0e81e53bb1cdbcdef779b98d3d5cdef0d201480b8178031220087a5301cd74bf1517b04409db61ddeca855f6d37b58fe97af0fe11133b4754ff2c805afdf76ceec4dff7d7cffc28ceee34b1babfbb466f526c91eec0cfb7fa70e958fd9248c58722e36f2cf522c964fd231480f81680d16502704c2fc5474400a6e817804c698c3b867970e97efd6352940a25b2ad52bbb627dbf9b214efdecdabb7c255af42de2ef929b129decb31579aa35a16800f45369f9965586f7eacee0d926bfa7bf0ef43f64952c9b108766c4bcdd9dfdc6522a78d8b35905000e25e00eeae1f02a03efb8e9b9cf8ea72af2d8dede27d7eab49fc719789bfee31f1de61bf2d8df5af7b4d2ceee986af1a77bbaba6f8c5a5f6e447e5e2bdc326febc2792a37f1c30f1f1bdf648c777d7f830b045f51a9cba7fe0abcbbcb870d4ae1cf9adfcfc4178d7a6395474b78907271b70f2bd008409887301381400eed34bf1e1004e4ef66a150075dd76520737febe578adcfd01ad5c3812c07756f9ac467c7b43277a367361f708037fd869c3b68f0670df78aff5885aaccfb4b7cf76e237eaf288e6184b649f9fd9eeb7ce36746de24407c9d1b8766ebc94ebc5c74703dab7ff1bd9f68a3e1eb8aa31dfda643a45e8d4190bbd315eba3780b33b4ce40df4a0a3e447ed9b253d3d22037e2b7fb5becd2b044089d877d7faac9727b10e520098040ac00d2f00eacee62d830dabb0ea1ecff7d79a5643bbf2cd6a6a75bd67b881521bb6ffc6221f7a368deda52eea8cc1f0962e141df06b8fef6f2261fb46199fba0eaf044435d7ff91d5b9eeedff5bc678ff7803a627f606b7b0bb07e70fea153925174a5417f7f05c7343e7cabe1ebc7f58af7c94de1791a481b7f232006102e25700a448bf7b508ac2bd7a29be5b0460925e016891e6c4e353bddac7f2f13d019c98e845b364e735d78ec7b773e11fb27ad41dc3cf379ad6d98e58f219341a605e17b715bfeef8bebfc6c4a0729a4bb25f24698471edffa96501f8f848002fcdf322bb1af7013c3ac56b09ab4e41b97834801fae33d1a49cb33837a7382d3928d52c49ff906dacede7611d244c425c0bc001290847f5527c48af00a81be2ba3771e2eb4b7ddac7726e9f1fdb067bac97e95c1d47ff5b5c784b0abbee18feb2d38f653d3d317d49906abefba4f9961ed1bfbfbfb2d8875b52afcd8f7a93e1826e6e5c3cac77fba5c2b796fbd0b9516c6749d4fcfcce0a1f2e1ed12fc4afe47acbbd8fc3ef6980ffdb60e292e618ce1ff0e3d878838f03122621ae0560bf14842341ad141f0cea1500f9dcc1b2e22cc8f36b6f6eefecf263656f4fb9a797bbdee4c47fdb202145fbfdd831c4409219fd0a373de8c013ea0c89e6d89460bc9aeb436ae0dad8d437d28d6deb16e9d4bf9f7eb4d6c4c896b19de256a7e3ffb8c3d42e49ef89743f31c55ba1cc7e53e4e5e3c3faa5fcb5f9be6add4c4a2800a43e08c0483b05c0a74d00d4e9f79c562efc7eabfeb1fc717b008bba7b60b8ae6d70ea86c0cfe79a36e43380c33906b26238c5ad6ef87a759e4f7b6c17ee0ee2f40c9ff5c8e135ef69703540bfe62efc7d97fefdf4eb4d7e2cea16db5750ab9724fd6bcf15b16914b8a3638c0ae37863a10f17340b80fafc37979b08797923200580c4af00ec95827038a895e203220013f50980bad96c4a0737feb153c6724f502bbfc8f3635a4777b96fe36b95eec467a6f9b4c770e150100f8c8bfe4900ebcb7f521cf8d632537b6cefed0be0e1895ef80d47f92f226aeac25fefd2bf9ffe2ca2b675506c4f02b4ca70a268affed8fe2902b47960c5d7df9f1581fae8600db61185205d94e3f287abfdd6bb33580b2900245e0540ad7864d5a693e27d220013f409803a8d39b7b3bbeab1d482cc14acf36372fbf205a0a508c0d353bcda85ea631180472779714baa33ea53db6d339df8c91abff6d8cecb3e382e72a2be93e1ea38d45313b7673bf1bb2dfae328141954f3db1dc3b3eedd6e72d922c42ab6bc4a6ec03b35dd870f0fe88de1a21c0f3f5deb47d3247e45300580c4a7008c5002a09a63482bba05409dc65cd1d3c0c58321ed6329581ba85800d29c786a8aaf96b779adc85c1201785e56891db2a22bdeaa09ded1c889331bfdda65af68b708c098f26f705371a8987fbb497f1ce7258e1322225e77f42bdc912ddd787faf7e212ebc4b04a06f2502304d0460bfde18d41c7a3bcf8f765914000a00895f01d82d05e150482bc5fb4238395e9f0024f81c58d7c740c9c190f6b114aca9420026fbb4c7502abc3ac74497c6aea82f91f46eeac29fb604b4c75624f3a94a01d8584e1c1aa4f333537d08c6708d7b4a7b0f3ed8ab5f880bef0a8a00547c0fc0a9a99705405f0c2592f3dfc87ee8da98ef02a00090f815805d526854e3d448f15ebd02906c3ab0b19fa17d1c0a4b00da55210036c4f1a55cd36aea517d49920840ffe66ebcb34dbfec15edaaa600d432170f442429c51fbd00ccbf4309807e892cdc2102d0a70a01d8a75f22ffb03928f38202400120f12900c34500764a539062a993e23d7a05403d72b66d80a17d1c8a82d55508c0249f2d71fcf77c3ffa358bae78abf7050cb9d58d7f6ed72f7b45329f8e8fae42003604b4c7512239faa24852460c37b92ded66587355776c85dba31080bd7a632815feb42568cd0bd6420a00896701d81fd24af16e1180b1fa04204b8afcde215eede35014ac1201685b8500d4f676cb11806f2ff6636894c5db7a0d700b37ce6dd72f7b510b800d92f45591a486313c2ab9419af2877bf4c755b8ad0a0198e2b3258ebf491c635b53002800244e05c08b77ef524d26ac95e25d7a05a061d88983c3bc576c53a300acbc0e02500ef94bfc56538f263feaed7213dab8655feb97bd22d9c6f19c2a04202f604b8ebe2602d038862fbcd9d65f0460b7feb80ab78a00f4ae440026fbec89430460525bbe0e980240e25300869509c0beb0568a7785b50bc0a1a15eede3504404c053b1004cf4d91247fee240d40210341c98d1c1830f76eadfd7453b422200beca05607dd0961cc52e00deb2c6ab57880bb786aa1000d39e38b68528008449886b0190828dbd61ad14ef140118a34f009a2539716c944ffb3814052b82950bc004d39638bebf34809c96d10bc02c250077e9dfd745db450046290170542c00ebec11806f8800344f8efe31b7c3723c7cb45b7f5c5109c02efd71fc5304605e270a000580c4a700c8aaf95d29d8d813d64af15d7a05a0458a138fc8e7eb1e87a2e0ce280440c7b6af6ab43f5e16c0b8569e1b57006c90a4371706d0263dfabbdc1f9639746197feb80ab78800f4aa440026950980e638ce89002cef4601a00090f81480213ebcbb4d8ac1ee04ad14ef1001186dea138054271e1b2b8d57adde346309409b0a0440e2786abca638ae1282b74400c6b78e510076e897bd22692ac7475622009922006b83b6c85abe084087cce805e09131262eecd41f57e1e62a0460a208800d719cdb1ac29d14000a00896301d86a83006c4fc0c91ccd0230c6d43e0e457402a03f8eb79606313eca330061af030b3a19f868472deceb3d955324f3e9f848b372015813aaf2736a83fc05d51080bbc27ae3921c166e8a420074c7219cdb2202d09502400120f12900834500b648a1d995a095e26d9a0520a54c00348f4351b0bc0a0118e7d71b43350420d1e7c0aa6e5e5cdaa95f4c8a643e1d1f519900b8f0dbd5215b24297f41307601d8a1392ed987851bc3c8ebe9ad5c0076e8cfcfb9cd61110083b5900240e25600a4084035068d146fb54100469bdac7a128582602d0ba120118ebd71b439908bcb5247a0148120158dfc38bd29dfa05a96873c502a072d63ec389332b4328915874f3eddc20da65c42000a3cb0440678e24aec20d5508c0041180edfaf7d5b94d1400c204c4b7004811c05d095ab14500e4f3cbdd7e6d0bc0d2eb2c0065bcb55804a06535044033950980fa5ae226091159fbeaec8056be322b807b86f8d0381cfd53008fc81cbab05d7f8e2c01e85185006cd31f8725005d28001400129f023048098014831db5444502b0450460940880a671dc2602f078450250cb142c09552c0012c75363fcb6c4f1d6a21026c42a0036c45524f3e9f8f0f205c07a2db1ab015aa7b9d0a3b15b2bdd1bb9ad79e189e1eb801f5502b04d7f8e0af3aa1080f16502a0398e731bc3584101a000903815808122001b55f34ed44af166118091fa04a08d349453eadabbe67128aa1480d1f6c4f13389635a1b8fb5aa8e4a00bafb506a435c451b9500f82b1480bacce9f17e7cbcb51685b802aa140099cb1f6ed11fc7bf3784b1a19238080580d47701d820c5607ba2568a37e915804e992ebc3a39a07d1c8a82c52200adaa1000dd7148a3fdf59d61e47634a25ae1da2e00c36e4c01f8af69415cdca63f4785eb13a21000fd719c977db5a79f8fb5900240e25600f2440054d1d388250023f40ac06b4a00348f43119500d4d6f62a918033cbc398df214601b041908a36dcc00230550460abfe1c15ae1301e85e89008c1501d8ac3f8ef3b2aff652002800244e0560409900a8a2a791e28d8922007ebd023029a07d1c8a82455508408ebff6b657891c9c5916a300741301b041908a643e1d1f7a030bc016fd398a4a0036e98fe37c1e05803001712c00a608806a36495ab147008265dbd32c000bcb04c0519e00b84400ec1191334bab210036c455b4fe0616802922009bf5e7a870ad0840b74a04608c08c046fd719c5f4f01204c407c0bc07a29065b92b452bc4104609866019818d43e0e45c1823026b7342a168051015be2b004a07d0c02d05509409276d92b5a9788e3436e6401d0959b3a2a007d4dd6420a00894b01e8270220051baae869a438cf2601d03c0e45c17c1180dbaa10001be238b3a41a0260435c456b3f1100b5bf0d570324cbf6534cfb09198ea89e92f88f004c1601d8a45fde0ad72422af6bc52bef53a303f87083fe38cecbb14f01a0003009f12c0052b0a18a9e468ad7db20001382dac7a1a8520046066c89e3cce26a08800d711549733b3e382200aaf9774877615f1f1f8e0c306de5eefe2672db7b91e075c426001bf54b52e1ea2804204f7f1ce7d75200081310c702e0c7bb52b0a18a9e468ad725e1e4508d02902102303ea87d1c8a82dc2804c08638aa250036c455b4fa130150abf0b55decd96e79e4cf0c590212b5004c1201c8d314cf159254b8aa0a01c8110158af5fd6cecbb1bfb70f05800240e25700564b31d890ac95e2b53608c0b860edc7bef15a0a7213a2108064ed9c599480f9edbc22008ee804c06ac4fae32a92f9745900d4a9ff3577f850b2a1ba9f5743019811a3004cd428005750b85204a04b1502b04e7f1c140042018877015825c5202fb976294f0086dc8002500e05f32a118064118011015be2885900a41197da105791cca7e383ae1080ce220079c9b6e4e46af267844500dcd10bc084102eaed71f57e18aa4ca0560549900c428a7b1727e4d1205803009712b007d4500564aa151454f23c5b22a3c3958b3008c0d7eb2cd3c7d44250079c9da39b3b01a0260435c45329f8e0fbc4a00d627db9293abc99f5e0d0158a73faec23bab10809122006b93b4c7715e646d6f6f0a000580c4af00c86a04aae85597ba28001a29982302d0a21201181eb0258e330b4400dac6280036c455ae00ac4bb6252757933f4d04202d0601182f02b056634c1400420120754b0054234fd14af1aa647b0440db183e119e2a056058a06642152567e65743006c88ab68851280c02702d04904606db22d39b95a4ceb9c009451b8bc0a01182102b046ff99b9f3226b7b7b51002800247e05e04e29066b53b452bc520940409f00a4bbf1da9890f671280a6627562e004383b5bfdd72a4e4ccfcc41805c0140148d12e7b452294d70a80feed9647fed484d804605c1817d7e88fab705932f2ee302b1180203e5cad5fcccfcbbedadbd3cf5a480120712900bd4500964ba151454f23c552684e0ed22c00a3439fde6e7d1280723893ab04c0179d007845003a8b00d810579108e5f101570a8089923529b6e4e46aaa2500abf5c7650940e74a0460b808c02afd627efe4e0a006102e25b00a4184115bd9a501705401305b344006ead42006c88e3cc3c11803631088034e2521be22a12a13cdeff2a01589d624b4eae267f4a8c023056046095feb80a97562100c32800840240ec120055f434522c85e6e440cd029013aab9c84441c1cc4a042049046048d09638ceccad8600d81057d1b23201709509c0ed2200ab526cc9c9d5e44f1601488d510056ea8fab70890840a72a046045b2f638cecbbedadb8302400120f12900bd027877a96ad2a95a295e9e220210d42c0061ede3504404c05bb900d810c799b949b1098034e2521be22a92f974bcdf1502d051046065aa2d39b99a9805608c08c08a14ed425cb8380a01b853bf989f5f4a01204c40fc0a404f118025520c56a4569f955553bc4c046080460148130118158e2a969a52302309936f5102e0a858006c88e3cc1c1180d6310a800d71152d510210bc5600ae03f993aa210077a6688fab6a01088900e817f3f3226b7bbb530028008402a011db0440f3381405d3ab1080c1415be23833bb1a0260435c458b4500fa5e2500366cb73c318d5d00124400f48b49e1221180db2b1180a12200cbf58bc8f9251400c204c4b70048c1862a7a1a299695c6c9fe9a05606458fb381405d344006eae440006056d89e3d7b344005ac52000d2884ba3f96c1d0270e7751000217f626c02f0468e08c072fd71152eac42008688002cd32fe6e7175300081310bf02d0430460911483e5695a295e92aa5500daa7b8f1e2b0b0f67128aa1680902d71fc627a1266b628ff5e840a05209acfbeb366142d1201e8131100b5dde5ed4c7c24fbffe3659f707159659f517b92943f213601786978d88a4fb7bc152e1001e85885002cd52fe66a5f6de9cc17015100487c0a4077118085520c5441ae095509c06211807e216d02a01aef9303ed69bc0553ab10009be2f8c994244c9438a2c9694c0250438a643e5d1600afa0ceceeceae2c7fe6e018b4332e79e1d12b6a440772cf91312d121257a017842f6dd85a5fae32a9c9f52b9000c1601b0213fe716a460557b1f6b210580c4a700046b4700aa40b700b44874e1d1fe41ede35044250036c4f1e3c94918dfdc1b557efe230036c455b44004a0774400d4fe56bf66f99d681888d02cecc2b45bbdb6ccbbfcf1b109c0c9fe22004bd26c12007f1d108054dcd99667002800247e05408a0096a669a5789108405fbd02f058bfa0f671280aa654220012c7530342b6c4f156ac02d04104c086b88ae67f2200e5c562c89f0f6964e0bc0df32e7f5c6c02f08848ea85c5fa25a930370a0158ac5f90cecda7001026207e05a09b08801401a8558f468a65b577b28f0d02a0791c8a0269bc939b57210036c4f1d644118066310a800d7115e58a00f48a42002a9b77d74b00fa9609806631b104a043250230480460917e413a974b01204c40fc0a405711002902589cae95e205697a05204104408ab7ee71280a2625572e00fdc3b6c411b300b4f7a3b4bccfba5e0290ab5f3cf3c756430016e997a4c2795508c040118085faf343012014807817807969fa0560be08406fcd02d0c74e01f05d7f0198908cf14da3138044c381d56dfd2859549e00d42e9600f48c4600d26a7ddb57933f3629460108e3c242fd7115ce4d455efbca04208c0f17e88fe3dc3c11803614000a00895f01982b854635068dd42b01982802d0ac1201e8678f00fc787cf40210f638b0b0a5890b0bf4c755244279bc67a87201682802608378e68f895100fa846dc951e19c280540731ce7e4d8a700500098847815802e220073a4d02c4cd74a71ae5e01681e76e141693aba454651a90088883c25ab483be2f8c1d8648cbe293a01088a00ccbac5870f72f5cb5ed1dc2805c006f1cc1f1d9b00dcd723848fe6eb8fab4a0118200260431cff923816dcc6c700290024be0540ad7a34523c371d277b85b50940a3801387bb06b58f435130210a01d02c548aef4a731bd1c8884d00e6e98fab48e6d3f11e5108800de2999f2302901cbd00ecec14c087b9fae32a9c2502d0ae1201e81fb62d8e29513e49422800a4de094008efce9662303f432b9600f4d427000d032e1cba23a47d1c8a82f129550bc0820cede48f4ac2f09804c0c40773d3b5c75524f3a96a01f0e2fc6cfdb1e4e724c72400db3a8800ccd32f918533d32a17807e61dbe298d48c02400120f1290077d8240073f40a40b6df89fd9d83f608c0381180a69508409fb02d71bc393219431bc62000378b00ccd1bfaf8b668900748f420066e98f257f546c02b0b9bd08c05cfd7145042050890024543f8e1804e9ef33d230be0905800240e253003a8b00a8429c9ba195e2d97a0520dde7c45d1d83dac7a1a852007a876d89e3ebc39330202b3a0108b81d56ccefd9b0af8b668a00748b4200666a8ca59a02b0b2b5df9255ed02208d37afad2601889252c9d35fa6a6457d16895000487d14005588e76568a5581acfc91efa0420d9ebc4265951e91e87a2606c140260431c5f1e92843e19d1156fd58c4748d33d278da7dccfb353009c2200d99a05a08cfc91220049d10bc08216263e98ad3faec2e95508405f1180397ae32895fdfe87c9a9514b24a10090fa280033a4d0cccdd04ab114fb93ddf509807ace3daf8d1fa59ac7a12818539900b86d110035ced70725a27b9a27aafca82fe5199a6de09fd3f4cb5e91cca7e35da3108019fa63c91f119b00cc68eec307b3f4c755a500f4110198ad378e1299436727a5a267ba87b5900240e25300c27877ba148439995a299e99a15500421e0756b4f4e3e2ec4ced632918935ab900f44ad01e43898cf3f9be89513737d574fb671a7867b292bd4cad14c97c8a4a00d4bcd31c4bac0230b2a117efcfd4195744220ba7a5617d9b4a04a0b708c02cbd225b322703bf1c978af631e48750000805a0ce0980dfedc0a25bfdf860a6feb1fc4c04604a0502d05a04e0746ffd0270717686251a4a38a2c98f479a6eaf74037f9a94a63db6f39600842b1400afc4324c04e03d1be65dfef0d804a06f8681f766e88fab706a3af22a11801744ee3ed23c972fcd8ecce55bc32ed6420a00894b01e82402304d0a8d5a396ba4588aeac96efa0440ad2a673433714e0aabeeb1fc6a6c2a663537e1765edbe06e4ff6e0f3fd93b4c7f0b1348787a4c9360d4657bcdd8e06b823c58333b2e2abf0736ba9b1a8c6feb0ec6b256515dd8f30e1269f3527ea9a007448f244ce4c688e4bcdd3bbda072b8ce38b8392706196de382ececac48f47a5a0a19f02400120f12900b78b004c954223c540271f4a517da667221a9a2e64578334afb3c215a5c2250d6e4c232ffe34214dfb58fe303e0d8b6e312de9b83a0ed564bf3430c9967c1eed1492dc38a3dacf4e47e4ecc48f46a6688fed8234f6d3bd12acd70f57f444c2c25bfcd6bffbd4ffd5204af9c36213806c6986e7a6ea17e222d9c691cea10ae3f8eae064913cdd12a9f29322fbc9c95a480120712b0053a420ccccd24ac98c2cfc6b72067e96935a2d3ed72709fd32bc5623aba8c10dcbf2e2edd169dac7f29709e958d6c26fdd5877751cbdd20c7c6f68aaf618d43edbdd3e84146f74c55b9d79691270e12b0393239fa151004aa5b1bcda3719a915c4a6c46097c45eaa594414f9436313008fb301de9994a63d3625dd27ba862b9ccbdf1f9e828b33f44be4170724c1ac44ac090580d47701982c05411a745de6ec98744c6f625a05baa206d7479aef7787a4688fe51f1333b0be5500c1724e710fc9f4e2973969da63f8db840cacb92d60ada6a3ddd7993e279eef9568cbfefaaa88468b50f98d5789813a1ba45b9214f94353621200358f7e3c22159766e88deb83a9997856f685ab1ca14d369cf8cdd8744b9a75c6f09ec4f078b7f263201400120f02d05104609208c0f4ac3a4d550270f906bc533d12b5c7f29e08d3fe0e21ebe54357afdc2635f6a1c806a1fad568c9475333a67b2ad4d982c31d65e56d8300fc60582a8694f37cb9cad16d61177e3c3cd51611c91f129b00285463fe68aade7da83effcb039291685c7b96a475d88d7f4dd43f87fe3529035bdb045907099310b702d0a14c00a665d569ce8eae5a001af95d38288db954b30094483ccff64c42bb44cf356f23dcd146b63f4dbf107d7b500a0667c4f60a5775c622b7b9890b53f50bdf5fc66560bb3497ab5797ea8cc59c6626de9f6c8f74e60f8e5d0036b70e5a92a733ae4b3247de1e95868e89d73e83bff8667fede5a782e6af24f04fb28f26dec46f02244c0005a01e0880ba96395b56c5768ce7cf63d2719734fba60197754d3bcb746261733f7e39324dfbb62f4a037fa44b026e0dc5d6d8d44d8bea32c93be3d2b5c7a824e8a7c3d330ed26d33ae51f92c6af6ee69c25fbe757a3d26d9b37f9224a1d1263cb538f540385e333a2df4e359bb36af24f744b44f3a0cb7a8f4582d05bf6cf999c744b32750bc85bc353714b90ef00204c40fc0a407b1180095214a664eb616aed70362703d36faa5c00d4e965d5e07e3024b5d6b65b11a54291e4ad60583abe3120053f1a9a867f8ecbb4fe5cf7b6ff353e136b6f2bff1e84aaae6f37f63bf19d41faf3a3b824fbbf5072f2fd2169f89a62f5e96400000b2b49444154e4e8874353f16fc9991d39ba4cbe8c355601508df88712f3c529fae3fb6872167e39221d5fef9f823707a6e01fb22a2f89f573aa2146ef8b243fdb23b1d2e38950000805a04e707654d502a0502bf2fb6f4fb025a652a16472362e0a9726477eb663bbff3b381523b22a7e22a2aae6b6a76dc8b658d5762e5d871c5d267f60ec02a02e5b5867c62666d922292512a7920d254c76c9d19fc7646051733f6b20a100c4b500b49342375e0a9d14e7baccd991d10980dfe5c0e44626fe3e26b3ce8fa93a5c90a674ac63029a07aaf7f2167519a05f9a8142959f3a2e7dd74b00accb0029067e979361bbb0d88192b1ef0d4a4513be008850002800ef8e130198945da7393b223a0170c8eaad55d88dd35d93f4c4729d05e0cc8874ebba7a792f218af63280ba59f1e59ec9f55290ae267f40f50440ddacf8e41d8978ef0690e358f987c8dfae36213efe472800148004bc3b560ac3c486758b499f265a01b0be18488af7f4c626dec9c9bce6736e642e4eccc683b727d4f8c62df52efe71d926deb3c4afa2ed65d70b2202e0a996280d48f7e2d7c3d35172238c35cae67f51feed772527b78578f31fa1005000dad65101b80a4b001a472700eadaf82d01371eee94884b757c5cb1f0d3c1e91893edabf6eaff536701bc4ebcd22305a5f5283fe591df3f0d1d12aaf775b7ea26cb23edc3383726abdee4e38f2333b1f296006ffe2314005226006344002634acd39c1d1ebd005cfec29981b282fbd1c0f43a3fb668784ff6d1e6db42c8f0d6ce7bdbd59703f54df5e25ff5a8b9d5b60028516a13f6e06b7d52f1e1b8ec1b3e17ef89e8bfd03519593e5efb271400725900464b711bdfb04e7376586c02e0287ba5eac2a601bc23ab9eba3ebecab824cde7a9ce496827cda836afdb06449276b60ea1e4f2b626d43ff2fb555f0022df0d10b9a9f4e743d271e906ced1c712fb9b928b3ea946b59e1e211400521f05a08d08408e08c0b846759ab3433331bd9119d3a94b55e81a9b2eec6b1dc67ba3ebea181b564a89f0d59ea91898e685cf59bb5fdaa224a9a1ac06ffab478a4846c32a63d1826679caef5b330150247a9cd8786b08bf93395832ee4614c886f8e9c074cc6cece717ff100a00b942005a8b008c924231b6519de6ec102500fe98af5daa53dd2d436e9ce89088f773eafe38afa44478b34f1ac6659908bbf515eeeec906fea7afac70c768cc4f9442744162f8e5e00c7cac62a905c1ca97fc75087b6a9ca39b44240fb509e34fc3ca24a08e0bf3652e8d6d885f0ccac0aa9b834831f8b5bf840240e248002e9fc655a7cf4f7448ba21c6aab8280df05bbdd23029dbb456a00e8d734049524ea689eff549c785d1d76fcca5c2d764ccab9a07f1b7e159d6cf35fdccda12007536a945d08d8372bcfc6e4896c852dd9f434aa27e3a20036ba4f9ab333d0ed63b420120d708c048698aaaa0d561ce0eaebe005c6e72ad431e1c6a9580bf0ecbaad3637d4f24e5b5ae291893a9bff95ff93d0aa3327c78a35b2ade97ed975e8771bf3d30d31291667e37bedd3b4d64a4e6f332bf77ed08c06509b835e0c6e65b432890c65a1bf1d53a65cdff839c86560e173609b0f9130a00a94400464821532bbf3accd94122000dfd357a7c49dd40d7d4efc2ca6641fc4056bb1773ead6b84b84df0fcec2f1b689e893e2b51e43b3b370abf703f497ed3ede2109ef0ccdb6e2b16bec7f189289f93745bedf403de6785044eddf23b26bfcb9f9bd6a4f002edf37d1c874215762fd52f7549c93184beb900094087f11c17db673b275e928d570b2f9130a00a94000a4d0be3b5c1a614ee33acdd98159351680cb055cadaa47cb6af7096974bf1f9485929c46d77d7cff1e9e8d2fcaea7b79d3a075aad9705e9f9bb5d49992f6d230b7ca2a5749d207231ba1b436c65841832e15de1e9029e30e7cea6cc7f0749f485f96f5f7754900aebc317060aa1747da24e0fffa67a078d4f597c9f322f26fca78b7c9beeb9a68584f79b0c6110a00a990432d9500480119d5b84e7376800840b6bfd65e6062dd1c18f4606993205eec9482df8a605c18696f1e4a857f0d6d886f744fc7ae1661f493d57782e7faafd8d4f633bd4e4c9215e463ed93f12bc9fd4735cdcd5542502ad2f5c18846f8468f34cc6de4bfe626c7463e17bede3d2db2dd1a88c7777aa65b42a347961c68ee7763a6c4ff98c86441bf0cbc274db8d4467154db2a1281ffdfdee938da26113919a6f59c3f5ff34b2800a44a16340ee09bd2807ed83ba34ef35969d203a441d67661535f1ed4316c60f14d413cd22e09df9586f1b721d9f878a4bea6ff8108d7affb67e1b53b52b1f5963006a5fa906638eb5cd15697045a89242dbc2980673a26e317fd32f1bec45e5ac3f17f288dffe7f259c7db2461888cbdbc47d3d4b637df1caed1dcfc41af0c3c2cfbb489a9f7b5b76a0ea93ccd6ce8c77dad132d71f9c3a02c6b9c5a9abee4b0583e5b49eb97baa6e18048fcb84c134dcdeb77e6885000c80d88bae16a54ba0fe3a580d465d4b5e9748d8f31a986a3729123b9d87473084fc8caf76bddd2f1b634aac2210d714115f36a484189fc9ff78735c21f0766e387d2905eee9c8a7b5a255ae275478281a0abee5fa355ef1f6813f2c84a3d80fba5c17d599aceaffa65e15d1957493439917fa3f2f79741d9c817c1524d798e7c5613d355e94b696e0bb831b206735335c59e495e5b9e7d57fb50355f75e64209ddaaa6413cd436c96ad0057d33f1cee06c7c5883336d4a1a55fedeea93892f7449c33191a7654d82e89d2cc785d7659dd1623d23140052ade2a5be45af4e63632e54c3682acda9bf14d75c6954db6595fe9014dce73aa6e00bb26affa688c1f77b66e02d5965164841fe65df2cfc428afc4f7a67e247d2e4bfd3231d5f91c2ff52a7143c292271b8652256370d61823424753d3ad9e3b44e1fdf68f34435994c6936bda5a92a8139745b029ee9908cd7456abead56ea32f69f493efe9fe4a24072a17efe86e4eae54ea93821cd30af59c892cdc6b2528d76fc359e9bd7e97852d29425b9ea916458670636350f5bf274aa63323e2f73e8ebddd2f0bdb239f4933e19f8a508d5db82fabdfab37c9943ff2dffe655c9ad3afb7254a431af790853b2fce8926820433e5b09076ff02314004234e12c3b3ba06efa522bd6dbc306faa7f83026ddc4e44c3f6666fb315f24614ec380559c276498182a2bc01e52a4d50a36dd7021e08a347c473d5aa5a9cb15411125f588598790078353222b75958f79928f19f2eb78c9859228757a3c45f267381bd4ab1cc4f2f8a047f6bfbacf41e5ab9de4abafe465549a0f53640e4d9579b34072a66453cd21f567c3650ef512d16a23b95322a1bee1527d061b3ea10010420821840240082184100a0021841042280084104208a10010420821840240082184500008218410420120841042080580104208211400420821845000082184104201208410420805801042082114004208218450000821841042012084104208058010420821140042082184500008218410420120841042080580104208211400420821845000082184100a0021841042280084104208a10010420821840240082184100a0021841042280084104208a10010420821840240082184100a0021841042280084104208a10010420821840240082184100a0021841042280084104208a10010420821840240082184100a0021841042016012082184100a0021841042280084104208a10010420821840240082184100a0021841042280084104208a10010420821840240082184100a0021841042280084104208a10010420821840240082184100a0021841042280084104208a10010420821840240082184102680104208a10010420821840240082184100a0021841042280084104208a10010420821840240082184100a0021841042280084104208a10010420821840240082184100a0021841042280084104208a100104208212446fe3ff817dc02eea297b50000000049454e44ae426082);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_equipos`
--

CREATE TABLE `detalles_equipos` (
  `id_asignacion` int(11) NOT NULL,
  `msd` varchar(50) NOT NULL,
  `antivirus` varchar(50) NOT NULL,
  `visio_pro` varchar(50) NOT NULL,
  `mac_osx` varchar(50) NOT NULL,
  `windows` varchar(50) NOT NULL,
  `autocad` varchar(50) NOT NULL,
  `office` varchar(50) NOT NULL,
  `appolo` varchar(50) NOT NULL,
  `zeus` varchar(50) NOT NULL,
  `otros` text NOT NULL,
  `procesador` varchar(100) NOT NULL,
  `disco_duro` varchar(50) NOT NULL,
  `memoria_ram` varchar(50) NOT NULL,
  `cd_dvd` varchar(300) NOT NULL,
  `tarjeta_video` varchar(300) NOT NULL,
  `tarjeta_red` varchar(300) NOT NULL,
  `tipo_red` enum('Cableada','Wifi') NOT NULL,
  `tiempo_bloqueo` enum('Si','No') NOT NULL,
  `usuario` enum('Si','No') NOT NULL,
  `clave` enum('Si','No') NOT NULL,
  `zfip` enum('Si','No') NOT NULL,
  `privilegios` enum('Estandar','Administrador') NOT NULL,
  `backup` varchar(300) NOT NULL,
  `dia_backup` enum('Lunes','Martes','Miercoles','Jueves','Viernes') NOT NULL,
  `realiza_backup` enum('Si','No') NOT NULL,
  `justificacion_backup` text NOT NULL,
  `id_activo_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_actividad`
--

CREATE TABLE `detalle_actividad` (
  `id_detalle_acpm` int(11) NOT NULL,
  `fecha_evidencia` date NOT NULL DEFAULT current_timestamp(),
  `evidencia` text NOT NULL,
  `recursos` text NOT NULL,
  `id_actividad_fk` int(11) NOT NULL,
  `id_usuario_e_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_orden`
--

CREATE TABLE `detalle_orden` (
  `id_orden_detalle` int(11) NOT NULL,
  `articulo_compra` text NOT NULL,
  `cantidad_orden` float NOT NULL,
  `valor_neto` float NOT NULL,
  `valor_iva` float NOT NULL,
  `valor_total` float NOT NULL,
  `observaciones_articulo` text NOT NULL,
  `id_orden_compra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_accionista`
--

CREATE TABLE `empresa_accionista` (
  `nit_e_accionista` char(11) NOT NULL,
  `nombre_empresa_accionista` varchar(255) NOT NULL,
  `num_accionistas` float NOT NULL,
  `nit_asociado_n` char(11) DEFAULT NULL,
  `empresa_padre_id` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estado_inventario` enum('Activo','Finalizado') NOT NULL,
  `id_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientos`
--

CREATE TABLE `mantenimientos` (
  `id_mantenimiento` int(11) NOT NULL,
  `id_proceso_fk` int(11) NOT NULL,
  `fecha_mantenimiento` date NOT NULL,
  `Id_usuario_fk` int(11) NOT NULL,
  `id_cargo_fk` int(11) NOT NULL,
  `correo_destinatario` varchar(100) NOT NULL,
  `marca` varchar(200) NOT NULL,
  `modelo` varchar(200) NOT NULL,
  `serie` varchar(100) NOT NULL,
  `usuario_equipo` varchar(100) NOT NULL,
  `soplar_partes_externas` enum('SI','NO') NOT NULL,
  `verificar_usuario` enum('SI','NO') NOT NULL,
  `liberar_espacio` enum('SI','NO') NOT NULL,
  `actualizar_logos` enum('SI','NO') NOT NULL,
  `lubricar_puertos` enum('SI','NO') NOT NULL,
  `verificar_contraseñas` enum('SI','NO') NOT NULL,
  `desinstalar_programas` enum('SI','NO') NOT NULL,
  `organizar_cableado` enum('SI','NO') NOT NULL,
  `limpieza_equipo` enum('SI','NO') NOT NULL,
  `formato_asignacion_equipo` enum('SI','NO') NOT NULL,
  `desfragmentar` enum('SI','NO') NOT NULL,
  `limpiar_partes_interna` enum('SI','NO') NOT NULL,
  `depurar_temporales` enum('SI','NO') NOT NULL,
  `verificar_actualizaciones` enum('SI','NO') NOT NULL,
  `usuario` enum('SI','NO') NOT NULL,
  `clave` enum('SI','NO') NOT NULL,
  `estandar` enum('SI','NO') NOT NULL,
  `administrador` enum('SI','NO') NOT NULL,
  `analisis_completo` enum('SI','NO') NOT NULL,
  `bloqueo_usb` enum('SI','NO') NOT NULL,
  `dominio_zfip` enum('SI','NO') NOT NULL,
  `apagar_pantalla` enum('SI','NO') NOT NULL,
  `estado_suspension` enum('SI','NO') NOT NULL,
  `firma` text DEFAULT NULL,
  `estado_mantenimiento_equipo` enum('Sin Firmar','Firmado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_general`
--

CREATE TABLE `mantenimiento_general` (
  `id_general` int(100) NOT NULL,
  `id_proceso_fk_3` int(11) NOT NULL,
  `fecha_mantenimiento3` date NOT NULL,
  `Id_usuario_fk3` int(11) NOT NULL,
  `id_cargo_fk3` int(11) NOT NULL,
  `correo_destinatario2` varchar(100) NOT NULL,
  `articulo` varchar(100) NOT NULL,
  `marca_general` varchar(100) NOT NULL,
  `modelo_general` varchar(100) NOT NULL,
  `serial_general` varchar(100) NOT NULL,
  `partes_externas` enum('SI','NO') NOT NULL,
  `condiciones_fisicas` enum('SI','NO') NOT NULL,
  `cableado_verificar` enum('SI','NO') NOT NULL,
  `dispositivo` enum('SI','NO') NOT NULL,
  `estado_general` enum('Sin Firmar','Firmado') NOT NULL,
  `firma_general` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_impresora`
--

CREATE TABLE `mantenimiento_impresora` (
  `id_impresora` int(200) NOT NULL,
  `id_proceso_fk_2` int(11) NOT NULL,
  `fecha_mantenimiento_impresora` date NOT NULL,
  `Id_usuario_fk2` int(11) NOT NULL,
  `id_cargo_fk2` int(11) NOT NULL,
  `correo_destinatario1` varchar(100) NOT NULL,
  `nombre_impresora` varchar(200) NOT NULL,
  `marca_impresora` varchar(200) NOT NULL,
  `modelo_impresora` varchar(200) NOT NULL,
  `serial_impresora` varchar(200) NOT NULL,
  `soplar_exterior` enum('Si','No') NOT NULL,
  `isopropilico` enum('Si','No') NOT NULL,
  `toner` enum('Si','No') NOT NULL,
  `alinear` enum('Si','No') NOT NULL,
  `verificar_cableado` enum('Si','No') NOT NULL,
  `rodillos` enum('Si','No') NOT NULL,
  `reemplazar` enum('Si','No') NOT NULL,
  `limpiar` enum('Si','No') NOT NULL,
  `imprimir` enum('Si','No') NOT NULL,
  `verificar` enum('SI','NO') NOT NULL,
  `estado_mantenimiento_impresora` enum('Sin Firmar','Firmado') NOT NULL,
  `firma_impresora` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `id_orden` int(11) NOT NULL,
  `fecha_orden` date DEFAULT NULL,
  `proveedor_recurrente` enum('Si','No') NOT NULL,
  `forma_pago` enum('Contado','Credito','Anticipo','Otros') DEFAULT NULL,
  `tiempo_pago` varchar(50) DEFAULT NULL,
  `porcentaje_anticipo` float DEFAULT NULL,
  `condiciones_negociacion` text DEFAULT NULL,
  `comentario_orden` text DEFAULT NULL,
  `tiempo_entrega` varchar(300) DEFAULT NULL,
  `total_orden` float DEFAULT NULL,
  `analisis_cotizacion` enum('Si','No') DEFAULT NULL,
  `estado_orden` enum('Proceso','Aprobada','Denegada','Analisis de Cotizacion','Ejecutada') DEFAULT NULL,
  `descripcion_declinado` text DEFAULT NULL,
  `fecha_aprobacion` datetime DEFAULT NULL,
  `id_cotizante` int(11) DEFAULT NULL,
  `id_proveedor_fk` int(11) DEFAULT NULL,
  `id_gerente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `perfil` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `ModuloTI` enum('off','on') DEFAULT NULL,
  `AdminUsuarios` enum('off','on') DEFAULT NULL,
  `VerUsuarios` enum('off','on') DEFAULT NULL,
  `EstadoUsuarios` enum('off','on') DEFAULT NULL,
  `AdminPerfiles` enum('off','on') DEFAULT NULL,
  `AdminMantenimientos` enum('off','on') DEFAULT NULL,
  `InventarioEquipos` enum('off','on') DEFAULT NULL,
  `AdminSoporte` enum('off','on') DEFAULT NULL,
  `SolicitudSoporte` enum('off','on') DEFAULT NULL,
  `ConsultarSoporte` enum('off','on') DEFAULT NULL,
  `AdminAcpm` enum('off','on') DEFAULT NULL,
  `CrearAcpm` enum('on','off') DEFAULT NULL,
  `ConsultarAcpm` enum('off','on') DEFAULT NULL,
  `EditarAcpm` enum('off','on') DEFAULT NULL,
  `EliminarAcpm` enum('off','on') DEFAULT NULL,
  `AsignarActividades` enum('off','on') DEFAULT NULL,
  `ResponderActividades` enum('off','on') DEFAULT NULL,
  `VerActividades` enum('on','off') DEFAULT NULL,
  `EditarActividades` enum('off','on') DEFAULT NULL,
  `EliminarActividades` enum('off','on') DEFAULT NULL,
  `ArchivosSadoc` enum('off','on') DEFAULT NULL,
  `CarpetasSadoc` enum('off','on') DEFAULT NULL,
  `EliminarSadoc` enum('off','on') DEFAULT NULL,
  `SolicitudCodificacion` enum('off','on') DEFAULT NULL,
  `ResponderCodificacion` enum('off','on') DEFAULT NULL,
  `ConsultarCodificacion` enum('off','on') DEFAULT NULL,
  `EditarCodificacion` enum('off','on') DEFAULT NULL,
  `EliminarCodificacion` enum('off','on') DEFAULT NULL,
  `CrearOrden` enum('off','on') DEFAULT NULL,
  `EditarOrden` enum('off','on') DEFAULT NULL,
  `EliminarOrden` enum('off','on') DEFAULT NULL,
  `ConsultarOrden` enum('off','on') DEFAULT NULL,
  `AdminProveedorLider` enum('off','on') DEFAULT NULL,
  `AdminProveedorCT` enum('off','on') DEFAULT NULL,
  `AprobacionGH` enum('off','on') DEFAULT NULL,
  `AprobacionGR` enum('off','on') DEFAULT NULL,
  `AprobacionCT` enum('off','on') DEFAULT NULL,
  `CrearBascula` enum('off','on') DEFAULT NULL,
  `ConsultarBascula` enum('off','on') DEFAULT NULL,
  `EditarBascula` enum('off','on') DEFAULT NULL,
  `BasculaProceso` enum('off','on') DEFAULT NULL,
  `BasculaFact` enum('off','on') DEFAULT NULL,
  `ValorPesaje` enum('off','on') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`perfil`, `descripcion`, `ModuloTI`, `AdminUsuarios`, `VerUsuarios`, `EstadoUsuarios`, `AdminPerfiles`, `AdminMantenimientos`, `InventarioEquipos`, `AdminSoporte`, `SolicitudSoporte`, `ConsultarSoporte`, `AdminAcpm`, `CrearAcpm`, `ConsultarAcpm`, `EditarAcpm`, `EliminarAcpm`, `AsignarActividades`, `ResponderActividades`, `VerActividades`, `EditarActividades`, `EliminarActividades`, `ArchivosSadoc`, `CarpetasSadoc`, `EliminarSadoc`, `SolicitudCodificacion`, `ResponderCodificacion`, `ConsultarCodificacion`, `EditarCodificacion`, `EliminarCodificacion`, `CrearOrden`, `EditarOrden`, `EliminarOrden`, `ConsultarOrden`, `AdminProveedorLider`, `AdminProveedorCT`, `AprobacionGH`, `AprobacionGR`, `AprobacionCT`, `CrearBascula`, `ConsultarBascula`, `EditarBascula`, `BasculaProceso`, `BasculaFact`, `ValorPesaje`) VALUES
(56, 'MELISSA', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off'),
(71, 'HHH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 'S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pesaje_bascula`
--

CREATE TABLE `pesaje_bascula` (
  `id_pesaje` int(11) NOT NULL,
  `fecha_pesaje` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `placa` varchar(10) DEFAULT NULL,
  `fecha_uno` datetime DEFAULT NULL,
  `peso_uno` float DEFAULT NULL,
  `fecha_dos` datetime DEFAULT NULL,
  `peso_dos` float DEFAULT NULL,
  `peso_neto` float DEFAULT NULL,
  `valor_bruto` float DEFAULT NULL,
  `iva` float DEFAULT NULL,
  `valor_total` float DEFAULT NULL,
  `id_cliente_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pesaje_bascula`
--

INSERT INTO `pesaje_bascula` (`id_pesaje`, `fecha_pesaje`, `placa`, `fecha_uno`, `peso_uno`, `fecha_dos`, `peso_dos`, `peso_neto`, `valor_bruto`, `iva`, `valor_total`, `id_cliente_fk`) VALUES
(30, '2024-06-28 19:58:32', 'SDF', NULL, 43, NULL, NULL, NULL, NULL, NULL, NULL, 21),
(31, '2024-06-28 19:58:32', 'SDF', NULL, 43, NULL, NULL, NULL, NULL, NULL, NULL, 21),
(32, '2024-06-28 20:01:19', 'ASDF', NULL, 454, NULL, NULL, NULL, NULL, NULL, NULL, 21),
(33, '2024-06-28 20:01:19', 'ASDF', NULL, 454, NULL, NULL, NULL, NULL, NULL, NULL, 21),
(34, '2024-06-28 20:03:24', 'ASDF', NULL, 454, NULL, NULL, NULL, NULL, NULL, NULL, 21),
(35, '2024-06-28 20:03:34', 'asfdf', NULL, 456, NULL, NULL, NULL, NULL, NULL, NULL, 21),
(36, '2024-06-28 20:04:21', 'SADSAD', NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

CREATE TABLE `proceso` (
  `id_proceso` int(11) NOT NULL,
  `siglas_proceso` varchar(20) NOT NULL,
  `nombre_proceso` varchar(30) NOT NULL,
  `estado_proceso` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `proceso`
--

INSERT INTO `proceso` (`id_proceso`, `siglas_proceso`, `nombre_proceso`, `estado_proceso`) VALUES
(1, 'SIG', 'Sistema Integrado de Gestion', 'Activo'),
(2, 'TI', 'Tecnologi­a e Informatica', 'Activo'),
(3, 'CT', 'Contabilidad', 'Activo'),
(4, 'TEC', 'Tecnico', 'Activo'),
(5, 'GH', 'Gestion Humana', 'Activo'),
(6, 'GD', 'Gestion Documental', 'Activo'),
(7, 'OP', 'Operaciones', 'Activo'),
(8, 'PH', 'Propiedad Horizontal', 'Activo'),
(9, 'SST', 'Seguridad Salud en el Trabajo', 'Activo'),
(10, 'GR', 'Gerencia', 'Activo'),
(11, 'JR', 'Gestion Juridica', 'Activo'),
(12, 'PLE', 'Planeacion Estrategia', 'Activo'),
(13, 'SG', 'SEGURIDAD', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_compras`
--

CREATE TABLE `proveedor_compras` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(200) NOT NULL,
  `contacto_proveedor` varchar(100) NOT NULL,
  `telefono_proveedor` varchar(15) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sadoc`
--

CREATE TABLE `sadoc` (
  `id` int(11) NOT NULL,
  `ruta` varchar(500) NOT NULL,
  `ruta_principal` varchar(500) NOT NULL,
  `Fecha_Subida` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('activo','inactivo') NOT NULL,
  `sub_Carpeta` enum('Si','No') NOT NULL,
  `id_proceso_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_codificacion`
--

CREATE TABLE `solicitud_codificacion` (
  `id_codificacion` int(11) NOT NULL,
  `vigencia` enum('Nuevo','Antiguo') DEFAULT NULL,
  `fecha_solicitud_cod` date DEFAULT NULL,
  `usuario_solicitud_cod` int(200) DEFAULT NULL,
  `cargo_solicitud_cod` int(200) DEFAULT NULL,
  `nombre_documento` int(100) DEFAULT NULL,
  `codigo` int(100) DEFAULT NULL,
  `descripcion_cambio` int(200) DEFAULT NULL,
  `elabora_nombre` int(100) DEFAULT NULL,
  `elabora_correo` int(100) DEFAULT NULL,
  `revisa_nombre` int(100) DEFAULT NULL,
  `revisa_correo` int(100) DEFAULT NULL,
  `aprueba_nombre` int(100) DEFAULT NULL,
  `aprueba_correo` int(100) DEFAULT NULL,
  `codigo_doc_afectado` int(100) DEFAULT NULL,
  `nombre_doc_afectado` int(100) DEFAULT NULL,
  `afecta` enum('Si','No') DEFAULT NULL,
  `todos_colaboradores` enum('Si','No') DEFAULT NULL,
  `solo_lider` enum('Si','No') DEFAULT NULL,
  `miembros_proceso` enum('Si','No') DEFAULT NULL,
  `colaborador_expecifico` enum('Si','No') DEFAULT NULL,
  `nombre_interna` int(100) DEFAULT NULL,
  `correo_interna` int(100) DEFAULT NULL,
  `nombre_externa` int(100) DEFAULT NULL,
  `correo_externa` int(100) DEFAULT NULL,
  `enviar_copia` enum('Si','No') DEFAULT NULL,
  `estado_sig_codificacion` enum('Aprobado','Rechazado') DEFAULT NULL,
  `fecha_sig_codificacion` date DEFAULT NULL,
  `responsable_sig_codificacion` int(100) DEFAULT NULL,
  `causa_rechazo_codificacion` int(200) DEFAULT NULL,
  `evidencia_difucion` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soporte`
--

CREATE TABLE `soporte` (
  `id_soporte` int(11) NOT NULL,
  `correo_soporte` varchar(100) NOT NULL,
  `Id_usuario_fk` int(11) NOT NULL,
  `usuario_soporte` varchar(100) NOT NULL,
  `proceso_soporte` varchar(100) NOT NULL,
  `descripcion_soporte` varchar(600) NOT NULL,
  `imagenes_soporte` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `fecha_soporte` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `urgencia` enum('1','2','3') DEFAULT NULL,
  `solucion_soporte` varchar(200) DEFAULT NULL,
  `fecha_solucion` date DEFAULT NULL,
  `usuario_respuesta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `rol_usuario` varchar(100) NOT NULL,
  `admin_acpm` enum('Si','No') NOT NULL,
  `radicar_acpm` enum('Si','No') NOT NULL,
  `admin_sadoc` enum('Si','No') NOT NULL,
  `consultar_sadoc` enum('Si','No') NOT NULL,
  `ordenes` enum('Si','No') NOT NULL,
  `admin_compras` enum('Si','No') NOT NULL,
  `pagar_ordenes` enum('Si','No') NOT NULL,
  `analisis_cotizacion` enum('Si','No') NOT NULL,
  `radicar_orden` enum('Si','No') NOT NULL,
  `firmar_orden` enum('Si','No') NOT NULL,
  `evaluar_proveedor` enum('Si','No') NOT NULL,
  `admin_activos` enum('Si','No','','') NOT NULL,
  `consultar_activos` enum('Si','No','','') NOT NULL,
  `ingresar_activos` enum('Si','No') NOT NULL,
  `editar_activos` enum('Si','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `rol_usuario`, `admin_acpm`, `radicar_acpm`, `admin_sadoc`, `consultar_sadoc`, `ordenes`, `admin_compras`, `pagar_ordenes`, `analisis_cotizacion`, `radicar_orden`, `firmar_orden`, `evaluar_proveedor`, `admin_activos`, `consultar_activos`, `ingresar_activos`, `editar_activos`) VALUES
(1, 'superadmin', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si'),
(2, 'admin_sig', 'Si', 'Si', 'Si', 'Si', 'Si', 'No', 'No', 'No', 'Si', 'No', 'Si', 'Si', 'Si', 'Si', 'Si'),
(3, 'usuario_aux', 'No', 'No', 'No', 'Si', 'Si', 'No', 'No', 'No', 'No', 'No', 'No', 'Si', 'Si', 'Si', 'Si'),
(4, 'gerencia', 'No', 'Si', 'No', 'Si', 'Si', 'No', 'No', 'No', 'No', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si'),
(5, 'directivo', 'No', 'Si', 'No', 'Si', 'Si', 'No', 'No', 'No', 'Si', 'No', 'Si', 'Si', 'Si', 'Si', 'Si'),
(6, 'aux_cotizacion', 'No', 'No', 'No', 'Si', 'Si', 'No', 'No', 'Si', 'No', 'No', 'Si', 'Si', 'Si', 'Si', 'Si'),
(7, 'aux_contable', 'No', 'No', 'No', 'Si', 'Si', 'No', 'Si', 'No', 'No', 'No', 'No', 'Si', 'Si', 'Si', 'Si'),
(8, 'admin_contable', 'No', 'Si', 'No', 'Si', 'Si', 'No', 'Si', 'No', 'Si', 'No', 'Si', 'Si', 'Si', 'Si', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellidos_usuario` varchar(100) NOT NULL,
  `usuario` text NOT NULL,
  `password` text NOT NULL,
  `perfil` int(11) NOT NULL,
  `firma` text NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `id_cargo_fk` int(11) NOT NULL,
  `id_proceso_fk` int(11) NOT NULL,
  `ultimo_login` datetime DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `intentos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos_usuario`, `usuario`, `password`, `perfil`, `firma`, `estado`, `id_cargo_fk`, `id_proceso_fk`, `ultimo_login`, `fecha`, `intentos`) VALUES
(1, 'Administrador', '', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 1, 'vistas/img/usuarios/admin/489.jpg', 1, 0, 0, '2024-06-28 15:04:12', '2020-04-27 20:20:56', 2),
(2, 'vendedor', '', 'vendedor', '$2a$07$asxx54ahjppf45sd87a5auF3SxTPxKrykQWP2opioJ/PI/QjcniEW', 4, '', 0, 1, 0, '2022-08-02 14:02:24', '2022-08-02 16:07:21', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vencimiento_acpm`
--

CREATE TABLE `vencimiento_acpm` (
  `id_notificacion` int(11) NOT NULL,
  `id_acpm_fk` int(11) NOT NULL,
  `fecha_vencimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acpm`
--
ALTER TABLE `acpm`
  ADD PRIMARY KEY (`id_consecutivo`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`);

--
-- Indices de la tabla `acpm_rechazada`
--
ALTER TABLE `acpm_rechazada`
  ADD PRIMARY KEY (`id_rechazada`),
  ADD KEY `id_acpm_fk` (`id_acpm_fk`);

--
-- Indices de la tabla `actividades_acpm`
--
ALTER TABLE `actividades_acpm`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`),
  ADD KEY `id_acpm_fk` (`id_acpm_fk`);

--
-- Indices de la tabla `activos`
--
ALTER TABLE `activos`
  ADD PRIMARY KEY (`id_activo`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`),
  ADD KEY `id_proveedor` (`id_proveedor_fk`);

--
-- Indices de la tabla `asignacion_equipos`
--
ALTER TABLE `asignacion_equipos`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `id_ti_fk` (`id_ti_fk`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`);

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datosempresa`
--
ALTER TABLE `datosempresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalles_equipos`
--
ALTER TABLE `detalles_equipos`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `id_activo_fk` (`id_activo_fk`);

--
-- Indices de la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
  ADD PRIMARY KEY (`id_detalle_acpm`);

--
-- Indices de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  ADD PRIMARY KEY (`id_orden_detalle`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`);

--
-- Indices de la tabla `mantenimientos`
--
ALTER TABLE `mantenimientos`
  ADD PRIMARY KEY (`id_mantenimiento`);

--
-- Indices de la tabla `mantenimiento_general`
--
ALTER TABLE `mantenimiento_general`
  ADD PRIMARY KEY (`id_general`);

--
-- Indices de la tabla `mantenimiento_impresora`
--
ALTER TABLE `mantenimiento_impresora`
  ADD PRIMARY KEY (`id_impresora`);

--
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`id_orden`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`perfil`);

--
-- Indices de la tabla `pesaje_bascula`
--
ALTER TABLE `pesaje_bascula`
  ADD PRIMARY KEY (`id_pesaje`);

--
-- Indices de la tabla `proceso`
--
ALTER TABLE `proceso`
  ADD PRIMARY KEY (`id_proceso`);

--
-- Indices de la tabla `proveedor_compras`
--
ALTER TABLE `proveedor_compras`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`);

--
-- Indices de la tabla `sadoc`
--
ALTER TABLE `sadoc`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud_codificacion`
--
ALTER TABLE `solicitud_codificacion`
  ADD PRIMARY KEY (`id_codificacion`);

--
-- Indices de la tabla `soporte`
--
ALTER TABLE `soporte`
  ADD PRIMARY KEY (`id_soporte`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vencimiento_acpm`
--
ALTER TABLE `vencimiento_acpm`
  ADD PRIMARY KEY (`id_notificacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `datosempresa`
--
ALTER TABLE `datosempresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
  MODIFY `id_detalle_acpm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  MODIFY `id_orden_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimientos`
--
ALTER TABLE `mantenimientos`
  MODIFY `id_mantenimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimiento_general`
--
ALTER TABLE `mantenimiento_general`
  MODIFY `id_general` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimiento_impresora`
--
ALTER TABLE `mantenimiento_impresora`
  MODIFY `id_impresora` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `pesaje_bascula`
--
ALTER TABLE `pesaje_bascula`
  MODIFY `id_pesaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `proceso`
--
ALTER TABLE `proceso`
  MODIFY `id_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `sadoc`
--
ALTER TABLE `sadoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_codificacion`
--
ALTER TABLE `solicitud_codificacion`
  MODIFY `id_codificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `soporte`
--
ALTER TABLE `soporte`
  MODIFY `id_soporte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `vencimiento_acpm`
--
ALTER TABLE `vencimiento_acpm`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
