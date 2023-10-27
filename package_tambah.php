<?php
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Package</title>
</head>

<body>
    <form method="post">
        <center>
            <h2 style="margin-top:50px;"> Add New Package </h2>
            <div class="mt-5 px-5" style="width:75%;">
                <div class="mb-3" style="text-align:left;">
                    <label for="name" class="form-label">Package Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter package name" required>

                    <label for="name" class="form-label mt-2">Kuota</label>
                    <input type="number" class="form-control" name="kuota" placeholder="Enter jumlah kuota" required>

                    <label for="name" class="form-label mt-2">Harga</label>
                    <input type="number" class="form-control" name="harga" placeholder="Enter harga paket" required>

                </div>
                <div class="mb-3 text-center">
                    <button name="tambah" type="submit" class="form-control btn btn-primary">Add Package</button>
                </div>
            </div>
    </form>
</body>

</html>


<?php
if (isset($_POST["tambah"])) {
    $nama = $_POST["name"];
    $kuota = $_POST["kuota"];
    $harga = $_POST["harga"];
    $koneksi->query("INSERT INTO package (nama_paket, kuota ,harga) VALUES ('$nama', '$kuota', '$harga')");

    echo "<div class='alert-info alert-info'>Data Tersimpan</div>";
    echo "<script>location='package.php';</script>";
}

?>