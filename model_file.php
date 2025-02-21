<?php
    include("includes/connect.php");

    if(!isset($_SESSION["admin_id"])){
        header("Location:index.php?lgn=false");
    }
    
    if(!isset($_GET["id"])){
        header("Location:all_models.php?lgn=false");
    }else{
        $id = $_GET["id"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content</title>
    <link rel="stylesheet" href="css/all.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="adminboard.css">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
</head>
<style>
    button{
        border: none;
    }
    .round{
        border-radius: 100%;
        width: 100%;
        height: 90%;
    }
    
</style>
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

            <h2 class="my-5"></h2>
            <?php echo "$success"; echo "$error_msg";
            $sql = "SELECT * FROM model_tbl WHERE id = $id";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);

            if($row['status'] == '1'){
                $status = 'Active';
            }else{
                $status = 'Inactive';
            }

            echo "<div class='row ms-md-5'>
                <div class='col-md-4'>
                    <img class='img-fluid round' src=".$row['pic']." />
                </div>
                <div class='col-auto'>
                </div>
                <div class='col-md-7 mt-md-5 pt-md-5'>
                    <h4>Name: ".$row['full_name']."</h4> 
                    <h4>Nickname: ".$row['username']."</h4> 
                    <h4>Age: ".$row['age']."</h4> 
                    <h4>Votes: ".$row['votes']."</h4> 
                    <h4>Status: ".$status."</h4> 
                    <h4>Email: ".$row['email']."</h4> 
                </div>
            </div>";
            }
            else{
                echo "No results found in database";
            }
            ?>

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