<?php
session_start();
include_once 'db/connection.php';

if (isset($_POST['saveRecord_btn'])){
    $uid = $_POST['uid'];
    $bg_id = $_POST['bg_id'];
    $u_name = $_POST['display_name'];
    $donate_date = $_POST['donate_date'];

//    $donate_date = date("d-m-Y", strtotime($_POST['donate_date']));

//    $date1 = $donate_date;
//    $c_date1 = date('d-m-Y');
    $c_date = date('Y-m-d');
//    echo $donate_date."<br>";
//    echo $c_date."<br>";
//    exit();

//    $diff = abs(strtotime($c_date1) - strtotime($date1));
//    $years = floor($diff / (365*60*60*24));
//    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
//    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
//    SELECT u_id, u_name, MAX($donate_date), FROM b_d_history GROUP BY u_id

//    $sql = "INSERT INTO b_d_history(u_id, u_name, donate_date, t_year, t_months, t_days) VALUES($uid, '$u_name', '$donate_date', $years, $months, $days) ";
    $sql = "INSERT INTO b_d_history(u_id, bg_id, u_name, donate_date,d_date) VALUES($uid, $bg_id, '$u_name', '$donate_date','$c_date') ";

    if ($conn->query($sql)){
        $_SESSION['msg'] = "Record Save Successfully";
        header("Location: donation_history.php?status=success");
    }else{
        $_SESSION['msg'] = "Record No Save";
        header("Location: donation_history.php?status=error");
    }

}