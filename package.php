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
    $sortType = $_GET['sort'];
    switch ($sortType) {
        case 'asc':
            $orderDirection = 'ASC';
            break;
        case 'desc':
            $orderDirection = 'DESC';
            break;
        default:
            $orderDirection = 'ASC';
            break;
    }
}

// Menyesuaikan kolom pengurutan berdasarkan input pengguna
if (isset($_GET['orderBy'])) {
    $orderBy = $_GET['orderBy'];
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
    <title>LYRE - Paket</title>
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
                            <h2>Daftar <b>Paket</b></h2>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-6">
                                    <a href="package_tambah.php" class="btn btn-primary float-end">Tambah Paket</a>
                                </div>
                                <div class="col-6">
                                    <div class="search-box-crud">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <!-- Form untuk pencarian -->
                                        <form method="GET" action="">
                                            <input type="text" class="form-control" placeholder="Cari&hellip;" name="keyword" value="<?php echo htmlspecialchars($keyword); ?>">
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
                                Nama Paket
                                <a href="?keyword=<?php echo htmlspecialchars($keyword); ?>&orderBy=nama_paket&sort=<?php echo ($orderBy === 'nama_paket' && $orderDirection === 'ASC') ? 'desc' : 'asc'; ?>">
                                    <i class="text-dark fa fa-sort <?php echo ($orderBy === 'nama_paket' && $orderDirection === 'ASC') ? 'asc' : 'desc'; ?>"></i>
                                </a>
                            </th>
                            <th>
                                Kuota
                                <a href="?keyword=<?php echo htmlspecialchars($keyword); ?>&orderBy=kuota&sort=<?php echo ($orderBy === 'kuota' && $orderDirection === 'ASC') ? 'desc' : 'asc'; ?>">
                                    <i class="text-dark fa fa-sort <?php echo ($orderBy === 'kuota' && $orderDirection === 'ASC') ? 'asc' : 'desc'; ?>"></i>
                                </a>
                            </th>
                            <th>
                                Harga
                                <a href="?keyword=<?php echo htmlspecialchars($keyword); ?>&orderBy=harga&sort=<?php echo ($orderBy === 'harga' && $orderDirection === 'ASC') ? 'desc' : 'asc'; ?>">
                                    <i class="text-dark fa fa-sort <?php echo ($orderBy === 'harga' && $orderDirection === 'ASC') ? 'asc' : 'desc'; ?>"></i>
                                </a>
                            </th>
                            <th>Aksi</th>
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
                                    <?php $harga_format = number_format($data['harga'], 0, ',', '.');
                                    echo "Rp. " . $harga_format ?>
                                </td>
                                <td>

                                    <a href="package_ubah.php?id=<?php echo $data['id_paket']; ?>" data-toggle="tooltip" title="Edit" data-toggle="tooltip"><i class="fas fa-edit text-warning fs-5"></i></a>
                                    <a href="package_hapus.php?id=<?php echo $data['id_paket']; ?>" class="delete" title="Delete" data-toggle="tooltip"><i class="fas fa-trash-alt text-danger fs-5"></i></a>
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