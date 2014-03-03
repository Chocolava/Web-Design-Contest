<?php
	session_start();
	
	$id = $_SESSION['id'];
	if(	$_SESSION['start']!='1')
	{	echo "<center>You are not authorised to access this page.<br><a href='adminhome.php'>Go back to home page</a></center>";
	}
	else
	{	$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
		if(mysqli_connect_errno()) //True if error found
		{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
		}
		$pass = sha1($_POST['pass2']);
		
		$sql = "UPDATE evaluatortable SET evaluatorPassword = '$pass' WHERE evaluatorLogin = '$id'";
		
		mysqli_query($con, $sql);
		
		echo "<div id='div2'>You have succesfully changed the password</div><br><div id='div1' onclick='sun()'>Back to home</div>";
		mysqli_close($con);
	}
?>
<html>
	<head>
		<script>
			function sun()
			{	window.location.href="eval.php";
			}
		</script>
		<style>
			#div1
			{	width:160px;
				height:140px;
				text-align:center;
				vertical-align:middle;
				line-height:140px;
				border-radius:90px;
				background-color:#f62217;
				color:white;
				position:absolute;
				margin-top:160px;
				margin-left:940px;
				font-size:24px;
				font-family:Corbel;
				cursor:pointer;
			}
			#div2
			{	width:640px;
				height:140px;
				text-align:center;
				vertical-align:middle;
				line-height:140px;
				border-radius:90px;
				background-color:white;
				color:#008080;
				position:absolute;
				margin-top:180px;
				margin-left:160px;
				font-size:24px;
				font-family:Corbel;
			}
			#div1:hover
			{	background-color:white;
				color:#008080;
			}
			@font-face
			{	font-family: 'Corbel';
				src: url('Fonts/corbel.ttf');
			}
		</style>
	</head>
</html>