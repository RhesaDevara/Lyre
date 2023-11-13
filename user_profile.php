<?php
    include 'navbar.php';
    $id_pengguna = $_SESSION['user']['id_pengguna'];
    $sql = $koneksiPdo -> prepare("SELECT * FROM pengguna where id_pengguna = '$id_pengguna'");
    $sql -> execute();
    $data = $sql -> fetch();
?>
<!DOCTYPE html>
<?php
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Apply and Recruit</title>
    <style>
        .profile-container{
            width: 50%;
        }
        .profile-container-30{
            width: 30%;
        }
        .profile-container-70{
            width: 70%;
        }
        .img-profile{
            height: 150px;
            width: 150px;
            border-radius: 100px;
        }

        .top-profile{
            width:80%;
            margin: auto;
            background:#EAEAEA;
        }
        </style>
</head>
<body>
    <div class="top-profile mt-5">
    <div class="d-flex flex-column">
        <div class="d-flex flex-row">
            <div class="d-flex flex-row p-2 profile-container">
                <div class="p-2 profile-container-30"> <center> <img src="assets/img/profile.png" class="img-profile"> </div>
                <div class="p-2 profile-container-70"> <h1 style="margin-top: 30px;"> <?php echo $data['nama']; ?> </h1> <?php echo $data['email']; ?> </div>
            </div>
            <div class="p-2 profile-container">
                asdf
            </div>
        </div>

        <div class="d-flex profile-container"> 
            <div class="p-3" style="text-align: justify"> <?php echo $data['about']; 
            if(isset($_SESSION['user'])){ ?>
                <br><br> <button class="btn btn-warning form-control"> Edit </button> 
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>
