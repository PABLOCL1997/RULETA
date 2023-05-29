-- sofia_ruleta.ciudad definition

CREATE TABLE CIUDAD (
  ID_CIUDAD int(11) NOT NULL AUTO_INCREMENT,
  NOMBRE varchar(150) COLLATE utf8_spanish2_ci DEFAULT NULL,
  ESTADO varchar(1) COLLATE utf8_spanish2_ci DEFAULT NULL,
  USER_CREACION varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  FECHA_CREACION datetime DEFAULT NULL,
  PRIMARY KEY (`ID_CIUDAD`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Datos
insert
	into
	sofia_ruleta.ciudad (NOMBRE,
	ESTADO,
	USER_CREACION,
	FECHA_CREACION)
values
	 ('Santa Cruz','H','admin','2023-05-09 23:52:39'),
	 ('La Paz','H','admin','2023-05-09 23:52:52'),
	 ('Cochabamba','H','admin','2023-05-09 23:53:08');