<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php


// Get the raw POST data
$postData = file_get_contents('php://input');
$request = json_decode($postData, true);

if (isset($request['id']) && isset($request['table']) && isset($request['key'])) {
    $id = $request['id'];
    $table = $request['table'];
    $key = $request['key'];

    // Ensure both ID and table name are safe to use in a SQL query
    $id = mysqli_real_escape_string($conn, $id);
    $table = mysqli_real_escape_string($conn, $table);

    // SQL to delete the record from the specified table
    $sql = "DELETE FROM `$table` WHERE $key='$id'";

    if (mysqli_query($conn, $sql)) {
        // Record deleted successfully
        echo "Record deleted successfully.";
    } else {
        // Error deleting record
        echo "Error deleting record: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
?>
