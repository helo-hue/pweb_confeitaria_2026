cccccccccccccccccccccccccccccccccccccccccc-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for confeitaria_2025
CREATE DATABASE IF NOT EXISTS `confeitaria_2025` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `confeitaria_2025`;

-- Dumping structure for table confeitaria_2025.bolos
CREATE TABLE IF NOT EXISTS `bolos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sabor_massa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recheio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cobertura` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table confeitaria_2025.bolos: ~9 rows (approximately)
INSERT INTO `bolos` (`id`, `nome`, `sabor_massa`, `recheio`, `cobertura`, `valor`, `imagem`, `created_at`, `updated_at`) VALUES
	(1, 'aliquam Especial', 'Baunilha', 'Brigadeiro', 'Chantilly', 76.52, NULL, '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(2, 'quas Especial', 'Red Velvet', 'Beijinho', 'Chocolate', 136.10, NULL, '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(3, 'cum Especial', 'Red Velvet', 'Brigadeiro', 'Ganache', 126.06, NULL, '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(4, 'beatae Especial', 'Red Velvet', 'Creme de Morango', 'Chantilly', 135.71, NULL, '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(5, 'delectus Especial', 'Baunilha', 'Brigadeiro', 'Chocolate', 181.53, NULL, '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(6, 'perspiciatis Especial', 'Chocolate', 'Brigadeiro', 'Chantilly', 148.40, NULL, '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(8, 'quod Especial', 'Baunilha', 'Beijinho', 'Chantilly', 44.86, NULL, '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(9, 'et Especial', 'Baunilha', 'Beijinho', 'Chantilly', 80.22, NULL, '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(11, 'Bolo de Cenoura', 'Cenoura', 'Chocolate', 'Chocolate', 100.00, 'bolos/iJXchTqTu5IGjTk8oOxSF0pmZ3pPxIym0wJTvoyP.jpg', '2026-03-27 22:57:58', '2026-03-27 22:58:53');

-- Dumping structure for table confeitaria_2025.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_email_unique` (`email`),
  UNIQUE KEY `clientes_cpf_unique` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table confeitaria_2025.clientes: ~11 rows (approximately)
INSERT INTO `clientes` (`id`, `nome`, `email`, `telefone`, `endereco`, `cpf`, `created_at`, `updated_at`) VALUES
	(1, 'Ms. Leta Emmerich II', 'sbarton@example.net', '1-561-925-6376', '30896 Brett Port\nWest Pollyland, AZ 19791-9941', '43204976086', '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(2, 'Bailee Brown', 'wilburn.ullrich@example.com', '+1-832-959-2682', '49502 Kip Gateway Apt. 240\nHackettbury, RI 14725-6090', '25917702828', '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(3, 'Domingo McCullough', 'emoen@example.net', '575-493-3671', '534 Jed Club Suite 241\nEast Selinaview, AL 84688', '11196129833', '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(4, 'Dr. Jacques McDermott III', 'ernestina.thompson@example.com', '(567) 391-3777', '77610 Ida Islands\nLake Janamouth, OK 23080', '76866611384', '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(5, 'Braxton Kub Sr.', 'ecollier@example.org', '+14809400800', '18530 Senger Plaza\nNorth Gladys, MD 54341', '50968469498', '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(6, 'Gwen Schaden', 'dorothea.stroman@example.org', '253-620-6355', '8327 Marielle Course Suite 538\nBobbiemouth, KS 23127', '65192468461', '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(7, 'Aaron Strosin', 'dimitri86@example.org', '+1 (312) 895-2938', '970 Stephanie Squares\nMaudeland, NY 30513', '99372650679', '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(8, 'Prof. Earl Huels', 'zkuphal@example.com', '417-275-1475', '771 Wiza Station\nJonathanton, NE 29369-8565', '11593879714', '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(9, 'Dr. Ezra Shields', 'qfranecki@example.org', '+1-623-992-4887', '4529 Pete Mill Suite 071\nRhiannachester, WA 81881', '91176868134', '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(10, 'Tracey Gusikowski', 'dorothea.boehm@example.com', '+1-409-829-0224', '4523 Drew Orchard Apt. 168\nPort Theomouth, VT 84813-6680', '21889647938', '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(11, 'Ana Laura', 'rheloisa173@gmail.com', '49999684726', 'Nereu ramos', '66666666666', '2026-03-27 22:33:41', '2026-03-27 22:33:41');

-- Dumping structure for table confeitaria_2025.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table confeitaria_2025.migrations: ~6 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '2026_03_11_190623_create_cliente_table', 1),
	(3, '2026_03_11_191703_create_bolos_table', 1),
	(4, '2026_03_11_191757_create_pedidos_table', 1),
	(5, '2026_03_11_203555_create_receitas_table', 1),
	(6, '2026_03_26_232454_add_imagem_to_bolos_table', 1),
	(7, '2026_03_26_232652_add_imagem_to_bolos_table', 1);

-- Dumping structure for table confeitaria_2025.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table confeitaria_2025.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table confeitaria_2025.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` bigint unsigned NOT NULL,
  `bolo_id` bigint unsigned NOT NULL,
  `quantidade` decimal(8,2) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_pedido` date NOT NULL,
  `data_entrega` date DEFAULT NULL,
  `forma_pagamento` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'não definido',
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidos_cliente_id_foreign` (`cliente_id`),
  KEY `pedidos_bolo_id_foreign` (`bolo_id`),
  CONSTRAINT `pedidos_bolo_id_foreign` FOREIGN KEY (`bolo_id`) REFERENCES `bolos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pedidos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table confeitaria_2025.pedidos: ~4 rows (approximately)
INSERT INTO `pedidos` (`id`, `cliente_id`, `bolo_id`, `quantidade`, `valor_total`, `data_pedido`, `data_entrega`, `forma_pagamento`, `status`, `created_at`, `updated_at`) VALUES
	(1, 2, 4, 1.50, 203.57, '2026-04-02', '2026-04-10', 'pix', 'pendente', '2026-03-27 22:32:31', '2026-03-27 22:32:31'),
	(2, 6, 5, 30.00, 5445.90, '2026-03-28', '2026-03-29', 'pix', 'pendente', '2026-03-27 22:33:17', '2026-03-27 22:33:17'),
	(3, 11, 3, 0.90, 113.45, '2026-03-31', '2026-03-28', 'dinheiro', 'pendente', '2026-03-27 22:34:14', '2026-03-27 22:34:14'),
	(4, 11, 1, 8.00, 612.16, '2026-03-27', '2026-03-19', 'pix', 'entregue', '2026-03-27 23:01:17', '2026-03-27 23:02:45');

-- Dumping structure for table confeitaria_2025.receitas
CREATE TABLE IF NOT EXISTS `receitas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ingredientes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `modo_preparo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempo_preparo` int NOT NULL,
  `rendimento` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table confeitaria_2025.receitas: ~9 rows (approximately)
INSERT INTO `receitas` (`id`, `nome`, `ingredientes`, `modo_preparo`, `tempo_preparo`, `rendimento`, `created_at`, `updated_at`) VALUES
	(1, 'Bolo Red Velvet', 'Dolor amet voluptatem accusamus sunt ut consequatur placeat nulla ut quidem.', 'Voluptatem quas recusandae architecto quis ratione. Dolorum totam saepe sequi blanditiis et quos soluta porro. Consequatur vel iste tempore nisi consequatur eveniet culpa.', 109, 14, '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(2, 'Bolo Red Velvet', 'Repudiandae voluptatem quia earum autem ipsum aut.', 'Voluptate corrupti laboriosam velit impedit ducimus sit. Eum consequatur quia quisquam dolorem aut. Quia eum nulla quidem repudiandae enim cupiditate. Consequatur molestiae nulla impedit commodi accusamus eaque.', 66, 15, '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(3, 'Bolo de Chocolate', 'Est vero ratione ut aspernatur tenetur deserunt culpa accusantium esse.', 'Quos iste quas illum consequatur voluptas. Suscipit provident atque labore libero. Consequatur aut sint quae.', 87, 14, '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(4, 'Bolo de Cenoura', 'Vel alias fugiat autem voluptas ullam nesciunt quibusdam et dolorem quidem.', 'Expedita recusandae voluptate blanditiis natus ut fugit ut. Qui dicta voluptatibus quis ea sint. Sed ipsum enim laborum quos id. Id qui officia ab aut sint odit.', 42, 20, '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(5, 'Bolo Red Velvet', 'In autem officia consequatur harum est officiis facilis ratione et et.', 'Et quia earum cupiditate non placeat sed. Rem nam molestiae illo provident. Expedita voluptatem inventore rerum voluptatem. Assumenda doloremque numquam eius et est.', 89, 7, '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(6, 'Bolo Red Velvet', 'Voluptatem inventore quaerat occaecati soluta corporis nam ut sunt quaerat.', 'Impedit voluptas quae magni dolorum maiores aut. Consequuntur ut autem deleniti vel sapiente. Veritatis et cum ut nostrum numquam voluptatem.', 87, 9, '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(7, 'Bolo de Baunilha', 'Eius eveniet repellendus aut non maiores error et nihil.', 'Illo dolor consequuntur amet fugiat porro. Voluptate ut architecto rerum sapiente. Tenetur autem at eum saepe similique sit. Et qui facere id est fugit eligendi esse.', 84, 17, '2026-03-27 22:32:09', '2026-03-27 22:32:09'),
	(8, 'Bolo de Cenoura', 'Vel mollitia suscipit vel voluptate quae laboriosam maxime qui placeat est sequi vero.', 'Enim repellat autem dolorem sit sit et eveniet soluta. Odio tenetur et ut omnis voluptas qui. Dolorem nisi doloremque velit rerum voluptas non corrupti.', 83, 17, '2026-03-27 22:32:09', '2026-03-27 22:54:46'),
	(9, 'Bolo de Morango', 'Est distinctio recusandae iusto rerum impedit explicabo vero incidunt qui alias.', 'Illo omnis nam distinctio illum quod. Officiis vel rem blanditiis ipsa amet. Ipsa rerum doloribus similique iste voluptate. Mollitia cupiditate aut quis eos suscipit eaque qui eos.', 76, 19, '2026-03-27 22:32:09', '2026-03-27 22:32:09');

-- Dumping structure for table confeitaria_2025.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table confeitaria_2025.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('00GmtM07clewq3jKyeChYkTdMwz86HgSp4arHdEm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNHJLWldiVnNjWmpMUHhmZ01TOWNPMnB1M0xUNk43MkV6YVdWcWlKMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZWRpZG9zIjtzOjU6InJvdXRlIjtzOjEzOiJwZWRpZG9zLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1774641778);

-- Dumping structure for table confeitaria_2025.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table confeitaria_2025.users: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
