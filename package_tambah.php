<?php
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Paket</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/css/crud.css">
</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="text-left mb-3 mt-3">
                    <a href="package.php" title="Back To Package List" data-toggle="tooltip"><i class="fa-solid fa-arrow-left fa-2xl" style="color: #20444F;"></i></a>
                </div>
                <div class="table-title">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2>Tambah <b>Paket</b></h2>
                        </div>
                    </div>
                </div>
                <form method="POST">
                    <div class="mb-3">
                        <label for="packageName" class="form-label">Nama Paket</label>
                        <input type="text" class="form-control" id="packageName" name="packageName" placeholder="Masukkan nama paket" required>
                    </div>
                    <div class="mb-3">
                        <label for="kuota" class="form-label">Kuota</label>
                        <input type="number" class="form-control" id="kuota" name="kuota" min="1" placeholder="Masukkan jumlah kuota" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" min="1" placeholder="Masukkan harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="packageName" class="form-label">Deskripsi Paket</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi paket" required></textarea>
                    </div>
                    <div class="text-left">
                        <button type="submit" name="tambah" class="btn btn-success w-100">Tambah Paket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>


<?php
if (isset($_POST["tambah"])) {
    $namaPaket = $_POST["packageName"];
    $kuota = $_POST["kuota"];
    $harga = $_POST["harga"];
    $deskripsi = $_POST["deskripsi"];
    $koneksi->query("INSERT INTO paket (nama_paket, kuota ,harga,deskripsi_paket) VALUES ('$namaPaket', '$kuota', '$harga','$deskripsi')");


    echo "<script>alert('Paket berhasil Ditambah');</script>";
    echo "<script>location='package.php';</script>";
}

?>