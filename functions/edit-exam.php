<?php
session_start();
include "conn.php";

$id = $_POST['id'];

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

$query = mysqli_query($conn, "UPDATE exams set 
                                question = '$question',
                                c1 = '$c1',
                                c2 = '$c2',
                                c3 = '$c3',
                                c4 = '$c4',
                                answer = '$answer'
                                WHERE id = '$id'
");

if ($query) {
    echo "<script>
    alert('Question updated successfully.')
    window.location.href = '../pages/" . strtolower($category) . ".php';
    </script>";
}
