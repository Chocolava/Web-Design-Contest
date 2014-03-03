<?php
	session_start();
	if(	$_SESSION['start']!='1')
	{	echo "<center>You are not authorised to access this page.<br><a href='adminhome.php'>Go back to home page</a></center>";
	}
	else
	{	$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
		if(mysqli_connect_errno()) //True if error found
		{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
		}
		$sql2 = "DELETE FROM contesttable";
		mysqli_query($con, $sql2);
		header('Location: adminhome.php');
		mysqli_close($con);
	}
?>