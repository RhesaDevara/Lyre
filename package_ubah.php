<?php
include 'navbar.php';

$ambil = $koneksi->query("SELECT * FROM paket WHERE id_paket='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Packages</title>
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
                            <h2>Edit <b>Package</b></h2>
                        </div>
                    </div>
                </div>
                <form method="POST">
                    <div class="mb-3">
                        <label for="packageName" class="form-label">Package Name</label>
                        <input type="text" class="form-control" id="packageName" name="packageName"
                            placeholder="Enter package name" value="<?php echo $pecah['nama_paket']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="kuota" class="form-label">Kuota</label>
                        <input type="number" class="form-control" id="kuota" name="kuota" min="1"
                            placeholder="Enter kuota" value="<?php echo $pecah['kuota']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" min="1"
                            placeholder="Enter Harga" value="<?php echo $pecah['harga']; ?>" required>
                    </div>
                    <div class="text-left">
                        <button type="submit" name="ubah" class="btn btn-primary form-control">Change Package</button>
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
if (isset($_POST['ubah'])) {

    $namaPaket = $_POST['packageName'];
    $kuota = $_POST['kuota'];
    $harga = $_POST['harga'];

    $koneksi->query("UPDATE paket SET nama_paket='$namaPaket', kuota='$kuota', harga='$harga' WHERE id_paket='$_GET[id]'");
    echo "<script>alert('Berhasil Diubah');</script>";
    echo "<script>location='package.php';</script>";
}

?>