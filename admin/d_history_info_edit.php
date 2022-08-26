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

if (isset($_GET['id']) AND isset($_GET['val'])){
    $s_id = $_SESSION['userid'];
    $s_role = $_SESSION['userrole'];
    $u_id = $_GET['val'];
    $id = $_GET['id'];

//    echo $s_id."<br>";
//    echo $u_id."<br>";
//    echo $id."<br>";
//    exit();

    if ($s_id == $u_id || $s_role == 1){

        $select_d_history = "SELECT * FROM b_d_history WHERE id=$id AND u_id = $u_id";
        $run_sql = $conn->query($select_d_history);


        if ($run_sql->num_rows > 0){
            $d_history_info = $run_sql->fetch_assoc();
//
//            echo "<pre>";
//            print_r($d_history_info);
//            echo "</pre>";
//            exit();
        }else{
            $_SESSION['msg'] = "No Data Found to Edit";
            header("Location: donation_history.php?status=info");
            exit(0);
        }
    }else{
        $_SESSION['msg'] = "You are not authorize to change it";
        header("Location: donation_history.php?status=warning");
        exit(0);
    }
}else{
    $_SESSION['msg'] = "You are not trying wrong way";
    header("Location: donation_history.php?status=warning");
    exit(0);
}

include_once 'includes/header.php';
?>
<?php
include_once 'includes/top_nav.php';
include_once 'includes/side_nav.php';
?>

<h1 class="mt-4">Edit Donation Date</h1>
<ol class="breadcrumb mb-4">
    <!--        <li class="breadcrumb-item active">Dashboard</li>-->
</ol>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card p-4 mb-4">
                <form action="doner_history_update.php" method="post" class="row g-3">
                    <div class="col-md-12">
                        <input type="hidden" class="form-control dh_id" id="dh_id" name="dh_id" value="<?= $d_history_info['id']; ?>" required>
                        <input type="hidden" class="form-control uid" id="uid" name="uid" value="<?= $d_history_info['u_id']; ?>" required>
                    </div>
                    <div class="col-md-12">
                        <label for="display_name" class="form-label">Display Name</label>
                        <input type="text" class="form-control display_name" id="display_name" name="display_name" value="<?= $d_history_info['u_name']; ?>" placeholder="Display Name" readonly required>
                    </div>

                    <div class="col-md-12">
                        <label for="donate_date" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control donate_date" id="donate_date" name="donate_date" value="<?= date('Y-m-d',strtotime ($d_history_info['donate_date'])); ?>" <?php if($s_role == 1 && $s_id != $u_id){echo 'readonly';} ?> required>
                    </div>
                    <?php
                    if($s_role == 1):
                    ?>
                    <div class="col-md-12">
                        <label for="d_d_approve" class="form-label">Approve Donate Date</label>
                        <select id="d_d_approve" class="form-select d_d_approve" name="d_d_approve" required>
                            <option selected disabled>Approve Donate Date</option>
                            <option value="1" <?php echo ($d_history_info['d_d_approve'] == 1)? 'selected="selected"':'';?>>Approve</option>
                            <option value="2" <?php echo ($d_history_info['d_d_approve'] == 2)? 'selected="selected"':'';?>>Pending</option>
                        </select>
                    </div>
                    <?php endif; ?>

                    <div class="col-12 mt-5">
                        <button class="btn btn-success" type="submit" name="update_history">Update Info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

?>

<?php include_once 'includes/footer.php'; ?>