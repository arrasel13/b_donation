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

$td_sql = "SELECT * FROM users_info";
$td_run = $conn->query($td_sql);
$total_doner = $td_run->num_rows;

$da_sql = "SELECT * FROM b_d_history WHERE d_available = 1";
$da_run = $conn->query($da_sql);
$doner_available = $da_run->num_rows;


include_once 'includes/header.php';
?>
<?php include_once 'includes/top_nav.php'; ?>
<?php include_once 'includes/side_nav.php'; ?>



    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
<!--        <li class="breadcrumb-item active">Dashboard</li>-->
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Doner <span class="badge bg-light text-dark"><?php echo $total_doner; ?></span></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="doner_list.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Avail User to Donate  <span class="badge bg-light text-dark"><?php echo $doner_available; ?></span></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Success Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Danger Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>



<?php
    include_once 'includes/footer.php';
?>