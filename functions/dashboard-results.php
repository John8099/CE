<?php 
session_start();
include "conn.php";

$arr = array(
    "adminCount" => mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `admin`")),
    "studentCount" => mysqli_num_rows(mysqli_query($conn, "SELECT * FROM students")),
    "engCount" => mysqli_num_rows(mysqli_query($conn, "SELECT * FROM exams WHERE category = 'english'")),
    "mathCount" => mysqli_num_rows(mysqli_query($conn, "SELECT * FROM exams WHERE category = 'math'")),
    "sciCount" => mysqli_num_rows(mysqli_query($conn, "SELECT * FROM exams WHERE category = 'science'")),
);

echo json_encode($arr);
