<?php
	session_start();
	if(	$_SESSION['start']!='1')
	{	echo "<center>You are not authorised to access this page.<br><a href='adminhome.php'>Go back to home page</a></center>";
	}
	
	$con = mysqli_connect("localhost","wd_user","wd_igdtuw","wd_db");
	
	if(mysqli_connect_errno()) //True if error found
	{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
	}
	$name = $_POST['name'];
	$login = $_POST['login'];
	$pass1 = sha1($_POST['pass1']);
	
	mysqli_query($con, "INSERT into evaluatortable(evaluatorLogin, evaluatorPassword, evaluatorName) VALUES('$login', '$pass1', '$name')");
	echo "<div id='div2'>You have succesfully registered the evaluator: <span style='color:#adacac;'>".$name."</span></div><br><div id='div1' onclick='sun()'>Back to home</div>";
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
			{	width:160px;
				height:140px;
				text-align:center;
				vertical-align:middle;
				line-height:140px;
				border-radius:90px;
				background-color:#008080;
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
				border:2px solid #008080;
			}
			@font-face
			{	font-family: 'Corbel';
				src: url('Fonts/corbel.ttf');
			}
		</style>
	</head>
</html>