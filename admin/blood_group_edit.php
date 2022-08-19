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

$result = '';
if (isset($_GET['id'])){
    $u_id = $_GET['id'];

    $get_sql = "SELECT * FROM blood_group WHERE id = $u_id LIMIT 1";
    $get_query = $conn->query($get_sql);
    $get_info = $get_query->fetch_assoc();
}else{
    $_SESSION['msg'] = "You are trying a Wrong Way";
    header("Location: blood_group.php?status=warning");
}

if (isset($_POST['b_group_update'])){
    $b_id = $_POST['b_id'];
    $blood_group = $_POST['blood_group'];
    $bg_status = $_POST['bg_status'];

    $u_sql = "UPDATE blood_group SET b_group_name = '$blood_group', status = $bg_status WHERE id = $b_id";

    if ($conn->query($u_sql)){
        $_SESSION['msg'] = "Blood Group Updated Successfully";
        header("Location: blood_group.php?status=success");
        exit(0);
    }else{
        $_SESSION['msg'] = "Blood Group Didn't Update";
        header("Location: blood_group.php?status=error");
        exit(0);
    }
}

include_once 'includes/header.php';
?>
<?php include_once 'includes/top_nav.php'; ?>
<?php include_once 'includes/side_nav.php'; ?>


<h1 class="mt-4">Blood Group Edit</h1>
<ol class="breadcrumb mb-4">
    <!--        <li class="breadcrumb-item active">Dashboard</li>-->
</ol>



<div class="col-lg-5">
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="row g-3">
        <div class="col-md-12">
            <label for="b_id" class="form-label">Blood Group</label>
            <input type="hidden" class="form-control b_id" id="b_id" name="b_id" value="<?= $get_info['id']; ?>">
            <input type="text" class="form-control blood_group" id="blood_group" name="blood_group" value="<?= $get_info['b_group_name']; ?>">
        </div>
        <div class="col-md-12">
            <label for="bg_status" class="form-label">Status</label>
            <select id="bg_status" class="form-select bg_status" name="bg_status">
                <option selected>Choose Status...</option>
                <option value="1" <?php echo ($get_info['status'] == 1)? 'selected="selected"':'';?>>Active</option>
                <option value="0" <?php echo ($get_info['status'] == 0)? 'selected="selected"':'';?>>Inactive</option>
            </select>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary" name="b_group_update">Update</button>
        </div>
    </form>
</div>


<?php include_once 'includes/footer.php'; ?>
