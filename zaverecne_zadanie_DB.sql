-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Čas generovania: Pi 18.Máj 2018, 14:56
-- Verzia serveru: 5.7.21-0ubuntu0.16.04.1
-- Verzia PHP: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `zaverecne_zadanie_DB`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `aktuality`
--

CREATE TABLE `aktuality` (
  `id` int(11) NOT NULL,
  `datum` varchar(25) COLLATE utf8_slovak_ci DEFAULT NULL,
  `text` varchar(50) COLLATE utf8_slovak_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `aktuality`
--

INSERT INTO `aktuality` (`id`, `datum`, `text`) VALUES
(1, '26.1.2016', 'Padlo mi to'),
(2, '26.1.2016', 'olalalalalala'),
(3, '2.1.2018', 'haaaaaloooo'),
(9, '2018/05/18', 'oooooooooo');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `celkova_trasa`
--

CREATE TABLE `celkova_trasa` (
  `id` int(11) NOT NULL,
  `Start_lan` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `Start_lng` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `End_lan` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `End_lng` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `mode` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `Definoval` varchar(25) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `celkova_trasa`
--

INSERT INTO `celkova_trasa` (`id`, `Start_lan`, `Start_lng`, `End_lan`, `End_lng`, `mode`, `Definoval`) VALUES
(5, '48.8819572', '19.8405443', '48.8819572', '20.8405443', 'public', 'pajom17@gmail.com'),
(6, '46.8819572', '22.8405443', '48.8819577', '19.8405443', 'private', 'pajom17@gmail.com'),
(7, '45.8819572', '18.8405443', '44.8819572', '17.8405443', 'public', 'pajom17@gmail.com'),
(9, '48', '20', '48.5', '20.1', 'public', 'pajom17@gmail.com');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `druzstvo`
--

CREATE TABLE `druzstvo` (
  `id` int(11) NOT NULL,
  `meno` varchar(25) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `druzstvo`
--

INSERT INTO `druzstvo` (`id`, `meno`) VALUES
(10, 'test');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `newsletter_email`
--

CREATE TABLE `newsletter_email` (
  `id` int(11) NOT NULL,
  `email` varchar(30) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `newsletter_email`
--

INSERT INTO `newsletter_email` (`id`, `email`) VALUES
(9, 'pajom17@gmail.com'),
(10, 'spam.pajo@gmail.com'),
(11, 'pajo17@post.sk');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `prejdena_trasa`
--

CREATE TABLE `prejdena_trasa` (
  `id` int(11) NOT NULL,
  `vzdialenost` int(11) NOT NULL,
  `datum` varchar(30) COLLATE utf8_slovak_ci DEFAULT NULL,
  `cas_start` varchar(30) COLLATE utf8_slovak_ci DEFAULT NULL,
  `cas_end` varchar(30) COLLATE utf8_slovak_ci DEFAULT NULL,
  `GPS_Start` varchar(30) COLLATE utf8_slovak_ci DEFAULT NULL,
  `GPS_End` varchar(30) COLLATE utf8_slovak_ci DEFAULT NULL,
  `hodnotenie` int(11) DEFAULT NULL,
  `poznamka` varchar(50) COLLATE utf8_slovak_ci DEFAULT NULL,
  `id_celkova_trasa` int(11) NOT NULL,
  `id_uzivatel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `prejdena_trasa`
--

INSERT INTO `prejdena_trasa` (`id`, `vzdialenost`, `datum`, `cas_start`, `cas_end`, `GPS_Start`, `GPS_End`, `hodnotenie`, `poznamka`, `id_celkova_trasa`, `id_uzivatel`) VALUES
(1, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 1),
(2, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 1),
(3, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 2);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `uzivatel`
--

CREATE TABLE `uzivatel` (
  `id` int(11) NOT NULL,
  `Priezvysko` varchar(15) COLLATE utf8_slovak_ci NOT NULL,
  `Meno` varchar(15) COLLATE utf8_slovak_ci NOT NULL,
  `Email` varchar(30) COLLATE utf8_slovak_ci NOT NULL,
  `Heslo` varchar(30) COLLATE utf8_slovak_ci NOT NULL,
  `Stredná škola` varchar(30) COLLATE utf8_slovak_ci DEFAULT NULL,
  `Stredná škola (adresa)` varchar(50) COLLATE utf8_slovak_ci DEFAULT NULL,
  `Bydlisko - ulica` varchar(30) COLLATE utf8_slovak_ci DEFAULT NULL,
  `PSČ` varchar(30) COLLATE utf8_slovak_ci DEFAULT NULL,
  `Bydlisko - obec` varchar(30) COLLATE utf8_slovak_ci DEFAULT NULL,
  `druzstvo_id` int(11) DEFAULT NULL,
  `administrator` tinyint(1) NOT NULL,
  `aktivna` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `uzivatel`
--

INSERT INTO `uzivatel` (`id`, `Priezvysko`, `Meno`, `Email`, `Heslo`, `Stredná škola`, `Stredná škola (adresa)`, `Bydlisko - ulica`, `PSČ`, `Bydlisko - obec`, `druzstvo_id`, `administrator`, `aktivna`) VALUES
(1, 'Mrva', 'Pavol', 'pajom17@gmail.com', '1111', 'Gymnázium M.r.Stefanika', 'Nové mesto nad váhom', 'Hlavná', '91622', 'Podolie', NULL, 0, 7),
(2, 'Mag', 'Juraj', 'spam.pajo@gmail.com', '1111', 'gymnázium m.r.štefánika', 'Nové mesto nad váhom', 'Hlavná', '91622', 'Podolie', NULL, 1, 6);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `aktuality`
--
ALTER TABLE `aktuality`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `celkova_trasa`
--
ALTER TABLE `celkova_trasa`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `druzstvo`
--
ALTER TABLE `druzstvo`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `newsletter_email`
--
ALTER TABLE `newsletter_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `prejdena_trasa`
--
ALTER TABLE `prejdena_trasa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_celkova_trasa` (`id_celkova_trasa`),
  ADD KEY `id_uzivatel` (`id_uzivatel`);

--
-- Indexy pre tabuľku `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `druzstvo_id` (`druzstvo_id`),
  ADD KEY `aktivna` (`aktivna`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `aktuality`
--
ALTER TABLE `aktuality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pre tabuľku `celkova_trasa`
--
ALTER TABLE `celkova_trasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pre tabuľku `druzstvo`
--
ALTER TABLE `druzstvo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pre tabuľku `newsletter_email`
--
ALTER TABLE `newsletter_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pre tabuľku `prejdena_trasa`
--
ALTER TABLE `prejdena_trasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pre tabuľku `uzivatel`
--
ALTER TABLE `uzivatel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
