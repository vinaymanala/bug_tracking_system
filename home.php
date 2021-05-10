<?php	
	session_start();
	include("includes/logout.php");
	
//	include_once "includes/ticket_details.php";
	
?>
<?php
if (!isset($_SESSION['id'])){
	header("location: index.php?nouserlogin");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo($_SESSION['username']);?> Area | Dashboard</title>
	
<style>
	.signinerror{
	color:red;
}
</style>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  </head>
  <style>
  .modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}
  </style>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-danger" style="padding:0px">
    <div class="navbar-header" style="margin-left:50px">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="home.php"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-bug-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M4.978.855a.5.5 0 1 0-.956.29l.41 1.352A4.985 4.985 0 0 0 3 6h10a4.985 4.985 0 0 0-1.432-3.503l.41-1.352a.5.5 0 1 0-.956-.29l-.291.956A4.978 4.978 0 0 0 8 1a4.979 4.979 0 0 0-2.731.811l-.29-.956zM13 6v1H8.5v8.975A5 5 0 0 0 13 11h.5a.5.5 0 0 1 .5.5v.5a.5.5 0 1 0 1 0v-.5a1.5 1.5 0 0 0-1.5-1.5H13V9h1.5a.5.5 0 0 0 0-1H13V7h.5A1.5 1.5 0 0 0 15 5.5V5a.5.5 0 0 0-1 0v.5a.5.5 0 0 1-.5.5H13zm-5.5 9.975V7H3V6h-.5a.5.5 0 0 1-.5-.5V5a.5.5 0 0 0-1 0v.5A1.5 1.5 0 0 0 2.5 7H3v1H1.5a.5.5 0 0 0 0 1H3v1h-.5A1.5 1.5 0 0 0 1 11.5v.5a.5.5 0 1 0 1 0v-.5a.5.5 0 0 1 .5-.5H3a5 5 0 0 0 4.5 4.975z"/>
      </svg> BugTracker</a>
    </div>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active"  >
            <a class="nav-link" href="home.php">Dashboard<span class="sr-only" >(current)</span></a>
          </li>
          <li class="nav-item">
            <a type="button" class="nav-link" href="tickets.php">Tickets</a>
          </li>
          <li class="nav-item">
            <a type="button" class="nav-link" href="test.php">Data Report</a>
          </li>
          <li class="nav-item">
            <a type="button" class="nav-link" href="index.php">Posts</a>
          </li>
        </ul>
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
    	$conn = mysqli_connect("localhost","root","",$_SESSION['datab']);
    	  $pname = substr($_SESSION['datab'],0,-3);
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
          <tr><th>Bio: </th><td><?php echo$row[$bio];?></td></tr>
          <tr><th>Email: </th><td><?php echo$row[$email];?></td></tr>
          </table> 
        <?php endwhile?>
        <?php }?>
    </ul>
	</div>
	<form action="includes/logout.php" method="POST">
	 <li class="ml-3"><input type="submit" value="Logout" name="logout" style="border-radius:2px"class=" form-control bg-danger text-light nav-link btn-outline-light"/></li>
	 </form>
        </ul>
      </div>
    </nav>
    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h2><span aria-hidden="true"></span><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear" fill="currentColor" xmlns="http://www.w3.org/2000/svg"<path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
              <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
            </svg> <?php if($_SESSION["username"]=='admin'):?>
            		<?php echo "Dashboard";?>
            		<?php else:?>
            		<?php echo"Settings";?>
            		<?php endif ?>
            <span class="small" style="color:gray;"> Manage your Site</span></h2>
          </div>
          <div class="col-md-2">
            <div class="dropdown create">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Settings
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" type="button" data-toggle="modal" data-target="#add_ticket">Add Ticket</a>
                <?php if($_SESSION["username"]=='admin'):?>
                <?php echo '<a class="dropdown-item" type="button" data-toggle="modal" data-target="#add-user">Add Users</a>'; ?>
                <?php endif ?>
                <?php 
    			$student_db = mysqli_connect("localhost","root","","student_db");
			$professor_db = mysqli_connect("localhost","root","","professor_db");
		    ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3 my-col">
            <div class="list-group">
              <a href="home.php" class="list-group-item active bg-danger btn text-left">
                Dashboard
              </a>
              <a href="tickets.php" class="list-group-item text-dark" style="text-decoration:None"> Tickets <span class="badge badge-dark">
              <?php 
		      
		      $query = "SELECT COUNT(`ticket_id`) FROM ticket_details;";
			$result = mysqli_query($student_db, $query);
			$result2 = mysqli_query($professor_db, $query);
			$ticket_counts = 0;
			if(mysqli_num_rows($result) > 0){
				$row1 = $result->fetch_assoc();
				$ticket_counts += $row1['COUNT(`ticket_id`)'];
			}
			if(mysqli_num_rows($result2)>0){
				$row2 = $result2->fetch_assoc();
				$ticket_counts += $row2['COUNT(`ticket_id`)'];				
			}
			echo( $ticket_counts);
			
		      ?>
              </span></a>
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
		      	$users_count = 0;
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
          <div class="col-md-9">
            <!-- Website Overview -->
              <!-- Latest Users -->
            <div class="panel panel-default my-col">
              <div class="panel-heading">
              <form action="home.php" method="post">
                <h4 class="panel-title bg-danger">Latest Tickets</h4>
              </div>
              	<?php 
              	$searchText = null;
	if (isset($_POST['search'])){
		$searchText = $_POST['searchvalue'];
		$query = "SELECT * FROM `ticket_details` WHERE CONCAT(`ticket_id`, `ticket_header`, `ticket_description`, `ticket_priority`, `ticketreg_date`) LIKE '%".$searchText."%';";
//		$query = "SELECT * FROM `ticket_details` WHERE `ticket_priority` = $profile;";
		$search_result = filterTable($query);
		$search_prof = filterProf($query);
	
	
	}else {
		$query = "SELECT * FROM `ticket_details` ORDER BY ticketreg_date DESC;";
		$search_result = filterTable($query);
		$search_prof = filterProf($query);
	
	}
	function filterTable($query){
		$conn = mysqli_connect("localhost","root","","student_db");
/*		if ($conn->connect_error){
			echo "Connection failed".$conn->connect_error;
		}*/
		$filter_result = mysqli_query($conn,$query);
		return $filter_result;
	
	}
	function filterProf($query){
		$professordb = mysqli_connect("localhost","root","","professor_db");
		$filter_result = mysqli_query($professordb,$query);
		return $filter_result;
	
	}
              	?>
        <div class="container">
        	      <div class="checkbox">
		            <label class="input-group-text" for="profile">Search by <input type="text" class="form-control" name="searchvalue" id="searchvalue" placeholder="Enter to search"/><div >
		          <button type="submit" style="padding:0.3em"class="btn btn-info" name="search" id="searchSubmit">Search</button> <br>
		          </div>
		          </div>
		        
		  <?php if ($searchText != null){
		  echo "Results for '".$searchText."'";
		  }else{
		  echo " ";}
		  ?>
		  <div class="panel-body">
		  <table class="table table-striped table-hover">
                  <tr class="bg-secondary text-light">
                    <th>Ticket Header</th>
                    <th>Priority</th>
                    <th>Created by</th>
                    <th>Post Date</th>
                    <th>Comments</th>
                    <?php if($_SESSION['username']=='admin'):?>
                    <th>Delete	</th>
                    <? endif?>
                  </tr>
                  <?php 
		    while($row1 = mysqli_fetch_array($search_result)):
                  if (!$row1['Comment']){
                  echo "<tr>
                    <td>".$row1['ticket_header']."</td>
                    <td>".$row1['ticket_priority']."</td>
                    <td>student</td>
                    <td>".$row1['ticketreg_date']."</td>
                    <td><a type='button' style='padding:0.15em' class='comment btn btn-outline-info' name='student' id=".$row1['ticket_id'].">Comment</a></td>";
                    if($_SESSION["username"]=="admin"){
			echo '<td><a class="btn btn-danger btn-xs"type="button" style="padding:0.2em" name="student" href="includes/process.php?del='.$row1['ticket_id'].'&name=student&id='.$row1['id'].'">Delete</a></td>';
			}
		}
		 while($row2 = mysqli_fetch_array($search_prof)):
		 if(!$row2["Comment"]){
                  echo "</tr>
                  <tr>
                    <td>".$row2['ticket_header']."</td>
                    <td>".$row2['ticket_priority']."</td>
                    <td>professor</td>
                    <td>".$row2['ticketreg_date']."</td>
                    <td><a type='button' style='padding:0.15em' class='comment btn btn-outline-info' name='professor' id=".$row2['ticket_id'].">Comment</a></td>";
                    if($_SESSION["username"]=="admin"){
			echo '<td><a class="btn btn-danger btn-xs"type="button" style="padding:0.2em"name="professor" href="includes/process.php?del='.$row2['ticket_id'].'&name=professor&id='.$row2['id'].'">Delete</a></td>';
			}
                       }                 
                  echo "</tr>";
                  endwhile;
                  endwhile;
                  ?>
                  </table>
                  </div>
                  </form>
		</div>
            </div>
              
          </div>
    </section>
<br>
    <footer id="footer">
      <p>Copyright BugTracker, &copy; 2020</p>
    </footer>

  <!-- Modals -->

    <!-- Add Page -->
    <div class="modal fade" id="add_ticket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="includes/ticket_details.php" method="POST">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Create Ticket</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
          <?php
            	if(isset($_GET['error-ticket'])){
            	 echo("<script> $(document).ready(function(){ $('#add_ticket').modal('show'); }); </script>");	
            	  if($_GET['error-ticket']='emptyfield'){
            	  	echo '<p class="signinerror">Fill in all the details...</p>';
            	  }else if($_GET['error-ticket']=='incorrectcredentials'){
            	  	echo '<p class="signinerror">error due to server not reachable...</p>';
            	  	}
            	 }
           ?>
           <input type="hidden" name="page" value="home.php"/>
            <div class="form-group">
              <label>Ticket Header</label>
              <input type="text" name="ticket_header" id="ticket_header" class="form-control" placeholder="Ticket Header" >
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="editor1" class="form-control" placeholder="Ticket Description" ></textarea>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="ticket_priority">Priority</label>
                  </div>
                  <select class="custom-select" name="ticket_priority" id="ticket_priority">
                    <option selected>Choose Priority level...</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" name="insert" value="Post Ticket"class="btn btn-outline-danger"/>
          </div>
        </form>
        </div>
      </div>
    </div>
    
        <!-- ADD POSTS 
    <div class="modal fade" id="add-posts" tabindex="-1" role="dialog" aria-labelledby="mymodalLabel">
     <div class="modal-dialog" role="document">
      <div class="modal-content">
       <form  method="POST" enctype="multipart/form-data">
        <div class="modal-header"><h4 id="myModalLabel">New Post</h4></div>
          <div class="modal-body">
           <div class="form-group">
            <label>Status</label>
		<textarea name="post-status" class="form-control"></textarea>
	    </div>
	    <div class="form-group">
	     <input type="file" class="form-control" name="uploadFile" value="Upload file"/>            
            </div>
            <div class="modal-footer">
		<input type="hidden" name="page" value="index.php"/>
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<input type="submit" name="submit" value=" Post Status"class="btn btn-outline-info"/>
	    </div>
	    </div>
	</form>
	</div>
	</div>
	</div>
	-->
	
    <!-- ADD USERS -->
    <?php if ($_SESSION['username']=='admin'):?>
    <div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
	<form action="includes/signin.php" method="POST">
	   <div class="modal-header"><h4 id="myModalLabel">Add User</h4></div>
		<div class="modal-title">
		<?php
			if (isset($_GET['error'])){
		           echo("<script> $(document).ready(function(){ $('#add-user').modal('show'); }); </script>");	
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
			<label>Name</label>
		 	 <input class="form-control username" type="text" name="username" placeholder="Enter username or email" />
			</div>
			<div class="form-group">
			<label>Email</label>
			 <input class=" form-control" type="email" name="email" placeholder="Enter email" />
			</div>

		        <div class="checkbox">
		         <div class="input-group mb-3">
		          <div class="input-group-prepend">
		            <label class="input-group-text" for="profile">Profile Status</label>
		          </div>
		          <select class="custom-select" name="profile" id="profile" >
		            <option selected>Choose Profile Status...</option>
		            <option value="student">Student</option>
		            <option value="professor">Professor</option>
		          </select>
		        </div>
		      </div>
			<div class="form-group">
			<label>Password</label>
			 <input class=" form-control" type="password" name="password" placeholder="Enter new password" />
			</div> 
			<div class="form-group">
			<label>Confirm New Password</label>
			 <input class=" form-control" type="password" name="c_password" placeholder="Confirm new password" />
			</div>
			  <div class="modal-footer">
				<input type="hidden" name="page" value="home.php"/>			  	
			    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			    <input type="submit" name="submit" value=" Create User"class="btn btn-outline-info"/>
			</div>
		</div>
	</form>
	</div>
	</div>
	</div>
	<?php endif?>
		
    
    <!--  ADD COMMENTS  -->
        <div class="modal fade" id="comment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="includes/ticket_details.php" method="POST">
          <div class="modal-header">
          <?php if (isset($_GET['error'])){
		echo("<script> $(document).ready(function(){ $('#add-user').modal('show'); }); </script>");	
			if($_GET['error']=='emptycommentdata'){
		    	  	echo '<p class="signinerror">Fill in the comments field...</p>';
			}else if ($_GET['error']=='servererror'){
		    	  	echo '<p class="signinerror">error due to server not reachable...</p>';
			}
		}
		?>
            <h4 class="modal-title" id="myModalLabel">Ticket Details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body" id="ticket_details">
          </div>
            <div class="modal-body form-group">
              <label>Comment</label>
              <textarea id="text-comment" name="text-comment" class="form-control" placeholder="Comments here.."></textarea>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" id="post-comment" name="post-comment" value="Post Comment"class="btn btn-outline-info"/>
          </div>
        </form>
        </div>
      </div>
    </div>
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>
     <!-- Bootstrap core JavaScript
     ================================================== -->
     <!-- Placed at the end of the document so the pages load faster -->
  
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.min.js"></script>*/
    
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
	

    $(document).ready(function(){
    	$(".comment").click(function(){
	    	var ticket_id = $(this).attr("id");
	    	var ticket_db = $(this).attr("name");
	    	 $("#ticket_details").load("includes/comments.php",{
	    	 	ticket_id:ticket_id,
	    		ticket_db:ticket_db,
	    	 	});
		 $("#comment").modal("show");	 
	
    	});
    	   
    	});
    </script>
  </body>
  </html>
