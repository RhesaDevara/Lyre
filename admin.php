<?php
include 'navbar.php';

$keyword = '';
$orderBy = 'nama';
$orderDirection = 'ASC';

// Cek apakah ada data pencarian yang dikirimkan melalui URL
if (isset($_GET['keyword'])) {
	$keyword = $_GET['keyword'];
}

// Periksa parameter sort dari URL dan atur kolom dan arah pengurutan
if (isset($_GET['sort'])) {
	if ($_GET['sort'] === 'desc') {
		$orderDirection = 'DESC'; // Jika sort=desc, atur urutan ke descending
	}
}

// Melakukan pencarian data berdasarkan keyword pencarian dan pengurutan
$ambil = "SELECT * FROM admin WHERE nama LIKE '%$keyword%' OR email LIKE '%$keyword%' ORDER BY $orderBy $orderDirection";
$result = $koneksi->query($ambil);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LYRE - Admin</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<link rel="stylesheet" href="assets/css/crud.css">
</head>

<body>
	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-md-8">
							<h2>Admin <b>List</b></h2>
						</div>
						<div class="col-md-4">
							<div class="row">
								<div class="col-6">
									<a href="admin_input.php" class="btn btn-primary float-end">Add Admin</a>
								</div>
								<div class="col-6">
									<div class="search-box-crud">
										<i class="fa-solid fa-magnifying-glass"></i>
										<!-- Form untuk pencarian -->
										<form method="GET" action="">
											<input type="text" class="form-control" placeholder="Search&hellip;" name="keyword" value="<?php echo htmlspecialchars($keyword); ?>">
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
								Name
								<a href="?keyword=<?php echo htmlspecialchars($keyword); ?>&sort=<?php echo ($orderDirection === 'ASC') ? 'desc' : 'asc'; ?>">
									<i class="text-dark fa fa-sort <?php echo ($orderDirection === 'ASC') ? 'asc' : 'desc'; ?>"></i>
								</a>
							</th>
							<th>Email</th>
							<th>Hak Akses</th>
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
									<?php echo $data['id_admin']; ?>
								</td>
								<td>
									<?php echo $data['nama']; ?>
								</td>
								<td>
									<?php echo $data['email']; ?>
								</td>
								<td>
									<?php echo $data['hak_akses']; ?>
								</td>
								<td>
									<a href="admin_ubah.php?id=<?php echo $data['id_admin']; ?>" class="edit" title="Edit" data-toggle="tooltip"><i class="fas fa-edit text-warning fs-5"></i></a>
									<a href="admin_hapus.php?id=<?php echo $data['id_admin']; ?>" class="delete" title="Delete" data-toggle="tooltip"><i class="fas fa-trash-alt text-danger fs-5"></i></a>
								</td>
							</tr>
							<?php $nomor++; ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script src="script.js"></script>
</body>

</html>