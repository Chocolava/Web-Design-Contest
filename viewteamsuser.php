<?php
	session_start();
	if(@$_SESSION['loginstatus']!="true")
	{	exit( "<center>You are not authorised to access this page.<br><a href='home.html'>Go back to home page</a></center>");
	}
	else
	{	$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
		if(mysqli_connect_errno()) //True if error found
		{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
		}
		$sql = "SELECT * from teamtable";
		$res = mysqli_query($con, $sql);
		$count = 1;
		echo "<h3>The following teams have been registered for the contest:</h3>";
		echo "<table style='width:97%;margin:20px;'><tr><th>Serial #</th><th>Team Name</th><th>College</th><th>Members</th><th>Marks</th></tr>";
		
		while($ans = mysqli_fetch_array($res))
		{$ans1=explode(", ",$ans['collegeName']);	
		echo "<tr><td>".$count."</td><td>".$ans['teamName']."</td><td>";
		$i=1;
		foreach($ans1 as $val)
		{if($val=="")
		{break;}
		if($i>1)
		echo",";
		echo $val;$i++;
		}
		
		echo "</td><td>";
		$ans1=explode(", ",$ans['teamMembers']);$i=1;
		foreach($ans1 as $val)
		{if($val=="")
		{break;}
		if($i>1)
		echo",";
		echo $val;$i++;
		}
		
		echo"</td><td>".$ans['teamResult']."</td></tr>";
			$count= $count+1;
		}
		echo "</table><br><br>";
		echo"<br><div id='div1' onclick='sun()'>Back to home</div>";
		mysqli_close($con);
	}
?>

<html>
	<head>
		<title>View Teams</title>
		<script>
			function sun()
			{	window.location.href="userhome.php";
			
			}
		</script>
		<style>
		h3
		{	font-size:30px;
			font-family:Corbel;
			color:3333CC;
			font-weight:400;
			margin-left:300px;
		}
		tr
		{	width:20%;
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
			color:#585858 ;
		}
		body
		{	background-color:#faf9f4;
		}
		@font-face
		{	font-family: 'Corbel';
			src: url('Fonts/corbel.ttf');
		}
		a
		{	font-size:28px;
			margin-left:560px;
			text-decoration:none;
			color:#357ec7;
			cursor:pointer;
		}
		#div1
			{	width:180px;
				height:100px;
				text-align:center;
				horizontal-align:middle;
				line-height:100px;
				border-radius:90px;
				background-color:#357ec7;
				color:white;
				position:relative;
				margin-top:100px;
				margin-left:600px;
				font-size:24px;
				font-family:Corbel;
			}
			#div1:hover
			{	background-color:#b6b6b4;
			}
			@font-face
			{	font-family: 'Corbel';
				src: url('Fonts/corbel.ttf');
			}
		</style
		
	</head>
</html>
			