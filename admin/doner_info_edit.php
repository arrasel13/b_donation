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
    }else{
        $_SESSION['msg'] = "This user is not available";
        header("Location: doner_list.php?status=info");
    }

}else{
    $_SESSION['msg'] = "You are trying a Wrong Way";
    header("Location: doner_list.php?status=warning");
}

$select_blood_group = "SELECT * FROM blood_group";
$b_group_query = $conn->query($select_blood_group);

include_once 'includes/header.php';
?>
<?php
include_once 'includes/top_nav.php';
include_once 'includes/side_nav.php';
?>


<h1 class="mt-4">Edit Information</h1>
<ol class="breadcrumb mb-4">
    <!--        <li class="breadcrumb-item active">Dashboard</li>-->
</ol>
<div class="card p-4 mb-4">

    <form action="doner_info_update.php" method="post" class="row g-3" enctype="multipart/form-data">
        <div class="col-md-6">
            <label for="fname" class="form-label">First Name</label>
            <input type="hidden" class="form-control doner_id" id="doner_id" name="doner_id" value="<?= $doner_info['uid'] ?>" required>
            <input type="text" class="form-control fname" id="fname" name="fname" placeholder="First Name" value="<?= $doner_info['f_name'] ?>" autofocus required>
        </div>
        <div class="col-md-6">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" class="form-control lname" id="lname" name="lname" placeholder="Last Name" value="<?= $doner_info['l_name'] ?>" required>
        </div>

        <div class="col-md-6">
            <label for="display_name" class="form-label">Display Name</label>
            <input type="text" class="form-control display_name" id="display_name" name="display_name" value="<?= $doner_info['udisplayname'] ?>" placeholder="Display Name" required>
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control email" id="email" name="email" value="<?= $doner_info['uemail'] ?>" placeholder="Email ID" required>
        </div>

        <div class="col-md-6">
            <label for="contact_no" class="form-label">Mobile No</label>
            <input type="text" class="form-control contact_no" id="contact_no" name="contact_no" value="<?= $doner_info['contact_no'] ?>" placeholder="Mobile Number" required>
        </div>
        <div class="col-md-6">
            <div class="donerimg">
                <img src="<?= $doner_info['uimage'] ?>" style="width: 100px;" alt="Doner Image">
            </div>
            <label for="doner_image" class="form-label">Your Image</label>
            <input type="hidden" class="form-control old_doner_image" id="old_doner_image" name="old_doner_image" value="<?= $doner_info['uimage'] ?>">
            <input type="file" class="form-control doner_image" id="doner_image" name="doner_image" value="<?= $doner_info['uimage'] ?>">
        </div>

        <div class="col-md-3">
            <label for="dob" class="form-label">Date of Birth</label>
<!--            <input type="date" class="form-control dob" id="dob" name="dob" placeholder="dob" value="--><?//= $doner_info['udob'] ?><!--" required>-->
            <input type="date" class="form-control dob" id="dob" name="dob" placeholder="data of birth" value="<?= date('Y-m-d',strtotime ($doner_info['udob'])); ?>" required>
        </div>
        <div class="col-md-3">
            <label for="age" class="form-label">Age</label>
            <input type="text" class="form-control age" id="age" name="age" value="<?= $doner_info['uage'] ?>" placeholder="Age" required>
        </div>
        <div class="col-md-3">
            <label for="gender" class="form-label">Gender</label>
            <select id="gender" class="form-select gender" name="gender" required>
                <option selected>Gender...</option>
                <option value="0" <?php echo ($doner_info['ugender'] == 0)? 'selected="selected"':'';?>>Male</option>
                <option value="1" <?php echo ($doner_info['ugender'] == 1)? 'selected="selected"':'';?>>Female</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="blood_group" class="form-label">Blood Group</label>
            <select id="blood_group" class="form-select blood_group" name="blood_group" required>
                <option selected>Blood Group...</option>
                <?php if ($b_group_query->num_rows > 0): ?>
                    <?php while($b_group_name = $b_group_query->fetch_assoc()): ?>
                        <option value="<?= $b_group_name['id']; ?>" <?php echo ($doner_info['ubgroupid'] == $b_group_name['id'])? 'selected="selected"':'';?>><?= $b_group_name['b_group_name']; ?></option>
                    <?php endwhile; ?>
                <?php else: ?>
                    <option>No Blood Group Recorded</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="col-6">
            <label for="contact_address" class="form-label">Your Address</label>
            <textarea class="form-control contact_address" id="contact_address" name="contact_address" rows="3" placeholder="Your Address" required><?= $doner_info['ucontact'] ?></textarea>
        </div>
        <div class="col-6">
            <label for="additional_info" class="form-label">Additional Information</label>
            <textarea class="form-control additional_info" id="additional_info" name="additional_info" rows="3" placeholder="Additional Information (optional)"><?= $doner_info['uaddinfo'] ?></textarea>
        </div>


        <div class="col-md-6">
            <label for="doner_status" class="form-label">Status</label>
            <select id="doner_status" class="form-select doner_status" name="doner_status">
                <option selected>Choose Status...</option>
                <option value="1" <?php echo ($doner_info['ustatus'] == 1)? 'selected="selected"':'';?>>Active</option>
                <option value="0" <?php echo ($doner_info['ustatus'] == 0)? 'selected="selected"':'';?>>Inactive</option>
            </select>
        </div>
        <?php if ($_SESSION['userrole'] == 1): ?>
        <div class="col-md-6">
            <label for="doner_role" class="form-label">Role</label>
            <select id="doner_role" class="form-select doner_role" name="doner_role" required>
                <option selected>Choose Status...</option>
                <option value="1" <?php echo ($doner_info['urole'] == 1)? 'selected="selected"':'';?>>Admin</option>
                <option value="2" <?php echo ($doner_info['urole'] == 2)? 'selected="selected"':'';?>>General</option>
            </select>
        </div>
        <?php endif; ?>

        <div class="col-12 mt-5">
            <button class="btn btn-success" type="submit" name="update_info">Update Info</button>
        </div>
    </form>
</div>


<?php include_once 'includes/footer.php'; ?>
