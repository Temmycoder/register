<?php
    include("includes/connect.php");

    if (!isset($_SESSION["admin_id"])) {
        header("Location:index.php?lgn=false");
        exit(); // Ensure script execution is stopped after redirect
    }

    if (isset($_POST['id'])) { // Check if 'id' is set in POST request
        $id = $_POST['id'];

        $delete = "DELETE FROM model_tbl WHERE id = '$id'";

        if (mysqli_query($conn, $delete)) {
            header("Location: all_models.php?msg=deletion_success");
        } else {
            header("Location: all_models.php?error=deletion_failed");
        }
    } else {
        $error_msg = "<div class='alert alert-danger'>ID not provided or does not exist in database</div>";
        echo $error_msg; // Display error message if ID is not provided
    }
?>
