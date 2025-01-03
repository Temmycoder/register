<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/PHPMailer/src/Exception.php';
    require 'PHPMailer/PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/PHPMailer/src/SMTP.php';
    require 'vendor/autoload.php';

    function generateRandomPassword($length = 8){
        return substr(str_shuffle('0123456789'), 0, $length);
    }

    include('includes/connect.php');
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $result = mysqli_query($conn, "SELECT * FROM registration_tbl WHERE email = '$email'");
        if(mysqli_num_rows($result) > 0){
            
            $newPassword = generateRandomPassword();
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the user's password in the database
            $rec_email = $email;
            $updateQuery = "UPDATE registration_tbl SET password = '$hashedPassword' WHERE email = '$email'";
            $result = mysqli_query($conn, $updateQuery);


            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host       = 'mail.ariespoly.com';                 // Specify main and backup SMTP servers
                $mail->SMTPAuth   = true;                             // Enable SMTP authentication
                $mail->Username   = 'test@ariespoly.com';               // SMTP username
                $mail->Password   = 'Temp_Pass123';                     // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      // Enable TLS encryption, ssl also accepted
                $mail->Port       = 465;                              // TCP port to connect to

                //Recipients
                $mail->setFrom('test@ariespoly.com', 'Temmy Coder');
                $mail->addAddress($rec_email,);     // Add a recipient

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Password Reset Request';
                $mail->Body    = "Your new password is: <b>$newPassword</b>";
                $mail->AltBody = "Your new password is: $newPassword";

                $mail->send();
                $success = "<div class='alert alert-success'>Password reset email has been sent</div>";
            } catch (Exception $e){
                $error_msg = "<div class='alert alert-danger'>Password reset email could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";

            }
        }
        else{
            $error_msg = "<div class='alert alert-danger'>No such email found</div>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset-Password</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/all.css">
</head>
<style>
    .margin{
        margin: 1cm 0 0 13cm;
    }
    .inputin{
        border-radius: 7px;
        border: 1px solid #ccc;
    }
    .intern{
        display: flex;
    }
</style>
<body>
    <main>
        <h1 class="py-5 text-center">Reset Password</h1>
        <?php 
            echo $error_msg;
            echo $success;
        ?>
        <div class="margin">
            <form method="post">
                <label class="fs-4">Registered Email Address:</label><br><br>
                <input type="email" name="email" id="email" maxlength="30" required style="width: 50%;" class="inputin"><br><br>
                <div>
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                </div>
                <div class="fs-5 mt-3 intern">
                    <div>
                        <a href="form.php" target="blank">Don't have an account? Sign-up.</a>
                    </div>
                    <div style="margin-left: 4cm;">
                        <a href="index.php" target="blank" class="ms-auto">Login</a>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>

<script src="js/all.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
</html>