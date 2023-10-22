<?php
    include 'navbar.php';
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
        <input type="text" class="form-control" name="name" placeholder="Enter position name" required>
    </div>
    <div class="mb-3 text-center">
        <button name="tambah" type="submit" class="form-control btn btn-primary">Add Position</button>
    </div>
    </div>
</form>
</body>
</html>


<?php
if (isset($_POST["tambah"])) {
    $nama = $_POST["name"];
    $koneksi->query("INSERT INTO posisi (nama_posisi) VALUES ('$nama')");

    echo "<div class='alert-info alert-info'>Data Tersimpan</div>";
    echo "<script>location='posisi.php';</script>";
}

?>