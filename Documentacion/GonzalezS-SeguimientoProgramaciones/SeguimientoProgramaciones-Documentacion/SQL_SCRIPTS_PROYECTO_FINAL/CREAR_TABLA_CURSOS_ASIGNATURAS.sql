use appbanco;
CREATE TABLE `CURSOS_ASIGNATURAS` (
  `ID_CURSO` int(11) NOT NULL,
  `ID_ASIGNATURA` int(11) NOT NULL,
  KEY `id_curso_id_asignatura_idx` (`ID_CURSO`),
  KEY `id_asignatura_is_curso_idx` (`ID_ASIGNATURA`),
  CONSTRAINT `id_curso_id_asignatura` FOREIGN KEY (`ID_CURSO`) REFERENCES `cursos` (`id_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
