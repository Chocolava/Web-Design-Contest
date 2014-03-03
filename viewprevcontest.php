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
		$sql = "SELECT * from contesttable WHERE contestStatus='Completed'";
		$res = mysqli_query($con, $sql);
		$count = 1;
		echo "<h3>The following contests have been conducted previously:</h3>";
		echo "<table style='width:97%;margin:20px;'><tr><th>Serial #</th><th>Contest Name</th><th>Start date</th><th>Winner</th><th>Runner Up</th><th>Marks</th></tr>";
		while($ans = mysqli_fetch_array($res))
		{	echo "<tr><td id='d1'>".$count."</td><td>".$ans['contestName']."</td><td>".$ans['startDate']."</td><td>".$ans['winner1']."</td><td>".$ans['winner2']."</td></tr>";
			$count= $count+1;
		}
		echo "</table>";
		mysqli_close($con);
	}
?>

<html>
	<head>
		<title>View Teams</title>
		<style>
		h3
		{	font-size:30px;
			font-family:Corbel;
			color:#41a317;
			font-weight:400;
		}
		tr
		{
			height:30px;
		}
		th
		{	color:#565051;
			font-size:26px;
			text-decoration:underline;
		}
		td
		{	text-align:center;
			font-size:22px;
			font-family:Corbel;
		}
		body
		{	background-color:#faf9f4;
		}
		@font-face
		{	font-family: 'Corbel';
			src: url('Fonts/corbel.ttf');
		}
		#a1
		{	font-size:28px;
			margin-left:150px;
			text-decoration:none;
			color:#41a317;
			cursor:pointer;
		}
		#a2
		{	font-size:28px;
			margin-left:660px;
			text-decoration:none;
			color:#41a317;
			cursor:pointer;
		}
		</style>
		<script>
			function func()
			{	var x = confirm("You are about to delete all previous records. Are you sure you want to proceed?");
				if(x== true)
				{	window.location.href="clearcontesttable.php";
				}
			}
		</script>
	</head>
	<a href="adminhome.php" id="a1">Back</a>
	<a href="clearcontesttable.php" id="a2" onclick="func()">Delete all previous records</a>
</html>
			