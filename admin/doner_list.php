<?php
session_start();
include_once 'db/connection.php';

if (isset($_SESSION['username'])){

}else{
    if(isset($_COOKIE["auth"])){

    }else{
        $_SESSION['msg'] = "Oops... Login first";
        header("Location: ../login.php?status=error");
    }
}

if ($_SESSION['userrole'] != 1){
    $_SESSION['msg'] = "You don't have Access to this page";
    header("Location: admin.php?status=warning");
    exit(0);
}

if (isset($_POST['saveDoner_btn'])){
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
    $doner_status = $_POST['doner_status'];
    $doner_role = $_POST['doner_role'];

//    For Image Upload
    $target_dir = "assets/img/doners/";
    $imageFileName = basename($_FILES["doner_image"]["name"]);
    $imageFileTempName = $_FILES["doner_image"]["tmp_name"];

    $target_file = $target_dir . $imageFileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (empty($additional_info)){
        $add_info = "No Additional Data Added";
    }else{
        $add_info = $additional_info;
    }

    if ($password === $c_password){

        $sql1 = "INSERT INTO users (display_name, user_image, email, password, user_role) VALUES ('$display_name','$target_file','$email','$password', '$doner_role') ";

        if ($conn->query($sql1) === TRUE){
            $last_id = $conn->insert_id;
            move_uploaded_file($imageFileTempName,$target_file);

            $sql2 = "INSERT INTO users_info (u_id, fname, lname, contact_number, dob, age, gender, b_group_id, contact_address, additional_info, status) VALUES ('$last_id', '$fname', '$lname', '$contact_no', '$dob', $age, '$gender', '$blood_group', '$contact_address', '$add_info', $doner_status) ";

            if ($conn->query($sql2) === TRUE){
                //  $result = "";
                $_SESSION['msg'] = "Registration completed";
                header("Location: doner_list.php?status=success");
                exit(0);
            }else{
                $sql3 = "DELETE FROM users WHERE id=$last_id";
                $run_query = $conn->query($sql3);

                $_SESSION['msg'] = "User Info not inserted";
                header("Location: doner_list.php?status=error");
                exit(0);
            }
        }else{
            $_SESSION['msg'] = "Something went wrong";
            header("Location: doner_list.php?status=warning");
            exit(0);
        }
    }else{
        $_SESSION['msg'] = "Password doesn't match";
        header("Location: doner_list.php?status=info");
        exit(0);
    }
}

$select_user_sql = "SELECT u.id uid, u.email uemail, ui.fname f_name, ui.lname l_name, ui.contact_number contact_no, ui.gender ugender, ui.age uage, ui.status ustatus, bg.b_group_name ubgroup FROM users u, users_info ui, blood_group bg WHERE u.id = ui.u_id AND ui.b_group_id = bg.id";
$query_user_info = $conn->query($select_user_sql);


$select_blood_group = "SELECT * FROM blood_group";
$b_group_query = $conn->query($select_blood_group);

include_once 'includes/header.php';
?>
<?php
    include_once 'includes/top_nav.php';
    include_once 'includes/side_nav.php';
?>


    <h1 class="mt-4">Blood Doner List</h1>
    <ol class="breadcrumb mb-4">
        <!--        <li class="breadcrumb-item active">Dashboard</li>-->
    </ol>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-end">
            <!--            <i class="fa-solid fa-droplet"></i> Blood Group List-->
            <button class="btn btn-primary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newDonerAdd">Add Doner</button>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Blood Group</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($query_user_info->num_rows > 0):
                            $i=1;
                            while ($user_info = $query_user_info->fetch_assoc()):
                    ?>

                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $user_info['f_name']." ".$user_info['l_name'] ?></td>
                        <td><?= $user_info['uemail']; ?></td>
                        <td><?= $user_info['contact_no']; ?></td>
                        <td><?php
                            if ($user_info['ugender'] == 0):
                                echo "Male";
                            else:
                                echo "Female";
                            endif;
                        ?></td>
                        <td><?= $user_info['uage']; ?></td>
                        <td><?= $user_info['ubgroup']; ?></td>
                        <td><?php
                            if ($user_info['ustatus'] == 1):
                                echo "Active";
                            else:
                                echo "Inactive";
                            endif;
                            ?></td>
                        <td class="d-flex">
                            <a href="doner_details.php?id=<?php echo $user_info['uid']; ?>" class="btn btn-primary btn-sm me-1" title="View Info"><i class="fa-solid fa-eye"></i></a>
                            <a href="doner_info_edit.php?id=<?php echo $user_info['uid']; ?>" class="btn btn-info btn-sm me-1" title="Edit Info"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="doner_password_edit.php?id=<?php echo $user_info['uid']; ?>" class="btn btn-warning btn-sm me-1" title="Edit Password"><i class="fa-solid fa-key"></i></a>
                            <form action="blood_group_delete.php" method="post">
                                <button class="btn btn-danger btn-sm d_category" name="d_b_group" value="<?php echo $b_group['id']; ?>" title="Delete Info"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php
                            $i++;
                        endwhile;
                        else:
                    ?>
                    <tr>
                        <td colspan="10">No Data to Show</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>




<?php include_once 'includes/modals/addDoner_modal.php';?>
<?php include_once 'includes/footer.php'; ?>
