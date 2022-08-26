<?php
session_start();
include_once 'admin/db/connection.php';

$s_blood_group = "SELECT * FROM blood_group WHERE status=1";
$r_blood_group = $conn->query($s_blood_group);
$s1_blood_group = "SELECT * FROM blood_group WHERE status=1";
$r1_blood_group = $conn->query($s1_blood_group);

include_once 'includes/header.php';
?>


<section class="d_filter">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12">
                <ul class="nav nav-pills mb-3 nav-fill" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">All Doner</button>
                    </li>

                    <?php
                        if ($r_blood_group->num_rows > 0):
                            while($bg_result = $r_blood_group->fetch_assoc()):
                    ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link bg_name" id="tab-<?= $bg_result['id']; ?>" name="bg_name"data_id="<?= $bg_result['id']; ?>" data-bs-toggle="pill" data-bs-target="#tab<?= $bg_result['id']; ?>" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><?= $bg_result['b_group_name']; ?> Doner</button>
                    </li>
                    <?php
                            endwhile;
                        endif;
                    ?>

                </ul>

                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                        <div class="row">
                            <?php

//                            $sql1 = "SELECT * FROM users_info ui LEFT JOIN blood_group bg ON ui.b_group_id= bg.id LEFT JOIN users u ON ui.u_id=u.id LEFT JOIN b_d_history bdh ON ui.u_id = bdh.u_id";
//                            $sql1 = "SELECT * FROM users_info ui LEFT JOIN blood_group bg ON ui.b_group_id= bg.id LEFT JOIN users u ON ui.u_id=u.id LEFT JOIN b_d_history bdh ON ui.u_id = bdh.u_id ORDER BY id DESC LIMIT 0,1 ";
                            $sql1 = "SELECT * FROM users_info ui LEFT JOIN blood_group bg ON ui.b_group_id= bg.id LEFT JOIN users u ON ui.u_id=u.id ";
                            $run1 = $conn->query($sql1);

                            if ($run1->num_rows > 0):
                                while($details1 = $run1->fetch_assoc()):
//                                        echo "<pre>";
//                                        print_r($details1);
//                                        echo "</pre>";
                                $bgid = $details1['b_group_id'];
//                                $sql5 = "SELECT DISTINCT bdh.u_id, bdh.donate_date, bdh.t_year, bdh.t_months, bdh.t_days, ui.u_id, ui.b_group_id FROM b_d_history bdh, users_info ui WHERE bdh.u_id = ui.u_id AND ui.b_group_id = $bgid ORDER BY bdh.donate_date DESC LIMIT 0,1";
//                                $sql5 = "SELECT DISTINCT bdh.u_id, bdh.donate_date, ui.u_id, ui.b_group_id FROM b_d_history bdh, users_info ui WHERE bdh.u_id = ui.u_id AND ui.b_group_id = $bgid ORDER BY bdh.donate_date DESC LIMIT 0,1";
//                                $sql5 = "SELECT bdh.u_id, bdh.bg_id, MAX(bdh.donate_date), ui.u_id FROM b_d_history bdh, users_info ui WHERE bdh.u_id = ui.u_id AND bdh.bg_id = ui.b_group_id AND bdh.bg_id = $bgid GROUP BY bdh.u_id";
                                $sql5 = "SELECT bdh.u_id, bdh.bg_id, bdh.donate_date, ui.u_id FROM b_d_history bdh, users_info ui WHERE bdh.u_id = ui.u_id AND bdh.bg_id = ui.b_group_id AND bdh.bg_id = $bgid ORDER BY bdh.donate_date DESC LIMIT 0,1";
                                $run5 = $conn->query($sql5);
                                $result5 = $run5->fetch_assoc();
//                                 echo "<pre>";
//                                 print_r($result5);
//                                 var_dump($result5);
//                                 echo "</pre>";

                                $age_diff = abs(strtotime(date('d-m-Y')) - strtotime($details1['dob']));
                                $age_year = floor($age_diff / (365*60*60*24));
                                $age_month = floor(($age_diff - $age_year * 365*60*60*24) / (30*60*60*24));
                                $age_day = floor(($age_diff - $age_year * 365*60*60*24 - $age_month*30*60*60*24)/ (60*60*24));

                                $result5['donate_date'] = isset($result5['donate_date']) ? $result5['donate_date'] : date('d-m-Y',strtotime("-1 days"));

                                $diff = abs(strtotime(date('Y-m-d')) - strtotime($result5['donate_date']));
                                $years = floor($diff / (365*60*60*24));
                                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

//                                if($run5->num_rows > 0){
//                                    $result5 = $run5->fetch_assoc();
//                                }else{
//                                    $result5 = "No Record";
//                                    echo "<pre>";
//                                    print_r($result5);
//                                    echo "</pre>";
//                                }

                            ?>
                            <div class="col-lg-3">
                                <div class="doner_info">
                                    <div class="doner_image">
                                        <img class="img-fluid" src="admin/<?= $details1['user_image']; ?>" alt="Image">
                                    </div>
                                    <div class="doner_detail">
                                        <h2 class="d_name"><?= $details1['fname'].' '.$details1['lname']; ?></h2>
                                        <p class="d_c_no">Mobile: <?= $details1['contact_number']; ?></p>
                                        <p class="d_l_d_date">Last Donate: <?= date('d-m-Y',strtotime($result5['donate_date'])); ?></p>
                                        <p class="d_b_group">Blood Group: <?= $details1['b_group_name']; ?></p>
                                        <p class="d_age">Age: <?php

                                            if ($age_year > 0 && $age_month > 0 && $age_day >= 0):
                                                echo $age_year." Year ".$age_month." Months ".$age_day." Days";

                                            elseif($age_month > 0 && $age_day >= 0):
                                                echo $age_month." Months ".$age_day." Days";

                                            elseif ($age_day >= 0):
                                                echo $age_day." Days";

                                            else:
                                                echo "No Record";
                                            endif;
                                        ?></p>
                                        <p class="d_months">Months: <?php

                                            if ($years > 0 && $months > 0 && $days > 0):
                                                echo $years." Year ".$months." Months ".$days." Days";
                                            elseif($months > 0 && $days > 0):
                                                echo $months." Months ".$days." Days";
                                            elseif ($days > 0):
                                                echo $days." Days";

                                            else:
                                                echo "No Record";
                                            endif;
                                        ?></p>
                                        <p class="d_status">Status:
                                            <?php
                                                if ($months >= 3):
                                                    echo "<span class='no_doner_p1'>Available</span>";
                                                else:
                                                    echo "<span class='no_doner_p1'>Not Available</span>";
                                                endif;
                                            ?>
                                        </p>
                                        <button data-id='<?= $details1['b_group_id']; ?>' class="btn btn-success d_details">Detail Info</button>
                                    </div>
                                </div>
                            </div>

                            <?php
                                    endwhile;
                                else:
                                    echo "<h3 class='no_doner'>There has no Doner to Show</h3>";
                                endif;
                            ?>
                        </div>

                    </div>

                    <?php
                        if ($r1_blood_group->num_rows > 0):
                            while($bg_result1 = $r1_blood_group->fetch_assoc()):
                    ?>
                    <div class="tab-pane fade" id="tab<?= $bg_result1['id']; ?>" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                        <div class="row">
                            <?php
                                $id = $bg_result1['id'];

//                                $sql2 = "SELECT * FROM users_info ui LEFT JOIN blood_group bg ON ui.b_group_id= bg.id LEFT JOIN users u ON ui.u_id=u.id LEFT JOIN b_d_history bdh ON ui.u_id = bdh.u_id WHERE ui.b_group_id =$id ";
                                $sql2 = "SELECT * FROM users_info ui LEFT JOIN blood_group bg ON ui.b_group_id= bg.id LEFT JOIN users u ON ui.u_id=u.id WHERE ui.b_group_id = $id ";
                                $run2 = $conn->query($sql2);
                                if ($run2->num_rows > 0):
                                    while($details2 = $run2->fetch_assoc()):
//                                        echo "<pre>";
//                                        print_r($details2);
//                                        echo "</pre>";
                                        $sql4 = "SELECT DISTINCT bdh.u_id, bdh.donate_date, ui.u_id, ui.b_group_id FROM b_d_history bdh, users_info ui WHERE bdh.u_id = ui.u_id AND ui.b_group_id = $id ORDER BY bdh.donate_date DESC LIMIT 0,1";
                                        $run4 = $conn->query($sql4);
                                        $result4 = $run4->fetch_assoc();

                                        $age_diff = abs(strtotime(date('d-m-Y')) - strtotime($details2['dob']));
                                        $age_year = floor($age_diff / (365*60*60*24));
                                        $age_month = floor(($age_diff - $age_year * 365*60*60*24) / (30*60*60*24));
                                        $age_day = floor(($age_diff - $age_year * 365*60*60*24 - $age_month*30*60*60*24)/ (60*60*24));

//                                        if(is_null($result4['donate_date'])){
//                                            $result4['donate_date'] = date('d-m-Y',strtotime("-1 days"));
////                                            echo $result4['donate_date'];
//                                        }
                                        $result4['donate_date'] = isset($result4['donate_date']) ? $result4['donate_date'] : date('d-m-Y',strtotime("-1 days"));

                                        $diff = abs(strtotime(date('Y-m-d')) - strtotime($result4['donate_date']));
                                        $years = floor($diff / (365*60*60*24));
                                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                            ?>
                            <div class="col-lg-3">
                                <div class="doner_info">
                                    <div class="doner_image">
                                        <img class="img-fluid" src="admin/<?= $details2['user_image']; ?>" alt="Image">
                                    </div>
                                    <div class="doner_detail">
                                        <h2 class="d_name"><?= $details2['fname'].' '.$details2['lname']; ?></h2>
                                        <p class="d_c_no">Mobile: <?= $details2['contact_number']; ?></p>
                                        <p class="d_l_d_date">Last Donate: <?= date('d-m-Y',strtotime($result4['donate_date'])); ?></p>
                                        <p class="d_b_group">Blood Group: <?= $details2['b_group_name']; ?></p>
                                        <p class="d_age">Age: <?php

                                            if ($age_year > 0 && $age_month > 0 && $age_day >= 0):
                                                echo $age_year." Year ".$age_month." Months ".$age_day." Days";

                                            elseif($age_month > 0 && $age_day >= 0):
                                                echo $age_month." Months ".$age_day." Days";

                                            elseif ($age_day >= 0):
                                                echo $age_day." Days";

                                            else:
                                                echo "No Record";
                                            endif;
                                        ?></p>
                                        <p class="d_months">Months: <?php
                                            if ($years > 0 && $months > 0 && $days > 0):
                                                echo $years." Year ".$months." Months ".$days." Days";
                                            elseif($months > 0 && $days > 0):
                                                echo $months." Months ".$days." Days";
                                            elseif ($days > 0):
                                                echo $days." Days";

                                            else:
                                                echo "No Record";
                                            endif;
                                        ?></p>
                                        <p class="d_status">Status:
                                            <?php
                                            if ($months >= 3):
                                                echo "<span class='no_doner_p1'>Available</span>";
                                            else:
                                                echo "<span class='no_doner_p1'>Not Available</span>";
                                            endif;
                                            ?>
                                        </p>
                                        <button data-id='<?= $details2['b_group_id']; ?>' class="btn btn-success d_details">Detail Info</button>
                                    </div>
                                </div>
                            </div>

                            <?php
                                    endwhile;
                                else:
                                    echo "<h3 class='no_doner'>There has no Doner to Show</h3>";
                                endif;
                            ?>
                        </div>
                    </div>
                    <?php
                            endwhile;
                        endif;
                    ?>
<!--                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">...</div>-->
<!--                    <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">...</div>-->
                </div>
            </div>

            <div class="col-lg-12">
                <div class="modal fade" id="dDetailsModal" role="dialog">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Doner Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
//  include_once 'includes/doner_form.php';

include_once 'includes/footer.php';
?>