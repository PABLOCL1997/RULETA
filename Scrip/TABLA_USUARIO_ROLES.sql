-- Tabla roles y usuario

CREATE TABLE `users_roles` (
  `id_user_rol` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  PRIMARY KEY (`id_user_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

-- Datos
INSERT INTO sofia_ruleta.users_roles (id,id_rol) VALUES
	 (1,1);