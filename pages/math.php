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
            <h5 class="" style="margin: 10px;">Math Questions</h5>
            <div class="container-fluid">
                <div class="container" style="overflow-y: scroll; height: 600px;">
                    <?php
                    $query = mysqli_query($conn, "SELECT * FROM exams WHERE category = 'math'");
                    while ($row = mysqli_fetch_object($query)) :
                    ?>
                        <div class="card" style="width: 20rem; height: 460px; float: left;margin:20px;">
                            <div class="bg-secondary" style="margin: 0;width: 100%;height: 30px;text-align: right;">
                                <a href="edit-exam.php?cat=Math&&id=<?php echo $row->id ?>" alt="edit" style="text-decoration: none;">
                                    <i class="fa fa-edit" style="font-size: 18px;margin: 5px"></i>
                                </a>
                                <a href="../functions/delete-exam.php?cat=math&&id=<?php echo $row->id ?>" alt="delete" class="text-danger" style="text-decoration: none;">
                                    <i class="fa fa-times" style="font-size: 18px;margin: 5px;"></i>
                                </a>
                            </div>
                            <div class="card-body">
                                <p class="card-title">
                                    <?php
                                    echo $row->question;
                                    ?>
                                </p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <span class="badge badge-dark badge-pill">-</span>
                                    <?php
                                    echo $row->c1;
                                    ?>
                                </li>
                                <li class="list-group-item">
                                    <span class="badge badge-dark badge-pill">-</span>
                                    <?php
                                    echo $row->c2;
                                    ?>
                                </li>
                                <li class="list-group-item">
                                    <span class="badge badge-dark badge-pill">-</span>
                                    <?php
                                    echo $row->c3;
                                    ?>
                                </li>
                                <li class="list-group-item">
                                    <span class="badge badge-dark badge-pill">-</span>
                                    <?php
                                    echo $row->c4;
                                    ?>
                                </li>
                                <li class="list-group-item bg-success">
                                    <p class="card-text">
                                        Answer: <strong><?php echo $row->answer; ?></strong>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    <?php
                    endwhile;
                    ?>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(() => {
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        })
    </script>

</body>

</html>