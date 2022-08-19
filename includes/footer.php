    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- jQuery UI-->
    <script src="assets/js/jq_ui/jquery-ui.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!--    Toaster-->
    <script src="assets/js/toastr.min.js"></script>
    <!-- Default JS -->
    <script src="assets/js/script.js"></script>

    <!-- Doner Details Info -->
    <script type='text/javascript'>
        $(document).ready(function(){

            $('.d_details').click(function(){

                var blood_group_id = $(this).data('id');

                // AJAX request
                $.ajax({
                    url: 'donerDetails.php',
                    type: 'post',
                    data: {bg_id: blood_group_id},
                    success: function(response){
                        // Add response in Modal body
                        $('.modal-body').html(response);

                        // Display Modal
                        $('#dDetailsModal').modal('show');
                    }
                });
            });
        });
    </script>

    <?php
        include_once 'includes/doner_form.php';
        include_once './includes/toastr.php';
    ?>


</body>
</html>