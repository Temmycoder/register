<?php
    include("includes/connect.php");

    if (!isset($_SESSION["admin_id"])) {
        header("Location:index.php?lgn=false");
    }

    if (isset($_POST['id'])) { 
        $id = $_POST['id'];
        $sql = mysqli_query($conn, "SELECT * FROM model_tbl WHERE id = '$id'");

        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $status = $row["status"];

            if($status =="0") {
                $sql = mysqli_query($conn,"UPDATE model_tbl SET status = '1' WHERE id = $id");
            }
            else{
                $sql = mysqli_query($conn,"UPDATE model_tbl SET status = '0' WHERE id = $id");
            }
        }
    }
    
?>
