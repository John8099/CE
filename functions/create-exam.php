<?php
session_start();
include "conn.php";

$category = $_POST['category'];
$question = $_POST['question'];
$c1 = $_POST['c1'];
$c2 = $_POST['c2'];
$c3 = $_POST['c3'];
$c4 = $_POST['c4'];
$answer = "";

$answer1 = !isset($_POST['answer1']) ? "" : $_POST['answer1'];
$answer2 = !isset($_POST['answer2']) ? "" : $_POST['answer2'];
$answer3 = !isset($_POST['answer3']) ? "" : $_POST['answer3'];
$answer4 = !isset($_POST['answer4']) ? "" : $_POST['answer4'];

$answers = array($answer1, $answer2, $answer3, $answer4);

foreach ($answers as $ans) {
    if (!empty($ans)) {
        $answer = $ans;
    }
}

$query = mysqli_query($conn, "INSERT INTO exams(category, question, c1, c2, c3, c4, answer) VALUES('$category','$question','$c1','$c2','$c3','$c4','$answer')");

if ($query) {
    echo "<script>
    alert('Question successfully added.')
    window.location.href = '../pages/create-exam.php';
    </script>";
}
