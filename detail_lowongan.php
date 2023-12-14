<?php
include 'navbar.php';
$id_lowongan = $_GET['id_lowongan'];

if (isset($_SESSION['user'])) {
    $id_pengguna = $_SESSION['user']['id_pengguna'];
    $sqlLamaranPengguna = $koneksiPdo->prepare("SELECT * FROM lamaran where id_pengguna = '$id_pengguna' AND id_lowongan = '$id_lowongan'");
    $sqlLamaranPengguna->execute();

    $cekLamaran = $koneksiPdo->prepare("SELECT count(*) from lamaran where id_pengguna = '$id_pengguna' and id_lowongan = '$id_lowongan'");
    $cekLamaran->execute();

    $countLamaran = $cekLamaran->fetchColumn();
}

// Lakukan JOIN antara tabel lowongan_pekerjaan dan perusahaan
$sql = $koneksiPdo->prepare("SELECT lp.*, p.* FROM lowongan_pekerjaan lp
                            INNER JOIN perusahaan p ON lp.id_perusahaan = p.id_perusahaan
                            WHERE lp.id_lowongan = $id_lowongan");
$sql->execute();
$data = $sql->fetch();



$sql1 = $koneksiPdo->prepare("SELECT * FROM soal where id_lowongan = '$id_lowongan'");
$sql1->execute();

$cekSoal = $koneksiPdo->prepare("SELECT count(*) from soal where id_lowongan = '$id_lowongan'");
$cekSoal->execute();
$count = $cekSoal->fetchColumn();

?>
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
                        <img class="flex-shrink-0 img-fluid rounded me-4" src="<?php
                        $id_perusahaan = $data['id_perusahaan'];
                        echo $data['logo']; ?>" alt="Company Logo" style="width: 100px; height: 100px;">
                        <div>
                            <div class="d-flex flex-column flex-md-row">
                                <div>
                                    <h3 class="mb-1">
                                        <?php echo $data['posisi']; ?>
                                    </h3>
                                </div>
                                <?php
                                if (isset($_SESSION['company']['id_perusahaan']) && $_SESSION['company']['id_perusahaan'] == $id_perusahaan) { ?>
                                    <div class="mb-1 fw-bold">
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
                                    </div>
                                <?php } ?>
                            </div>
                            <h5 class="text-muted mb-3">
                                <a href="<?php echo "company_profile.php?id_perusahaan=$data[id_perusahaan]"; ?>"
                                    class="text-decoration-none">
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
                                <?php if (isset($_SESSION['company']['id_perusahaan']) && $_SESSION['company']['id_perusahaan'] == $id_perusahaan) {
                                    if ($data['status_lowongan'] == "Non Aktif") { ?>
                                        <button type="submit" name="aktif"
                                            onclick='return confirm("Apakah anda yakin ingin mengaktifkan lowongan?")'
                                            class="btn btn-success">Aktifkan</button>
                                    <?php } else { ?>
                                        <button type="submit" name="nonaktif"
                                            onclick='return confirm("Apakah anda yakin ingin menonaktifkan lowongan?")'
                                            class="btn btn-danger">Non Aktifkan</button>
                                    <?php }
                                    ?>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#ubahLowongan">Ubah Lowongan</button>
                                <?php } ?>
                            </form>
                        </div>
                    </div>

                    <?php if (isset($_SESSION['user']) || (isset($_SESSION['company']['id_perusahaan']) && $_SESSION['company']['id_perusahaan'] !== $id_perusahaan)) { ?>
                        <div class="mb-5">
                            <h4 class="mb-3">Deskripsi Pekerjaan</h4>
                            <p>
                                <?php echo $data['deskripsi_pekerjaan']; ?>
                            </p>
                        </div>
                        <?php
                        if (isset($_SESSION['user'])) {
                            if ($countLamaran == 0) {
                                ?>
                                <div>
                                    <h4 class="mb-4">Lamar Cepat</h4>
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <p class="text-secondary">
                                                    Unggah CV Anda
                                                </p>
                                                <input type="file" name="cv" class="form-control bg-white" required>
                                            </div>
                                            <div class="col-12">
                                                <button name="apply" class="btn btn-primary w-100"
                                                    onclick='return confirm("Apakah Anda Yakin?")' type="submit">Lamar
                                                    Sekarang</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div>
                                    <h4 class="mb-4">Status Lamaran</h4>

                                    <div class="row g-3">
                                        <div class="alert alert-warning">
                                            <p class="text-center">Anda belum melamar. Ayo mulai lamarkan diri anda!</p>
                                        </div>
                                    </div>

                                </div>
                                <?php
                            } ?>
                            <?php if ($countLamaran !== 0) {
                                ?>
                                <div>
                                    <h4 class="mb-4">Status Lamaran</h4>

                                    <div class="row g-3">
                                        <?php while ($dataLamaran = $sqlLamaranPengguna->fetch()) {
                                            // Mendapatkan data lamaran
                                            $id_lowongan = $dataLamaran['id_lowongan'];
                                            $id_lamaran = $dataLamaran['id_lamaran'];
                                            $status_lamaran = $dataLamaran['status_lamaran'];

                                            // Query untuk mengambil data lowongan pekerjaan
                                            $sqlLowongan = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where id_lowongan = '$id_lowongan'");
                                            $sqlLowongan->execute();

                                            // Query untuk menghitung jumlah hasil tes
                                            $sqlCountHasilTes = $koneksiPdo->prepare("SELECT * FROM hasil_tes where id_lamaran = '$id_lamaran'");
                                            $sqlCountHasilTes->execute();

                                            // Mendapatkan jumlah hasil tes
                                            $countHasilTes = $sqlCountHasilTes->rowCount();

                                            while ($dataLowongan = $sqlLowongan->fetch()) {
                                                // Mendapatkan data lowongan pekerjaan
                                                $tanggal_posting = date("j F Y", strtotime($dataLowongan['tanggal_posting']));
                                                $id_perusahaan = $dataLowongan['id_perusahaan'];

                                                // Query untuk mengambil data perusahaan
                                                $sqlPerusahaan = $koneksiPdo->prepare("SELECT * FROM perusahaan where id_perusahaan = '$id_perusahaan'");
                                                $sqlPerusahaan->execute();

                                                $dataPerusahaan = $sqlPerusahaan->fetch();
                                                ?>
                                                <!-- Markup untuk menampilkan detail lamaran -->
                                                <div class="card mb-3 mx-2 shadow-sm">
                                                    <div class="row g-0 align-items-center">
                                                        <div class="col-md-2 text-center p-lg-4 mt-4 mt-md-0">
                                                            <div
                                                                class="d-flex align-items-center justify-content-center text-center mx-auto">
                                                                <img src="<?php echo $dataPerusahaan['logo'] ?>" class="rounded"
                                                                    alt="Company Logo" style="width: 100px; height: 100px;">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <div
                                                                class="card-body d-md-flex flex-md-row flex-column align-md-items-start align-items-center justify-content-between text-start">
                                                                <div>
                                                                    <div class="d-flex flex-row">
                                                                        <div class="me-2">
                                                                            <h5 class="card-title">
                                                                                <?php echo $dataLowongan['posisi']; ?>
                                                                            </h5>
                                                                        </div>
                                                                        <div class="text-secondary">
                                                                            <?php
                                                                            if ($status_lamaran == 'Diperiksa') {
                                                                                echo "<span class='text-warning fw-bold'>(Status: " . $dataLamaran['status_lamaran'] . ")</span>";
                                                                            } else if ($status_lamaran == 'Tahap Tes') {
                                                                                echo "<span class='text-primary fw-bold'>(Status: " . $dataLamaran['status_lamaran'] . ")</span>";
                                                                            } else if ($status_lamaran == 'Ditolak') {
                                                                                echo "<span class='text-danger fw-bold'>(Status: " . $dataLamaran['status_lamaran'] . ")</span>";
                                                                            } else if ($status_lamaran == 'Lolos') {
                                                                                echo "<span class='text-success fw-bold'>(Status: " . $dataLamaran['status_lamaran'] . ")</span>";
                                                                            } ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-secondary">
                                                                        <span>Dikirim pada
                                                                            <?php
                                                                            $tanggal_lamaran = date("j F Y", strtotime($dataLamaran['tanggal_kirim']));
                                                                            echo $tanggal_lamaran; ?>
                                                                        </span>
                                                                    </div>
                                                                    <ul class="list-inline text-secondary">
                                                                        <li class="list-inline-item me-3">
                                                                            <i class="fa-solid fa-location-dot"></i>
                                                                            <?php echo $dataLowongan['lokasi_pekerjaan']; ?>
                                                                        </li>
                                                                        <li class="list-inline-item me-3 mt-3">
                                                                            <i class="far fa-money-bill-alt"></i>
                                                                            <?php
                                                                            $gaji = $dataLowongan['gaji'];
                                                                            $gaji_format = number_format($gaji, 0, ",", ".");
                                                                            echo "Rp. " . $gaji_format . ",-"; ?>
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            <i class="fa-solid fa-calendar-days"></i>
                                                                            <?php echo $tanggal_posting ?>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="text-md-end text-center">
                                                                    <?php
                                                                    if ($status_lamaran == "Diperiksa") { ?>
                                                                        <button class="btn btn-warning w-100" disabled>Kerjakan Tes</button>
                                                                    <?php } else if ($status_lamaran == "Ditolak") { ?>
                                                                            <button class="btn btn-danger w-100" disabled>Telah Ditolak</button>
                                                                    <?php } else if ($status_lamaran == "Tahap Tes") {
                                                                        if ($countHasilTes == 0) {
                                                                            ?>
                                                                                    <a
                                                                                        href="<?php echo "tes.php?id_lamaran=$id_lamaran&id_lowongan=$id_lowongan"; ?>"><button
                                                                                            class="btn btn-primary w-100">Kerjakan Tes</button></a>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                                    <a href=#><button class="btn btn-info w-100" disabled>Sedang
                                                                                            Diproses</button></a>
                                                                            <?php
                                                                        }
                                                                    } else if ($status_lamaran == "Lolos") { ?>
                                                                                    <a href="<?php echo "keterangan_hasil.php?id_lamaran=$id_lamaran"; ?>"><button
                                                                                            class="btn btn-success w-100">Lolos</button></a>
                                                                    <?php } else { ?>
                                                                                    <button class="btn btn-info w-100" disabled>Sedang Diproses</button>
                                                                    <?php } ?>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        } ?>
                                    </div>

                                </div>
                                <?php
                            } ?>
                        <?php }
                    }
                    ?>

                    <?php if (isset($_SESSION['company']['id_perusahaan']) && $_SESSION['company']['id_perusahaan'] == $id_perusahaan) { ?>
                        <!-- Tabs navs -->
                        <ul class="nav nav-tabs mb-3" id="detail-lowongan" role="tablist">
                            <li class="nav-item w-25" role="presentation">
                                <a data-bs-tab-init class="nav-link active" id="detail-lowongan-deskripsi"
                                    href="<?php echo "detail_lowongan.php?id_lowongan=$id_lowongan"; ?>" role="tab"
                                    aria-controls="detail-lowongan-deskripsi" aria-selected="true"><i
                                        class="fa-solid fa-info-circle fa-fw me-2"></i>Deskripsi</a>
                            </li>
                            <li class="nav-item w-25" role="presentation">
                                <a data-bs-tab-init class="nav-link" id="detail-lowongan-tes"
                                    href="<?php echo "detail_lowongan_tes.php?id_lowongan=$id_lowongan"; ?>" role="tab"
                                    aria-controls="detail-lowongan-tes" aria-selected="false"><i
                                        class="fas fa-clipboard-list fa-fw me-2"></i>Tes</a>
                            </li>
                            <li class="nav-item w-25" role="presentation">
                                <a data-bs-tab-init class="nav-link" id="detail-lowongan-pelamar"
                                    href="<?php echo "detail_lowongan_pelamar.php?id_lowongan=$id_lowongan"; ?>" role="tab"
                                    aria-controls="detail-lowongan-pelamar" aria-selected="false"><i
                                        class="fa-solid fa-file-contract fa-fw me-2"></i>Pelamar</a>
                            </li>
                        </ul>
                        <!-- Tabs navs -->

                        <!-- Tabs content -->
                        <div class="tab-content" id="detail-lowongan">
                            <div class="tab-pane fade show active" id="detail-lowongan-deskripsi" role="tabpanel"
                                aria-labelledby="detail-lowongan-deskripsi">
                                <div class="mb-5">
                                    <h4 class="mb-3">Deskripsi Pekerjaan</h4>
                                    <p style="text-align: justify;">
                                        <?php echo htmlspecialchars_decode($data['deskripsi_pekerjaan']); ?>
                                    </p>
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
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Dipublish pada:
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
                <div class="modal fade" id="ubahLowongan" tabindex="-1" aria-labelledby="ubahLowonganLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ubahLowonganLabel">Ubah Lowongan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Posisi:</label>
                                        <input type="text" class="form-control" id="posisi" name="posisi"
                                            placeholder="Masukkan Posisi" value="<?php echo $data['posisi']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Departemen:</label>
                                        <input type="text" class="form-control" id="departemen" name="departemen"
                                            placeholder="Masukkan Departemen"
                                            value="<?php echo $data['departemen']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Gaji:</label>
                                        <input type="text" class="form-control" id="gaji" name="gaji"
                                            placeholder="Masukkan Departemen" value="<?php echo $data['gaji']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Lokasi Pekerjaan:</label>
                                        <input type="text" class="form-control" id="lokasi_pekerjaan"
                                            name="lokasi_pekerjaan" placeholder="Masukkan Departemen"
                                            value="<?php echo $data['lokasi_pekerjaan']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Deskripsi Pekerjaan:</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi"
                                            placeholder="Masukkan dekripsi_pekerjaan"><?php echo $data['deskripsi_pekerjaan']; ?></textarea>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <a href="<?php echo "delete_vacancy.php?id_lowongan=$data[id_lowongan]" ?>"><button
                                        type="button" name="hapus" class="btn btn-danger"
                                        onclick='return confirm("Apakah Anda Yakin?")'>Hapus</button></a>
                                <button type="submit" name="ubahLowongan" class="btn btn-primary">Simpan
                                    Perubahan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal Ubah Lowongan-->
            </div>
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
    $cv_name = $_FILES['cv']['name'];
    $cv_tmp = $_FILES['cv']['tmp_name'];
    $cv_size = $_FILES['cv']['size'];
    $cv_type = $_FILES['cv']['type'];

    $tujuan = "cv/" . $cv_name;

    $allowedTypes = array('application/pdf');
    if (in_array($cv_type, $allowedTypes)) {
        if (move_uploaded_file($cv_tmp, $tujuan)) {
            echo "CV berhasil diunggah.";
        } else {
            echo "Terjadi kesalahan saat mengunggah file.";
        }
    } else {
        echo "Format file tidak valid. Harap unggah file PDF.";
    }
    $today = date("Ymd");
    $sqlTambahLowongan = $koneksiPdo->prepare("INSERT INTO lamaran(id_pengguna, id_lowongan, cv, tanggal_kirim, status_lamaran) 
        values('$id_pengguna','$id_lowongan','$tujuan','$today','Diperiksa')");
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