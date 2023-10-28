<?php 
require 'koneksi_pdo.php';
$id_soal = $_GET['id_pertanyaan'];
$sql = $koneksiPdo ->prepare("SELECT * FROM soal where id_soal = '$id_soal'");
$sql ->execute();

$data = $sql -> fetch();
$id_lowongan = $data['id_lowongan'];

$sql1 = $koneksiPdo->prepare("DELETE FROM soal WHERE id_soal='$id_soal'");
$sql1 -> execute();
echo "<script>alert('Berhasil Dihapus');</script>";
echo "<script>location='detail_lowongan.php?id_lowongan=$id_lowongan';</script>"
?>