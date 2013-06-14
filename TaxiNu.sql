-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 14 jun 2013 om 14:59
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
-- Tabelstructuur voor tabel `gcm`
--

CREATE TABLE `gcm` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `regid` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `gcm`
--

INSERT INTO `gcm` (`id`, `regid`) VALUES
(1, 'APA91bFZHKeyhDd8Hu8dC80p4TUgC1xLvKmYmNRjJMvp1vhuyr9yLHfYJY-3Y9kbW5qHkyZtUdbxJlv9qegZf8b6fLlO5m5HgTYQCwKwfF7dLGS69L1wbwJgM2XF3BeKE63BA78mAR9IGXutXpbLip8aPQhgiyo3WQ'),
(2, 'APA91bFZHKeyhDd8Hu8dC80p4TUgC1xLvKmYmNRjJMvp1vhuyr9yLHfYJY-3Y9kbW5qHkyZtUdbxJlv9qegZf8b6fLlO5m5HgTYQCwKwfF7dLGS69L1wbwJgM2XF3BeKE63BA78mAR9IGXutXpbLip8aPQhgiyo3WQ'),
(3, 'APA91bFZHKeyhDd8Hu8dC80p4TUgC1xLvKmYmNRjJMvp1vhuyr9yLHfYJY-3Y9kbW5qHkyZtUdbxJlv9qegZf8b6fLlO5m5HgTYQCwKwfF7dLGS69L1wbwJgM2XF3BeKE63BA78mAR9IGXutXpbLip8aPQhgiyo3WQ'),
(4, 'APA91bFZHKeyhDd8Hu8dC80p4TUgC1xLvKmYmNRjJMvp1vhuyr9yLHfYJY-3Y9kbW5qHkyZtUdbxJlv9qegZf8b6fLlO5m5HgTYQCwKwfF7dLGS69L1wbwJgM2XF3BeKE63BA78mAR9IGXutXpbLip8aPQhgiyo3WQ');

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
  `notif_email` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=130 ;

--
-- Gegevens worden uitgevoerd voor tabel `tblBestellingen`
--

INSERT INTO `tblBestellingen` (`id`, `Adres1`, `Adres2`, `Tijd`, `Personen`, `Naam`, `Email`, `Tel`, `Afgerond`, `Afstand`, `notif_email`) VALUES
(127, 'Fortsebaan 28-64, 2930 Brasschaat, België', 'Antwerpen, België', '2013-06-14 14:14:00', 2, 'wouters', 'wouters.plancke@gmail.com', 36634372, 1, '14,5 km', 1),
(128, 'Fortsebaan 28-64, 2930 Brasschaat, België', 'Antwerpen, België', '2013-06-14 14:50:00', 2, 'jeroen', 'jeroen.wou@gmail.com', 498845545, 1, '14,5 km', 0),
(129, 'Fortsebaan 28-64, 2930 Brasschaat, België', 'Antwerpen, België', '2013-06-14 14:57:00', 2, 'kdg', 'jeroen.wouters@student.kdg.be', 86755643, NULL, '14,5 km', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Gegevens worden uitgevoerd voor tabel `tblKlanten`
--

INSERT INTO `tblKlanten` (`id`, `naam`, `tel`, `email`, `pass`) VALUES
(7, 'jeroen', 498845545, 'jeroen.wou@gmail.com', '098f6bcd4621d373cade4e832627b4f6'),
(8, 'ben', 345678909, 'ben@mail.be', '6efe6cb7c3085b237d9d534bf134e599'),
(37, 'jins', 498845545, '23ste.jins@gmail.com', '098f6bcd4621d373cade4e832627b4f6'),
(40, 'wouters', 36634372, 'wouters.plancke@gmail.com', '098f6bcd4621d373cade4e832627b4f6'),
(41, 'kdg', 86755643, 'jeroen.wouters@student.kdg.be', '098f6bcd4621d373cade4e832627b4f6');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Gegevens worden uitgevoerd voor tabel `tblStatus`
--

INSERT INTO `tblStatus` (`id`, `fkBestelling`, `fkUser`, `Status`, `Wachttijd`, `fkTaxi`) VALUES
(8, 124, 1, 3, 3, 1),
(9, 127, 1, 3, 4, 1),
(10, 128, 1, 3, 4, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Gegevens worden uitgevoerd voor tabel `tblTaxis`
--

INSERT INTO `tblTaxis` (`id`, `fkUser`, `Login`, `Naam`, `pass`) VALUES
(1, 1, 'AntwerpTax_Taxi1', 'Taxi1', '21232f297a57a5a743894a0e4a801fc3'),
(2, 1, 'AntwerpTax_Taxi2', 'Taxi2', '21232f297a57a5a743894a0e4a801fc3'),
(3, 1, 'AntwerpTax_Taxi3', 'Taxi3', '21232f297a57a5a743894a0e4a801fc3'),
(4, 1, 'AntwerpTax_Taxi4', 'Taxi4', '21232f297a57a5a743894a0e4a801fc3'),
(6, 2, 'DtmTaxi_taxi1', 'taxi1', '21232f297a57a5a743894a0e4a801fc3'),
(7, 2, 'DtmTaxi_taxi2', 'taxi2', '21232f297a57a5a743894a0e4a801fc3'),
(8, 2, 'DtmTaxi_taxi3', 'taxi3', '21232f297a57a5a743894a0e4a801fc3'),
(9, 1, 'AntwerpTax_taxi5', 'taxi5', '21232f297a57a5a743894a0e4a801fc3');

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
(2, 'DtmTaxi', '21232f297a57a5a743894a0e4a801fc3', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
