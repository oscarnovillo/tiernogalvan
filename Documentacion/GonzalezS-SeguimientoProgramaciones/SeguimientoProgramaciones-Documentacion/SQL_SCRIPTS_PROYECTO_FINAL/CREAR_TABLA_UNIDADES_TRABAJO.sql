CREATE TABLE `unidades_trabajo` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(450) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EVALUACION` int(6) NOT NULL,
  `UNIDAD_HECHA` tinyint(4) NOT NULL,
  `COMENTARIO` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
