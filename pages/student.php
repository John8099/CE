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
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <?php include '../components/admin_sideNav.php'; ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <?php include '../components/admin_nav.php'; ?>
            <div class="container-fluid" style="height: 700px; overflow-y: scroll;">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered table-sm" id="admin_table">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">Full name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Email</th>
                                <th scope="col">Father</th>
                                <th scope="col">Mother</th>
                                <th scope="col">CreateAt</th>
                                <th scope="col" style="width: 18%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM students");
                            while ($row = mysqli_fetch_object($query)) :
                            ?>
                                <tr>
                                    <td><?php echo strtoupper("$row->student_fname " . $row->student_mname[0] . ". $row->student_lname"); ?></td>
                                    <td><?php echo $row->student_home_add; ?></td>
                                    <td><?php echo strtoupper($row->gender); ?></td>
                                    <td><?php echo $row->contact_number; ?></td>
                                    <td><?php echo $row->email; ?></td>
                                    <td><?php echo $row->father_name; ?></td>
                                    <td><?php echo $row->mother_name; ?></td>
                                    <td><?php echo date('d-M-y H:i', strtotime($row->createAt)) ?></td>
                                    <td style="text-align: center;">
                                        <a href="#" data-toggle="modal" data-target="#studentModal<?php echo $row->id ?>" class="btn btn-default action" alt="edit">
                                            <i class="fa fa-edit" style="font-size: 25px;"></i>
                                        </a>
                                        <a href="admin-view-results.php?id=<?php echo $row->id ?>" class="btn btn-default action" alt="view results">
                                            <i class="fa fa-bar-chart" style="font-size: 25px;"></i>
                                        </a>
                                        <a href="../functions/delete.php?student&&id=<?php echo $row->id ?>" class="btn btn-default action" alt="delete">
                                            <i class="fa fa-trash" style="font-size: 25px;color:red"></i>
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="studentModal<?php echo $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form id="formReg<?php echo $row->id ?>" action="../functions/editStudent.php?id=<?php echo $row->id ?>" method="POST">
                                                <div class="modal-header" style="text-align: center; display:block;">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true" style="color: red;">&times;</span>
                                                    </button>
                                                    <h3 class="modal-title" style="text-align: center;">Edit Student</h3>
                                                </div>
                                                <div class="modal-body">
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
                                                                    <input type="email" class="form-control" id="stud_email<?php echo $row->id ?>" value="<?php echo $row->email ?>" name="email" placeholder="Email" required>
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
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="closeReg" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                    <button type="button" id="btnEdit<?php echo $row->id ?>" class="btn btn-success">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $("#stud_email<?php echo $row->id ?>").on("click", () => {
                                        $("#stud_email<?php echo $row->id ?>").css("border", "1px solid #cfd4db");
                                        $("#btnEdit<?php echo $row->id ?>").prop("disabled", false);
                                    })
                                    $("#btnEdit<?php echo $row->id ?>").on("click", () => {
                                        let studEmail<?php echo $row->id ?> = $("#stud_email<?php echo $row->id ?>").val()
                                        if (studEmail<?php echo $row->id ?> !== "" && studEmail<?php echo $row->id ?> !== " ") {
                                            $.ajax({
                                                url: "../functions/checkEmailAndUsername.php?user_email",
                                                type: 'POST',
                                                cache: false,
                                                data: {
                                                    id: <?php echo $row->id ?>,
                                                    email: studEmail<?php echo $row->id ?>,
                                                },
                                                success: (data) => {
                                                    if (data === "true") {
                                                        $.notify(`Error! "${studEmail<?php echo $row->id ?>}" was already taken.`, {
                                                            type: "danger",
                                                            close: true,
                                                            delay: 3000,
                                                        });
                                                        $("#stud_email<?php echo $row->id ?>").css("border", "2px solid red");
                                                        $("#btnEdit<?php echo $row->id ?>").prop("disabled", true);
                                                    } else {
                                                        $("#stud_email<?php echo $row->id ?>").css("border", "1px solid #cfd4db");
                                                        $("#btnEdit<?php echo $row->id ?>").prop("disabled", false);
                                                        $("#formReg<?php echo $row->id ?>").submit();
                                                    }
                                                }
                                            })
                                        }
                                    })
                                </script>
                            <?php
                            endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Page Content -->
    </div>

    <script>
        $(document).ready(() => {
            $('#admin_table').DataTable();

            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });

            $("#btnReg").on("click", () => {
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
                                $("#btnReg").click();
                            } else {
                                $("#stud_email").css("border", "1px solid #cfd4db");
                                $("#btnReg").prop("disabled", false);
                            }
                        }
                    })
                }
            })
        })
    </script>

</body>

</html>