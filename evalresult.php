<?php
$con=mysqli_connect("localhost","wd_user","wd_igdtuw","wd_db");
$sel="SELECT *FROM teamtable";
$result=mysqli_query($con,$sel);
foreach($_POST['marks']as $key=>$value)
{$row=mysqli_fetch_array($result);
if($_POST['marks'][$key]<=100)
{
$res=$_POST['marks'][$key];
$name=$row['teamName'];
mysqli_query($con,"UPDATE teamtable SET teamResult='$res' where teamName='$name' ");
}
}
$sel="Select* from teamtable order by teamResult Desc";
mysqli_query($con,$sel);
$result=mysqli_query($con,$sel);
$winner=array();
for($i=0;$i<3;$i++)
{
$row=mysqli_fetch_array($result);
$winner[$i]=$row['teamName'];
}
mysqli_query($con,"UPDATE contesttable SET winner1='$winner[0]' where 1 ");
mysqli_query($con,"UPDATE contesttable SET winner2='$winner[1]' where 1 ");
mysqli_query($con,"UPDATE contesttable SET winner3='$winner[2]' where 1 ");
mysqli_close($con);
echo "<center style='font-size:1.5em'><br><br><br><br>Thank you for submitting your response.<br><br>You can back to your home page here<br><br><a href='eval.php' style='padding:4px;
			font-family:Corbel; font-size:24px; font-weight:400; height:50px;background-color:#f62217;color:white;
				border-radius:25px; border:3px solid white; cursor:pointer;'>Back</a></center>";
?>
