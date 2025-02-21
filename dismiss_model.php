<?php
    include("includes/connect.php");

    if (!isset($_SESSION["admin_id"])) {
        header("Location:index.php?lgn=false");
        exit(); // Ensure script execution is stopped after redirect
    }

    if (isset($_POST['id'])) { 
        // Check if 'id' is set in POST request 
        $id = mysqli_real_escape_string($conn, $_POST['id']);
         // Sanitize the input to prevent SQL injection 
         $sql = "SELECT * FROM model_tbl WHERE id = '$id'"; 
         $result = mysqli_query($conn, $sql); if (mysqli_num_rows($result) > 0) { $row = mysqli_fetch_assoc($result); 
            $status = $row['status']; if ($status == '0') { $deactivate = "UPDATE model_tbl SET status = 1 WHERE id = '$id'"; 
                if (mysqli_query($conn, $deactivate)) { 
                    header("Location: all_models.php?msg=deactivate_success"); 
                } else { 
                    header("Location: all_models.php?error=deactivate_failed"); } } else { $activate = "UPDATE model_tbl SET status = 0 WHERE id = '$id'"; if (mysqli_query($conn, $activate)) { header("Location: all_models.php?msg=activate_success"); } else { header("Location: all_models.php?error=activate_failed"); } } } else { $error_msg = "<div class='alert alert-danger'>ID not provided or does not exist in database</div>"; echo $error_msg; } } else { $error_msg = "<div class='alert alert-danger'>ID not provided or does not exist in database</div>"; echo $error_msg; }// Display error message if ID is not provided }
?>
