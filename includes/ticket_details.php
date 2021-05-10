<?php
	include('dbh.inc.php');

	if (isset($_POST['insert'])){
		$ticket_header = $tdesc = $ticket_priority = '';
		$ticket_header = $_POST['ticket_header'];
		$ticket_header = stripslashes($ticket_header);
		$page = $_POST['page'];
		$tdesc = $_POST['editor1'];
		$tdesc = strip_tags($tdesc);
		$ticket_priority = $_POST['ticket_priority'];
		$ticket_priority = stripslashes($ticket_priority);
		$id = $_SESSION['id'];
		$table = substr($_SESSION['datab'],0,-3);
		$tab = $table.'_users';
		if(empty($ticket_header) || empty($tdesc) || empty($ticket_priority)){
			header("location: ../".$page."?error-ticket=emptyfield&ticket_header=".$$ticket_header."&description=".$tdesc."&ticket_priority=".$ticket_priority."");
			exit();
		}
		if($ticket_priority == 'High' | 'Medium' | 'Low'){		
		$query = "INSERT INTO ticket_details(ticket_header,ticket_description,ticket_priority,id) VALUES ('$ticket_header','$tdesc','$ticket_priority',$id);";
		$counts = 1;		
		$query2 = "UPDATE $tab SET ticketCount = ticketCount + $counts WHERE main_id = '$id';";
		mysqli_query($conn,$query2) or die($query2->error());
		mysqli_query($conn, $query) or die($conn->error());
		header("LOCATION: ../".$page."?create_ticket=success");
			exit();
		}else {
		header("location: ../".$page."?error-ticket=incorrectcredentials");
			exit();
			}
	}
	
	if(isset($_POST['post-comment'])){
		$ticket_id =  $_COOKIE['comment_id'];
		$ticket_db = $_COOKIE['comment_db'];
		$commentData = $_POST['text-comment'];
		if(empty($commentData)){
			header("LOCATION: ../home.php?error-comment=emptycommentfield");
			exit();
		}
		$conn = mysqli_connect("localhost","root","",$ticket_db."_db") or die($conn->error);
		$query = "UPDATE ticket_details SET Comment= '$commentData' WHERE ticket_id = '$ticket_id';";
		$result = mysqli_query($conn,$query) or die($conn-> error);
		header("location: ../home.php?comment=success");
		exit();	
	}else{
		header("LOCATION: ../home.php/error-comment=servererror");
		exit();
	}
