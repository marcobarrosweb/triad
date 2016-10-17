-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: robb0222.publiccloud.com.br
-- Tempo de geração: 16/10/2016 às 23:19
-- Versão do servidor: 5.1.73-rel14.11-log
-- Versão do PHP: 5.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `imagimweb_triad`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `reserva`
--

CREATE TABLE IF NOT EXISTS `reserva` (
  `reserva_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_sala_id` int(11) NOT NULL,
  `fk_usuario_id` int(11) NOT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `data_fim` datetime DEFAULT NULL,
  PRIMARY KEY (`reserva_id`,`fk_sala_id`,`fk_usuario_id`),
  KEY `fk_sala_has_usuario_usuario1_idx` (`fk_usuario_id`),
  KEY `fk_sala_has_usuario_sala_idx` (`fk_sala_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Fazendo dump de dados para tabela `reserva`
--

INSERT INTO `reserva` (`reserva_id`, `fk_sala_id`, `fk_usuario_id`, `data_inicio`, `data_fim`) VALUES
(1, 1, 1, '2016-10-18 09:00:00', '2016-10-18 10:00:00'),
(2, 1, 1, '2016-10-18 11:00:00', '2016-10-18 12:00:00'),
(3, 1, 1, '2016-10-19 09:00:00', '2016-10-19 09:45:00'),
(4, 3, 1, '2016-10-18 10:45:00', '2016-10-19 10:50:00'),
(5, 2, 1, '2016-10-18 11:45:00', '2016-10-19 10:50:00'),
(6, 2, 4, '2016-10-19 19:45:00', '2016-10-19 20:30:00'),
(7, 3, 4, '2016-10-18 07:00:00', '2016-10-18 07:30:00'),
(8, 1, 4, '2016-10-18 07:00:00', '2016-10-18 07:30:00'),
(9, 2, 4, '2016-10-19 18:00:00', '2016-10-19 19:00:00'),
(14, 2, 4, '2016-10-16 12:00:00', '2016-10-16 13:05:00'),
(15, 2, 1, '2016-10-16 01:05:00', '2016-10-16 05:25:00'),
(16, 3, 32, '2016-10-16 04:00:00', '2016-10-16 05:00:00'),
(17, 1, 33, '2016-10-18 01:05:00', '2016-10-18 03:15:00'),
(18, 2, 33, '2016-10-21 02:12:00', '2016-10-21 04:20:00'),
(19, 2, 1, '2016-10-23 01:05:00', '2016-10-23 02:10:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sala`
--

CREATE TABLE IF NOT EXISTS `sala` (
  `sala_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` text,
  PRIMARY KEY (`sala_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Fazendo dump de dados para tabela `sala`
--

INSERT INTO `sala` (`sala_id`, `nome`, `descricao`) VALUES
(1, 'SALA 2 CORREDOR', 'Sala para desenvolvedores'),
(2, 'SALA DE REUNIÃO', 'Corredor da escada'),
(3, 'SALA DE PESQUISA', 'Corredor 3');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  `perfil` char(1) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `nome`, `email`, `senha`, `perfil`) VALUES
(1, 'Marco Barroso', 'marcobneves@gmail.com', 'f5888d0bb58d611107e11f7cbc41c97a', '2'),
(4, 'Talita Sarmento Queiro', 'talita@gmail.com', '73e0f334632193a2eb6d86ebaa7f2ab6', '1'),
(5, 'Marcelo Neves', 'marcelo@gmail.com', '995bf053c4694e1e353cfd42b94e4447', '1'),
(30, 'Venancio Neves Filho', 'venancio@gmail.com', '73a031e1204580f63443402ec6b668d2', '1'),
(31, 'Ana Telma Barroso Neves', 'telma@gmail.com', 'c58deab8ff74f5a40321e8e6b2b1e5e5', '1'),
(32, 'Anne do Esperito Santos', 'anne@gmail.com', 'e3fb62ebfa4f36acf5cbff6a6ed0f2e0', '1'),
(33, 'Joana Trindade', 'joana@gmail.com', '18f01959ff46071d73905d549cafde20', '1'),
(34, 'Triad System', 'triad@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1'),
(35, 'Administrador Sistema', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2');

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_sala_id` FOREIGN KEY (`fk_sala_id`) REFERENCES `sala` (`sala_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_id` FOREIGN KEY (`fk_usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
