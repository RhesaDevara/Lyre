<?php
include 'navbar.php';
$id_lowongan = $_GET['id_lowongan'];

if (isset($_SESSION['user'])) {
    $id_pengguna = $_SESSION['user']['id_pengguna'];
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Admin</title>

    <head>

        <!-- Referensi Popper.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

        <!-- Referensi Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </head>

</head>

<body>
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row gy-5 gx-md-5">
                <div class="col-lg-8">
                    <div class="d-flex align-items-top mb-5">
                        <img class="flex-shrink-0 img-fluid rounded me-4" src="<?php echo $data['logo'] ?>" alt="Company Logo" style="width: 100px; height: 100px;">
                        <div>
                            <div class="d-flex flex-row">
                                <div>
                                    <h3 class="mb-1">
                                        <?php echo $data['posisi']; ?>
                                    </h3>
                                </div>
                                <div class="mt-2 ms-2"> <b>
                                        <?php if ($data['status_lowongan'] == "Non Aktif") { ?>
                                            <font color="red">(<?php echo $data['status_lowongan']; ?>)</font>
                                        <?php } else { ?>
                                            <font color="green">(<?php echo $data['status_lowongan']; ?>)</font>
                                        <?php } ?>
                                    </b>
                                </div>
                            </div>
                            <h5 class="text-muted mb-3">
                                <a href="<?php echo "company_profile.php?id_perusahaan=$data[id_perusahaan]"; ?>" style="text-decoration: none"><?php echo $data['nama_perusahaan']; ?></a>
                            </h5>
                            <div class="text-muted d-md-flex">
                                <p class="me-4"><i class="fa fa-map-marker-alt text-primary me-1"></i>
                                    <?php echo $data['lokasi_pekerjaan']; ?>
                                </p>
                                <p class="me-4"><i class="far fa-money-bill-alt text-primary me-1"></i>
                                    <?php
                                    $harga = $data['gaji'];
                                    $harga_format = number_format($harga, 0, ",", ".");
                                    echo "Rp. " . $harga_format . ",-"; ?>
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
                                        <input type="submit" name="aktif" onclick='return confirm("Apakah anda yakin ingin mengaktifkan lowongan?")' class="btn btn-success" value="Aktifkan">
                                    <?php } else { ?>
                                        <input type="submit" name="nonaktif" onclick='return confirm("Apakah anda yakin ingin menonaktifkan lowongan?")' class="btn btn-danger" value="Non Aktifkan">
                                    <?php }
                                    ?>
                                    <input type="button" class="btn btn-warning" value="Ubah Lowongan" data-toggle="modal" data-target="#ubahLowongan">
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                    <?php
                    if (isset($_SESSION['company'])) { ?>
                        <div style="width:100%; border: 0px solid black;" class="d-flex flex-row mb-5">
                            <a href=<?php echo "detail_lowongan.php?id_lowongan=$id_lowongan"; ?> class="menu-detail-aktif">
                                <div>Deskripsi</div>
                            </a>
                            <a href=<?php echo "detail_lowongan_tes.php?id_lowongan=$id_lowongan"; ?> class="menu-detail">
                                <div>Tes</div>
                            </a>
                            <a href=<?php echo "detail_lowongan_pelamar.php?id_lowongan=$id_lowongan"; ?> class="menu-detail">
                                <div>Pelamar</div>
                            </a>
                        </div>
                    <?php } ?>
                    <div class="mb-5">
                        <h4 class="mb-3">Job Description</h4>
                        <p style="text-align: justify;">
                            <?php echo $data['deskripsi_pekerjaan']; ?>
                        </p>
                    </div>

                    <?php if (isset($_SESSION['user'])) {
                        if ($countLamaran == 0) { ?>

                            <div>
                                <h4 class="mb-4">Quick Apply</h4>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <p>
                                                <font color="grey"> Unggah CV Anda (.pdf)</font>
                                            </p>
                                            <input type="file" class="form-control" name="cv" accept=".pdf" required>
                                            <br>
                                        </div>
                                        <div class="col-12">
                                            <button name="apply" class="btn btn-primary w-100" onclick='return confirm("Apakah Anda Yakin?")' type="submit">Apply Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                </div>
            <?php
                        } else { ?>
                <div>
                    <h4 class="mb-4">Lamaran Diterima</h4>
                    <div class="row g-3">
                        <div class="col-12">
                        </div>
                        <div class="col-12">
                            <a href="my_application.php"><button name="apply" class="btn btn-primary w-100" type="button">Lihat Status</button></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
                    } else if (isset($_SESSION['company'])) { ?>

        <div>
            <form action="soal_tambah.php" method="post">
                <div class="row g-3">

                    <!-- Modal tambah soal -->
                    <div class="modal fade" id="jumlahSoal" tabindex="-1" role="dialog" aria-labelledby="jumlahSoalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Soal</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>


                                <div class="modal-body">
                                    <form method="post" action="soal_tambah.php">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Jumlah Soal:</label> <input type="text" name="id_lowongan" value="<?php echo $id_lowongan; ?>" hidden>
                                            <input type="text" class="form-control" id="jumlah_soal" name="jumlah_soal" placeholder="Tuliskan jumlah soal"></textarea>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <input type="submit" name="tambahKeahlian" class="btn btn-primary" value="Konfirmasi">
                                </div>

            </form>
        </div>
        </div>
    </div>
    </div>
    </form>
    </div>
    </div>
<?php } else { ?>
    <div>
        <form>
            <div class="row g-3">

            </div>
        </form>
    </div>
    </div>
<?php } ?>

<div class="col-lg-4">
    <div class="bg-light rounded p-4 mb-4">
        <h4 class="mb-3">Job Summary</h4>
        <p><i class="fa fa-angle-right text-primary me-2"></i>Vacancy:
            <?php echo $data['posisi']; ?>
        </p>
        <p><i class="fa fa-angle-right text-primary me-2"></i>Salary:
            <?php
            echo "Rp. " . $harga_format . ",-"; ?>
        </p>
        <p><i class="fa fa-angle-right text-primary me-2"></i>Location:
            <?php echo $data['lokasi_pekerjaan']; ?>
        </p>
        <p><i class="fa fa-angle-right text-primary me-2"></i>Published On:
            <?php echo $tanggal_posting ?>
        </p>
    </div>
    <div class="bg-light rounded p-4">
        <h4 class="mb-3">Company Detail</h4>
        <p class="m-0">
            <?php echo $data['deskripsi_perusahaan']; ?>
        </p>
    </div>
</div>
</div>
</div>
</div>

<!-- Modal tambah soal -->
<div class="modal fade" id="ubahLowongan" tabindex="-1" role="dialog" aria-labelledby="ubahLowonganLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lowongan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span> </button>
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
                        <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan Departemen"><?php echo $data['deskripsi_pekerjaan']; ?>
                         </textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <input type="submit" name="ubahLowongan" class="btn btn-primary" value="Konfirmasi">
            </div>
            </form>
        </div>
    </div>
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