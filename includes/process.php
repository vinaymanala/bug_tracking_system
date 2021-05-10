<?php 
	include("dbh.inc.php");
	$ticket_id = 0;
	$ticket_header = $tdesc = $ticket_priority = "";
	if (isset($_GET['del'])) {
		$ticket_id = $_GET['del'];
		$ticket_db = $_GET['name'];
		$id = $_GET['id'];
		$db = $ticket_db.'_db';
		$table = substr($db,0,-3);
		$tab = $table.'_users';
		$con = mysqli_connect("localhost","root","",$db);
		$con->query("DELETE FROM ticket_details WHERE ticket_id = $ticket_id;") or die($con->connect_error);
		$con->query("UPDATE $tab SET ticketCount = ticketCount - 1 WHERE main_id = $id;") or die($con->connect_error);
		header("location: ../home.php");
	}
	
	if (isset($_GET['delete'])) {
		$ticket_id = $_GET['delete'];
		$id = $_GET['id'];
		$table = substr($_SESSION['datab'],0,-3);
		$tab = $table.'_users';
		$conn->query("DELETE FROM ticket_details WHERE ticket_id = $ticket_id;");
		$conn->query("UPDATE $tab SET ticketCount = ticketCount - 1 WHERE main_id = $id;") or die($con->connect_error);
		header("location: ../tickets.php");
	}

	if(isset($_GET['edit'])){
		$ticket_id = $_GET['edit'];
		$result = $conn->query("SELECT * FROM ticket_details where ticket_id = $ticket_id;");
		if(count($result)==1){
			$row = $result->fetch_array();
			$ticket_header = row['ticket_header'];
			$tdesc = row['ticket_description'];
			$ticket_priority = row['ticket_priority'];
		}
		header("location:../edit.php");
	}

	if(isset($_POST['Update'])){
		$ticket_id = $_POST['ticket_id'];
		$ticket_header = $_POST['ticket_header'];
		$tdesc = strip_tags($_POST['editor1']);
		$ticket_priority = $_POST['ticket_priority'];
		$conn ->query("UPDATE ticket_details SET ticket_header='$ticket_header', ticket_description='$tdesc', ticket_priority='$ticket_priority' WHERE ticket_id='$ticket_id';") or die($conn->error);

		header("location: ../tickets.php");
	}
