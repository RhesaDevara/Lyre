<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Apply and Recruit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        .login-container .form-control {
            border-radius: 3px;
        }

        .login-container .btn-primary {
            width: 100%;
        }

        .logo {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-container">
            <div class="logo">LYRE</div>
            <div class="text-center mb-4">
                <h4>Apply and Recruit</h4>
            </div>
            <form>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter your password">
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
            <div class="mb-3 text-center">
                <p>Don't have an account? Sign up here.</p>
            </div>
            <div class="text-center">
                <a href="daftar_user.php" class="btn btn-secondary">Applicant</a>
                <a href="daftar_company.php" class="btn btn-secondary">Company</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
