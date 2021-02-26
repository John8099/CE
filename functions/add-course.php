<?php
include "conn.php";
session_start();

$course = $_POST['course'];
$cat = $_POST['cat'];

$query = mysqli_query($conn, "INSERT INTO courses(course, category) VALUES('$course','$cat')");

if ($query) {
    echo "<script>
    alert('Course Added successfully.'); 
    window.location.href = '../pages/add-suggested-courses.php'
    </script>";
}
