<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>

<?php
$tblname = "daily_task";
$tblkey = "id";
$pagename = "Dashboard";
$page_name = basename($_SERVER['PHP_SELF']);


$pending_work=getvalfield($conn,'daily_task','count(*)','work_status="Pending"');
$processing_work=getvalfield($conn,'daily_task','count(*)','work_status="Processing"');
$completed_work=getvalfield($conn,'daily_task','count(*)','work_status="Completed"');
$rejected_work=getvalfield($conn,'daily_task','count(*)','work_status="Rejected"');
$pending_amount=getvalfield($conn,'daily_task','count(*)','work_status="Rejected"');

?>

<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>


<!-- 1 -->
<div class="container-fluid mt-4 pt-4 px-4 ">
    <div class="row g-4 ">
        <h3 class="mb-0 text-center fw-bold text-primary">Daily Work Maruti Coumputers</h3>
        <hr class=" p-1 text-primary">
            <div class="col-sm-6 col-xl-6">
                <a href="../Daily-Task/">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 border border-primary">
                    <i class="fa-solid fa-plus fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Add New Work</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-sm-6 col-xl-6">
                <a href="../Daily-Task/pending-work.php">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 border border-primary">
                    <i class="fa-solid fa-list fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Pending Works</p>
                        <h5 class="mb-0 fw-bold text-primary text-end me-2"><?=$pending_work?></h5>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-sm-6 col-xl-6">
            <a href="../Daily-Task/processing-work.php">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 border border-primary">
                    <i class="fa-solid fa-list-check fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Processing Works</p>
                        <h5 class="mb-0 fw-bold text-primary text-end me-2"><?=$processing_work?></h5>
                    </div>
                </div>
            </a>
            </div>
            <div class="col-sm-6 col-xl-6">
            <a href="../Daily-Task/completed-work.php">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 border border-primary">
                    <i class="fa-solid fa-check-to-slot fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Completed Works</p>
                        <h5 class="mb-0 fw-bold text-primary text-end me-2"><?=$completed_work?></h5>
                    </div>
                </div>
            </a>
            </div>
            <div class="col-sm-6 col-xl-6">
            <a href="../Daily-Task/rejected-work.php">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 border border-danger">
                    <i class="fa-solid fa-file-signature fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Rejected Works</p>
                        <h5 class="mb-0 fw-bold text-primary text-end me-2"><?=$rejected_work?></h5>
                    </div>
                </div>
            </a>
            </div>
            <div class="col-sm-6 col-xl-6">
            <a href="../Daily-Task/pending-amount.php">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 border border-danger">
                    <i class="fa-solid fa-hand-holding-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Pending Amount</p>
                        <h5 class="mb-0 fw-bold text-primary text-end me-2"><?=$pending_amount?></h5>
                    </div>
                </div>
            </a>
            </div>
        </div>
</div>





<?php include('../includes/footer.php'); ?>