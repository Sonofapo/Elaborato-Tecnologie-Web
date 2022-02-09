-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 09, 2022 alle 17:34
-- Versione del server: 10.5.12-MariaDB-0+deb11u1
-- Versione PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unibonsai`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pan` char(16) NOT NULL,
  `cvv` char(3) NOT NULL,
  `date` date NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `cards`
--

INSERT INTO `cards` (`id`, `name`, `pan`, `cvv`, `date`, `userId`) VALUES
(1, 'utente', '4325695423698547', '954', '2025-07-18', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL,
  `isRead` tinyint(1) NOT NULL DEFAULT 0,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `orderProducts`
--

CREATE TABLE `orderProducts` (
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `orderProducts`
--

INSERT INTO `orderProducts` (`orderId`, `productId`, `quantity`) VALUES
(1, 6, 3),
(1, 18, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `orders`
--

INSERT INTO `orders` (`id`, `date`, `userId`) VALUES
(1, '2022-02-06 09:15:46', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` float NOT NULL,
  `shape` varchar(20) NOT NULL,
  `size` varchar(10) NOT NULL,
  `availability` int(11) NOT NULL,
  `path` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `shape`, `size`, `availability`, `path`) VALUES
(1, 'azalea', 49.95, 'squadrato', 'medio', 50, '/img_1.jpg'),
(2, 'azalea', 52.35, 'tondeggiante', 'medio', 26, '/img_2.jpg'),
(3, 'betulla', 83.48, 'tondeggiante', 'medio', 82, '/img_3.jpg'),
(4, 'carmona', 19.95, 'squadrato', 'piccolo', 28, '/img_4.jpg'),
(5, 'carmona', 25.95, 'tondeggiante', 'piccolo', 0, '/img_5.jpg'),
(6, 'ginepro', 179.68, 'squadrato', 'grande', 91, '/img_6.jpg'),
(7, 'ginepro', 119.95, 'tondeggiante', 'medio', 67, '/img_7.jpg'),
(8, 'ginepro', 145.24, 'tondeggiante', 'piccolo', 64, '/img_8.jpg'),
(9, 'ginseng', 30.81, 'squadrato', 'piccolo', 17, '/img_9.jpg'),
(10, 'ginseng', 60.37, 'tondeggiante', 'grande', 95, '/img_10.jpg'),
(11, 'ginseng', 19.94, 'tondeggiante', 'piccolo', 20, '/img_11.jpg'),
(12, 'melo', 85.12, 'tondeggiante', 'medio', 16, '/img_12.jpg'),
(13, 'melo', 101.01, 'tondeggiante', 'piccolo', 22, '/img_13.jpg'),
(14, 'olmo', 68.83, 'squadrato', 'medio', 58, '/img_14.jpg'),
(15, 'pepe', 76.59, 'squadrato', 'medio', 26, '/img_15.jpg'),
(16, 'pepe', 86.47, 'tondeggiante', 'medio', 53, '/img_16.jpg'),
(17, 'pepe', 110.48, 'tondeggiante', 'piccolo', 86, '/img_17.jpg'),
(18, 'quercia', 150.65, 'squadrato', 'medio', 72, '/img_18.jpg'),
(19, 'quercia', 167.32, 'tondeggiante', 'medio', 2, '/img_19.jpg'),
(20, 'quercia', 189.98, 'tondeggiante', 'piccolo', 95, '/img_20.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` char(32) NOT NULL,
  `isVendor` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `isVendor`) VALUES
(1, 'venditore', 'c1a70acc25af38c5408542ddd78acc4c', 1),
(2, 'cliente', '4983a0ab83ed86e0e7213c8783940193', 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card_ibfk_1` (`userId`);

--
-- Indici per le tabelle `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_ibfk_1` (`userId`);

--
-- Indici per le tabelle `orderProducts`
--
ALTER TABLE `orderProducts`
  ADD PRIMARY KEY (`orderId`,`productId`),
  ADD KEY `idProduct` (`productId`);

--
-- Indici per le tabelle `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indici per le tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
