-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-06-2018 a las 18:54:34
-- Versión del servidor: 5.6.38-log
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `discu351_clase`
--

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ASIGNATURAS`
--

CREATE TABLE `ASIGNATURAS` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ASIGNATURA_UNIDADTRABAJO`
--

CREATE TABLE `ASIGNATURA_UNIDADTRABAJO` (
  `ID_ASIGNATURA` int(11) NOT NULL,
  `ID_UNIDAD_TRABAJO` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(9, 'Matemáticas', 0);

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
('CONTADOR', 19);

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
(180, 8);

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
  `completado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(96, 'Auxiliar de Clínica para Clínica Dental', 'Se necesita Auxiliar de Enfermeria con experiencia en el sector Odontológico para Clínica Dental de alto volúmen.', 'The Kent Institute', 'https://www.infojobs.net/compania-alemana-en-el-baix-llobregat/em-ia1968fc0794151892acc574e6df97a', 'empresa5@discutivo.com', '12564789', 'Experiencia en trabajos de mantenimiento en Pisos/ Apartamentos,\r\npreferentemente en hoteles (fontanería/carpintería/electricidad/ albañilería).\r\n\r\nSólidos conocimientos de climatización y electricidad\r\n\r\nNivel Inglés Alto', 1, 'Salario: 15.000€ - 18.000€ Bruto/año', 'Bilbao, Vizcaya/Bizkaia (España)', '2018-08-11 00:00:00.000000', '2018-06-12 23:44:50', 179, 0);

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
(84, 1),
(84, 9),
(85, 2),
(85, 4),
(85, 9),
(86, 3),
(86, 4),
(86, 6),
(87, 6),
(87, 9),
(88, 6),
(88, 10),
(89, 2),
(89, 8),
(90, 3),
(90, 6),
(90, 10),
(91, 2),
(91, 8),
(92, 4),
(92, 8),
(92, 10),
(93, 4),
(93, 8),
(93, 10),
(94, 2),
(94, 5),
(95, 4),
(95, 8),
(96, 1),
(96, 3),
(96, 6),
(96, 9);

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
(180, 'Ricardo ', 'Remache Sánchez', 8, '616342559', 'r.alexis.remache@gmail.com', 'img/bolsaTrabajo/perfiles/4d61452f-54ab-4564-81c0-40a2726f9462/cara.jpg', 'https://www.linkedin.com/in/ricardo-remache/', NULL, 'https://github.com/ricardo7227', 'Técnico Superior en Desarrollo de Aplicaciones multiplataforma,\r\nTécnico Superior en Desarrollo de Aplicaciones Web.\r\n\r\nLenguajes de programación:\r\n-Java, PHP,Javascript, python, ABap\r\nBase de datos:\r\n- Oracle y MySql\r\nOtros:\r\n-Android, SAP UI5', 'Prácticas en:\r\n2017 - Buzinger: Consultora de aplicaciones Móviles.\r\n2018 - Unisys: Consultora empresaria en informática.\r\n2018 - Becario en Unisys - Equipo de SAP.\r\n\r\n', '2018-06-13 00:00:17', 1, 1);

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
(180, 1),
(179, 3);

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
(5, 1, 'Ejercicios 1, 2, 3, 4, 6, 8, 10 de página 170 del libro', ' Asignatura tal', '2018-06-30'),
(7, 1, 'Examen de recuperación', 'Matemáticas', '2018-06-15'),
(8, 1, 'Hoy', 'Matemáticas', '2018-06-02'),
(9, 1, 'Examen tema 2', 'Literatura', '2018-06-03'),
(10, 1, 'Prueba', 'Asignatura', '2018-05-06'),
(11, 24, 'Nueva tarea', 'Asignatura', '2018-01-01'),
(14, 1, 'Prueba', 'Prueba', '2018-06-09'),
(16, 1, 'Nueva tarea4', 'Nueva asignatura', '2020-01-01'),
(17, 1, 'Prueba2', 'Asignatura', '2018-06-10'),
(18, 1, 'Nueva tarea', 'asgasgsdgha', '2020-01-01'),
(19, 1, 'Nueva tarea', 'Nueva asignatura', '2018-09-10'),
(20, 1, 'Nueva tarea', 'prueba', '2019-01-01'),
(23, 4, 'Nueva tarea', 'Nueva asignatura', '2018-06-04'),
(24, 4, 'Nueva tarea', 'Nueva asignatura', '2018-06-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `UNIDADES_TRABAJO`
--

CREATE TABLE `UNIDADES_TRABAJO` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(450) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EVALUACION` int(6) NOT NULL,
  `UNIDAD_HECHA` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(179, 'Empresa', 'SL', 123456789, 'empresa@discutivo.com', 'sha1:64000:18:1haBmPaOH9/h54tsFy9N4QdqODFMNYUQ:l74EcCGK6DrB1ap73wwDjVQw', 'empresa', NULL, 1, '2018-06-12 20:54:51'),
(180, 'Ricardo ', 'Remache Sánchez', 616342559, 'r.alexis.remache@gmail.com', 'sha1:64000:18:D/Z/pOc5e+FFWTSd+YWzhOmRLzEBvX98:eES87FHjESd//mXY0in+t2av', 'ricardo7227', NULL, 1, '2018-06-12 21:47:01');

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
(12, 94, 'migueldiaz.tg@gmail.com', '2', '978-3-16-148410-0', '1.00', 'FOL', '2 BACH', '2018-06-07', 'A la venta', NULL),
(13, 94, 'migueldiaz.tg@gmail.com', 'D:', '978-3-16-148410-0', '15.00', 'C. sociales', '1 DAW', '2018-06-08', 'A la venta', NULL),
(14, 94, 'migueldiaz.tg@gmail.com', 'pues si', '978-3-16-148410-1', '5.00', 'Lengua', '1 BACH', '2018-06-08', 'A la venta', NULL),
(15, 94, 'migueldiaz.tg@gmail.com', 'asdf', '978-3-16-148410-0', '6.00', 'Matemáticas', '4 ESO', '2018-06-08', 'A la venta', NULL),
(16, 94, 'migueldiaz.tg@gmail.com', 'prueba 2', '978-3-16-148410-0', '7.00', 'FOL', '2 BACH', '2018-06-09', 'A la venta', NULL),
(17, 94, 'migueldiaz.tg@gmail.com', 'xDD', '978-3-16-148410-0', '14.00', 'C. sociales', '1 DAW', '2018-06-10', 'A la venta', NULL),
(18, 94, 'migueldiaz.tg@gmail.com', 'el otro', '978-3-16-148410-1', '8.50', 'Lengua', '1 BACH', '2018-06-10', 'A la venta', NULL),
(19, 169, 'erasto.sanchez.44@gmail.com', 'Humildad', '123-44-2234--22', '34.00', 'C. sociales', '2 DAW', '2018-06-12', 'Reservado', NULL),
(20, 169, 'erasto.sanchez.44@gmail.com', 'dfg', 'dfg', '0.00', 'Matemáticas', '4 ESO', '2018-06-12', 'A la venta', NULL);

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
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `ID_APUNTAR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `ASIGNATURAS`
--
ALTER TABLE `ASIGNATURAS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ENVIAR_OFERTAS`
--
ALTER TABLE `ENVIAR_OFERTAS`
  MODIFY `ID_NOTIFICAR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `ESTUDIOS_CENTRO`
--
ALTER TABLE `ESTUDIOS_CENTRO`
  MODIFY `ID_FP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT de la tabla `OFERTA`
--
ALTER TABLE `OFERTA`
  MODIFY `ID_OFERTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `PERFIL_ALUMNO`
--
ALTER TABLE `PERFIL_ALUMNO`
  MODIFY `ID_PERFIL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `UNIDADES_TRABAJO`
--
ALTER TABLE `UNIDADES_TRABAJO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT de la tabla `venta_libros`
--
ALTER TABLE `venta_libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  ADD CONSTRAINT `fk_inc_usr1` FOREIGN KEY (`solicitado_por`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inc_usr2` FOREIGN KEY (`completado_por`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_prm_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prm_usr` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
