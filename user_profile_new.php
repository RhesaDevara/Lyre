<?php
include 'navbar.php';
if (isset($_SESSION['user'])) {
  $id_pengguna = $_SESSION['user']['id_pengguna'];
} else {
  header("Location:index.php");
}
$sql = $koneksiPdo->prepare("SELECT * FROM pengguna where id_pengguna = '$id_pengguna'");
$sql->execute();
$data = $sql->fetch();

$countPendidikan = $koneksiPdo->prepare("SELECT Count(*) FROM pendidikan where id_pengguna = '$id_pengguna'");
$countPendidikan->execute();

$countPendidikan = $countPendidikan->fetchColumn();

$sqlPendidikan = $koneksiPdo->prepare("SELECT * FROM pendidikan where id_pengguna = '$id_pengguna'");
$sqlPendidikan->execute();

$countKeahlian = $koneksiPdo->prepare("SELECT Count(*) FROM keahlian where id_pengguna = '$id_pengguna'");
$countKeahlian->execute();

$countKeahlian = $countKeahlian->fetchColumn();

$sqlKeahlian = $koneksiPdo->prepare("SELECT * FROM keahlian where id_pengguna = '$id_pengguna'");
$sqlKeahlian->execute();

$sqlKeahlian1 = $koneksiPdo->prepare("SELECT * FROM keahlian where id_pengguna = '$id_pengguna'");
$sqlKeahlian1->execute();

$sqlPengalaman = $koneksiPdo->prepare("SELECT * FROM pengalaman where id_pengguna = '$id_pengguna'");
$sqlPengalaman->execute();

$sqlSertifikat = $koneksiPdo->prepare("SELECT * FROM sertifikat where id_pengguna = '$id_pengguna'");
$sqlSertifikat->execute();

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
          <div class="d-flex flex-shrink-0 mb-5">
            <?php
            $profilePicture = isset($data['foto_pengguna']) ? 'assets/img/' . $data['foto_pengguna'] : 'assets/img/profile.png';
            ?>
            <img class="img-fluid rounded me-4" src="<?php echo $profilePicture; ?>" loading="lazy" alt="User Logo"
              style="width: 100px; height: 100px;">
            <div>
              <h3 class="mb-1">
                <?php echo $data['nama']; ?>
              </h3>
              <div class="text-muted d-md-flex">
                <p class="me-4"><i class="fa fa-envelope me-1"></i>
                  <?php echo $data['email']; ?>
                </p>
                <p><i class="fa fa-phone-alt me-1"></i>
                  <?php echo $data['nomor_telepon']; ?>
                </p>
              </div>
              <?php
              if (isset($data['id_pengguna'])) { ?><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                  data-bs-target="#editProfile">Edit
                  Profile</button>
              <?php } ?>
            </div>
          </div>

          <div class="mb-5">
            <h4 class="mb-3">Tentang</h4>
            <p>
              <?php echo $data['about']; ?>
            </p>
          </div>

          <div class="mb-5">
            <h4 class="mb-3">Responsibilities</h4>
            <p>Magna et elitr diam sed lorem. Diam diam stet erat no est est. Accusam sed lorem stet
              voluptua sit sit at stet consetetur, takimata at diam kasd gubergren elitr dolor</p>
            <ul class="list-unstyled">
              <li><i class="fa fa-angle-right text-primary me-2"></i>Dolor justo tempor duo ipsum accusam
              </li>
              <li><i class="fa fa-angle-right text-primary me-2"></i>Elitr stet dolor vero clita labore
                gubergren</li>
              <li><i class="fa fa-angle-right text-primary me-2"></i>Rebum vero dolores dolores elitr</li>
              <li><i class="fa fa-angle-right text-primary me-2"></i>Est voluptua et sanctus at sanctus
                erat</li>
              <li><i class="fa fa-angle-right text-primary me-2"></i>Diam diam stet erat no est est</li>
            </ul>
          </div>

          <div class="mb-5">
            <h4 class="mb-3">Qualifications</h4>
            <p>Magna et elitr diam sed lorem. Diam diam stet erat no est est. Accusam sed lorem stet
              voluptua sit sit at stet consetetur, takimata at diam kasd gubergren elitr dolor</p>
            <ul class="list-unstyled">
              <li><i class="fa fa-angle-right text-primary me-2"></i>Dolor justo tempor duo ipsum accusam
              </li>
              <li><i class="fa fa-angle-right text-primary me-2"></i>Elitr stet dolor vero clita labore
                gubergren</li>
              <li><i class="fa fa-angle-right text-primary me-2"></i>Rebum vero dolores dolores elitr</li>
              <li><i class="fa fa-angle-right text-primary me-2"></i>Est voluptua et sanctus at sanctus
                erat</li>
              <li><i class="fa fa-angle-right text-primary me-2"></i>Diam diam stet erat no est est</li>
            </ul>
          </div>

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

        <div class="col-lg-4">
          <div class="bg-light rounded p-4 mb-4 position-relative">
            <div class="bg-light text-center d-flex align-items-center justify-content-between">
              <h4>Pendidikan</h4>
              <span role="button" data-bs-toggle="modal" data-bs-target="#tambahPendidikan">
                <i class="fa-solid fa-plus fs-5"></i>
              </span>
            </div>
            <hr class="mb-4">
            <?php
            $i = 1;
            while ($dataPendidikan = $sqlPendidikan->fetch()) {
              ?>
              <form method="post">
                <div class="d-flex flex-row justify-content-between align-items-center">
                  <div>
                    <span
                      class="fs-6 badge bg-primary-subtle border border-primary-subtle text-primary-emphasis rounded-pill">
                      <?php echo $dataPendidikan['nama_tempat']; ?>
                    </span>
                  </div>
                  <div class="pt-1">
                    <?php
                    if (isset($dataPendidikan['id_pendidikan'])) { ?><span role="button">
                        <i class="fa-solid fa-pencil" data-bs-toggle="modal" data-bs-target="#editPendidikan"></i>
                      </span>
                    <?php } ?>
                  </div>
                </div>
                <i>
                  <?php echo $dataPendidikan['jurusan']; ?>
                </i> <br>
                <?php echo $dataPendidikan['jenjang_pendidikan']; ?> <br>
                <b>
                  <?php echo $dataPendidikan['tahun_mulai'] . " - " . $dataPendidikan['tahun_lulus']; ?>
                </b>
                <hr>
              </form>
              <!-- Modal Ubah Pendidikan-->
              <div class="modal fade" id="editPendidikan" tabindex="-1" aria-labelledby="editPendidikanLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editPendidikanLabel">Ubah Data Pendidikan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Nama Tempat:</label>
                          <input type="text" value="<?php echo $dataPendidikan['id_pendidikan']; ?>" hidden
                            name="id_pendidikan">
                          <input type="text" class="form-control" id="nama_tempat" name="edt_nama_tempat"
                            placeholder="Universitas Darma Persada" value="<?php echo $dataPendidikan['nama_tempat']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Jenjang:</label>
                          <select class="form-control" id="cbJenjang" name="edt_jenjang">
                            <option value="<?php echo $dataPendidikan['jenjang_pendidikan']; ?>">
                              <?php echo $dataPendidikan['jenjang_pendidikan']; ?>
                            </option>
                            <option value="SMA"> SMA (Sekolah Menengah Akhir) </option>
                            <option value="SMK"> SMK (Sekolah Menengah Kejuruan) </option>
                            <option value="D1"> D1 </option>
                            <option value="D2"> D2 </option>
                            <option value="D3"> D3 </option>
                            <option value="D4/S1"> D4/S1 </option>
                            <option value="S2"> S2 </option>
                            <option value="S3"> S3 </option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Jurusan:</label>
                          <input type="text" class="form-control" id="jurusan" name="edt_jurusan"
                            placeholder="Teknologi Informasi" value="<?php echo $dataPendidikan['jurusan']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Tahun Mulai:</label>
                          <input type="number" class="form-control" id="tahun_mulai" name="edt_tahun_mulai"
                            value="<?php echo $dataPendidikan['tahun_mulai']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Tahun Lulus:</label>
                          <input type="number" class="form-control" id="tahun_lulus" name="edt_tahun_lulus"
                            value="<?php echo $dataPendidikan['tahun_lulus']; ?>">
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <a href="<?php echo "delete_pendidikan.php?id_pendidikan=$dataPendidikan[id_pendidikan]" ?>"><input
                          type="button" name="hapus" class="btn btn-danger" value="Hapus"
                          onclick='return confirm("Apakah Anda Yakin?")'></a>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Modal Ubah Pendidikan-->
              <?php
              $i++;
            }
            ?>

          </div>
          <div class="bg-light rounded p-4">
            <div class="bg-light text-center d-flex align-items-center justify-content-between">
              <h4>Keahlian</h4>
              <div class="d-flex align-items-center">
                <?php
                if (isset($_SESSION['user'])) {
                  if ($countKeahlian < 10) {
                    ?>
                    <span role="button" data-bs-toggle="modal" data-bs-target="#tambahKeahlian" class="me-2">
                      <i class="fa-solid fa-plus fs-5 me-3"></i>
                    </span>
                    <?php
                  }
                }
                ?>
                <span role="button" data-bs-toggle="modal" data-bs-target="#editKeahlian">
                  <i class="fa-solid fa-pencil fs-5"></i>
                </span>
              </div>
            </div>
            <hr class="mb-4">
            <?php
            while ($dataKeahlian = $sqlKeahlian->fetch()) {
              ?>
              <div class="d-flex flex-coloumn mb-3 justify-content-center align-items-center">
                <span
                  class="fs-6 w-100 badge bg-primary-subtle border border-primary-subtle text-primary-emphasis rounded-pill">
                  <?php echo $dataKeahlian['nama_keahlian']; ?>
                </span>
              </div>
              <?php
            }
            ?>
          </div>
        </div>

      </div>
    </div>
  </div>


  <!-- Modal Ubah Profile-->
  <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfileLabel">Ubah Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nama Lengkap:</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap anda"
                value="<?php echo $data['nama']; ?> ">
            </div>
            <div class=" form-group">
              <label for="recipient-name" class="col-form-label">Email:</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email anda"
                value="<?php echo $data['email']; ?> ">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nomor telepon:</label>
              <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="08**********"
                value="<?php echo $data['nomor_telepon']; ?> ">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Tentang Anda:</label>
              <textarea class="form-control" id="tentang_anda" name="tentang_anda" placeholder="Tuliskan tentang diri
                anda"><?php echo $data['about']; ?></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal Ubah Profile-->

  <!-- Modal Tambah Pendidikan-->
  <div class="modal fade" id="tambahPendidikan" tabindex="-1" aria-labelledby="tambahPendidikanLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahPendidikanLabel">Tambah Pendidikan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">ID Pengguna:</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap anda"
                value="<?php echo $_SESSION['user']['nama']; ?> ">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nama Lengkap:</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap anda"
                value="<?php echo $_SESSION['user']['nama']; ?> ">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Email:</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email anda"
                value="<?php echo $_SESSION['user']['email']; ?> ">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nomor telepon:</label>
              <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="08**********"
                value="<?php echo $_SESSION['user']['nomor_telepon']; ?> ">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Tentang Anda:</label>
              <textarea class="form-control" id="tentang_anda" name="tentang_anda" placeholder="Tuliskan tentang diri
                anda"><?php echo $_SESSION['user']['about']; ?></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal Tambah Pendidikan-->

  <!-- Modal Tambah Keahlian-->
  <div class="modal fade" id="tambahKeahlian" tabindex="-1" aria-labelledby="tambahKeahlianLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahKeahlianLabel">Tambah Keahlian</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Keahlian:</label>
              <input type="text" class="form-control" id="keahlian" name="keahlian" placeholder="Kotlin">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal Tambah Keahlian-->

  <!-- Modal Ubah Keahlian-->
  <div class="modal fade" id="editKeahlian" tabindex="-1" aria-labelledby="editKeahlianLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editKeahlianLabel">Tambah Pendidikan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <font color='grey'> Kosongkan kolom pengisian untuk menghapus keahlian </font>
          <form method="post">
            <?php
            $l = 1;
            while ($dataEditKeahlian = $sqlKeahlian1->fetch()) { ?>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Keahlian
                  <?php echo $l; ?>:
                </label> <input type="text" hidden name="id_keahlian<?php echo $l; ?>"
                  value="<?php echo $dataEditKeahlian['id_keahlian']; ?>">
                <input type="text" class="form-control" id="keahlian" name="keahlian<?php echo $l; ?>"
                  placeholder="Cohtoh: Kotlin" value="<?php echo $dataEditKeahlian['nama_keahlian']; ?>">
              </div>
              <?php $l++;
            } ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Ubah Keahlian-->

</body>

</html>