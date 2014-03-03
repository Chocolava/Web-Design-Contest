<?php
	session_start();
	if(	$_SESSION['start']!='1')
	{	echo "<center>You are not authorised to access this page.<br><a href='adminhome.php'>Go back to home page</a></center>";
	}
	else
	{	$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
		if(mysqli_connect_errno()) //True if error found
		{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
		}
		$sql = "INSERT into contesttable(contestStatus, startDate, endDate, contestName) VALUES('Current', '$_POST[startdate]','$_POST[enddate]', '$_POST[contestname]')";
		$sql1 ="DELETE FROM teamtable";
		$sql2 ="DELETE FROM evaluatortable";
		$sql3 ="UPDATE contesttable SET contestStatus='Completed'";
		mysqli_query($con, $sql3);
		mysqli_query($con, $sql);
		mysqli_query($con, $sql1);
		mysqli_query($con, $sql2);
		$target_path = "css/";
		$target_path = $target_path . basename( $_FILES['rulesup']['name']); 
		if(move_uploaded_file($_FILES['rulesup']['tmp_name'], $target_path)) 
		{	//echo "The file ".  basename( $_FILES['rulesup']['name']). " has been uploaded";
		} 
		echo "<div id='div1' onclick='sun()'><center>Contest added. Go back to home page</center></div>";
		mysqli_close($con);
	}
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
			{	width:530px;
				height:140px;
				text-align:center;
				vertical-align:middle;
				line-height:140px;
				border-radius:90px;
				background-color:#78ca20;
				color:white;
				position:absolute;
				margin-top:160px;
				margin-left:440px;
				font-size:24px;
				font-family:Corbel;
				cursor:pointer;
			}
			#div1:hover
			{	background-color:white;
				color:#78ca20;
				border:2px solid #78ca20;
			}
			@font-face
			{	font-family: 'Corbel';
				src: url('Fonts/corbel.ttf');
			}
		</style>
	</head>
</html>