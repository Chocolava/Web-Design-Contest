<?php
	session_start();
	if(	@$_SESSION['loginstatus']!="true")
	{	exit( "<center><strong>You are not authorised to access this page.<br><a href='home3.html'>Go back to home page.</a></strong></center>");
	}
	else
	{	
		echo"<div id='d1'>";
		$responsetext="";
		$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
		if(mysqli_connect_errno()) //For checking any errors
		{	$responsetext.="Failed to connect to mySQL: ". mysqli_connect_error();
		}
		$query = "SELECT * FROM contesttable WHERE contestStatus='current' ";
		$res = mysqli_query($con, $query);
		$ans = mysqli_fetch_array($res);//Assuming one contest to be active at a time 
	    if($ans)
		{
		$contestName=$ans['contestName'];
		$startDate=$ans['startDate'];
		$endDate=$ans['endDate'];
		//$startTime=$ans['startTime'];
		//$endTime=$ans['endTime'];
		$date1=new DateTime($startDate);
		$date2=new DateTime($endDate);
        $diff=$date1->diff($date2);
		//$time1=new DateTime($startTime);
		//$time2=new DateTime($endTime);
	    //$diff1=$time1->diff($time2);
		$days=$diff->format("%d");
		//$d2=floor(($diff1->format("%H"))/24);
		$hours=$diff->format("%H");
		$min=$diff->format("%i");
		$sec=$diff->format("%s");
		//$h1=($diff1->format("%H"))%24;
		//$h2=floor(($diff1->format("%i"))/60);
		//$hours=$h1+$h2;
		//$m1=($diff1->format("%i"))%60;
		//$m2=floor(($diff1->format("%s"))/60);
		//$min=$m1+$m2;
		//$sec=($diff1->format("%s"))%60;
		$responsetext.="<div id='div2'><table style='width:100%;margin-left:20px;margin-top:50px;position:relative;'><tr><th>Contest Name</th><th>Contest Start Date</th><th>Contest End Date</th><th>Duration(d/h/m/s)</th></tr>";
		$responsetext.="<tr><td>".$contestName."</td><td>".$startDate."</td><td>".$endDate."</td><td>".$days." days ".$hours." hours ".$min." minutes and ".$sec." seconds</td></tr></table></div>";
		}
		else
		{
		$responsetext.="<div id='div3' >Contest has ended</div>";
		}
		$responsetext.="<br><div id='div1' onclick='sun()'>Back to home</div>";
		echo $responsetext;
		echo"</div>";
		//$_SESSION['contest']=$contestName;
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
				height:100px;
				text-align:center;
				horizontal-align:middle;
				line-height:100px;
				border-radius:90px;
				background-color:#357ec7;
				color:white;
				position:absolute;
				margin-top:250px;
				margin-left:600px;
				font-size:24px;
				font-family:Corbel;
			}
			@font-face
			{	font-family: 'Corbel';
				src: url('Fonts/corbel.ttf');
			}
			#div2
			{	width:800px;
				height:70px;
				text-align:center;
				<!--vertical-align:middle;#43bfc7-->
				line-height:140px;
				font-size:80px;
				border-radius:90px;
				background-color:white;
				color:#357ec7;
				position:absolute;
				margin-top:40px;
				margin-left:340px;
				font-family:Corbel;
				font-size:26px;
			}
			#div3
			{
			  width:200px;
			  height:70px;
			  text-align:center;
			  font-size:80px;
			  color:#25383C;
			  margin-top:100px;
			  margin-left:480px;
			  font-family:Corbel;
			}
			#div1:hover
			{	background-color:#b6b6b4;
			}
			@font-face
			{	font-family: 'Corbel';
				src: url('Fonts/corbel.ttf');
			}
			tr
			{	
				width:20%;
				height:20px;
				color:#585858 ;
			}
			th
			{
			color:3333CC;
			font-size:20px;
			text-decoration:underline;
			font-family: 'Corbel';
			}
			td
			{
			font-family: 'Corbel';
			font-size:18px;
			}
			#d1
			{	
				width:1400px;
				height:900px;
				background-color:#faf9f4;
			}
			
		</style>
	</head>
</html>
