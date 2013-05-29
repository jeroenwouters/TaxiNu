-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 29 mei 2013 om 15:26
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
  `Afstand` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=223 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblKlanten`
--

CREATE TABLE `tblKlanten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(255) NOT NULL,
  `tel` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `fkTaxi` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=208 ;

--
-- Gegevens worden uitgevoerd voor tabel `tblStatus`
--

INSERT INTO `tblStatus` (`id`, `fkBestelling`, `fkUser`, `Status`, `Wachttijd`, `fkTaxi`) VALUES
(206, 221, 1, 3, NULL, 4),
(207, 222, 1, 3, 4, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblTaxis`
--

CREATE TABLE `tblTaxis` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `fkUser` int(255) NOT NULL,
  `Login` varchar(99) NOT NULL,
  `Naam` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL DEFAULT '21232f297a57a5a743894a0e4a801fc3',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `tblTaxis`
--

INSERT INTO `tblTaxis` (`id`, `fkUser`, `Login`, `Naam`, `pass`) VALUES
(1, 1, 'AntwerpTax_Taxi1', 'Taxi1', '21232f297a57a5a743894a0e4a801fc3'),
(2, 1, 'AntwerpTax_Taxi2', 'Taxi2', '21232f297a57a5a743894a0e4a801fc3'),
(3, 1, 'AntwerpTax_Taxi3', 'Taxi3', '21232f297a57a5a743894a0e4a801fc3'),
(4, 1, 'AntwerpTax_Taxi4', 'Taxi4', '21232f297a57a5a743894a0e4a801fc3'),
(5, 1, 'AntwerpTax_Taxi5', 'Taxi5', '21232f297a57a5a743894a0e4a801fc3');

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
