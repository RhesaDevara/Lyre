<?php
	require 'koneksi.php';
    include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Package</title>
</head>
<body>
    <center> <a href="package_tambah.php"> <input type="button" class="mt-5 btn btn-primary" value="Add New Package"> </a> </center>
    <table align=right class="table table-striped table-responsive-md table-hover mt-5"> 
		<thead align="center">
			<th>No</th>
			<th> ID Package</th>
			<th> Nama Package</th>
			<th> Kuota </th>
			<th> Harga </th>
			<th colspan=3> Action </th>
		</thead>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM package"); ?>
		<?php while($data = $ambil->fetch_assoc()){  ?>
			<tr align="center">
				<td><?= $nomor; ?></td>
				<td> <?php echo $data['id_package']; ?> </td>
				<td> <?php echo $data['nama_package']; ?> </td>
				<td> <?php echo $data['kuota']; ?> </td>
				<td> <?php echo $data['harga']; ?> </td>
				<td>
					<a href="package_ubah.php?&id=<?php echo $data['id_package']; ?>" class="btn btn-warning btn-sm">Edit</a>
					<a href="package_hapus.php?&id=<?php echo $data['id_package']; ?>" class="btn btn-danger btn-sm">Delete</a>
				</td>
			</tr>
		<?php $nomor++; ?>
	    <?php } ?>
	</table>
</div>
</body>
</html>