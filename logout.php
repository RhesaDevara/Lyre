<?php
session_start();
unset($_SESSION["user"]);
unset($_SESSION["company"]);
unset($_SESSION["admin"]);
session_destroy();
header("Location:index.php");
?>