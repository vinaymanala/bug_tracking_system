<?php
error_reporting(E_ERROR);
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = $_SESSION['datab'];

$conn = mysqli_connect($servername,$username,$password,$dbname);

if ($conn -> connect_error){
    echo "Failed to connect to phpmyadmin.." .$conn->connect_error;
}
