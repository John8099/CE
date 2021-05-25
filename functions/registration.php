<?php
session_start();
include "conn.php";

$student_fname = $_POST["fname"];
$student_mname = $_POST["mname"];
$student_lname = $_POST["lname"];
$homeAdd = $_POST["homeAdd"];
$gender = $_POST["gender"];
$bdate = $_POST["bdate"];
$religion = $_POST["religion"];
$civilStat = $_POST["civilStat"];
$contactNumber = $_POST["contactNumber"];
$email = $_POST["email"];
$fatherName = $_POST["fatherName"];
$fatherOccupation = $_POST["fatherOccupation"];
$motherName = $_POST["motherName"];
$motherOccupation = $_POST["motherOccupation"];
$password = password_hash($_POST['lname'], PASSWORD_ARGON2I);

$insert_stundent = mysqli_query($conn, "INSERT INTO students(id, student_fname, student_mname, student_lname, student_home_add, gender, student_birthday, religion, civil_status, contact_number, email, father_name, father_occupation, mother_name, mother_occupation, `password`) VALUES(NULL, '$student_fname', '$student_mname', '$student_lname', '$homeAdd', '$gender', '$bdate', '$religion', '$civilStat','$contactNumber', '$email', '$fatherName', '$fatherOccupation', '$motherName', '$motherOccupation', '$password')");

if ($insert_stundent) {
    $_SESSION["user_id"] = mysqli_insert_id($conn);
    echo '<script>
    alert("You are now registered ' . $student_fname . " " . $student_lname . '. \nYour temporary password is your \"Last Name\".")
    window.location.href = "../pages/student-dashboard.php"
    </script>';
}
