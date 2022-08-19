<?php

$message = $_SESSION['msg'];
$result = $_GET['status'];
if ($result == "success"){
    echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
              {$message}
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";
}elseif ($result == "error"){
    echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
              {$message}
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";
}
?>