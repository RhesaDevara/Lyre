<?php
    require 'koneksi_pdo.php';
    require 'koneksi.php';
?>
<html>
    <head>
        <style>
        .navbar-custom {
            background-color: #20444F;
        }

        .navbar-custom .navbar-brand {
            color: #fff;
            display: flex;
            align-items: center;
        }

        .navbar-custom .navbar-brand:hover {
            color: #fff;
        }

        .navbar-custom .navbar-brand img {
            margin-right: 10px;
            height: 30px;
        }

        .navbar-custom .navbar-nav .nav-link {
            color: #fff;
            transition: color 0.3s ease;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 0.25rem;
        }

        .navbar-custom .navbar-nav .nav-link:hover {
            background-color: #fff;
            color: #20444F;
        }

        .navbar-custom .btn-login {
            background-color: transparent;
            border: 1px solid #fff;
            color: #fff;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar-custom .btn-login:hover {
            background-color: #fff;
            color: #20444F;
        }
        </style>
    </head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="assets/img/logo.png" alt="Logo">
                    LYRE
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Profile</a>
                        </li>
                        <?php 
                            session_start();
                            if(isset($_SESSION['user'])){
                                echo "
                                <li class='nav-item'>
                                    <a class='nav-link' href='#'>Find Job</a>
                                </li>";
                            }else if(isset($_SESSION['company'])){
                                echo "
                                <li class='nav-item'>
                                    <a class='nav-link' href='#'>Our Vacancy</a>
                                </li>";
                            }else if(isset($_SESSION['admin'])){
                                echo "
                                <li class='nav-item'>
                                    <a class='nav-link' href='admin.php'>Admin</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='posisi.php'>Position</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='#'>Company</a>
                                </li>";
                            }else{
                                echo "tidak ada";
                            }
                        ?>
                    </ul>
                </div>
                <?php
                    if(isset($_SESSION['user']) || isset($_SESSION['company'])  || isset($_SESSION['admin']) ){
                        echo "
                        <a href='logout.php' onclick='return confirm('Apakah Anda Yakin?');' class='btn btn-login'>Logout</a>";
                    }else{
                        echo "
                        <a href='login.php' class='btn btn-login'>Login</a>";
                    }
                ?>
            </div>
        </nav>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </html>