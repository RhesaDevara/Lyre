<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Register</title>
    <link href="https://unpkg.com/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/css.css" rel="stylesheet">
</head>

<body>
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="card border border-light shadow-sm">
                <div class="row g-0">
                    <div class="col-12 col-md-6 bg-login-register text-white">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="col-10 col-xl-8 py-3 text-center">
                                <a href="index.php"><img class="img-fluid rounded mb-4" loading="lazy" title="Back To Home" data-toggle="tooltip" src="assets/img/logo2.png" width="245" height="80" alt=""></a>
                                <hr class="border border-light mb-4">
                                <h2 class="h3 mb-4">Anda sedang berada di halaman <br>Daftar Perusahaan</h2>
                                <p class="lead m-0 mb-3">Ingin daftar sebagai Pelamar? <br>
                                    <a class="link-offset-2 link-offset-3-hover link-underline-light text-light" href="daftar_user.php">
                                        Lewat sini!!!</a>
                                </p>
                                <p class="lead m-0">Sudah punya akun?<br><a class="link-offset-2 link-offset-3-hover link-underline-light text-light" href="login.php">Masuk Disini!!!</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card border border-light shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title mb-3">Register Company</h3>
                                <form method="post" action="daftar_company_proses.php">
                                    <div class="mb-3">
                                        <label for="nama_perusahaan" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" min="0" placeholder="Masukkan nama perusahaan" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email_perusahaan" class="form-label">Email Perusahaan <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email_perusahaan" name="email_perusahaan" placeholder="Masukkan email perusahaan" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm-password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Ulangi password untuk kofirmasi" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan nomor telepon" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dob" class="form-label">Alamat Perusahaan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" placeholder="Masukkan alamat perusahaan" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi_perusahaan" class="form-label">Deskripsi
                                            Perusahaan <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="deskripsi_perusahaan" name="deskripsi_perusahaan" placeholder="Masukkan deskripsi perusahaan" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-grid">
                                            <button name="daftar" class="btn btn-login-register" type="submit" onclick='return confirm("Apakah Anda Yakin?")'>Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="script.js"></script>
</body>

</html>