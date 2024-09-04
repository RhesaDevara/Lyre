<?php
require 'koneksi_pdo.php';
require 'koneksi.php';

//PERUBAHAN PADA NAVBAR UNTUK TES BRANCH
?>

<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/css.css">
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-custom">
    <div class="container">
        <a class="navbar-brand my-1 fs-3" href="index.php">
            <img src="assets/img/logo2.png" alt="Logo" width="100" height="40" class="d-inline-block align-text-center">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-lg-end" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Beranda</a>
                </li>
                <?php
                session_start();
                if (isset($_SESSION['user'])) {
                    echo "
                        <li class='nav-item'>
                            <a class='nav-link' href='find_job.php'>Lowongan</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='my_application.php'>Lamaran Saya</a>
                        </li>";
                } else if (isset($_SESSION['company'])) {
                    echo "
                        <li class='nav-item'>
                            <a class='nav-link' href='our_vacancy.php'>Lowongan Anda</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='buy_package.php'>Paket</a>
                        </li>";
                } else if (isset($_SESSION['admin'])) { ?>

                    <li class='nav-item'>
                        <a class='nav-link' href='find_job.php'> List Lowongan </a>
                    </li>
                <?php
                    if ($_SESSION['admin']['hak_akses'] == "Superadmin") {
                        echo "
                            <li class='nav-item'>
                                <a class='nav-link' href='admin.php'>Admin</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='package.php'>Paket</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='company.php'>Perusahaan</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='confirmation.php'>Konfirmasi</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='pembelian.php'>Pembelian</a>
                            </li>";
                    } else {
                        echo "
                            <li class='nav-item'>
                                <a class='nav-link' href='company.php'>Perusahaan</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='confirmation.php'>Konfirmasi</a>
                            </li>";
                    }
                } else {
                    echo "
                        <li class='nav-item'>
                            <a class='nav-link' href='find_job.php'>Lowongan</a>
                        </li>";
                }
                ?>
                <li class='nav-item'>
                    <a class='nav-link' href='about_us.php'>Tentang Kami</a>
                </li>
            </ul>
            <?php
            if (isset($_SESSION['user']) || isset($_SESSION['company']) || isset($_SESSION['admin'])) {
                if (isset($_SESSION['company'])) {
                    echo "
                        <div class='d-grid gap-2 d-md-flex justify-content-center'>
                        <div class='dropdown text-light'>
                            <a class='btn btn-custom dropdown-toggle text-light' href='#' role='button' id='profileDropdown' data-bs-toggle='dropdown' aria-expanded='false'>
                                <img src='" . $_SESSION['company']['logo'] . "' alt='Profile Picture' width='35' height='35' class='object-fit-cover rounded-circle me-2'>
                                " . $_SESSION['company']['nama_perusahaan'] . "
                            </a>
                            <ul class='dropdown-menu' aria-labelledby='profileDropdown'>
                                <li><a class='dropdown-item' href='company_profile.php'>Profile</a></li>
                                <li><a class='dropdown-item' href='#'>Kuota (" . $_SESSION['company']['kuota'] . ")</a></li>
                                <li><hr class='dropdown-divider'></li>
                                <li><a class='dropdown-item' href='logout.php' onclick='return confirm(\"Apakah Anda Yakin?\");'>Logout</a></li>
                            </ul>
                        </div>";
                } elseif (isset($_SESSION['user'])) {
                    echo "
                        <div class='d-grid gap-2 d-md-flex justify-content-center'>
                        <div class='dropdown text-light'>
                            <a class='btn btn-custom dropdown-toggle text-light' href='#' role='button' id='profileDropdown' data-bs-toggle='dropdown' aria-expanded='false'>
                                <img src='" . $_SESSION['user']['foto'] . "' alt='Profile Picture' width='35' height='35' class='object-fit-cover rounded-circle me-2'>
                                " . $_SESSION['user']['nama'] . "
                            </a>
                            <ul class='dropdown-menu' aria-labelledby='profileDropdown'>
                                <li><a class='dropdown-item' href='user_profile.php'>Profile</a></li>
                                <li><hr class='dropdown-divider'></li>
                                <li><a class='dropdown-item' href='logout.php' onclick='return confirm(\"Apakah Anda Yakin?\");'>Logout</a></li>
                            </ul>
                        </div>";
                } elseif (isset($_SESSION['admin'])) {
                    echo "<div class='d-grid gap-2 d-md-flex justify-content-md-end'>
                    <a href='logout.php' onclick='return confirm(\"Apakah Anda Yakin?\");' class='btn btn-danger form-control'>Logout</a></div>";
                }
            } else {
                echo "
                <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
                <a href='login.php' class='btn btn-nav-login me-2 form-control'>Masuk</a>
                <div class='dropdown text-light'>
                    <button class='btn btn-nav-register form-control dropdown-toggle' type='button' id='registerDropdown' data-bs-toggle='dropdown' aria-expanded='false'>
                        Daftar
                    </button>
                    <ul class='dropdown-menu' aria-labelledby='registerDropdown'>
                        <li><a class='dropdown-item' href='daftar_user.php'>Daftar Pelamar</a></li>
                        <li><a class='dropdown-item' href='daftar_company.php'>Daftar Perusahaan</a></li>
                    </ul>
                </div>";
            }
            ?>
        </div>
    </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
<script src="script.js"></script>

</html>