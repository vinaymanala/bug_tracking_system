<?php
         	
         		$student_db = mysqli_connect("localhost","root","","student_db");
         		$professor_db = mysqli_connect("localhost","root","","professor_db");
		if ($_SERVER['REQUEST_METHOD']=='POST' && empty($_SESSION['searchSubmit'])){
			$_SESSION["searchSubmit"] == "true";
			$profile = $_POST['searchby'];
			$searchtext = $_POST['searchText'];
			$query = "SELECT * FROM ticket_details WHERE ticket_header,ticket_description LIKE '%".$searchtext."%' and ticket_priority = ".$profile.";";
		}else{
			$query = "SELECT * FROM ticket_details order by ticketreg_date DESC;";
		
		}
                
                    $result_student = mysqli_query($student_db,$query);
                    $result_professor = mysqli_query($professor_db,$query);
                $resultCheck1 = mysqli_num_rows($result_student);
                $resultCheck2 = mysqli_num_rows($result_professor);
                if ($resultCheck1 >0 && $resultCheck2 >0){
		while($row1=$result_student->fetch_assoc() and $row2=$result_professor->fetch_assoc()){?>
	    <?php $ticket_id1 = $row1['ticket_id'];
	    	   $ticket_id2 = $row2['ticket_id'];
	          $ticket_header1 = $row1['ticket_header'];
	          $ticket_header2 = $row2['ticket_header'];
	          $ticket_description1 = $row1['ticket_description'];
	          $ticket_description2 = $row2['ticket_description'];
	          if (isset($_POST)){
	          $ticket_priority1 = $row1['ticket_priority'];
	          $ticket_priority2 = $row2['ticket_priority'];
	          $ticketreg_date1 = $row1['ticketreg_date'];
	          $ticketreg_date2 = $row2['ticketreg_date'];
		  
	          ;?>
                  <?php 
                  if (!$row2['Comment'] or !$row1['Comment']){
                  echo "<tr>
                    <td>$ticket_header1</td>
                    <td>$ticket_priority1</td>
                    <td>student</td>
                    <td>$ticketreg_date1</td>
                    <td><a type='button' style='padding:0.15em' class='comment btn btn-outline-info' name='student' id=$ticket_id1>Comment</a></td>";
                    if($_SESSION["username"]=="admin"){
			echo '<td><a class="btn btn-danger btn-xs"type="button" style="padding:0.2em" name="student" href="includes/process.php?del='.$ticket_id1.'&name=student">Delete</a></td>';
			}
                  echo "</tr>
                  <tr>
                    <td>$ticket_header2</td>
                    <td>$ticket_priority2</td>
                    <td>professor</td>
                    <td>$ticketreg_date2</td>
                    <td><a type='button' style='padding:0.15em' class='comment btn btn-outline-info' name='professor' id=$ticket_id2>Comment</a></td>";
                    if($_SESSION["username"]=="admin"){
			echo '<td><a class="btn btn-danger btn-xs"type="button" style="padding:0.2em"name="professor" href="includes/process.php?del='.$ticket_id2.'&name=professor">Delete</a></td>';
			}
                       }                 
                  echo "</tr>";
                  
                  ?>
                  <?php
                  	}
                  	}
                  	}
                  ?>
