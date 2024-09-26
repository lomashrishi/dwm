<?php
include('../config/dbconnection.php'); // Adjust path as needed
include('../config/session_check.php'); // Adjust path as needed

$tblname = "adminlogin";
$tblkey = "id";
$pagename = "Admin Profile";

$username=$_SESSION['username'];
$password = getvalfield($conn, $tblname, "password", "username='$username'");
$profile_picture = getvalfield($conn, $tblname, "profile_picture", "username='$username'");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Get form inputs
    $username = $_POST['username'];
    $confirm_password =  isset($_POST['confirm_password']) ? $_POST['confirm_password'] : ''; // Raw password input
    // $profile_picture = $_FILES['profile_picture'];
    $existing_file = isset($_POST['existing_file']) ? $_POST['existing_file'] : '';

    // Handle file upload
    if (!empty($_FILES['profile_picture'])) {
        $uploadOk = "";
        $target_dir = "uploads/";
        $maxSize = 5000000; // 5 MB
        $allowedTypes = ["jpg", "png", "jpeg"];

        $existing_file=$target_dir.$existing_file;
        
        // Delete existing file
        delete_existing_file($existing_file);

        // Initialize variables
        $profile_picture1 = ['success' => false, 'filePath' => ''];

        // Call the function for file upload
        if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']['name'])) {
            $profile_picture1 = handleFileUpload('profile_picture', $target_dir, $maxSize, $allowedTypes);
        }

        if (!empty($profile_picture1['success'])) {
            $uploadOk = 1;
            $uploaded_file_path = $profile_picture1['filePath'];
        } else {
            $uploadOk = 0;
        }
    } else {
        $uploaded_file_path = $existing_file;
        $uploadOk = 1;
    }

    // Hash the password before storing it
    $hashed_password = password_hash($confirm_password, PASSWORD_DEFAULT);

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
        // Prepare an SQL statement
        $stmt = $conn->prepare("UPDATE $tblname SET password=?, profile_picture=? WHERE id=1");
        $stmt->bind_param("ss", $hashed_password, $uploaded_file_path);

        if ($stmt->execute()) {
            $msg = "<div class='msg-container'><b class='alert alert-success msg'>Data updated successfully.</b></div>";
        } else {
            $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Error: " . $stmt->error . "</b></div>";
        }

        // Close the statement
        $stmt->close();
    } else {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Sorry, your file was not uploaded.</b></div>";
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
<!-- Start New charcha Form -->
<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid pt-4 px-4 ">
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="username" id="username" value="<?= $username ?>" readonly placeholder="User Name" required>
                        <label for="username">User username <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control"  id="old_password" placeholder="User Name" required onkeyup="new_p_form()">
                        <div id="old_pass_msg" style="font-size: 12px;"></div>
                        <label for="old_password">Old Password <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12" style="display: none;" id="new_p">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control"  id="new_password" placeholder="User Name" required onkeyup="confirm_p(); validatePassword() ">
                        <div id="strength_msg" style="font-size: 12px;"></div>
                        <label for="new_password">New Password <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12" style="display: none;" id="c_pass">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="User Name" required onkeyup="confirm_pass()">
                        <div id="confirm_pass_msg" style="font-size: 12px;"></div>
                        <label for="confirm_password">Confirm Password <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <!-- <div class="container mt-5">
                <div class="row"> -->
                    <div class="col-lg-12">
                        <div class="form-group shadow-sm">
                            <div class="form-floating mb-3">
                                <input type="file" class="form-control bg-white" id="profile_picture" placeholder="Profile Picture" name="profile_picture" onchange="picture_msg()">
                                <input type="hidden" class="form-control bg-white" id="existing_file" placeholder="Profile Picture" name="existing_file" value="<?= $profile_picture ? $profile_picture : '' ?>" onchange="picture_msg()">
                                <label for="profile_picture">Profile Picture</label>
                                <div id="picture_msg" class="mt-2" style="font-size: 12px;"></div>
                                <div id="picture_msgg" class="mt-2" style="font-size: 12px;"></div>
                            </div>
                        </div>
                    </div>
                <!-- </div>
            </div> -->

            <div class="col-lg-12 text-center">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" type="submit" style="background-color:#4ac387; display:none;" id="submit_button" name="submit"><b>Submit</b></button>
                    <!-- <div id="" class="mt-2" style="font-size: 12px;"></div> -->
                </div>
            </div>
        </div>
    </div>
</form>
<!-- New charcha  close -->

<script>
    function new_p_form(a) {
        var old_pass = document.getElementById('old_password').value;
        var new_pass = document.getElementById('new_p');
        var current_pass = <?= $password ?>;
        // alert(a);
        if (old_pass.length > 0) {
            new_pass.style.display = 'block';
        } else {
            new_pass.style.display = 'none';
        }
    }

    function confirm_p(b) {
        var new_pass = document.getElementById('new_password').value;
        var confirm_pass = document.getElementById('c_pass');
        // alert(a);
        if (new_pass.length > 0) {
            confirm_pass.style.display = 'block';

        } else {
            confirm_pass.style.display = 'none';
        }
    }

    function picture_msg() {
        var pictureMsg = document.getElementById('picture_msgg');
        pictureMsg.innerHTML = 'Only .png , .jpg , .jpeg files can supported';
        pictureMsg.innerHTML = 'Only .png , .jpg , .jpeg files can supported';
        pictureMsg.style.color = '#dc3545';

        var input = document.getElementById('profile_picture');
        var messageDiv = document.getElementById('picture_msg');
        var file = input.files[0];
        var reader = new FileReader();

        // Clear any previous messages or previews
        messageDiv.innerHTML = '';

        if (file) {
            reader.onload = function(e) {
                // Create an image element to show the preview
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '300px'; // Make sure the image fits within the container
                img.style.height = '300px'; // Maintain aspect ratio

                // Append the image to the messageDiv
                messageDiv.appendChild(img);
            };

            reader.readAsDataURL(file); // Convert the file to a data URL
        } else {
            messageDiv.innerHTML = 'No image selected.';
        }
    }
</script>
<script>
    function new_p_form() {
        var oldPassword = document.getElementById('old_password').value;
        var oldPassMsg = document.getElementById('old_pass_msg');

        if (oldPassword.length > 0) {
            fetch('check_password.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'old_password=' + encodeURIComponent(oldPassword)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.valid) {
                        document.getElementById('new_p').style.display = 'block';
                        oldPassMsg.innerHTML = 'Old Password is Matched!';
                        oldPassMsg.style.color = '#4ac38a';
                        oldPassMsg.style.display = 'block';
                    } else {
                        document.getElementById('new_p').style.display = 'none';
                        oldPassMsg.innerHTML = 'Old Password is Not Matched!';
                        oldPassMsg.style.color = '#dc3545';
                        oldPassMsg.style.display = 'block';
                    }
                });
        } else {
            document.getElementById('new_p').style.display = 'none';
            oldPassMsg.style.display = 'none';
        }
    }



    function confirm_pass() {
        var newPassword = document.getElementById('new_password').value;
        var confirmPassword = document.getElementById('confirm_password').value;
        var confirmPassMsg = document.getElementById('confirm_pass_msg');
        var submitButton = document.getElementById('submit_button');

        if (confirmPassword.length > 0) {
            document.getElementById('c_pass').style.display = 'block';

            if (confirmPassword === newPassword) {
                confirmPassMsg.innerHTML = 'Passwords is match!';
                confirmPassMsg.style.color = '#4ac38a';
                submitButton.style.display = 'block';
            } else {
                confirmPassMsg.innerHTML = 'Passwords do not match!';
                confirmPassMsg.style.color = '#dc3545';
            }

            confirmPassMsg.style.display = 'block';
        } else {
            document.getElementById('c_pass').style.display = 'block';
            confirmPassMsg.style.display = 'block';
        }
    }

    function validatePassword() {
        var newPassword = document.getElementById('new_password').value;
        var strengthMsg = document.getElementById('strength_msg');
        var strongPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        if (newPassword.length > 0) {
            if (strongPassword.test(newPassword)) {
                strengthMsg.innerHTML = 'Password is strong!';
                strengthMsg.style.color = '#4ac38a';
            } else {
                strengthMsg.innerHTML = 'Password should be at least 8 characters long, contain uppercase and lowercase letters, a number, and a special character.';
                strengthMsg.style.color = '#dc3545';
            }
            strengthMsg.style.display = 'block';
        } else {
            strengthMsg.style.display = 'none';
        }
    }
</script>


<?php include('../includes/footer.php'); ?>