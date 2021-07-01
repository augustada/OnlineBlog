-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 01 Tem 2021, 22:41:44
-- Sunucu sürümü: 10.4.17-MariaDB
-- PHP Sürümü: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `blog`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `icerik`
--

CREATE TABLE `icerik` (
  `icerik_id` int(11) NOT NULL,
  `konu_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `icerik` text NOT NULL,
  `resim` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `icerik`
--

INSERT INTO `icerik` (`icerik_id`, `konu_id`, `username`, `icerik`, `resim`, `created_at`, `updated_at`) VALUES
(17, 5, 'admin', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.', 'purple-sky-02.jpg', '2021-06-24 18:18:42', '2021-06-24 19:13:25'),
(18, 6, 'admin', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.Lorem ipsum dolor si', 'purple-sky-02.jpg', '2021-06-24 18:45:37', '2021-06-24 19:13:25'),
(19, 1, 'admin', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.', 'avatar4.jpg', '2021-06-24 19:01:35', '2021-06-27 19:26:29'),
(20, 6, 'admin', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.', 'linux-distro.jpg', '2021-06-24 19:12:16', '2021-06-24 19:12:16'),
(21, 11, 'admin', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.', 'image6.png', '2021-06-24 19:12:43', '2021-06-29 17:38:27'),
(23, 9, 'deneme', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.', '61613-98571.jpg', '2021-06-25 16:15:53', '2021-06-25 16:15:53'),
(24, 10, 'administor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.', '806581.jpg', '2021-06-25 17:36:19', '2021-07-01 20:41:16'),
(25, 7, 'administor', 'x  (apsis)  ekseni,  üzerindeki  noktaların  ordinatları sıfırdır. Yani, (x, 0) noktası, x ekseni üzerindedir. y  (ordinat)  ekseni  üzerindeki  noktaların  apsisleri sıfırdır. Yani, (0, y) noktası y ekseni üzerindedir. O(Orijin) başlangıç noktasının', 'image2.jpg', '2021-06-27 14:57:21', '2021-07-01 20:41:16');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `konu`
--

CREATE TABLE `konu` (
  `konu_id` int(11) NOT NULL,
  `konu_ad` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `konu`
--

INSERT INTO `konu` (`konu_id`, `konu_ad`) VALUES
(1, 'Eğitim'),
(2, 'Üniversite'),
(3, 'Roman'),
(4, 'Kodlama'),
(5, 'PHP'),
(6, 'Java101'),
(7, 'Matematik'),
(8, '90\'lar Pop'),
(9, 'Ari Borakas'),
(10, 'Hayatı Kodlama'),
(11, 'Didomido'),
(12, 'Big Brother');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `user_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`user_id`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '1234567', '2021-06-23 19:04:44', '2021-07-01 20:40:32'),
(2, 'administor', 'administor@gmail.com', '1234567', '2021-06-25 16:06:26', '2021-07-01 20:40:24');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oylama`
--

CREATE TABLE `oylama` (
  `rate_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `icerik_id` int(11) NOT NULL,
  `rateIndex` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `oylama`
--

INSERT INTO `oylama` (`rate_id`, `user_id`, `icerik_id`, `rateIndex`, `created_at`) VALUES
(56, 2, 20, 5, '2021-07-01 18:02:48'),
(57, 2, 21, 5, '2021-07-01 18:09:22'),
(59, 2, 23, 2, '2021-07-01 18:17:34'),
(62, 2, 17, 1, '2021-07-01 18:28:11'),
(64, 2, 19, 5, '2021-07-01 18:38:54'),
(79, 2, 18, 5, '2021-07-01 18:52:44'),
(80, 1, 25, 4, '2021-07-01 19:03:02'),
(81, 1, 24, 2, '2021-07-01 19:03:13'),
(83, 1, 23, 5, '2021-07-01 19:08:41');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `icerik`
--
ALTER TABLE `icerik`
  ADD PRIMARY KEY (`icerik_id`);

--
-- Tablo için indeksler `konu`
--
ALTER TABLE `konu`
  ADD PRIMARY KEY (`konu_id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`user_id`);

--
-- Tablo için indeksler `oylama`
--
ALTER TABLE `oylama`
  ADD PRIMARY KEY (`rate_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `icerik`
--
ALTER TABLE `icerik`
  MODIFY `icerik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Tablo için AUTO_INCREMENT değeri `konu`
--
ALTER TABLE `konu`
  MODIFY `konu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `oylama`
--
ALTER TABLE `oylama`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
