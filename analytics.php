<?php

    include ("connect.php");
    if(!isset($_SESSION['user_id'])){
        header('Location:index.php?lgn=false');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votes</title>
</head>
<body>
    <?include("includes/sidebar.php");?>
    <main>
        <?include("includes/header.php");?>

        
    </main>
</body>
</html>