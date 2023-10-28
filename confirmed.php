<?php
include 'navbar.php';
$id_perusahaan = $_GET['id_perusahaan'];
$sql = $koneksiPdo -> prepare("SELECT * FROM perusahaan where id_perusahaan = '$id_perusahaan'");
$sql -> execute();

$data = $sql -> fetch();
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
							<h2>Data <b>Perusahaan</b></h2>
						</div>
						<div class="col-md-4">
							<div class="row">
								<div class="col-6">
								</div>
							</div>
						</div>
					</div>
				</div>
                <?php echo "<form method='post' action='proses_perusahaan.php?id_perusahaan=$id_perusahaan&action=confirm'>"; ?>
                <table>
                    <tr> 
                        <td> ID Perusahaan </td>
                        <td> : </td>
                        <td> <?php echo $data['id_perusahaan']; ?> </td>
                    </tr>
                    <tr> 
                        <td> Nama Perusahaan </td>
                        <td> : </td>
                        <td> <?php echo $data['nama_perusahaan']; ?> </td>
                    </tr>
                    <tr> 
                        <td> Alamat  Perusahaan </td>
                        <td> : </td>
                        <td> <?php echo $data['alamat_perusahaan']; ?> </td>
                    </tr>
                    <tr> 
                        <td> Email Perusahaan </td>
                        <td> : </td>
                        <td> <?php echo $data['email_perusahaan']; ?> </td>
                    </tr>
                    <tr> 
                        <td> Nomor Telepon </td>
                        <td> : </td>
                        <td> <?php echo $data['nomor_telepon']; ?> </td>
                    </tr>
                    <tr> 
                        <td> Deskripsi </td>
                        <td> : </td>
                        <td> <?php echo $data['deskripsi_perusahaan']; ?> </td>
                    </tr>
                </table>
                <input type="submit" value="Konfirmasi" class="btn btn-success">
                </form>

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
