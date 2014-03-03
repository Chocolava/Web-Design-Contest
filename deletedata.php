<?php
	session_start();
	if(	$_SESSION['start']!='1')
	{	exit( "<center>You are not authorised to access this page.<br><a href='adminhome.php'>Go back to home page</a></center>");
	}
		
	$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
	if(mysqli_connect_errno()) //True if error found
	{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
	}
	
	$sql = "DELETE FROM admintable WHERE adminName='$name'";
	mysqli_query($con, $sql);
	echo "<div id='div1' onclick='sun()'><center>Go back to home page</center></div>";
	mysqli_close($con);
?>