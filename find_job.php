<?php
include 'navbar.php';
$sqlCount = $koneksiPdo->prepare("SELECT COUNT(*) FROM lowongan_pekerjaan");
$sqlCount->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Apply and Recruit</title>
    <style>
        .custom-radio {
            height: 50px;
        }
    </style>
</head>

<body>
    <style>
        body {
            background: #f5f5f5;
        }
    </style>
    <form method="post">
        <div class="d-flex flew-row" style="border: none; margin: 0;">
            <div class="mt-5 text-white" style="width:25%; height: 550px; background: #20444F;  position: fixed; border-radius: 0px 30px 30px 0px;">
                <div class="px-4 pt-4">
                    <h4> Filter </h4>
                    <hr>
                    <h5> Gaji </h5>
                    <table>
                        <tr>
                            <td><input type="number" name="min" class="input form-control" placeholder="Min" autocomplete="off"> </td>
                            <td width="10%" class="text-white px-2">
                                <div style="border: 1px solid white; height: 2px; background: white;">
                            </td>
                            <td><input type="number" name="max" class="input form-control" placeholder="Max" autocomplete="off"> </td>
                        </tr>
                    </table>
                    <h5 class="mt-4"> Lokasi </h5>
                    <input class="form-check-input" type="radio" name="lokasi" value="" checked hidden>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lokasi" id="jakarta" value="Jakarta">
                        <label class="form-check-label" for="jakarta">
                            Jakarta
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lokasi" id="bekasi" value="Bekasi">
                        <label class="form-check-label" for="bekasi">
                            Bekasi
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lokasi" id="bogor" value="Bogor">
                        <label class="form-check-label" for="bogor">
                            Bogor
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lokasi" id="depok" value="Depok">
                        <label class="form-check-label" for="depok">
                            Depok
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lokasi" id="tangerang" value="Tangerang">
                        <label class="form-check-label" for="tangerang">
                            Tangerang
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lokasi" id="bandung" value="Bandung">
                        <label class="form-check-label" for="bandung">
                            Bandung
                        </label>
                    </div>

                    <h5 class="mt-4"> Tanggal Post sesudah </h5>
                    <input type="date" class="form-control" name="tanggal_post">

                    <center> <button type="submit" name="btnFilter" class="btn btn-primary mt-4 form-control"> Terapkan </button></center>
                </div>
            </div>
    </form>
    <div style="width: 20%"></div>
    <div>
        <div class="container mt-5">
            <div class="row mt-5">
                <div class="col-lg-8 mx-auto">
                    <div class="container mb-2">
                        <form method="post">
                            <div class="d-flex flex-row" style="width: 100%;">
                                <div style="width: 100%;">
                                    <input type="text" name="search" placeholder="Cari disini..." class="form-control">
                                </div>
                                <div>
                                    <button type="submit" name="btnSearch" class="btn btn-primary">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mb-5">
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            <?php
                            if (isset($_POST['search'])) {
                                $search = $_POST['search'];
                                $sql = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where posisi LIKE '%$search%' AND status_lowongan = 'Aktif'");
                                $sql->execute();
                            } else {
                                if (isset($_POST['btnFilter'])) {
                                    $min = $_POST['min'];
                                    $max = $_POST['max'];
                                    $lokasi = $_POST['lokasi'];
                                    $tanggal_post = $_POST['tanggal_post'];

                                    if (!isset($min) || $min == "" || empty($min)) {
                                        $min = 0;
                                    }
                                    if (!isset($max) || $max == "" || empty($max)) {
                                        $max = 10000000000;
                                    }

                                    if (!isset($lokasi) || $lokasi == "" || empty($lokasi)) {
                                        $sql = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where status_lowongan = 'Aktif' AND gaji >= '$min' AND gaji <= '$max' AND tanggal_posting > '$tanggal_post'");
                                        $sql->execute();
                                    } else {
                                        $sql = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where status_lowongan = 'Aktif' AND gaji >= '$min' AND gaji <= '$max' AND tanggal_posting > '$tanggal_post' AND lokasi_pekerjaan = '$lokasi'");
                                        $sql->execute();
                                    }
                                    // } else if (isset($_POST['btnSearch'])) {
                                    //     $search = $_POST['search'];
                                    //     $sql = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where status_lowongan = 'Aktif'");
                                    //     $sql->execute();
                                } else {
                                    $sql = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where status_lowongan = 'Aktif'");
                                    $sql->execute();
                                }
                            }

                            while ($data = $sql->fetch()) {
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
                                                        <a href=<?php echo "detail_lowongan.php?id_lowongan=$id_lowongan"; ?>>
                                                            <input type="button" class="btn btn-secondary w-100" value="See Detail">
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
    </div>
    </div>
    <div style="height: 1000px;">

    </div>
</body>

</html>