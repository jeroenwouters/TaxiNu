-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 14 jan 2013 om 19:27
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
  `pkBestellingen` int(99) NOT NULL AUTO_INCREMENT,
  `fkAdmin` int(99) NOT NULL,
  `Adres1` varchar(99) NOT NULL,
  `Adres2` varchar(99) NOT NULL,
  `Tijd` datetime NOT NULL,
  `Personen` int(9) NOT NULL,
  PRIMARY KEY (`pkBestellingen`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Gegevens worden uitgevoerd voor tabel `tblBestellingen`
--

INSERT INTO `tblBestellingen` (`pkBestellingen`, `fkAdmin`, `Adres1`, `Adres2`, `Tijd`, `Personen`) VALUES
(9, 0, 'Fortsebaan 38, 2930 Brasschaat', 'Meir, Antwerpen', '2013-01-07 14:02:00', 5),
(10, 0, 'Fortsebaan 38, 2930 Brasschaat', 'Meir, Antwerpen', '2013-01-08 08:32:00', 5),
(11, 0, 'Fortsebaan 38, 2930 Brasschaat', 'Meir, Antwerpen', '2013-01-08 08:32:00', 5),
(12, 0, 'Fortsebaan 38, 2930 Brasschaat', 'Meir, Antwerpen', '2013-01-02 00:00:00', 5),
(13, 0, 'Fortsebaan 38, 2930 Brasschaat', 'Meir, Antwerpen', '2013-01-02 00:00:00', 3),
(14, 0, 'Fortsebaan 38, 2930 Brasschaat', 'Meir, Antwerpen', '2013-01-02 00:00:00', 3),
(15, 0, 'Fortsebaan 38, 2930 Brasschaat', 'Meir, Antwerpen', '2013-01-02 00:00:00', 3),
(16, 0, 'Fortsebaan 38, 2930 Brasschaat', 'Meir, Antwerpen', '2013-01-02 00:00:00', 3),
(17, 0, 'Fortsebaan 38, 2930 Brasschaat', 'Meir, Antwerpen', '2013-01-02 00:00:00', 3),
(18, 0, 'Fortsebaan 38, 2930 Brasschaat', 'Meir, Antwerpen', '2013-01-02 00:00:00', 3),
(19, 0, 'Fortsebaan 38, 2930 Brasschaat', 'antwerpen', '2013-01-07 14:55:00', 3),
(20, 0, 'Fortsebaan 38, 2930 Brasschaat', 'antwerpen', '2013-01-07 14:55:00', 3),
(21, 0, 'Fortsebaan 38, 2930 Brasschaat', 'antwerpen', '2013-01-07 14:55:00', 3),
(22, 0, 'Fortsebaan 38, 2930 Brasschaat', 'antwerpen', '2013-01-07 14:55:00', 3),
(23, 0, 'Fortsebaan 38, 2930 Brasschaat', 'antwerpen', '2013-01-07 14:55:00', 3),
(24, 0, 'Fortsebaan 38, 2930 Brasschaat', 'antwerpen', '2013-01-07 14:55:00', 3),
(25, 0, 'Fortsebaan 38, 2930 Brasschaat', 'antwerpen', '2013-01-07 14:55:00', 3),
(26, 0, 'Fortsebaan 38, 2930 Brasschaat', 'antwerpen', '2013-01-07 14:55:00', 3),
(27, 0, 'Fortsebaan 38, 2930 Brasschaat', 'antwerpen', '2013-01-07 14:55:00', 3),
(28, 0, 'Fortsebaan 38, 2930 Brasschaat', 'antwerpen', '2013-01-07 14:55:00', 3),
(29, 0, 'Fortsebaan 38, 2930 Brasschaat', 'antwerpen', '2013-01-07 14:55:00', 3),
(30, 0, 'Fortsebaan 38, 2930 Brasschaat', 'antwerpen', '2013-01-07 14:55:00', 3),
(31, 0, 'Fortsebaan 38, 2930 Brasschaat', 'antwerpen', '2013-01-07 14:55:00', 3),
(32, 0, 'Fortsebaan 38, 2930 Brasschaat', 'antwerpen', '2013-01-07 14:55:00', 3),
(33, 0, 'Fortsebaan 38, 2930 Brasschaat', 'antwerpen', '2013-01-07 14:55:00', 3),
(34, 0, 'Fortsebaan 38, 2930 Brasschaat', 'antwerpen', '2013-01-07 14:55:00', 3),
(35, 0, 'Fortsebaan 38, 2930 Brasschaat', 'Meir, Antwerpen', '2013-01-07 15:22:00', 5),
(36, 0, 'Fortsebaan 38, 2930 Brasschaat', 'Meir, Antwerpen', '2013-01-07 14:55:00', 5);

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
