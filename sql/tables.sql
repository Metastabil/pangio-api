CREATE TABLE IF NOT EXISTS `users` (
	`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`username` VARCHAR(255) NOT NULL UNIQUE,
	`password` VARCHAR(255) NOT NULL,
	`deleted` BOOL DEFAULT FALSE,
	`created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `groups` (
	`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
	`name` VARCHAR(255) NOT NULL UNIQUE,
	`description` TEXT,
	`deleted` BOOL DEFAULT FALSE,
	`created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `user_group_associations` (
	`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`user_id` INT UNSIGNED NOT NULL,
	`group_id` INT UNSIGNED NOT NULL,
	FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
	FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`)
);

CREATE TABLE IF NOT EXISTS `dealer_groups` (
	`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL UNIQUE,
	`description` TEXT,
	`deleted` BOOL DEFAULT FALSE,
	`created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `user_dealer_group_associations` (
	`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`user_id` INT UNSIGNED NOT NULL,
	`dealer_group_id` INT UNSIGNED NOT NULL,
	FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
	FOREIGN KEY (`dealer_group_id`) REFERENCES `dealer_groups` (`id`)
);

CREATE TABLE IF NOT EXISTS `article_groups` (
	`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL UNIQUE,
	`description` TEXT,
	`unavailable` BOOL DEFAULT FALSE,
	`deleted` BOOL DEFAULT FALSE,
	`created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `articles` (
	`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL UNIQUE,
	`description` TEXT,
	`price` FLOAT NOT NULL,
	`unavailable` BOOL DEFAULT FALSE,
	`article_group_id` INT UNSIGNED NOT NULL,
	`deleted` BOOL DEFAULT FALSE,
	`created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (`article_group_id`) REFERENCES `article_groups` (`id`)
);

CREATE TABLE IF NOT EXISTS `carts` (
	`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`user_id` INT UNSIGNED NOT NULL,
	`deleted` BOOL DEFAULT FALSE,
	`created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
);

CREATE TABLE IF NOT EXISTS `cart_elements` (
	`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`article_id` INT UNSIGNED NOT NULL,
	`cart_id` INT UNSIGNED NOT NULL,
	`amount` INT UNSIGNED NOT NULL,
	`deleted` BOOL DEFAULT FALSE,
	`created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
	FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`)
);

CREATE TABLE IF NOT EXISTS `orders` (
	`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`user_id` INT UNSIGNED NOT NULL,
	`paid` BOOL DEFAULT FALSE,
	`delivered` BOOL DEFAULT FALSE,
	`deleted` BOOL DEFAULT FALSE,
	`created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
);

CREATE TABLE IF NOT EXISTS `order_elements` (
	`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`article_id` INT UNSIGNED NOT NULL,
	`price` FLOAT NOT NULL,
	`order_id` INT UNSIGNED NOT NULL,
	`amount` INT UNSIGNED,
	`deleted` BOOL DEFAULT FALSE,
	`created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
	FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
);
