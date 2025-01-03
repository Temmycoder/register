<?php
    include("includes/connect.php");

    if(!isset($_SESSION["user_id"])){
        header("Location:index.php?lgn=false");
    }
    
    if(isset($_SESSION['user_id'])){

        $user_id = $_SESSION['user_id'];
        $get_details = mysqli_query($conn, "SELECT * FROM registration_tbl WHERE SN = '$user_id'");
        $results= mysqli_fetch_assoc($get_details);

        $first_name=$results['first_name'];
        $last_name=$results['last_name'];
        $email = $results['email'];
        $pic= $results['passport'];
        $state= $results['state'];
    }

    else{
       header("Location:index.php?lgn=false");
    }

    if(isset($_POST['enter'])){

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $state_of_origin = $_POST['state'];
        $email_address = $_POST['email'];

        $img_dir = "img/passport/";
        $pic_name = $_FILES['passport']['name'];
        $pic_extension = pathinfo($pic_name, PATHINFO_EXTENSION);
        $new_name = uniqid("file_", true). "." . $pic_extension;
        $pic_path = $img_dir . $new_name;
        move_uploaded_file($_FILES['passport']['tmp_name'], $pic_path);

        $upd = mysqli_query($conn, "UPDATE registration_tbl SET first_name ='$fname', last_name ='$lname',
        email ='$email_address', state ='$state_of_origin', passport ='$pic_path' WHERE SN = '$user_id'");

        if($upd){
            $success ="<div class='alert alert-success'>Update was successful</div>";
        }
        else{
            $error_msg ="<div class='alert alert-danger'>Update failed! try again please</div>";
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/all.css">
</head>

    <style>
        
    </style>
<body>
    <?php include('includes/sidebar.php');?>
    <main>
        <?php include('includes/header.php');?>

        <h1 class="pt-5">Update Profile</h1>
        
        <div class="box pt-5" style="margin-right: 10cm;">

            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <?php echo $success;?>
                    <?php echo $error_msg;?>
                    <div class="col-6">
                        <label>First Name:</label>
                        <input type="text" id="fname" name="fname" value="<?php echo $first_name; ?>"
                        required class="form-control">
                    </div>
                    <div class="col-6">
                        <label>Last Name:</label>
                        <input type="text" id="lname" name="lname" value="<?php echo $last_name; ?>" required class="form-control">
                    </div>
                </div>
                <br>
                <label>Email:</label>
                <input type="email" id="email" value="<?php echo $email; ?>" name="email" required class="form-control">
                <br>
                <label>State of Residence:</label><br><br>
                <select name="state" id="state" required class="form-control">
                    <option value="<?php echo $state;?>"><?php echo $state;?></option>
                    <option value="Ibadan">Ibadan</option>
                    <option value="Abia">Abia</option>
                    <option value="Lagos">Lagos</option>
                    <option value="Abuja">Abuja</option>
                    <option value="calabar" >calabar</option>
                    <option value="bauchi" >bauchi</option>
                    <option value="sokoto" >sokoto</option>
                    <option value="Osun" >Osun</option>

                </select>
                <br><br>
                <label>File:</label>  <span style="color:red;"> jpg files only</span><br> <br>

                <img src="<?php echo $pic;?>" width=100 height=100 class="bg-white"><br><br>
                <input type="file" name="passport" id="passport" required class="form-control">
                <br><br>

                <div class="regs text-center">
                    <input type="submit" value="Update Profile" name="enter" class="pt-2 pb-2 ps-4 pe-4 btn btn-primary">
                </div>
            </form>
        </div>
    </main>
    <script type="text/javascript" src="js/all.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>
   
</html>