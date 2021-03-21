-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Tempo de geração: 21-Mar-2021 às 20:39
-- Versão do servidor: 8.0.18
-- versão do PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbsistema`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `rl_empresa_fornecedor`
--

CREATE DATABASE dbsistema;
USE dbsistema;

DROP TABLE IF EXISTS `rl_empresa_fornecedor`;
CREATE TABLE IF NOT EXISTS `rl_empresa_fornecedor` (
  `co_empresa_fornecedor` int(6) NOT NULL AUTO_INCREMENT,
  `co_empresa` int(6) NOT NULL,
  `co_fornecedor` int(6) NOT NULL,
  PRIMARY KEY (`co_empresa_fornecedor`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_empresa`
--

DROP TABLE IF EXISTS `tb_empresa`;
CREATE TABLE IF NOT EXISTS `tb_empresa` (
  `co_empresa` int(6) NOT NULL AUTO_INCREMENT,
  `sg_uf` varchar(2) NOT NULL,
  `no_fantasia` varchar(100) NOT NULL,
  `nu_cnpj` varchar(14) NOT NULL,
  PRIMARY KEY (`co_empresa`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fornecedor`
--

DROP TABLE IF EXISTS `tb_fornecedor`;
CREATE TABLE IF NOT EXISTS `tb_fornecedor` (
  `co_fornecedor` int(6) NOT NULL AUTO_INCREMENT,
  `no_fornecedor` varchar(100) NOT NULL,
  `nu_cpf_cnpj` varchar(14) NOT NULL,
  `nu_im` varchar(20) NOT NULL,
  `nu_ie` varchar(20) NOT NULL,
  `nu_rg` varchar(20) NOT NULL,
  `dt_nascimento` date NOT NULL,
  `dt_cadastro` date NOT NULL,
  PRIMARY KEY (`co_fornecedor`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_telefone_fornecedor`
--

DROP TABLE IF EXISTS `tb_telefone_fornecedor`;
CREATE TABLE IF NOT EXISTS `tb_telefone_fornecedor` (
  `co_telefone` int(6) NOT NULL AUTO_INCREMENT,
  `co_fornecedor` int(6) NOT NULL,
  `nu_telefone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`co_telefone`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=admin',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'Administrator', 'admin', 'admin123', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
