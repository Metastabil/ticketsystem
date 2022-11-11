CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `is_administrator` BOOLEAN DEFAULT FALSE,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `projects` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(2000) NOT NULL,
    `description` TEXT,
    `status` VARCHAR(255) NOT NULL,
    `created_by_user_id` INT UNSIGNED NOT NULL,
    `responsible_user_id` INT UNSIGNED NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`created_by_user_id`) REFERENCES `users` (`id`),
    FOREIGN KEY (`responsible_user_id`) REFERENCES `users` (`id`)
);

CREATE TABLE IF NOT EXISTS `tickets` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(2000) NOT NULL,
    `description` TEXT,
    `due_date` DATE,
    `estimated_time_investment` DOUBLE UNSIGNED,
    `real_time_investment` DOUBLE UNSIGNED,
    `status` VARCHAR(255) NOT NULL,
    `created_by_user_id` INT UNSIGNED NOT NULL,
    `responsible_user_id` INT UNSIGNED NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`created_by_user_id`) REFERENCES `users` (`id`),
    FOREIGN KEY (`responsible_user_id`) REFERENCES `users` (`id`)
);