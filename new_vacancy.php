<?php
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/css/crud.css">
    </style>
</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="text-left mb-3 mt-3">
                    <a href="our_vacancy.php" title="Back To Our Vacancy" data-toggle="tooltip"><i class="fa-solid fa-arrow-left fa-2xl" style="color: #20444F;"></i></a>
                </div>
                <div class="table-title">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2>Buat <b>Lowongan</b></h2>
                        </div>
                    </div>
                </div>
                <form action="new_vacancy_process.php" method="post">
                    <div class="mb-3">
                        <label for="posisi" class="form-label mt-2">Posisi</label>
                        <input type="text" class="form-control" name="posisi" placeholder="Masukkan posisi" required>
                    </div>
                    <div class="mb-3">
                        <label for="departemen" class="form-label">Departemen</label>
                        <input type="text" class="form-control" name="departemen" placeholder="Masukkan departemen" required>
                    </div>
                    <div class="mb-3">
                        <label for="gaji" class="form-label mt-2">Gaji</label>
                        <input type="number" class="form-control" name="gaji" placeholder="Masukkan gaji" required>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi_pekerjaan" class="form-label mt-2">Lokasi Pekerjaan</label>
                        <input type="text" class="form-control" name="lokasi_pekerjaan" placeholder="Masukkan lokasi pekerjaan" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi_pekerjaan" class="form-label mt-2">Deskripsi Pekerjaan</label>
                        <textarea id="deskripsi_pekerjaan" name="deskripsi_pekerjaan" placeholder="Masukkan deskripsi pekerjaan"></textarea>
                    </div>
                    <div class="text-left">
                        <button type="submit" class="btn btn-success w-100">Buat Lowongan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#deskripsi_pekerjaan'), {
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|', 'heading',
                        '|', 'bold', 'italic',
                        '|', 'bulletedList', 'numberedList', 'blockQuote',
                    ],
                    shouldNotGroupWhenFull: false
                }
            })
            .catch(error => {
                console.log(error);
            });
    </script>
    <script src="script.js"></script>
</body>

</html>