<?php


if (isset($_POST['logout'])){
	session_start();
	session_unset();
	session_destroy();
	header("location: ../index.php?logout=success");
	exit();
}
//Development Connection
//$admin_db = mysqli_connect("localhost","root","","bug_tracker");
//$student_db = mysqli_connect("localhost","root","","student_db");
//$professor_db = mysqli_connect("localhost","root","","professor_db");

//Remote Connection - revert changes

$admin_db = mysqli_connect("localhost","root","","bug_tracker");
$student_db = mysqli_connect("localhost","root","","student_db");
$professor_db = mysqli_connect("localhost","root","","professor_db");

if (isset($_POST['login'])){
	$name = $_POST['username'];
	$password = $_POST['passw'];
	if (empty($name) || empty($password)){
		header("location: ../index.php?loginerror=emptyfieldserror");
		exit();
	}else{
	  $result = $admin_db->query("SELECT * FROM admintable WHERE admin_name = '$name' OR admin_password = '$password';");
	  if ($result->num_rows >0){
	  	$row = $result->fetch_assoc();
	  	if($name == $row['admin_name'] && $password == $row['admin_password']){
	  		session_start();
	  		$_SESSION['id'] = $row['admin_id'];
	  		$_SESSION['username'] = $row['admin_name'];
	  		header("location: ../index.php?login=successadmin");
	  		exit();
	  		}
	  }
	  $result = $student_db->query("SELECT * FROM student_users WHERE student_name = '$name' OR student_password = '$password';");
	  if ($result->num_rows >0){
	  	$row = $result->fetch_assoc();
	  	if($name == $row['student_name'] && $password == $row['student_password']){
	  		session_start();
	  		$_SESSION['id'] = $row['main_id'];
	  		$_SESSION['username'] = $row['student_name'];
	  		$_SESSION['datab'] = "wFePYmr585";
	  		header("location: ../index.php?login=success");
	  		exit();
	  	}else{
	  			header("location: ../index.php?loginerror=credentialsnotmatch");
	  			exit();
	  	     }
	  }else{
	  $result = $professor_db->query("SELECT * FROM professor_users WHERE professor_name = '$name' OR professor_password='$password';");	 
		  if ($result->num_rows >0){
		   	$row = $result->fetch_assoc();
	  		if($name == $row['professor_name'] && $password == $row['professor_password']){
		  		session_start();
		  		$_SESSION['id'] = $row['main_id'];
		  		$_SESSION['username'] = $row['professor_name'];
		  		$_SESSION['datab'] = "jAT5KBjxX2";
		  		header("location: ../index.php?login=success");
		  		exit();
	  		}else{
	  			header("location: ../index.php?loginerror=credentialsnotmatch");
	  			exit();
	  		} 
		  }else{
		  	header("location: ../index.php?loginerror=nouserfound");	
		  	exit();
		  } 	
	  }
	
	}
	
}else{
	header("location: ../index.php");
	exit();
	}




