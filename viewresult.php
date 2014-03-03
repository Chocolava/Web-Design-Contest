<?php
    session_start();
	if(	@$_SESSION['loginstatus']!="true")
	{	exit( "<center><strong>You are not authorised to access this page.<br><a href='home3.html'>Go back to home page.</a></strong></center>");
	}
	else
	{
		$responsetext="";
      $con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
		if(mysqli_connect_errno()) //For checking any errors
		{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
		}
	  $query = "SELECT * FROM contesttable WHERE contestStatus='Current'";
	  $res = mysqli_query($con, $query);
	  $ans = mysqli_fetch_array($res);
	  if($_SESSION['result']==3)
	  {
		$responsetext.="<div id='div1'> Competition has not finished yet</div>";
	  }
	  else
	  {
	     $query = "SELECT * FROM teamtable ORDER BY teamResult DESC";
		 $res = mysqli_query($con, $query);//$stmt = sqlsrv_query( $conn, $sql);
		 $rows= mysqli_num_rows($res);
		 $i=0;
		 $var = 1;
		 $responsetext.="<table style='width:97%;margin-left:20px;margin-top:50px;position:relative;'><tr><th>Serial #</th><th>Team Name</th><th>Result</th></tr>";
		 while($i<$rows)
		 {  
		    mysqli_data_seek ( $res,$i );
			$ans = mysqli_fetch_assoc($res);
			if($ans['teamName'][$i]==$_SESSION['id'])
			$responsetext.="<tr><td>".$var."</td><td>".$ans['teamName']."</td><td>".$ans['teamResult']."</td></tr>";
			else
			$responsetext.="<b><tr><td>".$var."</td><td>".$ans['teamName']."</td><td>".$ans['teamResult']."</td></tr></b>";
			$i=$i+1;
			$var = $var + 1;
			
		 }
		 $responsetext.="</table>";
	  }
	  $responsetext.="<div id='div3' onclick='sun()'> Back to Home</div>";
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
			#div3
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
			#div3:hover
			{	background-color:#b6b6b4;
			}
			@font-face
			{	font-family: 'Corbel';
				src: url('Fonts/corbel.ttf');
			}
			#div1
			{	width:700px;
				height:100px;
				text-align:center;
				<!--vertical-align:middle;#43bfc7-->
				line-height:140px;
				border-radius:90px;
				background-color:white;
				color:#25383C;
				position:absolute;
				margin-top:50px;
				margin-left:340px;
				font-size:50px;
				font-family:Corbel;
			}
			#div2
			{	width:700px;
				height:500px;
				text-align:center;
				<!--vertical-align:middle;#43bfc7-->
				line-height:140px;
				font-size:80px;
				border-radius:90px;
				background-color:white;
				color:#25383C;
				position:absolute;
				margin-top:40px;
				margin-left:340px;
				font-size:24px;
				font-family:Corbel;
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
			margin-left:400px;
		}
		tr
		{	width:20%;
			height:30px;
			color:#585858;
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
		table
		{	position:absolute;
			margin-top:50px;
			margin-left:200px;
		}
		</style>
	</head>
</html>
