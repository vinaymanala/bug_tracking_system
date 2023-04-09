<?php
error_reporting(E_ERROR);
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = $_SESSION['datab'];

// if ($dbname == "wduvQYfSN0"){
// 	$username = "wduvQYfSN0";
// 	$password = "1vspLjNzfW";
// }else if ($dbname == "wFePYmr585"){
// 	$username = "wFePYmr585";
// 	$password = "KtKgZEKcEl";
// }else if ($dbname == "jAT5KBjxX2"){
// 	$username = "jAT5KBjxX2";
// 	$password = "REWnHNbQUo";
// }

$conn = mysqli_connect($servername,$username,$password,$dbname);

if ($conn -> connect_error){
    echo "Failed to connect to phpmyadmin.." .$conn->connect_error;
}
