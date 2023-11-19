<?php
    include 'navbar.php';
    $sql = $koneksiPdo -> prepare("SELECT * FROM lowongan_pekerjaan");
    $sql -> execute();

    $sqlCount = $koneksiPdo -> prepare("SELECT COUNT(*) FROM lowongan_pekerjaan");
    $sqlCount -> execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Apply and Recruit</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
        integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />
</head>

<body>
    <style>
        body {
            background: #f5f5f5;
        }
    </style>
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-lg-8 mx-auto">
                <div class="mb-5">
                    <?php while ($data = $sql->fetch()) {
                        $id_lowongan = $data['id_lowongan'];
                        $tanggal_posting = date("j F Y", strtotime($data['tanggal_posting']));
                        ?>
                        <div class="card mb-3">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-2 text-center p-lg-4 p-2 mt-4 mt-lg-0">
                                    <?php
                                    $profilePicture = isset($_SESSION['company']['foto_perusahaan']) ? 'assets/img/' . $_SESSION['company']['foto_perusahaan'] : 'assets/img/profile.png';
                                    ?>
                                    <div class="d-flex align-items-center justify-content-center text-center mx-auto">
                                        <img src="<?php echo $profilePicture ?>" alt="FD Image"
                                            style="width: 70px; height: 70px;">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div
                                        class="card-body d-md-flex flex-md-row flex-column align-items-start justify-content-between text-center text-md-start">
                                        <div>
                                            <h5 class="card-title">
                                                <?php echo $data['posisi']; ?>
                                            </h5>
                                            <ul class="list-inline text-secondary">
                                                <li class="list-inline-item me-3">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                    <?php echo $data['lokasi_pekerjaan']; ?>
                                                </li>
                                                <li class="list-inline-item me-3">
                                                    <i class="far fa-money-bill-alt"></i>
                                                    <?php
                                                    $harga = $data['gaji'];
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
                                            <?php echo "<a href='detail_lowongan.php?id_lowongan=$id_lowongan'>"; ?> <button
                                                class="btn btn-secondary form-control">See Detail</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>