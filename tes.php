<?php
include 'navbar.php';

$id_pengguna = $_SESSION['user']['id_pengguna'];
$id_lamaran = $_GET['id_lamaran'];
$id_lowongan = $_GET['id_lowongan'];

$sqlCountSoal = $koneksiPdo->prepare("SELECT * FROM soal where id_lowongan = '$id_lowongan'");
$sqlCountSoal->execute();
$countSoal = $sqlCountSoal->rowCount();
echo $countSoal;

$sqlSoal = $koneksiPdo->prepare("SELECT * FROM soal where id_lowongan = '$id_lowongan'");
$sqlSoal->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        <div class="container pt-5">
            <?php
            $i = 1;
            while ($dataSoal = $sqlSoal->fetch()) { ?>
                <div class="mb-5">
                    <div class="list-group mt-3 mb-4 shadow rounded">
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row">
                                    <div>
                                        <h5 class="mb-1">
                                            <?php echo $i . ". " . $dataSoal['pertanyaan']; ?>
                                            <input type="text" name="id_soal" value="<?php echo $dataSoal['id_soal']; ?>" hidden>
                                            <input type="text" name="jawaban<?php echo $i; ?>" value="<?php echo $dataSoal['jawaban']; ?>" hidden>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <input type="radio" value="A" name="jawaban<?php echo $i; ?>" required> A. <input type="text" value="<?php echo $i; ?>" hidden>
                                <?php echo $dataSoal['pilihan_a']; ?>
                            </div>
                            <div>
                                <input type="radio" value="B" name="jawaban<?php echo $i; ?>"> B.
                                <?php echo $dataSoal['pilihan_b']; ?>
                            </div>
                            <div>
                                <input type="radio" value="C" name="jawaban<?php echo $i; ?>"> C.
                                <?php echo $dataSoal['pilihan_c']; ?>
                            </div>
                            <div>
                                <input type="radio" value="D" name="jawaban<?php echo $i; ?>"> D.
                                <?php echo $dataSoal['pilihan_d']; ?>
                            </div>
                        </div>
                    </div>
                <?php $i++;
            } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary form-control">
                </div>
    </form>
</body>

<?php

$benar = 0;
if (isset($_POST['submit'])) {
    for ($j = 1; $j <= $countSoal; $j++) {
        $id_soal = $_POST['id_soal'];
        $kunciJawaban = $_POST['jawaban' . $j];
        $jawaban = $_POST['jawaban' . $j];
        if ($jawaban == $kunciJawaban) {
            $benar++;
        }
    }

    $nilai = $benar / $countSoal * 100;

    $sqlHasil = $koneksiPdo->prepare("INSERT INTO hasil_tes(id_lamaran, id_lowongan, nilai) values ('$id_lamaran','$id_lowongan', '$nilai')");
    $sqlHasil->execute();

    if ($nilai > 80) {
        $sqlUpdate = $koneksiPdo->prepare("UPDATE lamaran set status_lamaran = 'Diterima' where id_lamaran = '$id_lamaran'");
        $sqlUpdate->execute();
    } else {
        $sqlUpdate = $koneksiPdo->prepare("UPDATE lamaran set status_lamaran = 'Nilai Kurang' where id_lamaran = '$id_lamaran'");
        $sqlUpdate->execute();
    }

    echo "<script>alert('Tes Selesai');</script>";
    echo "<script>location='my_application.php';</script>";
}
?>

</html>