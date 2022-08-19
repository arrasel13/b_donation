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

$userid = $_SESSION['userid'];
//echo $_SESSION['userrole'];exit();
$username = $_SESSION['username'];

if ($_SESSION['userrole'] == 1){
    if (isset($_GET['id'])){
        $uid = $_GET['id'];
        $select_d_history = "SELECT * FROM b_d_history WHERE u_id=$uid";
        $d_history_query = $conn->query($select_d_history);
    }else{
        $select_d_history = "SELECT * FROM b_d_history";
        $d_history_query = $conn->query($select_d_history);
    }
}else{
    $select_d_history = "SELECT * FROM b_d_history WHERE u_id=$userid";
    $d_history_query = $conn->query($select_d_history);
}


include_once 'includes/header.php';
?>
<?php
include_once 'includes/top_nav.php';
include_once 'includes/side_nav.php';
?>


<h1 class="mt-4">Blood Donation History</h1>
<ol class="breadcrumb mb-4">
    <!--        <li class="breadcrumb-item active">Dashboard</li>-->
</ol>
<div class="card mb-4">
    <div class="card-header d-flex justify-content-end">
        <!--            <i class="fa-solid fa-droplet"></i> Blood Group List-->
        <button class="btn btn-primary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#donationDateAdd">Add Record</button>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Donate Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($d_history_query->num_rows > 0):
                $i=1;
                while ($d_history_info = $d_history_query->fetch_assoc()):
                    ?>

                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $d_history_info['u_name']; ?></td>
                        <td><?= $d_history_info['donate_date']; ?></td>
                        <td class="d-flex">
                            <a href="d_history_info_edit.php?id=<?php echo $d_history_info['id']; ?>&val=<?= $d_history_info['u_id']; ?>" class="btn btn-info btn-sm me-1" title="Edit Info"><i class="fa-solid fa-pen-to-square"></i></a>
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




<?php include_once 'includes/modals/donate_history_modal.php';?>
<?php include_once 'includes/footer.php'; ?>