<?php
session_start();
include "conn.php";
$fname = $_POST["fname"];
$mname = $_POST["mname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$uname = $_POST["uname"];
$pass = password_hash($_POST["pass"], PASSWORD_ARGON2I);

$query = mysqli_query($conn, "INSERT INTO `admin`(fname, mname, lname, email, uname, `password`) VALUES('$fname','$mname','$lname','$email','$uname','$pass')");

if ($query) {
    $formatedName = strtoupper("$lname, $fname $mname[0].");
    echo "<script>
    alert('Admin $formatedName Added successfully.'); 
    window.location.href = '../pages/add-admin.php'
    </script>";
}
