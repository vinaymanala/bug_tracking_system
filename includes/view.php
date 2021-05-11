<div class="table-responsive">
	<table class="table table-bordered table-hover">

<?php
session_start();
		$ticket_id = $_POST['ticket_id'];
		$conn = mysqli_connect("localhost","root","",$_SESSION['datab']);
		if ($_SESSION['datab'] == "wFePYmr585"){
			$conn = mysqli_connect("remotemysql.com","wFePYmr585","KtKgZEKcEl","wFePYmr585");
		}else if ($_SESSION['datab']== "jAT5KBjxX2"){
			$conn = mysqli_connect("remotemysql.com","jAT5KBjxX2","REWnHNbQUo","jAT5KBjxX2");
		}
		$query = "SELECT * FROM ticket_details WHERE ticket_id='$ticket_id';";
		$result = mysqli_query($conn,$query);
		    
		while($row = mysqli_fetch_assoc($result)){
		echo'
			  <tr>
			   <th width=40%>Id</th>
			   <td width=60% name="ticket_id">'.$ticket_id.'</td>
			  </tr> 
			  <tr>
			   <th width=40%>Header</th>
			   <td width=60%>'.$row['ticket_header'].'</td>
			   </tr>
			   <tr>
			   <th width=40%>Description</th>
			   <td width=60%>'.$row['ticket_description'].'</td>
			   </tr>
			   <tr>
			   <th width=40%>Profile Type</th>
			   <td width=60% name="ticket_db">'.$_SESSION['datab'].'</td>
			   </tr>
			   <tr>
			   <th width=40%>Priority</th>
			   <td width=60%>'.$row['ticket_priority'].'</td>
			   </tr>
			   <tr>
			   <th width=40%>Comments</th>
			   <td width=60%>'.$row['Comment'].'</td>
			   </tr>
			';
			}
			
?>
</table>
</div>
	

