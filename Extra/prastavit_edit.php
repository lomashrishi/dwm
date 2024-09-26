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


<!-- Script For Print button -->

<script>
    $(document).ready(function() {
        $('#Print').on('click', function() {
            // Serialize the form data and store it in the hidden field
            var formData = $('form').serialize();
            $('#form_data').val(formData);

            // Submit the form
            $('form').submit();
        });
    });
</script>

<!-- Print  -->

<!-- Script For DropDown List -->
<script>
    // For Vidhansabha
    // 
    // function vidhansabhaChange(dis_id)
    $(document).ready(function() {
        $('#districtSelect').change(function() {
            var district_id = $(this).val();
            // alert("Selected District ID: " + district_id);
            $.ajax({
                url: 'ajax/get_vidhansabha.php',
                type: 'POST',
                data: {
                    district_id: district_id
                },
                success: function(data) {
                    var vidhansabha = JSON.parse(data);
                    $('#vidhansabhaSelect').empty();
                    $('#vidhansabhaSelect').append('<option>विधानसभा का नाम चुनें</option>');
                    $.each(vidhansabha, function(index, vidhansabha) {
                        $('#vidhansabhaSelect').append('<option value="' + vidhansabha.vidhansabha_id + '">' + vidhansabha.vidhansabha_name + '</option>');
                    });
                    // Pre-select the vidhansabha if editing
                    <?php if (isset($vidhansabha_id) && !empty($vidhansabha_id)) { ?>
                        $('#vidhansabhaSelect').val('<?= $vidhansabha_id ?>');
                    <?php } ?>
                }
            });
        });
        // Trigger the change event if editing an existing record
        <?php if (isset($vidhansabha_id) && !empty($vidhansabha_id)) { ?>
            $('#districtSelect').trigger('change');
        <?php } ?>
    });

    // For Vikaskhand
    $(document).ready(function() {
        $('#vidhansabhaSelect').change(function() {
            var vidhansabha_id = $(this).val();
            //alert("Selected Vidhansabha ID: " + vidhansabha_id);
            $.ajax({
                url: 'ajax/get_vikaskhand.php',
                type: 'POST',
                data: {
                    vidhansabha_id: vidhansabha_id
                },
                success: function(data) {
                    var vikaskhand = JSON.parse(data);
                    $('#vikaskhandSelect').empty();
                    $('#vikaskhandSelect').append('<option selected>विकासखंड का नाम चुनें</option>');
                    $.each(vikaskhand, function(index, vikaskhand) {
                        $('#vikaskhandSelect').append('<option value="' + vikaskhand.vikaskhand_id + '">' + vikaskhand.vikaskhand_name + '</option>');
                    });
                    // Pre-select the vidhansabha if editing
                    <?php if (isset($vikaskhand_id) && !empty($vikaskhand_id)) { ?>
                        $('#vikaskhandSelect').val('<?= $vikaskhand_id ?>');
                    <?php } ?>
                }
            });
        });
        // Trigger the change event if editing an existing record
        <?php if (isset($vikaskhand_id) && !empty($vikaskhand_id)) { ?>
            $('#vidhansabhaSelect').trigger('change');
        <?php } ?>
    });

    // For Sector Load 
    $(document).ready(function() {
        $('#vikaskhandSelect').change(function() {
            var vikaskhand_id = $(this).val();
            //alert("Selected Vikaskhand ID: " + vikaskhand_id);
            $.ajax({
                url: 'ajax/get_sector.php', // Replace with your PHP file to fetch sectors
                type: 'POST',
                data: {
                    vikaskhand_id: vikaskhand_id
                },
                success: function(data) {
                    var sectors = JSON.parse(data);
                    $('#sectorSelect').empty();
                    $('#sectorSelect').append('<option selected>सेक्टर का नाम चुनें</option>');
                    $.each(sectors, function(index, sector) { // Changed variable name to 'sector' to avoid conflict
                        $('#sectorSelect').append('<option value="' + sector.sector_id + '">' + sector.sector_name + '</option>'); // Corrected selector
                    });
                    // Pre-select the vidhansabha if editing
                    <?php if (isset($sector_id) && !empty($sector_id)) { ?>
                        $('#sectorSelect').val('<?= $sector_id ?>');
                    <?php } ?>
                }
            });
        });
        <?php if (isset($sector_id) && !empty($sector_id)) { ?>
            $('#vikaskhandSelect').trigger('change');
        <?php } ?>
    });

    // For Gram Panchayat From Sector id 
    $(document).ready(function() {
        $('#sectorSelect').change(function() {
            var sector_id = $(this).val();
            //alert("Selected Sector ID: " + sector_id);
            $.ajax({
                url: 'ajax/get_gram_panchayat.php', // Replace with your PHP file to fetch sectors
                type: 'POST',
                data: {
                    sector_id: sector_id
                },
                success: function(data) {
                    var gram_panchayats = JSON.parse(data);
                    $('#gramPanchayatSelect').empty();
                    $('#gramPanchayatSelect').append('<option selected>ग्राम पंचायत का नाम चुनें</option>');
                    $.each(gram_panchayats, function(index, gram_panchayat) { // Changed variable name to ', gram_panchayat_name' to avoid conflict
                        $('#gramPanchayatSelect').append('<option value="' + gram_panchayat.gram_panchayat_id + '">' + gram_panchayat.gram_panchayat_name + '</option>'); // Corrected selector
                    });
                    // Pre-select the vidhansabha if editing
                    <?php if (isset($gram_panchayat_name) && !empty($gram_panchayat_name)) { ?>
                        $('#gramPanchayatSelect').val('<?= $gram_panchayat_name ?>');
                    <?php } ?>
                }
            });
        });
        <?php if (isset($gram_panchayat_name) && !empty($gram_panchayat_name)) { ?>
            $('#gramPanchayatSelect').trigger('change');
        <?php } ?>
    });

    //   For Grams  By Panchayat
    $(document).ready(function() {
        $('#gramPanchayatSelect').change(function() {
            var gram_panchayat_id = $(this).val();
            //   alert("Selected Gram Panchayat ID: " + gram_panchayat_id);
            $.ajax({
                url: 'ajax/get_gram.php', // Replace with your PHP file to fetch gram
                type: 'POST',
                data: {
                    gram_panchayat_id: gram_panchayat_id
                },
                success: function(data) {
                    var grams = JSON.parse(data);
                    $('#gramSelect').empty();
                    $('#gramSelect').append('<option selected>ग्राम का नाम चुनें</option>');
                    $.each(grams, function(index, gram) { // Changed variable name to ', gram_panchayat_name' to avoid conflict
                        $('#gramSelect').append('<option value="' + gram.gram_id + '">' + gram.gram_name + '</option>'); // Corrected selector
                    });
                    // Pre-select the vidhansabha if editing
                    <?php if (isset($gram_id) && !empty($gram_id)) { ?>
                        $('#gramSelect').val('<?= $gram_id ?>');
                    <?php } ?>
                }
            });
        });
        <?php if (isset($gram_id) && !empty($gram_id)) { ?>
            $('#gramSelect').trigger('change');
        <?php } ?>
    });
</script>

<!--  -->