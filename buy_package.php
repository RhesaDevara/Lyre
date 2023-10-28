<?php
    include 'navbar.php';
    $sql = $koneksiPdo -> prepare('SELECT * FROM paket');
    $sql -> execute();
    $count = 0
?>
<!DOCTYPE html>
<?php
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Apply and Recruit</title>
</head>
<body>
    <table width=100%>
    <div class="package-container">
        <?php while ($data=$sql->fetch()){ 
            $id_paket = $data['id_paket'];
            if($count == 0){
                ?> <tr> <?php
            }
            
            $count++ 
        ?>
        <td style="padding:10px;"> <center>
            <div class="package">
                <center> <h4> <?php echo $data['nama_paket']; ?> </h4> <center>
                
                Dapatkan <b><?php echo $data['kuota']; ?></b> kuota dengan paket ini.
                <br>
                <div class="mt-4">
                    <font size=6"><b> <?php $harga = $data['harga'];  
                        $harga_format = number_format($harga, 0, ",", ".");
                        echo "Rp. " . $harga_format . ",-"; ?>
                    </font>
                    <br>
                    <?php echo "<a href='kode_virtual.php?id_paket=$id_paket'>";?> <input type="button" value="Beli Paket" class="btn btn-success"></a>
                </div>
            </div>
        </td>
        <?php
            if($count == 4){
                ?> </tr> <?php
                $count = 0;
            }
        } 
        ?>
        
    </div>
</body>

</html>
