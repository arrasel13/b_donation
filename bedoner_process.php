<?php

session_start();
include_once 'admin/db/connection.php';

if (isset($_POST['register_btn'])){
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
    $password = md5($_POST['password']);
    $c_password = md5($_POST['confirm_password']);
//    $doner_status = $_POST['doner_status'];
//    $img = $_FILES['doner_image'];
//    echo "<pre>";
//    print_r($img);
//    echo "</pre>";exit();

//    For Image Upload
    $target_dir = "assets/img/doners/";
    $imageFileName1 = basename($_FILES["doner_image"]["name"]);
    $imageExtension = strtolower(pathinfo($_FILES["doner_image"]["name"], PATHINFO_EXTENSION));
    $imageFileName = strtolower($fname).'.'.$imageExtension;
    $imageFileTempName = $_FILES["doner_image"]["tmp_name"];

    $target_file = $target_dir . $imageFileName;
//    $uploadOk = 1;
//    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (empty($additional_info)){
        $add_info = "No Additional Data Added";
    }else{
        $add_info = $additional_info;
    }

    if ($password === $c_password){

        $sql1 = "INSERT INTO users (display_name, user_image, email, password) VALUES ('$display_name','$target_file','$email','$password') ";

        if ($conn->query($sql1) === TRUE){
            $last_id = $conn->insert_id;
            move_uploaded_file($imageFileTempName,"admin/".$target_file);

            $sql2 = "INSERT INTO users_info (u_id, fname, lname, contact_number, dob, age, gender, b_group_id, contact_address, additional_info) VALUES ('$last_id', '$fname', '$lname', '$contact_no', '$dob', $age, '$gender', '$blood_group', '$contact_address', '$add_info') ";

            if ($conn->query($sql2) === TRUE){
                //  $result = "";
                $_SESSION['msg'] = "Registration completed";
                header("Location: login.php?status=success");
                exit(0);
            }else{
                $sql3 = "DELETE FROM users WHERE id=$last_id";
                $run_query = $conn->query($sql3);

                $_SESSION['msg'] = "Registration is not completed";
                header("Location: login.php?status=error");
                exit(0);
            }
        }else{
            $_SESSION['msg'] = "Something went wrong";
            header("Location: login.php?status=warning");
            exit(0);
        }
    }else{
        $_SESSION['msg'] = "Password doesn't match";
        header("Location: login.php?status=info");
        exit(0);
    }
}else{
    $_SESSION['msg'] = "No Data Submitted to Register";
    header("Location: login.php?status=info");
    exit(0);
}

?>