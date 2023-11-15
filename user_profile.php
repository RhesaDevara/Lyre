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
                    if($countPendidikan == 0){
                        echo "<center> 
                        <button type='button' class='btn btn-secondary mt-5' data-toggle='modal' data-target='#exampleModal' data-whatever='@getbootstrap'> + Tambahkan pendidikan</button> </center>"; 
                    }else{
                        while($dataPendidikan = $sqlPendidikan -> fetch()){
                            ?>
                            <h3> <?php echo $dataPendidikan['nama_tempat']; ?> </h3>
                            <?php echo $dataPendidikan['jurusan']; ?> <br>
                            <?php echo $dataPendidikan['jenjang_pendidikan']; ?> <br>
                            <?php echo $dataPendidikan['tahun_mulai'] . " - " . $dataPendidikan['tahun_lulus']; 
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
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Tempat:</label>
            <input type="text" class="form-control" id="nama_tempat">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Jenjang:</label>
            <select class="form-control" id="cbJenjang" name="jenjang">
                <option value="">Pilih...</option>
                <option value="sma"> SMA (Sekolah Menengah Akhir) </option>
                <option value="smk"> SMK (Sekolah Menengah Kejuruan) </option>
                <option value="pt"> Perguruan Tinggi </option>
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Jurusan:</label>
            <input type="text" class="form-control" id="jurusan">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tahun Mulai:</label>
            <input type="text" class="form-control" id="tahun_mulai">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tahun Lulus:</label>
            <input type="text" class="form-control" id="tahun_lulus">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary">Konfirmasi</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
