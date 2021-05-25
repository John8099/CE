<?php
include "conn.php";

session_start();

if (isset($_GET["admin"])) {
    admin($conn);
    exit();
} else if (isset($_GET["student"])) {
    student($conn);
    exit();
}

function admin($db)
{
    $uname = $_POST["uname"];
    $pass = $_POST["pass"];

    $query = mysqli_query($db, "SELECT * FROM `admin` WHERE uname = '$uname'");
    $admin_user = mysqli_fetch_object($query);

    if (mysqli_num_rows($query) > 0) {
        if (md5($pass) == $admin_user->password) {
            $_SESSION["admin_id"] = $admin_user->id;
            echo "<script>
            alert('Welcome Admin $admin_user->fname.')
            window.location.href = '../pages/admin-dashboard.php'
            </script>";
        } else {
            echo "<script>
                alert('Error! Password not match.')
                window.location.href = '../'
                sessionStorage.setItem('triggerModal', 'admin')
                </script>";
        }
    } else {
        echo "<script>
        alert('Error! Username not found.') 
        window.location.href = '../' 
        sessionStorage.setItem('triggerModal', 'admin')
        </script>";
    }
}

function student($db)
{
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    $query = mysqli_query($db, "SELECT * FROM students WHERE email = '$email'");
    $student_user = mysqli_fetch_object($query);

    if (mysqli_num_rows($query) > 0) {
        if (md5($pass) == $student_user->password) {
            $_SESSION["user_id"] = $student_user->id;
            echo "<script>
            alert('Welcome back $student_user->student_fname $student_user->student_lname!')
            window.location.href = '../pages/student-dashboard.php'
            </script>";
        } else {
            echo "<script>
                alert('Error! Password not match.')
                window.location.href = '../'
                sessionStorage.setItem('triggerModal', 'student')
                </script>";
        }
    } else {
        echo "<script>
        alert('Error! Email not found.') 
        window.location.href = '../' 
        sessionStorage.setItem('triggerModal', 'student')
        </script>";
    }
}
