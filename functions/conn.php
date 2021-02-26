<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "ce";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    echo "<script>window.location.href='error.php'</script>";
}
