
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

<!-- Modal tambah sertifikat -->
<div class="modal fade" id="tambahSertifikatModal" tabindex="-1" role="dialog" aria-labelledby="tambahKeahlianModalLabel" aria-hidden="true">
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
