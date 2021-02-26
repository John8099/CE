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
        .pass {
            position: relative !important;
        }

        #show1,
        #hide1,
        #show2,
        #hide2,
        #show3,
        #hide3 {
            position: absolute !important;
            top: 7px;
            right: 10px;
            width: 25px;
            cursor: pointer;
            z-index: 99;
        }
    </style>
</head>

<body>
    <?php include "../components/student-nav.php"; ?>
   
    <div class="container">
        <div class="jumbotron" style="margin-top: 20px !important; padding: 20px !important; overflow:hidden;">

            <form id="formChangePass" action="../functions/change-pass.php" method="POST">
                <input type="text" id="id" name="id" value="<?php echo $_SESSION['user_id'] ?>" readonly hidden>
                <div class="form-group">
                    <label for="">Old Password</label>
                    <div class="pass">
                        <input type="password" class="form-control" id="psw1" placeholder="Old Password" require>
                        <img src="../img/show.png" id="show1">
                        <img src="../img/hide.png" id="hide1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">New Password</label>
                    <div class="pass">
                        <input type="password" class="form-control" id="psw2" name="newPass" placeholder="New Password" require>
                        <img src="../img/show.png" id="show2">
                        <img src="../img/hide.png" id="hide2">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Confirm New Password</label>
                    <div class="pass">
                        <input type="password" class="form-control" id="psw3" placeholder="Confirm New Password" require>
                        <img src="../img/show.png" id="show3">
                        <img src="../img/hide.png" id="hide3">
                    </div>
                </div>
                <div style="margin-bottom: 20px; float:right;">
                    <div class="container">
                        <a href="student-dashboard.php" class="btn btn-danger">Cancel</a>
                        <button type="button" id="btnSubmit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

</body>
<script>
    window.onload = () => {
        $("#hide1").hide();
        $("#hide2").hide();
        $("#hide3").hide();
    }
    $("#show1").on("click", () => {
        $("#hide1").show()
        $("#show1").hide()
        $("#psw1").attr('type', 'text');
    })

    $("#hide1").on("click", () => {
        $("#hide1").hide();
        $("#show1").show();
        $("#psw1").attr('type', 'password');
    })

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

    $("#show3").on("click", () => {
        $("#hide3").show()
        $("#show3").hide()
        $("#psw3").attr('type', 'text');
    })

    $("#hide3").on("click", () => {
        $("#hide3").hide();
        $("#show3").show();
        $("#psw3").attr('type', 'password');
    })

    $("#psw1").on("click", () => {
        $("#psw1").css("border", "1px solid #cfd4db");
    });

    $("#psw2").on("click", () => {
        $("#psw2").css("border", "1px solid #cfd4db");
        $("#psw3").css("border", "1px solid #cfd4db");
    });

    $("#psw3").on("click", () => {
        $("#psw2").css("border", "1px solid #cfd4db");
        $("#psw3").css("border", "1px solid #cfd4db");
    });

    $("#btnSubmit").on("click", () => {
        let psw1 = $("#psw1")
        let psw2 = $("#psw2")
        let psw3 = $("#psw3")
        let id = $("#id");

        if (psw2.val() !== psw3.val() && (psw2.val() != "" || psw3.val() != "")) {
            $.notify(`New password not match.`, {
                type: "danger",
                close: true
            });
            psw2.css("border", "2px solid red");
            psw3.css("border", "2px solid red");
        } else if (psw1.val() != "" && (psw2.val() != "" || psw3.val() != "")) {
            $.ajax({
                url: "../functions/change-pass.php?checkCurrent",
                type: 'POST',
                cache: false,
                data: {
                    pass: psw1.val(),
                    id: id.val(),
                },
                success: (data) => {
                    console.log(data)
                    if (data == "false") {
                        $.notify(`Wrong Old password. Please try again.`, {
                            type: "danger",
                            close: true
                        });
                        psw1.css("border", "2px solid red");
                    } else {
                        $("#formChangePass").submit();
                    }
                }
            })
        } else {
            $.notify(`Please input your password.`, {
                type: "danger",
                close: true
            });
            psw1.css("border", "2px solid red");
            psw2.css("border", "2px solid red");
            psw3.css("border", "2px solid red");
        }
    })
</script>

</html>