<?php
    include("includes/connect.php");

    if(!isset($_SESSION["user_id"])){
        header("Location:index.php?lgn=false");
    }
    
    if(isset($_POST['delete'])){

        $result = mysqli_query($conn, "SELECT * FROM registration_tbl");
        $row = mysqli_fetch_assoc($result);
        $con_id =  $row['email'];
        if(mysqli_num_rows($result) > 0){
            $delete = "DELETE FROM registration_tbl WHERE email = '$con_id'";

            if(mysqli_query($conn, $delete)){
                $success = "<div class='alert alert-success'>Data successfully delete</div>";
            }
            else{
                $error_msg = "<div class='alert alert-danger'>Could not delete data</div>";
            }
        }
        else{
            $error_msg = "<div class='alert alert-danger'>Does not exist in database</div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content</title>
    <link rel="stylesheet" href="css/all.css" type="text/css">
    <link rel="stylesheet" href="dashboard.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
</head>
<body>
    <?php include("includes/sidebar.php"); ?>
    <main>
        <?php include("includes/header.php"); echo "$success"; echo "$error_msg";?>

        <h2 class="mt-5">CONTESTANTS</h2>

        <a class="btn btn-warning my-4" href="form.php">Add Contestant</a>
        <?php
            $sql = "SELECT * FROM registration_tbl ORDER BY SN desc";
            $result = mysqli_query($conn, $sql);
        
            if(mysqli_num_rows($result) > 0){
                 
                echo "<table cellpadding='10' cellspacing='12'>";
                    echo "<thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>gender</th>
                            <th>Joined</th>
                            <th>State</th>
                        </tr>
                    </thead>";

                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tbody>
                            <tr>
                                <td>".$row['last_name'] . " " . $row['first_name']."</td>
                                <td>".$row['email']."</td>
                                <td>".$row['course']."</td>
                                <td>".$row['gender']."</td>
                                <td>".$row['time_registered']."</td>
                                <td>".$row['state']."</td>
                                <form method='post'>
                                    <td><button name='delete' id='delete' class='btn-secondary btn'>Delete</button></td>
                                    <td><button name='edit' name='delete' class='btn-secondary btn'>Edit</button></td>
                                </form>
                            </tr>
                        </tbody>";
                    }
                echo "</table>";
            }
            else{
                echo"No results found!!";
            }
        ?>
    </main>
</body>
<script type="text/javascript" src="js/all.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</html>