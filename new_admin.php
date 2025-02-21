<?php
    include("includes/connect.php");
    
    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;
    // require 'PHPMailer/PHPMailer/src/Exception.php';
    // require 'PHPMailer/PHPMailer/src/PHPMailer.php';
    // require 'PHPMailer/PHPMailer/src/SMTP.php';
    // require 'vendor/autoload.php';

    if(!isset($_SESSION["admin_id"])){
        header("Location:index.php?lgn=false");
    }

    if (isset($_POST['reg'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $code = $_POST['code'];
        $confam =$_POST['confam'];
        $uname =$_POST['uname'];
        $role =$_POST['role'];
        $time = date('Y-m-d H:i:s');
        $created_by = $_SESSION['f_name'];

        $enc_code = password_hash($code,PASSWORD_DEFAULT);
        
        //email check  
        $email_check = mysqli_query($conn, "SELECT * from users_tbl WHERE email = '$email'");
        $email_num = mysqli_num_rows($email_check);

        if(($email_num) < 1){

            if($code != $confam){
                $error_msg= "<div class='alert alert-danger'>Passwords do not match!</div>";
            }
            
            else{
                $sql = "INSERT INTO users_tbl (first_name, last_name, email, password, username, role, time, created_by)
                values('$fname', '$lname', '$email', '$enc_code', '$uname', '$role', '$time', '$created_by')";
                
                if(mysqli_query($conn, $sql)){
                   
                    // $mail = new PhpMailer(true);
                    // try{
                    //     $mail->isSMTP();
                    //     $mail->Host ='mail.ariespoly.com';
                    //     $mail->SMTPAuth = true;
                    //     $mail->Username = 'test@ariespoly.com';
                    //     $mail->Password = 'Temp_Pass123';
                    //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    //     $mail->Port = 465;

                    //     $mail->setFrom('test@ariespoly.com','Temmy Coder');
                    //     $mail->addAddress($email);

                    //     $mail->isHTML(true);
                    //     $mail->Subject = 'Registration Successful';
                    //     $mail->Body = "Your Registration has been Successful! <br> Login Details: <br> Email: $email <br> Password: $code";
                    //     $mail->send();
                    //     $success = "<div class='alert alert-success'>Registration details sent to email address</div>";
                    // }
                    // catch (Exception $e){
                    //     $error_msg = "<div class='alert alert-danger'>Email could not be sent</div>";
                    // }
                    $success = "<div class='alert alert-success'>Registration Successful</div>";

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
    <link rel="stylesheet" type="text/css" href="adminboard.css">
    <title>FORM</title>
</head>
<body>
    
    <div class="wrapper">
        <div class="body-overlay"></div>
        <?php include("includes/sidebar.php");?>

        <div id="content">
            <?php include("includes/header.php");?>

            <div class="main-content">
                <div class="form">
                    <h1 class="my-5 mx-5">Sign Up An Admin</h1>
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <?php echo $success;?>

                            <?php echo $error_msg; ?>
                            <div class="col-lg-4">
                                <label>First Name:</label>
                                <input type="text" id="fname" name="fname" required class="form-control">
                            </div>
                            <div class="col-lg-4">
                                <label>Last Name:</label>
                                <input type="text" id="lname" name="lname" required class="form-control">
                            </div>
                        </div>  
                        <br><br>

                        <div class="row">
                            <div class="col-lg-8">
                            <label>Email:</label>
                            <input type="email" id="email" name="email" required class="form-control">
                            <br><br>
                            </div>    
                        </div>

                        <div class="row">
                            <div class="col-lg-8">
                            <label>Password: </label><span style="color:blue;"> 8 Characters required</span>
                            <input type="password" name="code" id="code" maxlength="8" minlength="8" required class="form-control">
                            <br><br>
                            </div>    
                        </div>

                        <div class="row">
                            <div class="col-lg-8">
                            <label>Confirm Password:</label>
                            <input type="password" name="confam" id="confam" maxlength="8" minlength="8" required class="form-control">
                            <br><br>
                            </div>    
                        </div>

                        <div class="row">
                            <div class="col-lg-8">
                            <label>Username: </label>
                            <input type="text" name="uname" id="uname"required class="form-control">
                            <br><br>
                            </div>    
                        </div>

                        <div class="row">
                            <div class="col-lg-8">
                            <label>Role: </label>
                            <input type="text" name="role" id="role"required class="form-control">
                            <br><br>
                            </div>    
                        </div>
                        
                        <div>
                            <input type="submit" value="Register" name="reg" class="pt-2 pb-2 ps-4 pe-4 btn btn-primary">
                        </div><br><br>
                    </form>
                </div>
            </div>
            <!-------------footer------------>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <nav class="d-flex justify-content-center justify-content-md-start">
                                <ul class="m-0 p-0">
                                    <li><a href="#" id="">Home</a></li>
                                    <li><a href="#" id="">Company</a></li>
                                    <li><a href="#" id="">Portfolio</a></li>
                                    <li><a href="#" id="">Blogs</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-md-6">
                            <p class="copyright d-flex md-end justify-content-center">
                                &copy; 2024 Design By &nbsp;
                                <a href="http://github.com/TemmyCoder">TemmyCoder</a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
    <script type="text/javascript" src="js/all.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script src="js/jquery-3.7.1.js"></script>
    <script type="text/javascript">

        $(document) .ready(function(){
            $("#sidebar-collapse") .on('click',function(){
                $('#sidebar') .toggleClass('active');
                $('#content') .toggleClass('active');
            });

            $(".more-button,.body-overlay") .on('click',function(){
                $("#sidebar,.body-overlay") .toggleClass('show-nav');
            });
        });

    </script>
</html>