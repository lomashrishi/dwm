<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "swekshanudan";
$tblkey = "id";
$pagename = "विवरण";
$page_name = basename($_SERVER['PHP_SELF']);
// For Showing data On View If Admin View  
if (isset($_REQUEST['id']))
    $id = $_REQUEST['id'];
// View Id Recived
if ($id) {
    $sql = "SELECT a.*, d.district_name, v.vidhansabha_name, vk.vikaskhand_name, s.sector_name, gp.gram_panchayat_name, g.gram_name 
   ,   am.area_name AS area_name
 FROM $tblname a 
    LEFT JOIN district_master d ON a.district_id = d.district_id
    LEFT JOIN vidhansabha_master v ON a.vidhansabha_id = v.vidhansabha_id
    LEFT JOIN vikaskhand_master vk ON a.vikaskhand_id = vk.vikaskhand_id
    LEFT JOIN sector_master s ON a.sector_id = s.sector_id
    LEFT JOIN gram_panchayat_master gp ON a.gram_panchayat_id = gp.gram_panchayat_id
    LEFT JOIN gram_master g ON a.gram_id = g.gram_id
     LEFT JOIN area_master am ON a.area_id = am.area_id
    WHERE a.status=1
    ORDER BY a.$tblkey DESC";
    $fetch = mysqli_fetch_array(mysqli_query($conn, $sql));
    $id = $fetch['id'];
    $name = $fetch['name'];
    $phone_number = $fetch['phone_number'];
    $designation = $fetch['designation'];
    $district_name = $fetch['district_name'];
    $vidhansabha_name = $fetch['vidhansabha_name'];
    $vikaskhand_name = $fetch['vikaskhand_name'];
    $sector_name = $fetch['sector_name'];
    $gram_panchayat_name = $fetch['gram_panchayat_name'];
    $gram_name = $fetch['gram_name'];
    $area_name = $fetch['area_name'];
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
// Close For Buinding Db To form Data 

?>

<!-- Start New Swekshanudan Form -->

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
    <div class="container-fluid px-4 ">
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <hr class="text-danger p-2 rounded">
        <div class="row">
            <!--For ID-->
            <input type="hidden" name="vid" id="vid" value="<?= $id ?>">
            <!-- ID -->
            <div class="col-lg-4 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="name" value="<?= $name ?>" readonly>
                        <label for="name">आवेदक का नाम </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="phone_number" id="phone_number" value="<?= $phone_number ?>" readonly>
                        <label for="phone_number">आवेदक का फ़ोन नंबर </label>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="designation" id="designation" value="<?= $designation ?>" readonly>
                        <label for="designation">पद का नाम </label>
                    </div>
                </div>
            </div>

            <!-- for location view -->
            <?php include('../location/location_view.php') ?>

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="subject" name="subject" value="<?= $subject ?>" readonly>
                        <label for="subject">विषय का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="reference" name="reference" value="<?= $reference ?>" readonly>
                        <label for="reference">द्वारा </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3 input-group">
                        <input type="text" class="form-control" id="file_upload" name="file_upload" value="<?= $file_upload ?>" readonly>
                        <label for="file_upload"> अपलोडेड फाइल </label>
                        <span class="input-group-text bg-">
                            <a href="uploads/<?= $file_upload ?>" target="_blank" class=" p-0"><i class="fas fa-eye fa-lg"></i></a>
                        </span>
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="expectations_amount" name="expectations_amount" value="<?= $expectations_amount ?>" readonly>
                        <label for="expectations_amount">आपेक्षित राशि </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="application_date" name="application_date" value="<?= $application_date ?>" readonly>
                        <label for="application_date">आवेदन दिनांक</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea type="text" class="form-control" id="comment" style="height: 60px;" name="comment" value="" readonly><?= $comment ?></textarea>
                        <label for="comment">टिप्पणी </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="expectations_amount" placeholder="अनुमोदित राशि" readonly value="<?= $anumodit_amount ?>" name="anumodit_amount" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="anumodit_amount">अनुमोदित राशि </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="aadesh_no" placeholder="आदेश क्रमांक" readonly value="<?= $aadesh_no ?>" name="aadesh_no" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="aadesh_no">आदेश क्रमांक </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="anumodit_date" value="<?= $anumodit_date ?>" placeholder="अनुमोदित दिनांक" readonly name="anumodit_date">
                        <label for="anumodit_date">अनुमोदित दिनांक </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="view_comment" style="height: 60px;" name="view_comment" readonly><?= $view_comment ?></textarea>
                        <label for="view_comment">टिप्पणी </label>
                    </div>
                </div>
            </div>
            <!-- Add Update -->
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="sveekrt_amount" placeholder="स्वीकृत राशि" required name="sveekrt_amount" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="sveekrt_amount">स्वीकृत राशि <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="sveekrt_no" placeholder="स्वीकृत क्रमांक" required name="sveekrt_no" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="sveekrt_no">स्वीकृत क्रमांक <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="yojna_id" id="selectYojna" class="form-select form-control bg-white" required>
                            <option selected>योजना का नाम चुनें</option>
                            <?php
                            // Fetch districts for dropdown
                            $yojna_query = "SELECT * FROM yojna_master";
                            $yojna_result = mysqli_query($conn, $yojna_query);
                            while ($yojna_row = mysqli_fetch_assoc($yojna_result)) {
                                echo "<option value='" . $yojna_row['yojna_id'] . "'>" . $yojna_row['yojna_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="districtSelect">योजना का नाम चुनें <span class="text-danger">*</span></label>
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
                        <input type="date" class="form-control" id="sveekrt_date" value="<?= $currentDate ?>" placeholder="स्वीकृत दिनांक" required name="sveekrt_date" readonly>
                        <label for="sveekrt_date">स्वीकृत दिनांक <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="sveekrt_comment" style="height: 110px;" name="sveekrt_comment" required></textarea>
                        <label for="sveekrt_comment">टिप्पणी <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" id="approve" type="submit" style="background-color:#4ac387;" name="approve"><b>Approve</b></button>
                </div>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow btn-danger" id="UnApprove" type="submit" name="UnApprove"><b>UnApprove</b></button>
                </div>
            </div>

            <!--  -->
        </div>
    </div>
</form>
<!-- New Swekshanudan close -->