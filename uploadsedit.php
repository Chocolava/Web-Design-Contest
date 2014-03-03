<?php 
session_start();
	if(	@$_SESSION['loginstatus']!="true")
	{	exit( "<center><strong>You are not authorised to access this page.<br><a href='home3.html'>Go back to home page.</a></strong></center>");
	}
	else
	{
	$teamname=$_SESSION['id'];
	$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
		if(mysqli_connect_errno()) //For checking any errors
		{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
		}
		$query ="SELECT * FROM teamtable WHERE teamName='$teamname'";
		$res=mysqli_query($con,$query);
		
		if(!$res)
		{
		 echo "<center>You have not uploaded any files ...<a href=\"filesupload.php\">Upload first </a></center>";
		}
		else
		{
		$ans=mysqli_fetch_assoc($res);
		$teampath=$ans['path'];
		//echo $teampath;
		
// open this directory 
$myDirectory = opendir($teampath);
// get each entry
while($entryName = readdir($myDirectory)) {
    $dirArray[] = $entryName;
}
// close directory
closedir($myDirectory);
//  count elements in array
$indexCount = count($dirArray);
//Print ("<center>".$indexCount." files<br></center>\n");
// sort 'em
sort($dirArray);
// print 'em
print("<div id='div1' >");
print("<TABLE border=1 cellpadding=5 cellspacing=0 class=whitelinks style='width:97%;margin:20px;'>\n");
print("<tr><th>Name</th><th>Type</th><th>Size</th><th>Download</th><th>Delete</th></tr>\n");

// loop through the array of files and print them all
for($index=0; $index < $indexCount; $index++) {
        $file=urlencode($dirArray[$index]);
		$fileurl=$teampath."".$dirArray[$index];
        if (substr("$dirArray[$index]", 0, 1) != "."){ // don't list hidden files
        print("<tr><TD><a href=$fileurl>$dirArray[$index]</a></td>");
        print("<td>");  print(filetype($fileurl)); print("</td>");
        print("<td>");  print(filesize($fileurl)."bytes"); print("</td>");
		print("<td><a href=\"download.php?file=$file\">Download $file</a></td>");
		print("<td><a href=\"unlink.php?file=$file\">Delete $file</a></td>");
        print("</tr>\n");
    }
}
print("</TABLE>\n");
print("</div>");
echo"<br><div id='div2' onclick='sun()'>Back to home</div>";
mysqli_close($con);
}
}
?>
<html>
<head>
<style>
#div1
{
width:750px;
margin-left:350px;
margin-top:130px;
text-align:center;
horizontal-align:middle;


}
 #div2          
		   {	width:180px;
				height:100px;
				text-align:center;
				horizontal-align:middle;
				line-height:100px;
				border-radius:90px;
				background-color:#357ec7;
				color:white;
				position:relative;
				margin-top:250px;
				margin-left:600px;
				font-size:24px;
				font-family:Corbel;
			}
			#div2:hover
			{	background-color:#b6b6b4;
			}
			@font-face
			{	font-family: 'Corbel';
				src: url('Fonts/corbel.ttf');
			}
			tr
		{	width:20%;
			height:30px;
			color:#585858;
		}
		th
		{	color:#565051;
			font-size:26px;
			text-decoration:underline;
		}
		td
		{	text-align:center;
			font-size:22px;
			font-family:Corbel;
		}
</style>
<script>
function sun()
			{	window.location.href="userhome.php";
			
			}
</script>
</head>
</html>