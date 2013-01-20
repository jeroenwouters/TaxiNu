-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 20 jan 2013 om 15:19
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
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Gegevens worden uitgevoerd voor tabel `tblBestellingen`
--

INSERT INTO `tblBestellingen` (`id`, `Adres1`, `Adres2`, `Tijd`, `Personen`, `Status`) VALUES
(35, 'Fortsebaan 38, 2930 Brasschaat', 'Meir, Antwerpen', '2013-01-07 15:22:00', 5, 0),
(71, 'Fortsebaan, Brasschaat, België', 'Bierwertslei, Brasschaat, België', '2013-01-19 20:46:00', 2, 0),
(72, 'Fortsebaan 28-64, 2930 Brasschaat, België', 'Bierwertslei 3, Brasschaat, België', '2013-01-20 13:11:00', 5, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblUsers`
--

CREATE TABLE `tblUsers` (
  `pkUsers` int(99) NOT NULL AUTO_INCREMENT,
  `Username` varchar(99) NOT NULL,
  `Pass` varchar(99) NOT NULL,
  PRIMARY KEY (`pkUsers`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `tblUsers`
--

INSERT INTO `tblUsers` (`pkUsers`, `Username`, `Pass`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'admin2', 'c84258e9c39059a89ab77d846ddab909');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
