<?php
include 'navbar.php';

$id_perusahaan = $_SESSION['company']['id_perusahaan'];
$sqlSession = $koneksiPdo->prepare("SELECT * FROM perusahaan where id_perusahaan = '$id_perusahaan'");
$sqlSession->execute();
$_SESSION['company'] = $sqlSession->fetch();

$sql = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where id_perusahaan = '$id_perusahaan'");
$sql->execute();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Apply and Recruit</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
        integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />
</head>

<body>
    <style>
        body {
            background: #f5f5f5;
        }
    </style>
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-lg-8 mx-auto">
                <div class="mb-5">
                    <?php
                    if ($_SESSION['company']['status_akun'] == "Aktif") { ?>
                        <center> <a href="new_vacancy.php" class="btn btn-primary mb-3">Buat Lowongan</a> </center>
                    <?php } else { ?>
                        <div class="alert alert-warning">
                            <center> Akun anda sedang dalam proses verifikasi, anda belum dapat membuat lowongan </center>
                        </div>
                    <?php } ?>
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <?php while ($data = $sql->fetch()) {
                            $id_lowongan = $data['id_lowongan'];
                            $tanggal_posting = strtotime($data['tanggal_posting']);
                            $selisih_detik = time() - $tanggal_posting;

                            if ($selisih_detik < 60) {
                                $selisih = $selisih_detik . " Seconds Ago";
                            } elseif ($selisih_detik < 3600) {
                                $selisih = floor($selisih_detik / 60) . " Minutes Ago";
                            } elseif ($selisih_detik < 86400) {
                                $selisih = floor($selisih_detik / 3600) . " Hours Ago";
                            } elseif ($selisih_detik < 2592000) {
                                $selisih = floor($selisih_detik / 86400) . " Days Ago";
                            } elseif ($selisih_detik < 31536000) {
                                $selisih = floor($selisih_detik / 2592000) . " Months Ago";
                            } else {
                                $selisih = floor($selisih_detik / 31536000) . " Years Ago";
                            }
                            ?>
                            <div class="col">
                                <div class="card card-bordered card-hover cursor-pointer">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-4">
                                            <div
                                                class="d-flex align-items-center justify-content-center text-center pt-3 pb-md-5">
                                                <img src="<?php echo $_SESSION['company']['logo'] ?>" class="rounded"
                                                    alt="Company Logo" style="width: 100px; height: 100px;">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <div class="d-flex flex-column">
                                                    <div class="card-title">
                                                        <div class="fw-bold">
                                                            <span class="d-md-flex fs-5">
                                                                <?php echo $data['posisi']; ?>
                                                            </span>
                                                            <?php if ($data['status_lowongan'] == "Non Aktif") { ?>
                                                                <span class="text-danger">(
                                                                    <?php echo $data['status_lowongan']; ?> )
                                                                </span>
                                                            <?php } else { ?>
                                                                <span class="text-success">(
                                                                    <?php echo $data['status_lowongan']; ?> )
                                                                </span>
                                                            <?php } ?>
                                                        </div>

                                                    </div>
                                                    <!-- <div class="fw-bold">
                                                        <?php if ($data['status_lowongan'] == "Non Aktif") { ?>
                                                            <span class="text-danger">(
                                                                <?php echo $data['status_lowongan']; ?> )
                                                            </span>
                                                        <?php } else { ?>
                                                            <span class="text-success">(
                                                                <?php echo $data['status_lowongan']; ?> )
                                                            </span>
                                                        <?php } ?>
                                                    </div> -->
                                                </div>
                                                <ul class="list-unstyled text-secondary d-flex flex-column">
                                                    <li class="mb-1 me-3">
                                                        <i class="fa-solid fa-building"></i>
                                                        <?php echo $data['departemen']; ?>
                                                    </li>
                                                    <li class="mb-1 me-3">
                                                        <i class="fa-solid fa-location-dot"></i>
                                                        <?php echo $data['lokasi_pekerjaan']; ?>
                                                    </li>
                                                    <li class="mb-1">
                                                        <i class="far fa-money-bill-alt"></i>
                                                        <?php
                                                        $harga = $data['gaji'];
                                                        $harga_format = number_format($harga, 0, ",", ".");
                                                        echo "Rp. " . $harga_format . ",-"; ?>
                                                    </li>
                                                </ul>
                                                <div class="text-end">
                                                    <?php echo "<a href='detail_lowongan.php?id_lowongan=$id_lowongan'>"; ?>
                                                    <button class="btn btn-secondary w-100">See Detail</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-md-flex justify-content-between text-secondary">
                                            <small class="text-center">
                                                <i class="fa-solid fa-calendar-days"></i> Posted
                                                <span class="fs-7 fw-bold">
                                                    <?php echo $selisih ?>
                                                </span>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>