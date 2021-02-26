<?php
session_start();
include "../functions/conn.php";
if (!$_SESSION['user_id']) {
    header("location: ../");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Page</title>
    <link rel="icon" href="../img/ui.png" type="image/icon type">

    <!-- BOOTSTRAP LINK -->
    <?php include '../components/bootstrap.php'; ?>
    <link rel="stylesheet" href="../dep/font-awesome/css/font-awesome.min.css">

    <!-- notification -->
    <link rel="stylesheet" href="../dep/minJsCss/css/notify.css">
    <link rel="stylesheet" href="../dep/minJsCss/css/prettify.css">
    <script src="../dep/minJsCss/js/notify.js"></script>
    <script src="../dep/minJsCss/js/prettify.js"></script>
    <style>
        .card {
            padding: 5px;
            overflow: hidden;
            margin: auto;
            margin-top: 80px;
        }

        .card img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 60%;
        }

        .card-body {
            width: 100%;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include "../components/student-nav.php"; ?>

    <div class="container">
        <div class="row">
            <div class="card" style="width: 12rem;">
                <img src="../img/exam.png" alt="">
                <div class="card-body">
                    <a href="exam.php" class="btn btn-primary">Take Exam</a>
                </div>
            </div>
            <div class="card" style="width: 12rem;">
                <img src="../img/clipboard-profile.png" alt="">
                <div class="card-body">
                    <a href="student-profile.php" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
            <div class="card" style="width: 12rem;">
                <img src="../img/privacy.png" alt="">
                <div class="card-body">
                    <a href="change-password.php" class="btn btn-primary">Change Password</a>
                </div>
            </div>
            <div class="card" style="width: 12rem;">
                <img src="../img/analysis.png" alt="">
                <div class="card-body">
                    <a href="result.php" class="btn btn-primary">View Results</a>
                </div>
            </div>
            <div class="card" style="width: 12rem;">
                <img src="../img/arrow.png" alt="">
                <div class="card-body">
                    <a href="../functions/logout.php" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>