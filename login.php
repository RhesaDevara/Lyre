<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Login</title>
    <link href="https://unpkg.com/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/css.css" rel="stylesheet">
</head>

<body>
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="card border border-light shadow-sm mt-5">
                <div class="row g-0">
                    <div class="col-12 col-md-6 text-white bg-login-register">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="col-10 col-xl-8 py-3 text-center">
                                <a href="index.php"><img class="img-fluid rounded mb-4" loading="lazy"
                                        src="assets/img/logo2.png" width="245" height="80" title="Back To Home"
                                        data-toggle="tooltip"></a>
                                <hr class="border border-light mb-4">
                                <h4 class="mb-4">Pekerjaan Impian <br>Anda sedang Menunggu</h4>
                                <p class="lead m-0">Cari pekerjaan yang cocok dengan kemampuan dan keahlian anda.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card border border-light shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title mb-3">Masuk</h3>
                                <form action="login_process.php" method="post">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="nama@email.com" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Kata Sandi <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            value="" required placeholder="********">
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-grid">
                                            <button class="btn btn-login-register" type="submit">Masuk</button>
                                        </div>
                                    </div>
                                </form>
                                <hr class="mt-3 mb-4 border border-secondary">
                                <p class="mt-3 mb-3">Tidak punya akun? Daftar disini.</p>
                                <div class="d-flex gap-3 flex-column flex-xl-column">
                                    <a href="daftar_user.php" class="btn btn-select-register form-control">Pelamar</a>
                                    <p class="text-secondary text-center text-uppercase fw-bold mb-0">Atau</p>
                                    <a href="daftar_company.php" class="btn btn-select-register">Perusahaan</a>
                                </div>
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