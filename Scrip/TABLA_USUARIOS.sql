-- sofia_ruleta.users definition

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_mercado` int(11) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Datos 
insert
	into
	sofia_ruleta.users (name,
	email,
	email_verified_at,
	password,
	nombres,
	apellidos,
	estado,
	telefono,
	id_mercado,
	id_rol,
	remember_token,
	created_at,
	updated_at) 
VALUES
	('sofia','sofia@admin.com',NULL,'$2y$10$obR6AVSF2pCRhgtN9QI3T.FUU6IRED1QTonSEoUzSUVHy6q/r0DUK',NULL,NULL,NULL,NULL,3,NULL,NULL,'2023-05-26 18:26:23','2023-05-26 18:26:23');