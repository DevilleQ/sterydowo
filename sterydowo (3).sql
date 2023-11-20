-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 21 Lis 2023, 00:12
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sterydowo`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id_klienta` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `imie` varchar(255) NOT NULL,
  `nazwisko` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `isAdmin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`id_klienta`, `login`, `haslo`, `imie`, `nazwisko`, `email`, `isAdmin`) VALUES
(1, 'DevileQ', '123', 'Jakub', 'Nowak', 'jaknow2004@gmail.com', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id_produktu` int(255) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `cena` int(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `opis` text NOT NULL,
  `producent` varchar(255) NOT NULL,
  `kategoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id_produktu`, `nazwa`, `cena`, `img`, `opis`, `producent`, `kategoria`) VALUES
(1, 'Testosterone Propionate 100mg 10ml Dobry Teść', 100, 'img/produkty/tesc_pro.png', 'Testosteron Propionate charakteryzuje się krótkimi estrami co oznacza że jego suplementacja musi następować co 1-2 dni.\r\nJest to idealny wybór dla osób chcących mieć jak największą kontrolę nad swoim cyklem.', 'Dobry Teść', 'zastrzyk'),
(2, 'Testosterone Enanthate 300mg 10ml Dobry Teść', 120, '/img/produkty/tesc_en.png', 'Testosteron Enanthate charakteryzuje się dłuższymi estrami niż propionate jednak krótszymi niż cypionate. W skrócie oznacza to że można go suplementować rzadziej niż propionate jednak częściej niż cypionate.', 'Dobry Teść', 'zastrzyk'),
(3, 'TESTOSTERON CYPIONATE 300MG 10ML Dobry Teść', 140, '/img/produkty/tesc_cy.png', 'Testosteron Cypionate charakteryzuje się znacznie dłuższymi estrami niż propionate i enanthate, dzięki czemu można go suplementować tylko raz w tygodniu. Dobry wybór dla osób które cenią swój czas oraz nie lubią częstych zastrzyków.', 'Dobry Teść', 'zastrzyk'),
(4, 'Methandienone 50mg 10ml DieLikeGod', 80, '/img/produkty/metka_za.png', 'Methandienone to syntetyczny steroid anaboliczny, stosowany głównie w celu zwiększenia masy mięśniowej i siły. Popularny wśród sportowców i kulturystów, działa poprzez zwiększenie retencji azotu w komórkach mięśniowych, przyspieszając wzrost masy mięśniowej. ', 'DieLikeGod', 'zastrzyk'),
(5, 'Anapolon 50mg 10ml MaxForce', 130, '/img/produkty/anapol_za.png', 'Anapolon to handlowa nazwa dla substancji chemicznej oksymetolonu, który jest syntetycznym steroidem anabolicznym. Jest powszechnie stosowany w kulturystyce i sporcie siłowym do zwiększania masy mięśniowej i siły. Anapolon działa poprzez zwiększenie produkcji czerwonych krwinek i retencji azotu, co przyczynia się do szybszego wzrostu masy mięśniowej. ', 'MaxForce', 'zastrzyk'),
(6, 'Trenbolone Enanthate 200mg 10ml DieLikeGod\r\n', 180, '/img/produkty/tren_za.png', 'Trenbolon to syntetyczny steroid anaboliczny, powszechnie używany w kulturystyce i sporcie siłowym. Działa poprzez zwiększenie retencji azotu w mięśniach, co przyspiesza wzrost masy mięśniowej. Trenbolon jest również znany ze zdolności do zwiększania siły i wytrzymałości.', 'DieLikeGod', 'zastrzyk'),
(7, 'DHB Dihydroboldenone cypionate 100mg 10ml MosterByChoice', 160, '/img/produkty/dhb_za.png', 'DHB, czyli dihydroboldenon, to syntetyczny steroid anaboliczny, który jest stosowany w celu zwiększenia masy mięśniowej i siły. Podobnie jak inne substancje tego typu, DHB wpływa na retencję azotu w mięśniach, przyspieszając tym samym proces budowy masy mięśniowej. ', 'MonsterByChoice', 'zastrzyk'),
(8, 'Methenolone Enanthate 100mg 10ml DieLikeGod', 220, '/img/produkty/menth_za.png', 'Metenolon, znany również jako Methenolone, to steroid anaboliczny stosowany głównie w kulturystyce. Działa poprzez zwiększenie retencji azotu w mięśniach, wspomagając rozwój masy mięśniowej. Methenolone jest ceniony za niskie ryzyko efektów ubocznych.', 'DieLikeGod', 'zastrzyk'),
(9, 'Boldenone 250mg 10mg DieLikeGod', 130, 'img/produkty/bold_za.png', 'Boldenon to syntetyczny steroid anaboliczny, powszechnie stosowany w kulturystyce i sporcie siłowym. Jest znany ze zdolności do zwiększania masy mięśniowej poprzez zwiększenie retencji azotu. Boldenon jest stosunkowo łagodny w działaniu i rzadko powoduje efekty uboczne, co sprawia, że jest popularny wśród sportowców. ', 'DieLikeGod', 'zastrzyk'),
(10, 'Drostanolone Enanthate 200mg 10ml MonsterByChoice', 180, 'img/produkty/drost_za.png', 'Drostanolon, znany również jako Masteron, to syntetyczny steroid anaboliczny, popularny wśród kulturystów i sportowców. Jego główne zastosowanie to poprawa definicji mięśni i utrzymywanie masy ciała podczas okresów redukcji tłuszczu. Drostanolon działa poprzez zwiększenie twardości mięśniowej i eliminację nadmiaru wody podskórnej. ', 'MonsterByChoice', 'zastrzyk'),
(11, 'Maxitropin Liquid (HGH) 10 x 10IU MaxForce', 800, '/img/produkty/hgh_za.png', 'Hormon wzrostu, znany również jako HGH (ang. Human Growth Hormone), to naturalnie występujący hormon w organizmie odpowiedzialny za wzrost komórek, regenerację tkanek i utrzymanie zdrowego metabolizmu. W medycynie jest stosowany do leczenia różnych warunków, a w sporcie i kulturystyce bywa używany w celu poprawy wydolności fizycznej i regeneracji mięśni. ', 'MaxForce', 'zastrzyk'),
(12, 'Stanazol Winstrol 50mg 10ml DieLikeGod', 140, '/img/produkty/stan_za.png', 'Stanozolol inaczej nazywany Winstrol, to steryd wysoko anaboliczny, jest pochodną DHT (dihydrotestosteronu). DHT określany jako metabolit testosteronu, czyli najpopularniejszego hormonu anabolicznego, dzięki któremu odbywa się synteza białek mięśniowych i prowadzi do rozwoju mięśni. Szczególnie popularny wśród zawodników kulturystyki jako środek dopingujący. Anabolik ten pomaga w przyroście masy mięśniowej oraz siły.', 'DieLikeGod', 'zastrzyk'),
(13, 'Methyl Testosterone 25mg 50tab MaxForce', 150, '/img/produkty/tesc_or.png', '', 'MaxForce', 'tabletki'),
(14, 'Methandienone 10mg 100tab DieLikeGod', 80, '/img/produkty/metka_or.png', '', 'DieLikeGod', 'tabletki'),
(15, 'Anavar Oxandrolone 10mg 100tab DieLikeGod', 280, '/img/produkty/anv_or.png', '', 'DieLikeGod', 'tabletki'),
(16, 'Winstrol 10mg 100tab DieLikeGod', 120, '/img/produkty/win_or.png', '', 'DieLikeGod', 'tabletki'),
(17, 'Anapolon 25mg 100tab DieLikeGod', 180, '/img/produkty/anapol_or.png', '', 'DieLikeGod', 'tabletki'),
(18, 'Turanabol 10mg 100tab DieLikeGod', 160, '/img/produkty/tur_or.png', '', 'DieLikeGod', 'tabletki'),
(19, 'Anastrazol 1mg 30tab MaxForce', 140, '/img/produkty/anas_od.png', '', 'MaxForce', 'odblok'),
(20, 'Letrozole 50 tabletek 2.5 mg MaxForce', 180, '/img/produkty/let_od.png', '', '180', 'odblok'),
(21, 'Tamoxifen 20mg 50tab MaxForce', 90, '/img/produkty/tam_od.png', '', 'MaxForce', 'odblok'),
(22, 'Proviron 25mg 50tab MaxForce', 140, '/img/produkty/pro_od.png', '', 'MaxForce', 'odblok'),
(23, 'HCG Imperial 5000 MuscleBoss', 75, '/img/produkty/hcg_od.png', '', 'MuscleBoss', 'odblok'),
(24, 'Clomiphene Citrate', 55, '/img/produkty/clo_od.png', '', 'MuscleBoss', 'odblok');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id_zamowienia` int(11) NOT NULL,
  `id_klienta` int(11) NOT NULL,
  `zamowienie` text NOT NULL,
  `cena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id_zamowienia`, `id_klienta`, `zamowienie`, `cena`) VALUES
(3, 1, '4,3', 220),
(4, 1, '3,3,3,3,4,4,3,3,3,3,9', 1410),
(5, 1, '4,3,3', 360),
(6, 1, '4,24,3', 275);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id_klienta`),
  ADD KEY `id_klienta` (`id_klienta`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id_produktu`),
  ADD KEY `id_produktu` (`id_produktu`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id_zamowienia`),
  ADD KEY `id_zamowienia` (`id_zamowienia`),
  ADD KEY `id_klienta` (`id_klienta`);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `zamowienia_ibfk_1` FOREIGN KEY (`id_klienta`) REFERENCES `klienci` (`id_klienta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
