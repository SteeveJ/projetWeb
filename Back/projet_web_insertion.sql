-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2018 at 08:59 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_web`
--
CREATE DATABASE IF NOT EXISTS `projet_web` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projet_web`;

-- --------------------------------------------------------

--
-- Table structure for table `coordinates`
--

DROP TABLE IF EXISTS `coordinates`;
CREATE TABLE `coordinates` (
  `ID_COORDINATE` int(11) NOT NULL,
  `LATITUDE` double NOT NULL,
  `LONGITUDE` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coordinates`
--

INSERT INTO `coordinates` (`ID_COORDINATE`, `LATITUDE`, `LONGITUDE`) VALUES
(1, 12.36, 126.32),
(2, 1.362, 123.36),
(3, 51.512268, -0.106688),
(4, 51.499126, -0.094843),
(5, 51.511734, -0.155611),
(6, 51.511307, -0.031328),
(7, 51.491431, -0.044203),
(8, 51.5177162373547, -0.12625694274902347),
(9, 51.48940009377448, -0.13758659362792972),
(10, 51.493995984702856, -0.012788772583007812),
(11, 51.505964502406826, -0.12763023376464847),
(12, 53.40421057583339, -2.9843330383300786),
(13, 40.51379915504413, -4.383544921875001),
(14, 41.36031866306708, 2.1560668945312504),
(15, 51.505750806437874, -0.1271152496337891),
(16, 53.47619600229148, -2.244987487792969),
(17, 51.46085244645549, -0.04943847656250001),
(18, 41.89001042401827, 12.486648559570314),
(19, 48.13493370228957, 11.573066711425783),
(20, 37.38707192644979, -5.989952087402345),
(21, 50.41201824668217, 2.2933959960937504),
(22, 45.06964120886865, 7.680130004882813),
(23, 48.929717630629554, 2.7081298828125004),
(24, 40.40722213305287, -3.6900329589843754),
(25, 28.92163128242129, 29.838867187500004),
(26, 31.23159167205059, 30.05722045898438),
(27, 26.70635985763354, 17.116699218750004),
(28, 30.60600393400217, 32.29053497314454);

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

DROP TABLE IF EXISTS `features`;
CREATE TABLE `features` (
  `ID_FEATURE` int(11) NOT NULL,
  `COORDINATE_ID` int(11) NOT NULL,
  `ID_QUESTION` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`ID_FEATURE`, `COORDINATE_ID`, `ID_QUESTION`) VALUES
(2, 4, 1),
(3, 5, 1),
(4, 6, 1),
(5, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `maps`
--

DROP TABLE IF EXISTS `maps`;
CREATE TABLE `maps` (
  `ID_MAP` int(11) NOT NULL,
  `COORDINATE_ID` int(11) NOT NULL,
  `ZOOMMAX` int(11) NOT NULL,
  `ZOOMMIN` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maps`
--

INSERT INTO `maps` (`ID_MAP`, `COORDINATE_ID`, `ZOOMMAX`, `ZOOMMIN`) VALUES
(1, 1, 13, 11),
(2, 9, 14, 11),
(3, 11, 11, 10),
(4, 13, 11, 10),
(5, 15, 10, 10),
(6, 17, 10, 10),
(7, 21, 12, 11),
(8, 23, 11, 11),
(9, 25, 13, 11),
(10, 27, 13, 11);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `ID_QUESTION` int(11) NOT NULL,
  `TITLE` varchar(100) NOT NULL,
  `TOPIC_ID` int(11) NOT NULL,
  `RESPONSE_ID` int(11) NOT NULL,
  `MAP_ID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`ID_QUESTION`, `TITLE`, `TOPIC_ID`, `RESPONSE_ID`, `MAP_ID`) VALUES
(1, 'Driss', 1, 1, 1),
(2, '', 1, 3, 2),
(3, 'Ou se trouve Barcelone ?', 1, 4, 4),
(4, 'Ou se trouve Manchester ?', 3, 5, 5),
(5, 'Ou se trouve Rome ?', 3, 6, 6),
(6, 'Ou se trouve Turin ?', 3, 9, 7),
(7, 'Ou se trouve Madrid ?', 3, 10, 8),
(8, 'Ou se trouve le Phare d\'Alexandrie ?', 2, 11, 9),
(9, 'Ou se trouve la Pyramide de Kheops ?', 2, 12, 10);

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

DROP TABLE IF EXISTS `responses`;
CREATE TABLE `responses` (
  `ID_RESPONSE` int(11) NOT NULL,
  `COORDINATE_ID` int(11) NOT NULL,
  `MARGINERROR` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`ID_RESPONSE`, `COORDINATE_ID`, `MARGINERROR`) VALUES
(1, 2, 0.5),
(2, 8, 0.36),
(3, 10, 0.366),
(4, 14, 0.2),
(5, 16, 0.4),
(6, 18, 0.1),
(7, 19, 0.3),
(8, 20, 0.3),
(9, 22, 0.3),
(10, 24, 0.2),
(11, 26, 0.4),
(12, 28, 0.4);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

DROP TABLE IF EXISTS `scores`;
CREATE TABLE `scores` (
  `ID_SCORE` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `TOPIC_ID` int(11) NOT NULL,
  `SCORE` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics` (
  `ID_TOPIC` int(11) NOT NULL,
  `NAME` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`ID_TOPIC`, `NAME`) VALUES
(1, 'Most handsome people'),
(2, 'Les 7 merveilles du monde'),
(3, 'Villes ayant une equipe en quart de final de la ligue des champions 2018');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `ID_USER` int(11) NOT NULL,
  `FIRSTNAME` varchar(30) NOT NULL,
  `LASTNAME` varchar(30) NOT NULL,
  `PSEUDO` varchar(30) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `ROLE` varchar(10) NOT NULL,
  `ACTIVE` tinyint(1) NOT NULL,
  `CREATE_AT` datetime DEFAULT CURRENT_TIMESTAMP,
  `UPDATE_AT` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID_USER`, `FIRSTNAME`, `LASTNAME`, `PSEUDO`, `PASSWORD`, `ROLE`, `ACTIVE`, `CREATE_AT`, `UPDATE_AT`) VALUES
(1, 'Driss', 'IsKewl', 'KewlDriss', '7e5f04A@', 'admin', 1, '2018-05-12 19:47:29', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coordinates`
--
ALTER TABLE `coordinates`
  ADD PRIMARY KEY (`ID_COORDINATE`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`ID_FEATURE`),
  ADD KEY `ID_QUESTION` (`ID_QUESTION`),
  ADD KEY `COORDINATE_ID` (`COORDINATE_ID`);

--
-- Indexes for table `maps`
--
ALTER TABLE `maps`
  ADD PRIMARY KEY (`ID_MAP`),
  ADD KEY `COORDINATE_ID` (`COORDINATE_ID`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`ID_QUESTION`),
  ADD UNIQUE KEY `UC_QUESTION` (`TITLE`),
  ADD KEY `RESPONSE_ID` (`RESPONSE_ID`),
  ADD KEY `TOPIC_ID` (`TOPIC_ID`),
  ADD KEY `MAP_ID` (`MAP_ID`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`ID_RESPONSE`),
  ADD KEY `COORDINATE_ID` (`COORDINATE_ID`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`ID_SCORE`),
  ADD KEY `USER_ID` (`USER_ID`),
  ADD KEY `TOPIC_ID` (`TOPIC_ID`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`ID_TOPIC`),
  ADD UNIQUE KEY `NAME` (`NAME`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_USER`),
  ADD UNIQUE KEY `UC_USER` (`LASTNAME`,`FIRSTNAME`,`PSEUDO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coordinates`
--
ALTER TABLE `coordinates`
  MODIFY `ID_COORDINATE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `ID_FEATURE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `maps`
--
ALTER TABLE `maps`
  MODIFY `ID_MAP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `ID_QUESTION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `ID_RESPONSE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `ID_SCORE` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `ID_TOPIC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
