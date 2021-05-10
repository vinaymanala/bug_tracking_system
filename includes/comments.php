<div class="table-responsive">
	<table class="table table-bordered table-hover">

<?php
		$ticket_db = $_POST['ticket_db'];
		$ticket_id = $_POST['ticket_id'];
		$db = $ticket_db.'_db';
		setcookie('comment_id',$ticket_id);
		setcookie('comment_db',$ticket_db);
		$conn = mysqli_connect("localhost","root","",$db);
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
			   <td width=60% name="ticket_db">'.$ticket_db.'</td>
			   </tr>
			   <tr>
			   <th width=40%>Date</th>
			   <td width=60%>'.$row['ticketreg_date'].'</td>
			   </tr>
			   <tr>
			   <th width=40%>Priority</th>
			   <td width=60%>'.$row['ticket_priority'].'</td>
			 </tr>
			';
			}
			
?>
</table>
</div>
	

