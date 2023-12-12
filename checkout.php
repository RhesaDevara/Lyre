<?php
include 'navbar.php';
$id_paket = $_GET['id_paket'];
$sql = $koneksiPdo->prepare("SELECT * FROM paket where id_paket = '$id_paket'");
$sql->execute();
$data = $sql->fetch();
$today = date("Ymd");
$id_perusahaan = $_SESSION['company']['id_perusahaan'];
$kuota = $_SESSION['company']['kuota'];
$tambahKuota = $data['kuota'];
?>
<!DOCTYPE html>
<?php
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Apply and Recruit</title>
</head>

<body>
    <div class="container mt-5" style="width: 50%">
        <div class="row">
            <h4 class="mb-3 mt-5">Detail Item</h4>
            <hr>
            <div class="d-block my-3">
                <div>
                    Nama Paket: <h5> <?php echo $data['nama_paket']; ?> </h5>
                    Kuota: <h5> <?php echo $data['kuota']; ?> Lowongan </h5>
                    Harga:
                    <h5><?php
                        $harga_format = number_format($data['harga'], 0, ',', '.');
                        echo "Rp. " . $harga_format . ",-"; ?>
                    </h5>
                </div>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <h4 class="mt-5 mb-3">Pembayaran</h4>
                <hr class="mb-4">
                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" class="form-check-input" type="radio" checked="" required value="Credit Card">
                        <label class="custom-control-label" for="credit">Kartu Kredit</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="debit" name="paymentMethod" class="form-check-input" type="radio" required value="Debit Card">
                        <label class="custom-control-label" for="debit">Kartu Debit</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cc-name">Nama</label>
                    <input type="text" name="nameoncard" class="form-control" id="cc-name" required>
                    <small class="text-muted">Nama lengkap yang terdaftar pada kartu</small>
                    <div class="invalid-feedback"> Name on card is required </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cc-number">Nomor Kartu</label>
                    <input type="text" class="form-control" id="creditCard" placeholder="XXXX-XXXX-XXXX-XXXX" required maxlength="19">

                    <script>
                        document.getElementById('creditCard').addEventListener('input', function(e) {
                            // Menghapus karakter selain angka
                            let creditCardNumber = e.target.value.replace(/\D/g, '');

                            // Menambahkan tanda '-' setelah setiap 4 digit
                            creditCardNumber = creditCardNumber.replace(/(\d{4})/g, '$1-');

                            // Menghapus tanda '-' terakhir jika ada
                            creditCardNumber = creditCardNumber.replace(/-$/, '');

                            // Menetapkan nilai ke dalam input
                            e.target.value = creditCardNumber;
                        });
                    </script>

                    <div class="invalid-feedback"> Credit card number is required </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="cc-expiration">Kadaluarsa</label>
                    <input type="text" class="form-control" id="cc-expiration" placeholder="MM/YY" maxlength="5" required>

                    <script>
                        document.getElementById('cc-expiration').addEventListener('input', function(e) {
                            // Menghapus karakter selain angka
                            let expirationDate = e.target.value.replace(/\D/g, '');

                            // Menambahkan tanda '/' setelah dua digit pertama
                            expirationDate = expirationDate.replace(/(\d{2})/, '$1/');

                            // Menghapus karakter setelah 5 karakter
                            expirationDate = expirationDate.substring(0, 5);

                            // Menetapkan nilai ke dalam input
                            e.target.value = expirationDate;
                        });
                    </script>
                    <div class="invalid-feedback"> Expiration date required </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="cc-cvv">CVV</label>
                    <input type="text" class="form-control" id="cc-cvv" placeholder="XXX" required maxlength="3">

                    <script>
                        document.getElementById('cc-cvv').addEventListener('input', function(e) {
                            // Menghapus karakter selain angka
                            let cvv = e.target.value.replace(/\D/g, '');

                            // Menghapus karakter setelah 3 digit
                            cvv = cvv.substring(0, 3);

                            // Menetapkan nilai ke dalam input
                            e.target.value = cvv;
                        });
                    </script>
                    <div class="invalid-feedback"> Security code required </div>
                </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block form-control" type="submit" name="bayar">Bayar</button>
        </form>
    </div>
    </div>
    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">© 2017-2019 Company Name</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
    </div>
    <script>
        (function() {
            'use strict'

            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation')

                // Loop over them and prevent submission
                Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
            }, false)
        }())
    </script>
</body>
<?php
if (isset($_POST['bayar'])) {
    $newKuota = $kuota + $tambahKuota;
    $paymentMethod = $_POST['paymentMethod'];
    $nameoncard = $_POST['nameoncard'];
    $sql1 = $koneksiPdo->prepare("UPDATE perusahaan set kuota = '$newKuota' where id_perusahaan = '$id_perusahaan'");
    $sql1->execute();

    $sql2 = $koneksiPdo->prepare("SELECT * FROM perusahaan where id_perusahaan = '$id_perusahaan'");
    $sql2->execute();
    $_SESSION['company'] = $sql2->fetch();

    $sql3 = $koneksiPdo->prepare("INSERT INTO pembelian (id_perusahaan, id_paket, payment_method, name_on_card, tanggal_pembelian) 
    values ('$id_perusahaan','$id_paket','$paymentMethod','$nameoncard','$today')");
    $sql3->execute();

    echo "<script>alert('Terima kasih telah mempercayai kami!');</script>";
    echo "<script>location='company_profile.php'</script>";
}
?>

</html>