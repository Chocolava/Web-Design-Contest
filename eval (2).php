<?php
	session_start();
	if(!isset($_SESSION['start']))
		{	exit('<center>You are not authorised to access this page<br><a href="home.html">Go back to home page</a></center>');
		}
	$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
	if(mysqli_connect_errno())
	{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
	}	
	$sql = "SELECT * FROM contesttable WHERE contestStatus = 'Current'";
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
?>
<html>
	<head>
		<link href="css/county.css" rel="stylesheet" type="text/css" />
		<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
		<script src="js/county.js" type="text/javascript"></script>
		<script type="text/javascript">
		 $(document).ready(function () {
            $('#cdown').county({ endDateTime: new Date('<?php echo $t;?>'), reflection: false, animation: 'scroll', theme: 'blacky' });
        });
		</script>
		<script>
			function timer()
			{
			var x = <?php echo $ind ?> ;
			if(x == 1)
			{	document.getElementById('cind').innerHTML = 'Contest will end in';
			}
			else if(x == 2)
			{	document.getElementById('cind').innerHTML = 'Contest will begin in';
			}
			else
			{	document.getElementById('cind').innerHTML = 'Contest has ended';
			}
			}
		</script>
		<style>
			body
			{	background-color:white;	
				font-family:Corbel;
			}
			table
			{	margin-left:100px;
				align:center; position:relative; margin-top:50px;
			}
			
			td
			{	text-align:center; height:60;	font-size:22;	color:#736f6e; overflow:hidden;}
			#col1
			{	width:200px;	}
			#col2
			{	width:250px;	}
			#col3
			{	width:400px;	}
			th
			{	text-align:center;	height:90;	font-size:26;	color:#f62217;	}
			#marks
			{	font-size:18;	height:30;	width:25%;	color:#736f6e; background-color:#f3f2f2; border:1px solid black; text-align:center;}
			@font-face
			{	font-family: 'Corbel';
				src: url('Fonts/corbel.ttf');
			}
			input[type=submit]
			{  	width: 150px; font-family:Corbel; font-size:24px; font-weight:400; height:50px;background-color:#f62217;color:white;
				border-radius:25px; border:3px solid white; margin-left:530px; cursor:pointer;
			}
			#titlediv
			{	height:100px;
				width:98%;
				letter-spacing:4px;
				line-height:80px;
				text-align:center;
				vertical-align:middle;
				font-size:65px;
				z-index:2;
				font-family:Corbel;
				/*text-shadow: 5px 5px 10px #6d6968;*/
				color:#f62217;
				-webkit-transition: All 0.5s ease;
				-moz-transition: All 0.5s ease;
				-o-transition: All 0.5s ease;
				-ms-transition: All 0.5s ease;
				transition: All 0.5s ease;
			}
		</style>
		<script>
			function my(var err)
			{	if(err>100)
				{	document.getElementById("txt").innerHTML="Marks cannot be greater than 100";
				}
			}
		</script>
	</head>
	<body onload="timer()">
	<?php
	$count = 1;
	$con=mysqli_connect("localhost","root","","database")or die("failed to connect");
	$sel="SELECT *FROM teamtable";
	$result=mysqli_query($con,$sel);?>
	<div id="titlediv"><img src="acm.jpg" style="float:left;"><img src="igit.jpg" style="float:right;">Evaluate Submissions</div>
	
	<div id="Div10" style="float:left;width:100%;height:120px;text-align:center;">
			<div id="cind" style="width:50%;height:100%;font-size:26px;text-align:center;float:left;line-height:120px;vertical-align:middle;"></div>
			<div id="cdown" style="width:30%;height:100%;float:left;margin-left:20px;"></div>
	</div>
	<table>
	<tr>
	<th>Serial #</th><th>Team Name</th><th>Team Url</th><th>Team marks(100)</th>
	</tr>
	<form action="p.php" method="post">
	<?php	while($row=mysqli_fetch_array($result)){?>
	
	<tr>
	<td id="col1"><?php echo $count; $count = $count + 1;?></td>
	<td id="col2"><?php echo $row['teamName'];?></td>
	<td id="col3"><a href="<?php echo $row['teamUrl'];?>" ><?php echo $row['teamUrl'];?></a></td>
	<td><input type="text" name="marks[]" id="marks" value="<?php echo $row['teamResult']?>" onkeydown="my(this.value)"></td>
	<span id="txt"></span>
	</tr>
	<?php }?>
	</table>
	<br><br>
		<input type="submit" name="submit" id="submit" value="Submit" >
	</form>
			
	</body>
</html>
