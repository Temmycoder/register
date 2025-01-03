<?php
    include('includes/connect.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/PHPMailer/src/Exception.php';
    require 'PHPMailer/PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/PHPMailer/src/SMTP.php';
    require 'vendor/autoload.php';

    if(!isset($_SESSION['user_id'])){
        header("Location:index.php?lgn=false");
    }

    if(isset($_POST['change'])){
        $user_id = $_SESSION['user_id'];
        $old = $_POST['old'];
        $new = $_POST['new'];
        $confirm = $_POST['confirm'];
        $new_enc = password_hash($new, PASSWORD_DEFAULT);

        $sql = mysqli_query($conn, "SELECT * FROM registration_tbl WHERE SN = '$user_id'");
        $row = mysqli_fetch_assoc($sql);

        if (!password_verify($old, $row['password'])){
            $error_msg = "<div class='alert alert-danger'>Old Password is incorrect</div>";
        }

        else{
            if($confirm != $new){
                $error_msg = "<div class='alert alert-danger'>New Password and confirm password do not match</div>";
            }

            else{
                $update = mysqli_query($conn, "UPDATE registration_tbl SET password = '$new_enc' WHERE SN = '$user_id'");
                if ($update){
                    $success ="<div class='alert alert-success'>Password has been changed successfully</div>";
                    $mail = new PHPMailer(true);
                    try{
                        $mail->isSMTP();
                        $mail->Host = 'mail.ariespoly.com';
                        $mail->SMTPAuth = true;
                        $mail->Password = 'Temp_Pass123';
                        $mail->Username = 'test@ariespoly.com';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        $mail->Port = 465;

                        $mail->setFrom('test@ariespoly.com','Temmy Coder');
                        $mail->addAddress($row['email']);

                        $mail->isHTML(true);
                        $mail->Subject = 'Password Change';
                        $mail->Body    = "Your new password <b> $new </b> has been successfully updated";
                        $mail->AltBody = "Your new password is: $new";

                        $mail->send();
                        $success = "<div class='alert alert-success>Message has been sent to your email<div>";
                    }
                    catch(Exception $e){
                        $error_msg = "<div class='alert alert-danger'>Password change email could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
                    }
                }
                else{
                    $error_msg = "<div class='alert alert-danger'>Failed to change password! Network error</div>";
                }
            }
        }
    }
?>

<html>
<head>
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/all.css">

    <style>
        .box{
            border-radius: 7px;
            font-size: 20px;
            margin: 40px 7cm 0;
            padding: 70px 30px 50px 30px;
            border: none;
            background-color: #ddd;
            text-align: left;
        }
    </style>
</head>
<body>
    <?php include('includes/sidebar.php');?>
    <main>
        <?php include('includes/header.php');?>

        <h1 class="pt-5 text-center">Change Password</h1>
            <div class="box">
                <?php echo $error_msg; echo $success?>
                <form method="post">
                    <label>Old Password:</label>
                    <input type="password" name="old" id="old" class="form-control" required><br>
                    <label>New Password:</label>
                    <input type="password" name="new" id="new" maxlength="8" minlength="8" class="form-control" required><br>
                    <label>Confirm New Password:</label>
                    <input type="password" name="confirm" id="confirm" maxlength="8" minlength="8" class="form-control" required><br><br>
                    <div class="text-center">
                        <input type="submit" name="change" value="Change Password" class="btn btn-primary">
                    </div>
                </form>
            </div>
    </main>

    <script type="text/javascript" src="js/all.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>

</body>
</html>