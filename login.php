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
                                <h2 class="h1 mb-4">Your Dream <br>Job is Waiting</h2>
                                <p class="lead m-0">Find the perfect job that suits your skills and passion.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card border border-light shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title mb-3">Log in</h3>
                                <form action="login_process.php" method="post">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="name@email.com" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            value="" required placeholder="********">
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input class="form-check-input" type="checkbox" value="" name="remember_me"
                                            id="remember_me">
                                        <label class="form-check-label" for="remember_me">Keep me logged in</label>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-grid">
                                            <button class="btn btn-login-register" type="submit">Login</button>
                                        </div>
                                    </div>
                                </form>
                                <hr class="mt-5 mb-4 border border-secondary">
                                <div class="d-flex gap-2 gap-md-4 flex-row justify-content-end">
                                    <a href="#!" class="link-secondary text-decoration-none">Forgot password</a>
                                </div>
                                <p class="mt-5 mb-3">Don't have an account? Sign up here.</p>
                                <div class="d-flex gap-3 mb-1 flex-column flex-xl-row">
                                    <a href="daftar_user.php" class="btn btn-select-register">Applicant</a>
                                    <a href="daftar_company.php" class="btn btn-select-register">Company</a>
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