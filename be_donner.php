<?php
session_start();
include_once 'admin/db/connection.php';

$result = '';
if(isset($_POST['register_btn'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $display_name = $_POST['display_name'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $contact_address = $_POST['contact_address'];
    $additional_info = $_POST['additional_info'];
    $password = md5($_POST['password']);
    $c_password = md5($_POST['confirm_password']);

    if (empty($additional_info)){
        $add_info = "No Additional Data Added";
    }else{
        $add_info = $additional_info;
    }

    if ($password === $c_password){

        $sql1 = "INSERT INTO users (display_name, email, password) VALUES ('$display_name','$email','$password') ";
        if ($conn->query($sql1) === TRUE) {
            $last_id = $conn->insert_id;

            $sql2 = "INSERT INTO users_info (u_id, fname, lname, contact_number, gender, b_group_id, contact_address, additional_info) VALUES ('$last_id', '$fname', '$lname', '$contact_no', '$gender', '$blood_group', '$contact_address', '$add_info') ";
//            var_dump($sql2);exit;
            if ($conn->query($sql2) === TRUE){
//                $result = "";
                $_SESSION['msg'] = "Your Registration successfully completed";
                header("Location: login.php?status=success");
                exit(0);
            }else{
                $_SESSION['msg'] = "User Info not inserted";
                header("Location: be_donner.php?status=error");
                exit(0);
            }
        }else{
            $_SESSION['msg'] = "Something went wrong";
            header("Location: be_donner.php?status=warning");
            exit(0);
        }

    }else{
        $_SESSION['msg'] = "Password doesn't match";
        header("Location: be_donner.php?status=info");
        exit(0);
    }

}

$select_blood_group = "SELECT * FROM blood_group";
$b_group_query = $conn->query($select_blood_group);


include_once 'includes/header.php';
?>

    <!-- Registration Form section start -->
    <section class="register_section">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-md-6 col-md-offset-6">
                  <?php echo $result; ?>
                  <div class="register-panel panel panel-default">
                      <div class="panel-heading">
                          <h3 class="panel-title">Become a Doner</h3>
                      </div>
                      <div class="panel-body">
                          <form class="row g-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="col-md-6">
                              <!-- <label for="fname" class="form-label">First Name</label> -->
                              <input type="text" class="form-control fname" id="fname" name="fname" placeholder="First Name" autofocus required>
                            </div>
                            <div class="col-md-6">
                              <!-- <label for="lname" class="form-label">Last Name</label> -->
                              <input type="text" class="form-control lname" id="lname" name="lname" placeholder="Last Name" required>
                            </div>

                            <div class="col-md-6">
                              <!-- <label for="display_name" class="form-label">Display Name</label> -->
                              <input type="text" class="form-control display_name" id="display_name" name="display_name" placeholder="Display Name" required>
                            </div>
                            <div class="col-md-6">
                              <!-- <label for="email" class="form-label">Email</label> -->
                              <input type="email" class="form-control email" id="email" name="email" placeholder="Email ID" required>
                            </div>

                            <div class="col-md-5">
                              <!-- <label for="contact_no" class="form-label">Mobile No</label> -->
                              <input type="text" class="form-control contact_no" id="contact_no" name="contact_no" placeholder="Mobile Number" required>
                            </div>
                            <div class="col-md-3">
                              <!-- <label for="gender" class="form-label">Gender</label> -->
                              <select id="gender" class="form-select gender" name="gender" required>
                                <option selected>Gender...</option>
                                <option value="0">Male</option>
                                <option value="1">Female</option>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <!-- <label for="blood_group" class="form-label">Blood Group</label> -->
                              <select id="blood_group" class="form-select blood_group" name="blood_group" required>
                                <option selected>Blood Group...</option>
                                <?php if ($b_group_query->num_rows > 0): ?>
                                <?php while($b_group_name = $b_group_query->fetch_assoc()): ?>
                                <option value="<?= $b_group_name['id']; ?>"><?= $b_group_name['b_group_name']; ?></option>
                                <?php endwhile; ?>
                                <?php else: ?>
                                <option value="1">A+</option>
                                <?php endif; ?>
                              </select>
                            </div>

                            <div class="col-12">
                              <!-- <label for="contact_address" class="form-label"></label> -->
                              <textarea class="form-control contact_address" id="contact_address" name="contact_address" rows="3" placeholder="Your Address" required></textarea>
                            </div>
                            <div class="col-12">
                              <!-- <label for="additional_info" class="form-label">Additional Information</label> -->
                              <textarea class="form-control additional_info" id="additional_info" name="additional_info" rows="5" placeholder="Additional Information (optional)"></textarea>
                            </div>

                              <div class="col-md-5">
                                  <!-- <label for="confirm_password" class="form-label">Confirm Password</label> -->
                                  <input type="file" class="form-control donner_image" id="donner_image" name="donner_image" required>
                              </div>
                            <div class="col">
                              <!-- <label for="password" class="form-label">Password</label> -->
                              <input type="password" class="form-control password" id="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="col">
                              <!-- <label for="confirm_password" class="form-label">Confirm Password</label> -->
                              <input type="password" class="form-control confirm_password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                            </div>

                            <div class="col-12">
                              <button type="submit" class="btn btn-primary cust-btn w-100" name="register_btn">Register</button>
                            </div>
                          </form>

                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
    <!-- Registration Form section end -->

<?php 
  include_once 'includes/doner_form.php';

  include_once 'includes/footer.php';
?>