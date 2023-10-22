<?php
	require 'koneksi.php';
    include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Position</title>
</head>
<body>
    <center> <a href="posisi_tambah.php"> <input type="button" class="mt-5 btn btn-primary" value="Add New Position"> </a> </center>
    <table align=right class="table table-responsive-md table-hover mt-5"> 
		<thead align="center">
			<th>No</th>
			<th> ID Posisi</th>
			<th> Nama Posisi</th>
			<th colspan=3> Action </th>
			
		</thead>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM posisi"); ?>
		<?php while($data = $ambil->fetch_assoc()){  ?>
			<tr align="center">
				<td><?= $nomor; ?></td>
				<td> <?php echo $data['id_posisi']; ?> </td>
				<td> <?php echo $data['nama_posisi']; ?> </td>
				<td>
					<a href="posisi_ubah.php?&id=<?php echo $data['id_posisi']; ?>" class="btn btn-warning btn-sm">Edit</a>
					<a href="posisi_hapus.php?&id=<?php echo $data['id_posisi']; ?>" class="btn btn-danger btn-sm">Delete</a>
				</td>
			</tr>
		<?php $nomor++; ?>
	    <?php } ?>
	</table>
</div>
</body>
</html>