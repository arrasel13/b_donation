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

$sql = "SELECT * FROM blood_group";
$select_blood_group = $conn->query($sql);

if (isset($_POST['blood_group_btn'])){
    $blood_group = $_POST['blood_group'];
    $status = $_POST['bg_status'];

    $sql1 = "INSERT INTO blood_group (b_group_name, status) VALUES('$blood_group','$status')";
    if ($conn->query($sql1)){
        $_SESSION['msg'] = "Blood Group Added Successfully";
        header("Location: ./blood_group.php?status=success");
        exit(0);
    }else{
        $_SESSION['msg'] = "Blood Group Didn't Add";
        header("Location: ./blood_group.php?status=error");
        exit(0);
    }
}

include_once 'includes/header.php';
?>
<?php include_once 'includes/top_nav.php'; ?>
<?php include_once 'includes/side_nav.php'; ?>


    <h1 class="mt-4">Blood Group</h1>

    <ol class="breadcrumb mb-4">
        <!--        <li class="breadcrumb-item active">Dashboard</li>-->
    </ol>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-end">
<!--            <i class="fa-solid fa-droplet"></i> Blood Group List-->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bloodGroupAdd">Add Blood Group</button>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Id</th>
                        <th>Blood Group</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($select_blood_group->num_rows > 0): ?>
                    <?php
                        $i = 1;
                        while($b_group = $select_blood_group->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $b_group['id']; ?></td>
                        <td><?php echo $b_group['b_group_name']; ?></td>
                        <td><?php
                            if ($b_group['status'] == 1){
                                echo "Active";
                            }else{
                                echo "Inactive";
                            }
                        ?></td>
                        <td class="d-flex">
                            <a href="blood_group_edit.php?id=<?php echo $b_group['id']; ?>" class="btn btn-info me-1"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="blood_group_delete.php" method="post">
                                <button class="btn btn-danger d_category" name="d_b_group" value="<?php echo $b_group['id']; ?>"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php
                        $i++;
                        endwhile;
                        else:
                    ?>
                    <tr>
                        <td colspan="5">No Data To Show</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include_once 'includes/modals/blood_group_add_modal.php';?>

<?php include_once 'includes/footer.php'; ?>
