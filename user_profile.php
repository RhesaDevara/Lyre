<?php
    include 'navbar.php';
    if(isset($_SESSION['user'])){
      $id_pengguna = $_SESSION['user']['id_pengguna'];
    }else{
      $id_pengguna = $_GET['id_pengguna'];
    }
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

    $sqlKeahlian1 = $koneksiPdo ->prepare("SELECT * FROM keahlian where id_pengguna = '$id_pengguna'");
    $sqlKeahlian1 -> execute();

    $sqlPengalaman = $koneksiPdo ->prepare("SELECT * FROM pengalaman where id_pengguna = '$id_pengguna'");
    $sqlPengalaman -> execute();

    $sqlSertifikat = $koneksiPdo ->prepare("SELECT * FROM sertifikat where id_pengguna = '$id_pengguna'");
    $sqlSertifikat -> execute();

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
        .profile-container-20{
            width: 20%;
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
            <div class="px-5" style="text-align: justify;">
                <font size="3"> 
                  <p class="px-5 pt-5"><?php echo $data['about']; ?> </p>
                  </font> 
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
                            <div class="pt-1">
                    <?php
                      if(isset($_SESSION['user'])){  ?>  
                        <i class="fa-solid fa-pencil ms-3 mt-1" style="color: #20444F;" data-toggle='modal' data-target='#editModal<?php echo $i ?>'></i> 
                        <?php }
                    ?> 
                            
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
                    ?> <hr>  
                    <?php
                      if(isset($_SESSION['user'])){    
                        if($countPendidikan < 3){
                            echo "
                            <button type='button' class='btn btn-secondary' data-toggle='modal' data-target='#exampleModal' data-whatever='@getbootstrap'> + Tambahkan Pendidikan</button> </center>"; 
                        }
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
                                  
                    <?php
                      if(isset($_SESSION['user'])){   ?> 
                        <div class="pt-1"> <i class="fa-solid fa-pencil ms-3 mt-1" style="color: #20444F;" data-toggle='modal' data-target='#editPengalaman<?php echo $k; ?>'></i> </div>
                        <?php }
                    ?>  
                                  
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
                    <?php
                      if(isset($_SESSION['user'])){    ?>
                          <button class="btn btn-secondary mt-2" data-toggle="modal" data-target="#tambahPengalaman">+ Tambahkan Pengalaman Kerja</button>
                       <?php }
                    ?>  
                </div>
            </div>
            <div class="p-3 mt-5 profile-container-20">
                <div class="d-flex flex-row"> 
                  <div> <h3> Keahlian </h3></div>
                  
                    <?php
                      if(isset($_SESSION['user'])){ ?>
                        
                  <div class="pt-2"> <i class="fa-solid fa-pencil ms-3 mt-1" style="color: #20444F;" data-toggle='modal' data-target='#editKeahlianModal'></i> </h3> </div> 
                        <?php }
                    ?>  
                    </div>
                    <hr>
                  <?php 
                    while($dataKeahlian = $sqlKeahlian -> fetch()){
                      ?>
                        <div class="d-flex flex-row px-4">
                          <div class="background-text mb-2 pt-1" style="width:100%; height: 35px;"> <center><?php echo $dataKeahlian['nama_keahlian']; ?>  </div>
                          <div> </div> </div>       
                      <?php
                    }

                  
                    if(isset($_SESSION['user'])){
                    if($countKeahlian < 10){
                      ?> <center><button class="btn btn-secondary mt-2" data-toggle='modal' data-target='#tambahKeahlianModal'> + Tambahkan Keahlian </button></center> <?php
                      }
                    }
                  ?>
                </div>
            </div>
        </div>

        <div class="d-flex flex-row"> 
            <div class="px-5 pb-5 profile-container-80" style="text-align: justify">
             <h3> Sertifikat </h3> <hr>
             <?php
             $m = 1;
              while($dataSertifikat = $sqlSertifikat -> fetch()){
              ?>
                <div class="list-group">
                            <a class="list-group-item list-group-item-action flex-column align-items-start p-3">
                              <div class="d-flex w-100 justify-content-between">
                                <div class="d-flex flex-row">
                                  <div><h5 class="mb-1"><?php echo $dataSertifikat['nama_sertifikat']; ?> </h5> </div> 
                                  <?php
                                  if(isset($_SESSION['user'])){ ?>
                                    <div class="pt-1"> <i class="fa-solid fa-pencil ms-3 mt-1" style="color: #20444F;" data-toggle='modal' data-target='#editSertifikat<?php echo $m; ?>'></i> </div>
                                    <?php }
                                  ?>      
                                </div>
                              </div>
                              <small><b><?php echo $dataSertifikat['nama_penerbit']; ?></b></small> <br>
                              <small class="mb-1" style="text-align: justify";><?php echo $dataSertifikat['tanggal_terbit']. " - " . $dataSertifikat['tanggal_kadaluarsa']; ?></small>
                            </a>
                      </div>

                                  
            <!-- Modal ubah sertifikat -->
                <div class="modal fade" id="editSertifikat<?php echo $m; ?>" tabindex="-1" role="dialog" aria-labelledby="editSertifikatLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Ubah Sertifikat</h5> 
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="post">
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Nama Sertifikat:</label>
                                  <input type="text" class="form-control" id="nama_sertifikat" name="nama_sertifikat" placeholder="Pengenalan UI/UX" value="<?php echo $dataSertifikat['nama_sertifikat'];?>">
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Nama Penerbit:</label>
                                  <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" placeholder="Dicoding Indonesia" value="<?php echo $dataSertifikat['nama_penerbit'];?>">
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Tanggal Terbit:</label>
                                  <input type="date" class="form-control" id="tanggal_terbit" name="tanggal_terbit" value="<?php echo $dataSertifikat['tanggal_terbit'];?>">
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Tanggal Kadaluarsa:</label>
                                  <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" value="<?php echo $dataSertifikat['tanggal_kadaluarsa'];?>">
                                </div>
                            </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <input type="submit" name="editKeahlian" class="btn btn-warning" value="Ubah">
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>

             <?php $m++;} ?>
             
             <?php
              if(isset($_SESSION['user'])){ ?> 
                <button class="btn btn-secondary mt-2" data-toggle='modal' data-target='#tambahSertifikat'> + Tambahkan Sertifikat </button> 
              <?php } ?>  
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

<!-- Modal ubah keahlian -->
    <div class="modal fade" id="editKeahlianModal" tabindex="-1" role="dialog" aria-labelledby="editKeahlianModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ubah Keahlian</h5> 
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <font color='grey'> Kosongkan kolom pengisian untuk menghapus keahlian </font>
                  <form method="post">
                    <?php
                    $l = 1; 
                    while($dataEditKeahlian = $sqlKeahlian1 -> fetch()){ ?>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Keahlian <?php echo $l; ?>:</label> <input type="text" hidden name="id_keahlian<?php echo $l; ?>" value="<?php echo $dataEditKeahlian['id_keahlian']; ?>">
                        <input type="text" class="form-control" id="keahlian" name="keahlian<?php echo $l; ?>" placeholder="Kotlin / Java / PHP / Javascript" value="<?php echo $dataEditKeahlian['nama_keahlian'];?>">
                      </div>
                    <?php $l++; } ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <input type="submit" name="editKeahlian" class="btn btn-warning" value="Ubah">
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

<!-- Modal tambah sertifikat -->
<div class="modal fade" id="tambahSertifikat" tabindex="-1" role="dialog" aria-labelledby="tambahKeahlianModalLabel" aria-hidden="true">
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
            <label for="recipient-name" class="col-form-label">Nama Sertifikat:</label>
            <input type="text" class="form-control" id="nama_sertifikat" name="nama_sertifikat" placeholder="Pengenalan UI/UX"></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Penerbit:</label>
            <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" placeholder="Dicoding Indonesia"></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tanggal Terbit:</label>
            <input type="date" class="form-control" id="tanggal_terbit" name="tanggal_terbit"></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tanggal Kadaluarsa:</label>
            <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <input type="submit" name="tambahSertifikat" class="btn btn-primary" value="Konfirmasi">
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
      for($o = 1;$o <= $countKeahlian; $o++){
        $keahlian = $_POST['keahlian' . $o];
        $id_keahlian = $_POST['id_keahlian' . $o];
        if(empty($keahlian) || !isset($keahlian)){
          $sqlDeleteKeahlian = $koneksiPdo -> prepare("DELETE FROM keahlian where id_keahlian = '$id_keahlian'");
          $sqlDeletekeahlian -> execute();
        }else{
          $sqlEditKeahlian = $koneksiPdo -> prepare("UPDATE keahlian SET nama_keahlian = '$keahlian' where id_keahlian = '$id_keahlian'");
          $sqlEditKeahlian -> execute();
        }
      }
      echo "<script>alert('Keahlian berhasil diubah');</script>";
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

    if(isset($_POST['tambahSertifikat'])){
      $nama_sertifikat = $_POST['nama_sertifikat'];
      $nama_penerbit = $_POST['nama_penerbit'];
      $tanggal_terbit = $_POST['tanggal_terbit'];
      $tanggal_kadaluarsa = $_POST['tanggal_kadaluarsa'];

      $sqlTambahSertifikat = $koneksiPdo -> prepare("INSERT INTO sertifikat (id_pengguna, nama_sertifikat, nama_penerbit, tanggal_terbit, tanggal_kadaluarsa) 
      values ('$id_pengguna', '$nama_sertifikat', '$nama_penerbit', '$tanggal_terbit', '$tanggal_kadaluarsa')");
      $sqlTambahSertifikat -> execute();

      echo "<script>alert('Sertifikat berhasil ditambahkan');</script>";
      echo "<script>location='user_profile.php';</script>";

    }
  ?>

</body>
</html>
