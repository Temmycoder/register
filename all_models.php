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
    <link rel="stylesheet" type="text/css" href="adminboard.css">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
</head>
<style>
    button{
        border: none;
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

                <h2 class="my-5">CONTESTANTS</h2>
                <?php echo "$success"; echo "$error_msg";?>

                <?php
                    $sql = "SELECT * FROM model_tbl ORDER BY id";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0){
                        
                        echo "<table cellpadding=8>";
                            echo "<thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pic</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Votes</th>
                                    <th>Added By</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>";

                            $i=0; // counter initialisation

                            while($row = mysqli_fetch_assoc($result)){
                                $status =$row['status'];
                                if ($status == '1'){
                                    $state='<div class="badge rounded-pill text-bg-success">Active</div>';
                                }
                                else{
                                    $state= '<div class="badge rounded-pill text-bg-danger">Inactive</div>';
                                }
                                    $i++;
                                echo "<tbody>
                                    <tr>
                                        <td>".$i."</td>
                                        <td><img class='img-fluid' width='44' src=".$row['pic']."></td>
                                        <td>".$row['full_name']."</td>
                                        <td>".$row['email']."</td>
                                        <td>".$row['username']."</td>
                                        <td>".$row['votes']."</td>
                                        <td>".$row['created_by']."</td>
                                        <td>".$state."</td>
                                        <form method='post'>
                                            <td><button type='button' data-bs-toggle='modal' data-bs-target='#dismissModal' data-id='$row[id]'><i class='fa fa-toggle-on text-primary'></i></button></td>
                                            <div class='modal fade' id='dismissModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                <div class='modal-dialog' role='document'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h5 class='modal-title' id='exampleModalLabel'>Confirmation</h5>
                                                            <button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'>
                                                                <span aria-hidden='true'>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class='modal-body'>
                                                            Are you sure you want to deactivate <b>".$row['full_name']."<b>
                                                        </div>
                                                        <div class='modal-footer'>
                                                            <button type='button' class='btn btn-primary' id='dismissButton' name='dismissButton'>Yes</button>
                                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>No</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <td><a href='edit_model.php?id=$row[id]'><i class='fa fa-edit text-success'></a></i></td>

                                            <td><button type='button' data-bs-toggle='modal' data-bs-target='#myModal' data-id='$row[id]'>
                                            <i class='fa fa-trash-can text-danger'></i></button></td>

                                            <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                <div class='modal-dialog' role='document'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h5 class='modal-title' id='exampleModalLabel'>Confirmation</h5>
                                                            <button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'>
                                                                <span aria-hidden='true'>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class='modal-body'>
                                                            Are you sure you want to delete <b>".$row['full_name']."<b>
                                                        </div>
                                                        <div class='modal-footer'>
                                                            <button type='button' class='btn btn-primary' id='yesButton' name='yesButton'>Yes</button>
                                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>No</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    <script>
        $(document).on('click', '[data-bs-target="#myModal"]', function () { 
            var modelId = $(this).data('id'); 
            $('#yesButton').data('id', modelId); 
        }); 
        $('#yesButton').on('click', function () { 
            var id = $(this).data('id'); 

            $.ajax({ 
                url: 'delete_model.php', 
                type: 'POST', 
                data: { id: id }, 
                success: function(response) { 
                    console.log(response); 
                    // Optionally, you can reload the page or update the DOM to reflect the deletion 
                    location.reload(); 
                }
            });
        });

        $(document).on('click', '[data-bs-target="#dismissModal"]', function () { 
            var modelId = $(this).data('id'); 
            $('#dismissButton').data('id', modelId); 
        }); 
        $('#dismissButton').on('click', function () { 
            var id = $(this).data('id'); 

            $.ajax({ 
                url: 'dismiss_model.php', 
                type: 'POST', 
                data: { id: id }, 
                success: function(response) { 
                    console.log(response); 
                    // Optionally, you can reload the page or update the DOM to reflect the deletion 
                    location.reload(); 
                }
            });
        });
    </script>
</html>