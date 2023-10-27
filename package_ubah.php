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
</head>

<body>
    <form method="post">
        <div class="mt-5 px-5">
            <div class="mb-3">
                <label for="name" class="form-label">Package Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $pecah['nama_paket']; ?>" placeholder="Enter package name" required>

                <label for="name" class="form-label">Kuota</label>
                <input type="text" class="form-control" name="kuota" value="<?php echo $pecah['kuota']; ?>" placeholder="Enter jumlah kuota" required>

                <label for="name" class="form-label">Harga</label>
                <input type="text" class="form-control" name="harga" value="<?php echo $pecah['harga']; ?>" placeholder="Enter harga paket" required>
            </div>
            <div class="mb-3">
                <button name="ubah" type="submit" class="form-control btn btn-primary">Change Package</button>
            </div>
        </div>
    </form>
</body>

</html>

<?php
if (isset($_POST['ubah'])) {

    $nama = $_POST['name'];
    $kuota = $_POST['kuota'];
    $harga = $_POST['harga'];

    $koneksi->query("UPDATE paket SET nama_paket='$nama', kuota='$kuota', harga='$harga' WHERE id_paket='$_GET[id]'");
    echo "<script>alert('Berhasil Diubah');</script>";
    echo "<script>location='package.php';</script>";
}

?>