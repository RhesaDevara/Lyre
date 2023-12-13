<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Apply and Recruit</title>
</head>

<body>

    <?php
    include 'navbar.php';
    ?>

    <form method="post" action="find_job.php">
        <div class="container">
            <div class="hero-section">
                <div class="hero-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <h1 class="display-5"><b>Pekerjaan Impian</b> <br>Anda Sedang Menunggu</h1>
                            <p class="lead">Cari pekerjaan yang cocok dengan kemampuan dan keahlian anda.</p>
                            <div class="search-input input-group mb-3">
                                <input class="form-control" type="search" name="search" id="search-input"
                                    placeholder="Cari...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <img src="assets/img/interview.png" class="hero-img" loading="lazy" alt="Hero Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</body>

</html>