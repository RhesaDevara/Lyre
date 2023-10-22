<?php 
require 'koneksi.php';

$ambil = $koneksi->query("SELECT * FROM posisi WHERE id_posisi='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM posisi WHERE id_posisi='$_GET[id]'");

echo "<script>alert('Berhasil Dihapus');</script>";
echo "<script>location='posisi.php';</script>"
 ?>