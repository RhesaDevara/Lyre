<?php
include 'navbar.php';

$keyword = '';
$orderBy = 'nama_perusahaan';
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
$ambil = "SELECT * FROM perusahaan WHERE nama_perusahaan LIKE '%$keyword%' OR email_perusahaan LIKE '%$keyword%' ORDER BY $orderBy $orderDirection";
$result = $koneksi->query($ambil);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LYRE - Admin</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<link rel="stylesheet" href="crud.css">   
</head>
<body>
	<div style="width:95%; margin:auto;">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-md-8">
							<h2>Daftar <b>Perusahaan</b></h2>
						</div>
						<div class="col-md-4">
							<div class="row">
								<div class="col-6">
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
								Nama Perusahaan
								<a
									href="?keyword=<?php echo htmlspecialchars($keyword); ?>&sort=<?php echo ($orderDirection === 'ASC') ? 'desc' : 'asc'; ?>">
									<i
										class="text-dark fa fa-sort <?php echo ($orderDirection === 'ASC') ? 'asc' : 'desc'; ?>"></i>
								</a>
							</th>
							<th>Email</th>
							<th>Telepon</th>
							<th>Alamat</th>
							<th>Deskripsi</th>
							<th>Kuota</th>
							<th>Status Akun</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $nomor = 1; ?>
						<?php while ($data = $result->fetch_assoc()) { 
                                $id_perusahaan = $data['id_perusahaan'];
                                $nama_perusahaan = $data['nama_perusahaan'];
                                ?>
							<tr>
								<td>
									<?= $nomor; ?>
								</td>
								<td>
									<?php echo $id_perusahaan; ?>
								</td>
								<td>
									<?php echo $nama_perusahaan;  ?>
								</td>
								<td>
									<?php echo $data['email_perusahaan']; ?>
								</td>
								<td>
									<?php echo $data['nomor_telepon']; ?>
								</td>
								<td>
									<?php echo $data['alamat_perusahaan']; ?>
								</td>
								<td>
									<?php echo $data['deskripsi_perusahaan']; ?>
								</td>
								<td>
									<?php echo $data['kuota']; ?>
								</td>
								<td>
									<?php echo $data['status_akun']; ?>
								</td>
								<td>
                                    <?php 
                                        if($data['status_akun'] == 'Belum Review'){
                                            ?> 
                                            <?php echo "<form method='post' action='proses_perusahaan.php?id_perusahaan=$id_perusahaan&nama_perusahaan=$nama_perusahaan&action=review'>"; ?>
                                                <input type="submit" class="btn btn-primary" value="Konfirmasi">
                                            </form>
                                            <?php
                                        }else if($data['status_akun'] == 'Sedang Review'){ ?>
                                        <?php echo "<form method='post' action='confirmed.php?id_perusahaan=$id_perusahaan'>"; ?>
                                            <input type="submit" class="btn btn-secondary" value="Sedang di Konfirmasi">
                                        </form>
                                            <?php
                                        }else if($data['status_akun'] == 'Aktif'){ ?>
                                            <input type="submit" class="btn btn-success" value="Lihat Profile">
                                        <?php }
                                    ?>
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
