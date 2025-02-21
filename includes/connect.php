<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voters_db";
$success="";
$error_msg="";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("Connection error on server". $conn->connect_error);
}