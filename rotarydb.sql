-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 03-Nov-2016 às 17:27
-- Versão do servidor: 5.7.12
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rotarydb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_icon_path` varchar(60) DEFAULT 'logo.png',
  `category_description` text,
  `category_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_icon_path`, `category_description`, `category_created_at`, `category_updated_at`) VALUES
(36, 'Teste', 'logo.png', '', '2016-11-03 15:19:47', '0000-00-00 00:00:00');

--
-- Acionadores `categories`
--
DELIMITER $$
CREATE TRIGGER `categories_BEFORE_UPDATE` BEFORE UPDATE ON `categories` FOR EACH ROW BEGIN
	SET NEW.category_updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens`
--

CREATE TABLE `itens` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_title` varchar(75) DEFAULT NULL,
  `item_description` text,
  `item_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `item_updated_at` datetime NOT NULL,
  `item_image_path` varchar(100) DEFAULT NULL,
  `item_quote` varchar(50) DEFAULT NULL,
  `item_abstract` varchar(50) DEFAULT NULL,
  `item_category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Acionadores `itens`
--
DELIMITER $$
CREATE TRIGGER `itens_BEFORE_UPDATE` BEFORE UPDATE ON `itens` FOR EACH ROW BEGIN
	SET NEW.item_updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `fk_itens_categories_idx` (`item_category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `itens`
--
ALTER TABLE `itens`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `itens`
--
ALTER TABLE `itens`
  ADD CONSTRAINT `fk_itens_categories` FOREIGN KEY (`item_category`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
