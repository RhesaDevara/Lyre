<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Apply and Recruit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .navbar-custom {
            background-color: #20444F;
        }

        .navbar-custom .navbar-brand {
            color: #fff;
            display: flex;
            align-items: center;
        }

        .navbar-custom .navbar-brand img {
            margin-right: 10px;
            height: 30px;
        }

        .navbar-custom .navbar-nav .nav-link {
            color: #fff;
            transition: color 0.3s ease;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 0.25rem;
        }

        .navbar-custom .navbar-nav .nav-link:hover {
            background-color: #fff;
            color: #20444F;
        }

        .navbar-custom .btn-login {
            background-color: transparent;
            border: 1px solid #fff;
            color: #fff;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar-custom .btn-login:hover {
            background-color: #fff;
            color: #20444F;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/img/logo.png" alt="Logo">
                LYRE
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Find Job</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Online Test</a>
                    </li>
                </ul>
            </div>
            <a href="login.php" class="btn btn-login">Login</a>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
