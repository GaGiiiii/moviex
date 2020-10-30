-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2020 at 07:53 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviex`
--

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `director` varchar(50) NOT NULL,
  `actors` varchar(250) NOT NULL,
  `length` int(11) NOT NULL,
  `img` text NOT NULL,
  `trailer` text NOT NULL,
  `description` varchar(1000) NOT NULL,
  `publish_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `title`, `genre`, `price`, `director`, `actors`, `length`, `img`, `trailer`, `description`, `publish_date`) VALUES
(3, 'AVENGERS: ENDGAME (2019)', 'Action, Adventure, Drama', 750, 'Anthony Russo, Joe Russo', 'Robert Downey Jr., Chris Evans, Mark Ruffalo', 181, 'https://wallpaperaccess.com/full/329583.jpg', 'https://www.youtube.com/watch?v=TcMBFSGVi1c', 'After the devastating events of Avengers: Infinity War (2018), the universe is in ruins. With the help of remaining allies, the Avengers assemble once more in order to reverse Thanos actions and restore balance to the universe.', '2019-03-28'),
(4, 'VENOM (2018)', 'Action, Adventure, Sci-F', 650, 'Ruben Fleischer', 'Tom Hardy, Michelle Williams, Riz Ahmed', 112, 'https://images3.alphacoders.com/948/thumb-1920-948864.jpg', 'https://www.youtube.com/watch?v=u9Mv98Gr5pY', 'A failed reporter is bonded to an alien entity, one of many symbiotes who have invaded Earth. But the being takes a liking to Earth and decides to protect it.', '2018-10-03'),
(5, 'The Dark Knight (2008)', 'Action, Crime, Drama', 1000, 'Christopher Nolan', 'Christian Bale, Heath Ledger, Aaron Eckhart', 152, 'https://images4.alphacoders.com/573/thumb-1920-57394.jpg', 'https://www.youtube.com/watch?v=EXeTwQWrcwY', 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.', '2008-01-01'),
(6, 'The Amazing Spider-Man 2 (2014)', 'Action, Adventure, Sci-Fi', 650, 'Marc Webb', 'Andrew Garfield, Emma Stone, Jamie Foxx', 144, 'https://images.alphacoders.com/496/thumb-1920-496031.jpg', 'https://www.youtube.com/watch?v=nbp3Ra3Yp74', 'When New York is put under siege by Oscorp, it is up to Spider-Man to save the city he swore to protect as well as his loved ones.', '2014-01-01'),
(7, 'Deadpool (2016)', 'Action, Adventure, Comedy', 550, 'Tim Miller', 'Ryan Reynolds, Morena Baccarin, T.J. Miller', 108, 'https://wallpaperaccess.com/full/56675.jpg', 'https://www.youtube.com/watch?v=ONHBaC-pfsk', 'A wisecracking mercenary gets experimented on and becomes immortal but ugly, and sets out to track down the man who ruined his looks.', '2016-02-01'),
(8, 'Aquaman (2018)', 'Action, Adventure, Fantasy', 550, 'James Wan', 'Jason Momoa, Amber Heard, Willem Dafoe', 143, 'https://cdn.wallpapersafari.com/17/30/aKcDpZ.jpg', 'https://www.youtube.com/watch?v=WDkg3h8PCVU', 'Arthur Curry, the human-born heir to the underwater kingdom of Atlantis, goes on a quest to prevent a war between the worlds of ocean and land.', '2018-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `rating` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `user_id`, `movie_id`, `rating`) VALUES
(15, 1, 6, 2),
(40, 4, 4, 3),
(42, 4, 6, 2),
(44, 4, 8, 4),
(46, 4, 7, 1),
(47, 1, 8, 2),
(48, 1, 5, 5),
(49, 1, 4, 4),
(50, 1, 7, 4),
(51, 1, 3, 4),
(70, 4, 5, 5),
(79, 4, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `is_admin`) VALUES
(1, 'GaGiiiii', 'gagi@gagi.com', '4ed19dc084d50fdff56cddefd81128a2', 1),
(4, 'gagi', 'gaagi@gagi.com', '4ed19dc084d50fdff56cddefd81128a2', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
