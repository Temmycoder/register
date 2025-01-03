<?php
    include("includes/connect.php");

    if(isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"])){
        $key = $_GET["key"];
        $email = $_GET["email"];
        $curr_date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "SELECT * FROM code_reset_tbl WHERE key = '' . $key . ");
        $row = mysqli_num_rows($query);

        if($row == 0){
            $error_msg = "<h2>Invalid Link</h2>";
        }
        else{
            $row = mysqli_fetch_assoc($query);
            $exp_date = $row['exp_date'];
            if($exp_date < $curr_date){
                $error_msg = "<h2 class='alert alert-danger'>Link has expired</h2>";
            }
            else{
                if(isset($_POST['change'])){
                    $user_id = $_SESSION['user_id'];
                    $new = $_POST['new'];
                    $confirm = $_POST['confirm'];
                    $curr_date = date("Y-m-d H:i:s");
            
                        if($confirm != $new){
                            $error_msg = "<div class='alert alert-danger'>New Password and confirm password do not match</div>";
                        }
                        else{
                            $new = md5($new);
                            $update = mysqli_query($conn, "UPDATE registration_tbl SET password = '$new' WHERE SN = '$user_id'");
                            if ($update)
                            {
                                $success ="<div class='alert alert-success'>Password has been changed successfully</div>";
                            }
            
                        }
                }
                
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Reset Password</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/all.css">
    </head>
    <body>
        <div class="container">
        <h2>Reset Password</h2>
        <?php
        "<title>Change Password</title>
            <link rel='stylesheet' type='text/css' href='css/bootstrap.css'>
            <link rel='stylesheet' type='text/css' href='css/all.css'>

            <script type='text/javascript' src='js/all.js'></>

            <style>
                .box{
                    border-radius: 7px;
                    font-size: 20px;
                    margin: 40px 11cm 0 8cm;
                    padding: 70px 30px 50px 30px;
                    border: none;
                }
            </style>

            <h1 class='pt-5 text-center'>Change Password</h1>
            <div class='box'>
                <?php echo $error_msg; echo $success?>
                <form method='post'>
                    <label>New Password:</label>
                    <input type='password' name='new' id='new' maxlength='8' minlength='8' class='form-control' required><br>
                    <label>Confirm New Password:</label>
                    <input type='password' name='confirm' id='confirm' maxlength='8' minlength='8' class='form-control' required><br><br>
                    <div class='text-center'>
                        <input type='submit' name='change' value='Change Password' class='btn btn-primary'>
                    </div>
                </form>
            </div>";
        ?>
    </body>
</html>