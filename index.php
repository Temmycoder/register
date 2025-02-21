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
        font-size: 30px;
        margin: 60px 350px 0;
        padding: 50px 30px;
        box-shadow: 2px 2px 50px rgb(189, 180, 180);
        
    }
    .log{
        text-align: center;
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
    <div class="page" style="background-color: #eee; width: 18cm;">
        <div class="text-center pb-3"><h1>Admin Form<h1></div>
        <form method="post" autocomplete="off">
            <?php echo "$error_msg"; echo "$success"?> 
            <label>E-mail:</label><br><br>
            <input type="email" name="email" id="email" class="form-control"><br><br>
            <label>Password:</label><br><br>
            <input type="password" name="code" id="code" class="form-control"><br><br>
            <div class="log">
                <input type="submit" name="login" value="Login" class="ps-4 pe-4 pb-2 pt-2 btn btn-primary">
            </div><br>
            <div class="fs-5 ">
                <a href="form.php" target="blank">Don't have an account? sign-up</a>
            </div><br><br>
            <div class="fs-5">
            <a href="forgotcode.php" target="blank">Forgot Password!</a>
            </div>
        </form>
    </div>
</body>
<script type="text/javascript" href="css/bootstrap.css"></script>

</html>