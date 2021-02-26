<?php
session_start();
include "conn.php";

$reqs = json_decode($_POST['formDatas']);

$engPoints = 0;
$mathPoints = 0;
$sciPoints = 0;

$engArr = array();
$mathArr = array();
$sciArr = array();
$success = "false";
$totalNumber = count((array)$reqs);
foreach ($reqs as $idsAndNumbers => $answer) {
    $getIdAndNumber = preg_split("/(id=)|(&&number=)/", $idsAndNumbers);
    $id = $getIdAndNumber[1];
    $number = $getIdAndNumber[2];
    $query = mysqli_query($conn, "SELECT * FROM exams WHERE id = '$id'");
    $res = mysqli_fetch_object($query);
    if ($res->category == "math") {
        if (strtolower($answer) == strtolower($res->answer)) {
            $mathArr["number=$number"] = "correct";
            $mathPoints++;
        } else {
            $mathArr["number=$number"] = "wrong";
        }
    } else if ($res->category == "english") {
        if (strtolower($answer) == strtolower($res->answer)) {
            $engArr["number=$number"] = "correct";
            $engPoints++;
        } else {
            $engArr["number=$number"] = "wrong";
        }
    } else if ($res->category == "science") {
        if (strtolower($answer) == strtolower($res->answer)) {
            $sciArr["number=$number"] = "correct";
            $sciPoints++;
        } else {
            $sciArr["number=$number"] = "wrong";
        }
    }
    // var_dump($getIdAndNumber);
}
$maxNumber = max($engPoints, $mathPoints, $sciPoints);
$subjectGoodAtArr = array();
for ($i = 0; $i < 3; $i++) {
    if ($engPoints == $maxNumber) {
        if (!in_array("english|", $subjectGoodAtArr)) {
            array_push($subjectGoodAtArr, "english|");
        }
    } elseif ($mathPoints == $maxNumber) {
        if (!in_array("math|", $subjectGoodAtArr)) {
            array_push($subjectGoodAtArr, "math|");
        }
    } else if ($sciPoints == $maxNumber) {
        if (!in_array("science|", $subjectGoodAtArr)) {
            array_push($subjectGoodAtArr, "science|");
        }
    }
}
$subjectGoodAt = implode("", $subjectGoodAtArr);
$breakDownScores = array(
    "english" => $engArr,
    "engPoints" => $engPoints,
    "math" => $mathArr,
    "mathPoints" => $mathPoints,
    "science" => $sciArr,
    "sciPoints" => $sciPoints,
);
$jsonBreakdownScores = json_encode($breakDownScores);
$totalScores = $engPoints + $mathPoints + $sciPoints;
$overall = $totalScores . "/" . $totalNumber;
// var_dump($breakDownScores);
// var_dump($reqs);
// echo "<script>console.log(JSON.parse('".json_encode($breakDownScores)."'))</script>";
$inserResults = mysqli_query($conn, "INSERT INTO examresults(json_result, totalScores, goodAt, student_id) VALUES('$jsonBreakdownScores', '$overall', '$subjectGoodAt', '$_SESSION[user_id]')");
if ($inserResults) {
    $success = "true";
}
$msg = json_encode([
    "success" => $success,
    "total" => $totalScores,
]);
echo $msg;
