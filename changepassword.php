<?php
session_start();
$id = $_SESSION['id'];
if(	@$_SESSION['loginstatus']!="true")
{	echo "<center>You are not authorised to access this page.<br><a href='userhome.php'>Go back to home page</a></center>";
}
else
{
if(isset($_POST['submit']))
{
$password=mysql_real_escape_string($_POST['password']);
$confirmpassword=mysql_real_escape_string($_POST['confirmpassword']);
if($password==$confirmpassword)
{
$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
		if(mysqli_connect_errno()) //True if error found
		{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
		}
		else
		{
		$confirmpassword1=sha1($confirmpassword);
$insert=("UPDATE teamtable SET teamPassword = '$confirmpassword1' WHERE teamName = '$id'");
$insert1=mysqli_query($con,$insert);
echo "<script> alert('Your password is changed');</script>";
}
mysqli_close($con);
}
else
{
echo "<script> alert(Your passwords do not match);</script>";
}
}
}
?>

<html>
<head>
<title>Change Password</title>
<script type="text/javascript">
function showUser(str)
{
if (str=="")
{
document.getElementById("txtHint").innerHTML="";
return;
}
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari

xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5

xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","check_password.php?q="+str,true);

xmlhttp.send();
}
</script>

<script type="text/javascript">
function pass()
{
var pwd=document.getElementById("password").value;
var cpwd=document.getElementById("confirmpassword").value;
if(pwd==cpwd)
{
var t1=document.getElementById('pass').innerHTML="Password Match";

/*t1.style.display='block';*/
}
else
{
var t1=document.getElementById('pass').innerHTML="Password does not Match";
/* t1.style.display='block';*/
document.form.password.focus();
}
}
}
</script>
<script>
function sun()
			{	window.location.href="userhome.php";
			
			}
</script>

<style type="text/css">

.table
{
color:99CCFF;
}
.st
{
color:#FF0000;
}
#div1
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
			#div1:hover
			{	background-color:#b6b6b4;
			}
			@font-face
			{	font-family: 'Corbel';
				src: url('Fonts/corbel.ttf');
			}
			body
		{	background-color:#faf9f4;
		}
</style>
</head>
<body>
<form id="form" name="form" method="post" action="" onSubmit="return passvali();">
<table width="35%" border="0" cellspacing="0" cellpadding="5" align="center" bgcolor="6699FF" style="margin-top:200px;">
<tr>
<td colspan="2" align="center"> <h2>Change Password</h2></td>
</tr>
<tr>
<th> Current Password <span style="color:#F00;">*</span></th>
<td><input type="password" name="cur_pwd" class="input"id="oldpassword"placeholder="Enter Current Password" onChange="showUser(this.value)" ></td>
<td> <span class="st" id="txtHint"></span> </td>
</tr>
<tr>
<th>New Password <span style="color:#F00;">*</span></th>
<td><input type="password" name="password" class="input" id="password" placeholder="Enter your Password"></td>
</tr>
<tr>
<th> Confirm Password <span style="color:#F00;">*</span></th>
<td><input type="password" name="confirmpassword" class="input" id="confirmpassword" placeholder="Enter Confirm Password" onChange="return pass()" ></td>
<td><span id="pass" style="color:#F00;"> </span> </td>
</tr>
<tr>
</tr>
<tr>
<td colspan="2" align="left"><input type="submit" name="submit" value="Submit" style="width:80px;" ></td>

<td colspan="2" align="left"><input type="reset" name="cancel" value="Cancel" style="width:80px;" ></td>
<th></th>
</tr>
</table>
</form>
<div id='div1' onclick='sun()'>Back to home</div>
</body>
</html>