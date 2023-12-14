<?php
include 'navbar.php';
$id_lowongan = $_GET['id_lowongan'];

if (isset($_GET['id_perusahaan'])) {
    $id_perusahaan = $_GET['id_perusahaan'];
} else {
    $id_perusahaan = $_SESSION['company']['id_perusahaan'];
}

if (isset($_SESSION['user'])) {
    $id_pengguna = $_SESSION['user']['id_pengguna'];
    $cekLamaran = $koneksiPdo->prepare("SELECT count(*) from lamaran where id_pengguna = '$id_pengguna' and id_lowongan = '$id_lowongan'");
    $cekLamaran->execute();

    $countLamaran = $cekLamaran->fetchColumn();
}

if (isset($_SESSION['user'])) {
    echo "<script>location='403.html';</script>";
}

// Lakukan JOIN antara tabel lowongan_pekerjaan dan perusahaan
$sql = $koneksiPdo->prepare("SELECT lp.*, p.* FROM lowongan_pekerjaan lp
                            INNER JOIN perusahaan p ON lp.id_perusahaan = p.id_perusahaan
                            WHERE lp.id_lowongan = $id_lowongan");
$sql->execute();
$data = $sql->fetch();

if (isset($_SESSION['company']['id_perusahaan']) && $data['id_perusahaan'] !== $id_perusahaan) {
    echo "<script>location='404.html';</script>";
}

$sql1 = $koneksiPdo->prepare("SELECT * FROM soal where id_lowongan = '$id_lowongan'");
$sql1->execute();

$cekSoal = $koneksiPdo->prepare("SELECT count(*) from soal where id_lowongan = '$id_lowongan'");
$cekSoal->execute();
$count = $cekSoal->fetchColumn();

if (isset($_GET['status_lamaran'])) {
    $status_lamaran = $_GET['status_lamaran'];
} else {
    $status_lamaran = "";
}


$sqlCountDitolak = $koneksiPdo->prepare("SELECT count(*) FROM lamaran where id_lowongan = '$id_lowongan' AND status_lamaran = 'Ditolak'");
$sqlCountDitolak->execute();

$sqlCountDiperiksa = $koneksiPdo->prepare("SELECT count(*) FROM lamaran where id_lowongan = '$id_lowongan' AND status_lamaran = 'Diperiksa'");
$sqlCountDiperiksa->execute();

$sqlCountTahapTes = $koneksiPdo->prepare("SELECT count(*) FROM lamaran where id_lowongan = '$id_lowongan' AND status_lamaran = 'Tahap Tes'");
$sqlCountTahapTes->execute();

$sqlCountLolos = $koneksiPdo->prepare("SELECT count(*) FROM lamaran where id_lowongan = '$id_lowongan' AND status_lamaran = 'Lolos'");
$sqlCountLolos->execute();

$countDitolak = $sqlCountDitolak->fetchColumn();
$countDiperiksa = $sqlCountDiperiksa->fetchColumn();
$countTahapTes = $sqlCountTahapTes->fetchColumn();
$countLolos = $sqlCountLolos->fetchColumn();


?>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Apply and Recruit</title>
</head>

<body>
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row gy-5 gx-md-5">
                <div class="col-lg-8">
                    <div class="d-flex align-items-top mb-5">
                        <img class="flex-shrink-0 img-fluid rounded me-4" src="<?php echo $data['logo'] ?>" loading="lazy" alt="Company Logo" style="width: 100px; height: 100px;">
                        <div>
                            <div class="d-flex flex-row">
                                <div>
                                    <h3 class="mb-1">
                                        <?php echo $data['posisi']; ?>
                                    </h3>
                                </div>
                                <?php
                                if (isset($_SESSION['company'])) { ?>
                                    <div class="mb-1 fw-bold">
                                        <?php if ($data['status_lowongan'] == "Non Aktif") { ?>
                                            <span class="badge bg-danger-subtle border border-danger-subtle text-danger-emphasis rounded ms-xl-2 my-1 fs-6">
                                                <?php echo $data['status_lowongan']; ?>
                                            </span>
                                        <?php } else { ?>
                                            <span class="badge bg-success-subtle border border-successs-subtle text-success-emphasis rounded ms-xl-2 my-1 fs-6">
                                                <?php echo $data['status_lowongan']; ?>
                                            </span>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <h5 class="text-muted mb-3">
                                <a href="<?php echo "company_profile.php?id_perusahaan=$data[id_perusahaan]"; ?>" class="text-decoration-none">
                                    <?php echo $data['nama_perusahaan']; ?>
                                </a>
                            </h5>
                            <div class="text-muted d-md-flex">
                                <p class="me-4"><i class="fa fa-map-marker-alt text-primary me-1"></i>
                                    <?php echo $data['lokasi_pekerjaan']; ?>
                                </p>
                                <p class="me-4"><i class="far fa-money-bill-alt text-primary me-1"></i>
                                    <?php
                                    $gaji = $data['gaji'];
                                    $gaji_format = number_format($gaji, 0, ",", ".");
                                    echo "Rp. " . $gaji_format . ",-"; ?>
                                </p>
                                <p><i class="fa-solid fa-calendar-days text-primary me-1"></i>
                                    <?php
                                    $tanggal_posting = date("j F Y", strtotime($data['tanggal_posting']));
                                    echo $tanggal_posting ?>
                                </p>
                            </div>
                            <form method="post">
                                <?php if (isset($_SESSION['company'])) {
                                    if ($data['status_lowongan'] == "Non Aktif") { ?>
                                        <button type="submit" name="aktif" onclick='return confirm("Apakah anda yakin ingin mengaktifkan lowongan?")' class="btn btn-success">Aktifkan</button>
                                    <?php } else { ?>
                                        <button type="submit" name="nonaktif" onclick='return confirm("Apakah anda yakin ingin menonaktifkan lowongan?")' class="btn btn-danger">Non Aktifkan</button>
                                    <?php }
                                    ?>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahLowongan">Ubah Lowongan</button>
                                <?php } ?>
                            </form>
                        </div>
                    </div>

                    <?php
                    if (isset($_SESSION['company'])) { ?>
                        <!-- Tabs navs -->
                        <ul class="nav nav-tabs mb-3" id="detail-lowongan" role="tablist">
                            <li class="nav-item w-25" role="presentation">
                                <a data-bs-tab-init class="nav-link " id="detail-lowongan-deskripsi" href="<?php echo "detail_lowongan.php?id_lowongan=$id_lowongan"; ?>" role="tab" aria-controls="detail-lowongan-deskripsi" aria-selected="true"><i class="fa-solid fa-info-circle fa-fw me-2"></i>Deskripsi</a>
                            </li>
                            <li class="nav-item w-25" role="presentation">
                                <a data-bs-tab-init class="nav-link" id="detail-lowongan-tes" href="<?php echo "detail_lowongan_tes.php?id_lowongan=$id_lowongan"; ?>" role="tab" aria-controls="detail-lowongan-tes" aria-selected="false"><i class="fas fa-clipboard-list fa-fw me-2"></i>Tes</a>
                            </li>
                            <li class="nav-item w-25" role="presentation">
                                <a data-bs-tab-init class="nav-link active" id="detail-lowongan-pelamar" href="<?php echo "detail_lowongan_pelamar.php?id_lowongan=$id_lowongan"; ?>" role="tab" aria-controls="detail-lowongan-pelamar" aria-selected="false"><i class="fa-solid fa-file-contract fa-fw me-2"></i>Pelamar</a>
                            </li>
                        </ul>
                        <!-- Tabs navs -->

                        <!-- Tabs content -->
                        <div class="tab-content" id="detail-lowongan">
                            <div class="tab-pane fade show active" id="detail-lowongan-pelamar" role="tabpanel" aria-labelledby="detail-lowongan-pelamar">
                                <div class="mb-5">
                                    <h4>Daftar Pelamar</h4>
                                    <p class="text-secondary">
                                        Klik pada foto pelamar jika ingin melihat profile detail pelamar
                                    </p>
                                    <form method="post">
                                        <div class="d-flex flex-row">
                                            <div class="menu-detail"><input type="submit" name="ditolak" value="Ditolak (<?php echo $countDitolak; ?>)" class="btn-pelamar"></div>
                                            <div class="menu-detail"><input type="submit" name="periksa_cv" value="Periksa CV (<?php echo $countDiperiksa; ?>)" class="btn-pelamar"></div>
                                            <div class="menu-detail"><input type="submit" name="tahap_tes" value="Tahap Tes (<?php echo $countTahapTes; ?>)" class="btn-pelamar"></div>
                                            <div class="menu-detail"><input type="submit" name="diterima" value="Lolos (<?php echo $countLolos; ?>)" class="btn-pelamar"></div>
                                        </div>
                                        <div class="mt-4 text-decoration-none text-black">
                                            <div class="mb-3">
                                                <?php
                                                // Pelamar Diperiksa
                                                if (isset($_POST['periksa_cv'])) {
                                                    $status_lamaran = "Diperiksa";
                                                    echo "<h4>List Applicant</h4>";
                                                } else if (isset($_POST['tahap_tes'])) {
                                                    $status_lamaran = "Tahap Tes";
                                                    echo "<h4>List Applicant Tahap Tes</h4>";
                                                } else if (isset($_POST['diterima'])) {
                                                    $status_lamaran = "Lolos";
                                                    echo "<h4>List Applicant Lolos</h4>";
                                                } else if (isset($_POST['ditolak'])) {
                                                    $status_lamaran = "Ditolak";
                                                    echo "<h4>List Applicant Ditolak</h4>";
                                                } else {
                                                }
                                                ?>
                                            </div>
                                            <?php
                                            if ($status_lamaran == "Tahap Tes") {

                                                $sqlSearch = $koneksiPdo->prepare("SELECT lamaran.*, hasil_tes.* FROM lamaran LEFT JOIN hasil_tes ON lamaran.id_lamaran = hasil_tes.id_lamaran
                                                    WHERE status_lamaran = 'Tahap Tes' and lamaran.id_lowongan = '$id_lowongan' ORDER BY hasil_tes.nilai DESC");
                                                $sqlSearch->execute();
                                            } else {
                                                $sqlSearch = $koneksiPdo->prepare("SELECT * FROM lamaran where status_lamaran = '$status_lamaran' and id_lowongan ='$id_lowongan'");
                                                $sqlSearch->execute();
                                            }


                                            while ($dataLamaran = $sqlSearch->fetch()) {
                                                $id_pelamar = $dataLamaran['id_pengguna'];
                                                $id_lamaran = $dataLamaran['id_lamaran'];
                                                $sqlDataPelamar = $koneksiPdo->prepare("SELECT * FROM pengguna where id_pengguna = '$id_pelamar'");
                                                $sqlDataPelamar->execute();

                                                while ($dataPelamar = $sqlDataPelamar->fetch()) {

                                                    $sqlCountHasilTes = $koneksiPdo->prepare("SELECT count(*) FROM hasil_tes where id_lamaran = '$id_lamaran'");
                                                    $sqlCountHasilTes->execute();

                                                    $countHasilTes = $sqlCountHasilTes->fetchColumn();

                                                    $sqlHasilTes = $koneksiPdo->prepare("SELECT * FROM hasil_tes where id_lamaran = '$id_lamaran'");
                                                    $sqlHasilTes->execute();

                                                    $dataHasilTes = $sqlHasilTes->fetch();

                                            ?>

                                                    <div class="card mb-3">
                                                        <div class="row g-0 align-items-center">
                                                            <div class="col-md-2 text-center p-lg-4 p-2 mt-4 mt-md-0 mt-lg-0">
                                                                <div class="d-flex align-items-center justify-content-center text-center mx-auto">
                                                                    <a href="<?php echo "user_profile.php?id_pengguna=$id_pelamar"; ?>" target="_blank"><img src="<?php echo $dataPelamar['foto']; ?>" class="rounded rounded-circle" alt="Apllicant Profile" style="width: 80px; height: 80px;"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="card-body d-md-flex flex-md-row flex-column align-items-start justify-content-between text-center text-md-start">
                                                                    <div>
                                                                        <h5 class="card-title">
                                                                            <?php echo $dataPelamar['nama']; ?>
                                                                        </h5>
                                                                        <ul class="list-inline text-secondary">
                                                                            <li class="list-inline-item me-3">
                                                                                <a href="<?php echo $dataLamaran['cv']; ?>" target='_blank' class="text-decoration-none"><i class="fa-solid fa-file-lines"></i> Buka CV</a>
                                                                            </li>
                                                                            <li class="list-inline-item">
                                                                                <i class="fa-solid fa-calendar-days"></i>
                                                                                <?php echo $dataLamaran['tanggal_kirim']; ?>
                                                                            </li>
                                                                            <li class="list-inline-item ms-5">
                                                                                <?php
                                                                                if ($countHasilTes == 0 && $status_lamaran == "Tahap Tes") { ?>
                                                                                    <span class="btn btn-warning">Belum Mengerjakan Tes</span>
                                                                                <?php } else if ($countHasilTes > 0 && $status_lamaran == "Tahap Tes") { ?>
                                                                                    <span class="bg-primary text-white fw-bold p-2" style="border-radius: 100px;"> Nilai Tes: <?php echo $dataHasilTes['nilai']; ?> </span>
                                                                                <?php } ?>
                                                                                <br>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="my-auto text-md-end text-center">
                                                                        <form method="post">
                                                                            <input type="text" value="<?php echo $id_lamaran; ?>" name="id_lamaran" hidden>
                                                                            <?php
                                                                            if ($status_lamaran == "Diperiksa") { ?>
                                                                                <input type="submit" value="Tolak" name="reject" class="btn btn-danger">
                                                                                <input type="submit" value="Terima" name="accept" class="btn btn-success">
                                                                            <?php } else if ($status_lamaran == "Ditolak") { ?>
                                                                                <span class="text-center text-white fw-bold bg-danger p-2">Telah Ditolak</sp>
                                                                                <?php } else if ($status_lamaran == "Diterima") { ?>

                                                                                    <?php } else {

                                                                                    if ($status_lamaran == "Lolos") {
                                                                                    } else if ($countHasilTes == 1) { ?>
                                                                                        <input type="submit" name="reject" class="btn btn-danger mt-3" value="Tolak">
                                                                                        <input type="button" name="lolos" class="btn btn-success mt-3" value="Terima" data-bs-toggle="modal" data-bs-target="#keteranganLanjut">
                                                                                <?php }
                                                                                } ?>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Keterangan Lanjut-->
                                                    <div class="modal fade" id="keteranganLanjut" tabindex="-1" aria-labelledby="keteranganLanjutLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="keteranganLanjutLabel">Keterangan Lanjut</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post">
                                                                        <div class="form-group">
                                                                            <label for="recipient-name" class="col-form-label">Keterangan:</label>
                                                                            <input type="text" name="id_lamaran" value="<?php echo $id_lamaran; ?>" hidden>
                                                                            <textarea class="form-control" id="informasi_hasil" name="informasi_hasil"></textarea>
                                                                        </div>
                                                                        <div class="form-group mt-5">
                                                                            <h5 class="text-secondary fs-6">*Note : harap berikan informasi lebih lanjut seperti interview melewati zoom atau interview langsung diperusahaan</h5>
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" name="keteranganLanjut" class="btn btn-primary">Konfirmasi</button>
                                                                </div>
                                                                <script>
                                                                    ClassicEditor
                                                                        .create(document.querySelector('#informasi_hasil'), {
                                                                            toolbar: {
                                                                                items: [
                                                                                    'undo', 'redo',
                                                                                    '|', 'heading',
                                                                                    '|', 'bold', 'italic',
                                                                                    '|', 'bulletedList', 'numberedList', 'blockQuote',
                                                                                ],
                                                                                shouldNotGroupWhenFull: false
                                                                            }
                                                                        })
                                                                        .catch(error => {
                                                                            console.log(error);
                                                                        });
                                                                </script>
                                    </form>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Keterangan Lanjut-->
                <?php }
                                            }
                ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Tabs content -->

<?php } ?>

</div>

<div class="col-lg-4">
    <div class="bg-light rounded p-4 mb-4 shadow-sm">
        <h4 class="mb-3">Ringkasan Lowongan</h4>
        <p><i class="fa fa-angle-right text-primary me-2"></i>Posisi:
            <?php echo $data['posisi']; ?>
        </p>
        <p><i class="fa fa-angle-right text-primary me-2"></i>Gaji:
            <?php
            echo "Rp. " . $gaji_format . ",-"; ?>
        </p>
        <p><i class="fa fa-angle-right text-primary me-2"></i>Lokasi:
            <?php echo $data['lokasi_pekerjaan']; ?>
        </p>
        <p><i class="fa fa-angle-right text-primary me-2"></i>Dipublish Pada:
            <?php echo $tanggal_posting ?>
        </p>
    </div>
    <div class="bg-light rounded p-4 shadow-sm">
        <h4 class="mb-3">Detail Perusahaan</h4>
        <p class="m-0">
            <?php echo $data['deskripsi_perusahaan']; ?>
        </p>
    </div>
</div>

<!-- Modal Ubah Lowongan-->
<div class="modal fade" id="ubahLowongan" tabindex="-1" aria-labelledby="ubahLowonganLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahLowonganLabel">Ubah Lowongan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Posisi:</label>
                        <input type="text" class="form-control" id="posisi" name="posisi" placeholder="Masukkan Posisi" value="<?php echo $data['posisi']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Departemen:</label>
                        <input type="text" class="form-control" id="departemen" name="departemen" placeholder="Masukkan Departemen" value="<?php echo $data['departemen']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Gaji:</label>
                        <input type="text" class="form-control" id="gaji" name="gaji" placeholder="Masukkan Departemen" value="<?php echo $data['gaji']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Lokasi Pekerjaan:</label>
                        <input type="text" class="form-control" id="lokasi_pekerjaan" name="lokasi_pekerjaan" placeholder="Masukkan Departemen" value="<?php echo $data['lokasi_pekerjaan']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Deskripsi Pekerjaan:</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan Departemen">
                            <?php echo htmlspecialchars_decode($data['deskripsi_pekerjaan']); ?>
                         </textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="ubahLowongan" class="btn btn-primary">Simpan Perubahan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Ubah Lowongan-->
</div>
</div>

<script>
    ClassicEditor
        .create(document.querySelector('#deskripsi'), {
            toolbar: {
                items: [
                    'undo', 'redo',
                    '|', 'heading',
                    '|', 'bold', 'italic',
                    '|', 'bulletedList', 'numberedList', 'blockQuote',
                ],
                shouldNotGroupWhenFull: false
            }
        })
        .catch(error => {
            console.log(error);
        });
</script>

</body>

<?php
if (isset($_POST['apply'])) {
    $cv = $_POST['cv'];
    $today = date("Ymd");

    $sqlTambahLowongan = $koneksiPdo->prepare("INSERT INTO lamaran(id_pengguna, id_lowongan, cv, tanggal_kirim, status_lamaran) 
        values('$id_pengguna','$id_lowongan','$cv','$today','Diperiksa')");
    $sqlTambahLowongan->execute();

    echo "<script>alert('Berhasil Melamar');</script>";
    echo "<script>location='my_application.php';</script>";
}

if (isset($_POST['ubahLowongan'])) {
    $posisi = $_POST['posisi'];
    $departemen = $_POST['departemen'];
    $gaji = $_POST['gaji'];
    $lokasi_pekerjaan = $_POST['lokasi_pekerjaan'];
    $deskripsi = $_POST['deskripsi'];
    $sqlUbahLowongan = $koneksiPdo->prepare("UPDATE lowongan_pekerjaan set posisi = '$posisi', departemen = '$departemen', gaji = '$gaji', lokasi_pekerjaan = '$lokasi_pekerjaan', deskripsi_pekerjaan = '$deskripsi' where id_lowongan = '$id_lowongan'");
    $sqlUbahLowongan->execute();

    echo "<script>alert('Berhasil mengubah lowongan');</script>";
    echo "<script>location='detail_lowongan.php?id_lowongan=$id_lowongan';</script>";
}

if (isset($_POST['reject'])) {
    $id_lamaran = $_POST['id_lamaran'];
    $sqlReject = $koneksiPdo->prepare("UPDATE lamaran set status_lamaran = 'Ditolak' where id_lamaran = '$id_lamaran'");
    $sqlReject->execute();

    echo "<script>alert('Telah ditolak');</script>";
    echo "<script>location='detail_lowongan_pelamar.php?id_lowongan=$id_lowongan&status_lamaran=Ditolak';</script>";
}

if (isset($_POST['accept'])) {
    $id_lamaran = $_POST['id_lamaran'];
    $sqlReject = $koneksiPdo->prepare("UPDATE lamaran set status_lamaran = 'Tahap Tes' where id_lamaran = '$id_lamaran'");
    $sqlReject->execute();

    echo "<script>alert('Telah diterima');</script>";
    echo "<script>location='detail_lowongan_pelamar.php?id_lowongan=$id_lowongan&status_lamaran=TahapTes';</script>";
}

if (isset($_POST['keteranganLanjut'])) {
    $id_lamaran = $_POST['id_lamaran'];
    $informasi_hasil = $_POST['informasi_hasil'];
    $sqlKeterangan = $koneksiPdo->prepare("UPDATE lamaran set status_lamaran = 'Lolos', informasi_hasil = '$informasi_hasil' where id_lamaran = '$id_lamaran'");
    $sqlKeterangan->execute();

    echo "<script>alert('Telah diterima');</script>";
    echo "<script>location='detail_lowongan_pelamar.php?id_lowongan=$id_lowongan&status_lamaran=Diterima';</script>";
}

if (isset($_POST['lolos'])) {
    $id_lamaran = $_POST['id_lamaran'];
    $sqlReject = $koneksiPdo->prepare("UPDATE lamaran set status_lamaran = 'Lolos' where id_lamaran = '$id_lamaran'");
    $sqlReject->execute();

    echo "<script>alert('Telah diterima');</script>";
    echo "<script>location='detail_lowongan_pelamar.php?id_lowongan=$id_lowongan&status_lamaran=Lolos';</script>";
}

if (isset($_POST['aktif'])) {
    $sqlAktif = $koneksiPdo->prepare("UPDATE lowongan_pekerjaan set status_lowongan = 'Aktif' where id_lowongan = '$id_lowongan'");
    $sqlAktif->execute();

    echo "<script>alert('Berhasil mengubah lowongan');</script>";
    echo "<script>location='detail_lowongan.php?id_lowongan=$id_lowongan';</script>";
}

if (isset($_POST['nonaktif'])) {
    $sqlAktif = $koneksiPdo->prepare("UPDATE lowongan_pekerjaan set status_lowongan = 'Non Aktif' where id_lowongan = '$id_lowongan'");
    $sqlAktif->execute();

    echo "<script>alert('Berhasil mengubah lowongan');</script>";
    echo "<script>location='detail_lowongan.php?id_lowongan=$id_lowongan';</script>";
}
?>

</html>