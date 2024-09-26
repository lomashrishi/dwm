<?php
// print_r($conn);
$username=$_SESSION['username'];
$profile_picture = getvalfield($conn, "adminlogin", "profile_picture", "username='$username'");
?>

 <!-- Sidebar Start -->
 <div class="sidebar pe-4 pb-3 bg-warning text-light" style="color:white;">
     <nav class="navbar text-white navbar-light">
         <a href="../dash" class="navbar-brand mx-4 mb-3">
             <h3 class="text-white fw-bold text-center text-decoration-underline mb-0 pb-0">MCD-DASH</h3>
             <small class="text-white  text-center m-0 p-0">Maruti Computers</small>
         </a>
         <div class="d-flex align-items-center ms-2 mb-4" style="height: 50px; width: 185px; justify-content: center;">
             <div class="ms-0 d-flex">
             <img class="rounded me-lg-2" src="../dash/<?=$profile_picture?>" alt="" style="width: 50px; height: 55px;">
                 <h5 class="mb-0 text-light mt-3 text-capitalize"><?=$username;?> <sup class="text-success fw-bolder">*</sup></h5>
             </div>
         </div>
         <div class="navbar-nav w-100">
             <a href="../dash" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
             <!-- For आवेदन -->

             <a href="../Daily-Task/" class="nav-item nav-link mt-2"><i class="fa-solid fa-file-circle-plus me-2"></i>Add New Work</a>
             <a href="../Daily-Task/pending-work.php" class="nav-item nav-link mt-2"><i class="fa-regular fa-rectangle-list me-2"></i>Pending Work</a>
             <a href="../Daily-Task/processing-work.php" class="nav-item nav-link mt-2"><i class="fa-solid fa-list-check me-2"></i>Processing Work</a>
             <a href="../Daily-Task/completed-work.php" class="nav-item nav-link mt-2"><i class="fa-solid fa-check-to-slot me-2"></i>Completed Work</a>
             <a href="../Daily-Task/rejected-work.php" class="nav-item nav-link mt-2"><i class="fa-solid fa-square-xmark me-2 text-danger"></i>Rejected Work</a>
             <a href="../Daily-Task/pending-amount.php" class="nav-item nav-link mt-2"><i class="fa-solid fa-hand-holding-dollar me-2"></i>Pending Amount</a>
             <a href="../dash/profile.php" class="nav-item nav-link mt-2"><i class="fas fa-cog me-2"></i>Settings</a>


                    <!-- रिपोर्ट-->
            <!-- <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-chart-column"></i> रिपोर्ट </a>
                 <div class="dropdown-menu bg-transparent border-0">
                     <a href="../report" class="dropdown-item"><b>रिपोर्ट जनरेट करें </b></a>
                 </div>
             </div> -->

             <!-- सेटिंग्स -->
            

             <!-- हेल्प -->
             <!-- <a href="../help/" class="nav-item nav-link"><i class="fa-regular fa-circle-question me-2"></i>Help?..</a> -->

         </div>
     </nav>
 </div>
 <!-- Sidebar End -->