<?php
    include 'navbar.php';
    $id_perusahaan = $_SESSION['company']['id_perusahaan'];
    
    $sqlSession = $koneksiPdo -> prepare("SELECT * FROM perusahaan where id_perusahaan = '$id_perusahaan'");
    $sqlSession -> execute();
    $_SESSION['company'] = $sqlSession -> fetch();

    $sql = $koneksiPdo -> prepare("SELECT * FROM perusahaan where id_perusahaan = '$id_perusahaan'");
    $sql -> execute();
    $data = $sql -> fetch();

    $sql1 = $koneksiPdo -> prepare("SELECT * FROM lowongan_pekerjaan where id_perusahaan = '$id_perusahaan'");
    $sql1 -> execute();
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
    .vacancy-container {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .img-vacancy {
        width: 100px;
        height: auto;
        margin-right: 10px;
        border-radius: 0px;
    }

    .vacancy-details {
        flex: 1;
        padding: 15px;
    }

    .posisi {
        font-weight: bold;
        margin-bottom: 15px;
    }

    .vacancy-item-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-success {
        width: 100px;
    }
</style>
</style>
</head>
<body>
    <center>
    <div class="mt-5" style="width:80%;">
        <table width=100% border=0>
            <tr>
                <td rowspan='4' width="15%" class="pe-2"> <img src="assets/img/logo.png" width=100%> </td>

            </tr>
            <tr>
                <td> <h1> <?php echo $data['nama_perusahaan']; ?> </td>
            </tr>
            <tr>
                <td><i> <?php echo $data['email_perusahaan']; ?> / <?php echo $data['nomor_telepon']; ?> </td>
            </tr>
            <tr>
                <td> <?php echo $data['alamat_perusahaan']; ?> </td>
            </tr>
            <tr>
                <td colspan=3> <hr> </td>
            </tr>
            <tr>
                <td colspan=3> <div style="text-align: justify"> <?php echo $data['deskripsi_perusahaan']; ?></td>
            </tr>
            <tr>
                <td colspan=3> <hr> </td>
            </tr>
            </table>
            <?php while ($data1 = $sql1->fetch()) : ?>
    <div class="vacancy-container">
        <img src="assets\img\new_logo.png" class="img-vacancy">
        <div class="vacancy-details">
            <div class="vacancy-item-container">
            <div class="posisi"><?php echo $data1['posisi']; ?></div>
            <div><strong>Departemen:</strong> <?php echo $data1['departemen']; ?></div>
            <div><strong>Lokasi Pekerjaan:</strong> <?php echo $data1['lokasi_pekerjaan']; ?></div>
                <div><strong>Gaji:</strong> Rp. <?php echo number_format($data1['gaji'], 0, ",", "."); ?>,-</div>
                <div>
                    <?php
                    $id_lowongan = $data1['id_lowongan'];
                    echo "<a href='detail_lowongan.php?id_lowongan=$id_lowongan'>";
                    ?>
                    <button class="btn btn-success">Detail</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>

</div>
</body>
</html>
