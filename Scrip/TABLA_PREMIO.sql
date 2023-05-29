-- sofia_ruleta.premio definition

CREATE TABLE PREMIO (
  ID_PREMIO int(11) NOT NULL AUTO_INCREMENT,
  NOMBRE varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  ESTADO varchar(1) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  USER_CREACION varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  FECHA_CREACION datetime DEFAULT NULL,
  PRIMARY KEY (ID_PREMIO)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- Datos
insert
	into
	sofia_ruleta.premio (NOMBRE,
	ESTADO,
	USER_CREACION,
	FECHA_CREACION)
values
	 ('Mortadela de 500 grs','H','calderonpa','2023-05-05 01:03:17'),
	 ('Pate de 100 grs','H','calderonpa','2023-05-05 01:04:01'),
	 ('Parrillada Dismac','H','calderonpa','2023-05-05 01:04:35'),
	 ('Premio Consuelo','4','calderonpa','2023-05-06 12:11:00'),
	 ('Ninguno','H','pcalderon','2023-05-12 21:30:40');