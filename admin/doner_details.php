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


if (isset($_GET['id'])){
    $doner_id = $_GET['id'];
    $sql = "SELECT u.id uid, u.display_name udisplayname, u.user_role urole, u.user_image uimage, u.email uemail, ui.fname f_name, ui.lname l_name, ui.dob udob, ui.age uage, ui.contact_number contact_no, ui.gender ugender, ui.b_group_id ubgroupid, ui.contact_address ucontact, ui.additional_info uaddinfo, ui.created_at ucreated, ui.status ustatus, bg.b_group_name ubgroup FROM users u, users_info ui, blood_group bg WHERE u.id = $doner_id AND u.id = ui.u_id AND ui.b_group_id = bg.id";
    $doner_query = $conn->query($sql);
    if ($doner_query->num_rows > 0){
        $doner_info = $doner_query->fetch_assoc();
//        echo '<pre>';
//        print_r($doner_info);
//        echo '</pre>';
//        exit();
    }else{
        $_SESSION['msg'] = "This user is not available";
        header("Location: doner_list.php?status=info");
    }

}else{
    $_SESSION['msg'] = "You are trying a Wrong Way";
    header("Location: doner_list.php?status=warning");
}

include_once 'includes/header.php';
?>
<?php
include_once 'includes/top_nav.php';
include_once 'includes/side_nav.php';
?>


<h1 class="mt-4">Details</h1>
<ol class="breadcrumb mb-4">
    <!--        <li class="breadcrumb-item active">Dashboard</li>-->
</ol>
<div class="card mb-4">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td colspan="4" style="">
                    <?php if ($_SESSION['userrole'] == 1): ?>
                    <a href="doner_list.php" class="btn btn-primary" style="float: left;"><i class="fa-solid fa-hand-point-left"></i> Back to Doner List</a>
                    <?php else: ?>
                    <a href="doner_password_edit.php?id=<?= $doner_info['uid'] ?>" class="btn btn-primary" style="float: left;"><i class="fa-solid fa-key"></i> Edit Password</a>
                    <?php endif; ?>
                    <a href="doner_info_edit.php?id=<?= $doner_info['uid'] ?>" class="btn btn-primary" style="float: right;"><i class="fa-solid fa-pen-to-square"></i> Edit Info</a>
                </td>
            </tr>
            <tr>
                <td>First Name: </td>
                <td colspan="2"><?= $doner_info['f_name']; ?></td>
                <td rowspan="2" style="text-align: center;"><img src="<?= $doner_info['uimage']; ?>" alt="doner image" style="width: 120px;"></td>
            </tr>
            <tr>
                <td>Last Name: </td>
                <td colspan="2"><?= $doner_info['l_name']; ?></td>
            </tr>
            <tr>
                <td>Display Name: </td>
                <td><?= $doner_info['udisplayname']; ?></td>
                <td>Role: </td>
                <td><?php
                    if ($doner_info['urole'] == 1):
                        echo "Admin";
                    elseif ($doner_info['urole'] == 2):
                        echo "General";
                    endif;

                ?></td>
            </tr>
            <tr>
                <td>Email: </td>
                <td><?= $doner_info['uemail']; ?></td>

                <td>Mobile No: </td>
                <td><?= $doner_info['contact_no']; ?></td>
            </tr>
            <tr>
                <td>Date of Birth: </td>
                <td><?= $doner_info['udob']; ?></td>

                <td>Age: </td>
                <td><?= $doner_info['uage']; ?></td>
            </tr>
            <tr>
                <td>Gender: </td>
                <td><?php
                    if ($doner_info['ugender'] == 0):
                        echo "Male";
                    else:
                        echo "Female";
                    endif;
                ?></td>

                <td>Blood Group: </td>
                <td><?= $doner_info['ubgroup']; ?></td>
            </tr>
            <tr>
                <td>Contact Address: </td>
                <td colspan="3"><?= $doner_info['ucontact']; ?></td>
            </tr>
            <tr>
                <td>Additional Info: </td>
                <td colspan="3"><?= $doner_info['uaddinfo']; ?></td>
            </tr>
            <tr>
                <td>Member Since: </td>
                <td><?= $doner_info['ucreated']; ?></td>

                <td>Member Status: </td>
                <td><?php
                    if ($doner_info['ustatus'] == 1):
                        echo "Active";
                    else:
                        echo "Inactive";
                    endif;
                    ?></td>
            </tr>
        </tbody>
    </table>
</div>




<?php include_once 'includes/modals/addDoner_modal.php';?>
<?php include_once 'includes/footer.php'; ?>
