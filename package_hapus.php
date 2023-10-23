<?php 
require 'koneksi.php';

$ambil = $koneksi->query("SELECT * FROM package WHERE id_package='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM package WHERE id_package='$_GET[id]'");

echo "<script>alert('Berhasil Dihapus');</script>";
echo "<script>location='package.php';</script>"
 ?>