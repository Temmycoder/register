<?php
    include("includes/connect.php");

    if(!isset($_SESSION["admin_id"])){
        header("Location:index.php?lgn=false");
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content</title>
    <link rel="stylesheet" href="css/all.css" type="text/css">
    <link rel="stylesheet" href="adminboard.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
</head>
<style>
    button{
        border: none;
    }
</style>
<body>
    <div class="body-overlay"></div>

    <?php include("includes/sidebar.php"); ?>
        <div id="content">
        <?php include("includes/header.php"); echo "$success"; echo "$error_msg";?>

        <div class="main-content">
        <h2 class="my-5 text-center">Admins</h2>

        <?php
            $sql = "SELECT * FROM users_tbl";
            $result = mysqli_query($conn, $sql);

            if  (mysqli_num_rows($result) > 0){
                
                echo "<table cellpadding='10' cellspacing='12'>";
                    echo "<thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Added_by</th>
                            <th>Time Added</th>
                        </tr>
                    </thead>";

                    $i = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        $i++;
                        echo "<tbody>
                            <tr>
                                <td>$i</td>
                                <td>".$row['first_name'] . " " . $row['last_name']."</td>
                                <td>".$row['email']."</td>
                                <td>".$row['username']."</td>
                                <td>".$row['role']."</td>
                                <td>".$row['created_by']."</td>
                                <td>".$row['time']."</td>
                                <form method='post'>
                                    <td><button name='deactivate'><i class='fa fa-toggle-on text-primary'></i></button></td>
                                    <td><button name='edit'><a href=edit_admin.php?id=$row[id]><i class='fa fa-edit text-success'></a></i></button></td>
                                    <td><button name='delete'><i class='fa fa-trash-can text-danger'></i></button></td>
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
</body>
    <script type="text/javascript" src="js/all.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script src="js/jquery-3.7.1.js"></script>
</html>