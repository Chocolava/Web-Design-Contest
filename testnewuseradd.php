<?php
session_start();
$con = mysqli_connect("localhost","wd_user","wd_igdtuw","wd_db");
$con2 = mysqli_connect("localhost", "wd_user", "userdb", "acm_1gdtuw");
if(mysqli_connect_errno()) //True if error found
{
	echo "Failed to connect to mySQL: ". mysqli_connect_error();
}

// Check connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: ". mysqli_connect_error();
}

$username = $_POST["studname"];
$_SESSION['id'] = $username;

$mem=$_POST["members"];
$comma_sep=implode(", ", $mem);

$col=$_POST["college"];
$col_sep=implode(", ", $col);

$password=$_POST["pass1"];
$encrypted_pass= sha1($password);

$userIDs = $_POST["userid"];

$contestid = mysqli_query($con, "SELECT eventid FROM allevents WHERE eventType='Website Making Contest' AND eventStatus='ongoing' ");

$valid = mysqli_query($con, "SELECT userid FROM usertable WHERE eventId = '$contestid' ");
$isValid = 0;

for( $j = 0; $j < $userIDs.length; $j++ ) {
	$flag = 0;
	for( $i = 0; $i < $valid.length; $i++ ) {
		if( $valid[ $i ] == $userID[ $j ] ) {
			$flag = 1;
		}
	}
		if( !$flag ) {
			echo "User ID not valid!";
			$isValid = 1;
			break;
		}
}

$memmail=$_POST["email"];
$impmail=implode(", ",$memmail);
$sql="SELECT * FROM teamtable WHERE teamName='$username'";

$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);

if( $isValid = 1 ) {
}
else if($count>0 )
{	$_SESSION['loginstatus'] = "true";
 	header('Location:signupstud.php');
}
 else
 {$path="D:/Xampp/htdocs/Project/upload/".$username."/";
mkdir($path);
 $sql="INSERT INTO teamtable(teamName, teamMembers, collegeName, teamPassword,teamEmail,path) VALUES('$_POST[studname]','$comma_sep','$col_sep','$encrypted_pass','$impmail','$path')";
 echo "New Team added";
 $_SESSION['loginstatus'] = "true";
 $_SESSION['newuser']="true";
 
 header('Location:userhome.php');
 if (!mysqli_query($con,$sql))
 {	die('Error: ' . mysqli_error($con));
 }
 }
mysqli_close($con);
 ?>