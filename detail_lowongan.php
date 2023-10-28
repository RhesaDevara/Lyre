<?php
    include 'navbar.php';
    $id_lowongan = $_GET['id_lowongan'];
    $sql = $koneksiPdo -> prepare("SELECT * FROM lowongan_pekerjaan where id_lowongan = '$id_lowongan'");
    $sql ->execute();

    $data = $sql -> fetch();

    $sql1 = $koneksiPdo ->prepare("SELECT * FROM soal where id_lowongan = '$id_lowongan'");
    $sql1 -> execute();

?>
<!DOCTYPE html>
<?php
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Apply and Recruit</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LYRE - Admin</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<link rel="stylesheet" href="crud.css">
</head>
<body>
    <table style="margin:auto;">
        <tr>
            <th colspan=3> Detail Lowongan </th>
        </tr>
        <tr>
            <th colspan=3> <a href="soal_tambah.php?id_lowongan=<?php echo $id_lowongan; ?>"><input type="button" value="Tambah Soal" class="btn btn-primary"></a> </th>
        </tr>
        <tr>
            <td> Posisi </td>
            <td> : </td>
            <td> <?php echo $data['posisi']; ?> </td>
        </tr>
        <tr>
            <td> Departemen </td>
            <td> : </td>
            <td> <?php echo $data['departemen']; ?> </td>
        </tr>
        <tr>
            <td> Gaji </td>
            <td> : </td>
            <td> <?php echo $data['gaji']; ?> </td>
        </tr>
        <tr>
            <td> Lokasi Pekerjaan </td>
            <td> : </td>
            <td> <?php echo $data['lokasi_pekerjaan']; ?> </td>
        </tr>
        <tr>
            <td> Tanggal Posting </td>
            <td> : </td>
            <td> <?php echo $data['tanggal_posting']; ?> </td>
        </tr>
</table>
<?php 
$cekSoal = $koneksiPdo ->prepare("SELECT count(*) from soal where id_lowongan = '$id_lowongan'");
$cekSoal ->execute();
$count = $cekSoal ->fetchColumn();
if($count > 0 ){
?>
    <table class="table table-bordered">
        <tr>
            <th colspan=8> <center> Soal </th>
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
        <?php while($dataSoal = $sql1 ->fetch()){?>
        <tr>
            <td> <?php echo $dataSoal['id_soal']; ?></td>
            <td> <?php echo $dataSoal['pertanyaan']; ?></td>
            <td> <?php echo $dataSoal['pilihan_a']; ?></td>
            <td> <?php echo $dataSoal['pilihan_b']; ?></td>
            <td> <?php echo $dataSoal['pilihan_c']; ?></td>
            <td> <?php echo $dataSoal['pilihan_d']; ?></td>
            <td> <?php echo $dataSoal['jawaban']; ?></td> 
            <td> <a href="soal_ubah.php?id_pertanyaan=<?php echo $dataSoal['id_soal'];?>" class="edit" title="Edit" data-toggle="tooltip"><i class="fas fa-edit text-warning fs-5"></i></a>
				<a href="soal_hapus.php?id_pertanyaan=<?php echo $dataSoal['id_soal'];?>" class="delete" title="Delete" data-toggle="tooltip"><i class="fas fa-trash-alt text-danger fs-5"></i></a></td> 
        </tr>
        <?php }} ?>
</body>
</html>
