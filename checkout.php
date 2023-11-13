<?php
    include 'navbar.php';
    $id_paket = $_GET['id_paket'];
    $sql = $koneksiPdo -> prepare("SELECT * FROM paket where id_paket = '$id_paket'");
    $sql -> execute();
    $data = $sql ->fetch();
    $today = date("Ymd");
    $id_perusahaan = $_SESSION['company']['id_perusahaan'];
    $kuota = $_SESSION['company']['kuota'];
    $tambahKuota = $data['kuota'];
    $kode_va = "9000" . $id_perusahaan . $id_paket . $today;
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
    <center>
    <table width=50% border=1 class="mt-5">
        <tr>
            <td> Tambah Kuota </td>
            <td> : </td>
            <td> <b> <?php echo $data['kuota']; ?> Lowongan </b> </td>
        </tr>
        <tr>
            <td> Total Harga </td>
            <td> : </td>
            <td> <b> <?php 
            $harga = $data['harga']; 
            $harga_format = number_format($harga, 0, ",", ".");

            echo "Rp. " . $harga_format . ",-";?> </b> </td>
        </tr>
        <tr>
            <td> Kode Virtual </td>
            <td> : </td>
            <td> <b> <?php echo $kode_va ?> </b> </td>
        </tr>
        <tr>
            <td colspan=3><center>
    <form method="post">
        <input type="submit" name="bayar" value="Bayar" class="btn btn-success mt-2">
    </form>
</td>
    </table>

</body>
<?php
    if(isset($_POST['bayar'])){
        $newKuota = $kuota + $tambahKuota;
        $sql1 = $koneksiPdo ->prepare("UPDATE perusahaan set kuota = '$newKuota' where id_perusahaan = '$id_perusahaan'");
        $sql1 ->execute();

        $sql2 = $koneksiPdo ->prepare("SELECT * FROM perusahaan where id_perusahaan = '$id_perusahaan'");
        $sql2 ->execute();
        $_SESSION['company'] = $sql2 ->fetch();
        header("location:company_profile.php");
    }
?>
</html>
