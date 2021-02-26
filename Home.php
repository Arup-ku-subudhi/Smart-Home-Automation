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
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
<style>
#re{
	background-image: linear-gradient(to bottom right, lightgray, gray,gray,lightgray);
	width:450px;
	height:345px;
	opacity:0.9;
	border-radius:4rem;
	margin-top:15px;
	margin-bottom:50px;
	
}
#re2{
	background-image: linear-gradient(to bottom right, lightgray, gray,gray,lightgray);
	width:490px;
	height:310px;
	opacity:0.9;
	border-radius:4rem;
	margin-top:15px;
	margin-bottom:20px;
	
}

button{
	width:23%; border-radius:5px; border:1px solid black; color:white; background-color:#2c3e50;padding:3px 0;
}
</style>


<script type="text/javascript">
$('.clockpicker').clockpicker();
</script>
  
</head>
<body style="background-color:gray;">

<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="display:flex; justify-content:space-between; align-items:center;">
<h1 class="justify-content-left text-primary active" style="font-weight:300;"><b><strong>My Smart Home</strong></b></h1>
  <ul class="navbar-nav" >
    <li class="nav-item active">
      <a class="nav-link" href="#"><h4>Home</h4></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="Light.php"><h4>Light</h4></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="Fan.php"><h4>Fan</h4></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="Door.php"><h4>Door</h4></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="s_login.php"><h4>Logout</h4></a>
    </li>
  </ul>
</nav>

<center><div id="re">
         <fieldset>
<form method="POST" action="Home.php" align="center"><br><br>
	<div>
	<span class="badge badge-pill badge-info" style="height:auto;font-size:30px;width:300px; color:black;"><h4>Operate gadgets</h4></span><br><br>
	<span> <img src="https://cdn0.iconfinder.com/data/icons/education-340/100/Tilda_Icons_1ed_lightbulb_14-256.png" style="height:50px; width:50px;" alt="img"></span>
	
	<button type="submit" id="light" name="Slight" style="background-color:dark;"><h5>Light</h5></button> &nbsp &nbsp <label class="badge badge-secondary" style=" height:25px;font-size:15px;width:70px">Status:</label>
	<?php 
	
		$db = mysqli_connect("localhost","root","","smarthome") or die("Could not connect to the database.");
		$user_check_query = "SELECT * FROM operate WHERE Id = '11'  LIMIT 1";
		$results  = mysqli_query($db,$user_check_query);
		$user = mysqli_fetch_assoc($results);
		if($user)
		{
			if($user['Light'] == 0){
				echo "<a href='#' class='badge badge-danger'>Off</a>";
				
				$user_check_query = "SELECT * FROM light_tb WHERE Id = (SELECT MAX(Id) FROM light_tb)";
				$results  = mysqli_query($db,$user_check_query);
				$user = mysqli_fetch_assoc($results);
				echo "&nbsp <b>From: </b>{$user['OTime']}";
			}
			else{
				echo "<a href='#' class='badge badge-success'>On</a>";
				
				$user_check_query = "SELECT * FROM light_tb WHERE Id = (SELECT MAX(Id) FROM light_tb)";
				$results  = mysqli_query($db,$user_check_query);
				$user = mysqli_fetch_assoc($results);
				echo "&nbsp <b>From: </b>{$user['Time']}";
			}
		}
	?>
	
	</div><br>
	
	<div>
	<span> <img src="https://cdn1.iconfinder.com/data/icons/science-technology-outline-24-px/24/fan_wheel_windmill_rays_radiate-256.png" style="height:50px; width:50px;" alt="img"></span>
	<button type="submit" name="Sfan" style=" background-color:blueviolet;"><h5>Fan</h5></button> &nbsp &nbsp <label class="badge badge-secondary" style=" height:25px;font-size:15px;width:70px">Status:</label>
	<?php 
	
		$db = mysqli_connect("localhost","root","","smarthome") or die("Could not connect to the database.");
		$user_check_query = "SELECT * FROM operate WHERE Id = '11'  LIMIT 1";
		$results  = mysqli_query($db,$user_check_query);
		$user = mysqli_fetch_assoc($results);
		if($user)
		{
			if($user['Fan'] == 0){
				echo "<a href='#' class='badge badge-danger'>Off</a>";
				
				$user_check_query = "SELECT * FROM fan_tb WHERE Id = (SELECT MAX(Id) FROM fan_tb)";
				$results  = mysqli_query($db,$user_check_query);
				$user = mysqli_fetch_assoc($results);
				echo "&nbsp <b>From: </b>{$user['OTime']}";
			}
			else{
				echo "<a href='#' class='badge badge-success'>On</a>";
				
				$user_check_query = "SELECT * FROM fan_tb WHERE Id = (SELECT MAX(Id) FROM fan_tb)";
				$results  = mysqli_query($db,$user_check_query);
				$user = mysqli_fetch_assoc($results);
				echo "&nbsp <b>From: </b>{$user['Time']}";
			}
		}
	?>
	</div><br>
	<div>
	<span> <img src="https://cdn2.iconfinder.com/data/icons/donkey/800/2-256.png" style="height:50px; width:50px;" alt="img"></span>
	<button type="submit" name="Sdoor" style=" background-color:purple;"><h5>Door</h5></button> &nbsp &nbsp <label class="badge badge-secondary" style=" height:25px;font-size:15px;width:70px">Status :</label>
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
				echo "&nbsp <b>From: </b>{$user['OTime']}";
			}
			else{
				echo "<a href='#' class='badge badge-success'>On</a>";
				
				$user_check_query = "SELECT * FROM door_tb WHERE Id = (SELECT MAX(Id) FROM door_tb)";
				$results  = mysqli_query($db,$user_check_query);
				$user = mysqli_fetch_assoc($results);
				echo "&nbsp <b>From: </b>{$user['Time']}";
			}
		}
	?>
	</div>
	<br>
	<div id="re2">
        <fieldset><br>
			<span class="badge badge-pill badge-info" style="height:auto;font-size:30px;width:280px; color:black;"><h4><b>Alert Duration<b></h4></span><br><br>
			<div class="input-group clockpicker justify-content-center">
				
				<a href="#" class="badge badge-secondary col-3" style=" height:35px;font-size:20px;width:50px">
				<span> <img src="https://cdn0.iconfinder.com/data/icons/education-340/100/Tilda_Icons_1ed_lightbulb_14-256.png" style="height:30px; width:30px;" alt="img"></span>
				Light</a>&nbsp
					<input type="number" min="0" max="23" class="form-control col-2" value =0 name="Lhr" style="height:30px;" placeholder="09">Hr &nbsp 
					<input type="number" min="0" max="60" class="form-control col-2" value =0 name="Lmin" style="height:30px;" placeholder="30">Min
					<button type="submit" class="btn btn-primary mb-2" name="Dlight" style="background-color:info; width:75px; height:35px;">Submit</button>
					
			</div>
			<div class="input-group clockpicker justify-content-center">
			  <a href="#" class="badge badge-secondary col-3" style=" height:35px;font-size:20px;width:50px">
			  <span> <img src="https://cdn1.iconfinder.com/data/icons/science-technology-outline-24-px/24/fan_wheel_windmill_rays_radiate-256.png" style="height:30px; width:30px;" alt="img"></span>
			  &nbsp Fan</a>&nbsp
					<input type="number" min="0" max="23" class="form-control col-2" value =0 name="Fhr" style="height:30px;" placeholder="09">Hr &nbsp 
					<input type="number" min="0" max="60" class="form-control col-2" value =0 name="Fmin" style="height:30px;;" placeholder="30">Min 
					<button type="submit" class="btn btn-primary mb-2" name="Dfan" style="background-color:info; width:75px; height:35px;">Submit</button>
					
			</div>
			<div class="input-group clockpicker justify-content-center">
			  <a href="#" class="badge badge-secondary col-3" style=" height:35px;font-size:20px;width:50px">
			  <span> <img src="https://cdn2.iconfinder.com/data/icons/donkey/800/2-256.png" style="height:30px; width:30px;" alt="img"></span>
			  Door</a>&nbsp
					<input type="number" min="0" max="23" class="form-control col-2" value =0 name="Dhr" style="height:30px;" placeholder="09">Hr &nbsp 
					<input type="number" min="0" max="60" class="form-control col-2" value =0 name="Dmin" style="height:30px;" placeholder="30">Min
					<button type="submit" class="btn btn-primary mb-2" name="Ddoor" style="background-color:info; width:75px; height:35px;">Submit</button>
					
			</div>
			
			<div class="input-group clockpicker justify-content-center">
				<button  type="submit" class="btn btn-secondary col-5" name="auto" style="height:auto;font-size:20px;width:auto">
				Auto Shut down</button>&nbsp
				<?php
					
					$user_check_query = "SELECT * FROM operate WHERE Id = '11'  LIMIT 1";
					$results  = mysqli_query($db,$user_check_query);
					$user = mysqli_fetch_assoc($results);
					if($user)
					{
						if($user['auto'] == 0){
							echo "<a href='#' class='badge badge-danger' style='height:25px;font-size:auto;width:auto'>OFF</a>";
						}
						else{
							echo "<a href='#' class='badge badge-success' style='height:25px;font-size:auto;width:auto'>ON</a>";
						}
					}
				?>
			</div>
			<strong><b>*</b><i>(Here you will get an email according to your duration.)</i></strong><br>
		</fieldset>
	
</form></fieldset></div>
</center>
</body>
</html>