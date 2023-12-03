<?php
include 'navbar.php';
$search = $_POST['search'];

$sqlSearch = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where posisi LIKE '%$search%'");
$sqlSearch->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Apply and Recruit</title>
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
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <?php while ($data = $sqlSearch->fetch()) {
                            $id_lowongan = $data['id_lowongan'];
                            $id_perusahaan = $data['id_perusahaan'];
                            $tanggal_posting_unix = strtotime($data['tanggal_posting']);
                            $selisih_detik = time() - $tanggal_posting_unix;

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

                            $sqlPerusahaan = $koneksiPdo->prepare("SELECT * FROM perusahaan where id_perusahaan = '$id_perusahaan'");
                            $sqlPerusahaan->execute();

                            $dataPerusahaan = $sqlPerusahaan->fetch();
                        ?>
                            <div class="col">
                                <div class="card">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center justify-content-center text-center pt-3 pt-md-0  pb-md-5">
                                                <img src="<?php echo $dataPerusahaan['logo']; ?>" class="rounded" alt="Company Logo" style="width: 100px; height: 100px;">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <?php echo $data['posisi']; ?>
                                                </h5>
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