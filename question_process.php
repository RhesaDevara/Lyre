<?php
    include 'koneksi_pdo.php';
    $jumlah_pertanyaan = $_POST['jumlah_pertanyaan'];
    $id_lowongan = $_GET['id_lowongan'];
    for($i = 1;$i <= $jumlah_pertanyaan;$i++){
        $soal = $_POST['soalno'.$i];
        $jawaban = $_POST['pgno'.$i];
        $pgA = $_POST['a'.$i];
        $pgB = $_POST['b'.$i];
        $pgC = $_POST['c'.$i];
        $pgD = $_POST['d'.$i];

        $sql = $koneksiPdo ->prepare("INSERT INTO soal (id_lowongan, pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban) values ('$id_lowongan', '$soal','$pgA', '$pgB', '$pgC', '$pgD', '$jawaban')");
        $sql ->execute();

    }
?>