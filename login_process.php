<?php
session_start();

require 'koneksi_pdo.php';
$email = $_POST['email'];
$password = $_POST['password'];

$checkUser = $koneksiPdo->prepare("SELECT * FROM pengguna WHERE email = ?");
$checkUser->execute([$email]);

$checkCompany = $koneksiPdo->prepare("SELECT * FROM perusahaan WHERE email_perusahaan = ?");
$checkCompany->execute([$email]);

$checkAdmin = $koneksiPdo->prepare("SELECT * FROM admin WHERE email = ?");
$checkAdmin->execute([$email]);

$sqlUser = "SELECT * FROM pengguna WHERE email = ? AND password = ?";
$rowUser = $koneksiPdo->prepare($sqlUser);
$rowUser->execute([$email, $password]);
$countUser = $rowUser->fetchColumn();

if ($countUser == true) {
    $_SESSION['user'] = $checkUser->fetch();
    header('location: index.php');
} else {
    $sqlCompany = "SELECT * FROM perusahaan WHERE email_perusahaan = ? AND password = ?";
    $rowCompany = $koneksiPdo->prepare($sqlCompany);
    $rowCompany->execute([$email, $password]);
    $countCompany = $rowCompany->fetchColumn();
    if ($countCompany == true) {
        $_SESSION['company'] = $checkCompany->fetch();
        header('location: index.php');
    } else {
        $sqlAdmin = "SELECT * FROM admin WHERE email = ? AND password = ?";
        $rowAdmin = $koneksiPdo->prepare($sqlAdmin);
        $rowAdmin->execute([$email, $password]);
        $countAdmin = $rowAdmin->fetchColumn();
        if ($countAdmin == true) {
            $_SESSION['admin'] = $checkAdmin->fetch();
            header('location: index.php');
        } else {
            header('location: home.php');
        }
    }
}
?>
