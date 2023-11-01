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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="crud.css">
</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="text-left mb-3 mt-3">
                    <a href="admin.php" title="Back To Admin List" data-toggle="tooltip"><i
                            class="fa-solid fa-arrow-left fa-2xl" style="color: #20444F;"></i></a>
                </div>
                <div class="table-title">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2>Add <b>Admin</b></h2>
                        </div>
                    </div>
                </div>
                <form method="POST" action="admin_process.php">
                    <div class="mb-3">
                        <label for="na me" class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your full name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label mt-2">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label mt-2">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your password"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label mt-2">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm-password"
                            placeholder="Confirm your password" required>
                    </div>
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary form-control">Add Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>

</html>