<?php
include 'navbar.php';

$ambil = $koneksi->query("SELECT * FROM admin WHERE id_admin='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Admin</title>
</head>
<body>
    <form method="post">
    <div class="mt-5 px-5">
    <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" name="name" value="<?php echo $pecah['nama']; ?>" placeholder="Enter your full name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" value="<?php echo $pecah['email']; ?>" placeholder="Enter your email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" value="<?php echo $pecah['password']; ?>" placeholder="Enter your password" required>
    </div>
    <div class="mb-3">
        <label for="confirm-password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="confirm-password" value="<?php echo $pecah['password']; ?>" placeholder="Confirm your password" required>
    </div>
    <div class="mb-3">
        <button name="ubah" type="submit" class="form-control btn btn-primary">Change Admin</button>
    </div>
    </div>
</form>
</body>
</html>

<?php
if (isset($_POST['ubah'])) {

    $nama = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    if($password == $confirm_password){
        $koneksi->query("UPDATE admin SET nama='$nama', email='$email', password='$password' WHERE id_admin='$_GET[id]'");
        echo "<script>alert('Berhasil Diubah');</script>";
        echo "<script>location='admin.php';</script>";
    }

  
}

?>