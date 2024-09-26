<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>

<?php
$tblname = "daily_task";
$tblkey = "id";
$pagename = "Add New Work Orders";
$page_name = basename($_SERVER['PHP_SELF']);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Collect form data
    $task_id = ''; // Auto-generated task ID will be inserted
    $customer_name = mysqli_real_escape_string($conn, trim($_POST['customer_name']));
    $mobile = mysqli_real_escape_string($conn, trim($_POST['mobile']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $work_name = mysqli_real_escape_string($conn, trim($_POST['work_name']));
    $work_description = mysqli_real_escape_string($conn, trim($_POST['work_description']));   
    $schedule_work = mysqli_real_escape_string($conn, trim($_POST['schedule_work']));
    $total_rs = intval($_POST['total_rs']); // Ensure total_rs is an integer
    $paid_rs = intval($_POST['paid_rs']); // Ensure paid_rs is an integer
    $operator_name = mysqli_real_escape_string($conn, trim($_POST['operator_name']));
    $other_details = mysqli_real_escape_string($conn, trim($_POST['other_details']));

    // Prepare SQL statement
    $sql = "INSERT INTO $tblname 
                (task_id, customer_name, mobile, email, work_name, work_description, schedule_work, total_rs, paid_rs, operator_name, other_details) 
                VALUES 
                ('$task_id', '$customer_name', '$mobile', '$email', '$work_name', '$work_description', '$schedule_work', $total_rs, $paid_rs, '$operator_name', '$other_details')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'New Work Added Successfully.',
                    icon: 'success',
                    confirmButtonText: 'Done',
                    timer: 3000, // 3000 milliseconds = 3 seconds
                    timerProgressBar: true,
                    allowOutsideClick: false, 
                    customClass: { confirmButton: 'custom-confirm-button' },
                    willClose: () => {
                        // Redirect to a specific URL after the alert is closed
                        window.location.href = '{$page_name}';
                    }
                });
            });
                    </script>";
            // $msg = "<div class='msg-container'><b class='alert alert-success msg'>Help request sent successfully</b></div>";
        } else {
            // $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Failed to send help request</b></div>";
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Failed To Add New Work.',
                    icon: 'error',
                    confirmButtonText: 'Okay',
                    timer: 3000, // 3000 milliseconds = 3 seconds
                    timerProgressBar: true,
                    backdrop: true,
                    allowOutsideClick: false,
                    customClass: { confirmButton: 'custom-confirm-button' },
                    willClose: () => {
                        // Redirect to a specific URL after the alert is closed
                        window.location.href = '{$page_name}';
                    }
                });
            });
                </script>";
        }
    
}
?>

<!-- Staring page -->
<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>

<!-- Start New Daily Task Form -->
<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid pt-4 px-4 ">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="customer_name" id="customer_name"
                            placeholder="Customer Name" required>
                        <label for="customer_name">Customer Name <span class="text-danger">*</span> </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="mobile" id="mobile"
                            placeholder="Mobile Number" onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                            required>
                        <label for="mobile">Mobile Number <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                        <label for="email">Email ID<span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="work_name" id="work_name" placeholder="Work Name"
                            required>
                        <label for="work_name">Work Name <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" style="height: 110px;" name="work_description"
                            id="work_description" placeholder="Work Description" required></textarea>
                        <label for="work_description">Explain Work Description <span class="text-danger">*</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="total_rs" id="total_rs" placeholder="Total Rs"
                            required>
                        <label for="total_rs">Total Rs <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control bootstrap-datetimepicker-widget" 
                            name="schedule_work" id="schedule_work" placeholder="Schedule This Work" required>
                        <label for="schedule_work">Schedule Work<span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="paid_rs" id="paid_rs" placeholder="Paid Rs"
                            required>
                        <label for="paid_rs">Paid Rs <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="operator_name" id="operator_name"
                            placeholder="Operator Name" required>
                        <label for="operator_name">Operator Name <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" style="height: 110px;" name="other_details" id="other_details"
                            placeholder="Other Details" required></textarea>
                        <label for="other_details">Any Work Related Other Details <span class="text-danger">*</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 text-center">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" type="submit"
                        style="background-color:#4ac387;" name="submit"><b>Submit</b></button>
                </div>
            </div>

            <!--  -->
        </div>
    </div>
</form>
<!-- New Daily Task close -->

<hr>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <h6 class="mb-4 text-center mt-2 pt-3 ">Recent Added & Today Work</h6>
            <!-- <hr>
            <div class="container">
            <button class="btn btn-primary" id="export-pdf">Export to PDF</button>
            <button class="btn btn-success" id="export-excel">Export to Excel</button>
            </div>
            <hr> -->
            <div class=" rounded" style="overflow-y: scroll;">
                <div class="row mb-3">
                <table class="table table-striped border shadow" id="example" class="display nowrap" style="width:100%">
                        <thead class="head table-bordered">
                            <tr class="text-center text-nowrap">
                                <th scope="col">S.No.</th>
                                <th scope="col">Work-ID</th>
                                <th scope="col">C-Name</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Work Name</th>
                                <th scope="col">Total Rs.</th>
                                <th scope="col">Status</th>
                                <th scope="col">Remaining Rs.</th>
                                <th scope="col">Date & Time</th>
                                <th scope="col">Description</th>
                                <th scope="col">Schedule Work</th>
                                <th scope="col">Operator Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                        // Query to fetch data from the daily_task table
                        $date_today = date('Y-m-d'); // get the current date in YYYY-MM-DD format
                        $query = "SELECT * FROM daily_task WHERE work_status = 'Pending' AND date(schedule_work) = '$date_today' AND date(created_at) = '$date_today' ORDER BY `daily_task`.`created_at` ASC";
$fetch = mysqli_query($conn, $query);

// Check if the query was successful
if (!$fetch) {
    die("Query failed: " . mysqli_error($conn));
}
                        $i = 1;
                        while ($row = mysqli_fetch_array($fetch)) {
                        ?>
                            <tr class=" text-center text-nowrap">
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $row['task_id'] ?></td>
                                <td><?= $row['customer_name'] ?></td>
                                <td><?= $row['mobile'] ?></td>
                                <td><?= $row['work_name'] ?></td>
                                <td><?= $row['total_rs'] ?></td>
                                <td
                                class="<?= ($row['work_status'] == 'Pending') ? 'text-primary fw-bold' : (($row['work_status'] == 'Processing') ? 'text-warning fw-bold' : 'text-success fw-success fw-bold') ?>">
                                <?= $row['work_status'] ?></td>
                                <td><?= $row['remaining_rs'] ?></td>
                                <td><?= date("d-m-Y | h:m:A", strtotime($row['created_at'])) ?></td>
                                <!-- "Y-m-d\TH:i" -->
                                <td><?= $row['work_description'] ?></td>
                                <td><?= date("d-m-Y | h:m:A", strtotime($row['schedule_work'])) ?></td>
                                <!-- "Y-m-d\TH:i" -->
                                <td><?= $row['operator_name'] ?></td>

                                <td class="action">
                                    <a href="#" onclick="view(<?= $row['id'] ?>)"><i class="fas fa-eye me-2 "
                                            title="View"></i></a>
                                    &nbsp;
                                    &nbsp;
                                    <a href="#" onclick="edit(<?= $row['id'] ?>)"><i class="fas fa-pen me-2 "
                                            title="Edit"></i></a>
                                    &nbsp;
                                    &nbsp;
                                    <a class="text-danger " href=""
                                        onclick="confirmDelete(<?= $row['id']; ?>, '<?php echo $tblname; ?>', '<?= $tblkey ?>')"><i
                                            class="fas fa-trash-alt me-2 " title="Delete"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>