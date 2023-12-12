<?php
session_start();
include 'koneksi_pdo.php';
$posisi = $_POST['posisi'];
$departemen = $_POST['departemen'];
$deskripsi = $_POST['deskripsi_pekerjaan'];
$gaji = $_POST['gaji'];
$lokasi = $_POST['lokasi_pekerjaan'];
$today = date("Y-m-d");

$id_perusahaan = $_SESSION['company']['id_perusahaan'];

$sql = $koneksiPdo->prepare("INSERT INTO lowongan_pekerjaan (id_perusahaan, posisi, departemen, deskripsi_pekerjaan, gaji, lokasi_pekerjaan, tanggal_posting, status_lowongan)
    values('$id_perusahaan', '$posisi', '$departemen', '$deskripsi', '$gaji' , '$lokasi', '$today', 'Non Aktif')");

$sql->execute();

$kuotaAwal = $_SESSION['company']['kuota'];
$kuotaSekarang = $kuotaAwal - 1;
$sql1 = $koneksiPdo->prepare("UPDATE perusahaan set kuota='$kuotaSekarang' where id_perusahaan = '$id_perusahaan'");
$sql1->execute();

$sql2 = $koneksiPdo->prepare("SELECT * FROM perusahaan where id_perusahaan = '$id_perusahaan'");
$sql2->execute();

$_SESSION['company'] = $sql2->fetch();

$sql3 = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where id_perusahaan = '$id_perusahaan' AND posisi = '$posisi' AND departemen = '$departemen' AND 
gaji = '$gaji' AND lokasi_pekerjaan = '$lokasi' AND tanggal_posting = '$today'");
$sql3->execute();

$dataLowongan = $sql3->fetch();

$id_lowongan = $dataLowongan['id_lowongan'];

echo "<script>alert('Lowongan berhasil dibuat!');</script>";
echo "<script>location='detail_lowongan.php?id_lowongan=$id_lowongan';</script>";
