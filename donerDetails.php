<?php
include_once 'admin/db/connection.php';

if (isset($_POST['bg_id'])){
    $b_g_id = $_POST['bg_id'];

    $dd_sql1 = "SELECT * FROM users_info ui LEFT JOIN blood_group bg ON ui.b_group_id= bg.id LEFT JOIN users u ON ui.u_id=u.id WHERE ui.b_group_id = $b_g_id ";
    $dd_run1 = $conn->query($dd_sql1);
    $dd_result1 = $dd_run1->fetch_assoc();
//    echo "<pre>";
//    print_r($dd_result1);
//    echo "</pre>";

    $dd_sql2 = "SELECT DISTINCT bdh.u_id, bdh.donate_date, bdh.t_year, bdh.t_months, bdh.t_days, ui.u_id, ui.b_group_id FROM b_d_history bdh, users_info ui WHERE bdh.u_id = ui.u_id AND ui.b_group_id = $b_g_id ORDER BY bdh.donate_date DESC LIMIT 0,1";
    $dd_run2 = $conn->query($dd_sql2);
    $dd_result2 = $dd_run2->fetch_assoc();
//    echo "<pre>";
//    print_r($dd_result2);
//    echo "</pre>";

    $dd_sql3 = "SELECT * FROM blood_group WHERE id= $b_g_id";
    $dd_run3 = $conn->query($dd_sql3);
    $dd_result3 = $dd_run3->fetch_assoc();
//    echo "<pre>";
//    print_r($dd_result3);
//    echo "</pre>";

//    exit();
}

?>

<table class="table table-bordered">
    <tbody>
    <tr>

    </tr>
    <tr>
        <td>First Name: </td>
        <td colspan="2"><?= $dd_result1['fname']; ?></td>
        <td rowspan="2" style="text-align: center;"><img src="admin/<?= $dd_result1['user_image']; ?>" alt="Doner image" style="width: 120px;height: 120px;object-fit: cover;"></td>
    </tr>
    <tr>
        <td>Last Name: </td>
        <td colspan="2"><?= $dd_result1['lname']; ?></td>
    </tr>
    <tr>
        <td>Display Name: </td>
        <td><?= $dd_result1['display_name']; ?></td>

        <td>Doner Available </td>
        <td><?php
            if ($dd_result2['t_months'] > 3):
                echo "<p class='no_doner_p'>Available</p>";
            else:
                echo "<p class='no_doner_p'>Not Available</p>";
            endif;
        ?></td>

    </tr>
    <tr>
        <td>Email: </td>
        <td><?= $dd_result1['email']; ?></td>

        <td>Mobile No: </td>
        <td><?= $dd_result1['contact_number']; ?></td>
    </tr>
    <tr>
        <td>Date of Birth: </td>
        <td><?= $dd_result1['dob']; ?></td>

        <td>Age: </td>
        <td><?= $dd_result1['age']; ?></td>
    </tr>
    <tr>
        <td>Gender: </td>
        <td>
            <?php
            if ($dd_result1['gender'] == 0):
                echo "Male";
            else:
                echo "Female";
            endif;
            ?>
        </td>

        <td>Blood Group: </td>
        <td><?= $dd_result3['b_group_name']; ?></td>
    </tr>
    <tr>
        <td>Contact Address: </td>
        <td colspan="3"><?= $dd_result1['contact_address']; ?></td>
    </tr>
    <tr>
        <td>Additional Info: </td>
        <td colspan="3"><?= $dd_result1['additional_info']; ?></td>
    </tr>
    <tr>
        <td>Last Donate: </td>
        <td><?= $dd_result2['donate_date'] ?? "No Record"; ?></td>

        <td>Donation Time Passed: </td>
        <td><?php
            if ($dd_result2['t_year'] > 0 && $dd_result2['t_months'] > 0 && $dd_result2['t_days'] > 0):
                echo $dd_result2['t_year']." Year ".$dd_result2['t_months']." Months ".$dd_result2['t_days']." Days";
            elseif($dd_result2['t_months'] > 0 && $dd_result2['t_days'] > 0):
                echo $dd_result2['t_months']." Months ".$dd_result2['t_days']." Days";
            elseif ($dd_result2['t_days'] > 0):
                echo $dd_result2['t_days']." Days";
            else:
                echo "No Record";
            endif;
        ?></td>
    </tr>
    </tbody>
</table>
