<?php
	session_start();
	if(	@$_SESSION['loginstatus']!="true")
	{	exit( "<center><strong>You are not authorised to access this page.<br><a href='home3.html'>Go back to home page.</a></strong></center>");
	}
	else
	{	$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
	    $responsetext="";
		if(mysqli_connect_errno()) //For checking any errors
		{	$responsetext.="Failed to connect to mySQL: ". mysqli_connect_error();
		}
		$query = "SELECT * from teamtable ";
		$res = mysqli_query($con, $query);
		$no_of_rec=mysqli_num_rows($res);
		$responsetext.="<div id='div2'><table border=1><tr><td>Team Name</td><td>Team Members</td><td>College</td></tr>"  ;
		 $i=0;
		 while($i<$no_of_rec)
		{
			mysqli_data_seek ( $res,$i );
			$ans = mysqli_fetch_assoc($res);
		    $responsetext.="<tr><td>$ans[teamName]</td><td>$ans[teamMembers]</td><td>$ans[collegeName]</td></tr>";
			$i++;
		}
		$responsetext.="</table></div>";
		$responsetext.="<br><div id='div1' onclick='sun()'>Back to home</div>";
		mysqli_close($con);
		echo $responsetext;
		
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
				margin-left:480px;
				font-size:24px;
				font-family:Corbel;
			}
			#div2
			{	
				text-align:left;
				<!--vertical-align:middle;25383C-->
				line-height:140px;
				font-size:80px;
				font-color:black;
				border-radius:90px;
				background-color:white;
				color:#25383C;
				position:absolute;
				margin-top:10px;
				margin-left:340px;
				//font-size:24px;
				font-family:Corbel;
			}
			#div1:hover
			{	background-color:#b6b6b4;
			}
			@font-face
			{	font-family: 'Corbel';
				src: url('Fonts/corbel.ttf');
			}
		</style>
	</head>
</html>
