<?php
	session_start();
	if(	$_SESSION['start']!='1')
	{	exit( "<center>You are not authorised to access this page.<br><a href='adminhome.php'>Go back to home page</a></center>");
	}
	$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
	if(mysqli_connect_errno()) //True if error found
	{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
	}
	$name = $_POST['name'];
	$sql = "DELETE FROM admintable WHERE adminName='$name'";
	mysqli_query($con, $sql);
	echo "<div id='div1' onclick='sun()'><center>Admin succesfully deleted. Go back to home page</center></div>";
	mysqli_close($con);
	
?>
<html>
	<head>
		<script>
			function sun()
			{	window.location.href="adminhome.php";
			}
		</script>
		<style>
			#div1
			{	width:520px;
				height:140px;
				text-align:center;
				vertical-align:middle;
				line-height:140px;
				border-radius:90px;
				background-color:#78ca20;
				color:white;
				position:absolute;
				margin-top:160px;
				margin-left:480px;
				font-size:24px;
				font-family:Corbel;
				cursor:ponter;
			}
			#div1:hover
			{	background-color:#adacac;
			}
			@font-face
			{	font-family: 'Corbel';
				src: url('Fonts/corbel.ttf');
			}
		</style>
	</head>
</html>