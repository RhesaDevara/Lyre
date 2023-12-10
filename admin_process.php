<?php
require 'koneksi_pdo.php';
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$conf_password = $_POST['confirm-password'];
$hak_akses = $_POST['hak_akses'];

if ($password == $conf_password) {
    $sql = ('insert into admin (nama,email,password,hak_akses) values (?,?,?,?)');
    $row = $koneksiPdo->prepare($sql);
    $row->execute(array($name, $email, $password, $hak_akses));
    header('location:admin.php');
}
