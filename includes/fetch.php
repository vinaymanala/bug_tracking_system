<?php
    include_once 'dbh.inc.php';

if (isset($_POST['ticket_id'])){
    $query = "SELECT * FROM ticket_details WHERE id = '".$_POST['ticket_id']."';";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}
