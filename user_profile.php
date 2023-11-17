<?php
    include 'navbar.php';
    $id_pengguna = $_SESSION['user']['id_pengguna'];
    $sql = $koneksiPdo -> prepare("SELECT * FROM pengguna where id_pengguna = '$id_pengguna'");
    $sql -> execute();
    $data = $sql -> fetch();

    $countPendidikan = $koneksiPdo ->prepare("SELECT Count(*) FROM pendidikan where id_pengguna = '$id_pengguna'");
    $countPendidikan -> execute();

    $countPendidikan = $countPendidikan -> fetchColumn();

    $sqlPendidikan = $koneksiPdo ->prepare("SELECT * FROM pendidikan where id_pengguna = '$id_pengguna'");
    $sqlPendidikan -> execute();

    $countKeahlian = $koneksiPdo ->prepare("SELECT Count(*) FROM keahlian where id_pengguna = '$id_pengguna'");
    $countKeahlian -> execute();

    $countKeahlian = $countKeahlian -> fetchColumn();

    $sqlKeahlian = $koneksiPdo ->prepare("SELECT * FROM keahlian where id_pengguna = '$id_pengguna'");
    $sqlKeahlian -> execute();

    $sqlPengalaman = $koneksiPdo ->prepare("SELECT * FROM pengalaman where id_pengguna = '$id_pengguna'");
    $sqlPengalaman -> execute();


?>
<!DOCTYPE html>
<?php
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Apply and Recruit</title>
    <style>
        .profile-container{
            width: 50%;
        }
        .profile-container-30{
            width: 30%;
        }
        .profile-container-70{
            width: 70%;
        }
        .profile-container-80{
            width: 80%;
        }
        .profile-container-100{
            width: 100%;
        }
        .img-profile{
            height: 150px;
            width: 150px;
            border-radius: 100px;
        }

        .top-profile{
            width:100%;
            background:#F9F9F9;
        }

        .background-text{
          background: #20444F;
          border-radius: 20px;
          color: white;
        }
        </style>
</head>
<body>
    <div class="top-profile pt-5 px-5">
    <div class="d-flex flex-row profile-container-100">
        <div class="d-flex flex-column profile-container-80">
            <div class="d-flex flex-row p-2">
                <div class="p-2 profile-container-30"> <center> <img src="assets/img/profile.png" class="img-profile"> </div>
                <div class="p-2 profile-container-70"> <h1 style="margin-top: 30px;"> <?php echo $data['nama']; ?>
              </h1> <?php echo $data['email'] . " / " . $data['nomor_telepon']; ?> 
             <?php
                if(isset($_SESSION['user'])){ ?>
                    <br><button class="btn btn-warning mt-2" data-toggle='modal' data-target='#editProfile' >Edit Profile</button>
                <?php } ?></div>
            </div>
            <div class="mx-5 px-5" style="text-align: justify;">
            
            <h4 class="pt-5"> Tentang Saya </h4> <hr>
                <font size="3"> 
                  <p><?php echo $data['about']; ?> </p>
                  </font> 
            </div>

            <div class="mx-5 px-5">
              <table>
                <tr>
                  <td class="pt-1 pe-2"> <h4> Keahlian </h4> </td>
                  <td>  <?php 
                    if($countKeahlian < 20){
                      ?><button class="btn btn-secondary btn-sm" data-toggle='modal' data-target='#tambahKeahlianModal'> + </button> <?php
                    }?> </td>
                    </tr>
                  </table>
                
                     <hr>
            <div class="d-flex flex-row me-5">
              <table width="100%" border=0>
              <?php 
                    $j = 1;
                    $hitung = 5;
                    while($dataKeahlian = $sqlKeahlian -> fetch()){
                      ?>
                          <?php if($hitung == 5){ ?> 
                            <tr> 
                          <?php $hitung = 0; } ?>
                            <td width="20%">
                              <div class="background-text mb-1 px-3 py-2"> <center><?php echo $dataKeahlian['nama_keahlian']; ?>
                                <i class="fa-solid fa-pencil ms-2" style="color: #ffffff;" data-toggle='modal' data-target='#editKeahlianModal<?php echo $j; ?>'></i> 
                              </div> 
                            </td>  

                        <!-- Modal ubah keahlian -->
                        <div class="modal fade" id="editKeahlianModal<?php echo $j; ?>" tabindex="-1" role="dialog" aria-labelledby="editKeahlianModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ubah Keahlian</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>

                              <div class="modal-body">
                                <form method="post">
                                  <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Keahlian:</label> <input type="text" hidden name="id_keahlian" value="<?php echo $dataKeahlian['id_keahlian']; ?>">
                                    <input type="text" class="form-control" id="keahlian" name="keahlian" placeholder="Kotlin / Java / PHP / Javascript" value="<?php echo $dataKeahlian['nama_keahlian'];?>">
                                  </div>
                              </div>
                              <div class="modal-footer">
                                <a href="<?php echo "delete_keahlian.php?id_keahlian=$dataKeahlian[id_keahlian]"?>"><input type="button" name="hapus" class="btn btn-danger" value="Hapus" onclick='return confirm("Apakah Anda Yakin?")'></a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <input type="submit" name="editKeahlian" class="btn btn-warning" value="Ubah">
                              </div>
                            </form>
                            </div>
                          </div>
                        </div>

                      <?php $j++;
                      $hitung++;
                    }
                  ?>
                  </table>
                </div>
            </div>
            </div>

            <div class="">
                <div class="px-2"> 
                <h3> Pendidikan </h3>
                <?php
                    $i = 1;
                    while($dataPendidikan = $sqlPendidikan -> fetch()){
                         ?>
                         <hr>
                        <form method="post">
                        <div class="d-flex flex-row"> 
                            <div> <h5 class="background-text px-2 py-1"> <?php echo $dataPendidikan['nama_tempat']; ?> </h5></div>
                            <div class="pt-1"><i class="fa-solid fa-pencil ms-3 mt-1" style="color: #20444F;" data-toggle='modal' data-target='#editModal<?php echo $i ?>'></i> 
                            </div>
                    </div>
                        <i><?php echo $dataPendidikan['jurusan']; ?></i> <br>
                        <?php echo $dataPendidikan['jenjang_pendidikan']; ?> <br>
                        <b><?php echo $dataPendidikan['tahun_mulai'] . " - " . $dataPendidikan['tahun_lulus'];  ?> </b> </form> 

                        <div class="modal fade" id="editModal<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pendidikan</h5> 
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>

                              <div class="modal-body">
                                <form method="post">
                                  <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nama Tempat:</label>
                                    <input type="text" value="<?php echo $dataPendidikan['id_pendidikan']; ?>" hidden name="id_pendidikan">
                                    <input type="text" class="form-control" id="nama_tempat" name="edt_nama_tempat" placeholder="Universitas Darma Persada" value="<?php echo $dataPendidikan['nama_tempat'];?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Jenjang:</label>
                                    <select class="form-control" id="cbJenjang" name="edt_jenjang">
                                        <option value="<?php echo $dataPendidikan['jenjang_pendidikan'];?>"><?php echo $dataPendidikan['jenjang_pendidikan'];?></option>
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
                                    <input type="text" class="form-control" id="jurusan" name="edt_jurusan" placeholder="Teknologi Informasi" value="<?php echo $dataPendidikan['jurusan'];?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Tahun Mulai:</label>
                                    <input type="number" class="form-control" id="tahun_mulai" name="edt_tahun_mulai" value="<?php echo $dataPendidikan['tahun_mulai'];?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Tahun Lulus:</label>
                                    <input type="number" class="form-control" id="tahun_lulus" name="edt_tahun_lulus" value="<?php echo $dataPendidikan['tahun_lulus'];?>">
                                  </div>
                              </div>
                              <div class="modal-footer">
                                <a href="<?php echo "delete_pendidikan.php?id_pendidikan=$dataPendidikan[id_pendidikan]"?>"><input type="button" name="hapus" class="btn btn-danger" value="Hapus" onclick='return confirm("Apakah Anda Yakin?")'></a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <input type="submit" name="ubah" class="btn btn-warning" value="Ubah">
                              </div>
                            </form>
                            </div>
                          </div>
                        </div>

                        <?php
                        $i++;
                    } 
                    ?> <hr>  <?php

                    if($countPendidikan < 3){
                        echo "
                        <button type='button' class='btn btn-secondary' data-toggle='modal' data-target='#exampleModal' data-whatever='@getbootstrap'> + Tambahkan Pendidikan</button> </center>"; 
                    }
                ?>
            </div>
            <div class="px-2"> 
                
            </div>
        </div>
    </div>
    <div class="d-flex flex-column">
        <div class="d-flex flex-row">
            <div class="d-flex flex-row p-5 profile-container-80">
                <div class="p-2 profile-container-100"> 
                    <h2> Pengalaman </h2> <hr>
                    <?php 
                      $k = 1;
                      while($dataPengalaman = $sqlPengalaman -> fetch()){
                        $id_pengalaman = $dataPengalaman['id_pengalaman'];
                        ?>
                          <div class="list-group">
                            <a class="list-group-item list-group-item-action flex-column align-items-start">
                              <div class="d-flex w-100 justify-content-between">
                                <div class="d-flex flex-row">
                                  <div><h5 class="mb-1"><?php echo $dataPengalaman['posisi']; ?> </h5> </div> 
                                  <div class="pt-1 ms-2"><small> <?php echo " (" . $dataPengalaman['durasi'] . " Bulan)"; ?></small> </div> 
                                  <div class="pt-1"> <i class="fa-solid fa-pencil ms-3 mt-1" style="color: #20444F;" data-toggle='modal' data-target='#editPengalaman<?php echo $k; ?>'></i> </div>
                                </div>
                                <small> <?php echo $dataPengalaman['lokasi_pekerjaan']; ?> </small>
                              </div>
                              <small><b><?php echo $dataPengalaman['nama_perusahaan']; ?></b></small>
                              <p class="mb-1" style="text-align: justify";><?php echo $dataPengalaman['deskripsi']; ?></p>
                            </a>
                      </div>
                      <!-- Modal tambah pengalaman -->
                      <div class="modal fade" id="editPengalaman<?php echo $k; ?>" tabindex="-1" role="dialog" aria-labelledby="editPengalamanLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Ubah Pengalaman</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>


                            <div class="modal-body">
                              <form method="post">
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Posisi:</label> <input type="text" hidden value="<?php echo $id_pengalaman; ?>">
                                  <input type="text" class="form-control" id="posisi" name="posisi" placeholder="Web Developer" value="<?php echo $dataPengalaman['posisi']; ?>">
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Nama Perusahaan:</label>
                                  <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Microsoft" value="<?php echo $dataPengalaman['nama_perusahaan']; ?>">
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Tanggal Masuk:</label>
                                  <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?php echo $dataPengalaman['tanggal_masuk']; ?>">
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Durasi:</label>
                                  <input type="number" class="form-control" id="durasi" name="durasi" placeholder="Tulis dalam bulan (12) " value="<?php echo $dataPengalaman['durasi']; ?>">
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Lokasi Pekerjaan:</label>
                                  <input type="text" class="form-control" id="lokasi_pekerjaan" name="lokasi_pekerjaan" placeholder="Jakarta" value="<?php echo $dataPengalaman['lokasi_pekerjaan']; ?>">
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Deskripsi:</label>
                                  <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Saya berganggung jawab dalam pengembangan web...."><?php echo $dataPengalaman['posisi']; ?></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              <input type="submit" name="tambahPengalaman" class="btn btn-primary" value="Konfirmasi">
                            </div>
                          </form>
                          </div>
                        </div>
                      </div>

                        <?php
                        $k++;
                      }
                    ?>
                    <button class="btn btn-secondary mt-5" data-toggle="modal" data-target="#tambahPengalaman">+ Tambahkan Pengalaman Kerja</button>
                </div>
            </div>
            <div class="p-3">
                <div> 
                  <!-- <h3> Bahasa </h3> <hr> -->
                </div>
            </div>
        </div>

        <div class="d-flex flex-row"> 
            <div class="p-5 profile-container-80" style="text-align: justify">
             <h3> Sertifikat </h3> <hr>
            </div>
            <div class="p-2"> 
                <!-- a -->
            </div>
        </div>
    </div>

  <!-- Modal tambah pendidikan -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pendidikan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
        <form method="post">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Tempat:</label>
            <input type="text" class="form-control" id="nama_tempat" name="nama_tempat" placeholder="Universitas Darma Persada">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Jenjang:</label>
            <select class="form-control" id="cbJenjang" name="jenjang">
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
            <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Teknologi Informasi">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tahun Mulai:</label>
            <input type="number" class="form-control" id="tahun_mulai" name="tahun_mulai">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tahun Lulus:</label>
            <input type="number" class="form-control" id="tahun_lulus" name="tahun_lulus">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <input type="submit" name="konfirmasi" class="btn btn-primary" value="Konfirmasi">
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Modal edit profile -->
<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="editAboutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Tentang Anda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
        <form method="post">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Lengkap:</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap anda" value="<?php echo $_SESSION['user']['nama'];?> "></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email anda" value="<?php echo $_SESSION['user']['email'];?> "></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nomor telepon:</label>
            <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="08**********" value="<?php echo $_SESSION['user']['nomor_telepon'];?> "></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tentang Anda:</label>
            <textarea class="form-control" id="tentang_anda" name="tentang_anda" placeholder="Tuliskan tentang diri anda"><?php echo $_SESSION['user']['about'];?></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <input type="submit" name="ubahProfile" class="btn btn-warning" value="Ubah">
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Modal tambah keahlian -->
<div class="modal fade" id="tambahKeahlianModal" tabindex="-1" role="dialog" aria-labelledby="tambahKeahlianModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Keahlian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
        <form method="post">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Keahlian:</label>
            <input type="text" class="form-control" id="keahlian" name="keahlian" placeholder="Kotlin / Java / PHP / Javascript"></textarea>
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

<!-- Modal tambah pengalaman -->
<div class="modal fade" id="tambahPengalaman" tabindex="-1" role="dialog" aria-labelledby="tambahPengalamanLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengalaman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
        <form method="post">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Posisi:</label>
            <input type="text" class="form-control" id="posisi" name="posisi" placeholder="Web Developer"></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Perusahaan:</label>
            <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Microsoft"></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tanggal Masuk:</label>
            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk"></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Durasi:</label>
            <input type="number" class="form-control" id="durasi" name="durasi" placeholder="Tulis dalam bulan (12) "></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Lokasi Pekerjaan:</label>
            <input type="text" class="form-control" id="lokasi_pekerjaan" name="lokasi_pekerjaan" placeholder="Jakarta"></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Deskripsi:</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Saya berganggung jawab dalam pengembangan web...."></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <input type="submit" name="tambahPengalaman" class="btn btn-primary" value="Konfirmasi">
      </div>
    </form>
    </div>
  </div>
</div>

<?php
    if(isset($_POST['konfirmasi'])){
        $nama_tempat = $_POST['nama_tempat'];
        $jenjang = $_POST['jenjang'];
        $jurusan = $_POST['jurusan'];
        $tahun_mulai = $_POST['tahun_mulai'];
        $tahun_lulus = $_POST['tahun_lulus'];

        $inputPendidikan = $koneksiPdo -> prepare("INSERT INTO pendidikan (id_pengguna, nama_tempat, jenjang_pendidikan, jurusan, tahun_mulai, tahun_lulus) 
        VALUES ('$id_pengguna','$nama_tempat','$jenjang','$jurusan','$tahun_mulai','$tahun_lulus')");
        $inputPendidikan -> execute();

        
        echo "<script>alert('Data Pendidikan berhasil ditambahkan');</script>";
        echo "<script>location='user_profile.php';</script>";
    }
    
    if(isset($_POST['ubah'])){
      $id_pendidikan = $_POST['id_pendidikan'];
      $newNamaTempat = $_POST['edt_nama_tempat'];
      $newJenjang = $_POST['edt_jenjang'];
      $newJurusan = $_POST['edt_jurusan'];
      $newTahunMulai = $_POST['edt_tahun_mulai'];
      $newTahunLulus = $_POST['edt_tahun_lulus'];

      $sqlEdit = $koneksiPdo -> prepare("UPDATE pendidikan SET nama_tempat = '$newNamaTempat', jenjang_pendidikan = '$newJenjang', jurusan = '$newJurusan', tahun_mulai = '$newTahunMulai', tahun_lulus = '$newTahunLulus' where id_pendidikan = '$id_pendidikan'");
      $sqlEdit ->execute();
                                            
      echo "<script>alert('Data Pendidikan berhasil diubah');</script>";
      echo "<script>location='user_profile.php';</script>";
      }

    if(isset($_POST['ubahProfile'])){
      $tentang = $_POST['tentang_anda'];
      $nama = $_POST['nama'];
      $email = $_POST['email'];
      $nomor_telepon = $_POST['nomor_telepon'];
      $sqlEditTentang = $koneksiPdo -> prepare("UPDATE pengguna SET nama = '$nama', email = '$email', nomor_telepon = '$nomor_telepon', about = '$tentang' where id_pengguna = '$id_pengguna'");
      $sqlEditTentang -> execute();

      $sqlSelectProfile = $koneksiPdo -> prepare("SELECT * FROM pengguna where id_pengguna = '$id_pengguna'");
      $sqlSelectProfile -> execute();

      $_SESSION['user'] = $sqlSelectProfile -> fetch();
      echo "<script>alert('Profile berhasil diubah');</script>";
      echo "<script>location='user_profile.php';</script>";
    }

    if(isset($_POST['tambahKeahlian'])){
      $keahlian = $_POST['keahlian'];
      
      $sqlTambahKeahlian = $koneksiPdo -> prepare("INSERT INTO keahlian (id_pengguna, nama_keahlian) values ('$id_pengguna', '$keahlian')");
      $sqlTambahKeahlian -> execute();

      echo "<script>alert('Keahlian berhasil ditambahkan');</script>";
      echo "<script>location='user_profile.php';</script>";
    }

    if(isset($_POST['editKeahlian'])){
      $keahlian = $_POST['keahlian'];
      $id_keahlian = $_POST['id_keahlian'];
      $sqlEditKeahlian = $koneksiPdo -> prepare("UPDATE keahlian SET nama_keahlian = '$keahlian' where id_keahlian = '$id_keahlian'");
      $sqlEditKeahlian -> execute();

      echo "<script>alert('Keahlian berhasil diubah menjadi" . $keahlian . "');</script>";
      echo "<script>location='user_profile.php';</script>";
    }

    if(isset($_POST['tambahPengalaman'])){
      $posisi = $_POST['posisi'];
      $nama_perusahaan = $_POST['nama_perusahaan'];
      $tanggal_masuk = $_POST['tanggal_masuk'];
      $durasi = $_POST['durasi'];
      $lokasi_pekerjaan = $_POST['lokasi_pekerjaan'];
      $deskripsi = $_POST['deskripsi'];
      
      $sqlTambahPengalaman = $koneksiPdo -> prepare("INSERT INTO pengalaman (id_pengguna, posisi, nama_perusahaan, tanggal_masuk, durasi, lokasi_pekerjaan, deskripsi) 
      values ('$id_pengguna', '$posisi', '$nama_perusahaan', '$tanggal_masuk', '$durasi', '$lokasi_pekerjaan', '$deskripsi')");
      $sqlTambahPengalaman -> execute();

      echo "<script>alert('Keahlian berhasil ditambahkan');</script>";
      echo "<script>location='user_profile.php';</script>";
    }
  ?>

</body>
</html>
