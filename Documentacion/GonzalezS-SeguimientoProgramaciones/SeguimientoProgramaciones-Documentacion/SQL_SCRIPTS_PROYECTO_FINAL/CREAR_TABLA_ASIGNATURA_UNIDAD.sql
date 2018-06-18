CREATE TABLE `asignatura_unidadtrabajo` (
  `ID_ASIGNATURA` int(11) NOT NULL,
  `ID_UNIDAD_TRABAJO` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `unidad_asignatura_idx` (`ID_ASIGNATURA`),
  CONSTRAINT `ASIGNATURA_UNIDAD` FOREIGN KEY (`ID_ASIGNATURA`) REFERENCES `asignaturas` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SELECT * FROM proyectofinal.asignaturas;