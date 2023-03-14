-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2022 at 06:10 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comicshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `comic`
--

CREATE TABLE `comic` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `year` int(4) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `price` int(10) NOT NULL,
  `abstract` varchar(4000) NOT NULL,
  `country` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comic`
--

INSERT INTO `comic` (`id`, `userid`, `title`, `author`, `year`, `genre`, `price`, `abstract`, `country`, `created_at`) VALUES
(1, 1, 'Compendium', 'Robert Kirkman', 2011, 'Superheroes', 35, 'The first nine volumes of the greatest superhero comic in the universe from visionary creator Robert Kirkman (The Walking Dead), along with acclaimed artists Cory Walker and Ryan Ottley, are collected in one massive paperback edition, as Mark Grayson discovering that having his father superpowers and being a hero isn\'t what he expected!', 'United States', '2022-11-12 03:32:31'),
(2, 1, 'Shuna\'s Journey', 'Hayao Miyazaki', 2022, 'Manga', 20, 'From legendary animator Hayao Miyazaki comes Shuna\'s Journey, a new manga classic about a prince on a quest for a golden grain that would save his land, never before published in English!\r\nShuna, the prince of a poor land, watches in despair as his people work themselves to death harvesting the little grain that grows there. And so, when a traveler presents him with a sample of seeds from a mysterious western land, he sets out to find the source of the golden grain, dreaming of a better life for his subjects.\r\n\r\nIt is not long before he meets a proud girl named Thea. After freeing her from captivity, he is pursued by her enemies, and while Thea escapes north, Shuna continues toward the west, finally reaching the Land of the God-Folk.\r\nWill Shuna ever see Thea again? And will he make it back home from his quest for the golden grain?', 'Japan', '2022-11-13 05:09:42'),
(3, 2, 'Uzumaki', 'Junji Ito', 2013, 'Manga', 17, 'A masterpiece of horror manga, now available in a deluxe hardcover edition!\r\nKurouzu-cho, a small fogbound town on the coast of Japan, is cursed. According to Shuichi Saito, the withdrawn boyfriend of teenager Kirie Goshima, their town is haunted not by a person or being but a pattern: UZUMAKI, the spiral—the hypnotic secret shape of the world. The bizarre masterpiece horror manga is now available all in a single volume. Fall into a whirlpool of terror!', 'Japan', '2022-11-13 05:09:42'),
(4, 1, 'Berserk', 'Koyoharu Gotouge', 2019, 'Manga', 42, 'Have you got the Guts? Kentaro Miura\'s Berserk has outraged, horrified, and delighted manga and anime fanatics since 1989, creating an international legion of hardcore devotees and inspiring a plethora of TV series, feature films, and video games. And now the badass champion of adult fantasy manga is presented in an oversized 7\" x 10\" deluxe hardcover edition, nearly 700 pages amassing the first three Berserk volumes, with following volumes to come to serve up the entire series in handsome bookshelf collections. No Guts, no glory!', 'Japan', '2022-11-13 05:09:42'),
(5, 1, 'Batman: Hush', 'Jeph Loeb', 2019, 'Superheroes', 16, 'Gotham City\'s worst criminals--Joker, Riddler, Ra\'s al Ghul, Clayface and others--have emerged to throw Batman\'s life into utter chaos. However, these villains are part of a much more elaborate, sinister scheme to destroy the Dark Knight once and for all, one headed by a mastermind much closer to Bruce Wayne than any foe before...\r\n\r\nGotham City is infected by a crime epidemic and all of Batman\'s enemies have emerged to throw his life into utter chaos. But little do they know, they\'re all pawns of the villainous Hush in an elaborate game of revenge against Bruce Wayne. Pushed past his breaking point, Batman will need to use more than the world\'s greatest detective skills to uncover the true identity of this mysterious mastermind before it\'s too late.', 'United States', '2022-11-13 05:09:42');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`, `created_at`) VALUES
(1, 'ib20190265@student.fon.bg.ac.rs', 'ivana', 'ivana123', '2022-11-12 03:21:53'),
(2, 'marija@gmail.com', 'marija', 'marija33', '2022-11-12 03:21:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comic`
--
ALTER TABLE `comic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comic`
--
ALTER TABLE `comic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comic`
--
ALTER TABLE `comic`
  ADD CONSTRAINT `comic_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
