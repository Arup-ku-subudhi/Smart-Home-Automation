<?php
	
	$db = mysqli_connect("localhost","root","","smarthome") or die("Could not connect to the database.");

	if(isset($_POST["Slight"]))
	{	
		$user_check_query = "SELECT * FROM operate WHERE Id = '11'  LIMIT 1";
		$results  = mysqli_query($db,$user_check_query);
		$user = mysqli_fetch_assoc($results);
		if($user)
		{
			if($user['Light'] == 0){
				$query = "UPDATE operate SET Light=1 WHERE Id=11";
				mysqli_query($db,$query);
				
				date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
				$dt = date("Y-m-d");
				$tm = date("H:i:s");
				$query = "INSERT INTO light_tb (Date,Time,OTime) VALUES ('$dt','$tm','')";
				mysqli_query($db,$query);
			}
			else{
				$query = "UPDATE operate SET Light=0 WHERE Id=11";
				mysqli_query($db,$query);
				
				date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
				$tm = date("H:i:s");
				$user_check_query = "SELECT MAX(Id) AS max FROM light_tb";
				$results  = mysqli_query($db,$user_check_query);
				$user = mysqli_fetch_assoc($results);
				$query = "UPDATE light_tb SET OTime='$tm' WHERE Id={$user['max']}";
				mysqli_query($db,$query);
			}
		}
	}

	if(isset($_POST["Sfan"]))
	{
		$user_check_query = "SELECT * FROM operate WHERE Id = '11'  LIMIT 1";
		$results  = mysqli_query($db,$user_check_query);
		$user = mysqli_fetch_assoc($results);
		if($user)
		{
			if($user['Fan'] == 0){
				$query = "UPDATE operate SET Fan=1 WHERE Id=11";
				mysqli_query($db,$query);
				
				date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
				$dt = date("Y-m-d");
				$tm = date("H:i:s");
				$query = "INSERT INTO fan_tb (Date,Time,OTime) VALUES ('$dt','$tm','')";
				mysqli_query($db,$query);
			}
			else{
				$query = "UPDATE operate SET Fan=0 WHERE Id=11";
				mysqli_query($db,$query);
				
				date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
				$tm = date("H:i:s");
				$user_check_query = "SELECT MAX(Id) AS max FROM fan_tb";
				$results  = mysqli_query($db,$user_check_query);
				$user = mysqli_fetch_assoc($results);
				$query = "UPDATE fan_tb SET OTime='$tm' WHERE Id={$user['max']}";
				mysqli_query($db,$query);
			}
		}
	}

	if(isset($_POST['Sdoor']))
	{
		$user_check_query = "SELECT * FROM operate WHERE Id = '11'  LIMIT 1";
		$results  = mysqli_query($db,$user_check_query);
		$user = mysqli_fetch_assoc($results);
		if($user)
		{
			if($user['Door'] == 0){
				$query = "UPDATE operate SET Door=1 WHERE Id=11";
				mysqli_query($db,$query);
				
				date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
				$dt = date("Y-m-d");
				$tm = date("H:i:s");
				$query = "INSERT INTO door_tb (Date,Time,OTime) VALUES ('$dt','$tm','')";
				mysqli_query($db,$query);
			}
			else{
				$query = "UPDATE operate SET Door=0 WHERE Id=11";
				mysqli_query($db,$query);
				
				date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
				$tm = date("H:i:s");
				$user_check_query = "SELECT MAX(Id) AS max FROM door_tb";
				$results  = mysqli_query($db,$user_check_query);
				$user = mysqli_fetch_assoc($results);
				$query = "UPDATE door_tb SET OTime='$tm' WHERE Id={$user['max']}";
				mysqli_query($db,$query);
			}
		}
	}

	if(isset($_POST['Dlight']))
	{
		$user_check_query = "SELECT * FROM operate WHERE Id = '11'  LIMIT 1";
		$results  = mysqli_query($db,$user_check_query);
		$user = mysqli_fetch_assoc($results);
		
		if($_POST['Lhr']==null && $_POST['Lmin']==null){
			echo "<script> alert('Enter Hour/Minute'); </script>";
		}
		else{
			$h = $_POST['Lhr'];
			$m = $_POST['Lmin'];
			$d = $h*60 + $m;
 			$query = "UPDATE operate SET dlight='$d' WHERE Id=11";
			mysqli_query($db,$query);
		}
	}
	
	if(isset($_POST['Dfan']))
	{
		$user_check_query = "SELECT * FROM operate WHERE Id = '11'  LIMIT 1";
		$results  = mysqli_query($db,$user_check_query);
		$user = mysqli_fetch_assoc($results);
		
		if($_POST['Fhr']==null && $_POST['Fmin']==null){
			echo "<script> alert('Enter Hour/Minute'); </script>";
		}
		else{
			$h = $_POST['Fhr'];
			$m = $_POST['Fmin'];
			$d = $h*60 + $m;
 			$query = "UPDATE operate SET dfan='$d' WHERE Id=11";
			mysqli_query($db,$query);
		}
	}
	if(isset($_POST['Ddoor']))
	{
		$user_check_query = "SELECT * FROM operate WHERE Id = '11'  LIMIT 1";
		$results  = mysqli_query($db,$user_check_query);
		$user = mysqli_fetch_assoc($results);
		
		if($_POST['Dhr']==null && $_POST['Dmin']==null){
			echo "<script> alert('Enter Hour/Minute'); </script>";
		}
		else{
			$h = $_POST['Dhr'];
			$m = $_POST['Dmin'];
			$d = $h*60 + $m;
 			$query = "UPDATE operate SET ddoor='$d' WHERE Id=11";
			mysqli_query($db,$query);	
		}
	}
	if(isset($_POST['auto']))
	{
		$user_check_query = "SELECT * FROM operate WHERE Id = '11'  LIMIT 1";
		$results  = mysqli_query($db,$user_check_query);
		$user = mysqli_fetch_assoc($results);
		if($user)
		{
			if($user['auto'] == 0){
				$query = "UPDATE operate SET auto=1 WHERE Id=11";
				mysqli_query($db,$query);
			}
			else{
				$query = "UPDATE operate SET auto=0 WHERE Id=11";
				mysqli_query($db,$query);
			}
		}
	}

?>