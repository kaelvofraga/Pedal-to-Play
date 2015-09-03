-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/09/2015 às 03:52
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
`id_activitylog` int(11) NOT NULL,
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
`id_avatar` int(11) NOT NULL,
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
`id_image` int(11) NOT NULL,
  `id_typeimage` int(11) NOT NULL,
  `color` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ranking`
--

CREATE TABLE IF NOT EXISTS `ranking` (
`id_ranking` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `reward`
--

CREATE TABLE IF NOT EXISTS `reward` (
`id_reward` int(11) NOT NULL,
  `id_image` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `type_image`
--

CREATE TABLE IF NOT EXISTS `type_image` (
`id_typeimage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id_user` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `subscription_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(150) DEFAULT NULL,
  `birthday` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Índices de tabela `activitylog`
--
ALTER TABLE `activitylog`
 ADD PRIMARY KEY (`id_activitylog`), ADD KEY `id_user` (`id_user`);

--
-- Índices de tabela `avatar`
--
ALTER TABLE `avatar`
 ADD PRIMARY KEY (`id_avatar`), ADD KEY `id_user` (`id_user`);

--
-- Índices de tabela `avatar_image`
--
ALTER TABLE `avatar_image`
 ADD KEY `id_image` (`id_image`), ADD KEY `id_avatar` (`id_avatar`);

--
-- Índices de tabela `image`
--
ALTER TABLE `image`
 ADD PRIMARY KEY (`id_image`), ADD KEY `id_typeimage` (`id_typeimage`);

--
-- Índices de tabela `ranking`
--
ALTER TABLE `ranking`
 ADD PRIMARY KEY (`id_ranking`), ADD KEY `id_user` (`id_user`);

--
-- Índices de tabela `reward`
--
ALTER TABLE `reward`
 ADD PRIMARY KEY (`id_reward`), ADD KEY `id_image` (`id_image`);

--
-- Índices de tabela `type_image`
--
ALTER TABLE `type_image`
 ADD PRIMARY KEY (`id_typeimage`);

--
-- AUTO_INCREMENT de tabela `activitylog`
--
ALTER TABLE `activitylog`
MODIFY `id_activitylog` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `avatar`
--
ALTER TABLE `avatar`
MODIFY `id_avatar` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `image`
--
ALTER TABLE `image`
MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `ranking`
--
ALTER TABLE `ranking`
MODIFY `id_ranking` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `reward`
--
ALTER TABLE `reward`
MODIFY `id_reward` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `type_image`
--
ALTER TABLE `type_image`
MODIFY `id_typeimage` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restrições para dumps de tabelas
--

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
