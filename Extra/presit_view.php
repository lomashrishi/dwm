<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "swekshanudan";
$tblkey = "id";
$pagename = "विवरण ";
// For Showing data On View If Admin View  
if (isset($_REQUEST['id']))
    $id = $_REQUEST['id'];
// View Id Recived
if ($id) {
    $sql = "SELECT a.*, d.district_name, v.vidhansabha_name, vk.vikaskhand_name, s.sector_name, gp.gram_panchayat_name, g.gram_name, y.yojna_name
    FROM swekshanudan a 
    LEFT JOIN district_master d ON a.district_id = d.district_id
    LEFT JOIN vidhansabha_master v ON a.vidhansabha_id = v.vidhansabha_id
    LEFT JOIN vikaskhand_master vk ON a.vikaskhand_id = vk.vikaskhand_id
    LEFT JOIN sector_master s ON a.sector_id = s.sector_id
    LEFT JOIN gram_panchayat_master gp ON a.gram_panchayat_id = gp.gram_panchayat_id
    LEFT JOIN gram_master g ON a.gram_id = g.gram_id
    LEFT JOIN yojna_master y ON a.yojna_id = y.yojna_id
    WHERE a.status=2
    ORDER BY a.id DESC";
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
    $sveekrt_amount = $fetch['sveekrt_amount'];
    $sveekrt_no = $fetch['sveekrt_no'];
    $yojna_name = $fetch['yojna_name'];
    $sveekrt_date = $fetch['sveekrt_date'];
    $sveekrt_comment = $fetch['sveekrt_comment'];
    $ptr_sender = $fetch['ptr_sender'];
    $presit_date = $fetch['presit_date'];
    $anudan_prapt_add = $fetch['anudan_prapt_add'];
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
            <input type="hidden"  name="vid" id="vid" value="<?=$id ?>">
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
            <div class="col-lg-4 text-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" name="district_id" id="districtSelect" class=" form-control " value="<?= $district_name ?>" readonly>
                        <label for="districtSelect">जिले का नाम</label>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" name="vidhansabha_id" id="vidhansabhaSelect" class="form-control" value="<?= $vidhansabha_name ?>" readonly>
                        <label for="vidhansabha">विधानसभा का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" name="vikaskhand_id" id="vikaskhandSelect" class=" form-control " value="<?= $vikaskhand_name ?>" readonly>
                        <label for="vikaskhand">विकासखंड का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" name="sector_id" id="sectorSelect" class=" form-control " value="<?= $sector_name ?>" readonly>
                        <label for="sector">सेक्टर का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" name="gram_panchayat_id" id="gramPanchayatSelect" class=" form-control" value="<?= $gram_panchayat_name ?>" readonly>
                        <label for="gram_panchayt">ग्राम पंचायत का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="gramSelect" name="gram_id" value="<?= $gram_name ?>" readonly>
                        <label for="gram">ग्राम का नाम </label>
                    </div>
                </div>
            </div>

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
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="expectations_amount" name="expectations_amount" value="<?= $expectations_amount ?>" readonly>
                        <label for="expectations_amount">आपेक्षित राशि </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
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
                        <input type="text" class="form-control" id="expectations_amount" placeholder="अनुमोदित राशि" readonly value="<?= $anumodit_amount?>" name="anumodit_amount" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="anumodit_amount">अनुमोदित राशि </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="aadesh_no" placeholder="आदेश क्रमांक" readonly value="<?= $aadesh_no?>" name="aadesh_no" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="aadesh_no">आदेश क्रमांक  </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="anumodit_date"value="<?= $anumodit_date?>" placeholder="अनुमोदित दिनांक" readonly name="anumodit_date">
                        <label for="anumodit_date">अनुमोदित दिनांक </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="view_comment" style="height: 60px;" name="view_comment" readonly><?= $view_comment?></textarea>
                        <label for="view_comment">टिप्पणी </label>
                    </div>
                </div>
            </div>
            <!-- Add Update -->
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="sveekrt_amount" value="<?= $sveekrt_amount?>" placeholder="स्वीकृत राशि" readonly name="sveekrt_amount" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="sveekrt_amount">स्वीकृत राशि  </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="sveekrt_no" value="<?= $sveekrt_no?>" placeholder="स्वीकृत क्रमांक" readonly name="sveekrt_no" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="sveekrt_no">स्वीकृत क्रमांक </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input name="yojna_id" id="yojna" value="<?= $yojna_name?>" class=" form-control" placeholder="योजना का नाम" readonly>
                        <label for="yojna">योजना का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="sveekrt_date" value="<?=$sveekrt_date?>" placeholder="स्वीकृत दिनांक" name="sveekrt_date" readonly>
                        <label for="sveekrt_date">स्वीकृत दिनांक </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="sveekrt_comment" style="height: 60px;" name="sveekrt_comment" readonly><?=$sveekrt_comment?></textarea>
                        <label for="sveekrt_comment">टिप्पणी </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="ptr_sender" style="height: 60px;" name="ptr_sender" value="<?=$ptr_sender?>" readonly>
                        <label for="ptr_sender">पत्र भेजने वाले का नाम  </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date"  class="form-control" id="presit_date" style="height: 60px;" value="<?=$presit_date?>" name="presit_date" readonly>
                        <label for="presit_date">स्वीकृत प्रेषित दिनांक </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="anudan_prapt_add" style="height: 60px;" value="<?=$anudan_prapt_add?>" name="anudan_prapt_add" readonly>
                        <label for="anudan_prapt_add">स्थान जहाँ से स्वेच्छानुदान प्राप्त करना हैं !</label>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-6 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" id="approve" type="submit" style="background-color:#4ac387;" name="approve"><b>Approve</b></button>
                </div>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow btn-danger" id="UnApprove" type="submit" name="UnApprove"><b>UnApprove</b></button>
                </div>
            </div> -->

            <!--  -->
        </div>
    </div>
</form>
<!-- New Swekshanudan close -->
