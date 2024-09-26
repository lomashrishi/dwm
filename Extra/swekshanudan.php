<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "swekshanudan";
$tblkey = "id";
$pagename = "नया स्वेच्छानुदान आवेदन भरे";
$page_name = basename($_SERVER['PHP_SELF']);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Collect form data
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $phone_number = mysqli_real_escape_string($conn, trim($_POST['phone_number']));
    $designation = mysqli_real_escape_string($conn, trim($_POST['designation']));
    $district_id = intval($_POST['district_id']); // Ensure district_id is an integer
    $vidhansabha_id = intval($_POST['vidhansabha_id']); // Ensure vidhansabha_id is an integer
    $vikaskhand_id = intval($_POST['vikaskhand_id']); // Ensure vikaskhand_id is an integer
    $sector_id = intval($_POST['sector_id']); // Ensure sector_id is an integer
    $gram_panchayat_id = mysqli_real_escape_string($conn, trim($_POST['gram_panchayat_id']));
    $gram_id = mysqli_real_escape_string($conn, trim($_POST['gram_id']));
    $subject = mysqli_real_escape_string($conn, trim($_POST['subject']));
    $reference = mysqli_real_escape_string($conn, trim($_POST['reference']));
    $expectations_amount = intval($_POST['expectations_amount']); // Ensure expectations_amount is an integer
    $application_date = mysqli_real_escape_string($conn, trim($_POST['application_date']));
    $comment = mysqli_real_escape_string($conn, trim($_POST['comment']));
    $area_id = mysqli_real_escape_string($conn, $_POST['area_id']);
    $form_fill_by = 1;
    // File upload handling
    $uploadOk = "";
    $target_dir = "uploads/";
    $maxSize = 5000000; // 5 MB
    $allowedTypes = ["jpg", "png", "pdf"];
    $file_upload = ['success' => false, 'filePath' => ''];

    // Call the function for each file upload if the file is set
    if (isset($_FILES['file_upload']) && !empty($_FILES['file_upload']['name']))
        $file_upload = handleFileUpload('file_upload', $target_dir, $maxSize, $allowedTypes);

    if (!empty($file_upload['success'])) {
        // echo "At least one file was uploaded successfully.";
        $uploadOk = 1;
        $file_path = $file_upload['filePath'];
    } else {
        // echo "File upload failed.";
        $uploadOk = 0;
    }


    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Sorry, your file was not uploaded.</b></div>";
    } else {
        // Prepare SQL statement
        $sql = "INSERT INTO $tblname 
                    (name, phone_number, designation, district_id, vidhansabha_id, vikaskhand_id, sector_id, gram_panchayat_id, gram_id, subject, reference, expectations_amount, application_date, file_upload, comment, form_fill_by) 
                    VALUES 
                    ('$name', '$phone_number', '$designation', $district_id, $vidhansabha_id, $vikaskhand_id, $sector_id, '$gram_panchayat_id', '$gram_id', '$subject', '$reference', $expectations_amount, '$application_date', '$file_path', '$comment', '$form_fill_by')";

        // Execute SQL statement
        if ($conn->query($sql) === TRUE) {
            $msg = "<div class='msg-container'><b class='alert alert-success msg'>New Record Created Successfully.</b></div>";
        } else {
            $msg = "<div class='msg-container'><b class='alert alert-danger msg'>New Record Created Unsuccessfully!!</b></div>";
        }
    }
}
?>

<!-- Staring page -->
<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>

<style>
    input[type="file"]::file-selector-button {
        color: #00698f;
        /* change the text color to blue */
        background-color: white;
        /* change the background color to light gray */
        border: none;
    }
</style>
<!-- Start New Swekshanudan Form -->
<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid pt-4 px-4 ">
    
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <div class="row mt-5">
            <div class="col-lg-4 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="aavedak" placeholder="आवेदक का नाम" required>
                        <label for="aavedak">आवेदक का नाम <span class="text-danger">*</span> </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="phone_number" id="phone_number" placeholder="आवेदक का फ़ोन नंबर" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                        <label for="phone_number">आवेदक का फ़ोन नंबर <span class="text-danger">*</span></label>
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
                        <input type="date" class="form-control" id="application_date" value="<?= $currentDate ?>" placeholder="आवेदन दिनांक" required name="application_date">
                        <label for="application_date">आवेदन दिनांक <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>

            <!-- for location select -->
            <?php include('../location/location_add.php') ?>

            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3 ">
                        <input type="file" class="form-control bg-white" id="file_upload" placeholder="फाइल अपलोड करें" required name="file_upload">
                        <label for="file_upload">फाइल अपलोड करें <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="subject" placeholder="विषय" required name="subject">
                        <label for="subject">विषय का नाम <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="reference" placeholder="द्वारा" required name="reference">
                        <label for="reference">द्वारा <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="designation" id="designation" placeholder="पद का नाम" required>
                        <label for="designation">पद का नाम <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="expectations_amount" placeholder="आपेक्षित राशि" required name="expectations_amount" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="expectations_amount">आपेक्षित राशि <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>


            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="comment" placeholder="टिप्पणी" required style="height: 150px;" name="comment"></textarea>
                        <label for="comment">टिप्पणी <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;" name="submit"><b>Submit</b></button>
                </div>
            </div>

            <!--  -->
        </div>
    </div>
</form>
<!-- New Swekshanudan close -->

<?php include('../includes/footer.php'); ?>