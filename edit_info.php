<?php
    include("includes/connect.php");

    if(!isset($_SESSION['admin_id'])){
        header("Location:index.php?lgn=false");
    }
    
    if(isset($_SESSION['admin_id'])){

        $user_id = $_SESSION['admin_id'];
        $get_details = mysqli_query($conn, "SELECT * FROM users_tbl WHERE id = '$user_id'");
        $results= mysqli_fetch_assoc($get_details);

        $first_name=$results['first_name'];
        $last_name=$results['last_name'];
        $email = $results['email'];
        $uname = $results['username'];
        $role = $results['role'];

    }

    if(isset($_POST['enter'])){

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $state_of_origin = $_POST['state'];
        $email_address = $_POST['email'];

        $upd = mysqli_query($conn, "UPDATE users_tbl SET first_name ='$fname', last_name ='$lname',
        email ='$email_address', state ='$state_of_origin', passport ='$pic_path' WHERE id = '$user_id'");

        if($upd){
            $success ="<div class='alert alert-success'>Update was successful</div>";
        }
        else{
            $error_msg ="<div class='alert alert-danger'>Update failed! try again please</div>";
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

            <!---------Page content--------->
            <div id="content">

                <!---------top navbar design--------->

                <?php include("includes/header.php");?>
                <!--------Main-content-------->
                <div class="main-content">
                <h1 class="pt-5">Update Profile</h1>
        
                <div class="box pt-5">

                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                            <?php echo $success;?>

                            <?php echo $error_msg; ?>
                            <div class="col-lg-4">
                                <label>First Name:</label>
                                <input type="text" id="fname" name="fname" required class="form-control" value="<?php echo $first_name; ?>">
                            </div>
                            <div class="col-lg-4">
                                <label>Last Name:</label>
                                <input type="text" id="lname" name="lname" required class="form-control" value="<?php echo $last_name; ?>">
                            </div>
                        </div>  
                        <br><br>

                        <div class="row">
                            <div class="col-lg-8">
                            <label>Email:</label>
                            <input type="email" id="email" name="email" required class="form-control" value="<?php echo $email; ?>">
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
                            <input type="text" name="uname" id="uname"required class="form-control" value="<?php echo $uname; ?>">
                            <br><br>
                            </div>    
                        </div>

                        <div class="row">
                            <div class="col-lg-8">
                            <label>Role: </label>
                            <input type="text" name="role" id="role" required class="form-control" value="<?php echo $role; ?>">
                            <br><br>
                            </div>    
                        </div>
                        
                        <div class="regs">
                            <input type="submit" value="Submit" name="enter" class="pt-2 pb-2 ps-4 pe-4 btn btn-primary">
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