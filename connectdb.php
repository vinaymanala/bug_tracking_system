<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Form</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container" >
<?php
	$username = null;
	$password = null;
	$username = $_POST['user'];
	$password = $_POST['passw'];
	
	$conn = new mysqli("localhost","root","","loginform");
	$username = stripcslashes($username);
	$password = stripcslashes($password);
	$username = $conn->real_escape_string($username);
	$password = $conn->real_escape_string($password);
	
	
	//Connecting to the database.
	
	if($conn-> connect_error){
		die("Failed to connect to database...". $conn->connect_error);
	}else{
		echo "Connected to phpmyadmin successfully...";
	}
	
	//Query the database
	
	$query = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
	$result = $conn->query($query) or die("Failed to query the database : ".$conn->connect_error);;
		
	if ($result->num_rows>0){
		$row = $result->fetch_assoc();
		if ($row['username']==$username && $row['password']==$password){
			echo "Login Successfull $username";
		} else
		{
			echo "Login Failed...";
		}
		echo '<table class="table table-striped table-hover table-condensed" border="0" cellspacing="2" cellpadding="2" >
			<tr class="success">
				<td><font face="Arial Helvetica">Id</td>
				<td><font face="Arial Helvetica">Username</td>
				
			</tr>';
		$query = "SELECT * FROM users";
		if ($result = $conn->query($query)){
		while($row=$result->fetch_assoc()){
			$id=$user=$pass = '';
			$id = $row["id"];
			$user = $row["username"];
			$pass = $row["password"];
			
			echo '<tr>
				<td><font face="Arial Helvetica">'.$id.'</td>
				<td><font face="Arial Helvetica">'.$user.'</td>
			</tr>';
		}
		}
	}
	
	
	$conn->close();
?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
</div>
</body>
</html>
