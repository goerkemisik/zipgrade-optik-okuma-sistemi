-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 09 Eki 2025, 21:38:51
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `mtuosds`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cevap_anahtari`
--

CREATE TABLE `cevap_anahtari` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sinav_id` bigint(20) UNSIGNED NOT NULL,
  `cevaplar` varchar(512) NOT NULL,
  `num_soru` int(11) NOT NULL,
  `num_secenek` int(11) NOT NULL DEFAULT 5,
  `roi` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `cevap_anahtari`
--

INSERT INTO `cevap_anahtari` (`id`, `sinav_id`, `cevaplar`, `num_soru`, `num_secenek`, `roi`) VALUES
(6, 2, 'B,B,A,D,D', 5, 5, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `duyuru`
--

CREATE TABLE `duyuru` (
  `id` int(10) UNSIGNED NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `icerik` mediumtext NOT NULL,
  `yayin_tarihi` datetime DEFAULT NULL,
  `bitis_tarihi` datetime DEFAULT NULL,
  `enstitu` varchar(120) DEFAULT NULL,
  `onemli` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `duyuru`
--

INSERT INTO `duyuru` (`id`, `baslik`, `icerik`, `yayin_tarihi`, `bitis_tarihi`, `enstitu`, `onemli`) VALUES
(1, 'Sistem Bakımı', '<p>Bu akşam 22:00-23:00 bakım var.</p>', '2025-09-05 16:24:54', '2025-09-12 16:24:54', 'Enstitü', 1),
(2, 'Yeni Duyuru', '<p>Hoş geldiniz.</p>', '2025-09-05 16:24:00', NULL, 'Enstitü', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenci`
--

CREATE TABLE `ogrenci` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tcno` char(11) DEFAULT NULL,
  `kullaniciadi` varchar(64) DEFAULT NULL,
  `sifre` varchar(255) NOT NULL,
  `ad` varchar(100) DEFAULT NULL,
  `soyad` varchar(100) DEFAULT NULL,
  `eposta` varchar(190) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fotograf` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Tablo döküm verisi `ogrenci`
--

INSERT INTO `ogrenci` (`id`, `tcno`, `kullaniciadi`, `sifre`, `ad`, `soyad`, `eposta`, `created_at`, `updated_at`, `fotograf`) VALUES
(2, '12345678901', 'isikgorkem', '$2y$10$XG4hA/LeqkMnr9lctn.o9OPkHAuBZ/yACeTvJi5KRVl0RlVyL3qKm', 'Görkem', 'Işık', 'isikgorkem@gmail.com', '2025-10-09 19:36:22', '2025-10-09 19:36:22', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenci_sinav_takvim`
--

CREATE TABLE `ogrenci_sinav_takvim` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ogrenci_id` bigint(20) UNSIGNED NOT NULL,
  `ders_adi` varchar(150) NOT NULL,
  `tur` enum('vize','final','telafi','quiz','ödev','diğer') NOT NULL DEFAULT 'vize',
  `tarih` date NOT NULL,
  `saat` time DEFAULT NULL,
  `yer` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenci_sonuc`
--

CREATE TABLE `ogrenci_sonuc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ogrenci_id` bigint(20) UNSIGNED NOT NULL,
  `sinav_id` bigint(20) UNSIGNED NOT NULL,
  `dogru` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `yanlis` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `bos` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `puan` int(11) NOT NULL,
  `cozulensoru` int(11) DEFAULT 0,
  `optik_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `optik`
--

CREATE TABLE `optik` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sinav_id` bigint(20) UNSIGNED NOT NULL,
  `ogrenci_id` bigint(20) UNSIGNED NOT NULL,
  `dosya_yolu` varchar(500) DEFAULT NULL,
  `icerik` longblob DEFAULT NULL,
  `mime_type` varchar(100) DEFAULT 'image/png',
  `sifreli` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sifre_sifirlama`
--

CREATE TABLE `sifre_sifirlama` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kullanici_id` bigint(20) UNSIGNED NOT NULL,
  `token` char(64) NOT NULL,
  `expire_date` datetime NOT NULL,
  `kullanici_tipi` enum('ogrenci','yetkili') NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sinav`
--

CREATE TABLE `sinav` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad` varchar(200) NOT NULL,
  `ders_adi` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `tarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `sinav`
--

INSERT INTO `sinav` (`id`, `ad`, `ders_adi`, `tarih`) VALUES
(1, '1. Dönem Vize', 'Matematik', '2025-03-15'),
(2, '1. Dönem Final', 'Fizik', '2025-06-25');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yardim_destek`
--

CREATE TABLE `yardim_destek` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ogrenci_id` bigint(20) UNSIGNED NOT NULL,
  `konu` varchar(200) NOT NULL,
  `aciklama` text NOT NULL,
  `yanit` text DEFAULT NULL,
  `yanitlayan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `yanit_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yetkililer`
--

CREATE TABLE `yetkililer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kullanici_adi` varchar(64) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  `ad` varchar(100) DEFAULT NULL,
  `soyad` varchar(100) DEFAULT NULL,
  `unvan` varchar(100) DEFAULT NULL,
  `durum` tinyint(1) NOT NULL DEFAULT 1,
  `eposta` varchar(190) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fotograf` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Tablo döküm verisi `yetkililer`
--

INSERT INTO `yetkililer` (`id`, `kullanici_adi`, `sifre`, `ad`, `soyad`, `unvan`, `durum`, `eposta`, `created_at`, `updated_at`, `fotograf`) VALUES
(2, 'admin', '$2y$10$ZiAqnSh7DtPmR054BUibauX2MinuBi5GUuskynmFJM04gcOS7r2b2', 'Görkem', 'Işık', 'Dr. Öğr. Üyesi', 1, 'gorkem.isik@gmail.com', '2025-10-09 19:38:06', '2025-10-09 19:38:06', '');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `cevap_anahtari`
--
ALTER TABLE `cevap_anahtari`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_sinav` (`sinav_id`);

--
-- Tablo için indeksler `duyuru`
--
ALTER TABLE `duyuru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_yayin` (`yayin_tarihi`),
  ADD KEY `idx_onemli` (`onemli`);

--
-- Tablo için indeksler `ogrenci`
--
ALTER TABLE `ogrenci`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_ogr_tcno` (`tcno`),
  ADD UNIQUE KEY `uq_ogr_kullaniciadi` (`kullaniciadi`),
  ADD KEY `idx_ogr_login` (`tcno`,`kullaniciadi`);

--
-- Tablo için indeksler `ogrenci_sinav_takvim`
--
ALTER TABLE `ogrenci_sinav_takvim`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ogrenci_id` (`ogrenci_id`);

--
-- Tablo için indeksler `ogrenci_sonuc`
--
ALTER TABLE `ogrenci_sonuc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ogrenci_id` (`ogrenci_id`),
  ADD KEY `sinav_id` (`sinav_id`),
  ADD KEY `fk_os_optik` (`optik_id`);

--
-- Tablo için indeksler `optik`
--
ALTER TABLE `optik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sinav_id` (`sinav_id`),
  ADD KEY `ogrenci_id` (`ogrenci_id`);

--
-- Tablo için indeksler `sifre_sifirlama`
--
ALTER TABLE `sifre_sifirlama`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_token` (`token`),
  ADD KEY `idx_user` (`kullanici_id`,`kullanici_tipi`);

--
-- Tablo için indeksler `sinav`
--
ALTER TABLE `sinav`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yardim_destek`
--
ALTER TABLE `yardim_destek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_yardim_ogrenci_id` (`ogrenci_id`);

--
-- Tablo için indeksler `yetkililer`
--
ALTER TABLE `yetkililer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kullanici_adi` (`kullanici_adi`),
  ADD KEY `idx_yetkili_login` (`kullanici_adi`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `cevap_anahtari`
--
ALTER TABLE `cevap_anahtari`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `duyuru`
--
ALTER TABLE `duyuru`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenci`
--
ALTER TABLE `ogrenci`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenci_sinav_takvim`
--
ALTER TABLE `ogrenci_sinav_takvim`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenci_sonuc`
--
ALTER TABLE `ogrenci_sonuc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `optik`
--
ALTER TABLE `optik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Tablo için AUTO_INCREMENT değeri `sifre_sifirlama`
--
ALTER TABLE `sifre_sifirlama`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `sinav`
--
ALTER TABLE `sinav`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `yardim_destek`
--
ALTER TABLE `yardim_destek`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `yetkililer`
--
ALTER TABLE `yetkililer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `cevap_anahtari`
--
ALTER TABLE `cevap_anahtari`
  ADD CONSTRAINT `fk_ca_sinav` FOREIGN KEY (`sinav_id`) REFERENCES `sinav` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `ogrenci_sinav_takvim`
--
ALTER TABLE `ogrenci_sinav_takvim`
  ADD CONSTRAINT `fk_takvim_ogrenci` FOREIGN KEY (`ogrenci_id`) REFERENCES `ogrenci` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `ogrenci_sonuc`
--
ALTER TABLE `ogrenci_sonuc`
  ADD CONSTRAINT `fk_os_optik` FOREIGN KEY (`optik_id`) REFERENCES `optik` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `ogrenci_sonuc_ibfk_1` FOREIGN KEY (`ogrenci_id`) REFERENCES `ogrenci` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ogrenci_sonuc_ibfk_2` FOREIGN KEY (`sinav_id`) REFERENCES `sinav` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `optik`
--
ALTER TABLE `optik`
  ADD CONSTRAINT `optik_ibfk_1` FOREIGN KEY (`sinav_id`) REFERENCES `sinav` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `optik_ibfk_2` FOREIGN KEY (`ogrenci_id`) REFERENCES `ogrenci` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `yardim_destek`
--
ALTER TABLE `yardim_destek`
  ADD CONSTRAINT `fk_yardim_ogrenci` FOREIGN KEY (`ogrenci_id`) REFERENCES `ogrenci` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
