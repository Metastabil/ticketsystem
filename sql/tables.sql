CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `user_groups` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `status` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `projects` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `status_id` INT UNSIGNED NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
);

CREATE TABLE IF NOT EXISTS `tickets` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(2048) NOT NULL,
    `description` TEXT,
    `due_date` DATE,
    `responsible_user_id` INT UNSIGNED,
    `project_id` INT UNSIGNED NOT NULL,
    `status_id` INT UNSIGNED NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
    FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
);

CREATE TABLE IF NOT EXISTS `user_group` (
    `user_id` INT UNSIGNED NOT NULL,
    `group_id` INT UNSIGNED NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
    FOREIGN KEY (`group_id`) REFERENCES `user_groups` (`id`)
);

CREATE TABLE IF NOT EXISTS `user_project` (
    `user_id` INT UNSIGNED NOT NULL,
    `project_id` INT UNSIGNED NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
    FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`)
);

CREATE TABLE IF NOT EXISTS `group_project` (
    `group_id` INT UNSIGNED NOT NULL,
    `project_id` INT UNSIGNED NOT NULL,
    FOREIGN KEY (`group_id`) REFERENCES `user_groups` (`id`),
    FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`)
);