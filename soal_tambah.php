<?php
include 'navbar.php';
$id_lowongan = $_POST['id_lowongan'];

$sqlLowongan = $koneksiPdo->prepare("SELECT * FROM lowongan_pekerjaan where id_lowongan = '$id_lowongan'");
$sqlLowongan->execute();

$data = $sqlLowongan->fetch();
$jumlah_soal = $_POST['jumlah_soal'];
?>
<!DOCTYPE html>
<html lang="en">


<body>
    <div class="mt-5 p-2">
        <center>
            <h3> Soal Tes : <b>
                    <?php echo $data['posisi']; ?>
                </b> </h3>
        </center>
        <?php
        echo "<form method='post' action='question_process.php?id_lowongan=$id_lowongan'>"; ?>
        <div class="my-5">
            <input type="number" id="jumlah_pertanyaan" name="jumlah_pertanyaan" min="1" value="<?php echo $jumlah_soal; ?>" hidden>
            <center>
                <div>
                    <center>
                        <table width=75% border=0 id="questionTable">
                            <tr>
                                <th colspan=8>
                                    <center>
                                        <h4>Soal</h4>
                                </th>
                            </tr>
                        </table>
                        <script>
                            var jumlah_pertanyaan = parseInt(document.getElementById('jumlah_pertanyaan').value);
                            var table = document.getElementById('questionTable');
                            var html = '';

                            for (var i = 1; i <= jumlah_pertanyaan; i++) {
                                html += `
                                <tr>
                                    <td> <b> Pertanyaan No.${i} </td>
                                    <td> : </td>
                                    <td colspan=4> <input type="text" class="form-control" name="soalno${i}" required> </td>
                                </tr>
                                <tr>
                                    <td rowspan=4> Pilihan No.${i} </td>
                                    <td rowspan=4> : </td>
                                    <td class="pt-3"> <label><input type="radio" class="form-check-input"  name="pgno${i}" class="mt-3" value="A" required> A <input type="text" class="form-control mb-4" name="a${i}" required> </label></td>
                                </tr>
                                <tr>
                                    <td> <label><input type="radio" class="form-check-input"  name="pgno${i}" class="mt-3" value="B" required> B <input type="text" class="form-control mb-4" name="b${i}" required></label></td>
                                </tr>
                                <tr>
                                    <td> <label><input type="radio" class="form-check-input"  name="pgno${i}" class="mt-3" value="C" required> C <input type="text" class="form-control mb-4" name="c${i}" required></label></td>
                                </tr>
                                <tr>
                                    <td> <label><input type="radio" class="form-check-input"  name="pgno${i}" class="mt-3" value="D" required> D <input type="text" class="form-control mb-4" name="d${i}" required></label></td>
                                </tr>
                                <tr>
                                    <td colspan=8> <hr> </td>
                                </tr>`;
                            }

                            table.innerHTML = html;
                        </script>
                        <br>
                        <center> <input type="submit" value="Konfirmasi" class="btn btn-success mt-3">
                </div>
            </center>
        </div>
        </form>
</body>

</html>