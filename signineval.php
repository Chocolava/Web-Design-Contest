<?php
	session_start();
	$_SESSION['id'] = $_POST['user1'];
	$con = mysqli_connect("localhost", "wd_user", "wd_igdtuw", "wd_db");
	if(mysqli_connect_errno()) //True if error found
	{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
	}
	$password = sha1($_POST['pass1']);
	$res = mysqli_query($con, "SELECT * FROM  evaluatortable WHERE evaluatorLogin = '$_POST[user1]'");
	$row = mysqli_fetch_array($res);
	if($row['evaluatorPassword'] != $password )
	{	exit("<center>Password or ID seems to be incorrect<br><a href='home.html'>Go back to home page</a><center>");
	}
	else
	{	$_SESSION['start'] = 1;
		header('Location:eval.php');
	}
?>