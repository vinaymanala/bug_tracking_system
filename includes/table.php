<?php
error_reporting(E_ERROR);

$admin_db = mysqli_connect("localhost","root","","bug_tracker");
$student_db = mysqli_connect("localhost","root","","student_db");
$professor_db = mysqli_connect("localhost","root","","professor_db");

		if(isset($_SESSION['id'])){
			$db = $_SESSION['datab'];
			$id = $_SESSION['id'];
			$professor_db = mysqli_connect("localhost","root","",$db);
			$query = "SELECT * FROM ticket_details WHERE id= $id ORDER BY Comment DESC;";
			$result = mysqli_query($professor_db,$query);
			$resultCheck = mysqli_num_rows($result);
			
			if($resultCheck>0){
			  while ($rows=$result->fetch_assoc()){
	                          $ticket_id = $rows['ticket_id'];
	                          $ticket_header = $rows['ticket_header'];
	                          $tdesc = $rows['ticket_description'];
	                          $ticket_priority = $rows['ticket_priority'];
	                          $reg_date = $rows['ticketreg_date'];
	                          $comment = $rows['Comment'];
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
		    <td><a type="button" class="btn btn-outline-secondary" name="view" href="includes/view.php?view='.$ticket_id.'" >View</a>';
		    }
		 if($_SESSION["username"]=="admin"){
			echo '<a class="btn btn-danger btn-xs"type="button" name="delete" id="delete" href="includes/process.php?delete=<?php echo($ticket_id)?>">Delete</a></td>';
	}
			              }
			}else {
				echo "<b>No tickets created..</b>";
			}
		}
			
		
