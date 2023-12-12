<?php
include 'navbar.php';

$id_perusahaan = $_SESSION['company']['id_perusahaan'];
$sqlSession = $koneksiPdo->prepare("SELECT * FROM perusahaan where id_perusahaan = '$id_perusahaan'");
$sqlSession->execute();
$_SESSION['company'] = $sqlSession->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Apply and Recruit</title>
</head>

<body>
    <div class="container py-3">
        <header>
            <div class="packages-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-4 fw-normal text-body-emphasis">Paket</h1>
                <p class="fs-5 text-body-secondary">Belilah paket dibawah agar anda dapat tetap dapat mengunggah
                    lowongan terbaru anda. Dijamin Harga Termurah Seindonesia!!</p>
            </div>
        </header>

        <main>
            <div class="row row-cols-1 row-cols-md-4 mb-3 text-center">
                <?php $ambil = $koneksi->query("SELECT * FROM paket "); ?>
                <?php while ($perpaket = $ambil->fetch_assoc()) { ?>
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm" style="border: 1px solid #377487;">
                            <div class="card-header py-3 text-white" style="background: #377487; border: 1px solid #377487;">
                                <h4 class="my-0 fw-normal">
                                    <?php echo $perpaket['nama_paket']; ?>
                                </h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title"><small>
                                        <?php echo $perpaket['kuota']; ?> Kuota
                                    </small>
                                </h1>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>
                                        <?php echo $perpaket['deskripsi_paket']; ?>
                                    </li>
                                    <li class="fs-3">
                                        <?php echo 'Rp. ' . number_format($perpaket['harga'], 0, ',', '.'); ?>,-
                                    </li>
                                </ul>
                                <?php echo "<a href='checkout.php?id_paket=$perpaket[id_paket]'>"; ?><button type="button" class="w-100 btn btn-lg btn-our-color text-white" style="background: #377487;">Beli Paket</button></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </main>
    </div>
</body>

</html>