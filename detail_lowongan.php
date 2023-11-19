<?php
include 'navbar.php';
$id_lowongan = $_GET['id_lowongan'];

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
</head>

<body>
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row gy-5 gx-md-5">
                <div class="col-lg-8">
                    <div class="d-flex align-items-top mb-5">
                        <?php
                        $profilePicture = isset($_SESSION['company']['foto_perusahaan']) ? 'assets/img/' . $_SESSION['company']['foto_perusahaan'] : 'assets/img/profile.png';
                        ?>
                        <img class="flex-shrink-0 img-fluid rounded me-4" src="<?php echo $profilePicture ?>"
                            alt="Company Logo" style="width: 70px; height: 70px;">
                        <div>
                            <h3 class="mb-1">
                                <?php echo $data['posisi']; ?>
                            </h3>
                            <h5 class="text-muted mb-3">
                                <?php echo $data['nama_perusahaan']; ?>
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
                        </div>
                    </div>

                    <div class="mb-5">
                        <h4 class="mb-3">Job Description</h4>
                        <p>
                            <?php echo $data['deskripsi_pekerjaan']; ?>
                        </p>
                    </div>

                    <?php if(isset($_SESSION['user'])){ ?>

                    <div>
                        <h4 class="mb-4">Apply For The Job</h4>
                        <form>
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control" placeholder="Your Name">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" class="form-control" placeholder="Your Email">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control" placeholder="Portfolio Website">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="file" class="form-control bg-white">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" rows="5" placeholder="Coverletter"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Apply Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                    <?php }else if(isset($_SESSION['company'])){ ?>

                        <div>
                            <form>
                                <div class="row g-3">
                                    <div class="px-2"><input type="button" class="btn btn-warning" value="Ubah Lowongan" style="width: 100%;"></div>
                                    <?php 
                                    if($count == 0){
                                        ?><input type="button" value="Buat tes" data-toggle="modal" data-target="#jumlahSoal" class="btn btn-success" style="width: 100%;">
                                    <?php } ?>
                                        
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php }else{ ?>
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
    <?php
    if ($count > 0) {
        ?>
        <table class="table table-bordered">
            <tr>
                <th colspan=8>
                    <center> Soal
                </th>
            </tr>
            <tr>
                <td> ID Soal </td>
                <td> Pertanyaan </td>
                <td> Pilihan A </td>
                <td> Pilihan B </td>
                <td> Pilihan C </td>
                <td> Pilihan D </td>
                <td> Jawaban </td>
                <td> Aksi </td>
            </tr>
            <?php while ($dataSoal = $sql1->fetch()) { ?>
                <tr>
                    <td>
                        <?php echo $dataSoal['id_soal']; ?>
                    </td>
                    <td>
                        <?php echo $dataSoal['pertanyaan']; ?>
                    </td>
                    <td>
                        <?php echo $dataSoal['pilihan_a']; ?>
                    </td>
                    <td>
                        <?php echo $dataSoal['pilihan_b']; ?>
                    </td>
                    <td>
                        <?php echo $dataSoal['pilihan_c']; ?>
                    </td>
                    <td>
                        <?php echo $dataSoal['pilihan_d']; ?>
                    </td>
                    <td>
                        <?php echo $dataSoal['jawaban']; ?>
                    </td>
                    <td> <a href="soal_ubah.php?id_pertanyaan=<?php echo $dataSoal['id_soal']; ?>" class="edit" title="Edit"
                            data-toggle="tooltip"><i class="fas fa-edit text-warning fs-5"></i></a>
                        <a href="soal_hapus.php?id_pertanyaan=<?php echo $dataSoal['id_soal']; ?>" class="delete" title="Delete"
                            data-toggle="tooltip"><i class="fas fa-trash-alt text-danger fs-5"></i></a>
                    </td>
                </tr>
            <?php }
    }else{ ?>
        
    <?php } ?>

    
<!-- Modal tambah keahlian -->
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

</body>

</html>