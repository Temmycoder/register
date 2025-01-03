<?php
    include("includes/connect.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/PHPMailer/src/Exception.php';
    require 'PHPMailer/PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/PHPMailer/src/SMTP.php';
    require 'vendor/autoload.php';

    if (isset($_POST['reg'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $code = $_POST['code'];
        $confam =$_POST['confam'];
        $gen = $_POST['gen'];
        $course = $_POST['course'];
        $state = $_POST['state'];
        $time = date('Y-m-d H:i:s');

        $enc_code = password_hash($code,PASSWORD_DEFAULT);
        
        //email check  
        $email_check = mysqli_query($conn, "SELECT * from registration_tbl WHERE email = '$email'");
        $email_num = mysqli_num_rows($email_check);

        if(($email_num) < 1){

            if($code != $confam){
                $error_msg= "<div class='alert alert-danger'>Passwords do not match!</div>";
            // exit();
            }
            
            else{
                $image_loc = "img/passport/";
                $file_name = $_FILES['passport']['name'];
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $newfile_name = uniqid('cka_', true) . "." . $file_ext;
                $target_path = $image_loc . $newfile_name;

                move_uploaded_file($_FILES['passport']['tmp_name'], $target_path);
        
                $sql = "INSERT INTO registration_tbl (first_name, last_name, email, dob, password, gender, course, state, passport, time_registered)
                values('$fname', '$lname', '$email', '$dob', '$enc_code', '$gen', '$course', '$state', '$target_path','$time')";
                
                if(mysqli_query($conn, $sql)){
                   
                    $mail = new PhpMailer(true);
                    try{
                        $mail->isSMTP();
                        $mail->Host ='mail.ariespoly.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'test@ariespoly.com';
                        $mail->Password = 'Temp_Pass123';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        $mail->Port = 465;

                        $mail->setFrom('test@ariespoly.com','Temmy Coder');
                        $mail->addAddress($email);

                        $mail->isHTML(true);
                        $mail->Subject = 'Registration Successful';
                        $mail->Body = "Your Registration has been Successful! <br> Login Details: <br> Email: $email <br> Password: $code";
                        $mail->send();
                        $success = "<div class='alert alert-success'>Registration details sent to email address</div>";
                    }
                    catch (Exception $e){
                        $error_msg = "Email could not be sent";
                    }
                    header("Location:index.php?sgn=success");
                }
                else{
                    $error_msg ="<div class='alert alert-danger'>registration has failed</div>";
                }
            }
        }
        else{
            $error_msg ="<div class='alert alert-danger'>Email Address already taken !</div>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>FORM</title>
</head>
<style>
    .form{
        border: none;
        text-align: left;
        line-height: 20px;
        border-radius: 4px;
        font-size: larger;
        background-color: #eee;
        margin: 40px 300px;
        padding: 70px 30px 50px 30px;
    }

    .regs{
        text-align: center!important;
    }   

    .for{
        border-radius: 6px;
        width: 30%;
        border: none;
    } 
</style>
<body>
    
    <div class="form">
        <form method="post" enctype="multipart/form-data">
            <hr>
            <div class="row">
                <?php echo $success;?>

                <?php echo $error_msg; ?>
                <div class="col-6">
                    <label>First Name:</label>
                    <input type="text" id="fname" name="fname" required class="form-control">
                </div>
                <div class="col-6">
                    <label>Last Name:</label>
                    <input type="text" id="lname" name="lname" required class="form-control">
                </div>
            </div>  
            <br><br>
            <label>Email:</label>
            <input type="email" id="email" name="email" required class="form-control">
            <br><br>
            <label>DOB:</label>
            <input type="date" id="dob" name="dob" required class="form-control">
            <br><br>
            <label>Password: </label><span style="color:blue;"> 8 Characters required</span>
            <input type="password" name="code" id="code" maxlength="8" minlength="8" required class="form-control">
            <br><br>
            <label>Confirm Password:</label>
            <input type="password" name="confam" id="confam" maxlength="8" minlength="8" required class="form-control">
            <br><br>
            <label>Gender:</label><br><br>
            <input type="radio" id="gen" name="gen" value="Male" required> Male &nbsp;&nbsp;
            <input type="radio" id="gen" name="gen" value="Female" required> Female &nbsp;&nbsp;
            <input type="radio" id="gen" name="gen" value="Other"required> Other &nbsp;&nbsp;
            <br><br><br>
            <label>Course:</label>
            <input type="text" id="course" name="course" required class="form-control">
            <br><br>
            <label>State of Residence:</label><br><br>
            <select name="state" required class="for">
                <option value="">----</option>
                <option value="Ibadan">Ibadan</option>
                <option value="Abia">Abia</option>
                <option value="Lagos">Lagos</option>
                <option value="Abuja">Abuja</option>
                <option value="calabar" >calabar</option>
                <option value="bauchi" >bauchi</option>
                <option value="sokoto" >sokoto</option>
                <option value="Osun" >Osun</option>

            </select>
            <br><br><br>
            <label>Upload form:</label>   <span style="color:red;">jpg files only</span><br> <br>
            <input type="file" name="passport" id="passport" required class="form-control">
           
          
            <br><br>

            <div class="regs">
                <input type="submit" value="Register" name="reg" class="pt-2 pb-2 ps-4 pe-4 btn btn-primary">
            </div><br><br>
            <div class="">
                <a href="index.php" target="blank">Already have an account? Login</a>
            </div>
        </form>
    </div>
</body>
<script src="js/all.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
</html>