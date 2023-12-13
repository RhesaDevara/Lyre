<?php
include 'navbar.php';
if (isset($_SESSION['user'])) {
  $id_pengguna = $_SESSION['user']['id_pengguna'];
} else {
  $id_pengguna = $_GET['id_pengguna'];
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
            <img class="img-fluid rounded-circle mt-3 me-5" src="<?php echo $data['foto']; ?>" loading="lazy"
              alt="User Logo" style="width: 100px; height: 100px; object-fit: cover;border-radius: 100px;"
              data-bs-toggle="modal" data-bs-target="#ubahFoto">
            <div>
              <h3 class="mb-1 mt-4">
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
              if (isset($_SESSION['user'])) { ?><button type="button" class="btn btn-warning" data-bs-toggle="modal"
                  data-bs-target="#editProfile">Ubah
                  Profil</button>
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
            <div class="d-flex flex-column">
              <div class="text-center d-flex align-items-center justify-content-between">
                <h4>Pengalaman</h4>
                <?php
                if (isset($_SESSION['user'])) { ?>
                  <span role="button" data-bs-toggle="modal" data-bs-target="#tambahPengalaman">
                    <i class="fa-solid fa-plus fs-5"></i>
                  </span>
                <?php } ?>
              </div>
              <hr>
              <?php
              $pl = 1;
              while ($dataPengalaman = $sqlPengalaman->fetch()) {
                $id_pengalaman = $dataPengalaman['id_pengalaman'];
                ?>
                <div class="list-group mb-4 shadow rounded">
                  <a class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <div class="d-flex flex-row">
                        <div>
                          <h5 class="mb-1">
                            <?php echo $dataPengalaman['posisi']; ?>
                          </h5>
                        </div>
                        <div class="pt-1 ms-2"><small>
                            <?php echo " (" . $dataPengalaman['durasi'] . " Bulan)"; ?>
                          </small> </div>
                      </div>
                      <div class="ms-auto d-flex align-items-center">
                        <small class="me-3">
                          <?php echo $dataPengalaman['lokasi_pekerjaan']; ?>
                        </small>
                        <?php
                        if (isset($_SESSION['user'])) { ?>
                          <i class="fa-solid fa-pencil me-2 mt-1" role="button" data-bs-toggle="modal"
                            data-bs-target='#editPengalaman<?php echo $pl; ?>'></i>
                        <?php } ?>
                      </div>
                    </div>
                    <small><b>
                        <?php echo $dataPengalaman['nama_perusahaan']; ?>
                      </b></small>
                    <p class="mb-1" style="text-align: justify;">
                      <?php echo $dataPengalaman['deskripsi']; ?>
                    </p>
                  </a>
                </div>
                <!-- Modal Ubah Pengalaman-->
                <div class="modal fade" id="editPengalaman<?php echo $pl; ?>" tabindex="-1"
                  aria-labelledby="editPengalamanLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editPengalamanLabel">Ubah Data Pengalaman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="post">
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Posisi:</label>
                            <input type="text" name="id_pengalaman" hidden value="<?php echo $id_pengalaman; ?>">
                            <input type="text" class="form-control" id="posisi" name="posisi" placeholder="Web Developer"
                              value="<?php echo $dataPengalaman['posisi']; ?>">
                          </div>
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama Perusahaan:</label>
                            <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan"
                              placeholder="Microsoft" value="<?php echo $dataPengalaman['nama_perusahaan']; ?>">
                          </div>
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tanggal Masuk:</label>
                            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk"
                              value="<?php echo $dataPengalaman['tanggal_masuk']; ?>">
                          </div>
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Durasi:</label>
                            <input type="number" class="form-control" id="durasi" name="durasi"
                              placeholder="Tulis dalam bulan (12) " value="<?php echo $dataPengalaman['durasi']; ?>">
                          </div>
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Lokasi Pekerjaan:</label>
                            <input type="text" class="form-control" id="lokasi_pekerjaan" name="lokasi_pekerjaan"
                              placeholder="Jakarta" value="<?php echo $dataPengalaman['lokasi_pekerjaan']; ?>">
                          </div>
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Deskripsi:</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi"
                              placeholder="Saya berganggung jawab dalam pengembangan web...."><?php echo $dataPengalaman['deskripsi']; ?></textarea>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <a href="<?php echo "delete_pengalaman.php?id_pengalaman=$dataPengalaman[id_pengalaman]" ?>"><button
                            type="button" name="hapus" class="btn btn-danger"
                            onclick='return confirm("Apakah Anda Yakin?")'>Hapus</button></a>
                        <button type="submit" name="ubahPengalaman" class="btn btn-primary">Simpan Perubahan</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- End Modal Ubah Pengalaman-->
                <?php
                $pl++;
              }
              ?>
            </div>
          </div>

          <div class="mb-5">
            <div class="d-flex flex-column">
              <div class="text-center d-flex align-items-center justify-content-between">
                <h4>Sertifikat</h4>
                <?php
                if (isset($_SESSION['user'])) { ?>
                  <span role="button" data-bs-toggle="modal" data-bs-target="#tambahSertifikat">
                    <i class="fa-solid fa-plus fs-5"></i>
                  </span>
                <?php } ?>
              </div>
              <hr>
              <?php
              $st = 1;
              while ($dataSertifikat = $sqlSertifikat->fetch()) {
                $id_sertifikat = $dataSertifikat['id_sertifikat'];
                ?>
                <div class="list-group mb-4 shadow rounded">
                  <a class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <div class="d-flex flex-row">
                        <div>
                          <h5 class="mb-1">
                            <?php echo $dataSertifikat['nama_sertifikat']; ?>
                          </h5>
                        </div>
                      </div>
                      <?php
                      if (isset($_SESSION['user'])) { ?>
                        <div class="ms-auto">
                          <i class="fa-solid fa-pencil mt-1" role="button" data-bs-toggle="modal"
                            data-bs-target='#editSertifikat<?php echo $st; ?>'></i>
                        </div>
                      <?php } ?>
                    </div>
                    <small><b>
                        <?php echo $dataSertifikat['nama_penerbit']; ?>
                      </b></small> <br>
                    <small class="mb-1" style="text-align: justify;">
                      <?php echo $dataSertifikat['tanggal_terbit'] . " - " . $dataSertifikat['tanggal_kadaluarsa']; ?>
                    </small>
                  </a>
                </div>

                <!-- Modal Ubah Sertifikat-->
                <div class="modal fade" id="editSertifikat<?php echo $st; ?>" tabindex="-1"
                  aria-labelledby="editSertifikatLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editSertifikatLabel">Ubah Data Sertifikat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="post">
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama Sertifikat:</label>
                            <input type="text" hidden name="id_sertifikat" value="<?php echo $id_sertifikat; ?>">
                            <input type="text" class="form-control" id="nama_sertifikat" name="nama_sertifikat"
                              placeholder="Pengenalan UI/UX" value="<?php echo $dataSertifikat['nama_sertifikat']; ?>"
                              required>
                          </div>
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama Penerbit:</label>
                            <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit"
                              placeholder="Dicoding Indonesia" value="<?php echo $dataSertifikat['nama_penerbit']; ?>"
                              required>
                          </div>
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tanggal Terbit:</label>
                            <input type="date" class="form-control" id="tanggal_terbit" name="tanggal_terbit"
                              value="<?php echo $dataSertifikat['tanggal_terbit']; ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tanggal Kadaluarsa:</label>
                            <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa"
                              value="<?php echo $dataSertifikat['tanggal_kadaluarsa']; ?>" required>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <a href=<?php echo "delete_sertifikat.php?id_sertifikat=$id_sertifikat"; ?>><input type="button"
                            name="hapusSertifikat" class="btn btn-danger" value="Hapus"
                            onclick='return confirm("Apakah Anda Yakin?")'></a>

                        <button type="submit" name="ubahSertifikat" class="btn btn-primary">Simpan Perubahan</button>
                        </form>

                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal Ubah Sertifikat-->
                <?php
                $st++;
              }
              ?>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="bg-light rounded p-4 mb-4 position-relative">
            <div class="text-center d-flex align-items-center justify-content-between">
              <h4>Pendidikan</h4>
              <?php
              if (isset($_SESSION['user'])) { ?>
                <span role="button" data-bs-toggle="modal" data-bs-target="#tambahPendidikan">
                  <i class="fa-solid fa-plus fs-5"></i>
                </span>
              <?php } ?>
            </div>
            <hr class="mb-4">
            <?php
            $pk = 1;
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
                    if (isset($_SESSION['user'])) { ?><span role="button">
                        <i class="fa-solid fa-pencil" data-bs-toggle="modal"
                          data-bs-target="#editPendidikan<?php echo $pk; ?>"></i>
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
              <div class="modal fade" id="editPendidikan<?php echo $pk; ?>" tabindex="-1"
                aria-labelledby="editPendidikanLabel" aria-hidden="true">
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
                            placeholder="Universitas Darma Persada" value="<?php echo $dataPendidikan['nama_tempat']; ?>"
                            required>
                        </div>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Jenjang:</label>
                          <select class="form-control" id="cbJenjang" name="edt_jenjang" required>
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
                            placeholder="Teknologi Informasi" value="<?php echo $dataPendidikan['jurusan']; ?>" required>
                        </div>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Tahun Mulai:</label>
                          <input type="number" class="form-control" id="tahun_mulai" name="edt_tahun_mulai"
                            value="<?php echo $dataPendidikan['tahun_mulai']; ?>" required>
                        </div>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Tahun Lulus:</label>
                          <input type="number" class="form-control" id="tahun_lulus" name="edt_tahun_lulus"
                            value="<?php echo $dataPendidikan['tahun_lulus']; ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <a href="<?php echo "delete_pendidikan.php?id_pendidikan=$dataPendidikan[id_pendidikan]" ?>"><input
                          type="button" name="hapus" class="btn btn-danger" value="Hapus"
                          onclick='return confirm("Apakah Anda Yakin?")'></a>
                      <button type="submit" name="ubahPendidikan" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- End Modal Ubah Pendidikan-->
              <?php
              $pk++;
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
                  if ($countKeahlian > 0) { ?>

                    <span role="button" data-bs-toggle="modal" data-bs-target="#editKeahlian">
                      <i class="fa-solid fa-pencil fs-5"></i>
                    </span>
                  <?php }
                }
                ?>
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
          <h5 class="modal-title" id="editProfileLabel">Ubah Profil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Foto:</label>
              <center> <img src="<?php echo $data['foto']; ?>" style="width: 200px; height: 200px;"
                  class="form-control mb-3"> </center>
              <input type="file" class="form-control" name="gambar" id="gambar" accept="image/*">
              <input type="text" value="<?php echo $data['foto']; ?>" name="gambarLama" hidden>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nama Lengkap:</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap anda"
                value="<?php echo $data['nama']; ?> " required>
            </div>
            <div class=" form-group">
              <label for="recipient-name" class="col-form-label">Email:</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email anda"
                value="<?php echo $data['email']; ?> " required>
            </div>
            <div class=" form-group">
              <label for="recipient-name" class="col-form-label">Alamat:</label>
              <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat anda"
                value="<?php echo $data['alamat']; ?> " required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nomor telepon:</label>
              <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="08**********"
                value="<?php echo $data['nomor_telepon']; ?> " required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Tentang Anda:</label>
              <textarea class="form-control" id="tentang_anda" name="tentang_anda"
                placeholder="Tuliskan tentang diri anda" style="text-align: justify;"
                required><?php echo $data['about']; ?></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="ubahProfile" class="btn btn-primary">Simpan Perubahan</button>
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
              <label for="recipient-name" class="col-form-label">Nama Tempat:</label>
              <input type="text" class="form-control" id="nama_tempat" name="nama_tempat"
                placeholder="Universitas Darma Persada" required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Jenjang:</label>
              <select class="form-control" id="cbJenjang" name="jenjang" required>
                <option value="">Pilih...</option>
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
              <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Teknologi Informasi"
                required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Tahun Mulai:</label>
              <input type="number" class="form-control" id="tahun_mulai" name="tahun_mulai" placeholder="2020" required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Tahun Lulus:</label>
              <input type="number" class="form-control" id="tahun_lulus" name="tahun_lulus" placeholder="2024" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="tambahPendidikan" class="btn btn-primary">Tambah</button>
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
              <input type="text" class="form-control" id="keahlian" name="keahlian" placeholder="Kotlin" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="tambahKeahlian" class="btn btn-primary">Tambah</button>
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
          <h5 class="modal-title" id="editKeahlianLabel">Ubah Keahlian</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="text-secondary">Kosongkan kolom pengisian untuk menghapus keahlian</p>
          <form method="post">
            <?php
            $upk = 1;
            while ($dataEditKeahlian = $sqlKeahlian1->fetch()) { ?>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Keahlian
                  <?php echo $upk; ?>:
                </label> <input type="text" hidden name="id_keahlian<?php echo $upk; ?>"
                  value="<?php echo $dataEditKeahlian['id_keahlian']; ?>">

                <input type="text" class="form-control" id="keahlian" name="keahlian<?php echo $upk; ?>"
                  placeholder="Cohtoh: Kotlin" value="<?php echo $dataEditKeahlian['nama_keahlian']; ?>">
              </div>
              <?php $upk++;
            } ?>
        </div>
        <div class="modal-footer">
          <button type="submit" name="editKeahlian" class="btn btn-primary">Simpan Perubahan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal Ubah Keahlian-->

  <!-- Modal Tambah Pengalaman-->
  <div class="modal fade" id="tambahPengalaman" tabindex="-1" aria-labelledby="tambahPengalamanLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahPengalamanLabel">Tambah Pengalaman</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Posisi:</label>
              <input type="text" class="form-control" id="posisi" name="posisi" placeholder="Web Developer" required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nama Perusahaan:</label>
              <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan"
                placeholder="Microsoft" required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Tanggal Masuk:</label>
              <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Durasi:</label>
              <input type="number" class="form-control" id="durasi" name="durasi" placeholder="Tulis dalam bulan (12) "
                required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Lokasi Pekerjaan:</label>
              <input type="text" class="form-control" id="lokasi_pekerjaan" name="lokasi_pekerjaan"
                placeholder="Jakarta" required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Deskripsi:</label>
              <textarea class="form-control" id="deskripsi" name="deskripsi"
                placeholder="Saya bertanggung jawab dalam pengembangan web...." required></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="tambahPengalaman" class="btn btn-primary">Tambah</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal Tambah Pengalaman-->

  <!-- Modal Tambah Sertifikat-->
  <div class="modal fade" id="tambahSertifikat" tabindex="-1" aria-labelledby="tambahSertifikatLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahSertifikatLabel">Tambah Sertifikat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nama Sertifikat:</label>
              <input type="text" class="form-control" id="nama_sertifikat" name="nama_sertifikat"
                placeholder="Pengenalan UI/UX" required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nama Penerbit:</label>
              <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit"
                placeholder="Dicoding Indonesia" required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Tanggal Terbit:</label>
              <input type="date" class="form-control" id="tanggal_terbit" name="tanggal_terbit" required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Tanggal Kadaluarsa:</label>
              <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="tambahSertifikat" class="btn btn-primary">Tambah</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal Tambah Sertifikat-->

  <?php
  if (isset($_POST['tambahPendidikan'])) {
    $nama_tempat = $_POST['nama_tempat'];
    $jenjang = $_POST['jenjang'];
    $jurusan = $_POST['jurusan'];
    $tahun_mulai = $_POST['tahun_mulai'];
    $tahun_lulus = $_POST['tahun_lulus'];

    $inputPendidikan = $koneksiPdo->prepare("INSERT INTO pendidikan (id_pengguna, nama_tempat, jenjang_pendidikan, jurusan, tahun_mulai, tahun_lulus) 
        VALUES ('$id_pengguna','$nama_tempat','$jenjang','$jurusan','$tahun_mulai','$tahun_lulus')");
    $inputPendidikan->execute();


    echo "<script>alert('Data Pendidikan berhasil ditambahkan');</script>";
    echo "<script>location='user_profile.php';</script>";
  }

  if (isset($_POST['ubahPendidikan'])) {
    $id_pendidikan = $_POST['id_pendidikan'];
    $newNamaTempat = $_POST['edt_nama_tempat'];
    $newJenjang = $_POST['edt_jenjang'];
    $newJurusan = $_POST['edt_jurusan'];
    $newTahunMulai = $_POST['edt_tahun_mulai'];
    $newTahunLulus = $_POST['edt_tahun_lulus'];

    $sqlEdit = $koneksiPdo->prepare("UPDATE pendidikan SET nama_tempat = '$newNamaTempat', jenjang_pendidikan = '$newJenjang', jurusan = '$newJurusan', tahun_mulai = '$newTahunMulai', tahun_lulus = '$newTahunLulus' where id_pendidikan = '$id_pendidikan'");
    $sqlEdit->execute();

    echo "<script>alert('Data Pendidikan berhasil diubah');</script>";
    echo "<script>location='user_profile.php';</script>";
  }

  if (isset($_POST['ubahProfile'])) {
    $gambar_name = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $gambar_size = $_FILES['gambar']['size'];
    $gambar_type = $_FILES['gambar']['type'];

    if ($gambar_name == "" || empty($gambar_name) || !isset($gambar_name)) {
      $tujuan = $_POST['gambarLama'];
    } else {
      $tujuan = "photo/" . $gambar_name;
    }

    $allowed_types = array("image/jpeg", "image/png", "image/gif");
    if (in_array($gambar_type, $allowed_types)) {
      move_uploaded_file($gambar_tmp, $tujuan);
      echo "Gambar berhasil diunggah.";
    } else {
      echo "Jenis file tidak didukung.";
    }
    $tentang = $_POST['tentang_anda'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    ;
    $nomor_telepon = $_POST['nomor_telepon'];
    $sqlEditTentang = $koneksiPdo->prepare("UPDATE pengguna SET foto='$tujuan', nama = '$nama', email = '$email', alamat = '$alamat', nomor_telepon = '$nomor_telepon', about = '$tentang' where id_pengguna = '$id_pengguna'");
    $sqlEditTentang->execute();

    $sqlSelectProfile = $koneksiPdo->prepare("SELECT * FROM pengguna where id_pengguna = '$id_pengguna'");
    $sqlSelectProfile->execute();

    $_SESSION['user'] = $sqlSelectProfile->fetch();
    echo "<script>alert('Profile berhasil diubah');</script>";
    echo "<script>location='user_profile.php';</script>";
  }

  if (isset($_POST['tambahKeahlian'])) {
    $keahlian = $_POST['keahlian'];

    $sqlTambahKeahlian = $koneksiPdo->prepare("INSERT INTO keahlian (id_pengguna, nama_keahlian) values ('$id_pengguna', '$keahlian')");
    $sqlTambahKeahlian->execute();

    echo "<script>alert('Keahlian berhasil ditambahkan');</script>";
    echo "<script>location='user_profile.php';</script>";
  }

  if (isset($_POST['editKeahlian'])) {
    for ($o = 1; $o <= $countKeahlian; $o++) {
      $keahlian = $_POST['keahlian' . $o];
      $id_keahlian = $_POST['id_keahlian' . $o];
      if (empty($keahlian) || !isset($keahlian) || $keahlian == "") {
        $sqlDeleteKeahlian = $koneksiPdo->prepare("DELETE FROM keahlian where id_keahlian = '$id_keahlian'");
        $sqlDeleteKeahlian->execute();
      } else {
        $sqlEditKeahlian = $koneksiPdo->prepare("UPDATE keahlian SET nama_keahlian = '$keahlian' where id_keahlian = '$id_keahlian'");
        $sqlEditKeahlian->execute();
      }
    }
    echo "<script>alert('Keahlian berhasil diubah');</script>";
    echo "<script>location='user_profile.php';</script>";
  }

  if (isset($_POST['tambahPengalaman'])) {
    $posisi = $_POST['posisi'];
    $nama_perusahaan = $_POST['nama_perusahaan'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $durasi = $_POST['durasi'];
    $lokasi_pekerjaan = $_POST['lokasi_pekerjaan'];
    $deskripsi = $_POST['deskripsi'];

    $sqlTambahPengalaman = $koneksiPdo->prepare("INSERT INTO pengalaman (id_pengguna, posisi, nama_perusahaan, tanggal_masuk, durasi, lokasi_pekerjaan, deskripsi) 
      values ('$id_pengguna', '$posisi', '$nama_perusahaan', '$tanggal_masuk', '$durasi', '$lokasi_pekerjaan', '$deskripsi')");
    $sqlTambahPengalaman->execute();

    echo "<script>alert('Pengalaman berhasil ditambahkan');</script>";
    echo "<script>location='user_profile.php';</script>";
  }

  if (isset($_POST['ubahPengalaman'])) {
    $id_pengalaman = $_POST['id_pengalaman'];
    $posisi = $_POST['posisi'];
    $nama_perusahaan = $_POST['nama_perusahaan'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $durasi = $_POST['durasi'];
    $lokasi_pekerjaan = $_POST['lokasi_pekerjaan'];
    $deskripsi = $_POST['deskripsi'];

    $sqlUbahPengalaman = $koneksiPdo->prepare("UPDATE pengalaman set posisi = '$posisi', nama_perusahaan = '$nama_perusahaan', tanggal_masuk = '$tanggal_masuk', durasi = '$durasi',
    lokasi_pekerjaan = '$lokasi_pekerjaan', deskripsi = '$deskripsi' where id_pengalaman = '$id_pengalaman'");
    $sqlUbahPengalaman->execute();

    echo "<script>alert('Pengalaman berhasil diubah');</script>";
    echo "<script>location='user_profile.php';</script>";
  }

  if (isset($_POST['tambahSertifikat'])) {
    $nama_sertifikat = $_POST['nama_sertifikat'];
    $nama_penerbit = $_POST['nama_penerbit'];
    $tanggal_terbit = $_POST['tanggal_terbit'];
    $tanggal_kadaluarsa = $_POST['tanggal_kadaluarsa'];

    $sqlTambahSertifikat = $koneksiPdo->prepare("INSERT INTO sertifikat (id_pengguna, nama_sertifikat, nama_penerbit, tanggal_terbit, tanggal_kadaluarsa) 
      values ('$id_pengguna', '$nama_sertifikat', '$nama_penerbit', '$tanggal_terbit', '$tanggal_kadaluarsa')");
    $sqlTambahSertifikat->execute();

    echo "<script>alert('Sertifikat berhasil ditambahkan');</script>";
    echo "<script>location='user_profile.php';</script>";
  }


  if (isset($_POST['ubahSertifikat'])) {
    $id_sertifikat = $_POST['id_sertifikat'];
    $nama_sertifikat = $_POST['nama_sertifikat'];
    $nama_penerbit = $_POST['nama_penerbit'];
    $tanggal_terbit = $_POST['tanggal_terbit'];
    $tanggal_kadaluarsa = $_POST['tanggal_kadaluarsa'];

    $sqlUbahSertifikat = $koneksiPdo->prepare("UPDATE sertifikat set nama_sertifikat = '$nama_sertifikat', nama_penerbit = '$nama_penerbit', 
    tanggal_terbit = '$tanggal_terbit', tanggal_kadaluarsa = '$tanggal_kadaluarsa' where id_sertifikat = '$id_sertifikat'");
    $sqlUbahSertifikat->execute();

    echo "<script>alert('Sertifikat berhasil diubah');</script>";
    echo "<script>location='user_profile.php';</script>";
  }

  ?>
</body>

</html>