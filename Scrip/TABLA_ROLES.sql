-- sofia_ruleta.roles definition

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