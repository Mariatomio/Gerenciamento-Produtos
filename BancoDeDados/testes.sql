-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13-Jun-2024 às 06:09
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `testes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
`id` int(11) NOT NULL,
  `nomeCat` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nomeCat`, `create_at`) VALUES
(2, 'teste ', '2024-06-12 10:53:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle`
--

CREATE TABLE IF NOT EXISTS `controle` (
`id_controle` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `quantidade` text NOT NULL,
  `preco` text NOT NULL,
  `tipoMovimentacao` varchar(50) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `controle`
--

INSERT INTO `controle` (`id_controle`, `sku`, `quantidade`, `preco`, `tipoMovimentacao`, `create_at`) VALUES
(6, 'S85NKUVF8', '123', 'R$10,00', 'Saída', '2024-06-13 00:18:27'),
(7, 'S85NKUVF8', '123', 'R$10,00', 'Saída', '2024-06-13 00:19:47'),
(8, '23H%U7CTS', '2', 'R$0,22', 'Saída', '2024-06-13 01:01:47'),
(9, 'Z2H2WFCXQ', '44444', 'R$10.000,00', 'Saída', '2024-06-13 01:01:59');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE IF NOT EXISTS `estoque` (
`id` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `quantidade` text NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estoque`
--

INSERT INTO `estoque` (`id`, `sku`, `quantidade`, `create_at`) VALUES
(3, 'S85NKUVF8', '24', '2024-06-12 23:29:30'),
(4, 'Z2H2WFCXQ', '2224', '2024-06-12 17:23:56'),
(5, 'F71WDJKEY', '2234', '2024-06-12 17:24:16'),
(10, '23H%U7CTS', '5', '2024-06-13 00:56:51');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
`id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `categoria` int(11) NOT NULL,
  `descricao` text,
  `preco` varchar(200) NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `filetype` varchar(255) DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `dataVencimento` varchar(20) DEFAULT NULL,
  `dataCadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dataEdicao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sku` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `categoria`, `descricao`, `preco`, `filename`, `filetype`, `filesize`, `path`, `dataVencimento`, `dataCadastro`, `dataEdicao`, `sku`) VALUES
(6, 'Teste1', 2, '', 'R$10,00', NULL, NULL, NULL, NULL, '3232-03-31', '2024-06-13 00:48:29', '2024-06-13 00:48:29', 'S85NKUVF8'),
(7, 'Teste3', 2, 'sem description', 'R$10.000,00', NULL, NULL, NULL, NULL, '9333-03-03', '2024-06-13 00:48:50', '2024-06-13 00:48:50', 'Z2H2WFCXQ'),
(8, 'Teste2', 2, 'sem description 2', 'R$10.001,00', NULL, NULL, NULL, NULL, '2222-03-22', '2024-06-13 00:48:41', '2024-06-13 00:48:41', 'F71WDJKEY'),
(13, 'teste7', 2, '', 'R$0,22', NULL, NULL, NULL, NULL, '', '2024-06-13 00:56:51', '2024-06-13 00:56:51', '23H%U7CTS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `requisicao`
--

CREATE TABLE IF NOT EXISTS `requisicao` (
`id_req` int(11) NOT NULL,
  `sku` varchar(40) NOT NULL,
  `user` varchar(255) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `requisicao`
--

INSERT INTO `requisicao` (`id_req`, `sku`, `user`, `quantidade`, `create_at`) VALUES
(1, 'Z2H2WFCXQ', '111.222.333-11', 44, '2024-06-12 21:19:31'),
(2, 'Z2H2WFCXQ', '111.222.333-11', 5, '2024-06-12 21:19:33'),
(3, 'Z2H2WFCXQ', '111.222.333-11', 44, '2024-06-12 21:19:28'),
(4, 'F71WDJKEY', '111.222.333-11', 44, '2024-06-12 21:19:03'),
(5, 'Z2H2WFCXQ', '111.222.333-11', 1211, '2024-06-12 21:19:12'),
(6, 'F71WDJKEY', '111.222.333-11', 22, '2024-06-13 00:02:21'),
(7, 'F71WDJKEY', '111.222.333-11', 22, '2024-06-13 00:02:44'),
(8, 'S85NKUVF8', '111.222.333-11', 4, '2024-06-13 00:03:07'),
(9, 'F71WDJKEY', '111.222.333-11', 123, '2024-06-13 00:04:27'),
(10, 'F71WDJKEY', '111.222.333-11', 123, '2024-06-13 00:07:46'),
(11, 'F71WDJKEY', '111.222.333-11', 123, '2024-06-13 00:11:44'),
(12, 'S85NKUVF8', '111.222.333-11', 123, '2024-06-13 00:18:27'),
(13, 'S85NKUVF8', '111.222.333-11', 123, '2024-06-13 00:19:47'),
(14, '23H%U7CTS', '114.097.909-40', 2, '2024-06-13 01:01:47'),
(15, 'Z2H2WFCXQ', '114.097.909-40', 44444, '2024-06-13 01:01:59');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`uid` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `profile_pic` varchar(200) DEFAULT NULL,
  `google_auth_code` varchar(16) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`id_user` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(22) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_user`, `nome`, `cpf`, `create_at`) VALUES
(1, 'Maria', '123.123.123-49', '2024-06-11 23:39:32'),
(2, 'Maria', '123.123.123-49', '2024-06-11 23:45:14'),
(3, 'Maria Luíza Tomio', '111.222.333-11', '2024-06-12 20:57:22'),
(4, 'Maria Luíza Tomio', '111.222.333-11', '2024-06-12 23:33:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `controle`
--
ALTER TABLE `controle`
 ADD PRIMARY KEY (`id_controle`);

--
-- Indexes for table `estoque`
--
ALTER TABLE `estoque`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `requisicao`
--
ALTER TABLE `requisicao`
 ADD PRIMARY KEY (`id_req`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `controle`
--
ALTER TABLE `controle`
MODIFY `id_controle` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `estoque`
--
ALTER TABLE `estoque`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `requisicao`
--
ALTER TABLE `requisicao`
MODIFY `id_req` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `estoque`
--
ALTER TABLE `estoque`
ADD CONSTRAINT `sku_sku` FOREIGN KEY (`sku`) REFERENCES `produto` (`sku`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
