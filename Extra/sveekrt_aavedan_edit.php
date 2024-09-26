<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "swekshanudan";
$tblkey = "id";
$pagename = "विवरण बदले";
$page_name = basename($_SERVER['PHP_SELF']);

// $vikaskhand_name = "";
$vidhansabha_id = "";
$district_id = "";
$vikaskhand_id = "";
$sector_id = "";
$gram_id = "";
$gram_panchayat_id = "";

// View Id Received
if (isset($_REQUEST['edit_id'])) {
    $edit_id = $_REQUEST['edit_id']; // Add this line
    $edit_query = "SELECT * FROM $tblname WHERE $tblkey='$edit_id'";
    $fetch = mysqli_fetch_array(mysqli_query($conn, $edit_query));
    $id = $fetch['id'];
    $name = $fetch['name'];
    $phone_number = $fetch['phone_number'];
    $designation = $fetch['designation'];
    $district_id = $fetch['district_id'];
    $vidhansabha_id = $fetch['vidhansabha_id'];
    $vikaskhand_id = $fetch['vikaskhand_id'];
    $sector_id = $fetch['sector_id'];
    $gram_panchayat_id = $fetch['gram_panchayat_id'];
    $gram_id = $fetch['gram_id'];
    $area_idd = $fetch['area_id'];
    $subject = $fetch['subject'];
    $reference = $fetch['reference'];
    $expectations_amount = $fetch['expectations_amount'];
    $application_date = $fetch['application_date'];
    $comment = $fetch['comment'];
    $file_upload = $fetch['file_upload'];
    $anumodit_amount = $fetch['anumodit_amount'];
    $aadesh_no = $fetch['aadesh_no'];
    $anumodit_date = $fetch['anumodit_date'];
    $view_comment = $fetch['view_comment'];
}
?>




<!-- Include jQuery library
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<!-- Start New Prastavit Edit Form -->
<style>
    input[type="file"]::file-selector-button {
        color: #00698f;
        /* change the text color to blue */
        background-color: transparent;
        /* change the background color to light gray */
        border: none;
    }
</style>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid pt-4 px-4 ">
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <hr class="text-info p-2 rounded">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="aavedak" value="<?= $name ?>" placeholder="आवेदक का नाम" required readonly>
                        <input type="hidden" name="edit_id" id="id" value="<?= $id ?>">
                        <label for="aavedak">आवेदक का नाम </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="phone_number" value="<?= $phone_number ?>" id="phone_number" placeholder="आवेदक का फ़ोन नंबर" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required readonly>
                        <label for="phone_number">आवेदक का फ़ोन नंबर </label>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="designation" id="designation" value="<?= $designation ?>" placeholder="पद का नाम" required readonly>
                        <label for="designation">पद का नाम </label>
                    </div>
                </div>
            </div>

            <!-- for location edit -->
            <?php include('../location/location_edit.php') ?>

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3 input-group">
                        <input type="file" class="form-control" id="file_upload" name="file_upload" readonly>
                        <label for="file_upload"> अपलोडेड फाइल </label>
                        <span class="input-group-text bg-">
                            <a href="uploads/<?= $file_upload ?>" target="_blank" class="p-0"><i class="fas fa-eye fa-lg"></i></a>
                        </span>
                    </div>
                    <input type="hidden" name="existing_file" value="<?= $file_upload ?>">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="subject" placeholder="विषय" required name="subject" value="<?= $subject ?>" readonly>
                        <label for="subject">विषय का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="reference" placeholder="द्वारा" required name="reference" value="<?= $reference ?>" readonly>
                        <label for="reference">द्वारा </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="application_date" value="<?= $application_date ?>" placeholder="आवेदन दिनांक" required name="application_date" readonly>
                        <label for="application_date">आवेदन दिनांक </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="expectations_amount" placeholder="आपेक्षित राशि" required name="expectations_amount" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?= $expectations_amount ?>" readonly>
                        <label for="expectations_amount">आपेक्षित राशि </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <?php
                        // Set default current date
                        $currentDate = date('Y-m-d'); // Format: YYYY-MM-DD
                        ?>
                        <input type="date" class="form-control" id="update_date" value="<?= $currentDate ?>" placeholder="अपडेट दिनांक" required name="update_date" readonly>
                        <label for="update_date">अपडेट दिनांक </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="comment" placeholder="टिप्पणी" required style="height: 62px;" name="comment" readonly><?= $comment ?></textarea>
                        <label for="comment">टिप्पणी </label>
                    </div>
                </div>
            </div>

            <!-- Add Update -->

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="expectations_amount" placeholder="अनुमोदित राशि" required name="anumodit_amount" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?= $anumodit_amount ?>">
                        <label for="anumodit_amount">अनुमोदित राशि <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="aadesh_no" placeholder="आदेश क्रमांक" required name="aadesh_no" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?= $aadesh_no ?>">
                        <label for="aadesh_no">आदेश क्रमांक <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="application_date" placeholder="अनुमोदित दिनांक" required name="anumodit_date" value="<?= $anumodit_date ?>" readonly>
                        <label for="anumodit_date">अनुमोदित दिनांक <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="view_comment" style="height: 62px;" name="view_comment" required><?= $view_comment ?></textarea>
                        <label for="view_comment">टिप्पणी <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" id="Update" type="submit" onclick="update(<?= $id ?>)" style="background-color:#4ac387;" name="Update"><b>Update</b></button>
                </div>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow btn-info" id="Print" type="submit" name="Print"><b>Print</b></button>
                </div>
            </div>

            <!--  -->
        </div>
    </div>
</form>
<!-- New Prastavit Edit close -->