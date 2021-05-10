<?php 
          //$db = $_SESSION['datab'];
	//$con = mysqli_connect("localhost","root","",$db);
	include_once('dbh.inc.php');
      	if ($_SERVER['REQUEST_METHOD']=='POST' && empty($_SESSION['post-create']))
      	{	
      		$_SESSION["post-create"] == 'true';
      		if ($conn ->connect_error)
      		{
      			echo "Failed to connect to DB".$conn->connect_error;
      		}
      		$id = $_SESSION["id"];
      		$imageName = $conn -> real_escape_string($_FILES["uploadFile"]["name"]);
      		$imageType = $conn -> real_escape_string($_FILES["uploadFile"]["type"]);
      		$imageData = $conn ->real_escape_string(file_get_contents($_FILES["uploadFile"]["tmp_name"]));
      		
      		$title = $conn -> real_escape_string($_POST["post-title"]);
      		$status = $conn -> real_escape_string($_POST["post-status"]);
      		if (substr($imageType,0,5) == "image" and !empty($title) and !empty($imageData) and !empty($status))
      		{
      			$query = "INSERT INTO posts_details(posts_status,posts_user,posts_image,image_ext) VALUES('$status','$id','$imageData','$imageType');";
      			mysqli_query($conn,$query);
      			header("location: ../index.php?create-post=success");
      		}else
      		{
			echo "<script>document.getElementById('#error').innerHTML = 'Only Images allowed'</script>";
      		}
      		
      	}else {
      	
      		$_SESSION['post-create'] == 'NULL';
      	}
    
