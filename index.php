<?php include "functions/conn.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAREER ASSESSMENT EXAMINATION</title>
    <link rel="stylesheet" href="css/indexStyle.css">
    <link rel="icon" href="img/ui.png" type="image/icon type">
    <!-- BOOTSTRAP LINK -->
    <?php include 'components/bootstrap.php'; ?>
    <link rel="stylesheet" href="dep/font-awesome/css/font-awesome.min.css">

    <!-- notification -->
    <link rel="stylesheet" href="dep/minJsCss/css/notify.css">
    <link rel="stylesheet" href="dep/minJsCss/css/prettify.css">
    <script src="dep/minJsCss/js/notify.js"></script>
    <script src="dep/minJsCss/js/prettify.js"></script>
</head>

<body class="notify-open-drop">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img src="img/ui.png" class="navbar-brand" id="logo" width="70" height="80">
        <h1>
            <label for="navBrand" id="title" class="navbar-brand">CAREER EXAMINATION</label>
        </h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">

            <ul class="navbar-nav mr-auto my-2 my-lg-0 ">
                <li class="nav-item active"></li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <button type="button" id="buttonAdmin" data-toggle="modal" data-target="#adminModal" class="btn btn-light"> A D M I N </button>
            </div>
        </div>
    </nav>

    <div class="container d-flex h-75">
        <div class="row justify-content-center align-self-center" style="margin: auto;">
            <div class="mx-auto" style="width: 200px;">
                <button type="button" id="buttonReg" data-toggle="modal" data-target="#regModal" style="padding: 20px !important;" class="btn btn-warning btn-lg"> T A K E &ThickSpace; E X A M </button>
            </div>
        </div>
    </div>

    <!-- modal registration -->
    <div class="modal fade" id="regModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formReg" action="functions/registration.php" method="POST">
                    <div class="modal-header" style="text-align: center; display:block;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: red;">&times;</span>
                        </button>
                        <h3 class="modal-title" style="text-align: center;">R E G I S T R A T I O N</h3>
                    </div>
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
                        <div class="" style="margin-right:auto;">
                            Already registered?
                            <button type="button" id="buttonLog" data-toggle="modal" class="btn btn-link" style="margin-bottom: 6px;">Login here.</button>
                        </div>
                        <button type="button" id="closeReg" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" id="btnReg" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal user login -->
    <div class="modal fade" id="userLogin" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="formUserLogin" action="functions/login.php?student" method="POST">
                    <div class="modal-header" style="text-align: center; display:block;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: red;">&times;</span>
                        </button>
                        <h3 class="modal-title" style="text-align: center;">Student Login</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">@</div>
                                </div>
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                </div>
                                <input type="password" class="form-control" name="pass" id="psw2" placeholder="Password" required>
                                <img src="img/show.png" id="show2">
                                <img src="img/hide.png" id="hide2">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal admin -->
    <div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="formAdmin" action="functions/login.php?admin" method="POST">
                    <div class="modal-header" style="text-align: center; display:block;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: red;">&times;</span>
                        </button>
                        <h3 class="modal-title" style="text-align: center;">Admin Login</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                                </div>
                                <input type="text" class="form-control" name="uname" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                </div>
                                <input type="password" class="form-control" name="pass" id="psw" placeholder="Password" required>
                                <img src="img/show.png" id="show">
                                <img src="img/hide.png" id="hide">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>


<script>
    $(document).ready(() => {
        $('#adminModal').on('hidden.bs.modal', function() {
            $("#formAdmin").trigger("reset");
        })

        $('#regModal').on('hidden.bs.modal', function() {
            $("#formReg").trigger("reset");
        })

        $('#userLogin').on('hidden.bs.modal', function() {
            $("#formUserLogin").trigger("reset");
        })
        if (sessionStorage.length > 0) {
            let triggerOption = sessionStorage.getItem("triggerModal");
            if (triggerOption == "student") {
                $("#userLogin").modal('show')
                sessionStorage.clear()
            } else if (triggerOption == "admin") {
                $("#adminModal").modal('show')
                sessionStorage.clear()
            }
        }
        window.onload = () => {
            $("#hide").hide();
            $("#hide2").hide();
            $("#formAdmin").trigger("reset");
            $("#formReg").trigger("reset");
            $("#formUserLogin").trigger("reset");
        }
        $("#show2").on("click", () => {
            $("#hide2").show()
            $("#show2").hide()
            $("#psw2").attr('type', 'text');

        })

        $("#hide2").on("click", () => {
            $("#hide2").hide();
            $("#show2").show();
            $("#psw2").attr('type', 'password');
        })

        $("#show").on("click", () => {
            $("#hide").show()
            $("#show").hide()
            $("#psw").attr('type', 'text');

        })

        $("#hide").on("click", () => {
            $("#hide").hide();
            $("#show").show();
            $("#psw").attr('type', 'password');
        })

        $("#buttonLog").on("click", () => {
            $("#closeReg").click();
            $("#userLogin").modal('show')
        })

        $("#stud_email").on("click", () => {
            $("#stud_email").css("border", "1px solid #cfd4db");
            $("#btnReg").prop("disabled", false);
        })

        $("#stud_email").on("blur", () => {
            let studEmail = $("#stud_email").val()
            if (studEmail !== "" && studEmail !== " ") {
                $.ajax({
                    url: "functions/checkEmailAndUsername.php?user_email",
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

    });
</script>

</html>