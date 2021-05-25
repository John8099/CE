<?php
session_start();
include "conn.php";

$id = $_GET['id'];

$q = mysqli_query($conn, "DELETE FROM exams WHERE id = $id");

if ($q) {
    echo "
    <script>
        alert('Exam successfully delete.')
        window.location.href = '../pages/$_GET[cat].php'
    </script>
    ";
}
