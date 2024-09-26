<?php

// get value from any condition //
function getvalfield($con, $table, $field, $where)
{
    if ($where == "")
        $where = 1;

    $sql = "select $field from $table where $where";

    //echo $sql."<br>";
    $getvalue =  mysqli_query($con, $sql);
    $getval   =  mysqli_fetch_row($getvalue);

    return $getval[0];
}

//get random otp 
function generateOTP($length)
{
    $digits = '0123456789';
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= $digits[rand(0, strlen($digits) - 1)];
    }
    return $otp;
}

//for send otp
function sendOTP($phoneNumber, $otp)
{
    $apiKey = "xUNYy9lqpgK2V1vz";
    $senderId = "SBJSWL";
    $message = urlencode("Dear User, Your login OTP is $otp  .This OTP will expire in 5 minutes. SBJSWL www.shyambiharijaiswal.in");
    $url = "http://216.48.183.136/vb/apikey.php?apikey=$apiKey&senderid=$senderId&number=$phoneNumber&message=$message";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

//for store
function storeOTP($conn, $phoneNumber, $otp, $status)
{
    $date = new DateTime('now', new DateTimeZone('Asia/Kolkata')); // Set the timezone to Indian time
    $dateTime = $date->format('Y-m-d H:i:s');

    $newDate = clone $date; // Create a copy of the current date
    $newDate->modify('+5 minutes'); // Add 5 minutes to the current date
    $newDateTime = $newDate->format('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO otps (phone_number, otp, valid_time, otpSend_status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $phoneNumber, $otp, $newDateTime, $status);
    $stmt->execute();
    $stmt->close();
}

function generateEnquiryNumber($conn, $tblname, $prefix)
{
    // Get the count of existing entries in the table
    $query = "SELECT COUNT(*) as count FROM $tblname";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    // Generate the enquiry number
    $enquiryNumber = $prefix . sprintf('%003d', $count + 1);

    return $enquiryNumber;
    // print_r($enquiryNumber);
}


// Function to check if the file exists and the path is not empty
function checkFileExists($filePath){
    return !empty($filePath) && file_exists($filePath);
}

// Function to delete an existing file
function delete_existing_file($file_path){
    if (is_file($file_path)) {
        unlink($file_path);
    }
}

function handleFileUpload($fileInputName, $target_dir, $maxSize, $allowedTypes, $customFileName = null){
    $uploadOk = 1;
    $errorMsg = "";

    
    $file = $_FILES[$fileInputName];
    $fileExtension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    // If custom file name is provided, use it; otherwise, use the original file name
    if ($customFileName) {
        $target_file = $target_dir . $customFileName . "." . $fileExtension;

    } else {
        $target_file = $target_dir . basename($file["name"]);
    }
    // echo 'vaibhav---'.$target_file;
    if (!empty(basename($file["name"]))) {
        // Check if the file already exists
        if (checkFileExists($target_file)) {
            // Delete the existing file
            delete_existing_file($target_file);
        }

        // Check file size
        if ($file["size"] > $maxSize) {
            $errorMsg .= "<script>alert('Sorry, your file is too large (limit is " . ($maxSize / 1000000) . " MB).')</script>";
            $uploadOk = 0;
        }

        // Check file type
        if (!in_array($fileExtension, $allowedTypes)) {
            $errorMsg .= "<script>alert('Sorry, only " . implode(", ", $allowedTypes) . " files are allowed.')</script>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo $errorMsg;
            return false;
        } else {
            // Try to upload file
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return ['success' => true, 'filePath' => $target_file];
            } else {
                return ['success' => false, 'filePath' => ''];
            }
        }
    }
}
