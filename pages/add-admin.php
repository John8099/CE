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
                    <form id="formAddAdmin" action="../functions/add-admin.php" method="POST">
                        <div class="form-group row">
                            <label for="inputFname" class="col-sm-2 col-form-label">First name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputFname" placeholder="First name" name="fname" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputMname" class="col-sm-2 col-form-label">Middle name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputMname" placeholder="Middle name" name="mname" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputLname" class="col-sm-2 col-form-label">Last name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputLname" placeholder="Last name" name="lname" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" placeholder="Username" name="uname" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="psw" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="pass" id="psw" placeholder="Password" name="pass" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="showPass">
                                    Show Password
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <button type="button" id="btnAddAdmin" class="btn btn-success" style="float: right;">Add Admin</button>
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

            $('input[type="checkbox"]').click(function() {
                if ($(this).prop("checked") == true) {
                    $('input[id="psw"]').attr("type", "text");
                } else if ($(this).prop("checked") == false) {
                    $('input[id="psw"]').attr("type", "password");
                }
            })

            $("#username").on("click", () => {
                $("#username").css("border", "1px solid #cfd4db");
                $("#btnAddAdmin").prop("disabled", false);
            })

            $("#email").on("click", () => {
                $("#email").css("border", "1px solid #cfd4db");
                $("#btnAddAdmin").prop("disabled", false);
            })

            $("#btnAddAdmin").click(function() {
                let username = $("#username").val()
                let email = $("#email").val();
                if (username !== "" && username !== " " || email !== "" && email !== " ") {
                    $.ajax({
                        url: "../functions/checkEmailAndUsername.php?admin_uname&&addAdmin",
                        type: 'POST',
                        cache: false,
                        data: {
                            uname: username,
                            email: email
                        },
                        success: (data) => {
                            console.log(data)
                            let res = JSON.parse(data);

                            if (res.uname == "true" && res.email == "true") {
                                $.notify(`Error! Username "${username}" and Email "${email}" was already taken.`, {
                                    type: "danger",
                                    close: true,
                                    delay: 3000,
                                });
                                $("#username").css("border", "2px solid red");
                                $("#email").css("border", "2px solid red");
                                $("#btnAddAdmin").prop("disabled", true);
                            } else if (res.uname == "true" && res.email == "false") {
                                $.notify(`Error! Username "${username}" was already taken.`, {
                                    type: "danger",
                                    close: true,
                                    delay: 3000,
                                });
                                $("#username").css("border", "2px solid red");
                                $("#btnAddAdmin").prop("disabled", true);
                            } else if (res.uname == "false" && res.email == "true") {
                                $.notify(`Error! Email "${email}" was already taken.`, {
                                    type: "danger",
                                    close: true,
                                    delay: 3000,
                                });
                                $("#email").css("border", "2px solid red");
                                $("#btnAddAdmin").prop("disabled", true);
                            } else {
                                $("#username").css("border", "1px solid #cfd4db");
                                $("#email").css("border", "1px solid #cfd4db");
                                $("#btnAddAdmin").prop("disabled", false);
                                $("#formAddAdmin").submit();
                            }
                        }
                    })
                }
            })
        })
    </script>

</body>

</html>