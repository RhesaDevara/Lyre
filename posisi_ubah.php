<?php
include 'navbar.php';

$ambil = $koneksi->query("SELECT * FROM posisi WHERE id_posisi='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Position</title>
</head>
<body>
    <form method="post">
    <div class="mt-5 px-5">
    <div class="mb-3">
        <label for="name" class="form-label">Position Name</label>
        <input type="text" class="form-control" name="name" value="<?php echo $pecah['nama_posisi']; ?>" placeholder="Enter position name" required>
    </div>
    <div class="mb-3">
        <button name="ubah" type="submit" class="form-control btn btn-primary">Change Position</button>
    </div>
    </div>
</form>
</body>
</html>

<?php
if (isset($_POST['ubah'])) {

  $nama = $_POST['name'];

  $koneksi->query("UPDATE posisi SET nama_posisi='$nama' WHERE id_posisi='$_GET[id]'");
  echo "<script>alert('Berhasil Diubah');</script>";
  echo "<script>location='posisi.php';</script>";
}

?>