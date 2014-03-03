<?php 
	session_start();
		   if(	$_SESSION['loginstatus']!="true")
			{	exit( "<center><strong>You are not authorised to access this page.<br><a href='home.html'>Go back to home page.</a></strong></center>");
			}
	$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
	if(mysqli_connect_errno())
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
	$_SESSION['result']=$ind;
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="userhomestyling.css">
<link href="css/county.css" rel="stylesheet" type="text/css" />
  
    <script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="js/county.js" type="text/javascript"></script>
    <script type="text/javascript">
		 $(document).ready(function () {
            $('#cdown').county({ endDateTime: new Date('<?php echo $t;?>'), reflection: true, animation: 'scroll', theme: 'blacky' });
        });
    </script>
	<script>
			function timer()
			{
			var x = <?php echo $ind ?> 
		
			if(x == 1)
			{	document.getElementById('cind').innerHTML = 'Contest will end in';
			}
			else if(x == 2)
			{	document.getElementById('cind').innerHTML = 'Contest will begin in';
			}
			else
			{	document.getElementById('cind').innerHTML = 'Contest has ended.';
			}
			}
		</script>
<script>
			 function button1()
			 {	
			  window.location= "viewteaminfo.php"
			 }
			 function button8()
			 {
				window.location= "viewteamsuser.php"
			 }
			 function button2()
			 {	
			  window.location= "viewcontestinfo.php"
			 }
			 function button3()
			 {
			   showElement(document.getElementById("div3"));
			   //hideElement(document.getElementById("div6"));
			 }
			 function button4()
			 {
				window.location="filesupload.php"
			 }
			 function button9()
			 {
			 window.location="uploadsedit.php"
			 }
			 function button5()
			 {
			  window.location= "viewresultn.php"
			 }
			 function button6()
			 { //showElement(document.getElementById("div6"));
			   //hideElement(document.getElementById("div3"));
			   window.location="changepassword.php"
			 }
			 function button7()
			 {	window.location.href = "logoutuser.php";
			 }
			 function changecheck()
			 {	var a = document.getElementById("div6").changeuserpass.pass1.value;
				var b = document.getElementById("div6").changeuserpass.pass2.value;
				if(a=="" || b=="")
				{
				alert("New Password has to be entered or click cancel");
				return false;
				
				}
				if(a != b)
				{	alert("The passwords donot match. Please try again.");
					return false;
				}
				return true;
			 }
			 function hideElement (element) {
				if (element.style) {
					element.style.display = 'none';
				}
			}

			function showElement (element) {
				if (element.style) {
					element.style.display = '';
				}
			}
			function checkbutton()
			{
			
			}
			
			 
</script>
</head>
<body onload="timer()">
		
		<div id="Div" style="float:left;width:25%;height:100%;">
			<button type="button" class="button" onclick= "button1()">Your Team Information</button>
			<button type="button" class="button" onclick= "button8()">All Team Information</button>
			<button type="button" class="button" onclick= "button2()">Contest Information</button>
			<button type="button" class="button" onclick= "button3();">Contest Rules</button>
			<button type="button" class="button" onclick= "button4()">Upload Files</button>
			<button type="button" class="button" onclick= "button9()">Edit Uploaded Files</button>
			<button type="button" class="button" onclick= "button5()">Result</button>
			<button type="button" class="button" onclick= "button6()">Change Password</button>
			<button type="button" class="button" onclick= "button7()">Logout</button> 
		</div>
		
		<div id="div3" name = "myDiv" style="float:left;width:68%;height:100%;margin-left:50px;display:none;">
			<iframe src="Random/Rules.pdf" name="rules" id = "rules" style="width:100%;height:100%;">My document</iframe>	
		</div>
		<div id="div10" style="float:left;width:68%;height:100%;margin-left:50px;">
			<div id="cind" style="width:480px;margin:80 auto 20;height:80px;font-size:20px;text-align:center;">
			</div>
			<div id="cdown" style="width:480px;margin:50 auto;height:80px;"></div>
		</div>
		<div id="div6"  name = "myDiv" style="border:5px ridge gray; border-radius:25px;float:left;width:33%;height:130%;margin-left:40px; padding-left:70px;padding-top:20px;padding-bottom:20px;margin-top:200px;display:none;">
			<form name="changeuserpass" action="changeuserpass.php" onsubmit="return checkbutton();" method="post" >
				<label style="color:red;font-weight:bold">New password: </label><input type="password" name="pass1"  onfocus="document.getElementById('Div4').style.display='block';" onblur="document.getElementById('Div4').style.display='none';" onfocus="document.getElementById("spat1").style.display='none';"><div id="Div4" style="display:none;width:100px;float:right;color:blue;">Password must be more than 8 characters.</div><div id="spat1" class="error_mssg"></div><br>
				<label style="color:red;font-weight:bold">Retype New password: </label><input type="password" name="pass2" onfocus="document.getElementById('Div5').style.display='block';" onblur="document.getElementById('Div5').style.display='none';"><div id="Div5" style="display:none;width:100px;float:right;color:blue;">Re-Enter Password for verification.</div><div id="spat2" class="error_mssg"></div><br>
				<input type="submit" value="submit" style="float:left;margin-left:40px">    <input type="reset" value="cancel" style="float:right;margin-right:240px;" ><br>
				
			</form>
		</div>
		
		
</body>
</html>
