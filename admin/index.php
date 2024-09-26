<?php
include('config/dbconnection.php');
session_start();

$msg = "";
$otp = "";

if (isset($_POST['login'])) {
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));

    if (!empty($username) && !empty($password)) {
        // Prepare a secure SQL statement
        $sql = "SELECT username, password FROM adminlogin WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $db_username, $db_password);
            mysqli_stmt_fetch($stmt);



            // Verify the hashed password
            if (password_verify($password, $db_password)) {
                // Set session variables
                $_SESSION['username'] = $db_username;
                $_SESSION['role']     = 'admin';

                // Redirect to dashboard
                echo "<script>
                setTimeout(function() {
                    window.location.href = 'dash/';
                }, 2400);
                </script>";
                $msg = "<div class='msg-container'><b class='alert alert-success msg'>Admin Login Successfully!..</b></div>";
            } else {
                $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Invalid Username or Password !..</b></div>";
            }
        } else {
            $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Invalid Username or Password !..</b></div>";
        }

        mysqli_stmt_close($stmt);
    } else {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Please enter both username and password.</b></div>";
    }

    mysqli_close($conn);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Login Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(55deg, rgba(94, 79, 233, 1) 0%, rgba(0, 189,153, 1) 100%);
        }

        .header {
            position: relative;
            text-align: center;
            color: white;
        }

        .waves {
            position: relative;
            width: 100%;
            height: 15vh;
            margin-bottom: -7px;
            min-height: 100px;
            max-height: 150px;
        }

        .parallax>use {
            animation: move-forever 25s cubic-bezier(.55, .5, .45, .5) infinite;
        }

        .parallax>use:nth-child(1) {
            animation-delay: -2s;
            animation-duration: 7s;
        }

        .parallax>use:nth-child(2) {
            animation-delay: -3s;
            animation-duration: 10s;
        }

        .parallax>use:nth-child(3) {
            animation-delay: -4s;
            animation-duration: 13s;
        }

        .parallax>use:nth-child(4) {
            animation-delay: -5s;
            animation-duration: 20s;
        }

        @keyframes move-forever {
            0% {
                transform: translate3d(-90px, 0, 0);
            }

            100% {
                transform: translate3d(85px, 0, 0);
            }
        }

        @media (max-width: 340px) {
            .waves {
                height: 40px;
                min-height: 40px;
            }

            .content {
                height: 30vh;
            }

            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <div id="form-main-wrapper">
        <div class="form-container">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center" style="min-height: 85vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                            <?php if (isset($msg)) echo $msg; ?>

                            <!-- Spinner End -->
                            <form action="" method="POST" id="usernamePasswordForm">
                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <a href="" class="">
                                        <h3 class="text-primary"><span class="text-danger">DWM</span> Admin Sign In !..</h3>
                                    </a>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="@Admin" required>
                                    <label for="floatingInput">User Name <span class="text-danger">*</span></label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" id="passkey" name="password" placeholder="Password" required>
                                    <label for="floatingPassword">Password <span class="text-danger">*</span></label>
                                </div>
                                <button type="submit" name="login" value="Sign In" class="btn btn-primary py-3 w-100 mb-4 fw-bold">Sign In</button>
                               
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header">
        <div>
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
                </g>
            </svg>
        </div>
        <div class=" fw-bold" style="display: flex;align-items: center;justify-content: center;width: 100%;position: relative;bottom: 15px;height: 7px;">
            <small> <span style="color: black;">Developed By. </span> <a href="https://www.linkedin.com/in/lomashrishi/" target="_blank"> LomashRishi</a><span style="color: black;"> | All Rights Reserved</span></small>
        </div>
    </div>
   
        

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- <script src="js/main.js"></script> -->
    <script src="js/custom.js"></script>
</body>

</html>