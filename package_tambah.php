<?php
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Package</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/css/crud.css">
</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="text-left mb-3 mt-3">
                    <a href="package.php" title="Back To Package List" data-toggle="tooltip"><i
                            class="fa-solid fa-arrow-left fa-2xl" style="color: #20444F;"></i></a>
                </div>
                <div class="table-title">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2>Add <b>Package</b></h2>
                        </div>
                    </div>
                </div>
                <form method="POST">
                    <div class="mb-3">
                        <label for="packageName" class="form-label">Package Name</label>
                        <input type="text" class="form-control" id="packageName" name="packageName"
                            placeholder="Enter package name" required>
                    </div>
                    <div class="mb-3">
                        <label for="kuota" class="form-label">Kuota</label>
                        <input type="number" class="form-control" id="kuota" name="kuota" min="1"
                            placeholder="Enter kuota" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" min="1"
                            placeholder="Enter Harga" required>
                    </div>
                    <div class="text-left">
                        <button type="submit" name="tambah" class="btn btn-success form-control">Add Package</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>

</html>


<?php
if (isset($_POST["tambah"])) {
    $namaPaket = $_POST["packageName"];
    $kuota = $_POST["kuota"];
    $harga = $_POST["harga"];
    $koneksi->query("INSERT INTO paket (nama_paket, kuota ,harga) VALUES ('$namaPaket', '$kuota', '$harga')");

    echo "<div class='alert-info alert-info'>Data Tersimpan</div>";
    echo "<script>location='package.php';</script>";
}

?>