-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12-Nov-2017 às 17:56
-- Versão do servidor: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gerenciador_financeiro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_tb`
--

CREATE TABLE `categoria_tb` (
  `id_categoria` int(6) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `categoria` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria_tb`
--

INSERT INTO `categoria_tb` (`id_categoria`, `nome`, `categoria`) VALUES
(5, 'Mercado', 'D'),
(6, 'Salario Pai', 'R'),
(8, 'Lazer', 'D'),
(9, 'Aluguel', 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lancamento_tb`
--

CREATE TABLE `lancamento_tb` (
  `id_lancamento` int(6) NOT NULL,
  `data_prevista` date NOT NULL,
  `data_efetivada` date NOT NULL,
  `categoria` int(6) NOT NULL,
  `descricao` varchar(40) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `tipo` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `lancamento_tb`
--

INSERT INTO `lancamento_tb` (`id_lancamento`, `data_prevista`, `data_efetivada`, `categoria`, `descricao`, `valor`, `tipo`) VALUES
(16, '2017-10-01', '0000-00-00', 6, 'salario', '2000.00', 'R'),
(18, '2017-10-10', '0000-00-00', 6, 'a', '1000.00', 'R'),
(22, '2017-10-01', '0000-00-00', 6, 'nada', '10000.00', 'R'),
(31, '2017-10-12', '0000-00-00', 6, 'salario', '4000.00', 'R'),
(33, '2017-10-12', '0000-00-00', 5, 'nada', '500.00', 'D'),
(35, '2017-10-15', '0000-00-00', 5, 'Big - Xaxim', '152.00', 'D'),
(37, '2017-10-30', '0000-00-00', 6, 'SalÃ¡rio', '5000.00', 'R'),
(38, '2017-10-30', '0000-00-00', 9, 'SalÃ¡rio', '4500.00', 'R'),
(39, '2017-10-10', '2017-10-07', 6, 'nada', '5000.00', 'R'),
(40, '2017-10-10', '2017-10-07', 6, 'salario', '3000.00', 'R'),
(42, '2017-10-30', '0000-00-00', 6, 'nada', '100.80', 'R'),
(44, '2017-10-11', '0000-00-00', 6, 'nada', '4000.00', 'R'),
(45, '2017-10-14', '2017-10-10', 8, 'Praia', '500.00', 'D'),
(46, '2017-10-21', '0000-00-00', 6, '', '2000.00', 'R'),
(49, '2017-10-25', '0000-00-00', 9, '', '5000.00', 'D');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `id_usuario` int(6) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`id_usuario`, `nome`, `email`, `senha`) VALUES
(1, 'Guilherme', 'motag928@gmail.com', 'gui123'),
(2, 'JoÃ£o', 'john@gmail.com', '123'),
(3, 'Luiz Felipe', 'camufladin.lf17@gmail.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria_tb`
--
ALTER TABLE `categoria_tb`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `lancamento_tb`
--
ALTER TABLE `lancamento_tb`
  ADD PRIMARY KEY (`id_lancamento`),
  ADD KEY `fk_categoria` (`categoria`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria_tb`
--
ALTER TABLE `categoria_tb`
  MODIFY `id_categoria` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lancamento_tb`
--
ALTER TABLE `lancamento_tb`
  MODIFY `id_lancamento` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_usuario` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `lancamento_tb`
--
ALTER TABLE `lancamento_tb`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`categoria`) REFERENCES `categoria_tb` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
