-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2021 at 07:28 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knjiznica`
--

-- --------------------------------------------------------

--
-- Table structure for table `knjige`
--

CREATE TABLE `knjige` (
  `id` int(11) NOT NULL,
  `ime` varchar(100) COLLATE cp1250_croatian_ci NOT NULL,
  `autor` varchar(100) COLLATE cp1250_croatian_ci NOT NULL,
  `godina` year(4) NOT NULL,
  `zanr` varchar(50) COLLATE cp1250_croatian_ci NOT NULL,
  `nakladnik` varchar(100) COLLATE cp1250_croatian_ci NOT NULL,
  `jezik` varchar(20) COLLATE cp1250_croatian_ci NOT NULL,
  `brPrimjeraka` int(2) NOT NULL,
  `opis` varchar(5000) COLLATE cp1250_croatian_ci NOT NULL,
  `slika` varchar(255) COLLATE cp1250_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;

--
-- Dumping data for table `knjige`
--

INSERT INTO `knjige` (`id`, `ime`, `autor`, `godina`, `zanr`, `nakladnik`, `jezik`, `brPrimjeraka`, `opis`, `slika`) VALUES
(1, 'Harry Potter and The Prisoner of Azkaban', 'J. K. Rowling', 1999, 'Fantastika', 'Algoritam', 'Engleski', 4, 'Azkaban, jezovita tvrđava nad kojom bdiju ubojiti čuvari, mjesto je kamo čarobnjački svijet šalje one koje bi najradije zaboravio – ubojice, prevarante i općenito opasne tipove. Jedan je od njih i Sirius Black, koji je nakon dvanaest dugih godina nekako našao načina da pobjegne iz tog mračnog mjesta koje siše dušu.\r\nGlasine kažu da se uputio u Hogwarts, gdje je upravo počela nastava, a Harry se vratio s praznika na treću godinu. Škola je u strahu, pa Ministarstvo magije šalje azkabanske čuvare da pomognu štititi učenike i profesore. No, njihova će prisutnost imati užasne posljedice, a još je gora činjenica da se usred škole nalazi opasni izdajnik…\r\nHarry Potter i zatočenik Azkabana Joanne K. Rowling, u prijevodu Zlatka Crnkovića i uz izvornu ilustraciju Mary GrandPre, treća je od sedam knjiga o najpoznatijem malom čarobnjaku na svijetu. Prevedena na vjerojatno sve jezike svijeta i prodana u nebrojenom (i svakim danom rastućem) broju primjeraka, ova će vas knjiga, ako samo otvorite njezine korice, nepovratno odvući u čarobni svijet Harryja Pottera, gdje vas na svakoj strani čeka neopisiv užitak čitanja!', 'https://www.begen.hr/wp-content/uploads/2020/06/Harry-Potter-and-the-Prisoner-Azkaban.jpg'),
(3, 'gasdfgasd', 'asfdgsdg', 0000, 'Znanstvena fantastika', 'gsdgsdg', 'gsdgsgs', 4, 'dfgsgsdgsdg', 'https://images-na.ssl-images-amazon.com/images/I/91TsP9UCWwL.jpg'),
(4, 'Zločin i Kazna', 'Fjodor Mihajlovič Dostojevski', 1985, 'Drama', 'fasfas', 'Hrvatski', 4, 'faslfkaslfjasfjals', 'https://knjiga.hr/wp-content/uploads/product-images/049897/049897.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `imeKorisnika` varchar(60) COLLATE cp1250_croatian_ci NOT NULL,
  `emailKorisnika` varchar(100) COLLATE cp1250_croatian_ci NOT NULL,
  `uidKorisnika` varchar(30) COLLATE cp1250_croatian_ci NOT NULL,
  `lozinka` varchar(255) COLLATE cp1250_croatian_ci NOT NULL,
  `slikaKorisnika` varchar(255) COLLATE cp1250_croatian_ci NOT NULL,
  `admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `imeKorisnika`, `emailKorisnika`, `uidKorisnika`, `lozinka`, `slikaKorisnika`, `admin`) VALUES
(3, 'Mihaela kms', 'mihaela1958@gmail.com', 'mihaelakms', '$2y$10$QzdUwLQdffVi7mvSD2/iwuZw3SDFG2fFaRevD6LJW7G2094X1hsUq', 'a', 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik_knjiga`
--

CREATE TABLE `korisnik_knjiga` (
  `korisnikId` int(100) NOT NULL,
  `knjigaId` int(100) NOT NULL,
  `rating` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posudjeno`
--

CREATE TABLE `posudjeno` (
  `idKorisnik` int(11) NOT NULL,
  `idKnjiga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posudjeno2`
--

CREATE TABLE `posudjeno2` (
  `idKnjiga` int(100) NOT NULL,
  `idKorisnik` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `knjige`
--
ALTER TABLE `knjige`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik_knjiga`
--
ALTER TABLE `korisnik_knjiga`
  ADD KEY `knjigaId` (`knjigaId`),
  ADD KEY `korisnikId` (`korisnikId`);

--
-- Indexes for table `posudjeno`
--
ALTER TABLE `posudjeno`
  ADD KEY `idKorisnik` (`idKorisnik`),
  ADD KEY `idKnjiga` (`idKnjiga`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `knjige`
--
ALTER TABLE `knjige`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnik_knjiga`
--
ALTER TABLE `korisnik_knjiga`
  ADD CONSTRAINT `knjigaId` FOREIGN KEY (`knjigaId`) REFERENCES `knjige` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `korisnikId` FOREIGN KEY (`korisnikId`) REFERENCES `korisnici` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posudjeno`
--
ALTER TABLE `posudjeno`
  ADD CONSTRAINT `idKnjiga` FOREIGN KEY (`idKnjiga`) REFERENCES `knjige` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKorisnik` FOREIGN KEY (`idKorisnik`) REFERENCES `korisnici` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
