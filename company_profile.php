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
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row gy-5 gx-md-5">
                <div class="col-lg-12">
                    <div class="d-flex flex-shrink-0 mb-3">
                        <?php
                        $profilePicture = isset($data['foto_perusahaan']) ? 'assets/img/' . $data['foto_perusahaan'] : 'assets/img/profile.png';
                        ?>
                        <img class="img-fluid rounded me-4" src="<?php echo $profilePicture; ?>" loading="lazy"
                            alt="User Logo" style="width: 100px; height: 100px;">
                        <div>
                            <h3 class="mb-1">
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
                            if (isset($_SESSION['company'])) { ?><button type="button" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#editProfile">Edit
                                    Profile</button>
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
                                <h4>Our Vacancy</h4>
                            </div>
                            <hr>
                            <div class="row row-cols-2 row-cols-md-3 g-4">
                                <?php while ($data1 = $sql1->fetch()): ?>
                                    <div class="col">
                                        <div class="card">
                                            <div class="row g-0 align-items-center">
                                                <div class="col-md-4">
                                                    <?php
                                                    $profilePicture = isset($_SESSION['company']['foto_perusahaan']) ? 'assets/img/' . $_SESSION['company']['foto_perusahaan'] : 'assets/img/profile.png';
                                                    ?>
                                                    <div
                                                        class="d-flex align-items-center justify-content-center text-center pt-3 pb-md-5">
                                                        <img src="<?php echo $profilePicture ?>" alt="FD Image"
                                                            style="width: 70px; height: 70px;">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title">
                                                            <?php echo $data1['posisi']; ?>
                                                        </h5>
                                                        <ul class="list-unstyled text-secondary d-flex flex-column">
                                                            <li class="mb-1 me-3">
                                                                <i class="fa-solid fa-building"></i>
                                                                <?php echo $data1['departemen']; ?>
                                                            </li>
                                                            <li class="mb-1 me-3">
                                                                <i class="fa-solid fa-location-dot"></i>
                                                                <?php echo $data1['lokasi_pekerjaan']; ?>
                                                            </li>
                                                            <li class="mb-1">
                                                                <i class="far fa-money-bill-alt"></i>
                                                                <?php
                                                                $harga = $data1['gaji'];
                                                                $harga_format = number_format($harga, 0, ",", ".");
                                                                echo "Rp. " . $harga_format . ",-"; ?>
                                                            </li>
                                                        </ul>
                                                        <div class="text-end">
                                                            <?php $id_lowongan = $data1['id_lowongan'];
                                                            echo "<a href='detail_lowongan.php?id_lowongan=$id_lowongan'>"; ?>
                                                            <button class="btn btn-secondary">See Detail</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer d-md-flex justify-content-between text-secondary">
                                                    <small class="text-center">
                                                        <i class="fa-solid fa-calendar-days"></i> Posted
                                                        <?php
                                                        $tanggal_posting = date("j F Y", strtotime($data1['tanggal_posting']));
                                                        echo $tanggal_posting ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Ubah Profile-->
                <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="editProfileLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProfileLabel">Ubah Profile</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
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
                                <button type="submit" name="ubahProfile" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal Ubah Profile-->
                <?php
                if (isset($_POST['ubahProfile'])) {
                    $deskripsi = $_POST['deskripsi_perusahaan'];
                    $nama = $_POST['nama_perusahaan'];
                    $email = $_POST['email_perusahaan'];
                    $nomor_telepon = $_POST['nomor_telepon'];
                    $sqlEditTentang = $koneksiPdo->prepare("UPDATE perusahaan SET nama_perusahaan = '$nama', email_perusahaan = '$email', nomor_telepon = '$nomor_telepon', deskripsi_perusahaan = '$deskripsi' where id_perusahaan = '$id_perusahaan'");
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