<?php
	session_start();
	if(@$_SESSION['loginstatus']!="true")
	{	exit( "<center><strong>You are not authorised to access this page.<br><a href='home3.html'>Go back to home page.</a></strong></center>");
	}
	else
	{	$id=$_SESSION['id'];
		$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
		if(mysqli_connect_errno()) //For checking any errors
		{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
		}
		$query = "SELECT * from teamtable where teamName ='$id'";
		$res = mysqli_query($con, $query);
		$ans = mysqli_fetch_array($res);
	
		echo "<div id='div2'>";
		echo "<br><b>Team Name:  </b>".$ans['teamName'];
		echo "<br><b>College: </b>".$ans['collegeName'];
		echo "<br><b>Team Members: </b>";
		echo "<ul>";
	    $team=$ans['teamMembers'];
		$teamMem=explode(",",$team);
		echo "<ul>";
		foreach($teamMem as $element)
         {
			echo "<li>";
            echo $element."<br>";
			echo "</li>";
         }
		echo "</ul>";
		echo"</div>";
		echo"<br><div id='div1' onclick='sun()'>Back to home</div>";
		mysqli_close($con);
	}
?>
<html>
	<head>
		<script>
			function sun()
			{	window.location.href="userhome.php";
			
			}
		</script>
		<style>
			#div1
			{	width:180px;
				height:90px;
				text-align:center;
				horizontal-align:middle;
				line-height:100px;
				border-radius:90px;
				background-color:#008080;
				color:white;
				position:absolute;
				margin-top:350px;
				margin-left:320px;
				font-size:24px;
				font-family:Corbel;
			}
			#div2
			{	width:700px;
				height:400px;
				text-align:left;
				<!--vertical-align:middle;25383C-->
				line-height:140px;
				font-size:80px;
				font-color:magenta;
				border-radius:90px;
				background-color:white;
				color:#25383C;
				position:absolute;
				margin-top:10px;
				margin-left:340px;
				font-size:24px;
				font-family:Corbel;
			}
			#div1:hover
			{	background-color:#43bfc7;
			}
			@font-face
			{	font-family: 'Corbel';
				src: url('Fonts/corbel.ttf');
			}
		</style>
	</head>
</html>
