<?php
    include("includes/connect.php");
    
    if(!isset($_SESSION['admin_id'])){
        header("Location:index.php?lgn=false");
    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = mysqli_query($conn, "SELECT * FROM model_tbl WHERE id = '$id'");
        $row = mysqli_fetch_assoc($sql);
        $full_name = $row['full_name'];
        $old_email = $row['email'];
        $old_age = $row['age'];
        $username = $row['username'];
        $old_pic = $row['pic'];
    }
    else{
        header("Location:all_models.php");
    }

    if (isset($_POST['reg'])){
        $fname = $_POST['fname'];
        $email = $_POST['email'];
        $uname = $_POST['username'];
        $dob = $_POST['dob'];
        $gen = $_POST['gen'];
        $created_time = date('Y-m-d H:i:s');
        $status = 1;
        
        //email check  
        $email_check = mysqli_query($conn, "SELECT * from model_tbl WHERE email = '$email'");
        $email_num = mysqli_num_rows($email_check);

        if(($email_num) < 1 ){
            $image_loc = "img/passport/";
            $file_name = $_FILES['passport']['name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $newfile_name = uniqid('cka_', true) . "." . $file_ext;
            $target_path = $image_loc . $newfile_name;

            move_uploaded_file($_FILES['passport']['tmp_name'], $target_path);
    
            $sql = mysqli_query ($conn, "UPDATE model_tbl SET full_name = '$fname', email = '$email', 
            username = '$username', age = '$dob', gender = '$gen', created_time = '$created_time', pic = '$target_path' 
            WHERE id = '$id'");
            
            if($sql) {
                header("Location:all_models.php");
            }
            else {
                $error_msg ="<div class='alert alert-danger'>Sign Up Failed !</div>";
            }
        }
        else{
            $error_msg ="<div class='alert alert-danger'>Email Address already taken !</div>";
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Dashboard</title>
        <meta name="generator" content="Hugo 0.122.0">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/all.css">
        <link rel="stylesheet" type="text/css" href="adminboard.css">
    </head>

    <body>
        <div class="wrapper">
            <div class="body-overlay"></div>
            <?php include("includes/sidebar.php");?>

            <div id="content">
                <?php include("includes/header.php");?>

                <div class="main-content">
                    <div class="form">
                        <h1 class="my-5 mx-5">Sign Up A New Model</h1>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <?php echo $success;?>
                                <?php echo $error_msg; ?>

                            </div>  
                            <br><br>

                            <div class="row">
                                <div class="col-lg-8">
                                <label>Full Name:</label>
                                <input type="text" value="<?php echo $full_name; ?>" id="fname" name="fname" required class="form-control">
                                <br><br>
                                </div>    
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                <label>Email:</label>
                                <input type="email" value="<?php echo $old_email; ?>" id="email" name="email" required class="form-control">
                                <br><br>
                                </div>    
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                <label>Username:</label>
                                <input type="text" value="<?php echo $username; ?>" id="username" name="username" required class="form-control">
                                <br><br>
                                </div>    
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                <label>Age:</label>
                                <input type="number" value="<?php echo $old_age; ?>" id="dob" name="dob" required class="form-control">
                                <br><br>
                                </div>    
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                <label>Gender:</label><br><br>
                                <input type="radio" id="gen" name="gen" value="Male" required> Male &nbsp;&nbsp;
                                <input type="radio" id="gen" name="gen" value="Female" required> Female &nbsp;&nbsp;
                                <input type="radio" id="gen" name="gen" value="Other"required> Other &nbsp;&nbsp;
                                <br><br><br>
                                </div>    
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                <img src="<?php echo $old_pic; ?>" width="60"/>&nbsp;&nbsp;&nbsp;
                                <label>Upload image:</label><span style="color:red;">jpg files only</span><br> <br>
                                <input type="file" name="passport" id="passport" required class="form-control">
                                <br><br>
                                </div>    
                            </div>
                            
                            <div class="regs">
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