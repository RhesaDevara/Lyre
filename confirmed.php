<?php
include 'navbar.php';
$id_perusahaan = $_GET['id_perusahaan'];
$sql = $koneksiPdo->prepare("SELECT * FROM perusahaan where id_perusahaan = '$id_perusahaan'");
$sql->execute();

$data = $sql->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/crud.css">
</head>

<body>
    <div class="p-5" style="width:100%;">
        <div>
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
                <table class="table table-responsive">
                    <tr>
                        <td width=30%> ID Perusahaan </td>
                        <td width=10%> : </td>
                        <td> <?php echo $data['id_perusahaan']; ?> </td>
                    </tr>
                    <tr>
                        <td> Nama Perusahaan </td>
                        <td> : </td>
                        <td> <?php echo $data['nama_perusahaan']; ?> </td>
                    </tr>
                    <tr>
                        <td> Alamat Perusahaan </td>
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
                    <tr>
                        <td colspan=3> <input type="submit" value="Konfirmasi" class="btn form-control btn-primary"> <br>
                            </form>
                            <?php echo "<form method='post' action='proses_perusahaan.php?id_perusahaan=$id_perusahaan&action=reject'>"; ?>
                            <input type="submit" name="reject" value="Tolak" class="btn form-control btn-danger mt-2">
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>


</html>