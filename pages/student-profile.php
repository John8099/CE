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
            text-align: center;
            padding: 10px;
            margin: auto;
            margin-top: 80px;
        }

        .card img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 60%;
        }
    </style>
</head>

<body>
    <?php include "../components/student-nav.php"; ?>

    <?php
    $query = mysqli_query($conn, "SELECT * FROM students WHERE id = '$_SESSION[user_id]'");
    $row = mysqli_fetch_object($query);
    ?>
    <div class="container">
        <div class="jumbotron" style="padding: 5px !important;">
            <form id="formReg" action="../functions/editStudent.php?id=<?php echo $row->id ?>&&location=student" method="POST" style="margin: 10px;">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="">Last name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                                </div>
                                <input type="text" class="form-control" value="<?php echo $row->student_lname ?>" name="lname" placeholder="Last name" required>
                            </div>
                        </div>
                        <div class="col">
                            <label for="">First name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                                </div>
                                <input type="text" class="form-control" value="<?php echo $row->student_fname ?>" name="fname" placeholder="First name" required>
                            </div>
                        </div>
                        <div class="col">
                            <label for="">Middle name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                                </div>
                                <input type="text" class="form-control" value="<?php echo $row->student_mname ?>" name="mname" placeholder="Middle name" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="">Home Address</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-home"></i></div>
                                </div>
                                <input type="text" class="form-control" value="<?php echo $row->student_home_add ?>" name="homeAdd" placeholder="Home Address" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="gender">Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="<?php echo strtolower($row->gender) ?>"><?php echo strtoupper($row->gender) ?></option>
                                <?php
                                $gender = $row->gender;
                                $arrGenders = array("MALE", "FEMALE", "OTHERS");
                                foreach ($arrGenders as $arrGender) :
                                    if (strtolower($gender) != strtolower($arrGender)) :
                                ?>
                                        <option value="<?php echo strtolower($arrGender) ?>"><?php echo $arrGender ?></option>
                                <?php
                                    endif;
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="bDay">Birth Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <input type="date" id="datepicker" value="<?php echo $row->student_birthday ?>" class="form-control" name="bdate" required>
                            </div>
                        </div>
                        <div class="col">
                            <label for="">Religion</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-university"></i></div>
                                </div>
                                <input type="text" class="form-control" value="<?php echo $row->religion ?>" name="religion" placeholder="Religion" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="">Civil Status</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-heart"></i></div>
                                </div>
                                <input type="text" class="form-control" value="<?php echo $row->civil_status ?>" name="civilStat" placeholder="Civil Status" required>
                            </div>
                        </div>
                        <div class="col">
                            <label for="">Contact number</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">+63</div>
                                </div>
                                <input type="number" class="form-control" value="<?php echo $row->contact_number ?>" name="contactNumber" id="inputContactNumber" placeholder="Contact number" required>
                            </div>
                        </div>
                        <div class="col">
                            <label for="">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">@</div>
                                </div>
                                <input type="email" class="form-control" id="stud_email" value="<?php echo $row->email ?>" name="email" placeholder="Email" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="">Father's name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-male"></i></div>
                                </div>
                                <input type="text" class="form-control" value="<?php echo $row->father_name ?>" name="fatherName" placeholder="Father's name" required>
                            </div>
                        </div>
                        <div class="col">
                            <label for="">Father's Occupation</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-briefcase"></i></div>
                                </div>
                                <input type="text" class="form-control" value="<?php echo $row->father_occupation ?>" name="fatherOccupation" placeholder="Father's Occupation" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="">Mother's name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-female"></i></div>
                                </div>
                                <input type="text" class="form-control" value="<?php echo $row->mother_name ?>" name="motherName" placeholder="Mother's name" required>
                            </div>
                        </div>
                        <div class="col">
                            <label for="">Mother's Occupation</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-briefcase"></i></div>
                                </div>
                                <input type="text" class="form-control" value="<?php echo $row->mother_occupation ?>" name="motherOccupation" placeholder="Mother's Occupation" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="student-dashboard.php" id="closeReg" class="btn btn-primary">Go Back</a>
                    <button type="button" id="btnEdit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>

    </div>
    <script>
        $("#stud_email").on("click", () => {
            $("#stud_email").css("border", "1px solid #cfd4db");
            $("#btnEdit").prop("disabled", false);
        })
        $("#btnEdit").on("click", () => {
            let studEmail = $("#stud_email").val()
            if (studEmail !== "" && studEmail !== " ") {
                $.ajax({
                    url: "../functions/checkEmailAndUsername.php?user_email",
                    type: 'POST',
                    cache: false,
                    data: {
                        id: <?php echo $row->id ?>,
                        email: studEmail,
                    },
                    success: (data) => {
                        if (data === "true") {
                            $.notify(`Error! "${studEmail}" was already taken.`, {
                                type: "danger",
                                close: true,
                                deleay: 3000,
                            });
                            $("#stud_email").css("border", "2px solid red");
                            $("#btnEdit").prop("disabled", true);
                        } else {
                            $("#stud_email").css("border", "1px solid #cfd4db");
                            $("#btnEdit").prop("disabled", false);
                            $("#formReg").submit();
                        }
                    }
                })
            }
        })
    </script>
</body>


</html>