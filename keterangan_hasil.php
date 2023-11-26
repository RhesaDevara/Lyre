<?php
include 'navbar.php';

$id_pengguna = $_SESSION['user']['id_pengguna'];

$sqlLamaran = $koneksiPdo->prepare("SELECT * FROM lamaran where id_pengguna = '$id_pengguna'");
$sqlLamaran->execute();

$dataLamaran = $sqlLamaran->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container pt-5">

        <h3> Selamat Anda Lolos! </h3>
        <div class="alert alert-success">
            <?php echo $dataLamaran['informasi_hasil'];
            ?>
        </div>
</body>

</html>