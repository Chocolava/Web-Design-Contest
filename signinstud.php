<?php
	session_start();
	$_SESSION['id'] = $_POST['user1'];
	$con = mysqli_connect("localhost", "wd_user", "wd_igdtuw", "wd_db");
	if(mysqli_connect_errno()) //True if error found
	{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
	}
	$password = sha1($_POST['pass1']);
	$res = mysqli_query($con, "SELECT * FROM  teamtable WHERE teamName = '$_POST[user1]'");
	$row = mysqli_fetch_array($res);
	
	if($row['teamPassword'] != $password )
	{	echo "<center>Password or ID seems to be incorrect<br> ";
			exit("<a href='home.html'>Go back to home page</a><center>");
	}
	else
	{
		$_SESSION['loginstatus']="true"; 
		$query = "SELECT * FROM contesttable where contestStatus='Current' ";
		$res = mysqli_query($con, $query);
		$ans = mysqli_fetch_array($res);//Assuming one contest to be active at a time 
	   $_SESSION['contest']=$ans['contestName'];
		$_SESSION['uploaded']="false";
		$_SESSION['id'] = $_POST['user1'];
		header('Location:userhome.php');
		
	}
?>
