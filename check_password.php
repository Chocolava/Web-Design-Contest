<?php
session_start();
$id=$_SESSION['id'];
if(	@$_SESSION['loginstatus']!="true")
{	echo "<center>You are not authorised to access this page.<br><a href='userhome.php'>Go back to home page</a></center>";
}
else
{
$password=$_GET['q'];
$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
		if(mysqli_connect_errno()) //True if error found
		{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
		}
		else
		{
$select=mysqli_query($con,"select * from teamtable where teamName='$id'");
$fetch=mysqli_fetch_array($select);
$data_pwd=$fetch['teamPassword'];

if($data_pwd==sha1($password))
{

echo "Password match";
}
else
{
echo "Provide valid password";
}
}
}
?>