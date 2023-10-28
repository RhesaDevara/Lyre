<?php
    session_start();
    include 'koneksi_pdo.php';
    $posisi = $_POST['posisi'];
    $departemen = $_POST['departemen'];
    $deskripsi = $_POST['deskripsi_pekerjaan'];
    $gaji = $_POST['gaji'];
    $lokasi = $_POST['lokasi_pekerjaan'];
    $jumlah_pertanyaan = $_POST['jumlah_pertanyaan'];
    $today = date("Y-m-d");

    $id_perusahaan = $_SESSION['company']['id_perusahaan'];

    $sql = $koneksiPdo -> prepare("INSERT INTO lowongan_pekerjaan (id_perusahaan, posisi, departemen, deskripsi_pekerjaan, gaji, lokasi_pekerjaan, tanggal_posting)
    values('$id_perusahaan', '$posisi', '$departemen', '$deskripsi', '$gaji' , '$lokasi', '$today')");

    $sql -> execute();

    header('location:our_vacancy.php');
?>