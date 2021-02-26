<?php $query = mysqli_query($conn, "SELECT * FROM `admin` WHERE id = $_SESSION[admin_id]"); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom sticky-top">
    <button class="btn btn-default" id="menu-toggle"><i class="fa fa-bars"></i></button>

    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <?php

                $admin = mysqli_fetch_object($query);
                echo strtoupper($admin->lname) . ", " . strtoupper($admin->fname);
                ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="z-index: 999;">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#adminModal"><i class="fa fa-user"></i> Profile</a>
                <a class="dropdown-item" href="../functions/logout.php"><i class="fa fa-power-off"></i> Logout</a>
            </div>
        </li>
    </ul>
</nav>
<div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="formEdit" action="../functions/editAdmin.php?id=<?php echo $_SESSION['admin_id'] ?>" method="POST">
                <div class="modal-header" style="text-align: center; display:block;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: red;">&times;</span>
                    </button>
                    <h3 class="modal-title" style="text-align: center;">Edit Profile</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">First name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-users"></i></div>
                            </div>
                            <input type="text" class="form-control" name="fname" value="<?php echo $admin->fname ?>" placeholder="First name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Middle name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-users"></i></div>
                            </div>
                            <input type="text" class="form-control" name="mname" value="<?php echo $admin->mname ?>" placeholder="Middle name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Last name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-users"></i></div>
                            </div>
                            <input type="text" class="form-control" name="lname" value="<?php echo $admin->lname ?>" placeholder="Last name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                            </div>
                            <input type="text" class="form-control" id="adminEmail" name="email" value="<?php echo $admin->email ?>" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user"></i></div>
                            </div>
                            <input type="text" class="form-control" id="adminUname" name="uname" value="<?php echo $admin->uname ?>" placeholder="Username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-lock"></i></div>
                            </div>
                            <input type="password" class="form-control" name="pass" id="psw" placeholder="Password" required>
                            <img src="../img/show.png" id="show" style="position: absolute !important;top: 7px;right: 10px;width: 25px;cursor: pointer;z-index: 99;">
                            <img src="../img/hide.png" id="hide" style="position: absolute !important;top: 7px;right: 10px;width: 25px;cursor: pointer;z-index: 99;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="button" id="btnEdit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(() => {

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

        $("#adminUname").on("click", () => {
            $("#adminUname").css("border", "1px solid #cfd4db");
            $("#btnEdit").prop("disabled", false);
        })

        $("#adminEmail").on("click", () => {
            $("#adminEmail").css("border", "1px solid #cfd4db");
            $("#btnEdit").prop("disabled", false);
        })

        $("#btnEdit").on("click", () => {
            let adminUname = $("#adminUname").val()
            let adminEmail = $("#adminEmail").val()
            if (adminUname !== "" && adminUname !== " ") {
                $.ajax({
                    url: "../functions/checkEmailAndUsername.php?admin_uname",
                    type: 'POST',
                    cache: false,
                    data: {
                        uname: adminUname,
                        email: adminEmail
                    },
                    success: (data) => {
                        console.log(data)
                        let res = JSON.parse(data)
                        if (res.uname == "true" && res.email == "true") {
                            $.notify(`Error! Username "${adminUname}" and Email "${adminEmail}" was already taken.`, {
                                type: "danger",
                                close: true,
                                delay: 3000,
                            });
                            $("#adminUname").css("border", "2px solid red");
                            $("#adminEmail").css("border", "2px solid red");
                            $("#btnEdit").prop("disabled", true);
                        } else if (res.uname == "true" && res.email == "false") {
                            $.notify(`Error! Username "${adminUname}" was already taken.`, {
                                type: "danger",
                                close: true,
                                delay: 3000,
                            });
                            $("#adminUname").css("border", "2px solid red");
                            $("#btnEdit").prop("disabled", true);
                        } else if (res.uname == "false" && res.email == "true") {
                            $.notify(`Error! Email "${adminEmail}" was already taken.`, {
                                type: "danger",
                                close: true,
                                delay: 3000,
                            });
                            $("#adminEmail").css("border", "2px solid red");
                            $("#btnEdit").prop("disabled", true);
                        } else {
                            $("#adminUname").css("border", "1px solid #cfd4db");
                            $("#adminEmail").css("border", "1px solid #cfd4db");
                            $("#btnEdit").prop("disabled", false);
                            $("#formEdit").submit();
                        }
                    }
                })
            }
        })
    })
</script>