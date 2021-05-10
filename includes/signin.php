<?php
 if (isset($_POST['submit'])){
 	$username = $_POST['username'];
 	$email = $_POST['email'];
 	$user_bio = $_POST['editor1'];
 	$passw = $_POST['password'];
 	$c_passw = $_POST['c_password'];
 	$profile = $_POST['profile'];
 	$email = $_POST['email'];
 	$page = $_POST['page'];
 	
 	if (empty($username) || empty($c_passw) || empty($profile) || empty($profile) || empty($passw) || empty($user_bio)){
 		header("location: ../".$page."?error=emptyfield&name=".$username."&email=".$email);
 		exit();
 	}else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username)){
 		header("location: ../".$page."?error=invalidnameandemail");
 		exit();
 	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
 		header("location: ../".$page."?error=invalidemail&name=".$username);
 		exit();
 	}else if (!preg_match("/^[a-zA-Z0-9]*$/",$username)){
 		header("location: ../".$page."?error=invalidname&email=".$email);
 		exit();
 	}else if ($passw !== $c_passw){
 		header("location: ../".$page."?invalidpassw&name=".$username."&email=".$email);
 		exit();
 	
 	}else if ($profile == "student" | "professor"){
 			$db = $profile.'_db';
			$table = $profile.'_users';
	 		$conn = mysqli_connect("localhost","root","",$db);
	 		
	 	}if ($conn -> connect_error){
 			header("location: ../".$page."?error2=sqlerror");
 			exit();
 		}else{
 			$col_name = $profile.'_name';
 			$query = "SELECT * FROM $table WHERE $col_name = '$username';";
 			$result = $conn->query($query) or die($conn->error);
 			if ($result->num_rows > 0){
 				header("location: ../".$page."?error=usertaken&email=".$email);
 				exit();
 			}else{
 				$col_email = $profile.'_email';
 				$col_password = $profile.'_password';
 				$col_profile = $profile.'_profile';
 				$col_bio = $profile.'_bio';
 				$query = "INSERT INTO $table($col_name,$col_email, $col_password, $col_profile,$col_bio) VALUES ('$username','$email','$passw','$profile','$user_bio');";
 					mysqli_query($conn, $query) or die($conn->error);
 	 				header("location: ../".$page."?signup=success");
	 				exit();
 			}
 		}
 	
 }else {
 	header("location: ../".$page."?");
 	exit();
 	}
