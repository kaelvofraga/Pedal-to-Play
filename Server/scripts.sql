-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/09/2015 às 19:32
-- Versão do servidor: 5.6.21
-- Versão do PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `pedal2play`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `activitylog`
--
CREATE TABLE IF NOT EXISTS `activitylog` (
  `id_activitylog` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `calories` float NOT NULL,
  `initial_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `distance` float NOT NULL,
  `final_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `avatar`
--
CREATE TABLE IF NOT EXISTS `avatar` (
  `id_avatar` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_user` int(11) NOT NULL,
  `gender` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `avatar_image`
--
CREATE TABLE IF NOT EXISTS `avatar_image` (
  `id_image` int(11) NOT NULL,
  `id_avatar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `image`
--
CREATE TABLE IF NOT EXISTS `image` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_typeimage` int(11) NOT NULL,
  `color` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ranking`
--
CREATE TABLE IF NOT EXISTS `ranking` (
  `id_ranking` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `score` int(11) NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `reward`
--
CREATE TABLE IF NOT EXISTS `reward` (
  `id_reward` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_image` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `type_image`
--
CREATE TABLE IF NOT EXISTS `type_image` (
 `id_typeimage` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `token` varchar(100) NOT NULL,
  `subscription_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `password` varchar(33) NOT NULL,
  `address` varchar(150) DEFAULT NULL,
  `birthday` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `user_reward`
--

CREATE TABLE IF NOT EXISTS `user_reward` (
  `id_user` int(11) NOT NULL PRIMARY KEY,
  `id_reward` int(11) NOT NULL PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Restrições para tabelas `user_reward`
--
ALTER TABLE `user_reward`
ADD CONSTRAINT `user_reward_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
ADD CONSTRAINT `user_reward_ibfk_2` FOREIGN KEY (`id_reward`) REFERENCES `reward` (`id_reward`);

--
-- Restrições para tabelas `activitylog`
--
ALTER TABLE `activitylog`
ADD CONSTRAINT `activitylog_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Restrições para tabelas `avatar`
--
ALTER TABLE `avatar`
ADD CONSTRAINT `avatar_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Restrições para tabelas `avatar_image`
--
ALTER TABLE `avatar_image`
ADD CONSTRAINT `avatar_image_ibfk_1` FOREIGN KEY (`id_image`) REFERENCES `image` (`id_image`),
ADD CONSTRAINT `avatar_image_ibfk_2` FOREIGN KEY (`id_avatar`) REFERENCES `avatar` (`id_avatar`);

--
-- Restrições para tabelas `image`
--
ALTER TABLE `image`
ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`id_typeimage`) REFERENCES `type_image` (`id_typeimage`);

--
-- Restrições para tabelas `ranking`
--
ALTER TABLE `ranking`
ADD CONSTRAINT `ranking_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Restrições para tabelas `reward`
--
ALTER TABLE `reward`
ADD CONSTRAINT `reward_ibfk_1` FOREIGN KEY (`id_image`) REFERENCES `image` (`id_image`);

-- --------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
