<?php
    require 'koneksi_pdo.php';
    $email = $_POST['email'];
    $password = $_POST['password'];

    $checkUser = $koneksiPdo ->prepare("select*from pengguna where email ='$email'");
    $checkUser ->execute();

    
    $checkCompany = $koneksiPdo ->prepare("select*from perusahaan where email_perusahaan='$email'");
    $checkCompany ->execute();
    
    $checkAdmin = $koneksiPdo ->prepare("select*from admin where email='$email'");
    $checkAdmin ->execute();
    
    $_SESSION['rhesa'] = $checkAdmin ->fetch();
    
    
    $sqlUser = ('select*from pengguna where email = ? and password = ?');
    $rowUser = $koneksiPdo ->prepare($sqlUser);
    $rowUser -> execute(array($email,$password));
    $countUser = $rowUser ->fetchColumn();
    
    if($countUser == true){
        header('location:home.php');
    } else {
        $sqlCompany = ('select*from perusahaan where email_perusahaan = ? and password = ?');
        $rowCompany = $koneksiPdo ->prepare($sqlCompany);
        $rowCompany -> execute(array($email,$password));
        $countCompany = $rowCompany ->fetchColumn();
        if($countCompany == true){
            header('location:home.php');
        }else{
            $sqlAdmin = ('select*from admin where email = ? and password = ?');
            $rowAdmin = $koneksiPdo ->prepare($sqlAdmin);
            $rowAdmin -> execute(array($email,$password));
            $countAdmin = $rowAdmin ->fetchColumn();
            if($countAdmin == true){
                header('location:home.php');
            }else{
                header('location:index.php');
            }
        }
    }    
?>