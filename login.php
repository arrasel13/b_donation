<?php
    session_start();
    include_once 'admin/db/connection.php';

    $result = '';
    if (isset($_POST['login_btn'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $rememberLogin = isset($_POST['remember_me'])?1:0;

        $sql = "SELECT * FROM users WHERE email='$email' AND password = '$password' LIMIT 1";
        $login_query = $conn->query($sql);

        if ($login_query->num_rows > 0){
            $l_query = $login_query->fetch_assoc();

            $_SESSION['userid'] = $l_query['id'];
            $_SESSION['username'] = $l_query['display_name'];
            $_SESSION['userrole'] = $l_query['user_role'];
            if ($rememberLogin == 1){
                setcookie("auth", $l_query['username'], time()+(60*60*24));
            }

            $_SESSION['msg'] = "Successfully Logged in";
            header("Location: ./admin/admin.php?status=success");
            exit(0);

        }else{

            $_SESSION['msg'] = "User Email or Password does not match";
            header("Location: login.php?status=error");
//            exit(0);
        }
    }

  include_once 'includes/header.php';
?>

    <!-- Login Form Section start -->
    <section class="login_section">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-md-4 col-md-offset-4">
                  <div class="login-panel panel panel-default">
                      <div class="panel-heading">
                          <h3 class="panel-title">Please Sign In</h3>
                      </div>
                      <div class="panel-body">
                          <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                              <fieldset>
                                  <div class="form-group">
                                      <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                  </div>
                                  <div class="form-group">
                                      <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                  </div>
                                  <div class="checkbox">
                                      <label>
                                          <input name="remember_me" type="checkbox" value="Remember Me">Remember Me
                                      </label>
                                  </div>
                                  <!-- Change this to a button or input when using this as a form -->
                                  <button name="login_btn" class="btn btn-lg cust-btn btn-block">Login</button>
                              </fieldset>
                          </form>
                      </div>
<!--                      --><?php //echo $_SESSION['msg']; ?>
                  </div>
              </div>
          </div>
      </div>
    </section>
    <!-- Banner Section end -->

<?php 
//  include_once 'includes/doner_form.php';

  include_once 'includes/footer.php';
?>