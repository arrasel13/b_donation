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
    $sql = "SELECT * FROM users WHERE id = $doner_id";
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

include_once 'includes/header.php';
?>
<?php
include_once 'includes/top_nav.php';
include_once 'includes/side_nav.php';
?>


<h1 class="mt-4">Change Password</h1>
<ol class="breadcrumb mb-4">
    <!--        <li class="breadcrumb-item active">Dashboard</li>-->
</ol>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card p-4 mb-4">
                <form action="doner_pass_update.php" method="post" class="row g-3">
                    <div class="col-md-12">
                        <label for="password" class="form-label">Name</label>
                        <input type="hidden" class="form-control d_id" id="d_id" name="d_id" value="<?= $doner_info['id']; ?>">
                        <input type="text" class="form-control d_name" id="d_name" name="d_name" placeholder="Password"  value="<?= $doner_info['display_name']; ?>" readonly required>
                    </div>
                    <div class="col-md-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="col-md-12">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control confirm_password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>

                    <div class="col-12 mt-5">
                        <button class="btn btn-success" type="submit" name="update_pass">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include_once 'includes/footer.php'; ?>
