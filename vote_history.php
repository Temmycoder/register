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
        <h1 class="text-center my-4">Vote history</h1>
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
                <a href="http://github.com/TemmyCoder" target="_blank">TemmyCoder</a>
              </p>
            </div>
          </div>
        </div>
      </footer>
    </div>

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
  </body>
</html>