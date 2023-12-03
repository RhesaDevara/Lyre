<?php
include 'navbar.php';

$id_pengguna = $_SESSION['user']['id_pengguna'];

$sqlLamaran = $koneksiPdo->prepare("SELECT * FROM lamaran where id_pengguna = '$id_pengguna'");
$sqlLamaran->execute();


$sqlCountLamaran = $koneksiPdo->prepare("SELECT count(*) FROM lamaran where id_pengguna = '$id_pengguna'");
$sqlCountLamaran->execute();

$countLamaran = $sqlCountLamaran->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container pt-5">
        <?php
        if ($countLamaran == 0) { ?>
            <div class="alert alert-warning">
                <p class="text-center">Anda belum melamar. Ayo mulai lamarkan diri anda!</p>
            </div>
            <?php } else {
            while ($dataLamaran = $sqlLamaran->fetch()) {
                $id_lowongan = $dataLamaran['id_lowongan'];
                $id_lamaran = $dataLamaran['id_lamaran'];
                $status_lamaran = $dataLamaran['status_lamaran'];

                $sqlLowongan = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where id_lowongan = '$id_lowongan'");
                $sqlLowongan->execute();

                $sqlCountHasilTes = $koneksiPdo->prepare("SELECT * FROM hasil_tes where id_lamaran = '$id_lamaran'");
                $sqlCountHasilTes->execute();

                $countHasilTes = $sqlCountHasilTes->rowCount();

                while ($dataLowongan = $sqlLowongan->fetch()) {
                    $tanggal_posting = date("j F Y", strtotime($dataLowongan['tanggal_posting']));
                    $id_perusahaan = $dataLowongan['id_perusahaan'];

                    $sqlPerusahaan = $koneksiPdo->prepare("SELECT * FROM perusahaan where id_perusahaan = '$id_perusahaan'");
                    $sqlPerusahaan->execute();

                    $dataPerusahaan = $sqlPerusahaan->fetch();
            ?>
                    <div class="card mb-3 mx-2 shadow-sm">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-2 text-center p-lg-4 mt-4 mt-md-0">
                                <div class="d-flex align-items-center justify-content-center text-center mx-auto">
                                    <img src="<?php echo $dataPerusahaan['logo'] ?>" class="rounded" alt="Company Logo" style="width: 100px; height: 100px;">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="card-body d-md-flex flex-md-row flex-column align-md-items-start align-items-center justify-content-between text-start">
                                    <div>
                                        <div class="d-flex flex-row">
                                            <div class="me-2">
                                                <h5 class="card-title">
                                                    <?php echo $dataLowongan['posisi']; ?>
                                                </h5>
                                            </div>
                                            <div class="text-secondary">
                                                <?php
                                                if ($status_lamaran == 'Diperiksa') {
                                                    echo "<span class='text-warning fw-bold'>(Status: " . $dataLamaran['status_lamaran'] . ")</span>";
                                                } else if ($status_lamaran == 'Tahap Tes') {
                                                    echo "<span class='text-primary fw-bold'>(Status: " . $dataLamaran['status_lamaran'] . ")</span>";
                                                } else if ($status_lamaran == 'Ditolak') {
                                                    echo "<span class='text-danger fw-bold'>(Status: " . $dataLamaran['status_lamaran'] . ")</span>";
                                                } else if ($status_lamaran == 'Lolos') {
                                                    echo "<span class='text-success fw-bold'>(Status: " . $dataLamaran['status_lamaran'] . ")</span>";
                                                } ?>
                                            </div>
                                        </div>
                                        <div class="text-secondary">
                                            <span>Dikirim pada
                                                <?php
                                                $tanggal_lamaran = date("j F Y", strtotime($dataLamaran['tanggal_kirim']));
                                                echo $tanggal_lamaran; ?>
                                            </span>
                                        </div>
                                        <ul class="list-inline text-secondary">
                                            <li class="list-inline-item me-3">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <?php echo $dataLowongan['lokasi_pekerjaan']; ?>
                                            </li>
                                            <li class="list-inline-item me-3 mt-3">
                                                <i class="far fa-money-bill-alt"></i>
                                                <?php
                                                $gaji = $dataLowongan['gaji'];
                                                $gaji_format = number_format($harga, 0, ",", ".");
                                                echo "Rp. " . $gaji_format . ",-"; ?>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa-solid fa-calendar-days"></i>
                                                <?php echo $tanggal_posting ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="my-auto mt-md-0 mt-md-3 text-md-end text-center d-grid">
                                        <?php
                                        if ($status_lamaran == "Diperiksa") { ?>
                                            <button class="btn btn-warning w-100" disabled>Kerjakan Tes</button>
                                        <?php } else if ($status_lamaran == "Ditolak") { ?>
                                            <button class="btn btn-danger w-100" disabled>Telah Ditolak</button>
                                            <?php } else if ($status_lamaran == "Tahap Tes") {
                                            if ($countHasilTes == 0) {
                                            ?>
                                                <a href=<?php echo "tes.php?id_lamaran=$id_lamaran&id_lowongan=$id_lowongan"; ?>><button class="btn btn-primary w-100">Kerjakan Tes</button></a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href=#><button class="btn btn-info w-100" disabled>Sedang Diproses</button></a>
                                            <?php
                                            }
                                        } else if ($status_lamaran == "Lolos") { ?>
                                            <a href="<?php echo "keterangan_hasil.php?id_lamaran=$id_lamaran"; ?>"><button class="btn btn-success w-100">Lolos</button></a>
                                        <?php } else { ?>
                                            <button class="btn btn-info w-100" disabled>Sedang Diproses</button>
                                        <?php } ?>
                                        <?php echo "<a href='detail_lowongan.php?id_lowongan=$id_lowongan'>"; ?>
                                        <button class="btn btn-secondary w-100 mt-2">Lihat Detail</button></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
        <?php }
            }
        }
        ?>
</body>

</html>