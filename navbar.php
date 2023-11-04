<?php
require 'koneksi_pdo.php';
require 'koneksi.php';
?>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/css.css">
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-custom">
    <div class="container">
        <a class="navbar-brand my-1 fs-3" href="index.php">
            <img src="assets/img/logo2.png" alt="Logo" width="100" height="40" class="d-inline-block align-text-center">
            LYRE
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php
                session_start();
                if (isset($_SESSION['user'])) {
                    echo "
                                <li class='nav-item'>
                                    <a class='nav-link' href='#'>Profile</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='#'>Find Job</a>
                                </li>";
                } else if (isset($_SESSION['company'])) {
                    echo "
                                <li class='nav-item'>
                                    <a class='nav-link' href='company_profile.php'>Profile</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='our_vacancy.php'>Our Vacancy</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='buy_package.php'>Package</a>
                                </li>";
                } else if (isset($_SESSION['admin'])) {
                    echo "
                                <li class='nav-item'>
                                    <a class='nav-link' href='#'>Profile</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='admin.php'>Admin</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='package.php'>Package</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='company.php'>Company</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='confirmation.php'>Konfirmasi</a>
                                </li>";
                } else {
                    echo "
                                <li class='nav-item'>
                                    <a class='nav-link' href='#'>Find Job</a>
                                </li>";
                }
                ?>
            </ul>
            <div class="d-flex">
                <?php
                if (isset($_SESSION['user']) || isset($_SESSION['company']) || isset($_SESSION['admin'])) {
                    if (isset($_SESSION['company'])) {
                        echo "
                        <a href='' class='btn'> <font color='white'> <b>" . $_SESSION['company']['kuota'] . "</b> kuota tersedia</a>";
                    }
                    echo "
                        <a href='logout.php' onclick='return confirm(\"Apakah Anda Yakin?\");' class='btn btn-danger form-control'>Logout</a>";
                } else {
                    echo "
                    <a href='login.php' class='btn btn-login me-2 form-control'>Login</a>
                    <div class='dropdown'>
                            <button class='btn btn-register form-control dropdown-toggle' type='button' id='registerDropdown' data-bs-toggle='dropdown' aria-expanded='false'>
                                Register
                            </button>
                            <ul class='dropdown-menu' aria-labelledby='registerDropdown'>
                                <li><a class='dropdown-item' href='daftar_user.php'>Register as Applicant</a></li>
                                <li><a class='dropdown-item' href='daftar_company.php'>Register as Company</a></li>
                            </ul>
                        </div>
                        ";
                }
                ?>
            </div>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>