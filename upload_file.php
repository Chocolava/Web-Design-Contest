<?php

session_start();

/*if(!isset($_SESSION['loginstatus']))
{
header('Location:del.php');
}*///for checking login status..
if(	@$_SESSION['loginstatus']!="true")
	{	exit( "<center><strong>You are not authorised to access this page.<br><a href='home3.html'>Go back to home page.</a></strong></center>");
	}
	else
	{
	if(!isset($_FILES["file"]))
	{
	echo"<div id='div1' onclick='sun()'><center>Uploads are disabled for now!!</center></div>";
	
	}
	else
	{
$i=0;
foreach($_FILES['file']['error'] as $key=>$value)
{
if ($value > 0)
  {
  echo "Error: " ."<br>";
  }
else
  {
  $con=mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
if(mysqli_connect_errno())
{
echo "Failed to connect to MYSQL:".mysql_error();
exit();
}
  $Name =  $_FILES["file"]["name"][$key];
  $Type =  $_FILES["file"]["type"][$key];
  $Size = $_FILES["file"]["size"][$key];
  $Temp=$_FILES["file"]["tmp_name"][$key];
  $teamname=$_SESSION['id'];
   //$path="F:/xampp/htdocs/upload/".$id;
   $query="SELECT * from teamtable where teamName = '".$teamname."' ";
   $res=mysqli_query($con,$query);
   $ans = mysqli_fetch_array($res);
   $path=$ans['path'];
   
   
   //newuser is set when a new team registers itself for the first time then a new folder will be made for the team in upload folder otherwise a folder is already existing for the team already reagistered.
   
    /*  if(isset($_SESSION['newuser']))
	  {
	  if($_SESSION['newuser']=="true")
	  {
	  mkdir($path);
      }
	  }
	  //directory has to be created in signupstud.php
	  unset($_SESSION['newuser']);*/
  /* move temporary file to fixed location */
  
  
  if (file_exists("$path" . $_FILES["file"]["name"][$key]))
      {
      echo $_FILES["file"]["name"][$key] . " already exists.please change the name of file ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"][$key],
      "$path" . $_FILES["file"]["name"][$key]);
      /*echo "Stored in: " . "upload/" . $_FILES["file"]["name"][$key];*/
      
	$fileName = "$path" . $_FILES["file"]["name"][$key];
	//echo $fileName;
	if($i==0){
	if($ans['teamURL']==''){
	$URL=$_FILES["file"]["name"][$key];
	$query3="UPDATE teamtable SET teamURL='$URL' WHERE teamName='$teamname'";
	mysqli_query($con,$query3);
	}
	}
   echo"<div id='div1' onclick='sun()'>files upload successful..Go back to Home Page</div>";
   }
  mysqli_close($con);
   }
   $i=$i+1;
  }
  }
  }
  //header('Location:filesupload.php');
?>
<html>
<head>
<script>
			function sun()
			{	window.location.href="userhome.php";
			}
</script>
<style>
#div1
			{	width:500px;
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
				font-size:24px;
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

</head>
</html>