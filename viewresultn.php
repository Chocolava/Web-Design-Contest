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
	$sql = "SELECT * FROM contesttable WHERE contestStatus = 'current'";
	$res = mysqli_query($con, $sql);
	$ans = mysqli_fetch_array($res);
	$start = $ans['startDate'];
	$end = $ans['endDate'];
	date_default_timezone_set('Asia/Kolkata');
	$now = new DateTime();
	$dtA = new DateTime($start);
	$dtB = new DateTime($end);
	
	if ( $now>=$dtA && $now<=$dtB ) 
	{	//$interval = $now->diff($dtB);
		$ind = 1;
		$t = $dtB->format('Y-m-d H:i:s');
	}
	else if( $now<$dtA )
	{	//$interval = $now->diff($dtA);
		$ind = 2;
		$t = $dtA->format('Y-m-d H:i:s');
	}
	else if($now > $dtB)
	{	$ind = 3;
		$t = $now->format('Y-m-d H:i:s');
	}
	  if($ind==2)
	  {
		$responsetext.="<div id='div1'> Competition is in progress.</div>";
	  }
	  else if($ind==1)
	  {
		$responsetext.="<div id='div1'> Competition has not started yet</div>";
	  }
	  else
	  {
	     $query = "SELECT * FROM teamtable ORDER BY teamResult DESC";
		 $res = mysqli_query($con, $query);//$stmt = sqlsrv_query( $conn, $sql);
		 $rows= mysqli_num_rows($res);
		 $i=0;
		 $responsetext.="<div id='div2'><h3>Team ".$_SESSION['id']."!    The results are...</h3><table style='width:97%;margin-left:20px;margin-top:50px;position:relative;'><tr><th>Team Name</th><th>Result</th></tr>";
		 while($i<$rows)
		 {  
		    mysqli_data_seek ( $res,$i );
			$ans = mysqli_fetch_assoc($res);
			@$varr = $ans['teamName'][$i];
			if($varr == $_SESSION['id'])
			$responsetext.="<tr><td>".$ans['teamName']."</td><td>".$ans['teamResult']."</td></tr>";
			else
			$responsetext.="<b><td>".$ans['teamName']."</td><td>".$ans['teamResult']."</td></tr></b>";
			$i=$i+1;
			
		 }
		 $responsetext.="</table></div>";
	  }
	  $responsetext.="<div id='div3' onclick='sun()'> Back to Home</div>";
	  $responsetext.="<div id='div4'onclick='sun1()'>certificate</a></div>";
	  mysqli_close($con);
	  echo $responsetext;
	}
?>
<html>
	<head>
	<link href="css/county.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="js/county.js" type="text/javascript"></script>

		<script>
			function sun()
			{	window.location.href="userhome.php";
			
			}
			function sun1()
			{
			   window.location.href="Finalresultpdf.php";
			}
			
			function hideElement (element) {
				if (element.style) {
					element.style.display = 'none';
				}
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
				position:absolute;
				margin-top:500px;
				margin-left:300px;
				font-size:24px;
				font-family:Corbel;
			}
			#div4
			{	width:180px;
				height:100px;
				text-align:center;
				horizontal-align:middle;
				line-height:100px;
				border-radius:90px;
				background-color:#357ec7;
				color:white;
				position:absolute;
				margin-top:500px;
				margin-left:800px;
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
			#div4:hover
			{	background-color:#b6b6b4;
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
				margin-top:0px;
				margin-left:200px;
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
			margin-left:200px;
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
		</style>
	</head>
</html>
