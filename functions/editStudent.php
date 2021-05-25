<?php
session_start();
include "conn.php";

$id = $_GET["id"];

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

$password = md5($_POST['lname']);

$query = mysqli_query($conn, "UPDATE students set 
                                student_fname = '$student_fname',
                                student_mname = '$student_mname',
                                student_lname = '$student_lname',
                                student_home_add = '$homeAdd',
                                gender = '$gender',
                                student_birthday = '$bdate',
                                religion = '$religion',
                                civil_status = '$civilStat',
                                contact_number = '$contactNumber',
                                email = '$email',
                                father_name = '$fatherName',
                                father_occupation = '$fatherOccupation',
                                mother_name = '$motherName',
                                mother_occupation = '$motherOccupation',
                                `password` = '$password'
                                WHERE id = $id
                                ");

if ($query) {
    if (isset($_GET["location"])) {
        echo "<script>
        alert('Profile Updated successfully.'); 
        window.location.href = '../pages/student-profile.php'</script>";
    } else {
        echo "<script>
        alert('Student Updated successfully.'); 
        window.location.href = '../pages/student.php'</script>";
    }
}
