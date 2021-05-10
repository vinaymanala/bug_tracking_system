<?php
  include("includes/dbh.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-danger" style="padding:0px">
    <div class="navbar-header">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="home.php"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-bug-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M4.978.855a.5.5 0 1 0-.956.29l.41 1.352A4.985 4.985 0 0 0 3 6h10a4.985 4.985 0 0 0-1.432-3.503l.41-1.352a.5.5 0 1 0-.956-.29l-.291.956A4.978 4.978 0 0 0 8 1a4.979 4.979 0 0 0-2.731.811l-.29-.956zM13 6v1H8.5v8.975A5 5 0 0 0 13 11h.5a.5.5 0 0 1 .5.5v.5a.5.5 0 1 0 1 0v-.5a1.5 1.5 0 0 0-1.5-1.5H13V9h1.5a.5.5 0 0 0 0-1H13V7h.5A1.5 1.5 0 0 0 15 5.5V5a.5.5 0 0 0-1 0v.5a.5.5 0 0 1-.5.5H13zm-5.5 9.975V7H3V6h-.5a.5.5 0 0 1-.5-.5V5a.5.5 0 0 0-1 0v.5A1.5 1.5 0 0 0 2.5 7H3v1H1.5a.5.5 0 0 0 0 1H3v1h-.5A1.5 1.5 0 0 0 1 11.5v.5a.5.5 0 1 0 1 0v-.5a.5.5 0 0 1 .5-.5H3a5 5 0 0 0 4.5 4.975z"/>
      </svg> BugTracker</a>
    </div>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active" >
            <a class="nav-link"  href="home.php">Dashboard<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a type="button" class="nav-link" href="tickets.php">Tickets</a>
          </li>
          <li class="nav-item">
            <a type="button" class="nav-link" href="#">Posts</a>
          </li>
        </ul>
        <ul class="navbar-nav navbar-right" style="padding-right:100px">
          <li class="navbar mr-auto nav-item"><a class="navbar-link" href="#" style="text-decoration:None; color:white">
            Welcome, Vinay
          </a></li>
          <li class="navbar mr-right nav-item"><a type="button" class="navbar-link" href="#" style="text-decoration:None; color:white">Logout</a></li>
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
            </svg> Dashboard<span class="small" style="color:gray;"> Edit your Ticket</span></h2>
          </div>
          <div class="col-md-2">
            <div class="dropdown create">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Settings
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" type="button" data-toggle="modal" data-target="#addPage">Add Ticket</a>
                <a class="dropdown-item" href="#">Add Posts</a>
                <a class="dropdown-item" href="#">Add Users</a>
              </div> 
            </div>
          </div>
        </div>
      </div>
    </header>
    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="home.php"style="text-decoration:None">Dashboard</li></a>
          <li><a href="tickets.php" style="text-decoration:None">&nbsp&nbspTickets </a></li>
          <li class="active" style="color: gray;"> &nbsp&nbspEdit</li></div>
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
              <a href="tickets.php" class="list-group-item text-dark" style="text-decoration:None"> Tickets <span class="badge badge-dark">12</span></a>
              <a href="posts.html" class="list-group-item text-dark"style="text-decoration:None">Posts <span class="badge badge-dark">33</span></a>
              <a href="users.html" class="list-group-item text-dark"style="text-decoration:None"> Users <span class="badge badge-dark">203</span></a>
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
	<?php 
		$ticket_id = 0;
		$ticket_header = '';
		$ticket_priority = '';
		$tdesc = '';
		if (isset($_GET['edit'])){
			$ticket_id = $_GET['edit'];
			$sql = "SELECT * FROM ticket_details WHERE ticket_id = $ticket_id;";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) >0){
				$row = $result->fetch_array();
				$ticket_header = $row['ticket_header'];
				$tdesc = $row['ticket_description'];
				$ticket_priority = $row['ticket_priority'];
				$reg_date = $row['ticketreg_date'];
			}
		}
	?>
          <div class="col-md-9 my-col">
            <div class="panel panel-default">
              <div class="panel-heading bg-danger">
                <h3 class="panel-title">Edit Ticket</h3>
              </div>
              <div class="panel-body">
                <form action="includes/process.php" method="POST">
                  <div class="form-group">
			<input type="hidden" name="ticket_id" value="<?php echo $ticket_id ?>"/>
                    <label>Ticket Header</label>
                    <input type="text" class="form-control" name="ticket_header" value="<?php echo $ticket_header; ?>" placeholder="Enter ticket header..." id="ticket_header" />
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea name="editor1" class="form-control" placeholder="Enter description..."><?php echo $tdesc; ?>
                    </textarea>
                  </div>
                  <div class="form-group">
                    <div class="checkbox">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="ticket_priority">Priority</label>
                        </div>
                        <select class="custom-select" name="ticket_priority" id="ticket_priority">
                          <option value=<?php echo$ticket_priority?> ><?php echo "$ticket_priority" ?>-Selected</option>
                          <option value="High">High</option>
                          <option value="Medium">Medium</option>
                          <option value="Low">Low</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <input type="submit" class="btn btn-outline-danger" name="Update" value="Update Ticket">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


<footer id="footer">
  <p>Copyright BugTracker, &copy; 2020</p>
</footer>
<!-- Modals -->

    <!-- Add Page -->
    <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="include/tickets_details.php" method="POST">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Create Ticket</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Ticket Header</label>
              <input type="text" class="form-control" name="ticket_header" placeholder="Ticket Header">
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="editor1" class="form-control" placeholder="Ticket Description"></textarea>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="tpriority">Priority</label>
                  </div>
                  <select class="custom-select" name="ticket_priority" id="tpriority">
                    <option selected>Choose Priority level...</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="file" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="insert"class="btn btn-outline-danger">POST Ticket</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
  </html>
