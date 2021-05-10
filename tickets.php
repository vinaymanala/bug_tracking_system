<?php
session_start();
	include("includes/logout.php");
	include_once("includes/dbh.inc.php");

//  include('includes/ticket_details.php');
//  require("includes/process.php");	
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
    <title><?php echo($_SESSION['username']);?> Area | Tickets</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <style>
  .signinerror{
	color:red;
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
          <li class="nav-item" >
            <a class="nav-link"  href="home.php">Dashboard</a>
          </li>
          <li class="nav-item active">
            <a type="button" class="nav-link" href="tickets.php">Tickets<span class="sr-only">(current)</span></a>
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
//    	$conn = mysqli_connect("localhost","root","",$_SESSION['datab']);
//    	  $pname = substr($_SESSION['datab'],0,-3);
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
            <h2><span aria-hidden="true"></span><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
              <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
            </svg><?php if($_SESSION["username"]=='admin'):?>
            		<?php echo "Dashboard";?>
            		<?php else:?>
            		<?php echo"Settings";?>
            		<?php endif ?>
            <span class="small" style="color:gray;"> Manage your Tickets</span></h2>
          </div>
        </div>
      </div>
    </header>
    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="home.php" style="text-decoration:None">Dashboard</a></li>
          <li class="active" style="color: gray;">&nbsp&nbspTickets</li></div>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3 my-col">
            <div class="list-group">
              <a href="home.html" class="list-group-item active bg-danger btn text-left">
                  Dashboard
            </a>
            <a href="tickets.php" class="list-group-item text-dark" style="text-decoration:None"> Tickets <span class="badge badge-dark">
            <?php 
		  	$student_db = mysqli_connect("remotemysql.com","wFePYmr585","KtKgZEKcEl","wFePYmr585");
			$professor_db = mysqli_connect("remotemysql.com","jAT5KBjxX2","REWnHNbQUo","jAT5KBjxX2");
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
		  
          <div class="col-md-9 my-col">
              <!-- Latest Users -->
            <div class="panel panel-default my-col">
              <div class="panel-heading">
                <h4 class="panel-title bg-danger">Ticket Details</h4>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-hover table-bordered table-sm">
			            <tr class="bg-secondary text-light">
                    <th>TicketId</th>
                    <th>Ticket Header</th>
                    <th>Priority</th>
                    <th>Post Date</th>
                    <th>Comments</th>
                    <th>Settings</th>
                  </tr>
			            <?php
		error_reporting(E_ERROR);

		$admin_db = mysqli_connect("remotemysql.com","wduvQYfSN0","1vspLjNzfW","wduvQYfSN0");
		$student_db = mysqli_connect("remotemysql.com","wFePYmr585","KtKgZEKcEl","wFePYmr585");
		$professor_db = mysqli_connect("remotemysql.com","jAT5KBjxX2","REWnHNbQUo","jAT5KBjxX2");


		if(isset($_SESSION['id'])){
			$db = $_SESSION['datab'];
			$id = $_SESSION['id'];
			$user_db = mysqli_connect("localhost","root","",$db);
			$query = "SELECT * FROM ticket_details WHERE id= $id ORDER BY Comment DESC;";
			$result = mysqli_query($user_db,$query);
			$resultCheck = mysqli_num_rows($result);
			
			if($resultCheck>0){
			  while ($rows=$result->fetch_assoc()){
	                          $ticket_id = $rows['ticket_id'];
	                          $ticket_header = $rows['ticket_header'];
	                          $tdesc = $rows['ticket_description'];
	                          $ticket_priority = $rows['ticket_priority'];
	                          $reg_date = $rows['ticketreg_date'];
	                          $comment = $rows['Comment'];
	                          $user_id = $rows['id'];
			  if ($comment == NULL){
			  echo '<tr>
                    <td style="width:10px">'.$ticket_id.'</td>
                    <td>'.$ticket_header.'</td>
                    <td>'.$ticket_priority.'</td>
                    <td style="width:13%">'.$reg_date.'</td>
                    <td>'.$comment.'</td>
		    <td><a type="button" class="btn btn-outline-secondary edit_data" href="edit.php?edit='.$ticket_id.'" >Edit</a>';
		    }
		    else{
		    echo '
		    <td style="width:10px">'.$ticket_id.'</td>
                    <td>'.$ticket_header.'</td>
                    <td>'.$ticket_priority.'</td>
                    <td style="width:13%">'.$reg_date.'</td>
                    <td>'.$comment.'</td>
		    <td style="width:20%"><a type="button" class="btn btn-outline-info view" id='.$ticket_id.'>View</a>
		    	<a class="btn btn-danger btn-xs"type="button" name="delete" id="delete" href="includes/process.php?delete='.$ticket_id.'&id='.$user_id.'">Delete</a></td></tr>';
	}
			              }
			}else {
				echo "<b>No tickets created..</b>";
			}
		}		
			     ?>
                   <!--<?php if($_SESSION["username"]=="admin"): ?> 
			 <?php echo '<a class="btn btn-danger btn-xs"type="button" name="delete" id="delete" href="includes/process.php?delete=<?php echo($ticket_id)?>">Delete</a>'; ?>
 <?php endif ?> --></td>
                  </tr>
		  </table>
              </div>
          </div>
    </section>

    <footer id="footer">
      <p>Copyright BugTracker, &copy; 2020</p>
    </footer>
    
    <!-- Add Page 
    <div class="modal fade" id="add_ticket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="includes/ticket_details.php" method="POST">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Create Ticket</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
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
		<input type="hidden" name="page" value="tickets.php" />
                  <select class="custom-select" name="ticket_priority" id="ticket_priority" >
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
    </div>-->
    
    

<!-- Add USERS -->   
	
    <!-- VIEW DATA-->
    <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="includes/ticket_details.php" method="POST">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Ticket Details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body" id="view_details">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.min.js">    
    </script>
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
	 $(".view").click(function(){
	 	var ticket_id = $(this).attr("id");
	 	$("#view_details").load("includes/view.php",{
	 		ticket_id : ticket_id,
	 	});
	 	$("#view").modal("show");
	 });	
	
	
	});

    </script>
  </body>
  </html>
