<?php
include 'navbar.php';
$sql = $koneksiPdo->prepare("SELECT * FROM pembelian");
$sql->execute();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/crud.css">
</head>

<body>
    <div class="p-5" style="width:100%;">
        <div>
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-md-8">
                            <h2>Data <b>Pembelian</b></h2>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-6">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-responsive">
                    <tr>
                        <th> ID Pembelian </th>
                        <th> Nama Perusahaan </th>
                        <th> Nama Paket </th>
                        <th> Harga </th>
                        <th> Tanggal Pembelian </th>
                    </tr>

                    <?php
                    $total = 0;
                    while ($data = $sql->fetch()) {
                        $id_perusahaan = $data['id_perusahaan'];
                        $id_paket = $data['id_paket'];

                        $sql1 = $koneksiPdo->prepare("SELECT * FROM perusahaan where id_perusahaan = '$id_perusahaan'");
                        $sql1->execute();

                        $sql2 = $koneksiPdo->prepare("SELECT * FROM paket where id_paket = '$id_paket'");
                        $sql2->execute();

                        $dataPerusahaan = $sql1->fetch();
                        $dataPaket = $sql2->fetch();

                        $harga = $dataPaket['harga'];
                        $harga_format = number_format($harga, 0, ",", ".");
                    ?>

                        <tr>
                            <td> <?php echo $data['id_pembelian']; ?></td>
                            <td> <?php echo $dataPerusahaan['nama_perusahaan']; ?></td>
                            <td> <?php echo $dataPaket['nama_paket']; ?></td>
                            <td> Rp. <?php echo $harga_format ?> ,-</td>
                            <td> <?php echo $data['tanggal_pembelian']; ?></td>
                        </tr>
                    <?php
                        $total += $harga;
                    }
                    $total_format = number_format($total, 0, ",", ".");
                    ?>

                </table>
                </form>
                <div>
                    <h3> Total Penjualan : <b> Rp.<?php echo $total_format ?>,-</b></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>

</html>