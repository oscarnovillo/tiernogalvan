-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-06-2018 a las 08:12:09
-- Versión del servidor: 5.7.22-0ubuntu18.04.1
-- Versión de PHP: 7.2.5-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiernogalvan`
--
use daw2_pruebas;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ACC_MODIFICAR_BT`
--

CREATE TABLE `ACC_MODIFICAR_BT` (
  `ID_PERMISO` int(11) NOT NULL,
  `DESCRIPCION` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ACC_MODIFICAR_BT`
--

INSERT INTO `ACC_MODIFICAR_BT` (`ID_PERMISO`, `DESCRIPCION`) VALUES
(2, 'PROFESOR'),
(3, 'ADMINISTRACION'),
(5, 'EMPRESA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `APUNTARSE_OFERTA`
--

CREATE TABLE `APUNTARSE_OFERTA` (
  `ID_APUNTAR` int(11) NOT NULL,
  `ID_OFERTA` int(11) NOT NULL,
  `ID_ALUMNO` int(11) NOT NULL,
  `NOTIFICADO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `APUNTARSE_OFERTA`
--

INSERT INTO `APUNTARSE_OFERTA` (`ID_APUNTAR`, `ID_OFERTA`, `ID_ALUMNO`, `NOTIFICADO`) VALUES
(21, 73, 152, 1),
(22, 78, 152, 1),
(23, 79, 153, 1),
(24, 81, 154, 1),
(25, 79, 154, 1),
(26, 78, 174, 1),
(27, 81, 174, 1),
(28, 81, 178, 1),
(29, 95, 188, 1),
(30, 97, 193, 1),
(31, 97, 194, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ASIGNATURAS`
--

CREATE TABLE `ASIGNATURAS` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ASIGNATURAS`
--

INSERT INTO `ASIGNATURAS` (`ID`, `NOMBRE`) VALUES
(1, 'AsignaturaBlabla'),
(2, 'Asignatura2'),
(3, 'Asignatura'),
(4, 'AsignaturaPresentacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ASIGNATURA_UNIDADTRABAJO`
--

CREATE TABLE `ASIGNATURA_UNIDADTRABAJO` (
  `ID_ASIGNATURA` int(11) NOT NULL,
  `ID_UNIDAD_TRABAJO` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ASIGNATURA_UNIDADTRABAJO`
--

INSERT INTO `ASIGNATURA_UNIDADTRABAJO` (`ID_ASIGNATURA`, `ID_UNIDAD_TRABAJO`) VALUES
(2, '1'),
(2, '2'),
(4, '4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategorias` int(11) NOT NULL,
  `Categoria` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategorias`, `Categoria`) VALUES
(20, 'PresentacionFOlder');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `nombre_curso` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `turno` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `nombre_curso`, `tipo`, `turno`) VALUES
(1, '1º E.S.O.', 'ESO', 'm'),
(2, '2º E.S.O.', 'ESO', 'm'),
(3, '3º E.S.O.', 'ESO', 'm'),
(4, '4º E.S.O.', 'ESO', 'm'),
(5, '1º Bachillerato', 'BACH', 'm'),
(6, '2º Bachillerato', 'BACH', 'm'),
(7, '1º Mantenimiento de vehículos', 'FPB', 'm'),
(8, '2º Mantenimiento de vehículos', 'FPB', 'm'),
(9, '1º Mantenimiento de vehículos', 'FPB', 't'),
(10, '2º Mantenimiento de vehículos', 'FPB', 't'),
(11, '1º Carrocería', 'FPGM', 'm'),
(12, '2º Carrocería', 'FPGM', 'm'),
(13, '1º Instalaciones Eléctricas y Automáticas', 'FPGM', 'm'),
(14, '2º Instalaciones Eléctricas y Automáticas', 'FPGM', 'm'),
(15, '1º Instalaciones de Producción de Calor', 'FPGM', NULL),
(16, '2º Instalaciones de Producción de Calor', 'FPGM', 'm'),
(17, '1º ASIR', 'FPGS', 't'),
(18, '2º ASIR', 'FPGS', 't'),
(19, '1º Mantenimiento de Instalaciones Térmicas y Fluidos', 'FPGS', 't'),
(20, '2º Mantenimiento de Instalaciones Térmicas y Fluidos', 'FPGS', 't'),
(21, '1º Automoción', 'FPGS', 't'),
(22, '2º Automoción', 'FPGS', 't'),
(23, '1º DAW', 'FPGS', 'm'),
(24, '2º DAW', 'FPGS', 'm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CURSOS_ASIGNATURAS`
--

CREATE TABLE `CURSOS_ASIGNATURAS` (
  `ID_CURSO` int(11) NOT NULL,
  `ID_ASIGNATURA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `CURSOS_ASIGNATURAS`
--

INSERT INTO `CURSOS_ASIGNATURAS` (`ID_CURSO`, `ID_ASIGNATURA`) VALUES
(23, 1),
(23, 2),
(15, 3),
(14, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci,
  `activo` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `activo`) VALUES
(1, 'Informática\r\n', 1),
(7, 'Religión', 1),
(9, 'Matemáticas', 0),
(13, 'Lengua', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos_contabilidad`
--

CREATE TABLE `departamentos_contabilidad` (
  `de_codigo` varchar(5) NOT NULL,
  `de_descri_es` varchar(30) NOT NULL,
  `de_descri_en` varchar(30) NOT NULL,
  `de_tipo` int(1) NOT NULL,
  `de_url` varchar(4) NOT NULL,
  `de_jefe` varchar(9) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamentos_contabilidad`
--

INSERT INTO `departamentos_contabilidad` (`de_codigo`, `de_descri_es`, `de_descri_en`, `de_tipo`, `de_url`, `de_jefe`) VALUES
('AUTO', 'Automoción', 'Self propulsion', 1, 'aut', '02209190V'),
('BIO', 'Biología y Geología', 'Biology & Geology', 0, 'bio', '50168691X'),
('DIBU', 'Dibujo', 'Drawing', 0, 'dib', '07211460V'),
('ECO', 'Economía', 'Economics', 0, 'eco', '70869563P'),
('EFISI', 'Educación física', 'Physical education', 0, 'edu', '51376147N'),
('ELECA', 'Electricidad y Electrónica', 'Electricity & Electronics', 1, 'ele', '50716342P'),
('FILO', 'Filosofía', 'Philosophy', 0, 'fil', '77293396X'),
('EXT', 'Actividades Extraesc.', 'Out of School Activities', 0, 'ext', '05169553G'),
('FIQUI', 'Física y Química', 'Physics & Chemistry', 0, 'fis', '08098709H'),
('FRAN', 'Francés', 'French', 0, 'fra', '00384881E'),
('FRIO', 'Frío y calor', 'Hot & cold', 1, 'fri', '51628582E'),
('FOL', 'F.O.L.', 'Training & Guidance', 1, 'fol', '50713881P'),
('GEO', 'Geografía e Historia', 'Geography & History', 0, 'geo', '70568385S'),
('INFOR', 'Informática', 'Information technology', 1, 'inf', '51856856K'),
('ING', 'Inglés', 'English', 0, 'ing', '25981256L'),
('LEN', 'Lengua y Literatura', 'Language & Literature', 0, 'len', '51979639F'),
('LAT', 'Latín', 'Latin', 0, 'lat', '08105845R'),
('MATE', 'Matemáticas', 'Mathematics', 0, 'mat', '01110509T'),
('MUS', 'Música', 'Music', 0, 'mus', '09762481Q'),
('ORIEN', 'Orientación', 'Guidance', 0, 'ori', '50691126T'),
('RELI', 'Religión', 'Religion', 0, 'rel', '01912313R'),
('TECNO', 'Tecnología', 'Technology', 0, 'tec', '05271916V'),
('PCPI', 'PCPI', 'PCPI', 2, 'pcpi', NULL),
('SAED', 'S.A.E.D.', 'S.A.E.D.', 2, 'saed', NULL),
('CAMPE', 'Campeonatos Escolares', 'Campeonatos escolares', 2, 'cam', NULL),
('JESTU', 'Jefatura de Estudios', 'Jefatura de Estudios', 2, 'jes', NULL),
('ELEC', 'Electricidad', 'Electricidad', 2, 'edad', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `idDocumentos` int(11) NOT NULL,
  `Documento` varchar(150) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`idDocumentos`, `Documento`, `idCategoria`) VALUES
(10, 'GonzalezS.pdf', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EMAIL_COUNTER_BT`
--

CREATE TABLE `EMAIL_COUNTER_BT` (
  `ID_CONTADOR` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NUM` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `EMAIL_COUNTER_BT`
--

INSERT INTO `EMAIL_COUNTER_BT` (`ID_CONTADOR`, `NUM`) VALUES
('CONTADOR', 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ENVIAR_OFERTAS`
--

CREATE TABLE `ENVIAR_OFERTAS` (
  `ID_NOTIFICAR` int(11) NOT NULL,
  `ID_OFERTA` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `NOTIFICADO` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ENVIAR_OFERTAS`
--

INSERT INTO `ENVIAR_OFERTAS` (`ID_NOTIFICAR`, `ID_OFERTA`, `ID_USER`, `NOTIFICADO`) VALUES
(27, 74, 153, 1),
(28, 74, 152, 1),
(29, 75, 154, 1),
(30, 76, 154, 1),
(31, 82, 154, 1),
(32, 82, 152, 1),
(33, 73, 178, 1),
(34, 73, 157, 0),
(35, 73, 188, 1),
(36, 73, 194, 1),
(37, 79, 193, 1),
(38, 81, 193, 1),
(39, 83, 193, 1),
(40, 97, 153, 1),
(41, 97, 174, 1),
(42, 97, 178, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESTUDIOS_ALUMNO`
--

CREATE TABLE `ESTUDIOS_ALUMNO` (
  `ID_ALUMNO` int(11) NOT NULL,
  `ID_FP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ESTUDIOS_ALUMNO`
--

INSERT INTO `ESTUDIOS_ALUMNO` (`ID_ALUMNO`, `ID_FP`) VALUES
(193, 1),
(153, 2),
(174, 2),
(154, 3),
(178, 4),
(152, 7),
(157, 8),
(194, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESTUDIOS_CENTRO`
--

CREATE TABLE `ESTUDIOS_CENTRO` (
  `ID_FP` int(11) NOT NULL,
  `TITULO` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ESTUDIOS_CENTRO`
--

INSERT INTO `ESTUDIOS_CENTRO` (`ID_FP`, `TITULO`) VALUES
(1, 'EEC - Equipos Electrónicos de Consumo'),
(2, 'IEA - Instalaciones Eléctricas y Automáticas'),
(3, 'IPC - Instalaciones de Producción de Calor'),
(4, 'IFC - Instalaciones Frigoríficas y de climatización'),
(5, 'IPCFC - Instalaciones de Producción de Calor, Frigoríficas y de Climatización'),
(6, 'Carrocería'),
(7, 'ASIR - Administración de Sistemas Informáticos en Red'),
(8, 'DAW - Desarrollo de Aplicaciones Web'),
(9, 'MITF - Mantenimiento de Instalaciones Térmicas y de Fluidos'),
(10, 'Automoción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `solicitado_por` int(11) NOT NULL,
  `departamento` int(11) NOT NULL,
  `estado` enum('completado','proceso','sinempezar') COLLATE utf8mb4_unicode_ci DEFAULT 'sinempezar',
  `fecha` datetime NOT NULL,
  `completado_por` int(11) DEFAULT NULL,
  `lugar` text COLLATE utf8mb4_unicode_ci,
  `equipo` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id`, `nombre`, `solicitado_por`, `departamento`, `estado`, `fecha`, `completado_por`, `lugar`, `equipo`) VALUES
(135, 'test', 75, 1, 'completado', '2018-06-10 22:33:35', 75, NULL, NULL),
(136, 'test', 75, 1, 'proceso', '2018-06-10 22:38:53', 75, NULL, NULL),
(137, 'test', 75, 1, 'completado', '2018-06-10 22:41:36', 75, NULL, NULL),
(138, 'test', 75, 1, 'completado', '2018-06-10 22:42:28', 75, NULL, NULL),
(139, 'test', 75, 1, 'completado', '2018-06-10 22:47:33', 75, NULL, NULL),
(140, 'test2', 75, 7, 'proceso', '2018-06-11 17:31:26', 75, NULL, NULL),
(141, 'Test final', 75, 1, 'completado', '2018-06-13 08:02:19', 75, NULL, NULL),
(152, '<p>dfg df<strong>gh dfg fgh fg fg hfg fg h<em>gfhf gfg gh fgh<u>fgh fgfgh fgh gf</u></em></strong></p>', 75, 1, 'completado', '2018-06-14 18:26:19', 75, 'lugar_test', 'equipo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias_chat`
--

CREATE TABLE `incidencias_chat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `incidencia_id` int(11) DEFAULT NULL,
  `mensaje` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `incidencias_chat`
--

INSERT INTO `incidencias_chat` (`id`, `user_id`, `incidencia_id`, `mensaje`) VALUES
(23, 75, 140, 'dfgdfgdfg'),
(24, 75, 140, 'dfgdfgdfg'),
(25, 75, 140, 'PRUEBA FINAL!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `mo_id` smallint(5) NOT NULL,
  `mo_coddep` varchar(5) DEFAULT NULL,
  `mo_fecha` date DEFAULT NULL,
  `mo_concep` varchar(50) DEFAULT NULL,
  `mo_import` decimal(10,2) NOT NULL,
  `mo_nummov` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`mo_id`, `mo_coddep`, `mo_fecha`, `mo_concep`, `mo_import`, `mo_nummov`) VALUES
(1405, 'FOL', '2018-01-01', 'SALDO INICIAL', '3267.65', 0),
(1403, 'FILO', '2018-01-01', 'SALDO INICIAL', '652.19', 0),
(1395, 'AUTO', '2018-01-01', 'SALDO INICIAL', '7500.47', 0),
(1411, 'LAT', '2018-01-01', 'SALDO INICIAL', '1238.15', 0),
(1421, 'BIO', '2018-01-26', 'OLIMPIADAS DE BIOLOGÍA', '-10.00', 38),
(1422, 'BIO', '2018-01-23', 'PROYECTO RÍO AYTO DE MADRID-USERA', '5000.00', 23),
(1423, 'ORIEN', '2018-01-23', 'AYUDA LIBROS AYTO DE MADRID-USERA', '3657.15', 24),
(1424, 'FRIO', '2018-01-26', 'DONACION INST AIRE ARANJUEZ', '288.00', 34),
(1425, 'FRIO', '2018-01-26', 'DONACION ONDOAN SERVICIOS', '576.00', 35),
(1426, 'CAMPE', '2018-01-26', 'KROMEX-EQUIPACIONES', '-347.03', 42),
(1427, 'CAMPE', '2018-01-29', 'RECARGA TARJETA TRANSPORTE', '-12.20', 44),
(1428, 'FRIO', '2018-02-01', 'DONACION REMAI, S.L.', '288.00', 53),
(1429, 'FRIO', '2018-02-01', 'SALVADOR ESCODA', '-357.11', 58),
(1430, 'INFOR', '2018-02-01', 'PC COMPONENTES', '-486.75', 59),
(1431, 'FRIO', '2018-02-02', 'MAYMOL, S.A.', '-10.19', 62),
(1432, 'FRIO', '2018-02-05', 'SALVADOR ESCODA,S.A.', '-228.11', 64),
(1433, 'FRIO', '2018-02-09', 'SALVADOR ESCODA+PEREDA+MAYMOL', '-36.33', 66),
(1434, 'FRIO', '2018-02-12', 'OXIGENO AL MAYOR, S.L.U.', '-67.60', 68),
(1435, 'FRIO', '2018-02-12', 'OXIGENO AL MAYOR, S.L.U.', '-519.15', 69),
(1436, 'LEN', '2018-02-12', 'VICENS VIVES', '-117.97', 70),
(1437, 'EXT', '2018-02-12', 'DEL OLMO AUTOCARES DPT FQ', '-137.50', 71),
(1438, 'MATE', '2018-02-12', 'INSCRIPCIÓN CONCURSO DE PRIMAVERA', '-15.00', 72),
(1439, 'FRIO', '2018-02-13', 'PALCO, ELECT, C.A.', '-55.90', 74),
(1440, 'FRIO', '2018-02-13', 'SPLIT MANIA', '-46.65', 75),
(1441, 'CAMPE', '2018-02-14', '60% CAMPEONATOS ESCOLARES', '664.17', 77),
(1442, 'FRIO', '2018-02-14', 'DONACION AIR PROYECT, S.L.', '222.00', 78),
(1443, 'BIO', '2018-02-14', 'SCIENCE BITS', '-4366.25', 80),
(1444, 'AUTO', '2018-02-15', 'LAVILINE + YOU YOU', '-26.98', 84),
(1445, 'AUTO', '2018-02-15', 'SAILUN', '-79.90', 85),
(1446, 'FRIO', '2018-02-23', 'DONACION TRANE AIRE ACONDIC', '444.00', 91),
(1447, 'BIO', '2018-02-23', 'TRIBULADORES', '-86.90', 92),
(1448, 'FRIO', '2018-02-23', 'CARBUROS METÁLICOS CONTRATO', '-121.00', 93),
(1449, 'FRIO', '2018-02-23', 'CARBUROS METÁLICOS: GASES', '-231.96', 94),
(1450, 'AUTO', '2018-02-01', 'GT2i', '-181.04', 111),
(1451, 'EXT', '2018-03-02', 'fFQ.visita M Cencia y Tecnologia', '85.00', 114),
(1452, 'EXT', '2018-03-02', 'ACT EXTRESC MUSEO CIEC Y TECN', '137.50', 116),
(1453, 'EXT', '2018-03-02', 'TEATRO FRANCÉS', '370.50', 117),
(1454, 'EFISI', '2018-03-02', 'SERV INTEGRALES GUI-AN, S.L.', '-912.90', 118),
(1455, 'BIO', '2018-03-09', 'VERNATURA', '-16.70', 143),
(1456, 'AUTO', '2018-03-09', 'CARMAN', '-112.94', 144),
(1457, 'INFOR', '2018-03-16', 'MIRASUR, S C M', '222.00', 154),
(1458, 'AUTO', '2018-03-16', 'PROYECTOR BARATO.COM', '-19.61', 158),
(1459, 'AUTO', '2018-03-16', 'HIERROS SEGOVIA', '-133.10', 160),
(1460, 'DIBU', '2018-03-19', 'BLUR EDIC+AMAZON+MOZART', '-99.88', 162),
(1461, 'AUTO', '2018-03-22', 'C. DE SALAMANCA', '684.00', 176),
(1462, 'CAMPE', '2018-04-09', 'RECARGA TARJETA METROBUS', '-48.80', 194),
(1463, 'BIO', '2018-04-13', 'MANUEL RISGO+A&B GmbH', '-76.42', 198),
(1464, 'BIO', '2018-04-13', 'DIDECO', '-41.42', 199),
(1465, 'AUTO', '2018-04-13', 'SERVIAUTO', '-84.14', 206),
(1466, 'BIO', '2018-04-13', 'ALEJANDRO SORIANO PUIGBO', '-284.00', 211),
(1467, 'MATE', '2018-04-17', 'MEDIA MARKT', '-196.99', 214),
(1468, 'BIO', '2018-04-23', 'MERCADONA', '-17.25', 220),
(1469, 'ORIEN', '2018-04-23', 'PC COMPONENTES', '-42.00', 221),
(1470, 'GEO', '2018-04-23', 'SUMAES', '-76.08', 223),
(1471, 'CAMPE', '2018-03-09', 'RECARGA TARJETA TRANSPORTE', '-48.80', 142),
(1472, 'EXT', '2018-04-24', 'ATLÁNTICA JUEGOS', '-14.95', 231),
(1473, 'CAMPE', '2018-05-08', 'CAMPEONATOS ESCOLARES', '442.77', 246),
(1474, 'EXT', '2018-05-09', '32 ENTRADAS RFEF', '-160.16', 247),
(1475, 'EXT', '2018-05-09', 'HNOS MONTOYA MADRID-LAS ROZAS-MADRID', '-200.01', 248),
(1476, 'AUTO', '2018-05-09', 'E-T-A-I IBÉRICA, S.L.', '-338.00', 249),
(1477, 'EFISI', '2018-05-09', 'SERVICIOS INTEGRALES GUI-AN S.L.', '-115.89', 250),
(1478, 'GEO', '2018-05-10', 'EL CORTE INGLES', '-59.62', 253),
(1479, 'FRIO', '2018-05-17', 'BRICOMART', '-22.39', 254),
(1480, 'AUTO', '2018-05-18', 'HIERROS Y TUBOS LORCA, S.L.', '-757.77', 256),
(1481, 'FRIO', '2018-05-18', 'FERROSERVICE', '-907.50', 261),
(1482, 'FRIO', '2018-05-18', 'CANOPINA', '-46.75', 262),
(1420, 'EFISI', '2018-01-26', 'SERVICIOS INTEGRALES GUI-AN', '-441.70', 37),
(1409, 'INFOR', '2018-01-01', 'SALDO INICIAL', '12775.64', 0),
(1397, 'CAMPE', '2018-01-01', 'SALDO INICIAL', '-88.48', 0),
(1416, 'RELI', '2018-01-01', 'SALDO INICIAL', '861.19', 0),
(1400, 'EFISI', '2018-01-01', 'SALDO INICIAL', '2768.83', 0),
(1399, 'ECO', '2018-01-01', 'SALDO INICIAL', '2430.98', 0),
(1415, 'ORIEN', '2018-01-01', 'SALDO INICIAL', '4796.05', 0),
(1414, 'MUS', '2018-01-01', 'SALDO INICIAL', '1775.75', 0),
(1413, 'MATE', '2018-01-01', 'SALDO INICIAL', '2067.53', 0),
(1402, 'EXT', '2018-01-01', 'SALDO INICIAL', '164.35', 0),
(1417, 'TECNO', '2018-01-01', 'SALDO INICIAL', '3009.45', 0),
(1418, 'AUTO', '2018-01-19', 'OXIGENO AL MAYOR', '-111.45', 14),
(1419, 'AUTO', '2018-01-19', 'SERVIAUTO', '-100.67', 15),
(1410, 'ING', '2018-01-01', 'SALDO INICIAL', '1599.58', 0),
(1398, 'DIBU', '2018-01-01', 'SALDO INICIAL', '1134.04', 0),
(1407, 'FRIO', '2018-01-01', 'SALDO INICIAL', '15202.16', 0),
(1408, 'GEO', '2018-01-01', 'SALDO INICIAL', '2779.49', 0),
(1401, 'ELEC', '2018-01-01', 'SALDO INICIAL', '8387.86', 0),
(1396, 'BIO', '2018-01-01', 'SALDO INICIAL', '3843.62', 0),
(1406, 'FRAN', '2018-01-01', 'SALDO INICIAL', '413.76', 0),
(1404, 'FIQUI', '2018-01-01', 'SALDO INICIAL', '3289.78', 0),
(1412, 'LEN', '2018-01-01', 'SALDO INICIAL', '729.42', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OFERTA`
--

CREATE TABLE `OFERTA` (
  `ID_OFERTA` int(11) NOT NULL,
  `TITULO` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DESCRIPCION` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `EMPRESA` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `WEB` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EMAIL` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TELEFONO` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `REQUISITOS` text COLLATE utf8mb4_unicode_ci,
  `VACANTES` int(2) DEFAULT NULL,
  `SALARIO` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LOCALIZACION` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CADUCIDAD` datetime(6) NOT NULL,
  `CREACION` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_USER` int(11) NOT NULL,
  `DIFUNDIDA` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `OFERTA`
--

INSERT INTO `OFERTA` (`ID_OFERTA`, `TITULO`, `DESCRIPCION`, `EMPRESA`, `WEB`, `EMAIL`, `TELEFONO`, `REQUISITOS`, `VACANTES`, `SALARIO`, `LOCALIZACION`, `CADUCIDAD`, `CREACION`, `ID_USER`, `DIFUNDIDA`) VALUES
(73, 'Demostrador (H/M) de pintura decorativa (sábados)', '<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">\r\n          <a class=\"dropdown-item\" href=\"#\">Action</a>\r\n          <a class=\"dropdown-item\" href=\"#\">Another action</a>\r\n          <div class=\"dropdown-divider\"></div>\r\n          <a class=\"dropdown-item\" href=\"#\">Something else here</a>\r\n        </div>', 'r2as', 'https://www.infojobs.net/alicante-alacant/', 'r_alexis_remache@yahoo.es', '616342559', '<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">\r\n          <a class=\"dropdown-item\" href=\"#\">Action</a>\r\n          <a class=\"dropdown-item\" href=\"#\">Another action</a>\r\n          <div class=\"dropdown-divider\"></div>\r\n          <a class=\"dropdown-item\" href=\"#\">Something else here</a>\r\n        </div>', NULL, '500', 'Barcelona, Barcelona (España)', '2018-06-30 00:00:00.000000', '2018-06-09 13:04:24', 93, 1),
(74, 'Ofertas de trabajo', 'http_response_code(Http::BAD_REQUEST);', 'r2as', '', '', '', 'http_response_code(Http::BAD_REQUEST);', NULL, '', '', '2018-06-20 00:00:00.000000', '2018-06-09 13:05:37', 93, 1),
(75, 'Demostrador (H/M) de pintura decorativa (sábados)', 'https://www.mediafire.com/?ynz0yt4', '', '', '', '', 'https://www.mediafire.com/?ynz0yt4', NULL, '', '', '2018-06-30 00:00:00.000000', '2018-06-09 22:29:43', 150, 1),
(76, 'Demostrador (H/M) de pintura decorativa (sábados)', '$this->getIdRol()', '', '', '', '', '$this->getIdRol()', NULL, '', '', '2018-06-30 00:00:00.000000', '2018-06-09 22:39:05', 150, 1),
(78, 'IDEAL para Estudiantes 800€-1200€ Media Jornada', 'Trabajo al aire libre en pequeños grupos de trabajo.\r\nPodrás pagar tu carrera, tú ropa y tus festivales. Consigue tu independencia económica mientras te formas, un buen trabajo que te garantiza tiempo libre para tu carrera deportiva, formativa o para tu familia.\r\n\r\nEn que consiste: Trabaja a pie de calle luchando contra las desigualdades informando a personas sobre la labor de las ONGS que representamos, el objetivo hablar con el máximo número de personas posibles.\r\n\r\nDos turnos mañana y tarde. \r\nFlexibilidad horaria. \r\nNo es necesaria experiencia previa.\r\nApto para todas las edades de 18 en adelante.\r\nFormación a cargo de la empresa.\r\nRéquisito indispensable ganas de hablar.\r\n\r\nAlta en la seguridad social (NO MERCANTIL NI AUTONOMOS)\r\nSalario base más incentivos. \r\nSueldo medio 800€- 1000€ brutos.', 'r2as', '', 'wwww@discutivo.com', '616342559', 'Estudios mínimos\r\nBachillerato\r\nsdsdsd', NULL, '', '', '2018-06-21 00:00:00.000000', '2018-06-10 13:26:54', 152, 1),
(79, 'VEN HOY, EMPIEZA MAÑANA Captación socios Cruz Roja', 'Gracias a nuestra dilatada trayectoria profesional de más de 10 años desarrollamos campañas de ventas y captación de clientes face to face tanto en empresas, particulares como eventos puntuales para un amplio abanico de clientes en distintos sectores del mercado.\r\n\r\nEn estos momentos nos encontramos ampliando nuestra campaña de captación de socios face-to-face especializados en visitas residenciales, empresas y eventos puntuales para Cruz Roja Madrid.\r\n\r\nBuscamos profesionales con o sin experiencia en ventas y/o captación de clientes o socios, capaces de desarrollar sus aptitudes comunicativas con eficacia, liderazgo y dispuestos a asumir nuevos retos con ganas de aprender y adquiriendo habilidades en trato al público, captación de clientes, gestión de grupos comerciales y ventas.', 'FORCE S.P', 'https://www.infojobs.net/force-s.p/em-i6a18d783c9406d96df9448bf29c482', 'ssds@discutivo.com', '', 'Mayor de edad\r\n- DNI o NIE con permiso de trabajo por cuenta propia\r\n- Número de la Seguridad Social\r\n- Dinamismo\r\n- Buena imagen\r\n- Predisposición y capacidad de aprendizaje\r\n- Pro-actividad\r\n- Don de gentes\r\n- Responsable\r\n- Buena autogestión propia', 224, '', 'Madrid, Madrid (España)', '2018-06-28 00:00:00.000000', '2018-06-10 13:50:55', 152, 1),
(81, 'VEN HOY, EMPIEZA MAÑANA Captación socios Cruz Roja jhee', 'Gracias a nuestra dilatada trayectoria profesional de más de 10 años desarrollamos campañas de ventas y captación de clientes face to face tanto en empresas, particulares como eventos puntuales para un amplio abanico de clientes en distintos sectores del mercado.\r\n\r\nEn estos momentos nos encontramos ampliando nuestra campaña de captación de socios face-to-face especializados en visitas residenciales, empresas y eventos puntuales para Cruz Roja Madrid.\r\n\r\nBuscamos profesionales con o sin experiencia en ventas y/o captación de clientes o socios, capaces de desarrollar sus aptitudes comunicativas con eficacia, liderazgo y dispuestos a asumir nuevos retos con ganas de aprender y adquiriendo habilidades en trato al público, captación de clientes, gestión de grupos comerciales y ventas.', 'FORCE S.P', 'https://www.infojobs.net/force-s.p/em-i6a18d783c9406d96df9448bf29c482', 'ssds@discutivo.com', '', 'Mayor de edad\r\n- DNI o NIE con permiso de trabajo por cuenta propia\r\n- Número de la Seguridad Social\r\n- Dinamismo\r\n- Buena imagen\r\n- Predisposición y capacidad de aprendizaje\r\n- Pro-actividad\r\n- Don de gentes\r\n- Responsable\r\n- Buena autogestión propia', NULL, '', 'Madrid, Madrid (España)', '2018-06-28 00:00:00.000000', '2018-06-10 13:52:19', 152, 1),
(82, 'oferta de prueba', 'descripción mucho trabajo', '', '', '222@discutivo.com', '', 'descripción mucho trabajo', NULL, '', '', '2018-06-30 00:00:00.000000', '2018-06-11 14:42:31', 93, 1),
(83, 'Recoge colillas', 'Tienes que recoger las colillas que los chavales tiran al suelo, con el tabaco sobrante liar cigarros', 'Tabacalerass Recicling', 'askjdsdew', 'valevale@vale.pene', '646445445', 'precisión para liar cigarros, habilidades especiales para agacharse al suelo', 15, '1200', 'Madrid', '2018-06-22 00:00:00.000000', '2018-06-12 17:36:11', 169, 1),
(84, 'TRABAJO FIJO BARCELONA - SUELDO 1650€', 'Si estás buscando trabajo, nosotros te ofrecemos estabilidad laboral con un sueldo fijo más un contrato indefinido.\r\n\r\nOfrecemos la posibilidad de crecer de forma interna en la empresa obteniendo las herramientas necesarias para el éxito personal y profesional.\r\n\r\nEl anunció está enfocado a aquellas personas que tengan disponibilidad completa e inmediata, que sean POSITIVAS, RESOLUTIVAS, COMPETENTES y PRO-ACTIVAS.\r\n\r\nLa formación correrá a cargo de la empresa, además de tener una secretaria personal que os gestione las visitas diarias, donde haréis de demostradores de nuestro producto exclusivo y patentado a nivel mundial.\r\n\r\nOFRECEMOS:\r\n-Contrato Laboral Indefinido + Alta en la Seguridad Social en Régimen General\r\n-Salario Fijo, Comisiones y Gastos de Vehículo\r\nMóvil de empresa\r\n-Buen ambiente de trabajo\r\n-Formación inicial y continuada\r\n-Plan de Carrera, promoción interna\r\n-Visitas concertadas por el Departamento de Call-Center', ' Compañía Alemana en el Baix Llobregat', 'https://www.infojobs.net/compania-alemana-en-el-baix-llobregat/em-ia1968fc0794151892acc574e6df97a', 'empresa1@discutivo.com', '12564789', 'DON DE GENTES\r\n-BUENA PRESENCIA\r\n-COCHE PROPIO Y PERMISO DE CONDUCIR B1\r\n-JORNADA COMPLETA Y INCORPORACIÓN INMEDIATA\r\n-PROYECCIÓN DE FUTURO', 3, 'Salario: 1.500€ - 2.400€ Bruto/mes', 'Barcelona, Barcelona (España)', '2018-08-15 00:00:00.000000', '2018-06-12 22:57:56', 179, 0),
(85, 'INGENIERO TÉCNICO INFORMÁTICO', 'Ingeniero técnico informático\r\nEstamos buscando un candidato básico con un perfil técnico en nuestras oficinas de Tres Cantos', ' Compañía Alemana en el Baix Llobregat', 'https://www.infojobs.net/compania-alemana-en-el-baix-llobregat/em-ia1968fc0794151892acc574e6df97a', 'empresa2@discutivo.com', '12564789', 'Disponibilidad de viajar, flexibilidad.\r\nIdioma : Inglés.\r\nExperiencia en el sector.', 1, 'Salario: 18.000€ - 24.000€ Bruto/año', 'Tres Cantos, Madrid (España)', '2018-08-02 00:00:00.000000', '2018-06-12 22:59:53', 179, 0),
(86, 'Administrador de RRSS y página Web con B2 inglés', 'Si te apasionan las nuevas tecnologías de información, eres la persona que buscamos. \r\nThe Kent Institute, academia de inglés consolidada y líder en el sector, precisa un experto en posicionamiento SEO y gestión de Redes Sociales, para ampliar la presencia de la marca Kent en el área digital. Buscamos un profesional joven, dinámico, polivalente, con facilidad de adaptación y responsable, con al menos 1 año de experiencia en puesto similar y formación relacionada con el marketing. Sus principales tareas consistirán en diseñar y aplicar la estrategia comercial digital (SEO) así como en gestionar el área Social Media, todo ello en colaboración con la dirección del centro. \r\nEl puesto es a tiempo parcial por las tardes de lunes a viernes, 4 horas diarias (a tiempo completo, en septiembre y octubre). \r\nIncorporación a finales de mayo.', 'The Kent Institute', 'https://www.infojobs.net/compania-alemana-en-el-baix-llobregat/em-ia1968fc0794151892acc574e6df97a', 'empresa3@discutivo.com', '12564789', 'Nivel B2 de inglés (título FCE de Cambridge o similar). \r\n· Mínimo 1 año de experiencia profesional en gestión de Redes Sociales y páginas web.\r\n· Dominio de Google Analytics y de las herramientas de analítica de las redes sociales. \r\n· Alto dominio de las herramientas de publicaciones en las redes sociales y páginas web (wordrpress o similar).\r\n· Conocimientos básicos de herramientas para edición de vídeo\r\n· Dotes de comunicación \r\n. Ser apasionado de las nuevas tecnologías de la información, de Internet y de las redes sociales. \r\n. Ser versátil con facilidad de adaptación, organizado y metódico. \r\n· Se valorará ser comunicativo, tener don de gentes y clara vocación de trabajo en equipo.\r\n', 1, 'Salario: 18.000€ - 24.000€ Bruto/año', 'Valencia, Valencia/València (España)', '2018-08-23 00:00:00.000000', '2018-06-12 23:34:56', 179, 0),
(87, 'Full Stack Developer', 'iEstrategic es una agencia de marketing digital y fabricante de una solución SaaS en crecimiento, y por ello necesitamos incorporar nuevo talento a nuestro equipo.\r\n\r\nComo Full Stack Developer en iEstrategic contribuirás al éxito de proyectos en diferentes sectores (turismo, retail, etc) trabajando en un equipo multidisciplinar, joven e internacional.\r\n\r\nParticiparás en el desarrollo de webs y aplicaciones desde el principio hasta el fin, sobre una potente plataforma SaaS. Trabajarás codo con codo con expertos en SEO, SEM, UX/UI, y marketing digital, aportando tu conocimiento y experiencia en tecnologías como HTML5,CSS3,Javascript y PHP/MySQL.', 'The Kent Institute', 'https://www.infojobs.net/compania-alemana-en-el-baix-llobregat/em-ia1968fc0794151892acc574e6df97a', 'empresa4@discutivo.com', '12564789', 'Experiencia demostrable en desarrollo web\r\nDominio de HTML5, CSS3, Javascript, jQuery\r\nConocimientos de PHP/MySQL\r\nConocimientos de SEO y UX', 1, 'Salario: 27.000€ - 36.000€ Bruto/año', 'Valencia, Valencia/València (España)', '2018-08-23 00:00:00.000000', '2018-06-12 23:35:52', 179, 0),
(88, 'MECÁNICO INDUSTRIAL / AJUSTADOR', 'La empresa seleccionará un Mecánico Industrial / Ajustador, para la realización de trabajos de reparación y montaje de equipos de bombeo en taller y en campo. Así como la reparación de otro tipo de maquinaria, motores, reductores, etc...', 'The Kent Institute', 'https://www.infojobs.net/compania-alemana-en-el-baix-llobregat/em-ia1968fc0794151892acc574e6df97a', 'empresa4@discutivo.com', '12564789', 'Formación Profesional Grado Medio en Mecánica Industrial o Electricidad.\r\n-Conocimientos de reparación de equipos de bombeo, Motores, reductoras...\r\n-Carnet de conducir B', 1, 'Salario: 27.000€ - 36.000€ Bruto/año', 'Bilbao, Vizcaya/Bizkaia (España)', '2018-08-07 00:00:00.000000', '2018-06-12 23:37:08', 179, 0),
(89, 'Técnico Mantenimiento Preventivo y Correctivo de A', 'Empresa del Sector Renovable busca 6 Técnicos de Mantenimiento Preventivo y Correctivo de Aerogeradores para los proyectos que actualmente cursa en Alaiz.', 'The Kent Institute', 'https://www.infojobs.net/compania-alemana-en-el-baix-llobregat/em-ia1968fc0794151892acc574e6df97a', 'empresa4@discutivo.com', '12564789', 'Experiencia 2 años contrastada.\r\n- Conocimientos y Formación en Electricidad-Electrónica.\r\n- Conocimientos en Mantenimiento Preventivo y Correctivo de Aerogeneradores.\r\n- Nivel medio de Inglés.', 1, 'Salario: 27.000€ - 36.000€ Bruto/año', 'Bilbao, Vizcaya/Bizkaia (España)', '2018-08-10 00:00:00.000000', '2018-06-12 23:37:49', 179, 0),
(90, 'Mecánico', 'Empresa dedicada al renting flexible de vehículos desea incorporar a sus talleres propios en Móstoles un oficial de 2ª con experiencia acreditada en mecánica pesada de vehículos < 3.500 kg. (motores, distribuciones, embragues, turbos,...), mecánica rápida, diagnosis y electricidad. Todo ello en un entorno multimarca.\r\nLa persona debe poseer título de FP II Automoción o similar, y una experiencia en puesto similar superior a 3 años. Debe poseer carnet de conducir B y vehículo propio.', 'The Kent Institute', 'https://www.infojobs.net/compania-alemana-en-el-baix-llobregat/em-ia1968fc0794151892acc574e6df97a', 'empresa5@discutivo.com', '12564789', 'FP II Automoción, FP Mantenimiento de Vehículos Autropopulsados o similar.\r\n- Al menos 3 años de experiencia en funciones descritas.\r\n- Proactividad.\r\n- Residencia en la zona sur de Madrid.\r\n- Carnet de conducir B.\r\n- Vehículo propio.', 1, 'Salario: 15.000€ - 18.000€ Bruto/año', 'Bilbao, Vizcaya/Bizkaia (España)', '2018-08-05 00:00:00.000000', '2018-06-12 23:40:49', 179, 0),
(91, 'Mecánico SENIOR', 'Empresa dedicada al renting flexible de vehículos desea incorporar a sus talleres propios en Móstoles un oficial de 2ª con experiencia acreditada en mecánica pesada de vehículos < 3.500 kg. (motores, distribuciones, embragues, turbos,...), mecánica rápida, diagnosis y electricidad. Todo ello en un entorno multimarca.\r\nLa persona debe poseer título de FP II Automoción o similar, y una experiencia en puesto similar superior a 3 años. Debe poseer carnet de conducir B y vehículo propio.', 'The Kent Institute', 'https://www.infojobs.net/compania-alemana-en-el-baix-llobregat/em-ia1968fc0794151892acc574e6df97a', 'empresa5@discutivo.com', '12564789', 'FP II Automoción, FP Mantenimiento de Vehículos Autropopulsados o similar.\r\n- Al menos 3 años de experiencia en funciones descritas.\r\n- Proactividad.\r\n- Residencia en la zona sur de Madrid.\r\n- Carnet de conducir B.\r\n- Vehículo propio.', 1, 'Salario: 15.000€ - 18.000€ Bruto/año', 'Bilbao, Vizcaya/Bizkaia (España)', '2018-08-05 00:00:00.000000', '2018-06-12 23:41:07', 179, 0),
(92, 'ADMINISTRATIVO BILINGÜE CON INGLES', 'ADMINISTRATIVO BILINGÜE CON INGLES PARA CONTABILIDAD, FACTURACION Y SERVICIO TÉCNICO PARA UNA EMPRESA UBICADA EN EL VALLES QUE COMERCIALIZA EQUIPOS TINTOMETRICOS AVANZADOS, DOSIFICADORES, AGITADORES Y MEZCLADORES PARA LA INDUSTRIA DE LAS PINTURAS Y LOS REVESTIMIENTOS  ASI COMO EQUIPAMIENTOS EN PUNTOS DE VENTA PARA AUTOSERVICIO.\r\nLA PERSONA CANDIDATA DEBERA CONTAR CON UNA FORMACION PROFESIONAL ADMINISTRATIVA GRADO II, INGLES A NIVEL DE CONVERSACION (VALORABLE ITALIANO) Y PERFECTO DOMINIO DE CONTABILIDAD Y FACTURACION LLLEVADA CON ACCESS, ASI COMO WORD Y EXCEL, FAMILIARIZADO CON DEPARTAMENTOS DE SERVICIO TÉCNICO A CLIENTES', 'The Kent Institute', 'https://www.infojobs.net/compania-alemana-en-el-baix-llobregat/em-ia1968fc0794151892acc574e6df97a', 'empresa5@discutivo.com', '12564789', 'FP II Automoción, FP Mantenimiento de Vehículos Autropopulsados o similar.\r\n- Al menos 3 años de experiencia en funciones descritas.\r\n- Proactividad.\r\n- Residencia en la zona sur de Madrid.\r\n- Carnet de conducir B.\r\n- Vehículo propio.', 1, 'Salario: 15.000€ - 18.000€ Bruto/año', 'Bilbao, Vizcaya/Bizkaia (España)', '2018-08-05 00:00:00.000000', '2018-06-12 23:41:52', 179, 0),
(93, 'Planchista automoción', 'aller multimarca en Barcelona ciudad precisa un planchista-chapista con experiencia para cubrir una puesto permanente. Jornada completa de lunes a viernes.', 'The Kent Institute', 'https://www.infojobs.net/compania-alemana-en-el-baix-llobregat/em-ia1968fc0794151892acc574e6df97a', 'empresa5@discutivo.com', '12564789', 'FP II Automoción, FP Mantenimiento de Vehículos Autropopulsados o similar.\r\n- Al menos 3 años de experiencia en funciones descritas.\r\n- Proactividad.\r\n- Residencia en la zona sur de Madrid.\r\n- Carnet de conducir B.\r\n- Vehículo propio.', 1, 'Salario: 15.000€ - 18.000€ Bruto/año', 'Bilbao, Vizcaya/Bizkaia (España)', '2018-08-05 00:00:00.000000', '2018-06-12 23:42:35', 179, 0),
(94, 'TÉCNICO MANTENIMIENTO LUXURY APARTMENTS', 'Si eres un apasionado/a de la hospitalidad y disfrutas con las múltiples culturas que nos visitan: ¡Aspasios es tu empresa!\r\n\r\nEn Aspasios disfrutamos haciendo que cada persona que alojamos en nuestros apartamentos vea cumplido un sueño y queremos que tu formes parte de este equipo.\r\n\r\nTe buscamos a ti que muestras un trato con orientación resolutiva, atento y todo con una gran sonrisa:\r\n\r\n- Garantizar la máxima satisfacción y bienestar, tanto del huésped como del cliente interno, gracias al buen estado y mantenimiento de las instalaciones del Hotel/Apartamentos', 'The Kent Institute', 'https://www.infojobs.net/compania-alemana-en-el-baix-llobregat/em-ia1968fc0794151892acc574e6df97a', 'empresa5@discutivo.com', '12564789', 'Experiencia en trabajos de mantenimiento en Pisos/ Apartamentos,\r\npreferentemente en hoteles (fontanería/carpintería/electricidad/ albañilería).\r\n\r\nSólidos conocimientos de climatización y electricidad\r\n\r\nNivel Inglés Alto', 1, 'Salario: 15.000€ - 18.000€ Bruto/año', 'Bilbao, Vizcaya/Bizkaia (España)', '2018-08-02 00:00:00.000000', '2018-06-12 23:43:17', 179, 0),
(95, 'Técnico de Mantenimiento (Vacaciones)', 'Centros Residenciales SAVIA, empresa del sector de servicios Socio - Sanitario necesita incorporar a su plantilla varios técnicos de Mantenimiento para la provincia de Valencia para cubrir las vacaciones del equipo.\r\n\r\n¿Cuales son las funciones que voy a realizar?\r\n\r\n- Será responsable del mantenimiento de las instalaciones de los centros \r\n- Controlar las visitas y el trabajo de firmas contratadas por la empresa\r\n- Elaborar planes e mantenimiento\r\n- Cuidado de as salas de maquinas, instalaciones, cuadros eléctricos etc.. \r\n- Realización de trabajos de albañilería, pintura o cualquier actividad necesaria en los centros.\r\n- Tareas especificas del puesto de trabajo', 'The Kent Institute', 'https://www.infojobs.net/compania-alemana-en-el-baix-llobregat/em-ia1968fc0794151892acc574e6df97a', 'empresa5@discutivo.com', '12564789', 'Experiencia en trabajos de mantenimiento en Pisos/ Apartamentos,\r\npreferentemente en hoteles (fontanería/carpintería/electricidad/ albañilería).\r\n\r\nSólidos conocimientos de climatización y electricidad\r\n\r\nNivel Inglés Alto', 1, 'Salario: 15.000€ - 18.000€ Bruto/año', 'Bilbao, Vizcaya/Bizkaia (España)', '2018-08-11 00:00:00.000000', '2018-06-12 23:44:14', 179, 0),
(96, 'Auxiliar de Clínica para Clínica Dental', 'Se necesita Auxiliar de Enfermeria con experiencia en el sector Odontológico para Clínica Dental de alto volúmen.', 'The Kent Institute', 'https://www.infojobs.net/compania-alemana-en-el-baix-llobregat/em-ia1968fc0794151892acc574e6df97a', 'empresa5@discutivo.com', '12564789', 'Experiencia en trabajos de mantenimiento en Pisos/ Apartamentos,\r\npreferentemente en hoteles (fontanería/carpintería/electricidad/ albañilería).\r\n\r\nSólidos conocimientos de climatización y electricidad\r\n\r\nNivel Inglés Alto', 1, 'Salario: 15.000€ - 18.000€ Bruto/año', 'Bilbao, Vizcaya/Bizkaia (España)', '2018-08-11 00:00:00.000000', '2018-06-12 23:44:50', 179, 0),
(97, 'sdsgfgdfdfdfd', 'fgdgdgdgdfdfdf dtdfgdgdfg', '', '', 'discutivo@aol.com', '', 'dfdfdfdfdfdfd dfdf', NULL, '', '', '2018-06-30 00:00:00.000000', '2018-06-15 08:25:50', 173, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OFERTA_ESTUDIOS`
--

CREATE TABLE `OFERTA_ESTUDIOS` (
  `ID_OFERTA` int(11) NOT NULL,
  `ID_ESTUDIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `OFERTA_ESTUDIOS`
--

INSERT INTO `OFERTA_ESTUDIOS` (`ID_OFERTA`, `ID_ESTUDIO`) VALUES
(73, 4),
(73, 8),
(74, 2),
(74, 7),
(75, 3),
(75, 9),
(76, 3),
(76, 6),
(78, 2),
(78, 8),
(79, 1),
(79, 5),
(81, 1),
(81, 5),
(82, 3),
(82, 7),
(83, 1),
(97, 2),
(97, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PERFIL_ALUMNO`
--

CREATE TABLE `PERFIL_ALUMNO` (
  `ID_PERFIL` int(11) NOT NULL,
  `NOMBRE` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `APELLIDOS` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FP_CODE` int(11) NOT NULL,
  `TELEFONO` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EMAIL` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `FOTO` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PERFIL_EXTERNO` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CV` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LINK_INTERES` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `COMENTARIO` text COLLATE utf8mb4_unicode_ci,
  `EXPERIENCIA` text COLLATE utf8mb4_unicode_ci,
  `ULTIMA_EDICION` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `RECIBIR_OFERTAS` tinyint(1) NOT NULL DEFAULT '1',
  `BUSCA_TRABAJO` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `PERFIL_ALUMNO`
--

INSERT INTO `PERFIL_ALUMNO` (`ID_PERFIL`, `NOMBRE`, `APELLIDOS`, `FP_CODE`, `TELEFONO`, `EMAIL`, `FOTO`, `PERFIL_EXTERNO`, `CV`, `LINK_INTERES`, `COMENTARIO`, `EXPERIENCIA`, `ULTIMA_EDICION`, `RECIBIR_OFERTAS`, `BUSCA_TRABAJO`) VALUES
(152, 'ricardo', 'sanchez', 7, '', 'r_alexis_remache@yahoo.es', 'img/bolsaTrabajo/perfiles/d780846b-779d-49ce-8b0c-14cd8c147990/rock.png', 'https://trakt.tv/users/ricardo7227/progress', NULL, '', '    echo json_encode(new GenericMessage(MensajesBT::OPERACION_DENEGADA, MensajesBT::ERROR_FALLO_IDENTIFICADOR));', '    echo json_encode(new GenericMessage(MensajesBT::OPERACION_DENEGADA, MensajesBT::ERROR_FALLO_IDENTIFICADOR));', '2018-06-10 12:57:36', 1, 1),
(153, 'Carls', 'Weathers', 2, '616342559', '22@discutivo.com', 'img/bolsaTrabajo/perfiles/7a0509f9-e1fd-4d93-9495-0cc648668042/Captura de pantalla (793).png', '', NULL, '', 'PERFIL_DATA[0].ID_PERFIL', 'PERFIL_DATA[0].ID_PERFIL', '2018-06-10 15:31:29', 1, 1),
(154, 'Gardinelia', 'Marterson', 3, '616342559', '22@discutivo.com', 'img/bolsaTrabajo/perfiles/e6f87f73-3e73-4ae9-aeb5-8feb87e0a816/Captura de pantalla (625).png', '', NULL, 'https://github.com/Josantonius/PHP-File', 'La gardenia es una planta de la familia de las rubiáceas originaria de China. El nombre científico de la especie más común es Gardenia jasminoides. Comprende 259 especies descritas y de estas, solo 134 aceptadas.​ Wikipedia', 'Las Gardenias son flores muy fragantes y están consideradas como unas de las más populares flores exóticas. Y de todos es sabido que es una flor muy usada para temas musicales románticos. En el terreno místico y espiritual se dice que la gardenia tiene un poder de atracción especial, inundando de energía pura y limpia.', '2018-06-10 16:59:37', 1, 1),
(157, 'user', 'assa', 8, '', '', NULL, '', NULL, '', '', '', '2018-06-12 16:10:11', 1, 1),
(174, 'erasto', 'rojas', 2, '', 'erasto.sanchez.44@gmail.com', 'img/bolsaTrabajo/perfiles/d520088f-fa46-4359-8593-0b7f8c752cae/Capacidad.png', '', NULL, '', 'soy un makinon', 'mamporrero 10 años(ricardo)', '2018-06-12 09:22:50', 1, 0),
(178, 'Ricardo ', 'Remache Sánchez', 4, '23232323', 'r.alexis.remache@gmail.com', 'img/bolsaTrabajo/perfiles/ba97ae90-512c-4dda-beac-34f870fe4ad2/1.PNG', 'perfil externo', NULL, 'github', ' mkdir(): Permission denied in ', ' mkdir(): Permission denied in ', '2018-06-13 10:00:23', 1, 1),
(188, 'Ricardo ', 'Remache Sánchez', 8, '616342559', 'r.alexis.remache@gmail.com', 'img/bolsaTrabajo/perfiles/4d61452f-54ab-4564-81c0-40a2726f9462/cara.jpg', 'https://www.linkedin.com/in/ricardo-remache/', NULL, 'https://github.com/ricardo7227', 'Técnico Superior en Desarrollo de Aplicaciones multiplataforma,\r\nTécnico Superior en Desarrollo de Aplicaciones Web.\r\n\r\nLenguajes de programación:\r\n-Java, PHP,Javascript, python, ABap\r\nBase de datos:\r\n- Oracle y MySql\r\nOtros:\r\n-Android, SAP UI5', 'Prácticas en:\r\n2017 - Buzinger: Consultora de aplicaciones Móviles.\r\n2018 - Unisys: Consultora empresaria en informática.\r\n2018 - Becario en Unisys - Equipo de SAP.\r\n\r\n', '2018-06-13 00:00:17', 1, 1),
(193, 'ricardo', 'remache', 1, '', 'r.alexis.remache@gmail.com', 'img/bolsaTrabajo/perfiles/968aab7d-304e-4099-90af-65a37e32ec0f/cara.jpg', '', NULL, '', 'muchas cosas', 'mas cosas', '2018-06-15 08:29:13', 1, 1),
(194, 'Ricardo ', 'Remache', 8, '', 'r.alexis.remache@gmail.com', 'img/bolsaTrabajo/perfiles/b46916f4-4b93-4a01-9913-b2f03eb7334b/cara.jpg', '', NULL, '', 'tercnoco sdsdsd', 'vdfdfdfgdfgfd', '2018-06-15 09:14:18', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_usuario` int(10) NOT NULL,
  `id_rol` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_usuario`, `id_rol`) VALUES
(75, 1),
(92, 1),
(98, 1),
(122, 1),
(125, 1),
(133, 1),
(134, 1),
(136, 1),
(137, 1),
(139, 1),
(142, 1),
(147, 1),
(148, 1),
(149, 1),
(153, 1),
(154, 1),
(157, 1),
(167, 1),
(168, 1),
(170, 1),
(171, 1),
(172, 1),
(174, 1),
(176, 1),
(178, 1),
(179, 1),
(181, 1),
(186, 1),
(188, 1),
(190, 1),
(191, 1),
(192, 1),
(193, 1),
(194, 1),
(76, 2),
(91, 2),
(145, 2),
(158, 2),
(159, 2),
(161, 2),
(162, 2),
(163, 2),
(182, 2),
(75, 3),
(90, 3),
(93, 3),
(110, 3),
(152, 3),
(160, 3),
(169, 3),
(173, 3),
(177, 3),
(185, 3),
(189, 3),
(78, 4),
(90, 4),
(169, 4),
(150, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_ventas`
--

CREATE TABLE `registro_ventas` (
  `id` int(11) NOT NULL,
  `id_vend` int(11) NOT NULL,
  `email_vend` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_comp` int(11) NOT NULL,
  `email_comp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titulo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `fecha_venta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `registro_ventas`
--

INSERT INTO `registro_ventas` (`id`, `id_vend`, `email_vend`, `id_comp`, `email_comp`, `titulo`, `precio`, `fecha_venta`) VALUES
(1, 98, 'qwqw@qw.qw', 169, 'erasto.sanchez.44@gmail.com', 'ttrwtrsyt', '0.00', '2018-06-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(10) NOT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_rol` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `descripcion`, `nombre_rol`) VALUES
(1, 'alumno', 'Alumno'),
(2, 'profesor', 'Profesor'),
(3, 'administrador', 'Administrador'),
(4, 'incidencias_tic', 'Incidencias'),
(5, 'EMPRESA', 'Empresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id_tarea` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `asignatura` varchar(50) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id_tarea`, `id_curso`, `descripcion`, `asignatura`, `fecha`) VALUES
(1, 24, 'Nueva tarea', 'Proyecto final de curso', '2018-06-13'),
(2, 1, 'Nueva tarea', 'Asignatura', '2018-02-01'),
(4, 1, 'Entrega de trabajo', 'Tecnología', '2018-06-13'),
(5, 1, 'Ejercicios 1, 2, 3, 4, 6, 8, 10 de página 170 del libro', 'hola guti!!!! ', '2018-06-30'),
(7, 1, 'Examen de recuperación', 'si que sale en rojo', '2018-06-15'),
(8, 1, 'Hoy', 'Matemáticas', '2018-06-02'),
(9, 1, 'Examen tema 2', 'Literatura', '2018-06-03'),
(10, 1, 'Prueba', 'Asignatura', '2018-05-06'),
(11, 24, 'Nueva tarea', 'Asignatura', '2018-01-01'),
(14, 1, 'Prueba', 'Prueba', '2018-06-09'),
(16, 1, 'Nueva tarea4', 'Nueva asignatura', '2020-01-01'),
(17, 1, 'Prueba2', 'Asignatura', '2018-06-10'),
(18, 1, 'Nueva tarea', 'asgasgsdgha', '2019-01-01'),
(19, 1, 'Nueva tarea', 'Nueva asignatura', '2018-09-10'),
(20, 1, 'Nueva tarea', 'prueba', '2019-01-01'),
(23, 4, 'Nueva tarea', 'Nueva asignatura', '2018-06-04'),
(24, 4, 'Nueva tarea', 'Nueva asignatura', '2018-06-03'),
(30, 1, 'para mañana', 'tal', '2018-06-14'),
(31, 21, 'Buscar una rueda', 'Carroceria', '2018-06-28'),
(32, 1, 'ERASTUS CRIMINALUS', 'Tecnología', '2020-11-21'),
(33, 2, 'ERASTUS CRIMINALUS', 'Tecnología', '2020-11-21'),
(34, 1, 'Leer a Teo', 'Lengua', '2018-06-28'),
(35, 2, 'ejercicios del libro, pag 5, y pag 6 ', 'la vida', '2018-06-29'),
(36, 1, 'Examen temas 1 a 5', 'Literatura', '2018-06-19'),
(37, 2, 'EDUARDO SE FUE DE VIAJE', 'VIAJES', '2018-11-19'),
(38, 2, 'Examen del tema 6', 'ldfhgiudfhidfh', '2018-06-20'),
(39, 2, 'Nueva tarea', 'Mañana', '2018-06-16'),
(40, 1, 'Nueva tarea', 'Tecnología', '2018-06-29'),
(41, 19, 'Nueva tarea', 'dfkghdjg', '2019-07-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `UNIDADES_TRABAJO`
--

CREATE TABLE `UNIDADES_TRABAJO` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(450) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EVALUACION` int(6) NOT NULL,
  `UNIDAD_HECHA` tinyint(4) NOT NULL,
  `COMENTARIO` varchar(450) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `UNIDADES_TRABAJO`
--

INSERT INTO `UNIDADES_TRABAJO` (`ID`, `NOMBRE`, `EVALUACION`, `UNIDAD_HECHA`, `COMENTARIO`) VALUES
(1, 'NuevaUNidad', 2, 0, 'dddd'),
(2, 'tema 3', 1, 0, NULL),
(4, 'NuevoTema', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` int(12) DEFAULT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nick` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_activacion` binary(250) DEFAULT NULL,
  `activado` tinyint(1) DEFAULT NULL,
  `ultimo_acceso` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellidos`, `telefono`, `email`, `pass`, `nick`, `codigo_activacion`, `activado`, `ultimo_acceso`) VALUES
(75, 'test', 'test', 33333333, 'andirexulon@gmail.com', 'sha1:64000:18:MXL6PA8cz56S5o9zEBeqHAudFR0qc/af:DhbKad4QduQv/7/lV630i2Kw', 'test', NULL, 1, '2018-06-10 00:00:00'),
(76, 'ALUMNASO', 'pepa', 333, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:1gDe4PrCBL8jlVx8gH7zTHlee3YhVEw1:mSgViGwGiqOIyUVWHKQ7YW4T', 'alumno', NULL, 1, '2018-06-08 00:00:00'),
(77, 'sara', 'sara', 333, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:O5Jlcbk81nPzU55RNl/OBzozNjhcDkXD:v7bx4WepIu0zoy2m/14bJTO2', 'sara', 0x6a36306377617a727338386f30346b386b676f730000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 0, '2018-06-08 00:00:00'),
(78, 'luisaaa', 'luisangel', 333, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:kx03KqE3KTtISdUIGsyDd/4ksmxvAtdK:SGv5wcwJpIzZ5pMSX81UuEY0', 'luis', 0x667535396a39386868396b6f73636f306330386f0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 0, '2018-06-08 00:00:00'),
(90, 'Dani', 'Admin', 123, 'dgut92@gmail.com', 'sha1:64000:18:rZ5Scyq7PdbIzq94ez0Q8r2RsrJGtsfq:f5yCUHWAsoBQbC3+uGjj7VBm', 'dani_admin', NULL, 1, '2018-06-13 10:00:15'),
(91, 'Dani', 'Profe', 123, 'dgut92@gmail.com', 'sha1:64000:18:7z2CCSlyaDuqSra8/Z4jhheDXrQJnFxT:OuPeFmDFrpvt5b4PpMEnavkz', 'dani_profe', NULL, 1, '2018-06-15 11:35:00'),
(92, 'Dani', 'Alumno', 123, 'dgut92@gmail.com', 'sha1:64000:18:Rfz2Jv3RnHwCH7Mfpsz7LQEVC6axJInt:2hTgoFoNodj02OCPPkTAc3+A', 'dani_alumno', NULL, 1, '2018-06-15 11:31:45'),
(93, 'ricardo', 'sanchez', 616342559, 'r_alexis_remache@yahoo.es', 'sha1:64000:18:zS/8fyFQHzpbtOyUCKmJP4D87QbYEksm:2aGkjicINLNtz9jB5gIkHyyH', 'arturia', NULL, 1, '2018-06-12 14:07:43'),
(98, 'si2', 'mio xD', 123456789, 'migueldiaz.tg@gmail.com', 'sha1:64000:18:OHjEbbecFQfnFkpWt9w4h2FQXBxco3qe:KV1hH9f8nf8d9QqjqBSCElFg', 'qq', NULL, 1, '2018-06-15 11:06:03'),
(110, 'prueba', 'prueba', 4444444, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:3gFAlkXSOJRsxh8wynB6UuWMbCitsW+R:cD8hPfuFuxpWngP/je6tP/Z5', 'prueba', NULL, 1, '2018-06-09 13:13:17'),
(122, 'ferrnado', 'ferf', 4444, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:5gpwGObf7JHkwSXSAWYQ9WZJ0Vb8PNMd:eIKlt3ww6at4DfdttZm2Cl+h', 'feran', NULL, 1, '2018-06-09 11:33:27'),
(125, 'ricardinho', 'ricar', 44444, 'erasto.sanchez.44@gmail.com', '', 'ricard', 0x6972347a7a6a70703567676b306b3834386b776f0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 0, '2018-06-09 12:11:25'),
(133, 'pruebaMail', 'Mail', 333333333, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:N66lSMHUhePZybAl4VLI6b9lJPSmEPLG:10Jpz6ld0XenKvoG9IkPwFmC', 'mail', 0x636668616b72777272656f3077343077306b34340000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 0, '2018-06-09 15:34:04'),
(134, 'ggh', 'ggh', 444444, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:oej6wKsdsl7Zkhs3t3XlSwpSqRX/aXg5:ft/kNWRGebbOHVM51GQ539Cm', 'ggh', 0x396463767835723166696f386b6b636f6f386b300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 0, '2018-06-09 15:51:30'),
(136, 'be', 'be', 33333, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:d8AYn+xvaquzImUzaOrEY1Miih+hM+qy:ny072W0nuku2vFXGd0wELaA+', 'be', 0x636e6662696632347a7567776b736763306738670000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 0, '2018-06-09 15:58:09'),
(137, 'login', 'we', 33333, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:wIrON7vUEMlASQs+sgfoct1q8wV4QrhZ:u+ZjAYgJ70q9abrrZWPWlUxj', 'c', 0x6639356976726d663764773073636f34733830730000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 0, '2018-06-09 16:01:12'),
(139, 'xx', 'xx', 444444, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:8ChXSIhBVhbapcv3nEnJ7Fjk0VbR2DHG:w0JhzaYD2YjEDJSQMzICH2yD', 'x', 0x37646c70373771716d6b6f3430777367733438300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 0, '2018-06-09 16:23:13'),
(142, 'jjjj', 'jjj', 666666, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:+m/Kn8NgBaJxohyhknsZYeo7+x0YI9P+:ypame1t9vt1aCPXoN6Wtc/ek', 'jjj', 0x716f69616d6762626931633877736b73343430670000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 0, '2018-06-09 16:35:46'),
(145, 'fede', 'fede', 333333, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:QgV4WV+/+88ZHLdNAxgW19pZapvaayUO:qVdTx7QcpnaogHA6Xw+dlXiZ', 'fede', 0x3130637a79676d32366f726b6b346f7373636b6b0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 0, '2018-06-09 16:55:12'),
(147, 'doas', 'doas', 3333333, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:CGUHO2LbUsDCtslexu3P2cU00oJgPbH0:/Z2Q8T0uqIj+QRxOBLJVEPNQ', 'doas', 0x38316a39657a69326e696f3830386f636b636f340000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 1, '2018-06-09 17:29:28'),
(148, 'PruebaFinal', 'Final', 112223332, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:O1Qxt3KPprHHRBBz1yo57H7pvHdsmz2Z:XaswYWHD/hx6dUKWXgOdr1uD', 'pruebaFinal', 0x32326a67757a6d346f6a7234306367777738306f0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 1, '2018-06-09 17:36:07'),
(149, 'paloma', 'del rey', 616919323, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:sy/sYZw2fcmxgQhaSLQiPZha3CjV1qg6:+GNRlpKyUs38KOslnKJzhxSm', 'paloma', 0x737764356b68623565633063633434636b346f6b0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 1, '2018-06-09 20:17:57'),
(150, 'ricardinho', 'saxxcx ', 616342559, 'r_alexis_remache@yahoo.es', 'sha1:64000:18:VbE3Hb/Nl7b4v6cTVqrs311CSS/fZgvd:6tKWuXv23rtATB8zIjSE0ziy', 'arturia3', NULL, 1, '2018-06-11 21:07:12'),
(152, 'ricardo', 'sanchez', 616342559, 'r_alexis_remache@yahoo.es', '', 'arturia4', NULL, 1, '2018-06-11 19:40:05'),
(153, 'Lisa up', 'asters', 12546688, 'lisa@discutivo.com', 'sha1:64000:18:m5QNxmw7n/a+oJ3ZBLMJqsVd8oZwZkr3:aypjkFenWzQMpW2NzAiDpQBO', 'lisa', NULL, 1, '2018-06-12 14:05:03'),
(154, 'gardineliala', 'band', 21233, '222@discutivo.com', 'sha1:64000:18:VMsdvytgy9aqdo7FsaCsoXhm4RAxuB4g:DBIn7yAmH667SYjcfEtH3WKq', 'gardinelia', NULL, 1, '2018-06-10 00:00:00'),
(157, 'asdasds', 'asdasddasd', 455555, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:pkzdE7RjPJ23jmtADQpXtlOg5/NVOX6e:WktSewleiV48YeNm2sR4aiV0', 'werrew', NULL, 1, '2018-06-12 14:08:30'),
(158, 'pepepro', 'eoprepor', 3333, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:lqznTN2QelKfILiUBZ90CAuPwHt1Jd7D:CXWIRnFnu5TcJkJ/gO7MJs1N', 'erop', NULL, 1, '2018-06-11 00:00:00'),
(159, 'lolaFlores', 'lolaManola', 33333, 'erasto.sanchez.44@gmail.com', '', 'lola', NULL, 1, '2018-06-11 20:18:02'),
(160, 'popo', 'popopa', 33333, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:1f1BvIZAuemH39Vz2HrCjPkcy1hnX/R3:D4IgKvTAVT8i/ZuTXcplWI3j', 'popo', NULL, 1, '2018-06-11 20:20:18'),
(161, 'kk', 'kkcc', 33333, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:1gDe4PrCBL8jlVx8gH7zTHlee3YhVEw1:mSgViGwGiqOIyUVWHKQ7YW4T', 'kk', NULL, 1, '2018-06-15 07:16:34'),
(162, 'dana', 'dananana', 33333, 'erasto.sanchez.44@gmail.com', '', 'dana', NULL, 1, '2018-06-11 20:27:01'),
(163, 'proba', 'probando', 44444, 'erasto.sanchez.44@gmail.com', '', 'proba', NULL, 1, '2018-06-11 20:32:19'),
(167, 'mario', 'mario', 44444, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:TqiT5Yd7JZgXge0GhSS7GbUdsofcT5Gm:sBccCgh0lvAm3G7WXR2YNGIQ', 'mario', 0x336e70666f343061387a637767736f776f3438730000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 0, '2018-06-11 21:15:04'),
(168, 'lau', 'lau', 3333, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:qL5hZ4iSVyagrqS7V+uXpJ3mfl7R8nvO:WQhj46OIj5JzLhdNEeNeiOQM', 'lau', 0x666572736672776e3968633067776377637767380000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 0, '2018-06-11 21:17:50'),
(169, 'god', 'God Supremo', 22222, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:1gDe4PrCBL8jlVx8gH7zTHlee3YhVEw1:mSgViGwGiqOIyUVWHKQ7YW4T', 'god', NULL, 1, '2018-06-18 08:03:04'),
(170, 'gio', 'gio', 234234, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:mnWlsJaA0NiSbbnxclPQT34dIO5JnOKs:woNZy7Cl/ZoYaKBC8oGSRs21', 'gio', 0x3774357530357a6238616363633834346f73776f0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 0, '2018-06-11 21:25:36'),
(171, 'pipon', 'pipo', 44444, 'erasto.sanchez.44@gmail.com', '', 'pipo', 0x626a7038656c363269627334776f6763776377380000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 1, '2018-06-11 21:28:50'),
(172, 'poiopi', 'poipoi', 88888, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:54co34BBVrSqHIFCbqUhf34z0KYXArks:4AVTGt3GJcrNmpm5VxvNC4qz', 'oioiu', NULL, 1, '2018-06-11 22:25:45'),
(173, 'archer', 'sanchez', 616342559, 'r_alexis_remache@yahoo.es', 'sha1:64000:18:sl7XS4ph7t+lCJ8PjwKeKFyCxBN6S/tU:7wfrKTr7h7VGzORV1/o9D8Nu', 'archer', NULL, 1, '2018-06-15 11:33:44'),
(174, 'mier', 'mierda', 4444, 'erasto.sanchez.44@gamil.com', 'sha1:64000:18:5zn19+yp9/36zcYkP9jLjYu5fhrqifrW:V2nxsvqrCbwsEtKsSZoivN3E', 'mier', NULL, 1, '2018-06-12 07:12:26'),
(176, 'a', 'd', 616342559, 'r_alexis_remache@yahoo.es', 'sha1:64000:18:r6zJSlHvJ89Ynw3+wihu6/tFfWPveQK2:hJFVdpdo6ODQ/RY1qHejiO4q', 'saber', NULL, 1, '2018-06-12 17:22:05'),
(177, 'empresa', 'SL', 123456789, 'empresa@discutivo.com', 'sha1:64000:18:GhFyTcPCuh3SzKQ+h1CHOkeVBtfLpHi8:kUinuDId7VJpf66FOk8l402E', 'empresa', NULL, 1, '2018-06-12 20:24:37'),
(178, 'Ricardo ', 'Remache Sánchez', 616342559, 'r.alexis.remache@gmail.com', 'sha1:64000:18:MZ+ZvDdfzIBxmF/hPR6StGCrt8AyMzfZ:E3Tmtw6SAAqbcWuFf8Zl3RUV', 'ricardo7', NULL, 1, '2018-06-13 09:53:17'),
(179, 'lisa', 'Fi', 1221212, 'r_alexis_remache@yahoo.es', 'sha1:64000:18:25gt+bXH5Y/unUOO06Lq3vAiO2SwqoMe:+UGPGTBUfJfreyPr4+FIef6K', 'fripside', 0x7169306e756a356b6277673434306f306f6730770000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 1, '2018-06-12 22:31:40'),
(181, 'archer', 'sanchez', 223232323, 'r_alexis_remache@yahoo.es', 'sha1:64000:18:m7WRp2GNq0RdqMCMXIz041u0jvDQeoLz:s8i+8jGMJyExdt57oUf1cil7', 'sister', 0x39707a61766d6b6533773877736f6b6f3067676f0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 1, '2018-06-13 00:40:23'),
(182, 'goku', 'goky', 2344, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:Dim3kwF4OhLOfdIHS37Xe/mdzswP2iaW:c4dbnSO1mq/p8uZ+joVunqcT', 'goku', NULL, 1, '2018-06-13 08:51:38'),
(185, 'miguela', 'miguela', 234234, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:ToqH/D94VU2vY/wxsyCmvBZ9A04PHx+I:Jb1Q0HmXc9rSbOhLMr5AQzCJ', 'mima', NULL, 1, '2018-06-13 09:54:46'),
(186, 'humildad', 'humildad', 123123, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:gBsMzW0UOMOAokEQ+3brDbDy+lq7xulA:vzTcQ8WpLm5ufxVh49S8+Ijs', 'humildad', 0x6970666e686669737170346f633034676f3838730000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 1, '2018-06-13 10:03:59'),
(188, 'Ricardo', 'Remache Sánchez', 616342559, 'r.alexis.remache@gmail.com', 'sha1:64000:18:+iV5SlieqUx9zDZFnDclDpyhtV4BCcSR:bHq5WeEhmwtWZVmXpd9sskOX', 'ricardo7227', NULL, 1, '2018-06-15 10:53:12'),
(189, 'Santiagp', 'gomez', 4444, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:r7/V62n1e5GkQZnTgx7PzNFyaHMS2eL/:RZNqr72AMKJ3hcBegqAEquHi', 'santi', NULL, 1, '2018-06-14 08:50:23'),
(190, 'oscars', 'oscars', 4444, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:Y1BjIeH0hzBKYX0cWb9O0fuM7H1nvSMV:Hp1Q+zkxqJDFz00evE9BCUpV', 'oscars', 0x656c39627a787972346e77773077776f387334730000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 1, '2018-06-14 08:58:21'),
(191, 'pepito', 'peptio', 8888, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:ixOaxwGykFPSQjbswuRWnfS+P99KT4jH:HsoRE63anCZvC4bxUVcPYykM', 'pepeee', 0x6c7076396f683168387730776b306377676767340000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 0, '2018-06-14 09:01:22'),
(192, 'pppppp', 'pppppp', 22222, 'erasto.sanchez.44@gmail.com', 'sha1:64000:18:l+X36YTfr6HTkA0ocqJqNlX97lGI8KBA:MI9njdrU44Yi+0l2AbTAyaZX', 'pppp', 0x376e7670633568796f716b676f736767303477770000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 1, '2018-06-14 09:09:02'),
(193, 'ricardo', 'rem', 616342559, 'r.alexis.remache@gmail.com', 'sha1:64000:18:jmwUcR0F0sHYHx4X6kXf1JEDJoZHZD+G:KvbU/6tJ50Xcm9/bdwTyFOh4', 'alumno1231', NULL, 1, '2018-06-15 08:29:37'),
(194, 'ricardo', 'remache', 616342559, 'r.alexis.remache@gmail.com', 'sha1:64000:18:E+8XXzvM4UrT7F7DjP9+YuTWqo0/qJ1+:tfj0M4QcW4qVOaqQfhaBIlsy', 'alumno67', NULL, 1, '2018-06-15 09:09:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_libros`
--

CREATE TABLE `venta_libros` (
  `id` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titulo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isbn` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `asignatura` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `curso` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_comprador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `venta_libros`
--

INSERT INTO `venta_libros` (`id`, `id_vendedor`, `email`, `titulo`, `isbn`, `precio`, `asignatura`, `curso`, `fecha_publicacion`, `estado`, `id_comprador`) VALUES
(11, 94, 'migueldiaz.tg@gmail.com', '1', '978-3-16-148410-0', '12.00', 'Matemáticas', '4 ESO', '2018-06-07', 'Reservado', 169),
(12, 94, 'migueldiaz.tg@gmail.com', '2', '978-3-16-148410-0', '1.00', 'FOL', '2 BACH', '2018-06-07', 'Reservado', 188),
(13, 94, 'migueldiaz.tg@gmail.com', 'D:', '978-3-16-148410-0', '15.00', 'C. sociales', '1 DAW', '2018-06-08', 'A la venta', NULL),
(14, 94, 'migueldiaz.tg@gmail.com', 'pues si', '978-3-16-148410-1', '5.00', 'Lengua', '1 BACH', '2018-06-08', 'A la venta', NULL),
(15, 94, 'migueldiaz.tg@gmail.com', 'asdf', '978-3-16-148410-0', '6.00', 'Matemáticas', '4 ESO', '2018-06-08', 'A la venta', NULL),
(16, 94, 'migueldiaz.tg@gmail.com', 'prueba 2', '978-3-16-148410-0', '7.00', 'FOL', '2 BACH', '2018-06-09', 'A la venta', NULL),
(17, 94, 'migueldiaz.tg@gmail.com', 'xDD', '978-3-16-148410-0', '14.00', 'C. sociales', '1 DAW', '2018-06-10', 'Reservado', 188),
(18, 94, 'migueldiaz.tg@gmail.com', 'el otro', '978-3-16-148410-1', '8.50', 'Lengua', '1 BACH', '2018-06-10', 'A la venta', NULL),
(19, 169, 'erasto.sanchez.44@gmail.com', 'Humildad', '123-44-2234--22', '34.00', 'C. sociales', '2 DAW', '2018-06-12', 'Reservado', NULL),
(24, 169, 'erasto.sanchez.44@gmail.com', 'Titulo santiago', '123', '10.00', 'Matemáticas', '4 ESO', '2018-06-15', 'A la venta', NULL),
(25, 169, 'erasto.sanchez.44@gmail.com', 'ffff', '546456456', '1.00', 'Matemáticas', '4 ESO', '2018-06-15', 'A la venta', NULL),
(26, 98, 'migueldiaz.tg@gmail.com', 'mi libro', 'qwertyw3ey7', '2.00', 'Matemáticas', '4 ESO', '2018-06-15', 'Reservado', 169);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ACC_MODIFICAR_BT`
--
ALTER TABLE `ACC_MODIFICAR_BT`
  ADD PRIMARY KEY (`ID_PERMISO`);

--
-- Indices de la tabla `APUNTARSE_OFERTA`
--
ALTER TABLE `APUNTARSE_OFERTA`
  ADD PRIMARY KEY (`ID_APUNTAR`),
  ADD KEY `ID_OFERTA` (`ID_OFERTA`),
  ADD KEY `ID_APUNTAR` (`ID_APUNTAR`);

--
-- Indices de la tabla `ASIGNATURAS`
--
ALTER TABLE `ASIGNATURAS`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `ASIGNATURA_UNIDADTRABAJO`
--
ALTER TABLE `ASIGNATURA_UNIDADTRABAJO`
  ADD KEY `ID_ASIG_UNIDAD_idx` (`ID_ASIGNATURA`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategorias`),
  ADD UNIQUE KEY `Categoria_UNIQUE` (`Categoria`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `CURSOS_ASIGNATURAS`
--
ALTER TABLE `CURSOS_ASIGNATURAS`
  ADD KEY `id_curso_id_asignatura_idx` (`ID_CURSO`),
  ADD KEY `id_asignatura_curso_idx` (`ID_ASIGNATURA`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamentos_contabilidad`
--
ALTER TABLE `departamentos_contabilidad`
  ADD PRIMARY KEY (`de_codigo`),
  ADD KEY `fk_depart_jefe` (`de_jefe`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`idDocumentos`),
  ADD KEY `fk_categoria_doc_idx` (`idCategoria`);

--
-- Indices de la tabla `ENVIAR_OFERTAS`
--
ALTER TABLE `ENVIAR_OFERTAS`
  ADD PRIMARY KEY (`ID_NOTIFICAR`),
  ADD KEY `ID_OFERTA` (`ID_OFERTA`);

--
-- Indices de la tabla `ESTUDIOS_ALUMNO`
--
ALTER TABLE `ESTUDIOS_ALUMNO`
  ADD PRIMARY KEY (`ID_ALUMNO`,`ID_FP`),
  ADD KEY `ID_FP` (`ID_FP`);

--
-- Indices de la tabla `ESTUDIOS_CENTRO`
--
ALTER TABLE `ESTUDIOS_CENTRO`
  ADD PRIMARY KEY (`ID_FP`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inc_dpt` (`departamento`),
  ADD KEY `fk_inc_usr1` (`solicitado_por`),
  ADD KEY `fk_inc_usr2` (`completado_por`);

--
-- Indices de la tabla `incidencias_chat`
--
ALTER TABLE `incidencias_chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pf_ic_1` (`user_id`),
  ADD KEY `pf_ic_2` (`incidencia_id`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`mo_id`),
  ADD KEY `mo_coddep` (`mo_coddep`);

--
-- Indices de la tabla `OFERTA`
--
ALTER TABLE `OFERTA`
  ADD PRIMARY KEY (`ID_OFERTA`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Indices de la tabla `OFERTA_ESTUDIOS`
--
ALTER TABLE `OFERTA_ESTUDIOS`
  ADD PRIMARY KEY (`ID_OFERTA`,`ID_ESTUDIO`),
  ADD KEY `ID_OFERTA` (`ID_OFERTA`),
  ADD KEY `ID_ESTUDIO` (`ID_ESTUDIO`);

--
-- Indices de la tabla `PERFIL_ALUMNO`
--
ALTER TABLE `PERFIL_ALUMNO`
  ADD PRIMARY KEY (`ID_PERFIL`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_usuario`,`id_rol`),
  ADD KEY `permiso_rol` (`id_rol`);

--
-- Indices de la tabla `registro_ventas`
--
ALTER TABLE `registro_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tarea`);

--
-- Indices de la tabla `UNIDADES_TRABAJO`
--
ALTER TABLE `UNIDADES_TRABAJO`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nick` (`nick`);

--
-- Indices de la tabla `venta_libros`
--
ALTER TABLE `venta_libros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ACC_MODIFICAR_BT`
--
ALTER TABLE `ACC_MODIFICAR_BT`
  MODIFY `ID_PERMISO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `APUNTARSE_OFERTA`
--
ALTER TABLE `APUNTARSE_OFERTA`
  MODIFY `ID_APUNTAR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `ASIGNATURAS`
--
ALTER TABLE `ASIGNATURAS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategorias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `idDocumentos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `ENVIAR_OFERTAS`
--
ALTER TABLE `ENVIAR_OFERTAS`
  MODIFY `ID_NOTIFICAR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT de la tabla `ESTUDIOS_CENTRO`
--
ALTER TABLE `ESTUDIOS_CENTRO`
  MODIFY `ID_FP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT de la tabla `incidencias_chat`
--
ALTER TABLE `incidencias_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `mo_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1483;
--
-- AUTO_INCREMENT de la tabla `OFERTA`
--
ALTER TABLE `OFERTA`
  MODIFY `ID_OFERTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT de la tabla `PERFIL_ALUMNO`
--
ALTER TABLE `PERFIL_ALUMNO`
  MODIFY `ID_PERFIL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;
--
-- AUTO_INCREMENT de la tabla `registro_ventas`
--
ALTER TABLE `registro_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT de la tabla `UNIDADES_TRABAJO`
--
ALTER TABLE `UNIDADES_TRABAJO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;
--
-- AUTO_INCREMENT de la tabla `venta_libros`
--
ALTER TABLE `venta_libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ACC_MODIFICAR_BT`
--
ALTER TABLE `ACC_MODIFICAR_BT`
  ADD CONSTRAINT `ACC_USERS` FOREIGN KEY (`ID_PERMISO`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `APUNTARSE_OFERTA`
--
ALTER TABLE `APUNTARSE_OFERTA`
  ADD CONSTRAINT `APUNTARSE_OFERTA_ibfk_1` FOREIGN KEY (`ID_OFERTA`) REFERENCES `OFERTA` (`ID_OFERTA`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ASIGNATURA_UNIDADTRABAJO`
--
ALTER TABLE `ASIGNATURA_UNIDADTRABAJO`
  ADD CONSTRAINT `ID_ASIG_UNIDAD` FOREIGN KEY (`ID_ASIGNATURA`) REFERENCES `ASIGNATURAS` (`ID`);

--
-- Filtros para la tabla `CURSOS_ASIGNATURAS`
--
ALTER TABLE `CURSOS_ASIGNATURAS`
  ADD CONSTRAINT `id_asignatura_curso` FOREIGN KEY (`ID_ASIGNATURA`) REFERENCES `ASIGNATURAS` (`ID`),
  ADD CONSTRAINT `id_curso_id_asignatura` FOREIGN KEY (`ID_CURSO`) REFERENCES `cursos` (`id_curso`);

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `fk_categoria_doc` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategorias`);

--
-- Filtros para la tabla `ENVIAR_OFERTAS`
--
ALTER TABLE `ENVIAR_OFERTAS`
  ADD CONSTRAINT `ENVIAR_OFERTAS_ibfk_1` FOREIGN KEY (`ID_OFERTA`) REFERENCES `OFERTA` (`ID_OFERTA`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ESTUDIOS_ALUMNO`
--
ALTER TABLE `ESTUDIOS_ALUMNO`
  ADD CONSTRAINT `ESTUDIOS_ALUMNO_ibfk_1` FOREIGN KEY (`ID_FP`) REFERENCES `ESTUDIOS_CENTRO` (`ID_FP`),
  ADD CONSTRAINT `ESTUDIOS_ALUMNO_ibfk_2` FOREIGN KEY (`ID_ALUMNO`) REFERENCES `PERFIL_ALUMNO` (`ID_PERFIL`) ON DELETE CASCADE;

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `fk_inc_dpt` FOREIGN KEY (`departamento`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `fk_inc_usr1` FOREIGN KEY (`solicitado_por`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_inc_usr2` FOREIGN KEY (`completado_por`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `incidencias_chat`
--
ALTER TABLE `incidencias_chat`
  ADD CONSTRAINT `pf_ic_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pf_ic_2` FOREIGN KEY (`incidencia_id`) REFERENCES `incidencias` (`id`);

--
-- Filtros para la tabla `OFERTA`
--
ALTER TABLE `OFERTA`
  ADD CONSTRAINT `OFERTA_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `OFERTA_ESTUDIOS`
--
ALTER TABLE `OFERTA_ESTUDIOS`
  ADD CONSTRAINT `OFERTA_ESTUDIOS_ibfk_1` FOREIGN KEY (`ID_OFERTA`) REFERENCES `OFERTA` (`ID_OFERTA`) ON DELETE CASCADE,
  ADD CONSTRAINT `OFERTA_ESTUDIOS_ibfk_2` FOREIGN KEY (`ID_ESTUDIO`) REFERENCES `ESTUDIOS_CENTRO` (`ID_FP`) ON DELETE CASCADE;

--
-- Filtros para la tabla `PERFIL_ALUMNO`
--
ALTER TABLE `PERFIL_ALUMNO`
  ADD CONSTRAINT `PERFIL_ALUMNO_ibfk_1` FOREIGN KEY (`ID_PERFIL`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `fk_prm_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`),
  ADD CONSTRAINT `fk_prm_usr` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
