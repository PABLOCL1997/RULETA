-- sofia_ruleta.mercado definition

CREATE TABLE `MERCADO` (
  `ID_MERCADO` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ID_CIUDAD` int(11) DEFAULT NULL,
  `DIRECCION` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ESTADO` varchar(1) DEFAULT NULL,
  `USER_CREACION` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_MERCADO`),
  KEY `ID_CIUDAD1` (`ID_CIUDAD`),
  CONSTRAINT `ID_CIUDAD1` FOREIGN KEY (`ID_CIUDAD`) REFERENCES `ciudad` (`ID_CIUDAD`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


-- Datos
insert
	into
	sofia_ruleta.MERCADO (NOMBRE,
	ID_CIUDAD,
	DIRECCION,
	ESTADO,
	USER_CREACION,
	FECHA_CREACION)
values
	 ('Abasto',1,'3cer anillo interno','H','admin','2023-05-09 12:25:20'),
	 ('Ramada',1,'Primer Anillo Interno','H','admin','2023-05-09 12:26:02');