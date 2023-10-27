<?php
require 'koneksi_pdo.php';
require 'koneksi.php';
?>
<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="css.css">


<nav class="navbar navbar-expand-lg navbar-dark bg-custom">
    <div class="container">
        <a class="navbar-brand my-1 fs-3" href=" index.php">
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
                                    <a class='nav-link' href='#'>Profile</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='#'>Our Vacancy</a>
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
                                    <a class='nav-link' href='#'>Company</a>
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
                    echo "
                        <a href='logout.php' onclick='return confirm('Apakah Anda Yakin?');' class='btn btn-danger'>Logout</a>";
                } else {
                    echo "
                        <a href='login.php' class='btn btn-login me-2 form-control'>Login</a>
                        <a href='login.php' class='btn btn-register form-control'>Register</a>
                        ";
                }
                ?>
            </div>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>