-- --------------------------------------------------------
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

-- Dumping structure for table confeitaria_2025.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_email_unique` (`email`),
  UNIQUE KEY `clientes_cpf_unique` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table confeitaria_2025.clientes: ~9 rows (approximately)
INSERT INTO `clientes` (`id`, `nome`, `email`, `telefone`, `endereco`, `cpf`, `imagem`, `created_at`, `updated_at`) VALUES
	(1, 'Prof. Leo Vandervort MD', 'sbergnaum@example.com', '+1-361-730-9522', '918 Wiza Rapids\nPort Trinity, IN 31231', '98684196247', NULL, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(2, 'Prof. Lydia Kessler II', 'born@example.org', '+1.217.455.6436', '828 Tyree Radial Apt. 032\nBlandaborough, IA 35513-0518', '42417284230', NULL, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(3, 'Dr. Mozelle Mayert DVM', 'brakus.wilfrid@example.org', '+12703073745', '2532 Trantow Loaf Suite 969\nSouth Marquesmouth, RI 09929', '97037576562', NULL, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(4, 'Halie Howell', 'fgreenholt@example.net', '352-528-0168', '498 Amelie Villages\nGusikowskifort, AR 31497', '47646460494', NULL, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(5, 'Ray McKenzie', 'ucronin@example.com', '(858) 340-7428', '16136 Bechtelar Park\nBoehmmouth, NV 07088-3075', '54342506420', NULL, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(6, 'Pietro Ortiz', 'magali94@example.com', '+1.567.575.0617', '6273 Eloisa Pines Apt. 178\nKaceyshire, TN 54038-4204', '68843927741', NULL, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(7, 'Prof. Steve Shanahan', 'verner45@example.net', '+1-409-507-6715', '533 Dell Spurs\nRolandochester, IN 26242-1466', '55208364423', NULL, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(8, 'Muhammad Dibbert', 'balistreri.lynn@example.net', '+1-623-394-2150', '80392 Molly Rapids\nTillmanfort, SC 70371-3175', '70809336009', NULL, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(9, 'Jodie Larkin', 'aabernathy@example.org', '+1-551-477-8931', '79356 Armstrong Cliff Suite 907Peterhaven, AL 68505-8152', '29994997792', 'clientes/5fjn8LSy3R4jccVEgZgrk16nzys73mVfgh0BkTSO.jpg', '2026-05-08 19:43:07', '2026-05-08 23:09:58');

-- Dumping structure for table confeitaria_2025.entregas
CREATE TABLE IF NOT EXISTS `entregas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pedido_id` bigint unsigned NOT NULL,
  `nome_retirador` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora_entrega` time DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entregas_pedido_id_foreign` (`pedido_id`),
  CONSTRAINT `entregas_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table confeitaria_2025.entregas: ~4 rows (approximately)
INSERT INTO `entregas` (`id`, `pedido_id`, `nome_retirador`, `endereco`, `hora_entrega`, `status`, `created_at`, `updated_at`) VALUES
	(4, 4, 'ana alura', '121 Jermey IslandEast Josiane, NJ 31683-8876', '08:30:00', 'pendente', '2026-05-08 20:27:23', '2026-05-08 20:28:04'),
	(5, 5, 'ana alura', '45294 Watsica Course Apt. 458Jaedenport, TN 41054-5602', '22:10:00', 'entregue', '2026-05-08 20:29:22', '2026-05-08 20:29:51'),
	(6, 6, 'ana alura', '121 Jermey IslandEast Josiane, NJ 31683-8876', '09:05:00', 'entregue', '2026-05-08 20:30:37', '2026-05-08 20:33:19'),
	(7, 7, 'ana alura', '121 Jermey IslandEast Josiane, NJ 31683-8876', '08:03:00', 'entregue', '2026-05-08 23:11:35', '2026-05-08 23:14:10');

-- Dumping structure for table confeitaria_2025.item_pedidos
CREATE TABLE IF NOT EXISTS `item_pedidos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pedido_id` bigint unsigned NOT NULL,
  `produto_id` bigint unsigned NOT NULL,
  `quantidade` decimal(8,2) NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL,
  `observacoes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_pedidos_pedido_id_foreign` (`pedido_id`),
  KEY `item_pedidos_produto_id_foreign` (`produto_id`),
  CONSTRAINT `item_pedidos_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `item_pedidos_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table confeitaria_2025.item_pedidos: ~6 rows (approximately)
INSERT INTO `item_pedidos` (`id`, `pedido_id`, `produto_id`, `quantidade`, `valor_unitario`, `observacoes`, `created_at`, `updated_at`) VALUES
	(3, 2, 6, 10.00, 199.26, 'giiuiu', '2026-05-08 19:54:14', '2026-05-08 19:54:14'),
	(8, 4, 4, 20.00, 79.50, 'dsvzgffgxdf', '2026-05-08 20:27:23', '2026-05-08 20:27:23'),
	(9, 5, 6, 15.00, 199.26, NULL, '2026-05-08 20:29:22', '2026-05-08 20:29:22'),
	(10, 6, 7, 10.00, 22.51, NULL, '2026-05-08 20:30:37', '2026-05-08 20:30:37'),
	(11, 7, 2, 20.00, 37.68, 'jdjdjdd', '2026-05-08 23:11:35', '2026-05-08 23:11:35'),
	(12, 7, 5, 40.00, 167.20, NULL, '2026-05-08 23:11:35', '2026-05-08 23:11:35');

-- Dumping structure for table confeitaria_2025.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table confeitaria_2025.migrations: ~12 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '2026_03_11_190623_create_cliente_table', 1),
	(3, '2026_03_11_191703_create_produtos_table', 1),
	(4, '2026_03_11_191757_create_pedidos_table', 1),
	(5, '2026_03_11_203555_create_receitas_table', 1),
	(6, '2026_03_26_232454_add_imagem_to_produtos_table', 1),
	(7, '2026_03_26_232652_add_imagem_to_produtos_table', 1),
	(8, '2026_05_06_200057_create_item_pedidos_table', 1),
	(9, '2026_05_06_235413_add_observacoes_to_item_pedidos_table', 1),
	(10, '2026_05_07_000001_create_entregas_table', 1),
	(11, '2026_05_07_013731_add_tem_entrega_to_pedidos_table', 1),
	(12, '2026_05_07_103600_add_imagem_to_clientes_table', 1);

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
  `valor_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `data_pedido` date NOT NULL,
  `data_entrega` date DEFAULT NULL,
  `forma_pagamento` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'não definido',
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente',
  `tem_entrega` tinyint(1) NOT NULL DEFAULT '0',
  `hora_entrega` time DEFAULT NULL,
  `endereco_entrega` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidos_cliente_id_foreign` (`cliente_id`),
  CONSTRAINT `pedidos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table confeitaria_2025.pedidos: ~5 rows (approximately)
INSERT INTO `pedidos` (`id`, `cliente_id`, `valor_total`, `data_pedido`, `data_entrega`, `forma_pagamento`, `status`, `tem_entrega`, `hora_entrega`, `endereco_entrega`, `created_at`, `updated_at`) VALUES
	(2, 5, 1992.60, '2026-05-12', '2026-05-27', 'dinheiro', 'entregue', 0, NULL, NULL, '2026-05-08 19:43:51', '2026-05-08 19:54:14'),
	(4, 2, 1605.00, '2026-05-08', '2026-05-15', 'débito', 'pendente', 1, NULL, NULL, '2026-05-08 20:27:23', '2026-05-08 20:27:23'),
	(5, 4, 3003.90, '2026-05-09', '2026-05-28', 'dinheiro', 'entregue', 1, NULL, NULL, '2026-05-08 20:29:22', '2026-05-08 20:29:51'),
	(6, 3, 240.10, '2026-05-13', '2026-05-28', 'débito', 'entregue', 1, NULL, NULL, '2026-05-08 20:30:37', '2026-05-08 20:32:14'),
	(7, 2, 7456.60, '2026-05-08', '2026-05-15', 'débito', 'entregue', 1, NULL, NULL, '2026-05-08 23:11:35', '2026-05-08 23:14:10');

-- Dumping structure for table confeitaria_2025.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
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

-- Dumping data for table confeitaria_2025.produtos: ~9 rows (approximately)
INSERT INTO `produtos` (`id`, `nome`, `sabor_massa`, `recheio`, `cobertura`, `valor`, `imagem`, `created_at`, `updated_at`) VALUES
	(1, 'vel Especial', 'Red Velvet', 'Creme de Morango', 'Chantilly', 67.24, NULL, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(2, 'veritatis Especial', 'Baunilha', 'Creme de Morango', 'Chocolate', 37.68, NULL, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(3, 'voluptas Especial', 'Baunilha', 'Creme de Morango', 'Chantilly', 141.49, NULL, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(4, 'aliquam Especial', 'Baunilha', 'Brigadeiro', 'Chocolate', 79.50, NULL, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(5, 'blanditiis Especial', 'Chocolate', 'Brigadeiro', 'Chantilly', 167.20, NULL, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(6, 'autem Especial', 'Red Velvet', 'Brigadeiro', 'Chantilly', 199.26, NULL, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(7, 'mollitia Especial', 'Chocolate', 'Brigadeiro', 'Chocolate', 22.51, NULL, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(8, 'quia Especial', 'Baunilha', 'Beijinho', 'Chantilly', 128.45, NULL, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(9, 'minima Especial', 'Red Velvet', 'Beijinho', 'Chantilly', 59.39, 'produtos/82Zp8515zBQtaGso1Z0HmGN15eeZzhL3H33E8peU.jpg', '2026-05-08 19:43:07', '2026-05-08 23:10:29');

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
	(1, 'Produto de Baunilha', 'Dolore vel est vero et est earum hic hic.', 'Voluptatem est ipsa tempore quibusdam laudantium occaecati. Adipisci id ab suscipit perspiciatis minima voluptas architecto. Itaque ratione ducimus ea ullam recusandae quasi. Ea nisi tenetur voluptatem nobis sint culpa voluptatibus.', 67, 17, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(2, 'Produto de Baunilha', 'Minima iure hic ipsa hic ipsam quasi perferendis.', 'Mollitia sit iusto molestias qui porro eaque. Sed placeat aspernatur est suscipit ratione. Velit architecto rem sint sed sint deleniti. Esse molestiae blanditiis deleniti laudantium repellat voluptatem.', 84, 10, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(3, 'Produto de Cenoura', 'Sit ea ab quos nam qui voluptates enim suscipit dolores iusto illum omnis.', 'Et quia sed repellendus quia aspernatur incidunt tenetur quis. Voluptate vero et aspernatur voluptate. Sunt occaecati aperiam dolorum voluptatem. Ea consequatur possimus ut.', 80, 20, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(4, 'Produto de Baunilha', 'In ratione optio eius maxime fuga recusandae quia.', 'Vero reprehenderit corrupti fuga doloribus corporis et vitae. Blanditiis assumenda voluptatem rerum laborum culpa et vel unde. Quia voluptate enim quia dolores et. Natus et aliquid sint temporibus doloremque.', 69, 6, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(5, 'Produto Red Velvet', 'Ab provident et quo rerum eum totam perspiciatis enim corrupti dolores quis.', 'Id aut nostrum eum tenetur omnis sint. Odit necessitatibus velit eveniet rerum molestiae. Facilis ut adipisci quo sit et eligendi est.', 31, 17, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(6, 'Produto de Chocolate', 'Aut eveniet quae iusto quaerat ut tempora nisi dignissimos ad et qui.', 'Numquam vero eius perferendis commodi. Ut odio saepe animi quia pariatur facilis non. Aut in et placeat quo rerum consequatur.', 47, 20, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(7, 'Produto de Morango', 'Ut error quasi molestiae omnis ut et.', 'Illum necessitatibus quia qui inventore ut. Ut repellat voluptatum asperiores quaerat. Saepe aliquam in quis.', 48, 16, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(8, 'Produto Red Velvet', 'Nam vero error numquam et harum assumenda.', 'Aliquam qui aperiam quo velit. Totam eligendi quam dolore ad ut eum. Molestiae et saepe quia voluptatibus consectetur. Tempore exercitationem expedita sit dolores.', 105, 20, '2026-05-08 19:43:07', '2026-05-08 19:43:07'),
	(9, 'Produto Red Velvet', 'Fuga dignissimos beatae natus molestiae et iste molestias beatae doloribus aperiam qui.', 'Odit cupiditate corrupti qui. Ex temporibus quas illum nam. Molestiae delectus mollitia temporibus perferendis quisquam. Perferendis molestiae vel et voluptatem nihil autem aut.', 52, 19, '2026-05-08 19:43:07', '2026-05-08 19:43:07');

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
	('FCDJSMhw1eVSJ94JovHyq9UyRDZl4UuZGsid0NB3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWFdQaEhtaldkYVZFVnFMeVU5Vk5tcWNqOEpoNGxRWERVeWRFVFZlaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778271348);

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
