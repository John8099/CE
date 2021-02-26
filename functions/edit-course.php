<?php
include "conn.php";
session_start();

$id = $_GET["id"];
$course = $_POST['course'];
$cat = $_POST['cat'];

$query = mysqli_query($conn, "UPDATE courses SET course='$course', category='$cat' WHERE id=$id");
if ($query) {
    echo "<script>
    alert('Course Updated successfully.'); 
    window.location.href = '../pages/suggested-courses.php'
    </script>";
}
