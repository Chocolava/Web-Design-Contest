<?php 
		session_start();
		?>
<html>
	<head>
		<title>Sign Up</title>
		<link rel="stylesheet" type="text/css" href="signupcss.css">
		<script>
		function hide(a)
			{
				if(a==document.getElementById("studname"))
					{
						document.getElementById("spat").innerHTML="";
					}
				if(a==document.getElementById("pass"))
					{
					document.getElementById("spat1").innerHTML="";
					}
				if(a==document.getElementById("pass3"))
					{
					document.getElementById("spat2").innerHTML="";
					}
				if(a==document.getElementById("m1"))
					{
					document.getElementById("spat3").innerHTML="";
					}
				if(a==documnet.getElementById("colege"))
					{
					document.getElementById("spat3").innerHTML="";
					}
				if(a=document.getElementById("mail"))
					{
					doccument.getElementById("spat3").innerHTML="";
					}
			}
		function validate()
			{
				
				var x=document.getElementById("studname").value;
				if(x==null||x=="")
				{
					document.getElementById("studname").focus();
					y=document.getElementById("spat");
					y.innerHTML="Team name cannot be null";
					return false;
				}
				var alphaExp = /^[0-9a-zA-Z]+$/;
				var w=document.getElementById("pass");
				if((w.value=="" )|| (!(w.value.match(alphaExp)))|| (w.value.length<='8'))
				{	   
					document.getElementById("pass").focus();
					document.getElementById("spat1").innerHTML="Please enter a valid password";
					return false;
				}
				var z=document.getElementById("pass3");
				if(z.value=="")
				{
					document.getElementById("pass3").focus();
					document.getElementById("spat2").innerHTML="Please fill up retype password field";
					return false;
				}
				if(w.value!=z.value)
				{	
					document.getElementById("pass3").focus();
					document.getElementById("spat2").innerHTML="Password donot match";
					return false;
				}
				var l=document.getElementById("m1");
				var c=document.getElementById("colege");
				var d=document.getElementById("mail");
				var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
				var k=d.value.match(emailExp);
				if(l.value=="")
				{
					document.getElementById("m1").focus();
					document.getElementById("spat3").innerHTML="Enter Member name";
					return false;
				}
				else if(c.value=="")
				{
					document.getElementById("colege").focus();
					document.getElementById("spat3").innerHTML="Enter College Name";
					return false;
				}
				else if(!k)
				{
					document.getElementById("mail").focus();
					document.getElementById("spat3").innerHTML="Enter valid email Id";
					return false;
				}
			
				if(document.form1.check.checked==false)
				{
					document.getElementById("check").focus();
					document.getElementById("check2").innerHTML="Please Read Rules and Regulation and tick the checkbox.";
					return false;
				}
				return true;
			}
		
		
		</script>
	</head>
	
	<body>
		<div id="titlediv">Sign Up!<br><span style="font-size:20px"><a href="home.html" style="text-decoration:none;color:red;letter-spacing:0;">Or Sign In</a></span></div>
		<div id="details">
			<form name="form1" onsubmit="return validate()" action="testnewuseradd.php" method="post">
				<label>Team Name</label> <input type="text" id="studname" name="studname" onkeydown="hide(this)" onfocus="document.getElementById('Div3').style.display='block';" onblur="document.getElementById('Div3').style.display='none'";><div class="hint"></div><div id="Div3" style="display:none;width:250px;float:left;color:purple;">Enter your Team Name</div><div id="spat" class="error_mssg"></div><br><br>
				<?php
				if(isset($_SESSION['loginstatus']))
				{	
				if($_SESSION['loginstatus'] == "true")
					{	echo "<p style='color:red'>Team name already in use. Please choose another name.</p>";
					}
					unset($_SESSION['loginstatus']);
				}
			?>
				<label>Password</label> <input type="password" id="pass" name="pass1" onkeydown="hide(this)" onfocus="document.getElementById('Div4').style.display='block';" onblur="document.getElementById('Div4').style.display='none';" onfocus="document.getElementById("spat1").style.display='none';"><div id="Div4" style="display:none;width:250px;float:left;color:purple;">Password must be more than 8 characters.</div><div id="spat1" class="error_mssg"></div><div class="hint"></div><br><br>
				<label>Retype Password</label> <input type="password" id="pass3" name="pass2" onkeydown="hide(this)" onfocus="document.getElementById('Div5').style.display='block';" onblur="document.getElementById('Div5').style.display='none';"><div id="Div5" style="display:none;width:220px;float:left;color:purple;font:20px">Re-Enter Password for verification.</div><div id="spat2" class="error_mssg"></div><br><br><br>
				<label style="border-top-right-radius:15px;width:180px;color:#008080; background-color:transparent;border:2px solid #008080;border-bottom-right-radius:15px;">Member Details:</label><div id="spat3" class="error_mssg"></div>
				<div id="memdetails">
					<input type="number" name="userid[]" placeholder="User ID"><input type="text" name="members[]" id="m1" placeholder="Name"><input type="text" name="college[]" id="colege" placeholder="College" ><input type="text" id="mail" name="email[]" placeholder="Email ID"><br>
					<input type="number" name="userid[]" placeholder="User ID"><input type="text" name="members[]" placeholder="Name"><input type="text" name="college[]" placeholder="College"><input type="text" name="email[]" placeholder="Email ID"><br>
					<input type="number" name="userid[]" placeholder="User ID"><input type="text" name="members[]" placeholder="Name"><input type="text" name="college[]" placeholder="College"><input type="text" name="email[]" placeholder="Email ID"><br>
					<input type="number" name="userid[]" placeholder="User ID"><input type="text" name="members[]" placeholder="Name"><input type="text" name="college[]" placeholder="College"><input type="text" name="email[]" placeholder="Email ID"><br>
					<input type="number" name="userid[]" placeholder="User ID"><input type="text" name="members[]" placeholder="Name"><input type="text" name="college[]" placeholder="College"><input type="text" name="email[]" placeholder="Email ID"><br>
				</div>
				<input type="checkbox" id="check" name="check" style="margin-left:50px;margin-top:20px;"><label style="font-size:20px;cursor:pointer;" for="check" id="check1">I have read the <a href="rules.html" style="text-decoration:none;color:red;">Rules and Regulations</a></label><br>
				<div id="check2" class="error"></div>
				<br><input type="submit" value="Register" id="enter1">
			</form>
		</div>
	</body>
</html>
	