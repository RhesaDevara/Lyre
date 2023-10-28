<?php
    include 'navbar.php';
    $id_perusahaan = $_SESSION['company']['id_perusahaan'];
    $sql = $koneksiPdo -> prepare("SELECT * FROM lowongan_pekerjaan where id_perusahaan = '$id_perusahaan'");
    $sql ->execute();
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
    <?php
    if ($_SESSION['company']['kuota'] == 0){
        ?>
        <center> <input type="button" value="Buat Lowongan" class="btn btn-secondary mt-5" disabled> </center>
        <?php
    }else{
        ?>
    <center><a href="new_vacancy.php"><input type="button" value="Buat Lowongan" class="btn btn-primary mt-5"></a> </center>
        <?php
    } ?>
    <?php while($data=$sql->fetch()){ ?>
        <div class="vacancy">
            <table>
                <tr>
                    <td rowspan=4> <img src="assets\img\new_logo.png" class="img-vacancy"> </td>
                    <td width=100% style="margin:0; padding:0; padding-left: 10px;">
                        <table class="table-vacancy" width=100%>
                            <tr>
                                <td class="posisi"><?php echo $data['posisi']; ?>  </td>
                            </tr>
                            <tr>
                                <td style="height:10px;"> <?php echo $data['departemen'];?></td>
                            </tr>
                            <tr>
                                <td> <?php echo $data['lokasi_pekerjaan'];?> </td>
                            </tr>
                            
                            <tr>
                                <td> <b><?php 
                                $id_lowongan = $data['id_lowongan'];
                                 $harga = $data['gaji'];  
                        $harga_format = number_format($harga, 0, ",", ".");
                        echo "Rp. " . $harga_format . ",-"; ?> </td>
                                <td width=20%> <?php echo "<a href='detail_lowongan.php?id_lowongan=$id_lowongan'>"; ?> <button class="btn btn-success" style="width:200px;">See Detail</button></a> </td>
                            </tr>
                    </td>
                    </table>
    </table>
        </div>
    <?php } ?>
</body>
</html>
