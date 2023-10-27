<?php
require 'koneksi.php';

$ambil = $koneksi->query("SELECT * FROM paket WHERE id_paket='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM paket WHERE id_paket='$_GET[id]'");

echo "<script>alert('Berhasil Dihapus');</script>";
echo "<script>location='package.php';</script>"
    ?>