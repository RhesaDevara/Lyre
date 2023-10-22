<?php
    require 'koneksi_pdo.php';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conf_password = $_POST['confirm-password'];

    if($password == $conf_password){
        $sql = ('insert into admin (nama,email,password) values (?,?,?)');
        $row = $koneksiPdo -> prepare($sql);
        $row ->execute(array($name,$email,$password));
        header('location:admin.php');
    }
?>