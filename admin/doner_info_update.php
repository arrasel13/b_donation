<?php
session_start();
include_once 'db/connection.php';

if (isset($_POST['update_info'])){
    $doner_id = $_POST['doner_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $display_name = $_POST['display_name'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $dob = date("d-m-Y", strtotime($_POST['dob']));
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $contact_address = $_POST['contact_address'];
    $additional_info = $_POST['additional_info'];
    $doner_status = $_POST['doner_status'];
    $doner_role = isset($_POST['doner_role'])?$_POST['doner_role']:$_SESSION['userrole'];
    $old_doner_image = $_POST['old_doner_image'];

//    echo "<pre>";
//    print_r($_POST);
//    print_r($_FILES);
//    echo "</pre>";exit();

    if (empty($additional_info)){
        $add_info = "No Additional Data Added";
    }else{
        $add_info = $additional_info;
    }

    if (!empty($_FILES['doner_image']['name'])){

        $target_dir = "assets/img/doners/";
        $imageFileName1 = basename($_FILES["doner_image"]["name"]);
        $imageExtension = strtolower(pathinfo($_FILES["doner_image"]["name"], PATHINFO_EXTENSION));
        $imageFileName = strtolower($fname).'.'.$imageExtension;
        $imageFileTempName = $_FILES["doner_image"]["tmp_name"];

        $target_file = $target_dir . $imageFileName;

//        echo $old_doner_image."<br>";
//        echo $imageFileName."<br>";
//        echo $target_file."<br>";
//        exit();

        $sql1 = "UPDATE users_info SET fname='$fname', lname='$lname', contact_number='$contact_no', dob='$dob', age=$age, gender=$gender, b_group_id='$blood_group', contact_address='$contact_address', additional_info='$add_info', status=$doner_status WHERE u_id=$doner_id ";
        $run1 = $conn->query($sql1);

        if ($run1){
            $sql2 = "UPDATE users SET display_name='$display_name', user_image='$target_file', email='$email' WHERE id='$doner_id', user_role=$doner_role";
            $run2 = $conn->query($sql2);
            if ($run2){
                unlink($old_doner_image);
                move_uploaded_file($imageFileTempName, $target_file);

                $_SESSION['msg'] = "Users Info updated";
                header("Location: doner_list.php?status=success");
                exit(0);
            }else{
                $_SESSION['msg'] = "Users not updated";
                header("Location: doner_list.php?status=error");
                exit(0);
            }
        }else{
            $_SESSION['msg'] = "User Info not updated";
            header("Location: doner_list.php?status=error");
            exit(0);
        }


    }else{
//        echo $old_doner_image."<br>";
//        exit();

        $sql1 = "UPDATE users_info SET fname='$fname', lname='$lname', contact_number='$contact_no', dob='$dob', age=$age, gender=$gender, b_group_id='$blood_group', contact_address='$contact_address', additional_info='$add_info', status=$doner_status WHERE u_id=$doner_id ";
        $run1 = $conn->query($sql1);

        if ($run1){

            $sql2 = "UPDATE users SET display_name='$display_name', email='$email' WHERE id='$doner_id'";
            $run2 = $conn->query($sql2);
            if ($run2){
                $_SESSION['msg'] = "Users Info updated";
                header("Location: doner_list.php?status=success");
                exit(0);
            }else{
                $_SESSION['msg'] = "Users not updated";
                header("Location: doner_list.php?status=error");
                exit(0);
            }

        }else{
            $_SESSION['msg'] = "User Info not updated";
            header("Location: doner_list.php?status=error");
            exit(0);
        }
    }
//
//    if ($_FILES['$doner_image']['size'] == 0 && $_FILES['$doner_image']['error'] == 0){
//        echo "Image not changed";
//        exit();
//    }else{
//        echo "Image changed";
//        exit();
//    }

}