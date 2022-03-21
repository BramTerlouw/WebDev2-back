-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Gegenereerd op: 21 mrt 2022 om 19:25
-- Serverversie: 10.6.5-MariaDB-1:10.6.5+maria~focal
-- PHP-versie: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--

CREATE TABLE `category` (
  `category_ID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `category`
--

INSERT INTO `category` (`category_ID`, `name`) VALUES
(1, 'Graphics card'),
(2, 'Motherboard'),
(3, 'SSD (Solid State Drive)');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `product_ID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(11) NOT NULL,
  `category_ID` int(11) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`product_ID`, `name`, `price`, `category_ID`, `image`) VALUES
(1, 'Gigabyte GeForce RTX 3050', 449, 1, 'https://www.megekko.nl/productimg/1146102/midi/1_Gigabyte-GeForce-RTX-3050-GAMING-OC-8G-Videokaart.jpg'),
(2, 'Gigabyte GeForce RTX 3060 Ti', 749, 1, 'https://www.megekko.nl/productimg/1009543/midi/3_Gigabyte-GeForce-RTX-3060-Ti-GAMING-OC-8G-2-0-Videokaart.jpg'),
(3, 'Gigabyte B550 AORUS ELITE V2', 110, 2, 'https://www.megekko.nl/productimg/295472/midi/1_Gigabyte-B550-AORUS-ELITE-V2-moederbord.jpg'),
(4, 'MSI MAG B550 TOMAHAWK', 140, 2, 'https://www.megekko.nl/productimg/287622/midi/1_MSI-MAG-B550-TOMAHAWK-moederbord.jpg'),
(5, 'Samsung 980 1TB M.2', 114, 3, 'https://www.megekko.nl/productimg/303274/midi/1_Samsung-980-1TB-M-2-SSD.jpg'),
(6, 'Samsung 980 PRO 1TB M.2', 173, 3, 'https://www.megekko.nl/productimg/293064/midi/1_Samsung-980-PRO-1TB-M-2-SSD.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `stock`
--

CREATE TABLE `stock` (
  `stock_ID` int(11) NOT NULL,
  `product_ID` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `stock`
--

INSERT INTO `stock` (`stock_ID`, `product_ID`, `amount`) VALUES
(1, 1, 5),
(2, 2, 2),
(3, 3, 10),
(4, 4, 9),
(5, 5, 20),
(6, 6, 36);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `user_ID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`user_ID`, `name`, `email`, `username`, `password`, `role`) VALUES
(1, 'Bram Terlouw', 'bram@mail.com', 'bram_user', 'wachtwoord', 'User'),
(2, 'Mark de Haan', 'mark@mail.com', 'mark_admin', 'wachtwoord', 'Admin');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_ID`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_ID`),
  ADD KEY `category_ID` (`category_ID`);

--
-- Indexen voor tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_ID`),
  ADD KEY `product_ID` (`product_ID`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `category`
--
ALTER TABLE `category`
  MODIFY `category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT voor een tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_ID`) REFERENCES `category` (`category_ID`) ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`product_ID`) REFERENCES `product` (`product_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
