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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/css/crud.css">
</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="text-left mb-3 mt-3">
                    <a href="admin.php" title="Back To Admin List" data-toggle="tooltip"><i
                            class="fa-solid fa-arrow-left fa-2xl" style="color: #20444F;"></i></a>
                </div>
                <div class="table-title">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2>Edit <b>Admin</b></h2>
                        </div>
                    </div>
                </div>
                <form method="POST">
                    <div class="mb-3">
                        <label for="na me" class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your full name"
                            value="<?php echo $pecah['nama']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label mt-2">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email"
                            value="<?php echo $pecah['email']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label mt-2">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your password"
                            value="<?php echo $pecah['password']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label mt-2">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm-password"
                            placeholder="Confirm your password" value="<?php echo $pecah['password']; ?>" required>
                    </div>
                    <div class="text-left">
                        <button type="submit" name="ubah" class="btn btn-primary form-control">Change Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>

<?php
if (isset($_POST['ubah'])) {

    $nama = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    if ($password == $confirm_password) {
        $koneksi->query("UPDATE admin SET nama='$nama', email='$email', password='$password' WHERE id_admin='$_GET[id]'");
        echo "<script>alert('Berhasil Diubah');</script>";
        echo "<script>location='admin.php';</script>";
    }


}

?>