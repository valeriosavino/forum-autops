-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 22, 2022 alle 19:35
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `autops`
--
CREATE DATABASE IF NOT EXISTS `autops` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `autops`;

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie`
--

CREATE TABLE `categorie` (
  `CodCategoria` int(8) NOT NULL,
  `NomeCategoria` char(50) NOT NULL,
  `DescrCategoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `categorie`
--

INSERT INTO `categorie` (`CodCategoria`, `NomeCategoria`, `DescrCategoria`) VALUES
(1, 'Formula 1', 'Categoria per gli amanti della Formula 1'),
(2, 'Formula E', 'Categoria per gli amanti della Formula E'),
(3, 'Carrozzeria', 'Categoria per la carrozzeria dei veicoli'),
(4, 'Acquisto nuovo', 'Categoria per gli acquisti di nuove auto'),
(5, 'Acquisto usato', 'Categoria per l\'acquisto di auto usate'),
(6, 'Pneumatici', 'Categoria per i pneumatici'),
(7, 'Auto elettriche', 'Categoria per le auto elettriche'),
(8, 'Recensioni modelli', 'Categoria dedicata alle recensioni delle auto'),
(9, 'Ultime notizie', 'Categoria dedicata alla discussione di nuove notizie'),
(10, 'Riviste', 'Categoria dedicata alla discussione su varie riviste '),
(11, 'Carburanti', 'Categoria dedicata ai carburanti'),
(12, 'Motori', 'Categoria dedicata alla discussione sui motori'),
(13, 'Meccanica', 'Categoria dedicata ai professionisti meccanici'),
(14, 'Auto d\'epoca', 'Categoria dedicata ai nostalgici delle auto d\'epoca'),
(15, 'Pezzi di ricambio', 'Categoria dedicata ai pezzi di ricambio');

-- --------------------------------------------------------

--
-- Struttura della tabella `modelli`
--

CREATE TABLE `modelli` (
  `CodModello` int(8) NOT NULL,
  `NomeModello` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `modelli`
--

INSERT INTO `modelli` (`CodModello`, `NomeModello`) VALUES
(0, '-'),
(1, 'Ford Mondeo'),
(2, 'Mini Cooper'),
(4, 'Nissan Micra'),
(5, 'Kia Sportage'),
(6, 'Citroen C3'),
(7, 'Dacia Sandero'),
(8, 'Fiat Panda'),
(9, 'Fiat 500'),
(10, 'Lancia Y'),
(11, 'Jeep Renegade'),
(12, 'Toyota Yaris'),
(13, 'Fiat 500X'),
(14, 'Dacia Lodgy'),
(15, 'Ford Puma'),
(16, 'Volkswagen T-Roc'),
(17, 'Jeep Compass'),
(18, 'Renault Captur'),
(19, 'Renault Clio'),
(20, 'Dacia Duster'),
(21, 'Opel Corsa'),
(22, 'Peugeot 2008'),
(23, 'Volkswagen T-Cross'),
(24, 'Peugeot 208'),
(25, 'Volkswagen Polo'),
(26, 'Peugeot 3008'),
(27, 'Fiat 500L'),
(28, 'Fiat Tipo'),
(29, 'Volkswagen Tiguan'),
(30, 'Volkswagen Golf'),
(31, 'Hyundai Tucson'),
(32, 'Suzuki Ignis'),
(33, 'Suzuki Swift'),
(34, 'Citroen C3 AirCross'),
(35, 'Toyota Aygo'),
(36, 'Ford Fiesta'),
(37, 'Hyundai i10'),
(38, 'Kia Picanto'),
(39, 'Ford Kuga'),
(40, 'Audi A3'),
(41, 'Audi A1'),
(42, 'Audi Q3'),
(43, 'BMW X1'),
(44, 'Opel Crossland X'),
(45, 'Toyota CHR'),
(46, 'Volvo XC40'),
(47, 'Ford Ecosport'),
(48, 'BMW Serie 1'),
(49, 'BMW Serie 3'),
(50, 'Mercedes Classe A'),
(51, 'Nissan Qashqai'),
(52, 'Ford Focus');

-- --------------------------------------------------------

--
-- Struttura della tabella `posts`
--

CREATE TABLE `posts` (
  `CodPost` int(8) NOT NULL,
  `Contenuto` text NOT NULL,
  `DataPost` datetime NOT NULL,
  `RispostaPost` int(8) NOT NULL DEFAULT 0,
  `TopicPost` int(8) NOT NULL,
  `UtPost` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `posts`
--

INSERT INTO `posts` (`CodPost`, `Contenuto`, `DataPost`, `RispostaPost`, `TopicPost`, `UtPost`) VALUES
(52, 'Mi piacerebbe prendere una bella macchina ibrida della Toyota', '2022-05-05 18:58:13', 0, 15, 10),
(53, 'Ti consiglio una bella Toyota della pubblicità', '2022-05-05 18:59:20', 52, 15, 1),
(54, 'Non saprei secondo me si', '2022-05-05 19:00:01', 0, 16, 1),
(55, 'Devo cambiare le gomme e non so se è il caso per acquistare questo tipo', '2022-05-05 19:01:12', 0, 17, 1),
(56, 'Chiedo cortesemente a tutti i partecipanti di darmi un consiglio, sono un profano di auto elettriche e/o ibride. Grazie', '2022-05-05 19:13:11', 0, 18, 27),
(57, 'Quella che ha le batterie che durano di più', '2022-05-05 19:13:38', 56, 18, 1),
(61, 'Devo valutare l\'acquisto di 4 gomme nuove e questa marca ha le più economiche, che ne dite?', '2022-05-09 12:47:17', 0, 19, 1),
(62, 'Le ho prese per la mia auto, mi ci sono trovato bene per il momento', '2022-05-09 12:53:44', 61, 19, 10),
(63, 'Sta andando forte questa stagione, secondo me ha buone possibilità', '2022-05-11 12:21:10', 54, 16, 10),
(64, 'Ho trovato su AutoScout una Mini Cooper rossa a una buona cifra (circa 3000 euro). Sapete se in generale le Mini presentano dei difetti comuni?', '2022-05-11 12:45:33', 0, 20, 10),
(65, '*messaggio eliminato*', '2022-05-11 12:47:36', 64, 20, 27),
(66, 'Lo staff ti invita a rispettare un linguaggio consono', '2022-05-11 12:49:21', 65, 20, 1),
(67, 'Ne ho vista una alla fiera del mio paese, semplicemente spettacolare!', '2022-05-22 12:02:00', 0, 21, 28),
(68, 'Io personalmente di quella generazione preferisco la Camaro, molto simile', '2022-05-22 12:04:43', 67, 21, 29),
(69, 'Ognuno ha i propri gusti...', '2022-05-22 12:05:57', 68, 21, 28),
(70, 'Io ne ho restaurata una, tanta roba', '2022-05-22 12:07:52', 67, 21, 30),
(71, 'Mi è arrivata oggi una Polo con un guasto ai freni. Ho attaccato l\'attrezzo alla centralina e mi dava un codice di errore che non c\'è sui manuali, qualcuno ne ha mai sentito parlare di una cosa simile?', '2022-05-22 12:11:26', 0, 22, 30),
(72, 'Ho fatto una scampagnata a Roccaraso per il finesettimana. Non avrei mai immaginato che i prezzi fossero cosi elevati! Conoscete un benzinaio economico?', '2022-05-22 12:13:06', 0, 23, 30),
(73, 'Mi sono stufato del nero classico, secondo voi quale colore sarebbe meglio abbinato al bianco?', '2022-05-22 12:17:57', 0, 24, 30),
(74, 'Ultimamente il pilota De Vries ha fatto i test delle prove libere con la Mercedes. Secondo voi, lascerà la Formula E per la 1? Spero di no', '2022-05-22 12:28:59', 0, 25, 10),
(75, 'Meglio se rimane in Formula E, per la sua carriera...è molto bravo, in Formula 1 si rovinerebbe', '2022-05-22 12:34:45', 74, 25, 27),
(76, 'Mi sono stufato del mio Suv della Kia, troppo ingombrante per la città. Sapete consigliarmi una piccola citycar che non sia la SMART?', '2022-05-22 12:38:39', 0, 26, 27),
(77, 'Mia moglie si trova bene con la sua Ford Ecosport, potrebbe essere un\'idea', '2022-05-22 12:40:21', 76, 26, 29),
(78, 'Ma è una Crossover! Vorrei una citycar un pò più gestibile', '2022-05-22 12:41:12', 77, 26, 27),
(79, 'Ha fatto certi sorpassi nell\'ultima gara che non stanno ne in cielo ne in terra!', '2022-05-22 12:45:09', 0, 27, 27),
(80, '*messaggio eliminato*', '2022-05-22 12:47:40', 79, 27, 31),
(81, 'Occhio al linguaggio luperk!', '2022-05-22 12:48:21', 79, 27, 1),
(82, 'Ho appena visto la nuova Kia Sportage in una pubblicità; Siccome avevo intenzione di farmi una nuova auto, dite che può essere un buon acquisto?', '2022-05-22 17:53:07', 0, 28, 32),
(83, 'Purtroppo non posso dirti nulla del nuovo modello, ma la mia Sportage dopo 6 anni ancora resiste (Ha più di 200.000km)', '2022-05-22 17:55:44', 82, 28, 27),
(84, 'Grazie per il consiglio, anche se sono ancora un pò scettico\r\nForse rimango con la mia Peugeot per ora', '2022-05-22 18:08:33', 83, 28, 32),
(85, 'no', '2022-05-22 18:18:19', 71, 22, 32),
(86, 'Siccome ha questa particolarità (brutta oserei aggiungere), che ne pensate della Audi A3?', '2022-05-22 18:24:10', 0, 29, 1),
(87, '*messaggio eliminato*', '2022-05-22 18:58:22', 86, 29, 0),
(88, '*messaggio eliminato*', '2022-05-22 19:01:01', 76, 26, 0),
(89, 'Scusami! Non ero cosi informato, pensavo fosse un SUV!', '2022-05-22 19:17:54', 78, 26, 29),
(90, 'Mi raccomando, non litigate.', '2022-05-22 19:18:30', 89, 26, 1),
(91, '*messaggio eliminato*', '2022-05-22 19:23:30', 82, 28, 10),
(92, 'Ciao, guarda ho letto che quella cosa non è più valida', '2022-05-22 19:24:46', 91, 28, 32),
(93, 'Ops! Ho letto adesso anche io, hai ragione', '2022-05-22 19:25:49', 92, 28, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `topics`
--

CREATE TABLE `topics` (
  `CodTopic` int(8) NOT NULL,
  `TitoloTopic` varchar(255) NOT NULL,
  `DataTopic` datetime NOT NULL,
  `CatTopic` int(8) NOT NULL,
  `UtTopic` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `topics`
--

INSERT INTO `topics` (`CodTopic`, `TitoloTopic`, `DataTopic`, `CatTopic`, `UtTopic`) VALUES
(15, 'Che ne pensate di una Toyota ibrida?', '2022-05-05 18:58:13', 4, 10),
(16, 'La Ferrari ce la farà a vincere il campionato?', '2022-05-05 19:00:01', 1, 1),
(17, 'Vale la pena acquistare dei pneumatici 4 stagioni adesso?', '2022-05-05 19:01:12', 6, 1),
(18, 'Come valutare la scelta di un\'auto elettrica?', '2022-05-05 19:13:11', 7, 27),
(19, 'Kleber è una buona marca?', '2022-05-09 12:47:17', 6, 1),
(20, 'Acquisto Mini Cooper annatta 2009', '2022-05-11 12:45:33', 5, 10),
(21, 'Che bella che era la Chevrolet Impala', '2022-05-22 12:02:00', 14, 28),
(22, 'Guasto freni Volkswagen Polo', '2022-05-22 12:11:26', 13, 30),
(23, 'Prezzo benzina a Roccaraso', '2022-05-22 12:13:06', 11, 30),
(24, 'Colore parafango per Panda Van', '2022-05-22 12:17:57', 3, 30),
(25, 'Speculazioni passaggio De Vries ', '2022-05-22 12:22:09', 2, 10),
(26, 'Cambio auto ', '2022-05-22 12:38:39', 4, 27),
(27, 'Verstappen è veramente forte!', '2022-05-22 12:45:09', 1, 27),
(28, 'Consiglio sulla nuova Kia Sportage', '2022-05-22 17:53:07', 4, 32),
(29, 'Non sopporto più il design della mia macchina!', '2022-05-22 18:24:10', 4, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `CodUtente` int(8) NOT NULL,
  `NomeUtente` char(40) NOT NULL,
  `PassUtente` varchar(255) NOT NULL,
  `EmailUtente` varchar(255) NOT NULL,
  `DataIscrizioneUtente` datetime NOT NULL,
  `AutorizzazioneUtente` int(2) NOT NULL,
  `ModUtente` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`CodUtente`, `NomeUtente`, `PassUtente`, `EmailUtente`, `DataIscrizioneUtente`, `AutorizzazioneUtente`, `ModUtente`) VALUES
(0, '*utente eliminato*', 'null', 'null', '2022-04-30 17:30:15', 0, 0),
(1, 'tizio', '7c222fb2927d828af22f592134e8932480637c0d', 'tizio987@hotmail.it', '2022-04-21 16:47:06', 1, 1),
(10, 'mellone', '5fa339bbbb1eeaced3b52e54f44576aaf0d77d96', 'veramail@mail.co', '2022-04-25 18:57:05', 0, 4),
(27, 'caio', '7c222fb2927d828af22f592134e8932480637c0d', 'pippo.paperino@gmail.it', '2022-05-05 19:11:11', 0, 5),
(28, 'impala', 'cbf2510a5f9f7eece23428da7125c06115839e2b', 'impala76@email.com', '2022-05-22 12:00:51', 0, 49),
(29, 'andrea10', 'dfc3cfa738b2b4fec282cbe181e84d868c213fe2', 'andr55@maild.it', '2022-05-22 12:03:12', 0, 27),
(30, 'bz808', 'e373fe543211d666f2575ac7301f092e1639f0d8', 'meccbz@gmail.com', '2022-05-22 12:07:33', 0, 8),
(31, 'luperk', 'fc2a8028bb42df41b92bb596017a292b4fd71b93', 'mor@live.it', '2022-05-22 12:47:21', 0, 52),
(32, 'Antonio', 'f09b3eb368b9d267a54b8878da46c9766f46663e', 'antony78@live.it', '2022-05-22 17:50:42', 0, 24);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`CodCategoria`),
  ADD UNIQUE KEY `NomeCategoriaUnique` (`NomeCategoria`);

--
-- Indici per le tabelle `modelli`
--
ALTER TABLE `modelli`
  ADD PRIMARY KEY (`CodModello`);

--
-- Indici per le tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`CodPost`),
  ADD KEY `TopicPost` (`TopicPost`),
  ADD KEY `UtPost` (`UtPost`);

--
-- Indici per le tabelle `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`CodTopic`),
  ADD KEY `CatTopic` (`CatTopic`),
  ADD KEY `UtTopic` (`UtTopic`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`CodUtente`),
  ADD UNIQUE KEY `NomeUtenteUnique` (`NomeUtente`),
  ADD UNIQUE KEY `NomeUtente` (`NomeUtente`),
  ADD KEY `ModUtente` (`ModUtente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `categorie`
--
ALTER TABLE `categorie`
  MODIFY `CodCategoria` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `modelli`
--
ALTER TABLE `modelli`
  MODIFY `CodModello` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT per la tabella `posts`
--
ALTER TABLE `posts`
  MODIFY `CodPost` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT per la tabella `topics`
--
ALTER TABLE `topics`
  MODIFY `CodTopic` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `CodUtente` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`TopicPost`) REFERENCES `topics` (`CodTopic`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`UtPost`) REFERENCES `utenti` (`CodUtente`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`CatTopic`) REFERENCES `categorie` (`CodCategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`UtTopic`) REFERENCES `utenti` (`CodUtente`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `utenti`
--
ALTER TABLE `utenti`
  ADD CONSTRAINT `utenti_ibfk_1` FOREIGN KEY (`ModUtente`) REFERENCES `modelli` (`CodModello`) ON UPDATE CASCADE;
COMMIT;
