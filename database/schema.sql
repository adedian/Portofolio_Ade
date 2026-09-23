-- ============================================================
-- Portfolio Ade Dian Sukmana — Database Schema
-- Engine: MySQL / MariaDB (XAMPP)
-- ============================================================

CREATE DATABASE IF NOT EXISTS `portfolio_ade`
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `portfolio_ade`;

-- ------------------------------------------------------------
-- users (admin panel authentication)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- experiences (work history + organization)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `experiences` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `type` ENUM('work','organization','education') NOT NULL DEFAULT 'work',
  `role` VARCHAR(150) NOT NULL,
  `organization` VARCHAR(150) NOT NULL,
  `location` VARCHAR(100) DEFAULT NULL,
  `period_start` VARCHAR(30) NOT NULL,
  `period_end` VARCHAR(30) NOT NULL DEFAULT 'Present',
  `year_marker` VARCHAR(10) NOT NULL,
  `summary` TEXT DEFAULT NULL,
  `tags` VARCHAR(500) DEFAULT NULL COMMENT 'comma separated',
  `sort_order` INT NOT NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- skills
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `skills` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `category` VARCHAR(60) NOT NULL,
  `name` VARCHAR(80) NOT NULL,
  `note` VARCHAR(255) DEFAULT NULL,
  `level` TINYINT UNSIGNED NOT NULL DEFAULT 75 COMMENT 'self-assessed proficiency 0-100, shown as a progress bar',
  `sort_order` INT NOT NULL DEFAULT 0
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- projects
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `projects` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `slug` VARCHAR(150) NOT NULL UNIQUE,
  `number` VARCHAR(4) NOT NULL,
  `title` VARCHAR(150) NOT NULL,
  `category` VARCHAR(100) NOT NULL,
  `filter_group` ENUM('WEB','SYSTEM','UIUX','AI') NOT NULL,
  `year` VARCHAR(10) DEFAULT NULL,
  `role` VARCHAR(150) DEFAULT NULL,
  `description` TEXT NOT NULL,
  `overview` TEXT DEFAULT NULL,
  `problem` TEXT DEFAULT NULL,
  `approach` TEXT DEFAULT NULL,
  `solution` TEXT DEFAULT NULL,
  `result` TEXT DEFAULT NULL,
  `technologies` VARCHAR(500) NOT NULL COMMENT 'comma separated',
  `features` TEXT DEFAULT NULL COMMENT 'newline separated',
  `thumbnail` VARCHAR(255) DEFAULT NULL,
  `is_academic` TINYINT(1) NOT NULL DEFAULT 0,
  `is_placeholder` TINYINT(1) NOT NULL DEFAULT 0,
  `featured` TINYINT(1) NOT NULL DEFAULT 0,
  `sort_order` INT NOT NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- project_images (gallery)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_images` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `project_id` INT UNSIGNED NOT NULL,
  `image_path` VARCHAR(255) NOT NULL,
  `alt_text` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  FOREIGN KEY (`project_id`) REFERENCES `projects`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- messages (contact form submissions)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `messages` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `subject` VARCHAR(200) DEFAULT NULL,
  `message` TEXT NOT NULL,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `is_read` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- settings (site-wide key/value, socials, availability toggle)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `settings` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `setting_key` VARCHAR(100) NOT NULL UNIQUE,
  `setting_value` TEXT DEFAULT NULL
) ENGINE=InnoDB;

-- ============================================================
-- SEED DATA — verified information only, no fabricated content
-- ============================================================

INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES
('site_name', 'Ade Dian Sukmana'),
('site_title', 'Ade Dian Sukmana — Web Developer & UI Designer'),
('site_description', 'Ade Dian Sukmana is a Web Developer & UI Designer based in Surabaya, Indonesia, focused on web development, UI/UX design, and IT systems.'),
('email', 'adesukmana000@gmail.com'),
('linkedin', 'https://id.linkedin.com/in/ade-dian-sukmana'),
('github', 'https://github.com/adedian'),
('location', 'Surabaya, Indonesia'),
('availability', 'Available for opportunities & collaborations')
ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value);

INSERT INTO `experiences` (`type`, `role`, `organization`, `location`, `period_start`, `period_end`, `year_marker`, `summary`, `tags`, `sort_order`) VALUES
('education', 'S1 Informatika / Computer Science', 'Telkom University Surabaya', 'Surabaya', '2021', '2025', '2021', 'Bachelor of Computer Science, focused on software engineering, web systems and human-computer interaction.', 'Informatics,Computer Science', 10),
('organization', 'Department of External Affairs', 'Himpunan Mahasiswa Informatika — Telkom University', 'Surabaya', 'September 2022', 'September 2023', '2022', 'Active member handling external relations and coordination for the Informatics student association.', 'Organization,External Affairs', 20),
('work', 'UI/UX Designer', 'Metropolis Apartment', 'Surabaya', 'July 2024', 'August 2024', '2024', 'Worked on UI/UX design using Figma, including internal application design within a technical, engineering-facing environment.', 'UI/UX,Figma,Internal Tools', 30),
('education', 'Graduation', 'Telkom University Surabaya', 'Surabaya', '2025', '2025', '2025', 'Completed Bachelor degree in Informatics / Computer Science.', 'Graduation', 40),
('work', 'IT Staff & Web Developer', 'PT Hexa Multi Energi', 'Surabaya', 'January 2026', 'Present', '2026', 'Handling web development and maintenance, WordPress and PHP-based sites, UI design, website security (SSL, backups), server management (cPanel/hPanel), IT system monitoring and technical troubleshooting.', 'Web Development,WordPress,PHP,UI Design,Website Security,cPanel,hPanel,IT Monitoring', 50);

INSERT INTO `skills` (`category`, `name`, `note`, `level`, `sort_order`) VALUES
('Development', 'PHP', 'Server-side logic and native application structure', 88, 1),
('Development', 'HTML', 'Semantic markup', 92, 2),
('Development', 'CSS', 'Custom, systematic styling', 88, 3),
('Development', 'JavaScript', 'Interaction and client-side behavior', 80, 4),
('Development', 'MySQL', 'Relational data modeling', 78, 5),
('Development', 'WordPress', 'CMS-based site development', 82, 6),
('UI / UX', 'Figma', 'Interface design and design systems', 85, 1),
('UI / UX', 'Wireframing', 'Low-fidelity structure planning', 80, 2),
('UI / UX', 'High-Fidelity Design', 'Polished visual interfaces', 82, 3),
('UI / UX', 'Prototyping', 'Interactive flow validation', 78, 4),
('UI / UX', 'Responsive Design', 'Cross-device layout adaptation', 85, 5),
('Systems', 'Database Design', 'Structuring relational schemas', 78, 1),
('Systems', 'CRUD', 'Data operations logic', 82, 2),
('Systems', 'Role-Based Access', 'Permission-driven system access', 75, 3),
('Systems', 'Authentication', 'Secure session & login handling', 75, 4),
('Systems', 'Inventory Systems', 'Stock & goods-flow logic', 80, 5),
('Systems', 'Reporting Systems', 'Structured data output', 78, 6),
('Tools', 'Git', 'Version control', 80, 1),
('Tools', 'GitHub', 'Code hosting & collaboration', 78, 2),
('Tools', 'cPanel', 'Hosting management', 82, 3),
('Tools', 'hPanel', 'Hosting management', 80, 4),
('Tools', 'VS Code', 'Primary editor', 90, 5),
('Tools', 'XAMPP', 'Local development environment', 88, 6);

INSERT INTO `projects`
(`slug`, `number`, `title`, `category`, `filter_group`, `year`, `role`, `description`, `overview`, `problem`, `approach`, `solution`, `result`, `technologies`, `features`, `thumbnail`, `is_academic`, `featured`, `sort_order`) VALUES
(
  'megah-restu-bumi', '01', 'PT Megah Restu Bumi', 'Corporate Website', 'WEB', '2025', 'Web Developer',
  'Corporate website developed to strengthen the digital presence of PT Megah Restu Bumi, a company operating in stretch film and plastic wrapping products.',
  'A corporate website built to present the company profile, product range and contact information in a clean, industrial-premium visual language suited to a manufacturing business.',
  'The company needed a professional web presence that could present its products and company profile clearly to business clients, without relying on printed material or third-party marketplace listings.',
  'Structured the site around company profile, product presentation and contact flow, with an emphasis on clarity and a professional, industrial tone consistent with the business.',
  'Built a responsive corporate website covering company profile, product information, and a contact system, with a content structure that is straightforward to maintain going forward.',
  'A professional web presence that better represents the company to business clients and centralizes product and contact information in one place.',
  'PHP,HTML,CSS,JavaScript,MySQL,WordPress',
  'Company profile page\nProduct presentation\nResponsive layout across devices\nContact system\nSEO-oriented page structure',
  NULL, 0, 1, 10
),
(
  'stok-proyek', '02', 'Dashboard Kontrol Stok Proyek', 'Enterprise Internal System — Inventory / Finance', 'SYSTEM', '2026', 'Web Developer',
  'An internal, web-based management system built for PT Hexa Multi Energi to help structure project, inventory and finance-related data across the organization.',
  'A role-based internal system covering project management, purchase orders, incoming/outgoing goods, stock, invoicing and cash flow, built to bring structure to previously ad-hoc administrative processes.',
  'The process of managing project-related data needed a more structured system than what was in place.',
  'Designed a project-based data model with role-based access control, so each user only interacts with the data relevant to their responsibilities.',
  'Built a web-based internal management system with role-based access control and project-based data access, covering inventory, purchasing, cash and reporting workflows end to end.',
  'The system helped make administrative, inventory, cash management, reporting and monitoring processes more structured across the organization.',
  'PHP Native,MySQL,PDO,HTML,CSS,JavaScript,Bootstrap 5,AJAX',
  'Dashboard overview\nProject management\nPurchase Order\nGoods Receipt (incoming goods)\nStock Out (outgoing goods)\nStock Opname\nInvoice\nKas & Bank\nReporting\nMaster data (Barang, Supplier)\nRole-based access control\nAudit / activity tracking',
  NULL, 0, 1, 20
),
(
  'helmet-detection', '03', 'Real-Time Hat & Helmet Detection for ATM CCTV', 'Academic Project — Deep Learning / Computer Vision', 'AI', '2025', 'Researcher / Developer',
  'Final-year thesis project applying real-time object detection to identify hat and helmet usage at ATM locations, to assist security personnel in CCTV monitoring.',
  'A computer vision system focused purely on object detection — identifying whether a hat or helmet is present in the camera frame — to support, not replace, human security monitoring at ATM areas.',
  'ATM security monitoring can benefit from automated visual cues that flag hat or helmet usage in real time, without relying solely on manual observation of CCTV feeds.',
  'Trained and evaluated a YOLOv5-based object detection model on hat/helmet imagery, then integrated it into a real-time video inference pipeline using OpenCV.',
  'Implemented a real-time detection pipeline that flags hat/helmet presence in the camera frame to assist security staff monitoring ATM CCTV feeds.',
  'A working real-time object detection prototype for ATM security monitoring assistance. The system performs object detection only — it does not perform face recognition, and it does not automatically block or penalize users.',
  'Python,YOLOv5,Deep Learning,Computer Vision,OpenCV',
  'Real-time video inference\nHat / helmet object detection\nCCTV monitoring assistance\nDetection-only scope (no face recognition, no automated enforcement)',
  NULL, 1, 1, 30
);
