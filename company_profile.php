<?php
include 'navbar.php';

if (isset($_SESSION['company'])) {
    $id_perusahaan = $_SESSION['company']['id_perusahaan'];
    $sqlSession = $koneksiPdo->prepare("SELECT * FROM perusahaan where id_perusahaan = '$id_perusahaan'");
    $sqlSession->execute();
    $_SESSION['company'] = $sqlSession->fetch();
} else {
    $id_perusahaan = $_GET['id_perusahaan'];
}

$sql = $koneksiPdo->prepare("SELECT * FROM perusahaan where id_perusahaan = '$id_perusahaan'");
$sql->execute();
$data = $sql->fetch();

$sql1 = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where id_perusahaan = '$id_perusahaan'");
$sql1->execute();

?>
<!DOCTYPE html>
<?php
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Apply and Recruit</title>
</head>

<body>
    <style>
        .logo-tes {
            width: 5rem;
        }
    </style>
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row gy-5 gx-md-5">
                <div class="col-lg-12">
                    <div class="d-flex flex-shrink-0 mb-3">
                        <img class="img-fluid rounded-circle mt-3 me-5" src="<?php echo $data['logo']; ?>"
                            loading="lazy" alt="Company Logo"
                            style="width: 100px; height: 100px; object-fit: cover;border-radius: 100px;"
                            data-bs-toggle="modal" data-bs-target="#ubahFoto">

                        <div>
                            <h3 class="my-3">
                                <?php echo $data['nama_perusahaan']; ?>
                            </h3>
                            <div class="text-muted d-md-flex">
                                <p class="me-4"><i class="fa fa-envelope me-1"></i>
                                    <?php echo $data['email_perusahaan']; ?>
                                </p>
                                <p><i class="fa fa-phone-alt me-1"></i>
                                    <?php echo $data['nomor_telepon']; ?>
                                </p>
                            </div>
                            <div class="text-muted d-md-flex">
                                <p><i class="fa-solid fa-location-dot me-1"></i>
                                    <?php echo $data['alamat_perusahaan']; ?>
                                </p>
                            </div>
                            <?php
                            if (isset($_SESSION['company'])) { ?><button type="button" class="btn btn-warning"
                                    data-bs-toggle="modal" data-bs-target="#editProfile">Edit
                                    Profil</button>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h4 class="mb-3">Tentang</h4>
                        <p>
                            <?php echo $data['deskripsi_perusahaan']; ?>
                        </p>
                    </div>

                    <div class="mb-5">
                        <div class="d-flex flex-column">
                            <div class="text-center d-flex align-items-center justify-content-between">
                                <h4>Lowongan Kami</h4>
                            </div>
                            <hr>
                            <section class="py-8">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 mb-6 mb-md-0 py-4">

                                            <div class="row">
                                                <?php while ($data1 = $sql1->fetch()): ?>
                                                    <div class="col-lg-4 col-12 mb-4">
                                                        <div
                                                            class="card card-bordered card-hover shadow-sm cursor-pointer h-100">
                                                            <div class="card-body">
                                                                <div class="mb-3 text-center">
                                                                    <img src="<?php echo $data['logo']; ?>"
                                                                        alt="Company Logo" loading="lazy"
                                                                        class="rounded logo-tes mt-md-2">
                                                                </div>
                                                                <div class="w-100 mt-3">
                                                                    <div class="d-flex justify-content-between mb-4">
                                                                        <div>
                                                                            <h3 class="fs-4"><a
                                                                                    href="<?php echo "detail_lowongan.php?id_lowongan=$id_lowongan"; ?>"
                                                                                    class="text-dark text-decoration-none text-inherit">
                                                                                    <?php echo $data1['posisi']; ?>
                                                                                </a>
                                                                            </h3>
                                                                            <?php
                                                                            if (isset($_SESSION['company'])) { ?>
                                                                                <?php if ($data1['status_lowongan'] == "Non Aktif") { ?>
                                                                                    <span
                                                                                        class="badge bg-danger-subtle border border-danger-subtle text-danger-emphasis rounded my-1 fs-6">
                                                                                        <?php echo $data1['status_lowongan']; ?>
                                                                                    </span>
                                                                                <?php } else { ?>
                                                                                    <span
                                                                                        class="badge bg-success-subtle border border-successs-subtle text-success-emphasis rounded my-1 fs-6">
                                                                                        <?php echo $data1['status_lowongan']; ?>
                                                                                    </span>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div>
                                                                    <div class="mb-4 text-secondary fs-5">
                                                                        <div class="mb-2 mb-md-0">
                                                                            <div class="mt-1"> <i
                                                                                    class="fa-solid fa-building"></i><span
                                                                                    class="ms-1">
                                                                                    <?php echo $data1['departemen']; ?>
                                                                                </span></div>
                                                                            <div class="mt-1">
                                                                                <i
                                                                                    class="fa-solid fa-location-dot"></i><span
                                                                                    class="ms-1">
                                                                                    <?php echo $data1['lokasi_pekerjaan']; ?>
                                                                                </span>
                                                                            </div>
                                                                            <div class="mt-1">
                                                                                <i class="far fa-money-bill-alt"></i><span
                                                                                    class="ms-1 ">
                                                                                    <?php
                                                                                    $gaji = $data1['gaji'];
                                                                                    $gaji_format = number_format($gaji, 0, ",", ".");
                                                                                    echo "Rp. " . $gaji_format . ",-"; ?>
                                                                                </span>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div class="text-secondary">
                                                                            <i class="fa-regular fa-clock"></i><span>
                                                                                <?php
                                                                                $id_lowongan = $data1['id_lowongan'];
                                                                                $tanggal_posting = new DateTime($data1['tanggal_posting']);
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
                                                                                echo $selisih ?>
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
                                                <?php endwhile; ?>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </section>
                        </div>
                    </div>
                </div>

                <!-- Modal Ubah Profile-->
                <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="editProfileLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProfileLabel">Ubah Profil</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Foto:</label>
                                        <center> <img src="<?php echo $data['logo']; ?>"
                                                style="width: 200px; height: 200px;" class="form-control mb-3">
                                        </center>
                                        <input type="file" class="form-control" name="logo" id="logo" accept="image/*">
                                        <input type="text" value="<?php echo $data['logo']; ?>" name="gambarLama"
                                            hidden>
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Nama Perusahaan:</label>
                                        <input type="text" class="form-control" id="nama_perusahaan"
                                            name="nama_perusahaan" placeholder="Masukkan nama perusahaan anda"
                                            value="<?php echo $data['nama_perusahaan']; ?> ">
                                    </div>
                                    <div class=" form-group">
                                        <label for="recipient-name" class="col-form-label">Email Perusahaan:</label>
                                        <input type="email" class="form-control" id="email_perusahaan"
                                            name="email_perusahaan" placeholder="Masukkan email perusahaan anda"
                                            value="<?php echo $data['email_perusahaan']; ?> ">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Nomor telepon:</label>
                                        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon"
                                            placeholder="08**********" value="<?php echo $data['nomor_telepon']; ?> ">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Deskripsi Perusahaan:</label>
                                        <textarea class="form-control" id="deskripsi_perusahaan"
                                            name="deskripsi_perusahaan"
                                            placeholder="Tuliskan tentang perusahaan anda"><?php echo $data['deskripsi_perusahaan']; ?></textarea>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="ubahProfile" class="btn btn-primary">Simpan
                                    Perubahan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal Ubah Profile-->
                <?php
                if (isset($_POST['ubahProfile'])) {
                    $gambar_name = $_FILES['logo']['name'];
                    $gambar_tmp = $_FILES['logo']['tmp_name'];
                    $gambar_size = $_FILES['logo']['size'];
                    $gambar_type = $_FILES['logo']['type'];

                    if (empty($gambar_name) || !isset($gambar_name)) {
                        $tujuan = $_POST['gambarLama'];
                    } else {
                        $tujuan = "logo/" . $gambar_name;
                    }

                    $allowed_types = array("image/jpeg", "image/png", "image/gif");
                    if (in_array($gambar_type, $allowed_types)) {
                        // Pindahkan gambar ke lokasi tujuan
                        move_uploaded_file($gambar_tmp, $tujuan);
                        echo "Gambar berhasil diunggah.";
                    } else {
                        echo "Jenis file tidak didukung.";
                    }

                    $deskripsi = $_POST['deskripsi_perusahaan'];
                    $nama = $_POST['nama_perusahaan'];
                    $email = $_POST['email_perusahaan'];
                    $nomor_telepon = $_POST['nomor_telepon'];
                    $sqlEditTentang = $koneksiPdo->prepare("UPDATE perusahaan SET logo = '$tujuan', nama_perusahaan = '$nama', email_perusahaan = '$email', nomor_telepon = '$nomor_telepon', deskripsi_perusahaan = '$deskripsi' where id_perusahaan = '$id_perusahaan'");
                    $sqlEditTentang->execute();

                    $sqlSelectProfile = $koneksiPdo->prepare("SELECT * FROM perusahaan where id_perusahaan = '$id_perusahaan'");
                    $sqlSelectProfile->execute();

                    $_SESSION['company'] = $sqlSelectProfile->fetch();
                    echo "<script>alert('Profile berhasil diubah');</script>";
                    echo "<script>location='company_profile.php';</script>";
                }
                ?>
</body>

</html>