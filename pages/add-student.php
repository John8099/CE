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
                <div id="space"></div>
                <div class="jumbotron">
                    <form id="formReg" action="../functions/registration.php?admin" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-user"></i></div>
                                            </div>
                                            <input type="text" class="form-control" name="lname" placeholder="Last name" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-user"></i></div>
                                            </div>
                                            <input type="text" class="form-control" name="fname" placeholder="First name" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-user"></i></div>
                                            </div>
                                            <input type="text" class="form-control" name="mname" placeholder="Middle name" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-home"></i></div>
                                            </div>
                                            <input type="text" class="form-control" name="homeAdd" placeholder="Home Address" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="gender">Gender</label>
                                        <select name="gender" class="form-control" required>
                                            <option value="">- Select Gender -</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="bDay">Birth Date</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                            <input type="date" id="datepicker" class="form-control" name="bdate" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="" style="color: transparent;">text</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-university"></i></div>
                                            </div>
                                            <input type="text" class="form-control" name="religion" placeholder="Religion" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-heart"></i></div>
                                            </div>
                                            <input type="text" class="form-control" name="civilStat" placeholder="Civil Status" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">+63</div>
                                            </div>
                                            <input type="number" class="form-control" name="contactNumber" id="inputContactNumber" placeholder="Contact number" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">@</div>
                                            </div>
                                            <input type="email" class="form-control" id="stud_email" name="email" placeholder="Email" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-male"></i></div>
                                            </div>
                                            <input type="text" class="form-control" name="fatherName" placeholder="Father's name" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-briefcase"></i></div>
                                            </div>
                                            <input type="text" class="form-control" name="fatherOccupation" placeholder="Father's Occupation" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-female"></i></div>
                                            </div>
                                            <input type="text" class="form-control" name="motherName" placeholder="Mother's name" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-briefcase"></i></div>
                                            </div>
                                            <input type="text" class="form-control" name="motherOccupation" placeholder="Mother's Occupation" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnReg" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
    <script>
        $("#stud_email").on("click", () => {
            $("#stud_email").css("border", "1px solid #cfd4db");
            $("#btnReg").prop("disabled", false);
        })

        $("#stud_email").on("blur", () => {
            let studEmail = $("#stud_email").val()
            if (studEmail !== "" && studEmail !== " ") {
                $.ajax({
                    url: "../functions/checkEmailAndUsername.php?user_email",
                    type: 'POST',
                    cache: false,
                    data: {
                        email: studEmail,
                    },
                    success: (data) => {
                        if (data === "true") {
                            $.notify(`Error! ${studEmail} was already taken.`, {
                                type: "danger",
                                close: true
                            });
                            $("#stud_email").css("border", "2px solid red");
                            $("#btnReg").prop("disabled", true);
                        } else {
                            $("#stud_email").css("border", "1px solid #cfd4db");
                            $("#btnReg").prop("disabled", false);
                        }
                    }
                })
            }
        })
    </script>
</body>

</html>