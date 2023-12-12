<?php
include 'koneksi_pdo.php';
$id_pengalaman = $_GET['id_pengalaman'];

$deletePengalaman = $koneksiPdo->prepare("DELETE FROM pengalaman where id_pengalaman = '$id_pengalaman'");
$deletePengalaman->execute();

echo "<script>alert('Data Pengalaman berhasil dihapus');</script>";
echo "<script>location='user_profile.php';</script>";
