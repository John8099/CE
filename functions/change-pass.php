<?php
session_start();
include "conn.php";

if (isset($_GET["checkCurrent"])) {
    $id = $_POST['id'];
    $oldPass = $_POST['pass'];

    $query = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");
    $student = mysqli_fetch_object($query);

    if (md5($oldPass) == $student->password) {
        echo "true";
    } else {
        echo "false";
    }
} else {
    $id = $_POST['id'];
    $pass = md5($_POST['newPass']);

    $query = mysqli_query($conn, "UPDATE students set `password`='$pass' WHERE id = '$id'");
    if ($query) {
        echo '<script>
        alert("Password updated successfully.")
        window.location.href = "../pages/student-dashboard.php"
        </script>';
    }
}
