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

        .logo-tes {
            width: 5rem;
        }
    </style>

    <section class="py-8 mb-3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mt-4 text-end">
                        <?php
                        if ($_SESSION['company']['status_akun'] == "Sudah Aktif") { ?>
                            <span> <a href="new_vacancy.php" class="btn btn-primary mb-3">Buat Lowongan</a> </span>
                        <?php } else { ?>
                            <div class="alert alert-warning">
                                <span> Akun anda sedang dalam proses verifikasi, anda belum dapat membuat lowongan </span>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-8">
        <div class="container">
            <div class="row justify-content-center">
                <!-- form -->
                <form method="post" class="row gx-2 gx-md-3 ">
                    <div class="col-xl-3 col-md-4 mb-6 mb-md-0">
                        <div class="card border mb-3 shadow-sm">
                            <div class="card-header">
                                <h4 class="mb-0 fs-5"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-filter text-muted me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z">
                                        </path>
                                    </svg>All Filters</h4>
                            </div>
                            <div class="card-body py-3">
                                <a class="fs-5 text-dark fw-semibold text-decoration-none d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse" href="#collapseExample" role="button"
                                    aria-expanded="false" aria-controls="collapseExample">
                                    <span>Locations</span>
                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                                            </path>
                                        </svg></span>
                                </a>


                                <div class="collapse show" id="collapseExample">
                                    <div class="mt-3">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="lokasi" id="jakarta"
                                                value="Jakarta">
                                            <label class="form-check-label" for="jakarta">
                                                Jakarta
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="lokasi" id="bekasi"
                                                value="Bekasi">
                                            <label class="form-check-label" for="bekasi">
                                                Bekasi
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="lokasi" id="bogor"
                                                value="Bogor">
                                            <label class="form-check-label" for="bogor">
                                                Bogor
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="lokasi" id="tangerang"
                                                value="Tangerang">
                                            <label class="form-check-label" for="tangerang">
                                                Tangerang
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="lokasi" id="bandung"
                                                value="Bandung">
                                            <label class="form-check-label" for="bandung">
                                                Bandung
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body border-top py-3">
                                <a class="fs-5 text-dark fw-semibold text-decoration-none d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse" href="#collapseExampleSecond" role="button"
                                    aria-expanded="false" aria-controls="collapseExampleSecond">
                                    <span>Salary</span>
                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                                            </path>
                                        </svg></span>
                                </a>
                                <div class="collapse show" id="collapseExampleSecond">
                                    <div class="mt-3">
                                        <input type="number" name="min" class="input form-control" placeholder="Min"
                                            autocomplete="off" min="0">
                                        <hr>
                                        <input type="number" name="max" class="input form-control" placeholder="Max"
                                            autocomplete="off">
                                    </div>
                                </div>

                            </div>

                            <div class="card-body border-top py-3">
                                <a class="fs-5 text-dark fw-semibold text-decoration-none d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse" href="#collapseExampleThird" role="button"
                                    aria-expanded="false" aria-controls="collapseExampleThird">
                                    <span>Last updated</span>
                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                                            </path>
                                        </svg></span>
                                </a>
                                <div class="collapse show" id="collapseExampleThird">
                                    <div class="mt-3">
                                        <input type="date" class="form-control" name="tanggal_post">

                                    </div>
                                </div>

                            </div>

                            <div class="card-body py-3 d-grid">
                                <button type="submit" name="btnFilter" class="btn btn-primary mb-1">
                                    Terapkan
                                </button>
                                <button type="submit" name="btnClear" class="btn btn-outline-secondary">
                                    Clear Data
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9 col-md-8 mb-6 mb-md-0">
                        <?php
                        if (isset($_POST['search'])) {
                            $search = $_POST['search'];
                            $sql = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where posisi LIKE '%$search%' ");
                            $sql->execute();
                        } else {
                            if (isset($_POST['btnFilter'])) {
                                $min = $_POST['min'];
                                $max = $_POST['max'];
                                $tanggal_post = $_POST['tanggal_post'];

                                if (!isset($min) || $min == "" || empty($min)) {
                                    $min = 0;
                                }
                                if (!isset($max) || $max == "" || empty($max)) {
                                    $max = 10000000000;
                                }

                                if (isset($_POST['lokasi'])) {
                                    $lokasi = $_POST['lokasi'];
                                }
                                if (!isset($lokasi) || $lokasi == "" || empty($lokasi)) {
                                    $sql = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where gaji >= '$min' AND gaji <= '$max' AND tanggal_posting > '$tanggal_post'");
                                    $sql->execute();
                                } else {
                                    $sql = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where gaji >= '$min' AND gaji <= '$max' AND tanggal_posting > '$tanggal_post' AND lokasi_pekerjaan = '$lokasi'");
                                    $sql->execute();
                                }
                            } else if (isset($_POST['btnClear'])) {
                                $sql = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan");
                                $sql->execute();
                            } else {
                                $sql = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan");
                                $sql->execute();
                            }
                        }

                        while ($data = $sql->fetch()) {
                            $id_lowongan = $data['id_lowongan'];
                            $id_perusahaan = $data['id_perusahaan'];
                            $tanggal_posting = new DateTime($data['tanggal_posting']);
                            $tanggal_formatted = $tanggal_posting->format('d F Y');
                            $now = new DateTime();
                            $interval = $tanggal_posting->diff($now);

                            if ($interval->m < 1) {
                                $selisih = $tanggal_formatted;
                            } elseif ($interval->y > 0) {
                                $selisih = $interval->y . " Years Ago";
                            } elseif ($interval->m > 0) {
                                $selisih = $interval->m . " Months Ago";
                            } elseif ($interval->d > 0) {
                                $selisih = $interval->d . " Days Ago";
                            } elseif ($interval->h > 0) {
                                $selisih = $interval->h . " Hours Ago";
                            } elseif ($interval->i > 0) {
                                $selisih = $interval->i . " Minutes Ago";
                            } else {
                                $selisih = $interval->s . " Seconds Ago";
                            }

                            $sqlPerusahaan = $koneksiPdo->prepare("SELECT * FROM perusahaan where id_perusahaan = '$id_perusahaan'");
                            $sqlPerusahaan->execute();

                            $dataPerusahaan = $sqlPerusahaan->fetch();
                            ?>
                            <div class="card card-bordered mb-3 shadow-sm card-hover cursor-pointer">
                                <div class="card-body">
                                    <div>
                                        <div class="d-xl-flex">
                                            <div class="mb-3 mb-md-0 text-center">
                                                <img src="<?php echo $dataPerusahaan['logo']; ?>" alt="Company Logo"
                                                    class="rounded logo-tes mt-md-2">
                                            </div>
                                            <div class="ms-xl-3 w-100 mt-3 mt-xl-1">
                                                <div class="d-flex justify-content-between mb-4">
                                                    <div>
                                                        <h3 class="mb-1 fs-4"><a
                                                                href="<?php echo "detail_lowongan.php?id_lowongan=$id_lowongan"; ?>"
                                                                class="text-dark text-decoration-none text-inherit">
                                                                <?php echo $data['posisi']; ?>
                                                            </a>
                                                            <?php if ($data['status_lowongan'] == "Non Aktif") { ?>
                                                                <span
                                                                    class="badge bg-danger-subtle border border-danger-subtle text-danger-emphasis rounded ms-xl-2 my-1 fs-6">
                                                                    <?php echo $data['status_lowongan']; ?>
                                                                </span>
                                                            <?php } else { ?>
                                                                <span
                                                                    class="badge bg-success-subtle border border-successs-subtle text-success-emphasis rounded ms-xl-2 my-1 fs-6">
                                                                    <?php echo $data['status_lowongan']; ?>
                                                                </span>
                                                            <?php } ?>
                                                        </h3>

                                                        <div class="mb-2 mb-md-0 text-secondary">
                                                            <div class="d-flex flex-column flex-md-row">
                                                                <span class="me-2"> <i class="fa-regular fa-building"></i>
                                                                    <span class="ms-1">
                                                                        <?php echo $data['departemen']; ?>
                                                                    </span></span>
                                                                <span class="me-2"> <i class="far fa-money-bill-alt"></i>
                                                                    <span class="ms-1">
                                                                        <?php
                                                                        $harga = $data['gaji'];
                                                                        $harga_format = number_format($harga, 0, ",", ".");
                                                                        echo "Rp. " . $harga_format . ",-"; ?>
                                                                    </span></span>
                                                                <span class="me-2"> <i class="fa-solid fa-location-dot"></i>
                                                                    <span class="ms-1">
                                                                        <?php echo $data['lokasi_pekerjaan']; ?>
                                                                    </span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="text-secondary">
                                                        <i class="fa-regular fa-clock"></i><span>
                                                            <?php echo $selisih ?>
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <a href="<?php echo "detail_lowongan.php?id_lowongan=$id_lowongan"; ?>"
                                                            class="btn btn-secondary">Detail</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </form>

            </div>
        </div>
    </section>
</body>

</html>