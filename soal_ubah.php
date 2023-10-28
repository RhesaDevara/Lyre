<?php
include 'navbar.php';
$id_soal = $_GET['id_pertanyaan'];
$sql = $koneksiPdo->prepare("SELECT * FROM soal WHERE id_soal='$id_soal'");
$sql ->execute();
$data = $sql->fetch();
$id_lowongan = $data['id_lowongan'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Admin</title>
    <style>
        label, input{
            color: black;
        }
        </style>
</head>
<body>
    <form method="post">
    <div class="mt-5 px-5">
    <div class="mb-3">
        <label for="name" class="form-label">Pertanyaan</label>
        <input type="text" class="form-control" name="pertanyaan" value="<?php echo $data['pertanyaan']; ?>" placeholder="Enter your full name" required>
    </div>
    <div class="mb-3">
        <label for="pilihan_a" class="form-label">Pilihan A</label>
        <input type="text" class="form-control" name="pilihan_a" value="<?php echo $data['pilihan_a']; ?>" placeholder="Enter your email" required>
    </div>
    <div class="mb-3">
        <label for="pilihan_b" class="form-label">Pilihan B</label>
        <input type="text" class="form-control" name="pilihan_b" value="<?php echo $data['pilihan_b']; ?>" placeholder="Enter your password" required>
    </div>
    <div class="mb-3">
        <label for="pilihan_c" class="form-label">Pilihan C</label>
        <input type="text" class="form-control" name="pilihan_c" value="<?php echo $data['pilihan_c']; ?>" placeholder="Confirm your password" required>
    </div>
    <div class="mb-3">
        <label for="pilihan_d" class="form-label">Pilihan D</label>
        <input type="text" class="form-control" name="pilihan_d" value="<?php echo $data['pilihan_d']; ?>" placeholder="Confirm your password" required>
    </div>
    <div class="mb-3" style="color: black;">
        <label for="jawaban" class="form-label">Jawaban</label> <br>
        <input type="radio" name="jawaban" value="A"> A <br>
        <input type="radio" name="jawaban" value="B"> B <br>
        <input type="radio" name="jawaban" value="C"> C <br>
        <input type="radio" name="jawaban" value="D"> D 
    </div>
    <div class="mb-3">
        <button name="ubah" type="submit" class="form-control btn btn-primary">Ubah Soal</button>
        <a href="detail_lowongan.php?id_lowongan=<?php echo $id_lowongan ?>"><button name="ubah" type="button" class="form-control btn btn-danger mt-2">Batal</button>
    </div>
    </div>
</form>
</body>
</html>

<?php
if (isset($_POST['ubah'])) {

    $pertanyaan = $_POST['pertanyaan'];
    $pilihan_a = $_POST['pilihan_a'];
    $pilihan_b = $_POST['pilihan_b'];
    $pilihan_c = $_POST['pilihan_c'];
    $pilihan_d = $_POST['pilihan_d'];
    $jawaban = $_POST['jawaban'];
    $koneksi->query("UPDATE soal SET pertanyaan='$pertanyaan', pilihan_a='$pilihan_a', pilihan_b='$pilihan_b', pilihan_c = '$pilihan_c', pilihan_d = '$pilihan_d', jawaban = '$jawaban' WHERE id_soal='$id_soal'");
    echo "<script>alert('Berhasil Diubah');</script>";
    echo "<script>location='detail_lowongan.php?id_lowongan=$id_lowongan';</script>";

}

?>