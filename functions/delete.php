<?php
session_start();

include 'conn.php';

if (isset($_GET['admin'])) {
    del_admin($conn);
    exit();
} else if (isset($_GET['student'])) {
    del_student($conn);
    exit();
} else {
    echo "<script>
        alert('Error deleting. Please contact admin.')
        window.location.href = '../pages/admin.php';
        </script>";
}

function del_admin($db)
{
    $id = $_GET['id'];
    $get_admin = mysqli_query($db, "SELECT * FROM `admin` WHERE id = '$id'");
    if ($get_admin) {
        $adminData = mysqli_fetch_object($get_admin);
        $query = mysqli_query($db, "DELETE FROM `admin` WHERE id = '$id'");
        if ($query) {
            $adminFormatedName = strtoupper($adminData->fname . " " . $adminData->lname);
            echo "<script>
            alert('Admin $adminFormatedName Deleted successfully.')
            window.location.href = '../pages/admin.php';
            </script>";
        } else {
            echo "<script>
        alert('Error deleting. Please contact admin.')
        window.location.href = '../pages/admin.php';
        </script>";
        }
    } else {
        echo "<script>
        alert('Error deleting. Please contact admin.')
        window.location.href = '../pages/admin.php';
        </script>";
    }
}

function del_student($db)
{
    $id = $_GET['id'];
    $get_student = mysqli_query($db, "SELECT * FROM students WHERE id = '$id'");
    if ($get_student) {
        $studentData = mysqli_fetch_object($get_student);
        $query = mysqli_query($db, "DELETE FROM students WHERE id = '$id'");
        if ($query) {
            $StundentFormatedName = strtoupper($studentData->student_fname . " " . $studentData->student_lname);
            echo "<script>
            alert('Student $StundentFormatedName Deleted successfully.')
            window.location.href = '../pages/student.php';
            </script>";
        } else {
            echo "<script>
        alert('Error deleting. Please contact admin.')
        window.location.href = '../pages/student.php';
        </script>";
        }
    } else {
        echo "<script>
        alert('Error deleting. Please contact admin.')
        window.location.href = '../pages/student.php';
        </script>";
    }
}
