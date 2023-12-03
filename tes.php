<?php
include 'navbar.php';

$id_pengguna = $_SESSION['user']['id_pengguna'];
$id_lamaran = $_GET['id_lamaran'];
$id_lowongan = $_GET['id_lowongan'];

$sqlCountSoal = $koneksiPdo->prepare("SELECT * FROM soal where id_lowongan = '$id_lowongan'");
$sqlCountSoal->execute();
$countSoal = $sqlCountSoal->rowCount();

$sqlSoal = $koneksiPdo->prepare("SELECT * FROM soal where id_lowongan = '$id_lowongan'");
$sqlSoal->execute();

// Lakukan JOIN antara tabel lowongan_pekerjaan dan perusahaan
$sql = $koneksiPdo->prepare("SELECT lp.*, p.* FROM lowongan_pekerjaan lp
                            INNER JOIN perusahaan p ON lp.id_perusahaan = p.id_perusahaan
                            WHERE lp.id_lowongan = $id_lowongan");
$sql->execute();
$data = $sql->fetch();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Apply and Recruit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/css.css">
</head>

<body>
    <form method="post" name="form">
        <section class="pt-5 pb-5">
            <div class="container">
                <div class="row mt-0 mt-md-4">
                    <div class="col-12">
                        <div class="card mb-4 shadow">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span> <img src="<?php echo $data['logo']; ?>" alt="course" class="rounded" style="width: 6.5rem;"></span>
                                        <div class="ms-3">
                                            <h3 class="mb-0"><span class="text-inherit">
                                                    <?php echo $data['posisi']; ?>
                                                </span></h3>
                                        </div>
                                    </div>
                                    <div>

                                        <p id="timer" class="text-danger"></p>

                                        <script>
                                            let timer = 1200;

                                            function updateTimer() {
                                                timer--;

                                                let minutes = Math.floor(timer / 60);
                                                let seconds = timer % 60;

                                                document.getElementById("timer").innerHTML = `${minutes} menit ${seconds} detik`;

                                                if (timer <= 0) {

                                                    document.getElementById("forcedSubmit").click();
                                                }
                                            }

                                            setInterval(updateTimer, 1000);
                                        </script>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <?php
                                    $i = 1;
                                    while ($dataSoal = $sqlSoal->fetch()) { ?>
                                        <span>Question
                                            <?php echo $i; ?>
                                        </span>
                                        <h3 class="mb-3 mt-1">
                                            <?php echo $dataSoal['pertanyaan']; ?>
                                        </h3>
                                        <input type="text" name="id_soal<?php echo $i; ?>" value="<?php echo $dataSoal['id_soal']; ?>" hidden>
                                        <input type="text" name="kunciJawaban<?php echo $i; ?>" value="<?php echo $dataSoal['jawaban']; ?>" hidden>
                                        <div class="list-group">
                                            <input class="form-check-input" type="radio" name="jawaban<?php echo $i; ?>" value="Z" id="flexRadioDefault0_<?php echo $i; ?>" checked hidden>

                                            <div class="list-group-item list-group-item-action " aria-current="true">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jawaban<?php echo $i; ?>" value="A" id="flexRadioDefault1_<?php echo $i; ?>">
                                                    <label class="form-check-label stretched-link" for="flexRadioDefault1_<?php echo $i; ?>">
                                                        <?php echo $dataSoal['pilihan_a']; ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="list-group-item list-group-item-action">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jawaban<?php echo $i; ?>" value="B" id="flexRadioDefault2_<?php echo $i; ?>">
                                                    <label class="form-check-label stretched-link" for="flexRadioDefault2_<?php echo $i; ?>">
                                                        <?php echo $dataSoal['pilihan_b']; ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="list-group-item list-group-item-action">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jawaban<?php echo $i; ?>" value="C" id="flexRadioDefault3_<?php echo $i; ?>">
                                                    <label class="form-check-label stretched-link" for="flexRadioDefault3_<?php echo $i; ?>">
                                                        <?php echo $dataSoal['pilihan_c']; ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="list-group-item list-group-item-action">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jawaban<?php echo $i; ?>" value="D" id="flexRadioDefault4_<?php echo $i; ?>">
                                                    <label class="form-check-label stretched-link" for="flexRadioDefault4_<?php echo $i; ?>">
                                                        <?php echo $dataSoal['pilihan_d']; ?>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    <?php $i++;
                                    } ?>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success" id="submit" name="submit" onclick='return confirm("Apakah Anda Yakin?")'>
                                            Finish <i class="fa-regular fa-circle-check"></i>
                                        </button>

                                        <input type="submit" hidden name="forcedSubmit" id="forcedSubmit">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </form>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(document).ready(function() {
            // Saat halaman dimuat, cek apakah terdapat nilai yang tersimpan di localStorage untuk setiap tombol radio.
            $('input[type="radio"]').each(function() {
                var radioName = $(this).attr('name');
                var storedValue = localStorage.getItem(radioName);
                if (storedValue === $(this).val()) {
                    $(this).prop('checked', true);
                }
            });

            // Ketika tombol radio dipilih, simpan nilainya ke dalam localStorage.
            $('input[type="radio"]').on('change', function() {
                var radioName = $(this).attr('name');
                var checkedValue = $(this).val();
                localStorage.setItem(radioName, checkedValue);
            });

            // Saat tombol "Finish" ditekan, hapus semua nilai yang tersimpan di localStorage.
            $('#submit').on('click', function() {
                $('input[type="radio"]').each(function() {
                    var radioName = $(this).attr('name');
                    localStorage.removeItem(radioName);
                });
            });
        });
    </script>

</body>

<?php

$benar = 0;
if (isset($_POST['submit']) || $_POST['forcedSubmit']) {
    for ($j = 1; $j <= $countSoal; $j++) {
        $id_soal = $_POST['id_soal'];
        $kunciJawaban = $_POST['kunciJawaban' . $j];
        $jawaban = $_POST['jawaban' . $j];
        if ($jawaban == $kunciJawaban) {
            $benar++;
        }
    }

    $nilai = $benar / $countSoal * 100;

    $sqlHasil = $koneksiPdo->prepare("INSERT INTO hasil_tes(id_lamaran, id_lowongan, nilai) values ('$id_lamaran','$id_lowongan', '$nilai')");
    $sqlHasil->execute();

    echo "<script>alert('Tes Selesai. Terima kasih Telah mengerjakan tes!');</script>";
    echo "<script>location='my_application.php';</script>";
}
?>

</html>