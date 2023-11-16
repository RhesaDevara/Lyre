-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2023 at 02:03 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lyre`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `email`, `password`) VALUES
(1, 'Rhesa', 'rhesadevaraw@gmail.com', 'admin'),
(2, 'Devara', 'rhesadevar@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_tes`
--

CREATE TABLE `hasil_tes` (
  `id_hasil_tes` int(11) NOT NULL,
  `id_lamaran` int(11) DEFAULT NULL,
  `id_lowongan` int(11) DEFAULT NULL,
  `nilai` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keahlian`
--

CREATE TABLE `keahlian` (
  `id_keahlian` int(11) NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `nama_keahlian` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi_perusahaan`
--

CREATE TABLE `konfirmasi_perusahaan` (
  `id_konfirmasi` int(11) NOT NULL,
  `id_admin` int(5) NOT NULL,
  `id_perusahaan` int(5) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status_akun` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konfirmasi_perusahaan`
--

INSERT INTO `konfirmasi_perusahaan` (`id_konfirmasi`, `id_admin`, `id_perusahaan`, `nama_admin`, `nama_perusahaan`, `tanggal_mulai`, `tanggal_selesai`, `status_akun`) VALUES
(2, 1, 3, 'Rhesa', 'PT. SJM', '0000-00-00', '2023-10-28', 'Aktif'),
(3, 1, 1, 'Rhesa', 'PT. Lyre', '0000-00-00', '0000-00-00', 'Aktif'),
(4, 1, 2, 'Rhesa', 'asdf', '0000-00-00', '0000-00-00', 'Sedang Review');

-- --------------------------------------------------------

--
-- Table structure for table `lamaran`
--

CREATE TABLE `lamaran` (
  `id_lamaran` int(11) NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `id_lowongan` int(11) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `status_lamaran` varchar(45) DEFAULT NULL,
  `informasi_hasil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lowongan_pekerjaan`
--

CREATE TABLE `lowongan_pekerjaan` (
  `id_lowongan` int(11) NOT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  `posisi` varchar(50) DEFAULT NULL,
  `departemen` varchar(50) NOT NULL,
  `deskripsi_pekerjaan` varchar(255) DEFAULT NULL,
  `gaji` int(20) DEFAULT NULL,
  `lokasi_pekerjaan` varchar(50) DEFAULT NULL,
  `tanggal_posting` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lowongan_pekerjaan`
--

INSERT INTO `lowongan_pekerjaan` (`id_lowongan`, `id_perusahaan`, `posisi`, `departemen`, `deskripsi_pekerjaan`, `gaji`, `lokasi_pekerjaan`, `tanggal_posting`) VALUES
(1, 1, 'Mobile Developer', 'IT Operation', 'Membuat aplikasi mobile', 10000000, 'Jakarta', '2023-10-28'),
(2, 1, 'Backend Developer', 'IT Backend', 'Bikin beken', 10000000, 'Jakarta', '2023-10-28'),
(3, 1, 'Front End Developer', 'IT Front End', 'Bikin fronen', 11000000, 'Bekasi', '2023-10-28');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(50) DEFAULT NULL,
  `kuota` int(5) DEFAULT NULL,
  `harga` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `kuota`, `harga`) VALUES
(1, 'Paket Standar', 2, 500000),
(2, 'Paket Medium', 5, 1000000),
(3, 'Paket Superior', 15, 2000000),
(4, 'Paket Ultra', 40, 4000000);

-- --------------------------------------------------------

--
-- Table structure for table `pengalaman`
--

CREATE TABLE `pengalaman` (
  `id_pengalaman` int(11) NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `posisi` varchar(50) DEFAULT NULL,
  `nama_perusahaan` varchar(50) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `durasi` int(5) DEFAULT NULL,
  `lokasi_pekerjaan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nik` varchar(45) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nomor_telepon` varchar(20) DEFAULT NULL,
  `pendidikan_terakhir` varchar(20) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `about` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nik`, `nama`, `tanggal_lahir`, `email`, `password`, `nomor_telepon`, `pendidikan_terakhir`, `alamat`, `about`) VALUES
(1, '123123123', 'Gacor', '2023-10-28', 'vmechanic12@gmail.com', '123', '123', 'Apa Aja', 'asdfasdf', 'Saya adalah seorang profesional bersemangat yang memiliki hasrat untuk terus belajar dan berkembang dalam dunia teknologi. Dengan latar belakang dalam pengembangan perangkat lunak dan antarmuka pengguna, saya memiliki keterampilan yang kuat dalam pemrograman dan desain. Keahlian saya mencakup pengembangan aplikasi web dan mobile menggunakan berbagai teknologi termasuk HTML, CSS, JavaScript, dan React.  Selain keterampilan teknis, saya juga memiliki kemampuan komunikasi yang baik dan mampu bekerja secara efektif dalam tim. Saya percaya bahwa kolaborasi dan pemikiran kreatif adalah kunci untuk mencapai solusi yang inovatif. Saya senang bekerja dalam lingkungan yang dinamis dan memiliki komitmen untuk memberikan hasil terbaik.');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(50) DEFAULT NULL,
  `email_perusahaan` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nomor_telepon` varchar(20) DEFAULT NULL,
  `alamat_perusahaan` varchar(100) DEFAULT NULL,
  `deskripsi_perusahaan` mediumtext DEFAULT NULL,
  `status_akun` varchar(20) DEFAULT NULL,
  `kuota` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `nama_perusahaan`, `email_perusahaan`, `password`, `nomor_telepon`, `alamat_perusahaan`, `deskripsi_perusahaan`, `status_akun`, `kuota`) VALUES
(1, 'PT. Lyre', 'lyre@gmail.com', '123', '(021)88977078', 'Perum. Vila Indah Permai Blok E5 No.3 Jln. Mahakam RT.006 RW.033 Bekasi Utara', 'PT. Lyre adalah perusahaan yang menghadirkan solusi daring untuk memudahkan pencarian dan perekrutan tenaga kerja. Dengan fokus pada platform lowongan pekerjaan, PT. Lyre menawarkan pengalaman pengguna yang intuitif dan efisien.\n\nMelalui website inovatifnya, PT. Lyre menyediakan mesin pencarian pekerjaan yang cepat, memungkinkan pencari kerja menemukan peluang sesuai dengan kualifikasi mereka. Pengguna dapat membuat profil pekerja interaktif, menyoroti pengalaman dan keterampilan mereka.\n\nFitur notifikasi memastikan pengguna selalu update dengan lowongan terbaru sesuai preferensi mereka. Proses lamaran pekerjaan di PT. Lyre disederhanakan, memungkinkan pengguna mengunggah dokumen dengan mudah.\n\nSetiap perusahaan yang memasang lowongan memiliki halaman profil yang komprehensif, memberikan wawasan tentang budaya perusahaan dan manfaat karyawan. Feedback dan evaluasi pengguna diterima, menjamin peningkatan kualitas layanan.\n\nDengan komitmen untuk mempertemukan talenta potensial dan pemberi kerja, PT. Lyre menjadi mitra utama dalam menciptakan hubungan yang saling menguntungkan di dunia kerja.', 'Aktif', 15),
(2, 'asdf', 'asdf@gmail.com', '123', '123', 'asdf', 'asdf', 'Aktif', 1),
(3, 'PT. SJM', 'sjm@gmail.com', '123', '123', 'SJM', 'SJMMMMM', 'Aktif', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id_sertifikat` int(11) NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `nama_sertifikat` varchar(50) DEFAULT NULL,
  `nama_penerbit` varchar(50) DEFAULT NULL,
  `tanggal_terbit` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `id_lowongan` int(11) DEFAULT NULL,
  `pertanyaan` varchar(255) DEFAULT NULL,
  `pilihan_a` varchar(45) DEFAULT NULL,
  `pilihan_b` varchar(45) DEFAULT NULL,
  `pilihan_c` varchar(45) DEFAULT NULL,
  `pilihan_d` varchar(45) DEFAULT NULL,
  `jawaban` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `id_lowongan`, `pertanyaan`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `jawaban`) VALUES
(7, 1, '121', '232', '343', '454', '565', 'B'),
(13, 1, 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'A'),
(14, 1, 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'D');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `hasil_tes`
--
ALTER TABLE `hasil_tes`
  ADD PRIMARY KEY (`id_hasil_tes`),
  ADD KEY `id_lamaran_tes_idx` (`id_lamaran`),
  ADD KEY `id_lowongan_tes_idx` (`id_lowongan`);

--
-- Indexes for table `keahlian`
--
ALTER TABLE `keahlian`
  ADD PRIMARY KEY (`id_keahlian`),
  ADD KEY `id_pengguna_pendidikan_idx` (`id_pengguna`);

--
-- Indexes for table `konfirmasi_perusahaan`
--
ALTER TABLE `konfirmasi_perusahaan`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indexes for table `lamaran`
--
ALTER TABLE `lamaran`
  ADD PRIMARY KEY (`id_lamaran`),
  ADD KEY `id_pengguna_idx` (`id_pengguna`),
  ADD KEY `id_lowongan_lamaran_idx` (`id_lowongan`);

--
-- Indexes for table `lowongan_pekerjaan`
--
ALTER TABLE `lowongan_pekerjaan`
  ADD PRIMARY KEY (`id_lowongan`),
  ADD KEY `id_perusahaan_idx` (`id_perusahaan`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `pengalaman`
--
ALTER TABLE `pengalaman`
  ADD PRIMARY KEY (`id_pengalaman`),
  ADD KEY `id_pengguna_idx` (`id_pengguna`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id_sertifikat`),
  ADD KEY `id_pengguna_sertifikat_idx` (`id_pengguna`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `id_lowongan_soal_idx` (`id_lowongan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hasil_tes`
--
ALTER TABLE `hasil_tes`
  MODIFY `id_hasil_tes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keahlian`
--
ALTER TABLE `keahlian`
  MODIFY `id_keahlian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konfirmasi_perusahaan`
--
ALTER TABLE `konfirmasi_perusahaan`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lamaran`
--
ALTER TABLE `lamaran`
  MODIFY `id_lamaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lowongan_pekerjaan`
--
ALTER TABLE `lowongan_pekerjaan`
  MODIFY `id_lowongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengalaman`
--
ALTER TABLE `pengalaman`
  MODIFY `id_pengalaman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id_sertifikat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_tes`
--
ALTER TABLE `hasil_tes`
  ADD CONSTRAINT `id_lamaran_tes` FOREIGN KEY (`id_lamaran`) REFERENCES `lamaran` (`id_lamaran`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_lowongan_tes` FOREIGN KEY (`id_lowongan`) REFERENCES `lowongan_pekerjaan` (`id_lowongan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `keahlian`
--
ALTER TABLE `keahlian`
  ADD CONSTRAINT `id_pengguna_pendidikan` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lamaran`
--
ALTER TABLE `lamaran`
  ADD CONSTRAINT `id_lowongan_lamaran` FOREIGN KEY (`id_lowongan`) REFERENCES `lowongan_pekerjaan` (`id_lowongan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_pengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lowongan_pekerjaan`
--
ALTER TABLE `lowongan_pekerjaan`
  ADD CONSTRAINT `id_perusahaan` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pengalaman`
--
ALTER TABLE `pengalaman`
  ADD CONSTRAINT `id_pengguna_pengalaman` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD CONSTRAINT `id_pengguna_sertifikat` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `id_lowongan_soal` FOREIGN KEY (`id_lowongan`) REFERENCES `lowongan_pekerjaan` (`id_lowongan`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
