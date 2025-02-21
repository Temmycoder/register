<?php
   include("includes/connect.php");
   if(!isset($_SESSION["admin_id"])){
    header("Location:index.php?lgn=false");
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
                    <h1>Hello, <?php echo $_SESSION['f_name']?></h1>
                    <div class="row">
                        <?php 
                            $model = mysqli_query($conn, "SELECT COUNT(id) as id FROM model_tbl");
                            $model_fetch = mysqli_fetch_assoc($model);
                            $total_model = $model_fetch['id'];

                            $votes = mysqli_query($conn, "SELECT sum(votes) as votes FROM model_tbl");
                            $vote_row = mysqli_fetch_assoc($votes);
                            $total_votes = $vote_row['votes'];

                            $admin = mysqli_query($conn,"SELECT COUNT(id) as admin_id FROM users_tbl");
                            $admin_row = mysqli_fetch_assoc($admin);
                            $tot_admin = $admin_row['admin_id'];

                            $model_query = mysqli_query($conn, "SELECT full_name FROM model_tbl ORDER BY votes DESC LIMIT 1");
                            $top_model_row = mysqli_fetch_assoc($model_query);
                            $top_model = $top_model_row['full_name'];
                        echo'
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header">
                                    <div class="icon icon-warning">
                                        <span class="fa fa-chart-simple"></span>
                                    </div>
                                </div>

                                <div class="card-content">
                                    <p class="category"><strong>Models</strong></p>
                                    <h3 class="card-title">'.$total_model.'</h3>
                                </div>

                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="fa fa-info text-info"></i>
                                        <a href="#">No. of models</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header">
                                    <div class="icon icon-rose">
                                        <span class="fa fa-shopping-cart"></span>
                                    </div>
                                </div>

                                <div class="card-content">
                                    <p class="category"><strong>Vote Count</strong></p>
                                    <h3 class="card-title">'.$total_votes.'</h3>
                                </div>

                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="fa fa-tag text-info"></i>
                                        <a href="#">No. of Models` Votes</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header">
                                    <div class="icon icon-success">
                                        <span class="fa fa-dollar"></span>
                                    </div>
                                </div>

                                <div class="card-content">
                                    <p class="category"><strong>Our Admins</strong></p>
                                    <h3 class="card-title">'.$tot_admin.'</h3>
                                </div>

                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="far fa-calendar text-info"></i>
                                        <a href="#">No. of Admins</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header">
                                    <div class="icon icon-info">
                                        <span class="fa fa-person-walking-arrow-right"></span>
                                    </div>
                                </div>

                                <div class="card-content">
                                    <p class="category"><strong>Top Model</strong></p>
                                    <h3 class="card-title">'.$top_model.'</h3>
                                </div>

                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="fa fa-clock-rotate-left fa-flip-horizontal text-info"></i>
                                        <a href="#">Top Ranking Model</a>
                                    </div>
                                </div>
                            </div>
                        </div>'
                        ?>
                    </div>

                    <div class="row">
                        <div class="col-lg-7 col-md-12">
                            <div class="card" style="min-height: 485px;">
                                <div class="card-header card-header-text">
                                    <h4 class="card-title">Voting History</h4>
                                    <p class="category">New Employees on 16th December, 2016</p>
                                </div>

                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <?php 
                                        $sql = "SELECT vote_log.name, vote_log.votes, vote_log.created_time, 
                                        model_tbl.full_name FROM vote_log INNER JOIN model_tbl ON vote_log.model_id = model_tbl.id";

                                        $result = mysqli_query($conn, $sql);

                                        if(mysqli_num_rows($result) > 0){
                                                echo "<thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>Model Name</th>
                                                            <th>Votes</th>
                                                            <th>Voting time</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>";

                                                    $i = 0;
                                            while($row = mysqli_fetch_assoc($result)){

                                                $i++;
                                                echo "<tr>
                                                    <td>".$i."</td>
                                                    <td>".$row['name']."</td>
                                                    <td>".$row['full_name']."</td>
                                                    <td>".$row['votes']."</td>
                                                    <td>".$row['created_time']."</td>
                                                </tr>";
                                            }                
                                        }
                                    
                                        else{
                                            echo "no results found";
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5 col-md-12">
                            <div class="card" style="min-height: 485px;">
                                <div class="card-header card-header-text">
                                    <h4 class="card-title">Vote Ranking</h4>
                                </div>

                                <div class="card-content">
                                    <div class="steamline">
                                        <?php
                                        $sql = mysqli_query($conn,"SELECT * FROM model_tbl ORDER BY votes desc Limit 6");
                                       
                                        if(mysqli_num_rows($sql) > 0) {
                                            
                                            while( $row = mysqli_fetch_assoc($sql)){
                                                echo'<div class="sl-item sl-primary">
                                                <div class="sl-content">
                                                    <small class="text-muted">5 min Ago</small>
                                                    <p>'.$row['full_name']. " - " .$row['votes'].'</p>
                                                </div>
                                            </div>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
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