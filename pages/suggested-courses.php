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
                                <th scope="col">Courses</th>
                                <th scope="col">Categoty</th>
                                <th scope="col" style="width: 15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM `courses`");
                            while ($row = mysqli_fetch_object($query)) :
                            ?>
                                <tr>
                                    <td><?php echo $row->course; ?></td>
                                    <td><?php echo $row->category; ?></td>
                                    <td style="text-align: center;">
                                        <a href="#" data-toggle="modal" data-target="#adminModal<?php echo $row->id ?>" class="btn btn-default action" alt="edit">
                                            <i class="fa fa-edit" style="font-size: 25px;"></i>
                                        </a>
                                        <a href="../functions/delete-course.php?id=<?php echo $row->id ?>" class="btn btn-default action" alt="delete">
                                            <i class="fa fa-trash" style="font-size: 25px;color:red"></i>
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="adminModal<?php echo $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form id="formEdit<?php echo $row->id ?>" action="../functions/edit-course.php?id=<?php echo $row->id ?>" method="POST">
                                                <div class="modal-header" style="text-align: center; display:block;">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true" style="color: red;">&times;</span>
                                                    </button>
                                                    <h3 class="modal-title" style="text-align: center;">Edit Course</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Course</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text"><i class="fa fa-institution"></i></div>
                                                            </div>
                                                            <input type="text" class="form-control" name="course" value="<?php echo $row->course ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Category</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text"><i class="fa fa-book"></i></div>
                                                            </div>
                                                            <select name="cat" class="form-control" required>
                                                                <option value="<?php echo $row->category ?>"><?php echo $row->category ?></option>
                                                                <?php
                                                                $cats = array("English", "Science", "Math");
                                                                foreach ($cats as $cat) :
                                                                    if ($cat != $row->category) :
                                                                ?>
                                                                        <option value="<?php echo $cat ?>"><?php echo $cat ?></option>
                                                                <?php endif;
                                                                endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" id="btnEdit<?php echo $row->id ?>" class="btn btn-success">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <script>

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