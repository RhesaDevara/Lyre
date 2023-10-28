<?php
include 'navbar.php';

$keyword = '';
$orderBy = 'nama_paket';
$orderDirection = 'ASC';

// Cek apakah ada data pencarian yang dikirimkan melalui URL
if (isset($_GET['keyword'])) {
	$keyword = $_GET['keyword'];
}

// Periksa parameter sort dari URL dan atur kolom dan arah pengurutan
if (isset($_GET['sort'])) {
	if ($_GET['sort'] === 'desc') {
		$orderDirection = 'DESC';
	}
}

// Melakukan pencarian data berdasarkan keyword pencarian dan pengurutan
$ambil = "SELECT * FROM paket WHERE nama_paket LIKE '%$keyword%' ORDER BY $orderBy $orderDirection";
$result = $koneksi->query($ambil);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LYRE - Packages</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<link rel="stylesheet" href="crud.css">
</head>

<body>
	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-md-8">
							<h2>Package <b>List</b></h2>
						</div>
						<div class="col-md-4">
							<div class="row">
								<div class="col-6">
									<a href="package_tambah.php" class="btn btn-primary float-end">Add Package</a>
								</div>
								<div class="col-6">
									<div class="search-box-crud">
										<i class="fa-solid fa-magnifying-glass"></i>
										<!-- Form untuk pencarian -->
										<form method="GET" action="">
											<input type="text" class="form-control" placeholder="Search&hellip;"
												name="keyword" value="<?php echo htmlspecialchars($keyword); ?>">
										</form>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<table class="table table-striped table-hover table-bordered text-center">
					<thead>
						<tr>
							<th>No</th>
							<th>ID</th>
							<th>
								Package Name
								<a
									href="?keyword=<?php echo htmlspecialchars($keyword); ?>&sort=<?php echo ($orderDirection === 'ASC') ? 'desc' : 'asc'; ?>">
									<i
										class="text-dark fa fa-sort <?php echo ($orderDirection === 'ASC') ? 'asc' : 'desc'; ?>"></i>
								</a>
							</th>
							<th>
								Kuota
								<a
									href="?keyword=<?php echo htmlspecialchars($keyword); ?>&sort=<?php echo ($orderDirection === 'ASC') ? 'desc' : 'asc'; ?>">
									<i
										class="text-dark fa fa-sort <?php echo ($orderDirection === 'ASC') ? 'asc' : 'desc'; ?>"></i>
								</a>
							</th>
							<th>
								Harga
								<a
									href="?keyword=<?php echo htmlspecialchars($keyword); ?>&sort=<?php echo ($orderDirection === 'ASC') ? 'desc' : 'asc'; ?>">
									<i
										class="text-dark fa fa-sort <?php echo ($orderDirection === 'ASC') ? 'asc' : 'desc'; ?>"></i>
								</a>
							</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php $nomor = 1; ?>
						<?php while ($data = $result->fetch_assoc()) { ?>
							<tr>
								<td>
									<?= $nomor; ?>
								</td>
								<td>
									<?php echo $data['id_paket']; ?>
								</td>
								<td>
									<?php echo $data['nama_paket']; ?>
								</td>
								<td>
									<?php echo $data['kuota']; ?>
								</td>
								<td>
									<?php echo $data['harga']; ?>
								</td>
								<td>
									<a href="package_ubah.php?id=<?php echo $data['id_paket']; ?>" class="edit" title="Edit"
										data-toggle="tooltip"><i class="fas fa-edit text-warning fs-5"></i></a>
									<a href="package_hapus.php?id=<?php echo $data['id_paket']; ?>" class="delete"
										title="Delete" data-toggle="tooltip"><i
											class="fas fa-trash-alt text-danger fs-5"></i></a>
								</td>
							</tr>
							<?php $nomor++; ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Bootstrap JS and dependencies -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script>
		$(document).ready(function () {
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
</body>

</html>