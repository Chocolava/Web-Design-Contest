<?php
	session_start();
	if(	$_SESSION['start']!='1')
	{	exit( "<center>You are not authorised to access this page.<br><a href='home.html'>Go back to home page</a></center>");
	}
	else
	{	$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
		if(mysqli_connect_errno()) //True if error found
		{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
		}
		
		$sql = "SELECT * from admintable";
		$result = mysqli_query($con, $sql);
		$res = "<h3 style='font-size:24px;color:#348017;'>The following administrators have been registered on your system: </h3>";
		$res .= "<ul>";
		while($ans = mysqli_fetch_array($result))
		{	$res .= "<li>".$ans['adminName']."</li>";
		}
		$res .= "</ul>";
		echo $res;
		mysqli_close($con);
	}
?>

<html>
<head>
<style>
ul
{	list-style-image: url('Random/greenbullet2.jpg');
	margin-left:60px;
	font-size:22px;
	font-family:Corbel;
	color:#565051;
	font-weight:400;
	letter-spacing:1px;
}
</style>
</head>
	<body>
		<form action= "deleted.php" method="post">
			<label style="width:500px;float:left;margin:auto;">Enter the name of the Admin you wish to delete: </label><input type="text" name="name"><br><br>
			<input type="submit" style="margin-top:20px;">
		</form>
	</body>
</html>
					