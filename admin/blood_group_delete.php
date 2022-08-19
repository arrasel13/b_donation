<?php
session_start();
include_once 'db/connection.php';

if (isset($_POST['d_b_group'])){
    $d_id = $_POST['d_b_group'];

    $get_sql = "UPDATE blood_group SET status = 0 WHERE id = $d_id";
    if ($conn->query($get_sql)){
        $_SESSION['msg'] = "Blood Group Deleted Successfully";
        header("Location: ./blood_group.php?status=success");
    }else{
        $_SESSION['msg'] = "Blood Group Didn't Delete";
        header("Location: ./blood_group.php?status=error");
    }
}else{
    $_SESSION['msg'] = "You are trying a Wrong Way";
    header("Location: blood_group.php?status=error");
}
