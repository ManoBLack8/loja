-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/03/2021 às 02:21
-- Versão do servidor: 10.4.14-MariaDB
-- Versão do PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loja`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `andress`
--

CREATE TABLE `andress` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `rua` varchar(300) NOT NULL,
  `bairro` varchar(300) NOT NULL,
  `cidade` varchar(300) NOT NULL,
  `estado` varchar(300) NOT NULL,
  `lote` varchar(300) NOT NULL,
  `complemento` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `andress`
--

INSERT INTO `andress` (`id`, `id_usuario`, `cep`, `rua`, `bairro`, `cidade`, `estado`, `lote`, `complemento`) VALUES
(1, 1, '78090000', 'Avenida Fernando Correa da Costa', 'Jardim Presidente', 'Cuiabá', 'MT', 'casa 9', 'Condomínio coxipones');

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `dataa` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `id_usuario`, `id_produto`, `id_venda`, `dataa`) VALUES
(23, 2, 27, 0, '2020-12-30 00:00:00'),
(24, 2, 28, 0, '2020-12-30 00:00:00'),
(26, 2, 29, 0, '2020-12-30 00:00:00'),
(32, 1, 27, 0, '2021-01-03 00:00:00'),
(33, 1, 6, 0, '2021-01-03 00:00:00'),
(34, 1, 28, 0, '2021-01-04 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Blusas'),
(2, 'Camisas'),
(3, 'Camisetas'),
(4, 'Calças'),
(5, 'Saias'),
(6, 'Shorts'),
(7, 'Calçados'),
(8, 'Bolsas e acessórios'),
(9, 'Conjuntos'),
(10, 'Kimonos e coletes'),
(11, 'Macacões'),
(12, 'Golinhas'),
(13, 'Langeries'),
(14, 'Croppeds'),
(15, 'Body e maiô');

-- --------------------------------------------------------

--
-- Estrutura para tabela `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `ativo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `emails`
--

INSERT INTO `emails` (`id`, `nome`, `email`, `ativo`) VALUES
(1, 'Vinicius José Ferreira da silva', 'viniciusfe66@gmail.com', 'sim'),
(2, 'vdfvsdsvd', 'viniciusjs98@gmail.com', 'sim'),
(3, 'julina', 'julina.baranhuk@gmail.com', 'sim'),
(4, 'Suzi Daniele da Silva', 'viniciusf@gmail.com', 'sim'),
(13, 'ujujujjujuj', 'black555@gmail.com', 'sim'),
(14, 'ssass', 'saas@gmail.com', 'sim'),
(15, ' c  ', '  ', 'sim'),
(16, ' ', '@', 'sim');

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagens`
--

CREATE TABLE `imagens` (
  `id` int(11) NOT NULL,
  `id_produto` int(50) NOT NULL,
  `imagens` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `imagens`
--

INSERT INTO `imagens` (`id`, `id_produto`, `imagens`) VALUES
(1, 11, 'k2.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `nome_url` varchar(100) NOT NULL,
  `imagem` varchar(150) NOT NULL,
  `tamanho` varchar(50) NOT NULL,
  `tamanho_veste` varchar(200) DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `descricao` varchar(10000) NOT NULL,
  `idcategoria` int(50) NOT NULL,
  `statu` varchar(50) NOT NULL,
  `tags` varchar(200) NOT NULL,
  `peso` double(8,2) NOT NULL,
  `largura` double(8,2) NOT NULL,
  `altura` double(8,2) NOT NULL,
  `comprimento` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `nome_url`, `imagem`, `tamanho`, `tamanho_veste`, `valor`, `descricao`, `idcategoria`, `statu`, `tags`, `peso`, `largura`, `altura`, `comprimento`) VALUES
(30, 'Macacão de teste', 'macacao-de-teste', 'macacao.jpg', 'GG', 'M, G, GG, XGc', '20.00', 'ewscazXwASXZ', 11, '', 'macacao, Jeans, plus, jardineira', 0.00, 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `nivel` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `nome`, `email`, `senha`, `nivel`) VALUES
(1, NULL, 'Vinicius José Ferreira da silva', 'viniciusfe66@gmail.com', '202cb962ac59075b964b07152d234b70', 'adimin'),
(2, NULL, 'Vinicius José Ferreira da silva', 'viniciusjs98@gmail.com', '202cb962ac59075b964b07152d234b70', 'Cliente'),
(3, NULL, 'Vinicius José Ferreira da silva', 'viniciusfe66@gmail.co', '202cb962ac59075b964b07152d234b70', 'Cliente'),
(5, NULL, 'mano black', 'manoblack@gmail.com', 'ff4e811d5b50cc6d649e022d0c1fe244', 'Cliente'),
(7, NULL, 'Juliana de Souza', 'juliana.baranhuk@gmail.com', 'ea859c18ff5e069714195d2fc46260e3', 'adimin'),
(8, NULL, 'Vinicius José Ferreira da silva', 'vinici6@gmail.com', '202cb962ac59075b964b07152d234b70', 'Cliente'),
(9, NULL, 'Suzi Daniele da Silva', 'bibi@gmail.com', '202cb962ac59075b964b07152d234b70', 'Cliente');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `andress`
--
ALTER TABLE `andress`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `imagens`
--
ALTER TABLE `imagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `andress`
--
ALTER TABLE `andress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `imagens`
--
ALTER TABLE `imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
