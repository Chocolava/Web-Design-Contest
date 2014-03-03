<?php
	session_start();
	if(@$_SESSION['loginstatus']!="true")
	{	exit( "<center><strong>You are not authorised to access this page.<br><a href='home3.html'>Go back to home page.</a></strong></center>");
	}
	else
	{	$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
		if(mysqli_connect_errno()) //For checking any errors
		{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
		}
		$query = "SELECT * from teamtable where teamName = '".$_SESSION['id']."' ";
		$res = mysqli_query($con, $query);
		$ans = mysqli_fetch_array($res);
		$coleges=$ans['collegeName'];
		$coll=explode(", ",$coleges);
		$num=count($coll);
		$team=$ans['teamMembers'];
		$teamMem=explode(",",$team);
		$responsetext="<div id='div2'>";
		$responsetext.="<b><h3>Team Name:  </b>".$ans['teamName']."</h3>";
		$responsetext.="<b><h3>Team Details: </b></h3>";
		//echo "<br><b>College: </b>".$ans['collegeName'];
	/*	echo "<br><b>Colleges: ";
		echo "<ul>";
		for($i=0;$i<$num;$i++)
		{
			if($coll[$i]=="")
			{
			break;
			}
			else {
			echo "<li>";
			echo $coll[$i]."<br>";
			echo "</li>";}
		}
		echo "</ul>";
		echo "<br><b>Team Members: </b>";
		echo "<ul>";
	    
		echo "<ul>";
		for($j=0;$j<$num;$j++)
         {	if($teamMem[$j]=="")
				{
					break;
				}
			else{
			echo "<li>";
            echo $teamMem[$j]."<br>";
			echo "</li>";
         }}
		echo "</ul>";
*/
		$responsetext.="<table style='width:97%;margin:0px;'>";
		$responsetext.="<tr>";
		$responsetext.="<th>";
		$responsetext.="Name";
		$responsetext.="</th>";
		$responsetext.="<th>";
		$responsetext.="College";
		$responsetext.="</th>";
		$responsetext.="</tr>";
		for($i=0;$i<$num;$i++)
		{
		if($coll[$i]=="")
		{
			break;
		}
		else
		{
		$responsetext.="<tr>";
		$responsetext.="<td>";
		$responsetext.=$teamMem[$i];
		$responsetext.="</td>";
		$responsetext.="<td>";
		$responsetext.=$coll[$i];
		$responsetext.="</td>";
		$responsetext.="</tr>";
		}
		}
		//echo "</tr>";
		$responsetext.="</div>";
		$responsetext.="<br><div id='div1' onclick='sun()'>Back to home</div>";
		echo $responsetext;
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
				background-color:#357ec7;
				color:white;
				position:absolute;
				margin-top:350px;
				margin-left:300px;
				font-size:24px;
				font-family:Corbel;
			}
			#div2
			{	width:900px;
				height:700px;
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
				margin-left:200px;
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
			
		</style>
	</head>
</html>
