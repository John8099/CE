<?php
session_start();
include "../functions/conn.php";
if (!$_SESSION['admin_id']) {
    header("location: ../");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="icon" href="../img/ui.png" type="image/icon type">

    <!-- BOOTSTRAP LINK -->
    <?php include '../components/bootstrap.php'; ?>
    <link rel="stylesheet" href="../dep/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
    
    <!-- notification -->
    <link rel="stylesheet" href="../dep/minJsCss/css/notify.css">
    <link rel="stylesheet" href="../dep/minJsCss/css/prettify.css">
    <script src="../dep/minJsCss/js/notify.js"></script>
    <script src="../dep/minJsCss/js/prettify.js"></script>

    <style>
        .apexcharts-menu-icon {
            display: none !important;
        }
    </style>
</head>

<body>
    <?php #include "../components/admin_nav.php" 
    ?>

    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <?php include '../components/admin_sideNav.php'; ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <?php include '../components/admin_nav.php'; ?>

            <div class="container">
                <div class="row" id="chart"></div>
                <div class="row" id="chart2"></div>
            </div>

        </div>

    </div>

    <script>
        $(document).ready(() => {
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });

            $.ajax({
                url: "../functions/dashboard-results.php",
                type: 'GET',
                cache: false,
                success: (data) => {
                    let res = JSON.parse(data)

                    generateChart(res);
                }
            })

            function generateChart(data) {

                let adminCount = data.adminCount
                let studentCount = data.studentCount

                let colors = ['#008FFB', '#00E396'];
                let options = {
                    series: [{
                        name: 'Student & Admin Count',
                        data: [studentCount, adminCount]
                    }],
                    colors: colors,
                    chart: {
                        height: 300,
                        type: 'bar',
                        selection: {
                            enabled: true
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '50%',
                            distributed: true,
                            endingShape: 'rounded'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2
                    },

                    grid: {
                        row: {
                            colors: ['#fff', '#f2f2f2']
                        }
                    },
                    xaxis: {
                        labels: {
                            rotate: -45
                        },
                        categories: ['Student', 'Admin'],
                    },
                    title: {
                        text: 'Student & Admin total Count'
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'light',
                            type: "horizontal",
                            shadeIntensity: 0.25,
                            gradientToColors: undefined,
                            inverseColors: true,
                            opacityFrom: 0.85,
                            opacityTo: 0.85,
                            stops: [50, 0, 100]
                        },
                    }
                };
                let chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();

                let engCount = data.engCount
                let mathCount = data.mathCount
                let sciCount = data.sciCount

                let colors2 = ['#546E7A', '#FF4560', '#775DD0'];
                let options2 = {
                    series: [{
                        name: 'Exam questions',
                        data: [engCount, mathCount, sciCount]
                    }],
                    colors: colors2,
                    chart: {
                        height: 300,
                        type: 'bar',
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '50%',
                            distributed: true,
                            endingShape: 'rounded'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2
                    },
                    grid: {
                        row: {
                            colors: ['#fff', '#f2f2f2']
                        }
                    },
                    xaxis: {
                        labels: {
                            rotate: -45
                        },
                        categories: ['English', 'Math', 'Science'],
                    },
                    title: {
                        text: 'Exam questions total count'
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'light',
                            type: "horizontal",
                            shadeIntensity: 0.25,
                            gradientToColors: undefined,
                            inverseColors: true,
                            opacityFrom: 0.85,
                            opacityTo: 0.85,
                            stops: [50, 0, 100]
                        },
                    }
                };

                let chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
                chart2.render();
            }
        })
    </script>

</body>

</html>