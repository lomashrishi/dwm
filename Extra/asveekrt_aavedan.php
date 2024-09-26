<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "swekshanudan";
$tblkey = "id";
$pagename = "अस्वीकृत आवेदन";
$page_name = basename($_SERVER['PHP_SELF']);

// If Approve By Admin 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve'])) {
    $vid = $_POST['id'];
    $anumodit_amount = $_POST['anumodit_amount'];
    $aadesh_no = $_POST['aadesh_no'];
    $anumodit_date = $_POST['anumodit_date'];
    $view_comment = $_POST['view_comment'];

    $sql = "UPDATE $tblname SET status='1',anumodit_amount='$anumodit_amount',aadesh_no='$aadesh_no',anumodit_date='$anumodit_date',view_comment='$view_comment' WHERE id='$vid'";
    //    echo $sql;die;
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert($vid+'Approved Successfully')</script>";
        // echo "<script>window.open('prastavit_aavedak.php?view=$vid','_self')</script>";
    } else {
        echo "<script>alert('Error')</script>";
        echo "<script>window.open('view.php?view=$tblname','_self')</script>";
    }
}
// Close Approve Admin

// If Reject By Admin
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['UnApprove'])) {
    $id = $_REQUEST['id'];
    $sql = "UPDATE $tblname SET status='4' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Un Approve Successfully')</script>";
        // echo "<script>window.open('view.php?view=$tblname','_self')</script>";
    } else {
        echo "<script>alert('Error')</script>";
        echo "<script>window.open('view.php?view=$tblname','_self')</script>";
    }
}
// Close For Reject By Admin
// Search Option With Filter
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $district_id = isset($_POST['district_id']) ? $_POST['district_id'] : '';
    $vidhansabha_id = isset($_POST['vidhansabha_id']) ? $_POST['vidhansabha_id'] : '';
    $vikaskhand_id = isset($_POST['vikaskhand_id']) ? $_POST['vikaskhand_id'] : '';
    $sector_id = isset($_POST['sector_id']) ? $_POST['sector_id'] : '';
    $gram_panchayat_id = isset($_POST['gram_panchayat_id']) ? $_POST['gram_panchayat_id'] : '';
    $gram_id = isset($_POST['gram_id']) ? $_POST['gram_id'] : '';
    $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
    $from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
    $to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';
    $area_id = isset($_POST['area_id']) ? $_POST['area_id'] : '';

    // Start building the SQL query
    $sql = "SELECT a.*, d.district_name, v.vidhansabha_name, vk.vikaskhand_name, s.sector_name, gp.gram_panchayat_name, g.gram_name 
    ,am.area_name AS area_name
    FROM swekshanudan a 
    LEFT JOIN district_master d ON a.district_id = d.district_id
    LEFT JOIN vidhansabha_master v ON a.vidhansabha_id = v.vidhansabha_id
    LEFT JOIN vikaskhand_master vk ON a.vikaskhand_id = vk.vikaskhand_id
    LEFT JOIN sector_master s ON a.sector_id = s.sector_id
    LEFT JOIN gram_panchayat_master gp ON a.gram_panchayat_id = gp.gram_panchayat_id
    LEFT JOIN gram_master g ON a.gram_id = g.gram_id
    LEFT JOIN area_master am ON a.area_id = am.area_id
    WHERE a.status=4";

    // Add conditions if fields are set
    if (!empty($district_id)) {
        $sql .= " AND a.district_id = '" . mysqli_real_escape_string($conn, $district_id) . "'";
    }
    if (!empty($vidhansabha_id)) {
        $sql .= " AND a.vidhansabha_id = '" . mysqli_real_escape_string($conn, $vidhansabha_id) . "'";
    }
    if (!empty($area_id)) {
        $sql .= " AND a.area_id = '" . mysqli_real_escape_string($conn, $area_id) . "'";
    }
    if (!empty($vikaskhand_id)) {
        $sql .= " AND a.vikaskhand_id = '" . mysqli_real_escape_string($conn, $vikaskhand_id) . "'";
    }
    if (!empty($sector_id)) {
        $sql .= " AND a.sector_id = '" . mysqli_real_escape_string($conn, $sector_id) . "'";
    }
    if (!empty($gram_panchayat_id)) {
        $sql .= " AND a.gram_panchayat_id = '" . mysqli_real_escape_string($conn, $gram_panchayat_id) . "'";
    }
    if (!empty($gram_id)) {
        $sql .= " AND a.gram_id = '" . mysqli_real_escape_string($conn, $gram_id) . "'";
    }
    if (!empty($phone_number)) {
        $sql .= " AND phone_number = '" . mysqli_real_escape_string($conn, $phone_number) . "'";
    }
    if (!empty($from_date) && !empty($to_date)) {
        $sql .= " AND application_date BETWEEN '" . mysqli_real_escape_string($conn, $from_date) . "' AND '" . mysqli_real_escape_string($conn, $to_date) . "'";
    }
    $sql .= " ORDER BY id DESC";
    // echo $sql;die;
} else {
    $sql = "SELECT a.*, d.district_name, v.vidhansabha_name, vk.vikaskhand_name, s.sector_name, gp.gram_panchayat_name, g.gram_name 
    ,am.area_name AS area_name 
    FROM swekshanudan a 
    LEFT JOIN district_master d ON a.district_id = d.district_id
    LEFT JOIN vidhansabha_master v ON a.vidhansabha_id = v.vidhansabha_id
    LEFT JOIN vikaskhand_master vk ON a.vikaskhand_id = vk.vikaskhand_id
    LEFT JOIN sector_master s ON a.sector_id = s.sector_id
    LEFT JOIN gram_panchayat_master gp ON a.gram_panchayat_id = gp.gram_panchayat_id
    LEFT JOIN gram_master g ON a.gram_id = g.gram_id
    LEFT JOIN area_master am ON a.area_id = am.area_id
    WHERE a.status=4
    ORDER BY a.id DESC";
}

$fetch = mysqli_query($conn, $sql);
//  Close Search

?>

<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>
<!-- For search bar -->
<?php include('../location/search.php') ?>

<!-- Table Start -->
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <h6 class="mb-4 text-center mt-2 pt-3 "><?= $pagename; ?> सूची</h6>
            <div class=" rounded" style="overflow-y: scroll;">

                <table class="table table-striped border shadow">
                    <thead class=" head">
                        <tr class="text-center text-nowrap">
                            <th scope="col">क्रमांक</th>
                            <th scope="col">आवेदक का नाम</th>
                            <th scope="col">मोबाइल नंबर</th>
                            <th scope="col">विषय</th>
                            <th scope="col">आपेक्षित राशि</th>
                            <th scope="col">आवेदन दिनांक</th>
                            <th scope="col">टिप्पणी</th>
                            <th scope="col">विधानसभा</th>
                            <th scope="col">जिला</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_array($fetch)) {
                        ?>
                            <tr class=" text-center">
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['phone_number'] ?></td>
                                <td><?= $row['subject'] ?></td>
                                <td><?= $row['expectations_amount'] ?></td>
                                <td><?= date("d-m-Y", strtotime($row['application_date'])) ?></td>
                                <td><?= $row['comment'] ?></td>
                                <td><?= $row['vidhansabha_name'] ?></td>
                                <td><?= $row['district_name'] ?></td>
                                <td class="action">
                                    <a href="#" onclick="view(<?= $row['id'] ?>)"><i class="fas fa-eye me-2 " title="View"></i></a>
                                    &nbsp;
                                    &nbsp;
                                    <a href="#" onclick="edit(<?= $row['id'] ?>)"><i class="fas fa-pen me-2 " title="Edit"></i></a>
                                    &nbsp;
                                    &nbsp;
                                    <a class="text-danger " href="" onclick="confirmDelete(<?= $row['id']; ?>, '<?php echo $tblname; ?>', '<?= $tblkey ?>')"><i class="fas fa-trash-alt me-2 " title="Delete"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Table End -->

<!-- The View Modal -->
<div class="modal fade" id="myModal-view" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"><?= $pagename; ?> विवरण</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- This will be replaced with the content from view.php -->
            </div>
        </div>
    </div>
</div>

<!-- The Edit Modal -->
<div class="modal fade" id="myModal-edit" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"><?= $pagename; ?> विवरण बदले </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- This will be replaced with the content from view.php -->
            </div>
        </div>
    </div>
</div>
<!-- modal Scripts  -->
<script>
    // function view(v_id){
    function view(v_id) {
        //  alert(v_id);
        $.ajax({
            type: 'POST',
            url: 'aavedak_view.php',
            data: {
                id: v_id
            },
            success: function(data) {
                $('#myModal-view').find('.modal-body').html(data);
                $('#myModal-view').modal('show');
            }
        });
    }

    function edit(e_id) {
        // alert('dsa');
        $.ajax({
            type: 'POST',
            url: 'aavedak_edit.php',
            data: {
                edit_id: e_id
            },
            success: function(data) {
                $('#myModal-edit').find('.modal-body').html(data);
                $('#myModal-edit').modal('show');
            }
        });
    }

    //   setTimeout(()=>{
    //   document.getElementById('subs_msg1').innerHTML = "";
    // },2000);

    // }
</script>


<!-- Close Modal And Table View Scripts -->


<!-- Script For DropDown List -->

<script>
    // For Vidhansabha
    $(document).ready(function() {
        $('#districtSelect').change(function() {
            var district_id = $(this).val();
            //  alert("Selected District ID: " + district_id);
            $.ajax({
                url: '../ajax/get_vidhansabha.php',
                type: 'POST',
                data: {
                    district_id: district_id
                },
                success: function(data) {
                    var vidhansabha = JSON.parse(data);
                    $('#vidhansabhaSelect').empty();
                    $('#vidhansabhaSelect').append('<option value="">विधानसभा का नाम चुनें</option>');
                    $.each(vidhansabha, function(index, vidhansabha) {
                        $('#vidhansabhaSelect').append('<option value="' + vidhansabha.vidhansabha_id + '">' + vidhansabha.vidhansabha_name + '</option>');
                    });
                }
            });
        });
    });

    // For Vikaskhand
    $(document).ready(function() {
        $('#vidhansabhaSelect').change(function() {
            var vidhansabha_id = $(this).val();
            //alert("Selected Vidhansabha ID: " + vidhansabha_id);
            $.ajax({
                url: '../ajax/get_vikaskhand.php',
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
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + status + ' - ' + error);
                }
            });
        });
    });
    // For Sector Load 
    $(document).ready(function() {
        $('#vikaskhandSelect').change(function() {
            var vikaskhand_id = $(this).val();
            //alert("Selected Vikaskhand ID: " + vikaskhand_id);
            $.ajax({
                url: '../ajax/get_sector.php', // Replace with your PHP file to fetch sectors
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
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + status + ' - ' + error);
                }
            });
        });
    });
    // For Gram Panchayat From Sector id 
    $(document).ready(function() {
        $('#sectorSelect').change(function() {
            var sector_id = $(this).val();
            //alert("Selected Sector ID: " + sector_id);
            $.ajax({
                url: '../ajax/get_gram_panchayat.php', // Replace with your PHP file to fetch sectors
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
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + status + ' - ' + error);
                }
            });
        });
    });

    //   For Grams  By Panchayat
    $(document).ready(function() {
        $('#gramPanchayatSelect').change(function() {
            var gram_panchayat_id = $(this).val();
            //   alert("Selected Gram Panchayat ID: " + gram_panchayat_id);
            $.ajax({
                url: '../ajax/get_gram.php', // Replace with your PHP file to fetch gram
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
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + status + ' - ' + error);
                }
            });
        });
    });
</script>

<!--  -->

<?php include('../includes/footer.php'); ?>