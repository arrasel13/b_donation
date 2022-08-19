<script>
$(document).ready(function () {
    <?php
    if($_GET['status'] == "success") {
        if(isset($_SESSION['msg'])){
    ?>
        // Display an info toast with no title
        toastr.success('<?php echo $_SESSION['msg']; ?>');

    <?php
        unset($_SESSION['msg']);
      }
    } else if($_GET['status'] == "error"){
        if(isset($_SESSION['msg'])){
    ?>
        toastr.error('<?php echo $_SESSION['msg']; ?>');
    <?php
        unset($_SESSION['msg']);
     }
    } else if($_GET['status'] == "warning"){
        if(isset($_SESSION['msg'])){
    ?>
        toastr.warning('<?php echo $_SESSION['msg']; ?>');
    <?php
        unset($_SESSION['msg']);
     }
    } else if($_GET['status'] == "info"){
        if(isset($_SESSION['msg'])){
    ?>
        toastr.info('<?php echo $_SESSION['msg']; ?>');
    <?php
        unset($_SESSION['msg']);
     }
    }
    ?>
});
</script>