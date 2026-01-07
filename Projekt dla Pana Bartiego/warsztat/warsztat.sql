-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 19, 2025 at 03:46 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warsztat`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id_klienta` int(11) NOT NULL,
  `Imie` varchar(50) DEFAULT NULL,
  `Nazwisko` varchar(50) DEFAULT NULL,
  `Pesel` varchar(11) DEFAULT NULL,
  `Nr_telefonu` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klienci`
--

INSERT INTO `klienci` (`id_klienta`, `Imie`, `Nazwisko`, `Pesel`, `Nr_telefonu`) VALUES
(1, 'Grzegorz', 'Braun', '12345678910', '123456789'),
(2, 'Anna', 'Kowalska', '90010112345', '501234567'),
(3, 'Piotr', 'Nowak', '85031298765', '502345678'),
(4, 'Maria', 'Wiśniewska', '92071554321', '503456789'),
(5, 'Tomasz', 'Mazur', '88092167890', '504567890');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pojazdy`
--

CREATE TABLE `pojazdy` (
  `id_pojazdu` int(11) NOT NULL,
  `Nr_rejestracyjny` varchar(60) DEFAULT NULL,
  `Marka` varchar(60) DEFAULT NULL,
  `Model` varchar(60) DEFAULT NULL,
  `Typ_Silnika` varchar(60) DEFAULT NULL,
  `Pracownik` int(11) DEFAULT NULL,
  `Aktualny_pzebieg` int(11) DEFAULT NULL,
  `Data_przyjazdu` date DEFAULT NULL,
  `Data_odjazdu` date DEFAULT NULL,
  `id_klienta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pojazdy`
--

INSERT INTO `pojazdy` (`id_pojazdu`, `Nr_rejestracyjny`, `Marka`, `Model`, `Typ_Silnika`, `Pracownik`, `Aktualny_pzebieg`, `Data_przyjazdu`, `Data_odjazdu`, `id_klienta`) VALUES
(1, 'KR1234AB', 'Bugatti', 'Chiron', 'W16', 1, 1200, '2025-11-10', '2025-11-15', 1),
(2, 'WA5678CD', 'Lamborghini', 'Aventador', 'V12', 2, 3500, '2025-11-08', '2025-11-12', 2),
(3, 'PO9876EF', 'Ferrari', 'SF90 Stradale', 'V8', 3, 2100, '2025-11-09', '2025-11-14', 3),
(4, 'KR4321GH', 'Rolls-Royce', 'Cullinan', 'V12', 4, 4800, '2025-11-07', '2025-11-13', 4),
(5, 'WA6543IJ', 'Porsche', '918 Spyder', 'V8', 5, 1500, '2025-11-06', '2025-11-11', 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownicy`
--

CREATE TABLE `pracownicy` (
  `id_pracownika` int(11) NOT NULL,
  `Imie` varchar(50) DEFAULT NULL,
  `Nazwisko` varchar(50) DEFAULT NULL,
  `Pensja` decimal(6,2) DEFAULT NULL,
  `Nr_telefonu` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pracownicy`
--

INSERT INTO `pracownicy` (`id_pracownika`, `Imie`, `Nazwisko`, `Pensja`, `Nr_telefonu`) VALUES
(1, 'Mateusz', 'Lewandowski', 4200.00, '600112233'),
(2, 'Katarzyna', 'Nowicka', 4600.50, '600223344'),
(3, 'Michał', 'Wróbel', 3950.75, '600334455'),
(4, 'Agnieszka', 'Kaczmarek', 5120.00, '600445566'),
(5, 'Paweł', 'Piotrowski', 4499.99, '600556677');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id_klienta`);

--
-- Indeksy dla tabeli `pojazdy`
--
ALTER TABLE `pojazdy`
  ADD PRIMARY KEY (`id_pojazdu`),
  ADD KEY `id_klienta` (`id_klienta`),
  ADD KEY `Pracownik` (`Pracownik`);

--
-- Indeksy dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`id_pracownika`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pojazdy`
--
ALTER TABLE `pojazdy`
  ADD CONSTRAINT `pojazdy_ibfk_1` FOREIGN KEY (`id_klienta`) REFERENCES `klienci` (`id_klienta`),
  ADD CONSTRAINT `pojazdy_ibfk_2` FOREIGN KEY (`Pracownik`) REFERENCES `pracownicy` (`id_pracownika`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
