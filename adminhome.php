<?php
	// if(!isset($_SESSION['start']))
	// {	exit("<center>You are not authorised to access this page<br><a href='home.html'>Go back to home page</a></center>");
	// }
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
	{	$ind = 1;
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
		<title>Admin</title>
		
		<link href="css/county.css" rel="stylesheet" type="text/css" />
  
    <script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="js/county.js" type="text/javascript"></script>
    <script type="text/javascript">
		 $(document).ready(function () {
            $('#cdown').county({ endDateTime: new Date('<?php echo $t;?>'), reflection: true, animation: 'scroll', theme: 'grayu' });
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
		<script>
			 function button1()
			 {	hideElement(document.getElementById('Div2'));
				showElement(document.getElementById('Div1'));
				hideElement(document.getElementById('Div4'));
				hideElement(document.getElementById('Div5'));
				hideElement(document.getElementById('Div8'));
				hideElement(document.getElementById('Div9'));
				hideElement(document.getElementById('Div100'));
				hideElement(document.getElementById('Div10'));
			 }
			 function button2()
			 {	hideElement(document.getElementById('Div1'));
				showElement(document.getElementById('Div2'));
				hideElement(document.getElementById('Div4'));
				hideElement(document.getElementById('Div5'));
				hideElement(document.getElementById('Div8'));
				hideElement(document.getElementById('Div9'));
				hideElement(document.getElementById('Div100'));
				hideElement(document.getElementById('Div10'));
			}
			function button3()
			{	window.location.href = "viewteams2.php";
			}
			function button12()
			{	window.location.href = "viewprevcontest.php";
			}
			 function button4()
			 {	hideElement(document.getElementById('Div1'));
				showElement(document.getElementById('Div4'));
				hideElement(document.getElementById('Div2'));
				hideElement(document.getElementById('Div5'));
				hideElement(document.getElementById('Div8'));
				hideElement(document.getElementById('Div100'));
				hideElement(document.getElementById('Div9'));
				hideElement(document.getElementById('Div10'));
			}
			function button5()
			 {	hideElement(document.getElementById('Div2'));
				hideElement(document.getElementById('Div1'));
				hideElement(document.getElementById('Div4'));
				hideElement(document.getElementById('Div10'));
				hideElement(document.getElementById('Div100'));
				showElement(document.getElementById('Div5'));
				hideElement(document.getElementById('Div8'));
				hideElement(document.getElementById('Div9'));
			 }
			 function button8()
			 {	hideElement(document.getElementById('Div2'));
				hideElement(document.getElementById('Div1'));
				hideElement(document.getElementById('Div4'));
				showElement(document.getElementById('Div8'));
				hideElement(document.getElementById('Div5'));
				hideElement(document.getElementById('Div10'));
				hideElement(document.getElementById('Div9'));
				hideElement(document.getElementById('Div100'));
			 }
			 function button9()
			 {	hideElement(document.getElementById('Div4'));
				showElement(document.getElementById('Div9'));
				hideElement(document.getElementById('Div2'));
				hideElement(document.getElementById('Div5'));
				hideElement(document.getElementById('Div8'));
				hideElement(document.getElementById('Div1'));
				hideElement(document.getElementById('Div10'));
				hideElement(document.getElementById('Div100'));
			}
			function button10()
			{	window.location.href = "logoutadmin.php";
			}
			function button11()
			{	var r= confirm("This will delete all previously stored team and evaluator data. Are you sure you want to proceed?");
				if(r==true)
				{	button5();	}
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
			function contestcheck()
			{	var a = document.startcontest.startdate.value;
				var b = document.startcontest.starttime.value;
				var c = document.startcontest.enddate.value;
				var d = document.startcontest.endtime.value;
				var e = document.startcontest.length.value;
				if(a="" || b="" || c="" || d="" || e="")
				{	alert("None of the fields must be left blank. Thank you.");
					return false;
				}
			}	
			function changecheck()
			{	var a = document.changepass.pass1.value;
				var b = document.changepass.pass2.value;
				if(a != b)
				{	alert("The passwords donot match. Please try again.");
					return false;
				}
			}
			function admincheck()
			{	var x = document.addadmin.name.value;
				if(x=="")
				{	alert("Name field cannot be blank");
					return false; 
				}
				var y= document.addadmin.login.value;
				if(y=="")
				{	alert("Login ID cannot be blank");
					return false
				}
				var a = document.addadmin.pass1.value;
				var b = document.addadmin.pass2.value;
				if(a!=b)
				{	alert("Passwords donot match");
					return false;
				}
			}
			function evalcheck()
			{	var x = document.addeval.name.value;
				if(x=="")
				{	alert("Name field cannot be blank");
					return false; 
				}
				var y= document.addeval.login.value;
				if(y=="")
				{	alert("Login ID cannot be blank");
					return false
				}
				var a = document.addeval.pass1.value;
				var b = document.addeval.pass2.value;
				if(a!=b)
				{	alert("Passwords donot match");
					return false;
				}
			}
			function button6()
			{	var xmlhttp;
				if (window.XMLHttpRequest)
				{	xmlhttp=new XMLHttpRequest();	}
				else
				{	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");	}
				xmlhttp.onreadystatechange=function()
				{	if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{	hideElement(document.getElementById('Div4'));
						hideElement(document.getElementById('Div9'));
						hideElement(document.getElementById('Div2'));
						hideElement(document.getElementById('Div5'));
						hideElement(document.getElementById('Div8'));
						hideElement(document.getElementById('Div1'));
						hideElement(document.getElementById('Div10'));
						showElement(document.getElementById('Div100'));
						document.getElementById("Div100").innerHTML=xmlhttp.responseText;	}
				}
				xmlhttp.open("GET","deleteAdmin.php",true);
				xmlhttp.send();
			}
			function button7()
			{	var xmlhttp;
				if (window.XMLHttpRequest)
				{	xmlhttp=new XMLHttpRequest();	}
				else
				{	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");	}
				xmlhttp.onreadystatechange=function()
				{	if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{	hideElement(document.getElementById('Div4'));
						hideElement(document.getElementById('Div9'));
						hideElement(document.getElementById('Div2'));
						hideElement(document.getElementById('Div5'));
						hideElement(document.getElementById('Div8'));
						hideElement(document.getElementById('Div1'));
						hideElement(document.getElementById('Div10'));
						showElement(document.getElementById('Div100'));
						document.getElementById("Div100").innerHTML=xmlhttp.responseText;	
					}
				}
				xmlhttp.open("GET","deleteEvaluator.php",true);
				xmlhttp.send();
			}
		</script>
		<link rel="stylesheet" type="text/css" href="css/adminhome.css">
	</head>
	
	<body onload="timer()">
		<div id="div1" style="float:left;width:25%;height:100%;">
			<button type="button" class="button" onclick= "button1();">Add Admin</button>
			<button type="button" class="button" onclick= "button2();">Add Evaluator</button>
			<button type="button" class="button" onclick= "button4();">Show Contest Rules</button>
			<button type="button" class="button" onclick= "button11();">Start New Contest</button>
			<button type="button" class="button" onclick= "button9()">Update Contest Details</button>
			<button type="button" class="button" onclick= "button6()">Delete Admin</button>
			<button type="button" class="button" onclick= "button7()">Delete Evaluator</button>
			<button type="button" class="button" onclick= "button3();">View Teams & Result</button>
			<button type="button" class="button" onclick= "button12();">View Previous Contest Details</button>
			<button type="button" class="button" onclick= "button8()">Change Password</button>
			<button type="button" class="button" onclick= "button10()">Logout</button> 
		</div>
		<div id="Div4" name = "myDiv" style="float:left;width:68%;height:100%;margin-left:50px;display:none;">
			<iframe src="Random/Rules.pdf" name="rules" id = "rules" style="width:100%;height:100%;margin-bottom:0;">My document</iframe>
			<!--OR use google doc viewer, upload file on Drive and generate link. We'll debate this later.-->
		</div>
		<div id="Div1" name = "myDiv" style="float:left;width:68%;height:100%;margin-left:50px;display:none;">
			<center>
			<form name="addadmin" action="addadmin.php" method="post" onsubmit="return admincheck()">
			<label>Admin Name</label><input type="text" name="name"><br><br>
			<label>Admin Login ID</label><input type="text" name="login"><br><br>
			<label>Password</label><input type="password" name="pass1"><br><br>
			<label>Retype Password</label><input type="password" name="pass2"><br><br><br><br>
			<input type="submit" class="but1" style="margin:20 auto;">
			</form>
			</center>
		</div>
		<div id="Div2" name = "myDiv" style="float:left;width:68%;height:100%;margin-left:50px;display:none;">
			<form name="addeval" action="addeval.php" method="post" onsubmit="return evalcheck()">
			<label>Evaluator Name</label><input type="text" name="name"><br><br>
			<label>Evaluator Login ID</label><input type="text" name="login"><br><br>
			<label>Password</label><input type="password" name="pass1"><br><br>
			<label>Retype Password</label><input type="password" name="pass2"><br><br><br>
			<input type="submit" class="but1" style="margin:20 auto;">
			</form>
		</div>
		
		<div id="Div5" name = "myDiv" style="float:left;width:68%;height:100%;margin-left:50px;display:none;">
			<form name="startcontest" action="addcontest.php" method="post" enctype="multipart/form-data" onsubmit="return contestcheck()">
			<label style="width:400px;">Contest Name</label><input type="text" name="contestname"><br><br>
			<label style="width:400px;">Start Date & Time(24 hour format)</label><input type="datetime-local" name="startdate"><br><br>
			<label style="width:400px;">End Date & Time(24 hour format)</label><input type="datetime-local" name="enddate"><br><br>
			<label style="width:400px;">Select a Rules pdf file(please make sure it's named as Rules.pdf):</label><br><br><br>
			<input type="file" name="rulesup"><br><br>
			<input type="submit" class="but1" style="margin:20 auto;">
			</form>
		</div>

		<div id="Div8" name = "myDiv" style="float:left;width:68%;height:100%;margin-left:50px;display:none;">
			<form name="changepass" action="changepass.php" method="post" onsubmit="return changecheck()">
				<label>New password</label><input type="password" name="pass1"><br><br>
				<label>Retype New password</label><input type="password" name="pass2"><br><br><br>
				<input type="submit" class="but1" style="margin:20 auto;">
			</form>
		</div>
		<div id="Div9" name = "myDiv" style="float:left;width:68%;height:100%;margin-left:50px;display:none;text-align:center;">
			<form name="updatecontest" action="updatecontest.php" method="post" enctype="multipart/form-data" onsubmit="return contestcheck()">
			<label style="width:700px;color:red;">Please note that you will have to re-enter all the details to successfully update the contest database.</label><br><br><br><br><br>
			<label style="width:400px;">Contest Name</label><input type="text" name="contestname"><br><br>
			<label style="width:400px;">Start Date & Time(24 hour format)</label><input type="datetime-local" name="startdate"><br><br>
			<label style="width:400px;">End Date & Time(24 hour format)</label><input type="datetime-local" name="enddate"><br><br>
			<label style="width:400px;">Select a Rules pdf file(please make sure it's named as Rules.pdf):</label><br><br><br>
			<input type="file" name="rulesup"><br><br>
			<input type="submit" class="but1" style="margin:20 auto;">
			</form>
		</div>
		<div id="Div10" style="float:left;width:68%;height:100%;margin-left:50px;">
			<div id="cind" style="width:480px;margin:80 auto 20;height:80px;font-size:26px;text-align:center;">
			</div>
			<div id="cdown" style="width:480px;margin:50 auto;height:80px;"></div>
		</div>
		<div id="Div100" style="float:left;width:68%;height:100%;margin-left:50px;display:none;">
		</div>
	</body>
</html>