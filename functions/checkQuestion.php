<?php
session_start();
include "conn.php";

$action = $_POST["action"];


$question =  strtolower($_POST['ques']);
$formatedQuestion = implode("", preg_split("/\s+/", $question));

$query = null;

if ($action == "add") {
    $query = mysqli_query($conn, "SELECT * FROM exams");
} else if ($action == "edit") {
    $id = $_POST['id'];
    $query = mysqli_query($conn, "SELECT * FROM exams WHERE id != '$id'");
}


$checker = "";

while ($res = mysqli_fetch_object($query)) {
    $dbQuestion = strtolower($res->question);
    $dbFormatedQuestion = implode("", preg_split("/\s+/", $dbQuestion));
    if ($formatedQuestion == $dbFormatedQuestion) {
        if ($checker != "true") {
            $checker = "true";
        }
    }
}

echo json_encode(["success" => "true", "msg" => "$checker"]);
