<?php
    include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRE - Admin</title>
</head>
<body>
    <center>
    <form action="admin_process.php" method="post">
        <h2 style="margin-top:50px;"> Add New Admin </h2>
    <div class="mt-5 px-5"  style="width:75%;text-align:left;">
    <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter your full name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label mt-2">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label mt-2">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
    </div>
    <div class="mb-3">
        <label for="confirm-password" class="form-label mt-2">Confirm Password</label>
        <input type="password" class="form-control" name="confirm-password" placeholder="Confirm your password" required>
    </div>
    <div class="mb-3">
        <input type="submit" class="form-control btn btn-primary" value="Register New Admin">
    </div>
    </div>
</form>
</body>
</html>