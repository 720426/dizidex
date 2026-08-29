CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `short_description` TEXT,
  `full_description` TEXT,
  `price` DECIMAL(10, 2) NOT NULL,
  `currency` VARCHAR(10) DEFAULT 'INR',
  `checkout_url` VARCHAR(500),
  `cta_text` VARCHAR(100) DEFAULT 'GET IT NOW',
  `status` ENUM('Draft', 'Published', 'Archived') DEFAULT 'Draft',
  `seo_title` VARCHAR(255),
  `seo_description` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE `product_features` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `product_id` INT NOT NULL,
  `feature` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `display_order` INT DEFAULT 0,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
);

CREATE TABLE `product_faqs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `product_id` INT NOT NULL,
  `question` TEXT NOT NULL,
  `answer` TEXT NOT NULL,
  `display_order` INT DEFAULT 0,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
);

CREATE TABLE `testimonials` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `product_id` INT NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `rating` DECIMAL(2, 1) DEFAULT 5.0,
  `review` TEXT NOT NULL,
  `source` VARCHAR(100),
  `status` ENUM('Hidden', 'Published') DEFAULT 'Published',
  `display_order` INT DEFAULT 0,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
);

CREATE TABLE `utm_sessions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `session_id` VARCHAR(255) NOT NULL,
  `source` VARCHAR(100),
  `medium` VARCHAR(100),
  `campaign` VARCHAR(100),
  `content` VARCHAR(100),
  `term` VARCHAR(100),
  `fbclid` VARCHAR(255),
  `referrer` VARCHAR(500),
  `device` VARCHAR(50),
  `browser` VARCHAR(50),
  `country` VARCHAR(50),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `page_views` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `session_id` VARCHAR(255) NOT NULL,
  `page_url` VARCHAR(500) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `checkout_events` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `session_id` VARCHAR(255) NOT NULL,
  `product_id` INT,
  `value` DECIMAL(10, 2),
  `currency` VARCHAR(10) DEFAULT 'INR',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE SET NULL
);

CREATE TABLE `orders` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_id` VARCHAR(100) NOT NULL UNIQUE,
  `session_id` VARCHAR(255),
  `product_id` INT,
  `status` VARCHAR(50),
  `amount` DECIMAL(10, 2),
  `currency` VARCHAR(10) DEFAULT 'INR',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE SET NULL
);

CREATE TABLE `settings` (
  `setting_key` VARCHAR(100) PRIMARY KEY,
  `setting_value` TEXT
);

-- Insert Default Admin (Password: Dizidex@8660 hashed with bcrypt)
-- NOTE: In PHP we would use password_hash(). Let's use a placeholder and instruct to run a setup script.
-- I'll insert a pre-hashed password for 'Dizidex@8660'.
INSERT INTO `users` (`username`, `password`) VALUES ('uday', '$2y$10$fIuN39eB7GKVw0wGz4K5bObJ45U0.u9W3bVvG/3yK/tV4k6zC48jW');
