<?php
    include("includes/connect.php");

    if(isset($_GET['lgn'])){
        $error_msg ="<div class='alert alert-danger'>Access Denied! Please Login. </div>";
    }

    if (isset($_POST['login'])){
        $code = $_POST['code'];
        $email = $_POST['email'];   
        $sql ="SELECT * FROM users_tbl WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        
        //checks if user exists in database
        if ($data = mysqli_num_rows($result) < 1){
            $error_msg ="<div class='alert alert-danger'>Invalid Email Address</div>";
        }
        
        else{
            $row = mysqli_fetch_assoc($result);

            if (password_verify($code, $row['password'])){

                $_SESSION['f_name']= $row['first_name'];
                $_SESSION['l_name']= $row['last_name'];
                $_SESSION['admin_id']= $row['id'];
                $_SESSION['profile_pic']= $row['passport'];

                header ("Location:dashboard.php");
            }
            else{
                $error_msg ="<div class='alert alert-danger'>Invalid Password</div>";
            }
        }
    }
?>
<style>
    .page{
        border: none;
        text-align: left;
        line-height: 20px;
        border-radius: 10px;
        font-size: 26px;
        padding: 50px;
        box-shadow: 2px 2px 50px rgb(189, 180, 180);
        background-color: #eee;
        width: auto;
    }

    @media screen and (min-width: 992px) {
        .page{
            width: 50% !important;
        }
    }
    
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css">
    <title>Document</title>
</head>
<body>
    <div class="row container mt-5">
        <div class="col-1 col-md-3 col-lg-4"></div>

        <div class="col-11 col-md-8 col-lg-4 page">
            <span class="text-center"><h1 class="mb-4">Login Form</h1></span>
            <form method="post" class="container">

                <?php echo "$error_msg"; echo "$success"; ?>

                <label>E-mail:</label><br><br>
                <input type="email" name="email" id="email" class="form-control" autofocus><br><br>

                <label>Password:</label><br><br>
                <input type="password" name="code" id="code" class="form-control"><br><br>

                <div class="d-md-flex">
                    <div class="mb-3 mb-md-0">
                        <input type="submit" name="login" value="Login" class="ps-3 pe-3 pb-1 pt-1 btn btn-primary">
                    </div>
                    <div class="ms-auto"><h5><a href="forgotcode.php" target="blank">Forgot Password!</a></h5></div>
                </div>

            </form>
        </div>

        <div class="col-auto col-md-auto col-lg-4"></div>
    </div>
</body>
<script type="text/javascript" href="css/bootstrap.css"></script>

</html>