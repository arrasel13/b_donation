<?php
session_start();
include_once 'db/connection.php';

if (isset($_POST['update_history'])){

    $dh_id = $_POST['dh_id'];
    $uid = $_POST['uid'];
    // $donate_date = date("d-m-Y", strtotime($_POST['donate_date']));
    $donate_date = $_POST['donate_date'];
    $d_d_approve = isset($_POST['d_d_approve']) ? $_POST['d_d_approve'] : 2;

    // $c_date = date('Y-m-d');

    // $date1 = $donate_date;
    // $c_date1 = date('d-m-Y');
    // $diff = abs(strtotime($c_date1) - strtotime($date1));
    // $years = floor($diff / (365*60*60*24));
    // $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    // $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));


    $sql = "UPDATE b_d_history SET donate_date='$donate_date', d_d_approve=$d_d_approve WHERE id=$dh_id AND u_id=$uid ";
    $run = $conn->query($sql);

    if ($run){
        $_SESSION['msg'] = "Record Updated Successfully";
        header("Location: donation_history.php?status=success");
        exit(0);
    }else{
        $_SESSION['msg'] = "Record Didn't Update";
        header("Location: donation_history.php?status=error");
        exit(0);
    }
}