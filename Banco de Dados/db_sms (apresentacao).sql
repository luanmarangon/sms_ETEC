-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 21-Jun-2015 às 22:43
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_sms`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_controlesms`
--

CREATE TABLE IF NOT EXISTS `tab_controlesms` (
  `cod_controleSMS` int(11) NOT NULL AUTO_INCREMENT,
  `controleSMS` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod_controleSMS`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tab_controlesms`
--

INSERT INTO `tab_controlesms` (`cod_controleSMS`, `controleSMS`) VALUES
(1, 127);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_curso`
--

CREATE TABLE IF NOT EXISTS `tab_curso` (
  `cod_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nome_curso` varchar(45) NOT NULL,
  PRIMARY KEY (`cod_curso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `tab_curso`
--

INSERT INTO `tab_curso` (`cod_curso`, `nome_curso`) VALUES
(1, 'AdministraÃ§Ã£o'),
(2, 'Contabilidade'),
(3, 'InformÃ¡tica para Internet'),
(4, 'Marketing'),
(5, 'Redes'),
(6, 'ServiÃ§os JurÃ­dicos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_email`
--

CREATE TABLE IF NOT EXISTS `tab_email` (
  `cod_email` int(11) NOT NULL AUTO_INCREMENT,
  `mensagem_email` varchar(3000) NOT NULL,
  `dt_envio` date NOT NULL,
  `hr_envio` time NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  PRIMARY KEY (`cod_email`,`cod_usuario`),
  KEY `fk_tab_email_tab_usuario1_idx` (`cod_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `tab_email`
--

INSERT INTO `tab_email` (`cod_email`, `mensagem_email`, `dt_envio`, `hr_envio`, `cod_usuario`) VALUES
(1, '', '2015-05-08', '00:43:11', 1),
(2, '', '2015-05-14', '01:10:36', 1),
(3, '', '2015-05-14', '02:57:25', 1),
(4, '', '2015-05-14', '02:58:54', 1),
(5, '', '2015-05-14', '02:59:02', 1),
(6, '', '2015-05-14', '02:59:11', 1),
(7, '', '2015-05-14', '03:00:02', 1),
(8, '', '2015-05-14', '03:00:12', 1),
(9, '', '2015-05-14', '03:01:33', 1),
(10, 'Teste de envio de e-mail', '2015-06-21', '23:07:14', 1),
(11, 'Teste de envio de e-mail - Por favor, me comunique se recebeu essa mensagem.\r\n\r\nAss.: Karina.', '2015-06-21', '21:33:36', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_log`
--

CREATE TABLE IF NOT EXISTS `tab_log` (
  `cod_log` int(11) NOT NULL AUTO_INCREMENT,
  `dt_log` date NOT NULL,
  `hr_log` time NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  PRIMARY KEY (`cod_log`),
  KEY `fk_tab_log_tab_usuario1_idx` (`cod_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Extraindo dados da tabela `tab_log`
--

INSERT INTO `tab_log` (`cod_log`, `dt_log`, `hr_log`, `cod_usuario`) VALUES
(1, '2015-04-30', '21:11:29', 1),
(2, '2015-05-01', '23:10:25', 1),
(3, '2015-05-02', '04:42:50', 1),
(4, '2015-05-05', '00:04:01', 1),
(5, '2015-05-05', '00:48:47', 1),
(6, '2015-05-07', '01:38:13', 1),
(7, '2015-05-12', '01:37:44', 1),
(8, '2015-05-14', '00:16:25', 1),
(9, '2015-05-14', '00:40:14', 1),
(10, '2015-05-25', '03:22:07', 1),
(11, '2015-05-26', '01:07:10', 1),
(12, '2015-05-26', '01:08:50', 4),
(13, '2015-06-01', '03:02:43', 1),
(14, '2015-06-03', '21:51:44', 1),
(15, '2015-06-03', '22:14:32', 1),
(16, '2015-06-05', '02:16:26', 1),
(17, '2015-06-05', '02:41:47', 1),
(18, '2015-06-08', '02:27:05', 1),
(19, '2015-06-08', '02:29:49', 1),
(20, '2015-06-08', '02:35:25', 1),
(21, '2015-06-08', '02:37:49', 1),
(22, '2015-06-20', '00:45:16', 1),
(23, '2015-06-20', '19:40:22', 1),
(24, '2015-06-20', '19:47:38', 1),
(25, '2015-06-21', '23:06:29', 1),
(26, '2015-06-22', '01:17:53', 1),
(27, '2015-06-22', '01:28:33', 3),
(28, '2015-06-22', '01:36:10', 3),
(29, '2015-06-21', '20:40:53', 3),
(30, '2015-06-21', '20:41:25', 3),
(31, '2015-06-21', '20:41:54', 3),
(32, '2015-06-21', '20:44:51', 1),
(33, '2015-06-21', '22:31:46', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_modulo`
--

CREATE TABLE IF NOT EXISTS `tab_modulo` (
  `cod_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `modulo` varchar(30) NOT NULL,
  PRIMARY KEY (`cod_modulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tab_modulo`
--

INSERT INTO `tab_modulo` (`cod_modulo`, `modulo`) VALUES
(1, '1Âº MÃ³dulo'),
(2, '2Âº MÃ³dulo'),
(3, '3Âº MÃ³dulo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_pessoas`
--

CREATE TABLE IF NOT EXISTS `tab_pessoas` (
  `cod_pessoas` int(11) NOT NULL AUTO_INCREMENT,
  `nome_pessoas` varchar(60) NOT NULL,
  `cel_pessoas` varchar(15) NOT NULL,
  `dt_nasc` date NOT NULL,
  `cpf_pessoas` varchar(14) NOT NULL,
  `email_pessoas` varchar(60) DEFAULT NULL,
  `aceita_email` int(11) NOT NULL,
  `aceita_sms` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`cod_pessoas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `tab_pessoas`
--

INSERT INTO `tab_pessoas` (`cod_pessoas`, `nome_pessoas`, `cel_pessoas`, `dt_nasc`, `cpf_pessoas`, `email_pessoas`, `aceita_email`, `aceita_sms`, `status`) VALUES
(1, 'Karina Ferreira', '(18) 98821-1721', '1990-05-04', '361.813.948-93', 'kahpedrosaferreira@gmail.com', 1, 1, 1),
(2, 'LaÃ­s Alves Beloni', '(18) 99791-4422', '1988-11-28', '456.234.984-00', 'lais.beloni@gmail.com', 1, 1, 1),
(3, 'Luan Marangon de Lima', '(18) 99748-2397', '1990-08-21', '743.131.757-33', 'luande_lm@yahoo.com', 1, 1, 1),
(4, 'Camila Silva Lima', '(18) 98815-8969', '1989-09-08', '544.166.808-30', 'camila.slima@live.com', 1, 1, 1),
(5, 'marco antonio de paula santos', '(18) 99635-1156', '2002-04-13', '157.236.841-16', 'm.antoniops@gmail.com', 1, 1, 1),
(6, 'Camilla Valente Peres', '(21) 98851-6392', '1993-07-17', '712.178.981-74', 'peres.milla@gmail.com', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_pessoas_turma`
--

CREATE TABLE IF NOT EXISTS `tab_pessoas_turma` (
  `cod_tab_pessoas_turma` int(11) NOT NULL AUTO_INCREMENT,
  `cod_pessoas` int(11) NOT NULL,
  `cod_turma` int(11) NOT NULL,
  `status_pessoa_turma` int(11) NOT NULL,
  PRIMARY KEY (`cod_tab_pessoas_turma`,`cod_pessoas`,`cod_turma`),
  KEY `fk_tab_pessoas_has_turma_turma1_idx` (`cod_turma`),
  KEY `fk_tab_pessoas_has_turma_tab_pessoas1_idx` (`cod_pessoas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `tab_pessoas_turma`
--

INSERT INTO `tab_pessoas_turma` (`cod_tab_pessoas_turma`, `cod_pessoas`, `cod_turma`, `status_pessoa_turma`) VALUES
(1, 1, 9, 1),
(2, 2, 9, 1),
(3, 3, 9, 1),
(4, 4, 6, 1),
(5, 5, 10, 1),
(6, 6, 6, 1),
(7, 6, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_pessoas_turma_email`
--

CREATE TABLE IF NOT EXISTS `tab_pessoas_turma_email` (
  `cod_tab_pessoas_turma_email` int(11) NOT NULL AUTO_INCREMENT,
  `cod_tab_pessoas_turma` int(11) NOT NULL,
  `cod_email` int(11) NOT NULL,
  PRIMARY KEY (`cod_tab_pessoas_turma_email`,`cod_tab_pessoas_turma`,`cod_email`),
  KEY `fk_tab_pessoas_turma_has_tab_email_tab_email1_idx` (`cod_email`),
  KEY `fk_tab_pessoas_turma_has_tab_email_tab_pessoas_turma1_idx` (`cod_tab_pessoas_turma`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `tab_pessoas_turma_email`
--

INSERT INTO `tab_pessoas_turma_email` (`cod_tab_pessoas_turma_email`, `cod_tab_pessoas_turma`, `cod_email`) VALUES
(1, 1, 10),
(2, 2, 10),
(3, 3, 10),
(4, 4, 10),
(5, 7, 11),
(6, 4, 11),
(7, 6, 11),
(8, 1, 11),
(9, 2, 11),
(10, 3, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_sms`
--

CREATE TABLE IF NOT EXISTS `tab_sms` (
  `cod_sms` int(11) NOT NULL AUTO_INCREMENT,
  `mensagem_sms` varchar(140) NOT NULL,
  `dt_sms` date NOT NULL,
  `hr_sms` time NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  PRIMARY KEY (`cod_sms`,`cod_usuario`),
  KEY `fk_tab_sms_tab_usuario1_idx` (`cod_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `tab_sms`
--

INSERT INTO `tab_sms` (`cod_sms`, `mensagem_sms`, `dt_sms`, `hr_sms`, `cod_usuario`) VALUES
(1, 'Oi, como vai vocÃª? (1)', '2015-04-30', '04:33:07', 1),
(2, 'Oi, como vai vocÃª? (2)', '2015-04-30', '04:33:35', 1),
(3, 'Teste de envio com cont e UPDATE no banco.', '2015-04-30', '18:31:30', 1),
(4, 'Segundo teste da mesma coisa ', '2015-04-30', '18:34:23', 1),
(5, 'Mais um teste de envio e update', '2015-04-30', '20:16:42', 1),
(6, 'Estou testando as exceÃ§Ãµes de envio. Por favor, me avisa se recebeu esse SMS.', '2015-04-30', '22:32:38', 1),
(7, 'oi', '2015-06-08', '02:40:07', 1),
(8, 'oi', '2015-06-08', '02:40:28', 1),
(9, 'oi', '2015-06-08', '02:40:36', 1),
(10, 'Teste da VersÃ£o Final - 14:44 - Sem GRID - Turmas Contabilidade e Inf. Internet', '2015-06-20', '19:45:35', 1),
(11, 'Teste v.GRID - COM GRID - Turmas Contabilidade e Inf. Internet - 14:48', '2015-06-20', '19:49:03', 1),
(12, 'Novo Teste Grid - HORA DA VERDADE - 14:49', '2015-06-20', '19:50:17', 1),
(13, 'Teste de Envio de SMS - 21/06 Ã s 20:50\r\nPor favor, me avise se recebeu essa mensagem.\r\nAss.: Karina.', '2015-06-21', '20:50:34', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_sms_pessoas_turma`
--

CREATE TABLE IF NOT EXISTS `tab_sms_pessoas_turma` (
  `cod_tab_sms_pessoas_turma` int(11) NOT NULL AUTO_INCREMENT,
  `cod_sms` int(11) NOT NULL,
  `tab_pessoas_turma` int(11) NOT NULL,
  PRIMARY KEY (`cod_tab_sms_pessoas_turma`,`cod_sms`,`tab_pessoas_turma`),
  KEY `fk_tab_sms_has_tab_pessoas_turma_tab_pessoas_turma1_idx` (`tab_pessoas_turma`),
  KEY `fk_tab_sms_has_tab_pessoas_turma_tab_sms1_idx` (`cod_sms`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Extraindo dados da tabela `tab_sms_pessoas_turma`
--

INSERT INTO `tab_sms_pessoas_turma` (`cod_tab_sms_pessoas_turma`, `cod_sms`, `tab_pessoas_turma`) VALUES
(1, 1, 1),
(4, 2, 1),
(7, 3, 1),
(10, 4, 1),
(13, 5, 1),
(19, 8, 1),
(22, 9, 1),
(25, 10, 1),
(29, 11, 1),
(32, 13, 1),
(2, 1, 2),
(5, 2, 2),
(8, 3, 2),
(11, 4, 2),
(14, 5, 2),
(16, 6, 2),
(20, 8, 2),
(23, 9, 2),
(26, 10, 2),
(30, 11, 2),
(33, 13, 2),
(3, 1, 3),
(6, 2, 3),
(9, 3, 3),
(12, 4, 3),
(15, 5, 3),
(17, 6, 3),
(21, 8, 3),
(24, 9, 3),
(27, 10, 3),
(31, 11, 3),
(34, 13, 3),
(18, 6, 4),
(28, 10, 4),
(35, 13, 4),
(36, 13, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_usuario`
--

CREATE TABLE IF NOT EXISTS `tab_usuario` (
  `cod_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(45) NOT NULL,
  `tel_usuario` varchar(15) NOT NULL,
  `email_usuario` varchar(45) NOT NULL,
  `senha_usuario` varchar(200) NOT NULL,
  `nivel_usuario` int(11) NOT NULL,
  PRIMARY KEY (`cod_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `tab_usuario`
--

INSERT INTO `tab_usuario` (`cod_usuario`, `nome_usuario`, `tel_usuario`, `email_usuario`, `senha_usuario`, `nivel_usuario`) VALUES
(1, 'Karina Ferreira', '(18) 98821-1721', 'karina_pedrosa@hotmail.com', 'c33367701511b4f6020ec61ded352059', 1),
(2, 'Lais Alves Beloni', '(18) 99791-4422', 'lais.beloni@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(3, 'Luan Marangon de Lima', '(18) 99748-2397', 'luande_lm@yahoo.com', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(4, 'Administrador NÃ­vel 2', '18998211721', 'adm2@adm.com', '81dc9bdb52d04dc20036dbd8313ed055', 2),
(5, 'UsuÃ¡rio Teste ', '(18) 99888-9899', 'admteste@teste.com', '827ccb0eea8a706c4c34a16891f84e7b', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE IF NOT EXISTS `turma` (
  `cod_turma` int(11) NOT NULL AUTO_INCREMENT,
  `cod_curso` int(11) NOT NULL,
  `cod_modulo` int(11) NOT NULL,
  PRIMARY KEY (`cod_turma`,`cod_curso`,`cod_modulo`),
  KEY `fk_tab_curso_has_tab_modulo_tab_modulo1_idx` (`cod_modulo`),
  KEY `fk_tab_curso_has_tab_modulo_tab_curso1_idx` (`cod_curso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`cod_turma`, `cod_curso`, `cod_modulo`) VALUES
(1, 1, 1),
(4, 2, 1),
(7, 3, 1),
(10, 4, 1),
(13, 5, 1),
(16, 6, 1),
(2, 1, 2),
(5, 2, 2),
(8, 3, 2),
(11, 4, 2),
(14, 5, 2),
(17, 6, 2),
(3, 1, 3),
(6, 2, 3),
(9, 3, 3),
(12, 4, 3),
(15, 5, 3),
(18, 6, 3);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tab_email`
--
ALTER TABLE `tab_email`
  ADD CONSTRAINT `fk_tab_email_tab_usuario1` FOREIGN KEY (`cod_usuario`) REFERENCES `tab_usuario` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tab_log`
--
ALTER TABLE `tab_log`
  ADD CONSTRAINT `fk_tab_log_tab_usuario1` FOREIGN KEY (`cod_usuario`) REFERENCES `tab_usuario` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tab_pessoas_turma`
--
ALTER TABLE `tab_pessoas_turma`
  ADD CONSTRAINT `fk_tab_pessoas_has_turma_tab_pessoas1` FOREIGN KEY (`cod_pessoas`) REFERENCES `tab_pessoas` (`cod_pessoas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tab_pessoas_has_turma_turma1` FOREIGN KEY (`cod_turma`) REFERENCES `turma` (`cod_turma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tab_pessoas_turma_email`
--
ALTER TABLE `tab_pessoas_turma_email`
  ADD CONSTRAINT `fk_tab_pessoas_turma_has_tab_email_tab_email1` FOREIGN KEY (`cod_email`) REFERENCES `tab_email` (`cod_email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tab_pessoas_turma_has_tab_email_tab_pessoas_turma1` FOREIGN KEY (`cod_tab_pessoas_turma`) REFERENCES `tab_pessoas_turma` (`cod_tab_pessoas_turma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tab_sms`
--
ALTER TABLE `tab_sms`
  ADD CONSTRAINT `fk_tab_sms_tab_usuario1` FOREIGN KEY (`cod_usuario`) REFERENCES `tab_usuario` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tab_sms_pessoas_turma`
--
ALTER TABLE `tab_sms_pessoas_turma`
  ADD CONSTRAINT `fk_tab_sms_has_tab_pessoas_turma_tab_pessoas_turma1` FOREIGN KEY (`tab_pessoas_turma`) REFERENCES `tab_pessoas_turma` (`cod_tab_pessoas_turma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tab_sms_has_tab_pessoas_turma_tab_sms1` FOREIGN KEY (`cod_sms`) REFERENCES `tab_sms` (`cod_sms`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `fk_tab_curso_has_tab_modulo_tab_curso1` FOREIGN KEY (`cod_curso`) REFERENCES `tab_curso` (`cod_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tab_curso_has_tab_modulo_tab_modulo1` FOREIGN KEY (`cod_modulo`) REFERENCES `tab_modulo` (`cod_modulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
