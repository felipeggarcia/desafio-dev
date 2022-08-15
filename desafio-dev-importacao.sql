-- ANTES DE INICIAR ESSE SCRIPT É NECESSÁRIO CRIAR UM SCHEMA CHAMADO "desafio-dev"

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Ago-2022 às 16:33
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `desafio-dev`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_transicao`
--

CREATE TABLE `tipo_transicao` (
  `tipo` int(11) DEFAULT NULL,
  `descricao` varchar(60) DEFAULT NULL,
  `natureza` char(8) DEFAULT NULL,
  `sinal` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipo_transicao`
--

INSERT INTO `tipo_transicao` (`tipo`, `descricao`, `natureza`, `sinal`) VALUES
(1, 'Débito', 'Entrada', '+'),
(2, 'Boleto', 'Saída', '-'),
(3, 'Financiamento', 'Entrada', '+'),
(4, 'Crédito Entrada', 'Entrada', '+'),
(5, 'Recebimento Empréstimo', 'Entrada', '+'),
(6, 'Vendas', 'Entrada', '+'),
(7, 'Recebimento TED', 'Entrada', '+'),
(8, 'Recebimento DOC', 'Entrada', '+'),
(9, 'Aluguel', 'Saída', '-');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transicoes`
--

CREATE TABLE `transicoes` (
  `id` bigint(20) NOT NULL,
  `tipo` int(1) NOT NULL,
  `data` date NOT NULL,
  `valor` bigint(20) NOT NULL,
  `cpf` bigint(20) NOT NULL,
  `cartao` char(12) NOT NULL,
  `hora` time NOT NULL,
  `dono_loja` char(14) NOT NULL,
  `nome_loja` char(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `transicoes`
--
ALTER TABLE `transicoes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `transicoes`
--
ALTER TABLE `transicoes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
