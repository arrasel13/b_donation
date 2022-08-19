<?php
session_start();
include_once 'db/connection.php';

if (isset($_POST['update_pass'])){
    $d_id = $_POST['d_id'];
    $n_pass = md5($_POST['password']);
    $nc_pass = md5($_POST['confirm_password']);

    if ($n_pass == $nc_pass){

        $sql = "UPDATE users SET password = '$n_pass' WHERE id=$d_id";
        $run = $conn->query($sql);
        if ($run){
            $_SESSION['msg'] = "Password Updated";
            header("Location: doner_list.php?status=success");
        }else{
            $_SESSION['msg'] = "Password didn't Update";
            header("Location: doner_list.php?status=error");
        }
    }else{
        $_SESSION['msg'] = "Password And Confirm password doesn't match";
        header("Location: doner_password_edit.php?status=warning");
    }
}