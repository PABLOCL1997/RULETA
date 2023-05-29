BEGIN;
    
    -- Crear la base de datos
    CREATE DATABASE `SOFIA_RULETA` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci */;

	USE `SOFIA_RULETA`;  -- Usamos la base de datos SOFIA_RULETA

	/*-------- TABLA CIUDAD -----------*/
	
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
	
		
	/*-------- TABLA PREMIO -----------*/

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
		
	
	/*-------- TABLA ROLES -----------*/

	CREATE TABLE `roles` (
	  `id_rol` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `created_at` timestamp NULL DEFAULT NULL,
	  `updated_at` timestamp NULL DEFAULT NULL,
	  PRIMARY KEY (`id_rol`),
	  UNIQUE KEY `roles_nombre_unique` (`nombre`)
	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	
	
	-- Datos
	
	insert
		into
		sofia_ruleta.roles (nombre,
		descripcion,
		estado,
		created_at,
		updated_at)
	values
		 ('administrador','administrador del sistema','A','2023-05-26 19:49:26','2023-05-26 19:49:33'),
		 ('proveedor','Personal proveedor del sistema','A','2023-05-26 19:48:45','2023-05-26 19:48:45');
		
	/*-------- TABLA PREMIOS -----------*/

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
		
	/*-------- TABLA MERCADO -----------*/

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
		
	/*-------- TABLA MERCADO_PREMIO -----------*/

	CREATE TABLE MERCADO_PREMIO (
	  ID_MERCADO_PREMIO int(11) NOT NULL AUTO_INCREMENT,
	  ID_MERCADO int(11) DEFAULT NULL,
	  ID_PREMIO int(11) DEFAULT NULL,
	  CANTIDAD_MAX_SALIDAS int(8) DEFAULT NULL,
	  CANTIDAD_ENTREGADO_DIARIO int(8) DEFAULT NULL,
	  USER_CREACION varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
	  FECHA_CREACION datetime DEFAULT NULL,
	  PRIMARY KEY (ID_MERCADO_PREMIO),
	  KEY ID_MERCADO (ID_MERCADO),
	  KEY ID_PREMIO (ID_PREMIO),
	  CONSTRAINT ID_MERCADO FOREIGN KEY (ID_MERCADO) REFERENCES MERCADO (ID_MERCADO),
	  CONSTRAINT ID_PREMIO FOREIGN KEY (ID_PREMIO) REFERENCES PREMIO (ID_PREMIO)
	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
	
	-- Datos
	insert
		into
		sofia_ruleta.mercado_premio (ID_MERCADO,
		ID_PREMIO,
		CANTIDAD_MAX_SALIDAS,
		CANTIDAD_ENTREGADO_DIARIO,
		USER_CREACION,
		FECHA_CREACION)
	values
		 (3,1,3,3,'admin','2023-05-09 12:26:33'),
		 (3,2,5,6,'admin','2023-05-09 12:28:01'),
		 (3,3,5,7,'admin','2023-05-09 12:28:37'),
		 (3,4,8,0,'admin','2023-05-09 12:29:50'),
		 (3,5,0,0,'admin','2023-05-19 21:31:26');
		
	/*-------- TABLA CLIENTE_PREMIADO -----------*/

	CREATE TABLE `CLIENTE_PREMIADO` (
	  `ID_CLIENTE_PREMIEADO` int(11) NOT NULL AUTO_INCREMENT,
	  `NOMBRES` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
	  `APELLIDOS` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
	  `CARNET_IDENTIDAD` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
	  `TELEFONO` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
	  `ID_CIUDAD` int(11) DEFAULT NULL,
	  `FECHA_NACIMIENTO` date DEFAULT NULL,
	  `NRO_TICKET` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
	  `ESTADO` varchar(1) DEFAULT NULL,
	  `ID_MERCADO` int(11) DEFAULT NULL,
	  `ID_PREMIO` int(11) DEFAULT NULL,
	  `USER_CREACION` varchar(150) DEFAULT NULL,
	  `FECHA_CREACION` datetime DEFAULT NULL,
	  PRIMARY KEY (`ID_CLIENTE_PREMIEADO`),
	  KEY `ID_PREMIO1` (`ID_MERCADO`),
	  KEY `ID_CIUDAD` (`ID_CIUDAD`),
	  CONSTRAINT `ID_CIUDAD` FOREIGN KEY (`ID_CIUDAD`) REFERENCES `CIUDAD` (`ID_CIUDAD`),
	  CONSTRAINT `ID_MERCADO1` FOREIGN KEY (`ID_MERCADO`) REFERENCES `MERCADO` (`ID_MERCADO`),
	  CONSTRAINT `ID_PREMIO1` FOREIGN KEY (`ID_MERCADO`) REFERENCES `PREMIO` (`ID_PREMIO`)
	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
COMMIT;