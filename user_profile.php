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
            background:#F2F2F2;
        }
        </style>
</head>
<body>
    <div class="top-profile pt-5 px-5">
    <div class="d-flex flex-row profile-container-100">
        <div class="d-flex flex-column">
            <div class="d-flex flex-row p-2">
                <div class="p-2 profile-container-30"> <center> <img src="assets/img/profile.png" class="img-profile"> </div>
                <div class="p-2 profile-container-70"> <h1 style="margin-top: 30px;"> <?php echo $data['nama']; ?> </h1> <?php echo $data['email']; ?> </div>
            </div>
            <div class="px-5" style="text-align: justify;">
                <font size="2"> <?php echo $data['about']; ?> </font> <?php
                if(isset($_SESSION['user'])){ ?>
                    <br><br> <button class="btn btn-warning form-control"> Edit </button> 
                <?php } ?>
            </div>
        </div>

        <div class="d-flex flex-column profile-container-100"> 
            <div class="py-4 px-2">
                <h3> Pendidikan </h3>
                <?php
                    while($dataPendidikan = $sqlPendidikan -> fetch()){
                         ?>
                         <hr>
                        <form method="post">
                        <div class="d-flex flex-row"> 
                            <input type="text" value="<?php echo $dataPendidikan['id_pendidikan']; ?>" hidden name="id_pendidikan">
                            <div> <h5> <?php echo $dataPendidikan['nama_tempat']; ?> </h5></div>
                            <div class="pt-1"> <button type="submit" name="edit_pendidikan" data-toggle='modal' data-target='#editModal'><i class="fa-solid fa-pencil ms-3"></i></button> </div>
                    </div>
                        <i><?php echo $dataPendidikan['jurusan']; ?></i> <br>
                        <?php echo $dataPendidikan['jenjang_pendidikan']; ?> <br>
                        <b><?php echo $dataPendidikan['tahun_mulai'] . " - " . $dataPendidikan['tahun_lulus'];  ?> </b> </form> <?php
                    } ?> <hr>  <?php

                    if($countPendidikan < 2){
                        echo "<center> 
                        <button type='button' class='btn btn-secondary mt-5' data-toggle='modal' data-target='#exampleModal' data-whatever='@getbootstrap'> + Tambahkan pendidikan</button> </center>"; 
                    }
                ?>
            </div>
            <div class="px-2"> 
                
            </div>
        </div>
    </div>
    <div class="d-flex flex-column">
        <div class="d-flex flex-row">
            <div class="d-flex flex-row p-5 profile-container-70">
                <div class="p-2 profile-container-30"> 
                    <h2> Pengalaman </h2>
                </div>
            </div>
            <div class="p-2">
                <h3> Keahlian </h3>
            </div>
        </div>

        <div class="d-flex flex-row"> 
            <div class="p-5 profile-container-70" style="text-align: justify">
             asdf
            </div>
            <div class="p-2"> 
                asdf 
            </div>
        </div>
    </div>

    
      
    <?php
    if(isset($_POST['edit_pendidikan'])){
        $id_pendidikan = $_POST['id_pendidikan'];
        $selectPendidikan = $koneksiPdo -> prepare("SELECT * FROM pendidikan where id_pendidikan = '$id_pendidikan'");
        $selectPendidikan -> execute();
        $dataSelect = $selectPendidikan -> fetch();
        ?>
        
        
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Pendidikan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
        <form method="post">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Tempat:</label>
            <input type="text" class="form-control" id="nama_tempat" name="nama_tempat" placeholder="e.g Universitas Darma Persada" value="<?php echo $selectPendidikan['nama_tempat'];?>">
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
            </select>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Jurusan:</label>
            <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="e.g. Teknologi Informasi">
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

        <?php
        }
    ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Pendidikan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
        <form method="post">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Tempat:</label>
            <input type="text" class="form-control" id="nama_tempat" name="nama_tempat" placeholder="e.g Universitas Darma Persada">
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
            </select>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Jurusan:</label>
            <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="e.g. Teknologi Informasi">
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
    ?>
</body>
</html>
