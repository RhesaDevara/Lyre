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

        .logo-tes {
            width: 5rem;
        }
    </style>

    <section class="py-8 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-12">
                    <div class="mt-4">
                        <div class="bg-white rounded-md-pill me-lg-10 shadow-sm rounded-3">
                            <div class="p-md-2 p-4">
                                <!-- form -->
                                <form method="post" class="row g-2">
                                    <div class="col-12 col-md-10">

                                        <div class="input-group mb-2 mb-md-0 border-md-0 border rounded-pill">
                                            <span class="input-group-text bg-transparent border-0 pe-0 ps-md-3 ps-md-0"
                                                id="searchJob"><svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                    height="14" fill="currentColor" class="bi bi-search text-muted"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z">
                                                    </path>
                                                </svg></span>
                                            <!-- search -->
                                            <input type="search" name="search"
                                                class="form-control rounded-pill border-0 ps-3 form-focus-none"
                                                placeholder="Job Title" aria-label="Job Title"
                                                aria-describedby="searchJob">
                                        </div>

                                    </div>
                                    <div class="col-12 col-md-2 text-end d-grid">
                                        <!-- button -->
                                        <button type="submit" name="btnSearch"
                                            class="btn btn-primary rounded-pill">Search</button>
                                    </div>
                                </form>
                            </div>

                        </div>

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
                            $sql = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where posisi LIKE '%$search%' AND status_lowongan = 'Aktif'");
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
                                    $sql = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where status_lowongan = 'Aktif' AND gaji >= '$min' AND gaji <= '$max' AND tanggal_posting > '$tanggal_post'");
                                    $sql->execute();
                                } else {
                                    $sql = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where status_lowongan = 'Aktif' AND gaji >= '$min' AND gaji <= '$max' AND tanggal_posting > '$tanggal_post' AND lokasi_pekerjaan = '$lokasi'");
                                    $sql->execute();
                                }
                            } else if (isset($_POST['btnClear'])) {
                                $sql = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where status_lowongan = 'Aktif'");
                                $sql->execute();
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
                            <div class="card card-bordered mb-3 shadow-sm card-hover cursor-pointer">
                                <div class="card-body">
                                    <div>
                                        <div class="d-xl-flex">
                                            <div class="mb-3 mb-md-0 text-center">
                                                <img src="<?php echo $dataPerusahaan['logo']; ?>" alt="course"
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
                                                        </h3>

                                                        <div class="mb-2 mb-md-0 text-secondary">
                                                            <div class="d-flex flex-column flex-md-row">
                                                                <!-- Mengubah menjadi kolom pada mobile -->
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