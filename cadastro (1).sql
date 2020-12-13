-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/08/2019 às 02:17
-- Versão do servidor: 5.6.25
-- Versão do PHP: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cadastro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `configuracao`
--

CREATE TABLE IF NOT EXISTS `configuracao` (
  `id` int(5) NOT NULL,
  `linhas_por_pagina` int(5) NOT NULL,
  `coluna_inicial` int(5) NOT NULL,
  `ordem_inicial` varchar(5) NOT NULL,
  `gerador_cpf` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `configuracao`
--

INSERT INTO `configuracao` (`id`, `linhas_por_pagina`, `coluna_inicial`, `ordem_inicial`, `gerador_cpf`) VALUES
(1, 4, 1, 'asc', 'nao');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `image` varchar(20) NOT NULL,
  `cpf` bigint(12) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `image`, `cpf`, `endereco`, `telefone`, `email`) VALUES
(1, 'Maria', 'das GraÃ§as', 'Ua3lklrGbm455325.jpg', 16975417474, 'Recife', '81999239855', 'maria@bol.com'),
(2, 'Marta', 'Abelha', 'NLQRhyVfVV271331.jpg', 83626010198, 'Surubim', '99777788878', 'abelha@bol.com'),
(3, 'Ana', 'Julha', 'ujYkuuWa6W755911.jpg', 1471947335, 'VitÃ³ria', '55767788888', 'ana@gmail.com'),
(4, 'Beatriz', 'Carvalho', 'uJRAQoamJP369329.jpg', 2751148727, 'Caruaru', '78998989898', ''),
(5, 'Carla', 'Silva', 'ocOfgTX1Rq574142.jpg', 95136550163, 'SÃ£o Paulo', '11988776655', 'carla@bol.com'),
(6, 'Claudia', 'Brito', 'h33laBYtTt905462.jpg', 18250899148, 'Rio de Janeiro', '', 'brito@bol.com'),
(7, 'Delma', 'Lima', '0aT5GCqrco512619.jpg', 1189465108, 'JaboatÃ£o', '81977887878', 'delma@bol.com'),
(8, 'Eliana', 'Martins', 'KZGkF1NZVr467355.jpg', 73772464130, 'GoiÃ¡s', '23898978787', 'eli@bol.com'),
(9, 'Fabiana', 'Santos', 'XeOYWwE8Kr332360.jpg', 16919140454, 'Vertentes', '71676768979', 'fab@bol.com'),
(10, 'Geise', 'Arruda', 'isSE8QkpD3497155.jpg', 36391590982, 'Limoeiro', '32434343434', 'gey@google.com'),
(11, 'Helena', 'Santana', 'KHjdtezV5P135293.jpg', 72676615130, 'Palmares', '32899898900', 'helena@bol.com'),
(12, 'Amaral xxx', 'Neto', 'WZ3n7mLLA5728253.jpg', 12142322727, 'Recife', '81988787878', 'neto@hotmail.com'),
(13, 'Daniel', 'Azulai', '0CfmVdUDgR991101.jpg', 70249082110, 'Rio de Janeiro', '12989878979', 'daniel@bol.com'),
(14, 'Jose', 'Carlos', 'Vn2jtm43xs379217.jpg', 22095432231, 'MaceiÃ³', '45333243565', 'carl@bol.com'),
(15, 'Manoel', 'Jacinto', 'mCLBqx3wfk356723.jpg', 89787271070, 'RibeirÃ£o', '81989787879', 'manoel@gmail.com'),
(16, 'Paulo', 'Vilela', 'A05eskS5mE189401.jpg', 75309362126, 'Campinas', '34728463729', 'paulo@bol.com'),
(17, 'Roberto', 'Justo', 'n4gD6XQt8c367187.jpg', 95150452742, 'Olinda', '21283987937', 'justo@bol.com'),
(18, 'Silvano', 'tec', 'ziWSwVKd7n762503.jpg', 97623141236, 'SÃ£o Paulo', '11238373435', 'tec@bol.com'),
(20, 'Aila', 'Torres', '', 58843919350, 'Pombos', '88677565657', 'aila@bol.com'),
(21, 'Margarida ', 'Souza de Lima', '', 1234567890, 'Rua SÃ£o Silvestre 56B Loteamento Hosana', '81987654322', 'marga@bol.com.br'),
(22, 'Andreia', 'Xavier de Brito', 'S1DZu57nJL803454.jpg', 12345678909, 'Vitoria de Santo AntÃ£o PE', '81876543233', 'xavier@bol.com.br');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `configuracao`
--
ALTER TABLE `configuracao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
