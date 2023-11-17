<?php
    include 'koneksi_pdo.php';
    $id_pendidikan = $_GET['id_pendidikan'];
    
    $deletePendidikan = $koneksiPdo -> prepare("DELETE from pendidikan where id_pendidikan = '$id_pendidikan'");
    $deletePendidikan -> execute();
    
    echo "<script>alert('Data Pendidikan berhasil dihapus');</script>";
    echo "<script>location='user_profile.php';</script>";
?>