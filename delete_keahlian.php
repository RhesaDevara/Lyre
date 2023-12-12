<?php
include 'koneksi_pdo.php';
$id_keahlian = $_GET['id_keahlian'];

$deleteKeahlian = $koneksiPdo->prepare("DELETE FROM keahlian where id_keahlian = '$id_keahlian'");
$deleteKeahlian->execute();

echo "<script>alert('Data Keahlian berhasil dihapus');</script>";
echo "<script>location='user_profile.php';</script>";
