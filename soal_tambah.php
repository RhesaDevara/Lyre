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

            <div class="alert alert-info mt-5 mx-5 w-50 text-start">
                <h5>Keterangan membuat soal:</h5>
                <div class="ms-3">
                    <li>Tuliskan soal anda pada kolom input pertanyaan.</li>
                    <li>Masukkan setiap jawaban pilihan ganda ke kolomnya masing - masing.</li>
                    <li>Pilih salah satu pilihan dari A - D pada setiap soal untuk menentukan jawaban yang benar pada soal tersebut</li>
                    <li>Jawaban benar akan ditandai dengan lingkaran berwarna biru seperti <input type="radio" class="form-check-input" checked> </li>
                </div>

            </div>
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
                                    <td colspan=4> <input type="text" class="form-control" name="soalno${i}" required placeholder='Tulis soal disini!'> </td>
                                </tr>
                                <tr>
                                    <td rowspan=4> Pilihan No.${i} </td>
                                    <td rowspan=4> : </td>
                                    <td class="pt-3"> 
                                    <label class="form-control mt-2">
                                    <input type="radio" class="form-check-input"  name="pgno${i}" class="mt-3" value="A" required> A 
                                    <input type="text" placeholder='Masukkan pilihan jawaban A'  class="form-control mb-4" name="a${i}" required> </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td> <label class="form-control mt-2"><input type="radio" class="form-check-input"  name="pgno${i}" class="mt-3" value="B" required> B 
                                    <input type="text" placeholder='Masukkan pilihan jawaban B' class="form-control mb-4" name="b${i}" required></label></td>
                                </tr>
                                <tr>
                                    <td> <label class="form-control mt-2">
                                    <input type="radio" class="form-check-input"  name="pgno${i}" class="mt-3" value="C" required> C 
                                    <input type="text" placeholder='Masukkan pilihan jawaban C' class="form-control mb-4" name="c${i}" required></label></td>
                                </tr>
                                <tr>
                                    <td> <label class="form-control mt-2"><input type="radio" class="form-check-input"  name="pgno${i}" class="mt-3" value="D" required> D 
                                    <input type="text" placeholder='Masukkan pilihan jawaban D' class="form-control mb-4" name="d${i}" required></label></td>
                                </tr>
                                <tr>
                                    <td colspan=8> <hr> </td>
                                </tr>`;
                            }

                            table.innerHTML = html;
                        </script>
                        <br>
                </div>
            </center>
        </div>
        <center> <input type="submit" value="Konfirmasi" class="btn btn-success w-50">
            </form>
</body>

</html>