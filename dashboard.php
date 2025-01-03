<?php
   include("includes/connect.php");
    if(!isset($_SESSION['user_id'])){
        header("Location:index.php?lgn=false");
    }

    $total_students = mysqli_query($conn,"SELECT COUNT(SN) FROM registration_tbl");
?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $_SESSION['lname'];?>'s Dashboard </title>

    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    

</head>

<body>

    <?php include('includes/sidebar.php');?>
    <main>
    <?php include('includes/header.php');?>

        <h1 class="pt-5"><i class="fa-solid fa-dashboard" id="one"></i>&nbsp;&nbsp;Dashboard</h1>
        <h2 class="ps-5 ms-3">Hi, <?php echo ucwords($_SESSION['lname']);?></h2>

        <div class="cards mt-4">

            <div class="card1">

                <i class="fa-solid fa-users fa-2x"></i>
                <p>Total Contestants</p>
                <?php echo "<h1>253</h1>" ?>

            </div>

            <div class="card2">

                <i class="fa-solid fa-comment fa-2x"></i>
                <p>Comments</p>
                <h1>25,120</h1>
                
            </div>

            <div class="card3">

                <i class="fa-solid fa-share fa-2x"></i>
                <p>Total shares</p>
                <h1>10,320</h1>
                
            </div>
            
        </div>

        <div class="mt-5">

            <h1 class="mb-4"><i class="fa-solid fa-suitcase" id="one"></i>&nbsp;&nbsp;Recent SignUps</h1>
                <?php 
               
               $sql = "SELECT * FROM registration_tbl ORDER BY SN desc";

               $result= mysqli_query($conn, $sql);
           
               if(mysqli_num_rows($result) > 0){
                    echo " <table width=90% cellpadding=10 cellspacing=12>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Course</th>
                                <th>gender</th>
                                <th>Joined</th>
                                <th>State</th>
                            </tr>
                        </thead>

                        <tbody>";
           
                   while($row = mysqli_fetch_assoc($result)){
           
                       echo "<tr>
                                <td>".$row['first_name']."</td>
                                <td>".$row['email']."</td>
                                <td>".$row['course']."</td>
                                <td>".$row['gender']."</td>
                                <td>".$row['time_registered']."</td>
                                <td>".$row['state']."</td>
                            </tr>";
                   }                
               }
           
               else{
                   echo "no results found";
               }
               ?>
              
              </tbody>     
            </table>

        </div>

    </main>
    <script type="text/javascript" src="js/all.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>