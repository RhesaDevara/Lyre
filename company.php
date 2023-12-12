<?php
include 'navbar.php';
$sqlPerusahaan = $koneksiPdo->prepare("SELECT * FROM perusahaan ORDER BY status_akun ASC");
$sqlPerusahaan->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<link rel="stylesheet" href="assets/css/crud.css">
	<title>LYRE - Perusahaan</title>
</head>

<body>
	<div class="container pt-5">
		<?php
		while ($data = $sqlPerusahaan->fetch()) {
			$id_perusahaan = $data['id_perusahaan'];
			$stats_akun = $data['status_akun'];
			$nama_perusahaan = $data['nama_perusahaan'];


			$sqlCountLowongan = $koneksiPdo->prepare("SELECT count(*) FROM lowongan_pekerjaan where id_perusahaan = '$id_perusahaan'");
			$sqlCountLowongan->execute();

			$countLowongan = $sqlCountLowongan->fetchColumn();
		?>
			<div class="card mb-3 mx-2 shadow-sm">
				<div class="row g-0 align-items-center">
					<div class="col-md-2 text-center p-lg-4 mt-4 mt-md-0">
						<div class="d-flex align-items-center justify-content-center text-center mx-auto">
							<img src="<?php echo $data['logo'] ?>" class="rounded" alt="Company Logo" style="width: 100px; height: 100px;">
						</div>
					</div>
					<div class="col-md-10">
						<div class="card-body d-md-flex flex-md-row flex-column align-md-items-start align-items-center justify-content-between text-start">
							<div>
								<div class="d-flex flex-row">
									<div class="me-2">
										<h5 class="card-title">
											<?php echo $data['nama_perusahaan']; ?>
										</h5>
									</div>
									<div class="text-secondary">
										<?php
										if ($stats_akun == 'Belum Review') {
											echo "<span class='text-warning fw-bold'>(Status: " . $data['status_akun'] . ")</span>";
										} else if ($stats_akun == 'Sedang Review') {
											echo "<span class='text-primary fw-bold'>(Status: " . $data['status_akun'] . ")</span>";
										} else if ($stats_akun == 'Ditolak') {
											echo "<span class='text-danger fw-bold'>(Status: Ditolak)</span>";
										} else {
											echo "<span class='text-success fw-bold'>(Status: Aktif)</span>";
										} ?>
									</div>
								</div>
								<div class="text-secondary">
									<span>
										<?php
										echo $data['email_perusahaan']; ?>
									</span>
								</div>
								<ul class="list-inline text-secondary">
									<li class="list-inline-item me-3">
										<i class="fa-solid fa-location-dot"></i>
										<?php echo $data['alamat_perusahaan']; ?>
									</li> <br>
									<li class="list-inline-item me-3 mt-3">
										<i class="fa-solid fa-phone"></i>
										<?php echo $data['nomor_telepon'] ?>
									</li>
									<li class="list-inline-item">
										<i class="fa-solid fa-upload"></i>
										<?php echo $countLowongan ?>
									</li>
								</ul>
							</div>
							<div class="mt-md-0 mt-md-3 text-md-end text-center d-grid" style="width: 25%">
								<a href=<?php echo "company_profile.php?id_perusahaan=$id_perusahaan"; ?>>
									<button class="btn btn-secondary form-control mt-2">Lihat Detail</button></a>
								<?php
								if ($data['status_akun'] == "Belum Review") { ?>
									<?php echo "<a href='proses_perusahaan.php?id_perusahaan=$id_perusahaan&nama_perusahaan=$nama_perusahaan&action=review'>"; ?>
									<input type="button" value="Review" class="btn btn-primary mt-1 form-control" onclick='return confirm("Apakah Anda Yakin?")'></a>
								<?php } else if ($data['status_akun'] == "Sedang Review") { ?>
									<?php echo "<a href='confirmed.php?id_perusahaan=$id_perusahaan'>"; ?>
									<input type="button" value="Sedang Review" class="btn btn-warning mt-1 w-100"></a>
								<?php } else if ($data['status_akun'] == "Ditolak") { ?>

									<input type="button" value="Ditolak" class="btn btn-danger mt-1 w-100">
								<?php } else { ?>
									<input type="button" value="Aktif" class="btn btn-success mt-1 w-100">
								<?php } ?>
							</div>

						</div>
					</div>
				</div>
			</div>
		<?php }

		?>
</body>

</html>