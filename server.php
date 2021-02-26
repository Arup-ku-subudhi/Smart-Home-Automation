<?php
	$db = mysqli_connect("localhost","root","","smarthome") or die("Could not connect to the database.");
	//$query = "INSERT INTO login (id,email,otp) VALUES ('11','arupkumar692@gmail.com','0')";
	
	if(isset($_POST['gotp']))
	{
		//echo "RAM";
		$email = mysqli_real_escape_string($db, $_POST['email']);
		if($email != null){
			if($email == "arupkumar692@gmail.com"){
				$query = "UPDATE operate SET gotp=1 WHERE Id=11";
				mysqli_query($db,$query);
				$_POST['email'] = "arupkumar692@gmail";
			}
		}
	}
	if(isset($_POST['login']))
	{
		if($_POST['otp']==null){
			echo "<script>alert('Your OTP box is not filled-up.')</script>";
		}
		else{
			if($_POST['email']=='arupkumar692@gmail.com'){
				$user_check_query = "SELECT * FROM login WHERE id = '11' LIMIT 1";
				$results  = mysqli_query($db,$user_check_query);
				$user = mysqli_fetch_assoc($results);
				if($_POST['otp']==$user['otp']){
					
					$query = "UPDATE login SET otp=0 WHERE id=11";
					mysqli_query($db,$query);
					header("location: Home.php");
				}
			}
		}
	}
	
?>


<!--
	session_start();
	$light=1;
	$fan=1;
	$door=1;
	$id=11;
	$db = mysqli_connect("localhost","root","","smarthome") or die("Could not connect to the database.");
	
	$query = "INSERT INTO operate (Id, Light, Door,Fan) VALUES ('$id','$light','$fan','$door')";
	mysqli_query($db,$query);*/
-->