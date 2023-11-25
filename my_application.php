<?php
include 'navbar.php';

$id_pengguna = $_SESSION['user']['id_pengguna'];

$sqlLamaran = $koneksiPdo->prepare("SELECT * FROM lamaran where id_pengguna = '$id_pengguna'");
$sqlLamaran->execute();

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
        while ($dataLamaran = $sqlLamaran->fetch()) {
            $id_lowongan = $dataLamaran['id_lowongan'];
            $id_lamaran = $dataLamaran['id_lamaran'];
            $status_lamaran = $dataLamaran['status_lamaran'];

            $sqlLowongan = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where id_lowongan = '$id_lowongan'");
            $sqlLowongan->execute();
            while ($dataLowongan = $sqlLowongan->fetch()) {
                $tanggal_posting = date("j F Y", strtotime($dataLowongan['tanggal_posting']));
        ?>
                <div class="card mb-3 mx-2">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-2 text-center p-lg-4 mt-4 mt-lg-0">
                            <?php
                            $profilePicture = isset($_SESSION['company']['foto_perusahaan']) ? 'assets/img/' . $_SESSION['company']['foto_perusahaan'] : 'assets/img/profile.png';
                            ?>
                            <div class="d-flex align-items-center justify-content-center text-center mx-auto">
                                <img src="<?php echo $profilePicture ?>" alt="FD Image" style="width: 70px; height: 70px;">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body d-md-flex flex-md-row flex-column align-items-start justify-content-between text-center text-md-start">
                                <div>
                                    <div class="d-flex flex-row">
                                        <div class="me-2">
                                            <h5 class="card-title"><?php echo $dataLowongan['posisi']; ?> </h5>
                                        </div>
                                        <div class="">
                                            <font color="grey"><?php
                                                                if ($status_lamaran == 'Diperiksa') {
                                                                    echo " (Status: <font color='orange'><b>" . $dataLamaran['status_lamaran'] . ")</b></font>";
                                                                } else if ($status_lamaran == 'Tahap Tes') {
                                                                    echo " (Status: <font class='text-primary'><b>" . $dataLamaran['status_lamaran'] . ")</b></font>"; ?>
                                                <?php } else if ($status_lamaran == 'Ditolak') {
                                                                    echo " (Status: <font color='Red'><b>" . $dataLamaran['status_lamaran'] . ")</b></font>"; ?>
                                                <?php } ?>
                                        </div>
                                    </div>
                                    <div> Dikirim pada <?php echo $dataLamaran['tanggal_kirim']; ?> </font>
                                    </div>
                                    <ul class="list-inline text-secondary">
                                        <li class="list-inline-item me-3">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <?php echo $dataLowongan['lokasi_pekerjaan']; ?>
                                        </li>
                                        <li class="list-inline-item me-3 mt-3">
                                            <i class="far fa-money-bill-alt"></i>
                                            <?php
                                            $harga = $dataLowongan['gaji'];
                                            $harga_format = number_format($harga, 0, ",", ".");
                                            echo "Rp. " . $harga_format . ",-"; ?>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <?php echo $tanggal_posting ?>
                                        </li>
                                    </ul>
                                </div>
                                <div class="my-auto mt-md-0 mt-md-3 text-md-end text-center">
                                    <?php
                                    if ($status_lamaran == "Diperiksa") { ?>
                                        <button class="btn btn-warning form-control" disabled>Kerjakan Tes</button>
                                    <?php } else if ($status_lamaran == "Ditolak") { ?>
                                        <button class="btn btn-danger form-control" disabled>Telah Ditolak</button>
                                    <?php } else if ($status_lamaran == "Tahap Tes") { ?>
                                        <a href=<?php echo "tes.php?id_lamaran=$id_lamaran&id_lowongan=$id_lowongan"; ?>><button class="btn btn-primary form-control">Kerjakan Tes</button></a>
                                    <?php } else { ?>
                                        <button class="btn btn-info form-control" disabled>Sedang Diproses</button>
                                    <?php } ?>
                                    <?php echo "<a href='detail_lowongan.php?id_lowongan=$id_lowongan'>"; ?>
                                    <button class="btn btn-secondary form-control mt-2">Lihat Detail</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php }
        }

        ?>
</body>

</html>