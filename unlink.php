<?php
session_start();
	if(	@$_SESSION['loginstatus']!="true")
	{	exit( "<center><strong>You are not authorised to access this page.<br><a href='home3.html'>Go back to home page.</a></strong></center>");
	}
	else
	{
if(isset($_GET['file'])){ 
$file=$_GET['file'];
$teamname=$_SESSION['id'];
$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
if(mysqli_connect_errno()) //For checking any errors
{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
}
$query ="SELECT * FROM teamtable WHERE teamName='$teamname'";
$res=mysqli_query($con,$query);
$ans=mysqli_fetch_assoc($res);
$teampath=$ans['path'];
$file1=$teampath.$file;
unlink($file1); 
$myDirectory = opendir($teampath);
// get each entry
while($entryName = readdir($myDirectory)) {
    $dirArray[] = $entryName;
}
// close directory
closedir($myDirectory);
//  count elements in array
$indexCount = count($dirArray)-2;
if(!$indexCount)
{
$query3="UPDATE teamtable SET teamURL='' WHERE teamName='$teamname'";
	mysqli_query($con,$query3);

}
mysqli_close($con);
echo"<div id='div1' onclick='sun()'>File with name ".$file." has been deleted<br>Go back to Home Page</div>";
}
}
?>
<html>
<head>
<style>
#div1
			{	width:600px;
				height:140px;
				text-align:center;
				vertical-align:middle;
				line-height:140px;
				border-radius:90px;
				background-color:#357ec7;
				color:white;
				position:absolute;
				margin-top:160px;
				margin-left:480px;
				font-size:20px;
				font-family:Corbel;
				cursor:pointer;
			}
			#div1:hover
			{	background-color:#b6b6b4;
			}
			@font-face
			{	font-family: 'Corbel';
				src: url('Fonts/corbel.ttf');
			}
</style>
<script>
function sun()
			{	window.location.href="userhome.php";
			}

</script>
</head>
</html>