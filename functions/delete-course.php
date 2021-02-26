<?php
include "conn.php";
session_start();

$query = mysqli_query($conn, "DELETE FROM courses WHERE id = $_GET[id]");

if ($query) {
    echo "<script>
    alert('Course Deleted successfully.')
    window.location.href = '../pages/suggested-courses.php';
    </script>";
}
