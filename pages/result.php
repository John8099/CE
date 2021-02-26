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
        #formContent {
            -webkit-border-radius: 10px 10px 10px 10px;
            border-radius: 10px 10px 10px 10px;
            background: #fff;
            padding: 0px;
            -webkit-box-shadow: 0 30px 60px 0 rgba(0, 0, 0, 0.3);
            box-shadow: 0 30px 60px 0 rgba(0, 0, 0, 0.3);
        }

        table td img {
            width: 30px;
        }

        th,
        td {
            padding: 10px;
        }

        #horizontalHeader,
        td {
            text-align: center;
        }

        #verticalHeader,
        td {
            border-bottom: 1px solid #878484;
        }
    </style>
</head>

<body>
    <?php include "../components/student-nav.php"; ?>
    <?php
    $query = mysqli_query($conn, "SELECT * FROM examresults WHERE student_id = $_SESSION[user_id] ORDER BY createAt DESC");
    if (mysqli_num_rows($query) != 0) :
    ?>
        <div class="container" style="padding:20px;height: 600px;overflow-y: scroll;background-color: transparent; max-width:80%;">
            <?php

            while ($row = mysqli_fetch_object($query)) :
                $id = $row->id;
                $totalScores = explode("/", $row->totalScores)[0];
                $engPoints = json_decode($row->json_result)->engPoints;
                $mathPoints = json_decode($row->json_result)->mathPoints;
                $sciencePoints = json_decode($row->json_result)->sciPoints;

                $json_results = array(
                    "English" => json_decode($row->json_result)->english,
                    "Math" => json_decode($row->json_result)->math,
                    "Science" => json_decode($row->json_result)->science
                );
            ?>
                <div class="container" id="formContent" style="margin:20px !important">
                    <div class="row">
                        <div class="col">
                            <h3 style="padding: 20px;"><?php echo date('M d, Y h:i A', strtotime($row->createAt)) ?> Exam Results</h3>
                        </div>
                        <div class="col">
                            <h5 style="float:right;padding: 20px;">Good At: <strong><?php echo strtoupper(implode(" ", explode("|", $row->goodAt))) ?></strong></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div id="chartScoresBar<?php echo $row->id ?>"></div>
                        </div>
                        <div class="col">
                            <div id="chartScoresPie<?php echo $row->id ?>"></div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col" style="margin-left:20px; margin-bottom: 20px">
                            <label style="font-weight: bold;">
                                Overall Total: <?php echo implode(" out of ", explode("/", $row->totalScores)) ?>
                            </label>
                            <table style="width: 100%;">
                                <tr id="horizontalHeader">
                                    <th></th>
                                    <th scope="row">#1</th>
                                    <th scope="row">#2</th>
                                    <th scope="row">#3</th>
                                    <th scope="row">#4</th>
                                    <th scope="row">#5</th>
                                    <th scope="row">#6</th>
                                    <th scope="row">#7</th>
                                    <th scope="row">#8</th>
                                    <th scope="row">#9</th>
                                    <th scope="row">#10</th>
                                    <th scope="row">Total</th>
                                </tr>
                                <?php
                                $counter2 = 1;
                                foreach ($json_results as $title => $json_datas) :
                                ?>
                                    <tr>
                                        <th scope="row" id="verticalHeader"><?php echo $title ?></th>
                                        <?php
                                        $counter = 1;
                                        foreach ($json_datas as $numbers => $value) :
                                            $number = preg_split("/(number=)/", $numbers)[1];
                                            if ($number == $counter) :
                                                if ($value == "wrong") :
                                        ?>
                                                    <td>
                                                        <img src="../img/remove.png" alt="wrong">
                                                    </td>
                                                <?php elseif ($value == "correct") : ?>
                                                    <td>
                                                        <img src="../img/check.png" alt="correct">
                                                    </td>
                                        <?php
                                                endif;
                                            endif;
                                            $counter++;
                                        endforeach;
                                        ?>
                                        <td>
                                            <?php
                                            if ($title == "English") {
                                                echo "<strong>" . $engPoints . "</strong>";
                                            } elseif ($title == "Math") {
                                                echo "<strong>" . $mathPoints . "</strong>";
                                            } elseif ($title == "Science") {
                                                echo "<strong>" . $sciencePoints . "</strong>";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            </table>
                        </div>
                        <div class="col">
                            <label style="font-weight: bold;">
                                Suggested Courses
                            </label>

                            <ul>
                                <?php
                                $goodAts = explode("|", $row->goodAt);
                                foreach ($goodAts as $goodAt) {
                                    if ($goodAt !== '') {
                                        $getCourse = mysqli_query($conn, "SELECT * FROM courses WHERE category = '$goodAt' LIMIT 2");
                                        while ($row2 = mysqli_fetch_object($getCourse)) {
                                            echo "<li>" . $row2->course . "</li>";
                                        }
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <script>
                    let totalScores<?php echo  $row->id ?> = <?php echo $totalScores ?>;
                    let engPoints<?php echo  $row->id ?> = <?php echo $engPoints ?>;
                    let mathPoints<?php echo  $row->id ?> = <?php echo $mathPoints ?>;
                    let sciencePoints<?php echo  $row->id ?> = <?php echo $sciencePoints ?>;

                    var optionsBar<?php echo  $row->id ?> = {
                        series: [{
                            name: "Score",
                            data: [totalScores<?php echo  $row->id ?>, engPoints<?php echo  $row->id ?>, mathPoints<?php echo  $row->id ?>, sciencePoints<?php echo  $row->id ?>]
                        }],
                        chart: {
                            type: 'bar',
                            height: 350
                        },
                        plotOptions: {
                            bar: {
                                horizontal: true,
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        xaxis: {
                            type: 'category',
                            categories: ['Overall Total', 'English', 'Math', 'Science'],
                        }
                    };
                    var optionsPie<?php echo  $row->id ?> = {
                        series: [engPoints<?php echo  $row->id ?>, mathPoints<?php echo  $row->id ?>, sciencePoints<?php echo  $row->id ?>],
                        chart: {
                            width: 380,
                            type: 'pie',
                        },
                        labels: ['English', 'Math', 'Science'],
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    width: 200
                                },
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }]
                    };

                    var chartScoresBar<?php echo  $row->id ?> = new ApexCharts(document.querySelector("#chartScoresBar<?php echo $row->id ?>"), optionsBar<?php echo  $row->id ?>);
                    var chartScoresPie<?php echo  $row->id ?> = new ApexCharts(document.querySelector("#chartScoresPie<?php echo  $row->id ?>"), optionsPie<?php echo  $row->id ?>);
                    chartScoresBar<?php echo  $row->id ?>.render();
                    chartScoresPie<?php echo  $row->id ?>.render();
                </script>
            <?php endwhile ?>


        </div>
    <?php else : ?>
        <div class="container" id="formContent" style="margin:auto !important; margin-top:20px !important; padding: 20px;">
            <p class="font-weight-bold text-center" style="font-size: 20px;">Currently no Results yet.</p>
        </div>
    <?php endif; ?>
    <div class="fixed-bottom" style="margin-bottom: 20px;">
        <div class="container">
            <a href="student-dashboard.php" class="btn btn-primary">Go Back</a>
        </div>
    </div>
</body>

</html>