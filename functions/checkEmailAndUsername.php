<?php
session_start();
include "conn.php";

if (isset($_GET['admin_uname'])) {
    admin_uname($conn);
    exit();
} else if (isset($_GET['user_email'])) {
    user_email($conn);
    exit();
}

function admin_uname($db)
{
    $id = empty($_POST['id']);
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $query = null;
    if (isset($_GET['addAdmin'])) {
        $query = mysqli_query($db, "SELECT * FROM `admin`");
    } else {
        $query = mysqli_query($db, "SELECT * FROM `admin` WHERE id != '$_SESSION[admin_id]'");
    }

    $arrs = array(
        "uname" => "",
        "email" => "",
    );

    while ($row = mysqli_fetch_object($query)) {
        if (!$id) {
            if ($row->id != $_POST['id']) {
                if ($row->email == $email) {
                    $arrs["email"] = "true";
                }
                if ($row->uname == $uname) {
                    $arrs["uname"] = "true";
                }
            }
        } else {
            if ($row->email == $email) {
                $arrs["email"] = "true";
            }
            if ($row->uname == $uname) {
                $arrs["uname"] = "true";
            }
        }
    }
    foreach ($arrs as $arr => $val) {
        if (empty($val)) {
            $arrs[$arr] = "false";
        }
    }

    print_r(json_encode($arrs));
}

function user_email($db)
{
    $query = mysqli_query($db, "SELECT * FROM students WHERE email = '$_POST[email]'");

    if (mysqli_num_rows($query) > 0) {
        echo "true";
    } else {
        echo "false";
    }
}
