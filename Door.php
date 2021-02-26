<!DOCTYPE html>
<?php include('update.php'); ?>

<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="background-color:gray;">


<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="display:flex; justify-content:space-between; align-items:center;">
<h1 class="justify-content-left text-primary" style="font-weight:300;"><b><strong>My Smart Home</strong></b></h1>
  <ul class="navbar-nav" >
    <li class="nav-item">
      <a class="nav-link" href="Home.php"><h4>Home</h4></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="Light.php"><h4>Light</h4></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="Fan.php"><h4>Fan</h4></a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#"><h4>Door</h4></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="s_login.php"><h4>Logout</h4></a>
    </li>
  </ul>
</nav>


<form method="POST" action="Door.php" align="center"><br><br>
<div>
	
	<button type="submit" name="Sdoor" class="btn btn-dark" style="padding:5px 20px;"><h6>Door</h6></button>
	<?php 
	
		$db = mysqli_connect("localhost","root","","smarthome") or die("Could not connect to the database.");
		$user_check_query = "SELECT * FROM operate WHERE Id = '11'  LIMIT 1";
		$results  = mysqli_query($db,$user_check_query);
		$user = mysqli_fetch_assoc($results);
		if($user)
		{
			if($user['Door'] == 0){
				echo "<a href='#' class='badge badge-danger'>Off</a>";
				
				$user_check_query = "SELECT * FROM door_tb WHERE Id = (SELECT MAX(Id) FROM door_tb)";
				$results  = mysqli_query($db,$user_check_query);
				$user = mysqli_fetch_assoc($results);
				echo "&nbsp <h4 class='d-inline text-white'>From: <i>{$user['OTime']}</i></h4>";
				
			}
			else{
				echo "<a href='#' class='badge badge-success'>On</a>";
			
				$user_check_query = "SELECT * FROM door_tb WHERE Id = (SELECT MAX(Id) FROM door_tb)";
				$results  = mysqli_query($db,$user_check_query);
				$user = mysqli_fetch_assoc($results);
				echo "&nbsp <h4 class='d-inline text-white'>From: <i>{$user['Time']}</i></h4>";
			}
		}
	?>
	
	</div><br>
	
	</form>


<center>
<form method='POST'>
	<div>
		<h3 class="text-white ">Get History: </h3>
		<div class="col-2 input-group-prepend"  style="margin-bottom:20px;">
			
			<input type="date" name="date" class="form-control" value="2020-12-23" id="example-date-input">
			<input type="submit" name="sdate" class="btn btn-secondary" value="Submit">
		</div>
		<?php
			$count = 0;
			if(isset($_POST['sdate'])){
				if($_POST['date'] == null){
					echo "<script>alert('Enter A date');</script>";
				}
				else{				
					$d = $_POST['date'];
					$user_check_query = "SELECT * FROM door_tb WHERE Date = '$d'";
					$results  = mysqli_query($db,$user_check_query);
					$num_rows = mysqli_num_rows($results);
					$user = mysqli_fetch_assoc($results);
						
					if($num_rows>=1)
					{
						$k=$user['Id'];
						for($i=$k;$i < $num_rows+$k;$i++)
						{	
							$user_check_query = "SELECT * FROM door_tb WHERE Date = '$d' AND Id = '$i'";
							$results  = mysqli_query($db,$user_check_query);
							$user = mysqli_fetch_assoc($results);
							?>
							<div class="container">
							  <div class="row bg-dark text-white" style="padding:10px 20px; border:1px solid lightgray">
								<?php
									echo "<div class='col'>Id : ".$user['Id']."</div>";
									echo "<div class='col'> Date : ".$user['Date']."</div>";
									echo "<div class='col'> Start Time : ".$user['Time']."</div>";
									echo "<div class='col'> End Time : ".$user['OTime']."</div>";
									if($user['OTime']!='00:00:00'){
									$dr = round(abs(strtotime($user['OTime']) - strtotime($user['Time']))/60,2);
									$count += $dr;  // This is for calculating the total Duration time.
									echo "<div class='col'> Duration : ".$dr." Min</div>";
									echo "<br>";
									}
									else{ echo "<div class='col'> Duration : ".'0'." Min</div>"; }
								?>
							  </div>
							</div>
							<?php	
						}
						
						?>
							<div class="row bg-dark text-white" style="padding:10px 20px; border:1px solid lightgray">
								<?php
								
								echo "<div class='col'> Total Duration of the Day : </div>";
								echo "<div class='col'>".$count." Min</div>";
								
								?>
							</div>
						<?php
						
					}
					else{ echo "<h3>Sorry, There is no records in this date.</h3>"; }
				}
			}
		?>
	</div>
</form>
</center>

</body>
</html>
