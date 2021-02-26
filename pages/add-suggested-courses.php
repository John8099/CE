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
            <div id="space"></div>
            <div class="container">
                <div class="jumbotron">
                    <form id="formAddAdmin" action="../functions/add-course.php" method="POST">
                        <div class="form-group row">
                            <label for="inputFname" class="col-sm-2 col-form-label">Course</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Input Course" name="course" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select name="cat" class="form-control" required>
                                    <option value="">- Select Category -</option>
                                    <option value="English">English</option>
                                    <option value="Science">Science</option>
                                    <option value="Math">Math</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <button type="submit" id="btnAddAdmin" class="btn btn-success" style="float: right;">Add Course</button>
                            </div>
                        </div>
                    </form>
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