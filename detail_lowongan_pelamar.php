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

if (isset($_GET['status_lamaran'])) {
    $status_lamaran = $_GET['status_lamaran'];
} else {
    $status_lamaran = "";
}

// $sqlAmbilDiperiksa = $koneksiPdo->prepare("SELECT * from lamaran where id_lowongan = '$id_lowongan' and status_lamaran = 'Diperiksa'");
// $sqlAmbilDiperiksa->execute();

// $sqlAmbilDitolak = $koneksiPdo->prepare("SELECT * from lamaran where id_lowongan = '$id_lowongan' and status_lamaran = 'Ditolak'");
// $sqlAmbilDitolak->execute();

// $sqlAmbilTahapTes = $koneksiPdo->prepare("SELECT * from lamaran where id_lowongan = '$id_lowongan' and status_lamaran = 'Tahap Tes'");
// $sqlAmbilTahapTes->execute();

// $sqlAmbilDiterima = $koneksiPdo->prepare("SELECT * from lamaran where id_lowongan = '$id_lowongan' and status_lamaran = 'Diterima'");
// $sqlAmbilDiterima->execute();

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
                                <div class="mt-2 ms-2"><b>
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
                    <div style="width:100%; border: 0px solid black;" class="d-flex flex-row mb-5">
                        <a href=<?php echo "detail_lowongan.php?id_lowongan=$id_lowongan"; ?> class="menu-detail">
                            <div>Deskripsi</div>
                        </a>
                        <a href=<?php echo "detail_lowongan_tes.php?id_lowongan=$id_lowongan"; ?> class="menu-detail">
                            <div>Tes</div>
                        </a>
                        <a href=<?php echo "detail_lowongan_pelamar.php?id_lowongan=$id_lowongan"; ?> class="menu-detail-aktif">
                            <div>Pelamar</div>
                        </a>
                    </div>
                    <div class="mb-5">
                        <h4>Daftar Pelamar</h4>
                        <i>
                            <font color="grey">Klik pada foto pelamar jika ingin melihat profile detail pelamar</font>
                        </i>
                        <form method="post">
                            <div class="d-flex flex-row">
                                <div class="menu-detail"><input type="submit" name="ditolak" value="Ditolak" class="btn-pelamar"></div>
                                <div class="menu-detail"><input type="submit" name="periksa_cv" value="Periksa CV" class="btn-pelamar"></div>
                                <div class="menu-detail"><input type="submit" name="tahap_tes" value="Tahap Tes" class="btn-pelamar"></div>
                                <div class="menu-detail"><input type="submit" name="diterima" value="Lolos" class="btn-pelamar"></div>
                            </div>
                            <div class="mt-4" style="text-decoration: none; color:black;">
                                <?php
                                // Pelamar Diperiksa
                                if (isset($_POST['periksa_cv'])) {
                                    $status_lamaran = "Diperiksa";
                                } else if (isset($_POST['tahap_tes'])) {
                                    $status_lamaran = "Tahap Tes";
                                } else if (isset($_POST['diterima'])) {
                                    $status_lamaran = "Lolos";
                                } else if (isset($_POST['ditolak'])) {
                                    $status_lamaran = "Ditolak";
                                } else {
                                }

                                $sqlSearch = $koneksiPdo->prepare("SELECT * FROM lamaran where status_lamaran = '$status_lamaran' and id_lowongan ='$id_lowongan'");
                                $sqlSearch->execute();

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
                                        <div class="vacancy-container mt-4" style="text-decoration: none; color:black;">
                                            <a href=<?php echo "user_profile.php?id_pengguna=$id_pelamar"; ?>><img src="<?php echo $dataPelamar['foto']; ?>" class="img-vacancy"></a>
                                            <div class="vacancy-details">
                                                <div class="vacancy-item-container">
                                                    <div class="d-flex flex-column">
                                                        <div class="posisi"><?php echo $dataPelamar['nama']; ?></div>
                                                        <div>
                                                            <a href="<?php echo $dataLamaran['cv']; ?>" target='_blank'>Buka CV</a>
                                                        </div>
                                                    </div>
                                                    <div><?php echo $dataLamaran['tanggal_kirim']; ?></div>
                                                    <div>
                                                        <form method="post" class="mt-3">
                                                            <input type="text" value="<?php echo $id_lamaran; ?>" name="id_lamaran" hidden>
                                                            <?php
                                                            if ($status_lamaran == "Diperiksa") { ?>
                                                                <input type="submit" value="Tolak" name="reject" class="btn btn-danger">
                                                                <input type="submit" value="Terima" name="accept" class="btn btn-success">
                                                            <?php } else if ($status_lamaran == "Ditolak") { ?>
                                                                <!-- <input type="button" class="btn btn-danger" value="Telah Ditolak"> -->
                                                                <font color="red"> <b> Telah Ditolak </b></font>
                                                            <?php } else if ($status_lamaran == "Diterima") { ?>

                                                                <!-- <input type="button" class="btn btn-success" value="Telah Diterima"> -->

                                                                <?php } else {
                                                                if ($countHasilTes == 0) { ?>
                                                                    <font color="orange"> <b> Belum Mengerjakan </b></font>
                                                                    <?php } else {
                                                                    if ($dataHasilTes['nilai'] < 80) { ?>
                                                                        <font color="red"> Nilai: <b> <?php echo $dataHasilTes['nilai']; ?> (Gagal) </b></font>
                                                                    <?php
                                                                    } else { ?>
                                                                        <font color="green"> Nilai: <b> <?php echo $dataHasilTes['nilai']; ?> (Berhasil) </b></font>
                                                                <?php }
                                                                } ?>
                                                                <br>
                                                                <?php
                                                                if ($status_lamaran == "Lolos") {
                                                                } else { ?>
                                                                    <input type="submit" name="reject" class="btn btn-danger me-2" value="Tolak">
                                                                    <input type="button" name="lolos" class="btn btn-success" value="Terima" data-toggle="modal" data-target="#keteranganLanjut">
                                                            <?php }
                                                            } ?>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal keterangan lanjut -->
                                        <div class="modal fade" id="keteranganLanjut" tabindex="-1" role="dialog" aria-labelledby="keteranganLanjutLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Undangan Lanjut</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span> </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form method="post">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Keterangan:</label>
                                                                <input type="text" name="id_lamaran" value="<?php echo $id_lamaran; ?>" hidden>
                                                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan">
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <input type="submit" name="keteranganLanjut" class="btn btn-primary" value="Konfirmasi">
                                                    </div>
                        </form>
                    </div>
                </div>
            </div>
    <?php }
                                }
    ?>
        </div>
    </div> <?php
            if (isset($_SESSION['user'])) {
                if ($countLamaran == 0) { ?>

            <div>
                <h4 class="mb-4">Quick Apply</h4>
                <form method="post">
                    <div class="row g-3">
                        <div class="col-12">
                            <p>
                                <font color="grey"> Unggah CV Anda </font>
                            </p>
                            <input type="file" name="cv" class="form-control bg-white" required>
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
    </div>
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
    $informasi_hasil = $_POST['keterangan'];
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