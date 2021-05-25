<?php
session_start();
include "conn.php";
$id = $_GET['id'];

$fname = $_POST["fname"];
$mname = $_POST["mname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$uname = $_POST["uname"];
$pass = empty($_POST["pass"]);

$query;
if ($pass) {
    $query = mysqli_query($conn, "UPDATE `admin` SET fname = '$fname', mname = '$mname', lname = '$lname', email = '$email', uname = '$uname'  WHERE id = '$id'");
} else {
    $encrytPass = md5($_POST["pass"]);
    $query = mysqli_query($conn, "UPDATE `admin` SET fname = '$fname', mname = '$mname', lname = '$lname', email = '$email', uname = '$uname', `password` = '$encrytPass' WHERE id = '$id'");
}

if ($query) {
    echo "<script>
    alert('Profile Updated successfully.'); 
    window.location.href = '../pages/admin.php'</script>";
}
