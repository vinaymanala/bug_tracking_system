<?php
	session_start();
include("includes/dbh.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <?php if($_SESSION['id'] == null):?>
       <title>Posts | Login </title>
     <?php else:?>
    <title><?php echo($_SESSION['username']);?> Area | Tickets</title>
    <?php endif ?>
    <?php 
	$student_db = mysqli_connect("remotemysql.com","wFePYmr585","KtKgZEKcEl","wFePYmr585");
	$professor_db = mysqli_connect("remotemysql.com","jAT5KBjxX2","REWnHNbQUo","jAT5KBjxX2");
    ?>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  </head>
  <style>
	#username #password{ width:40%; text-align:center;}
	.btn{
		width:30%;	
	}
	.signinerror{
	color:red;
}
</style>
    <nav class="navbar navbar-expand-md navbar-dark bg-danger" style="padding:0px;">
    <div class="navbar-header" style="margin-left:50px">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" type="button" href="home.php"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-bug-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M4.978.855a.5.5 0 1 0-.956.29l.41 1.352A4.985 4.985 0 0 0 3 6h10a4.985 4.985 0 0 0-1.432-3.503l.41-1.352a.5.5 0 1 0-.956-.29l-.291.956A4.978 4.978 0 0 0 8 1a4.979 4.979 0 0 0-2.731.811l-.29-.956zM13 6v1H8.5v8.975A5 5 0 0 0 13 11h.5a.5.5 0 0 1 .5.5v.5a.5.5 0 1 0 1 0v-.5a1.5 1.5 0 0 0-1.5-1.5H13V9h1.5a.5.5 0 0 0 0-1H13V7h.5A1.5 1.5 0 0 0 15 5.5V5a.5.5 0 0 0-1 0v.5a.5.5 0 0 1-.5.5H13zm-5.5 9.975V7H3V6h-.5a.5.5 0 0 1-.5-.5V5a.5.5 0 0 0-1 0v.5A1.5 1.5 0 0 0 2.5 7H3v1H1.5a.5.5 0 0 0 0 1H3v1h-.5A1.5 1.5 0 0 0 1 11.5v.5a.5.5 0 1 0 1 0v-.5a.5.5 0 0 1 .5-.5H3a5 5 0 0 0 4.5 4.975z"/>
      </svg> BugTracker</a>
    </div>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item"  >
            <a class="nav-link" href="home.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a type="button" class="nav-link" href="tickets.php">Tickets</a>
          </li>
          <li class="nav-item">
            <a type="button" class="nav-link" href="test.php">Data Report</a>
          </li>
          <li class="nav-item active">
            <a type="button" class="nav-link" href="index.php">Posts<span class="sr-only" >(current)</span></a>
          </li>
        </ul>
        <?php if($_SESSION['id'] != null):?>
        <ul class="navbar-nav navbar-right" style="padding-right:100px">
          <div class="btn-group">
          
    <button class="navbar mr-auto nav-item btn btn-danger toggle" data-toggle="dropdown" aria-expanded="false">
            Welcome, <?php echo($_SESSION['username']);?>
        
    </button>
    <ul class="dropdown-menu">
    	<?php 
    	if($_SESSION['username']=='admin'){
    	  echo "
    	  <table>
          <tr><th>Name:</th><td>Admin</td></tr>
          <tr><th>Bio:</th><td>trackbugSysAdmin</td></tr>
          </table> 
    	  ";	
    	}else { 
//    	$conn = mysqli_connect("localhost","root","",$_SESSION['datab']);
//	$pname = substr($_SESSION['datab'],0,-3);
	if ($_SESSION['datab'] == "wFePYmr585"){
		$pname = "student";
	}else if ($_SESSION['datab']== "jAT5KBjxX2"){
		$pname = "professor";
	}
	  $name = $pname.'_name';
	  $bio = $pname.'_bio';	
	  $email = $pname.'_email';
	  $users = $pname.'_users';
	  $id = 'main_id';
	  $idx = $_SESSION['id'];
          $query = "SELECT $name, $bio, $email from $users WHERE $id = $idx;";
          $result = mysqli_query($conn,$query);
          while($row = mysqli_fetch_assoc($result)):?>
          <table>
          <tr><th>Name: </th><td><?php echo$row[$name];?></td></tr>
          <tr><th>Profile: </th><td><?php echo (substr($_SESSION['datab'],0,-3));?></td></tr>
          <tr><th>Bio: </th><td><?php echo$row[$bio];?></td></tr>
          <tr><th>Email: </th><td><?php echo$row[$email];?></td></tr>
          </table>
        <?php endwhile?>
        <?php }?>
    </ul>
	</div>
	    <?php endif?>
        <form action="includes/login.php" method="POST">
        <ul class="navbar-nav navbar-right" style="padding-right:100px">
        <?php
        if (isset($_SESSION['id'])){
        	echo'  <form action="includes/login.php" method="POST">
	 <li class="ml-3"><input type="submit" value="Logout" name="logout" style="border-radius:2px"class=" form-control bg-danger text-light nav-link btn-outline-light"/></li>
	 </form>
	 </div>';
	 
        }else {
           echo ' <li class=" mr-2 mx"><input type="text" id="name" name="username" class=" form-control sm-auto" placeholder=" Enter Username or Email"/></li>
	<li class="mr-2 mx"><input type="password" id="passw" name="passw" class="form-control sm-auto"  placeholder="Enter password"/></li>
	<li class="mx mr-2"><input type="submit" name="login" value="Login" style="border-radius:3px"class=" text-light bg-danger form-control nav-link btn-outline-light"/></li>
	 <li class="mx mr-2"><a type="button" style="border-radius:2px" class=" form-control text-light bg-danger nav-link btn-outline-light" data-toggle="modal" data-target="#sign-in">Signup</a></li>';
	 }
        ?>
        
        </ul>
        </form>
        </div>
      </div>
    </nav>
      <body>
      <br>
      <br>
      <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3 my-col">
		    <div class="list-group">
		      <a  id="comment" href="home.php" class="list-group-item active bg-danger">
		        Dashboard
		      </a>
		      <a href="tickets.php" class="list-group-item text-dark" style="text-decoration:None"> Tickets <span class="badge badge-dark"><?php 
		      
		      $query = "SELECT COUNT(`ticket_id`) FROM ticket_details;";
			$result = mysqli_query($student_db, $query);
			$result2 = mysqli_query($professor_db, $query);
			$ticket_counts = 0;
			if(mysqli_num_rows($result)>0){
				$row1 = $result->fetch_assoc();
				$ticket_counts += $row1['COUNT(`ticket_id`)'];
			}
			if(mysqli_num_rows($result2)>0){
				$row2 = $result2->fetch_assoc();
				$ticket_counts += $row2['COUNT(`ticket_id`)'];				
			}
			echo( $ticket_counts);
			
		      ?></span></a>
		      <a href="index.php" class="list-group-item text-dark"style="text-decoration:None">Posts <span class="badge badge-dark">
		      <?php
				$query = "SELECT COUNT(`post_id`) FROM posts_details;";
				$student = mysqli_query($student_db,$query);
				$professor = mysqli_query($professor_db,$query);
				$posts_count = 0;
				if(mysqli_num_rows($student)>0){
						$stu = $student->fetch_assoc();
						$posts_count += $stu['COUNT(`post_id`)'];
				}
				if (mysqli_num_rows($professor)>0){
						print_r($prof);
						$prof = $professor->fetch_assoc();
						$posts_count += $prof['COUNT(`post_id`)'];
				}
				echo($posts_count);
		      ?>
		      
		      
		      </span></a>
		      <a href="#" class="list-group-item text-dark"style="text-decoration:None"> Users <span class="badge badge-dark">
		      <?php 
		      	$query1 = "SELECT COUNT(`main_id`) FROM student_users;";
		      	$query2 = "SELECT COUNT(`main_id`) FROM professor_users;";
		      	$student_users = mysqli_query($student_db,$query1);
		      	$professor_users = mysqli_query($professor_db,$query2);
		      	if(mysqli_num_rows($student_users)){
		      		$stuid = $student_users->fetch_assoc();
		      		$users_count += $stuid['COUNT(`main_id`)'];
		      	}
		      	if(mysqli_num_rows($professor_users)){
		      		$profid = $professor_users->fetch_assoc();
		      		$users_count += $profid['COUNT(`main_id`)'];
		      	}
		      	echo($users_count);
		      ?>
		      
		      </span></a>
		      		      		
		    </div>
		    <br>

		    <div class="well">
		      <h4>Tickets Posted</h4>
		      <div class="progress">
		          <div class="progress-bar bg-dark" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
		              60%
		      </div>
		    </div>
		    <h4>Site Progress</h4>
		    <div class="progress">
		        <div class="progress-bar bg-dark" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
		            40%
		        </div>
		    </div>
		    </div>
          </div>
          <!-- Add POST -->
          <div class="col-md-8 responsive"style="background-color:">
            <?php if ($_SESSION['id']):?>
           <div class="panel panel-default my-col" style="background-color:white">             
            <div class="panel-title bg-danger">Create a New Post</div>
               <div class="panel-body">
                <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                 <input type="text" class="form-control border-secondary" name="post-title" id="post-title" placeholder="Enter title of the post" />
                 </div>
                 <div class="form-group">
                 <textarea class="form-control border-secondary" name="post-status" id="post-status" placeholder="Enter description"></textarea>
                 </div>
                 <div class="form-group">
                 <input type="file" class="form-control" name="uploadFile" id="uploadFile" />
                 <span id="error"></span>
                 </div>
                 <div class="form-group text-right">
                 <button type="submit" class="form-control-md btn btn-outline-info" style="width:7em;height:2.5em" name="post-create">create post</button>
                 </div>
                </form>
               </div>
             </div>
               <?php endif ?>
                <ul style="list-style:None">
          <?php 
          $db = $_SESSION['datab'];
//        $con = mysqli_connect("localhost","root","",$db);
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
      			header('Location: '.$_SERVER['PHP_SELF'].'?success');
			exit;
      		}else
      		{
			echo "<script>document.getElementById('#error').innerHTML = 'Only Images allowed'</script>";
      		}
      		
      	}else {
      	
      		$_SESSION['post-create'] == 'NULL';
      	}
      	?>
      	
      	<?php
	$studentdb = mysqli_connect("remotemysql.com","wFePYmr585","KtKgZEKcEl","wFePYmr585");
	$professordb = mysqli_connect("remotemysql.com","jAT5KBjxX2","REWnHNbQUo","jAT5KBjxX2");
      	$query = "SELECT * FROM posts_details ORDER BY postsreg_date DESC;";
      	$result1 = mysqli_query($studentdb,$query);
      	$result2 = mysqli_query($professordb,$query);
	      	while($row1=mysqli_fetch_assoc($result1))
	      	{		    
	      		$status1 = $row1["posts_status"];
	      		$imageType1 = $row1["image_ext"];
	      		$image1 = $row1["posts_image"];
	      		$posts_user1 = $row1["posts_user"];
	      		$date = $row1['postsreg_date'];
				$result = $studentdb->query("SELECT student_name FROM student_users WHERE main_id = '$posts_user1'");
				$name = mysqli_fetch_assoc($result);
				$student_name = $name["student_name"];
				
		      		echo '
		      		</br>
		      		<div class="panel panel-default my-col" style="background-color:white; border:1px solid #D3D3D3">             
		      		 <div class="container">
		      		 <div class="panel panel-title" style="background-color:#D3D3D3">
		      		<div class="panel-heading"><h5 style="color:black">on <cite>'.$date.'</cite> Posted by '.$student_name.'</div>
		      		 </div>
		      		<br>
				  <div class="panel panel-body">
					'.$status1.'</br></br>
				    <div class="text-center"><img src="data:'.$imageType1.';base64,'.base64_encode($image1).'" width=500 height=250/></div>
		      		  </div>
		      		 </div>
		      		</div>
		      		</br>';
		}
	      	while($row2=mysqli_fetch_assoc($result2))
	      	{
	      		$status2 = $row2["posts_status"];
	      		$imageType2 = $row2["image_ext"];
	      		$image2 = $row2["posts_image"];
	      		$posts_user2 = $row2["posts_user"];
	      		$date = $row2["postsreg_date"];
	      		$result = $professordb->query("SELECT professor_name FROM professor_users WHERE main_id = '$posts_user2'");
				$name = mysqli_fetch_assoc($result);
				$professor_name = $name["professor_name"];
	      		echo '
			</br>
			<div class="panel panel-default my-col" style="background-color:white; border:1px solid #D3D3D3"">             
	      		<div class="container">
	      		<div class="panel panel-title" style="background-color:#D3D3D3">
	      		<div class="panel-heading"><h5 style="color:black">on <cite>'.$date.'</cite> Posted by '.$professor_name.'</div>
	      		</div>
	      		<br>
		          <div class="panel panel-body">'.$status2.'
		          	'.$status2.'</br</br>
			   <div class="text-center"><img src="data:'.$imageType2.';base64,'.base64_encode($image2).'" width=500 height=300/></div>
	      		  </div>
	      		 </div>
	      		</div>
			</br>
	      		';
	      	}
      ?>
           </div>   
          </div>
      </section>
      
      
      
      
      <div class="modal fade" id="sign-in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
	<form action="includes/signin.php" method="POST">
	   <div class="modal-header"><h4 id="myModalLabel">Sign Up Form</h4></div>
		<div class="modal-title">
		<?php
			if (isset($_GET['error'])){
		           echo("<script> $(document).ready(function(){ $('#sign-in').modal('show'); }); </script>");	
		  	   if ($_GET['error']=='emptyfield'){
		  	   	echo "<p class='signinerror'>Fill in all the fields...</p>";
			   }else if ($_GET['error']=='invalidnameandemail'){
		  	   	echo "<p class='signinerror'>Invalid name and Email!...</p>";		  
			   }else if ($_GET['error']=='invalidemail'){
			   	echo "<p class='signinerror'>Invalid Email!</p>";
			   }else if ($_GET['error']=='invalidname'){
			   	echo "<p class='signinerror'>Invalid Name!</p>";		  
			   }else if ($_GET['error']=='invalidpassw'){
			   	echo "<p class='signinerror'>Invalid Password!</p>";	
			   }else if ($_GET['error']=='usertaken'){
			   	echo "<p class='signinerror'>Username already taken!</p>";		  
			   	}
			}	
		?>		
		</div>
		<div class="modal-body">
			<div class="form-group">
		 	 <input class="form-control username" type="text" name="username" placeholder="Enter username or email" />
			</div>
			<div class="form-group">
			 <input class=" form-control" type="email" name="email" placeholder="Enter email" />
			</div>
			<div class="form-group">
			<label>Description</label>
		              <textarea name="editor1" class="form-control" placeholder="Enter your bio" ></textarea>
			</div>

		        <div class="checkbox">
		         <div class="input-group mb-3">
		          <div class="input-group-prepend">
		            <label class="input-group-text" for="profile">Profile Status</label>
		          </div>
		          <select class="custom-select" name="profile" id="profile">
		            <option selected>Choose Profile Status...</option>
		            <option value="student">Student</option>
		            <option value="professor">Professor</option>
		          </select>
		        </div>
		      </div>
			<div class="form-group">
			 <input class=" form-control" type="password" name="password" placeholder="Enter new password" />
			</div> 
			<div class="form-group">
			 <input class=" form-control" type="password" name="c_password" placeholder="Confirm new password" />
			</div>
			  <div class="modal-footer">
			    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			    <input type="submit" name="submit" value="Sign Up"class="btn btn-outline-info"/>
			</div>
		</div>
	</form>
	</div>
	</div>
	</div>

            

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) 
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
	    
<!-- Include all compiled plugins (below), or include individual files as needed -->
 	<script src="js/bootstrap.min.js"></script>
 	
 	<script>
 $(".toggle").on("mouseenter", function () {
    // make sure it is not shown:
    if (!$(this).parent().hasClass("show")) {
        $(this).click();
    }
	});
    $(".btn-group, .dropdown").on("mouseleave", function () {
    // make sure it is shown:
    if ($(this).hasClass("show")){
        $(this).children('.toggle').first().click();
    }
});	
 	
 	</script>

</body>
</html>
