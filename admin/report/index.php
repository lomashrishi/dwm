<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "report";
$tblkey = "id";
$pagename = "रिपोर्ट जनरेट करें |";

?>


<!-- Staring Of This  page -->
<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>



<h3 class="text-primary fw-bold text-center">रिपोर्ट जनरेट करें </h3>
<!-- Button to trigger SweetAlert2 -->
<button id="triggerAlert">Click Me</button>



<!-- Trigger SweetAlert2 on Button Click -->
<script>
    document.getElementById('triggerAlert').addEventListener('click', function() {
        Swal.fire({
            title: 'Test Alert!',
            text: 'SweetAlert2 is triggered by a button click!',
            icon: 'success',
            confirmButtonText: 'Great!'
        });
    });
</script>

<?php
echo "<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({title: 'Success!',text: 'Yojna Added Successfully',icon: 'success',confirmButtonText: 'Done',customClass: {confirmButton: 'custom-confirm-button'}});
});
</script>";

?>


<!-- End Of This Page  -->
<?php include('../includes/footer.php'); ?>