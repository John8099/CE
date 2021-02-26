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
            <div class="container-fluid"  style="height: 700px; overflow-y: scroll;">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered table-sm" id="admin_table">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">Full name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Username</th>
                                <th scope="col">CreateAt</th>
                                <th scope="col" style="width: 15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM `admin` WHERE id != $_SESSION[admin_id]");
                            while ($row = mysqli_fetch_object($query)) :
                            ?>
                                <tr>
                                    <td><?php echo strtoupper("$row->fname " . $row->mname[0] . ". $row->lname"); ?></td>
                                    <td><?php echo $row->email; ?></td>
                                    <td><?php echo $row->uname; ?></td>
                                    <td><?php echo date('d-M-y h:i A', strtotime($row->createAt)) ?></td>
                                    <td style="text-align: center;">
                                        <a href="#" data-toggle="modal" data-target="#adminModal<?php echo $row->id ?>" class="btn btn-default action" alt="edit">
                                            <i class="fa fa-edit" style="font-size: 25px;"></i>
                                        </a>
                                        <a href="../functions/delete.php?admin&&id=<?php echo $row->id ?>" class="btn btn-default action" alt="delete">
                                            <i class="fa fa-trash" style="font-size: 25px;color:red"></i>
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="adminModal<?php echo $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form id="formEdit<?php echo $row->id ?>" action="../functions/editAdmin.php?id=<?php echo $row->id ?>" method="POST">
                                                <div class="modal-header" style="text-align: center; display:block;">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true" style="color: red;">&times;</span>
                                                    </button>
                                                    <h3 class="modal-title" style="text-align: center;">Edit Admin</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>First name</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text"><i class="fa fa-users"></i></div>
                                                            </div>
                                                            <input type="text" class="form-control" name="fname" value="<?php echo $row->fname ?>" placeholder="First name" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Middle name</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text"><i class="fa fa-users"></i></div>
                                                            </div>
                                                            <input type="text" class="form-control" name="mname" value="<?php echo $row->mname ?>" placeholder="Middle name" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Last name</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text"><i class="fa fa-users"></i></div>
                                                            </div>
                                                            <input type="text" class="form-control" name="lname" value="<?php echo $row->lname ?>" placeholder="Last name" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">@</div>
                                                            </div>
                                                            <input type="text" class="form-control" id="adminEmail<?php echo $row->id ?>" name="email" value="<?php echo $row->email ?>" placeholder="Email" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text"><i class="fa fa-user"></i></div>
                                                            </div>
                                                            <input type="text" class="form-control" id="adminUname<?php echo $row->id ?>" name="uname" value="<?php echo $row->uname ?>" placeholder="Username" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                                            </div>
                                                            <input type="password" class="form-control" name="pass" id="psw<?php echo $row->id ?>" placeholder="Password" required>
                                                            <img src="../img/show.png" id="show<?php echo $row->id ?>" style="position: absolute !important;top: 7px;right: 10px;width: 25px;cursor: pointer;z-index: 99;">
                                                            <img src="../img/hide.png" id="hide<?php echo $row->id ?>" style="position: absolute !important;top: 7px;right: 10px;width: 25px;cursor: pointer;z-index: 99;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                    <button type="button" id="btnEdit<?php echo $row->id ?>" class="btn btn-success">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $("#show<?php echo $row->id ?>").on("click", () => {
                                        $("#hide<?php echo $row->id ?>").show()
                                        $("#show<?php echo $row->id ?>").hide()
                                        $("#psw<?php echo $row->id ?>").attr('type', 'text');
                                    })

                                    $("#hide<?php echo $row->id ?>").on("click", () => {
                                        $("#hide<?php echo $row->id ?>").hide();
                                        $("#show<?php echo $row->id ?>").show();
                                        $("#psw<?php echo $row->id ?>").attr('type', 'password');
                                    })

                                    $("#adminUname<?php echo $row->id ?>").on("click", () => {
                                        $("#adminUname<?php echo $row->id ?>").css("border", "1px solid #cfd4db");
                                        $("#btnEdit<?php echo $row->id ?>").prop("disabled", false);
                                    })

                                    $("#adminEmail<?php echo $row->id ?>").on("click", () => {
                                        $("#adminEmail<?php echo $row->id ?>").css("border", "1px solid #cfd4db");
                                        $("#btnEdit<?php echo $row->id ?>").prop("disabled", false);
                                    })

                                    $("#btnEdit<?php echo $row->id ?>").on("click", () => {
                                        let adminUname = $("#adminUname<?php echo $row->id ?>").val()
                                        let adminEmail = $("#adminEmail<?php echo $row->id ?>").val()
                                        if (adminUname !== "" && adminUname !== " ") {
                                            $.ajax({
                                                url: "../functions/checkEmailAndUsername.php?admin_uname",
                                                type: 'POST',
                                                cache: false,
                                                data: {
                                                    id: <?php echo $row->id ?>,
                                                    uname: adminUname,
                                                    email: adminEmail
                                                },
                                                success: (data) => {
                                                    let res = JSON.parse(data)
                                                    if (res.uname == "true" && res.email == "true") {
                                                        $.notify(`Error! Username "${adminUname}" and Email "${adminEmail}" was already taken.`, {
                                                            type: "danger",
                                                            close: true,
                                                            delay: 3000,
                                                        });
                                                        $("#adminUname<?php echo $row->id ?>").css("border", "2px solid red");
                                                        $("#adminEmail<?php echo $row->id ?>").css("border", "2px solid red");
                                                        $("#btnEdit<?php echo $row->id ?>").prop("disabled", true);
                                                    } else if (res.uname == "true" && res.email == "false") {
                                                        $.notify(`Error! Username "${adminUname}" was already taken.`, {
                                                            type: "danger",
                                                            close: true,
                                                            delay: 3000,
                                                        });
                                                        $("#adminUname<?php echo $row->id ?>").css("border", "2px solid red");
                                                        $("#btnEdit<?php echo $row->id ?>").prop("disabled", true);
                                                    } else if (res.uname == "false" && res.email == "true") {
                                                        $.notify(`Error! Email "${adminEmail}" was already taken.`, {
                                                            type: "danger",
                                                            close: true,
                                                            delay: 3000,
                                                        });
                                                        $("#adminEmail<?php echo $row->id ?>").css("border", "2px solid red");
                                                        $("#btnEdit<?php echo $row->id ?>").prop("disabled", true);
                                                    } else {
                                                        $("#adminUname<?php echo $row->id ?>").css("border", "1px solid #cfd4db");
                                                        $("#adminEmail<?php echo $row->id ?>").css("border", "1px solid #cfd4db");
                                                        $("#btnEdit<?php echo $row->id ?>").prop("disabled", false);
                                                        $("#formEdit<?php echo $row->id ?>").submit();
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
        })
    </script>

</body>

</html>