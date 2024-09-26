<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "swekshanudan";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT a.*, d.district_name, v.vidhansabha_name, vk.vikaskhand_name, s.sector_name, gp.gram_panchayat_name, g.gram_name, y.yojna_name
    FROM $tblname a 
    LEFT JOIN district_master d ON a.district_id = d.district_id
    LEFT JOIN vidhansabha_master v ON a.vidhansabha_id = v.vidhansabha_id
    LEFT JOIN vikaskhand_master vk ON a.vikaskhand_id = vk.vikaskhand_id
    LEFT JOIN sector_master s ON a.sector_id = s.sector_id
    LEFT JOIN gram_panchayat_master gp ON a.gram_panchayat_id = gp.gram_panchayat_id
    LEFT JOIN gram_master g ON a.gram_id = g.gram_id
    LEFT JOIN yojna_master y ON a.yojna_id = y.yojna_id
    WHERE a.status=3
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
    $anudan_prapt_add = $fetch['anudan_prapt_add'];
} else {
    echo "<script>alert('Record Not Found');</script>";
}
// Maananeey Data From Master Table 

$msql = "SELECT * FROM `maananeey_master`;";
$maananeey = mysqli_query($conn, $msql);
if ($maananeey && mysqli_num_rows($maananeey) > 0) {
    $fetch = mysqli_fetch_assoc($maananeey);
    $maananeey_id = $fetch['maananeey_id'];
    $maananeey_info = $fetch['maananeey_info'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            @page {
                size: A4;
                margin:20mm;
            }
        }
    </style>
</head>

<body>
    <!--  -->
            <div class="container mt-5 mb-5 pt-5 pb-5">

                <div class="Title mb-5">
                    <h1 class="text-center text-primary fw-bolder">स्वेच्छानुदान-स्वीकृति 
                    </h1>
                </div>
               <div class="main_data text-justify p-3">
               <h4 class="fw-bold fs-3" style="line-height:2;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;माननीय श्री <b><?= $maananeey_info ?></b> की अनुशंसा पर वित्तीय वर्ष
                    <?php $year = date('Y');
                    $session = $year . '-' . ($year + 1); ?> <b><?= $session ?></b>
                    में जनसंपर्क मद से <strong><?= $subject ?>,</strong> के लिए <strong><?= $gram_name ?></strong> को <strong><?= $yojna_name ?></strong> हेतु <?= $sveekrt_amount ?> रू. राशि की स्वीकृति दी गई है । आप <?= $anudan_prapt_add ?> से सम्पर्क कर
                    स्वीकृत राशि का चेक प्राप्त कर लेवें |
                </h4>
                <br>
                <h4 class="fw-bold fs-3" style="line-height:2;"> श्री <strong><?= $maananeey_info ?></strong> द्वारा मुझें निर्देष दिया गया हैं, कि पत्र द्वारा आपको अवगत करा दूँ | कृपया अवगत होना चाहेंगें |</h4>
               </div>
                <div class="d-flex justify-content-end mt-5 p-3">
                    <div class="info_prati " style="line-height:2;">
                        <h5 ><strong>प्रति </strong></h5>
                        <h5 ><strong>आवेदक का नाम : </strong><?= $name ?></h5>
                        <h5 ><strong>जिला का नाम : </strong> <?= $district_name ?> (छ.ग.)</h5>
                        <h5 ><strong>विधानसभा का नाम : </strong> <?= $vidhansabha_name ?></h5>
                        <h5 ><strong>विकासखंड का नाम : </strong> <?= $vikaskhand_name ?></h5>
                        <h5 ><strong>ग्राम पंचायत का नाम : </strong> <?= $gram_panchayat_name ?></h5>
                        <h5 ><strong>ग्राम का नाम : </strong> <?= $gram_name ?></h5>
                    </div>
                </div>
            </div>
<!--  -->

        <!-- Bootstrap JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>