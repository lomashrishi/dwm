<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "swekshanudan";
$tblkey = "id";
$pagename = "प्रेषित प्रिंट विवरण";
// For Showing data On View If Admin View  
if (isset($_REQUEST['id']))
    $id = $_REQUEST['id'];
// View Id Recived
?>
<!-- Start  Form -->
<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid px-4 ">
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <hr class="text-success p-2 rounded">
        <div class="row">
            <!--For ID-->
            <input type="hidden"  name="presit_id" id="presit_id" value="<?=$id ?>">
            <!-- ID -->
            <div class="col-lg-6 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control border-dark" name="ptr_sender" id="ptr_sender" placeholder="पत्र भेजने वाले का नाम " required>
                        <label for="ptr_sender">पत्र भेजने वाले का नाम <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                    <?php
                        // Set default current date
                        $currentDate = date('Y-m-d'); // Format: YYYY-MM-DD
                        ?>
                        <input type="date" class="form-control border-dark" id="presit_date" value="<?=$currentDate?>"  name="presit_date" placeholder="स्वीकृत प्रेषित दिनांक " required readonly>
                        <label for="presit_date">स्वीकृत प्रेषित दिनांक <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control border-dark" name="anudan_prapt_add" id="anudan_prapt_add" placeholder="स्थान जहाँ से स्वेच्छानुदान प्राप्त करना हैं !.. ">
                        <label for="anudan_prapt_add"><small>स्थान जहाँ से स्वेच्छानुदान प्राप्त करना हैं !.. </small><span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" id="presit_summit" type="submit" style="background-color:#4ac387;" name="presit_summit"><b>Summit</b></button>
                </div>
            </div>
  <!--  -->
        </div>
    </div>
</form>
<!--Modal Body close -->