-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 23 jan 2013 om 13:08
-- Serverversie: 5.5.25
-- PHP-versie: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `TaxiNu`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblBestellingen`
--

CREATE TABLE `tblBestellingen` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `Adres1` varchar(99) NOT NULL,
  `Adres2` varchar(99) NOT NULL,
  `Tijd` datetime NOT NULL,
  `Personen` int(9) NOT NULL,
  `Naam` varchar(99) DEFAULT NULL,
  `Email` varchar(99) DEFAULT NULL,
  `Tel` int(15) DEFAULT NULL,
  `Afgerond` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=138 ;

--
-- Gegevens worden uitgevoerd voor tabel `tblBestellingen`
--

INSERT INTO `tblBestellingen` (`id`, `Adres1`, `Adres2`, `Tijd`, `Personen`, `Naam`, `Email`, `Tel`, `Afgerond`) VALUES
(137, 'Fortsebaan 28-64, 2930 Brasschaat, België', 'Bierwertslei, Brasschaat, België', '0000-00-00 00:00:00', 3, 'Jeroen', 'jeroen.wou@gmail.com', 498845545, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblStatus`
--

CREATE TABLE `tblStatus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkBestelling` int(11) DEFAULT NULL,
  `fkUser` int(11) DEFAULT NULL,
  `Status` int(11) DEFAULT '1',
  `Wachttijd` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=144 ;

--
-- Gegevens worden uitgevoerd voor tabel `tblStatus`
--

INSERT INTO `tblStatus` (`id`, `fkBestelling`, `fkUser`, `Status`, `Wachttijd`) VALUES
(143, 137, 1, 3, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblUsers`
--

CREATE TABLE `tblUsers` (
  `pkUsers` int(99) NOT NULL AUTO_INCREMENT,
  `Username` varchar(99) NOT NULL,
  `Pass` varchar(99) NOT NULL,
  `Naam` int(11) DEFAULT NULL,
  PRIMARY KEY (`pkUsers`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `tblUsers`
--

INSERT INTO `tblUsers` (`pkUsers`, `Username`, `Pass`, `Naam`) VALUES
(1, 'AntwerpTax', '21232f297a57a5a743894a0e4a801fc3', 0),
(2, 'DtmTaxi', 'c84258e9c39059a89ab77d846ddab909', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
