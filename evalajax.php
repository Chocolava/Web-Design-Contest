<?php
$q=$_GET["q"];
session_start();
$con = mysqli_connect("localhost", "wd_user", "wd_igdtuw", "wd_db");
	if(mysqli_connect_errno()) //True if error found
	{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
	}
	
	$res = mysqli_query($con, "SELECT * FROM  evaluatortable WHERE evaluatorLogin = '$_SESSION[id]'");
	$row = mysqli_fetch_array($res);
	$pass=sha1($q);
	if($row['evaluatorPassword'] != $pass)
	{	
	echo "<font color='maroon'>Incorrect Password</font>";
	}
	
	
	
//echo "q=$q";

/*$sql="SELECT * FROM ajax_users WHERE id = $q";

$result = mysqli_query($con, $sql);

echo "<table border='1'>
<tr>
<th>Firstname</th>
<th>Lastname</th>
<th>Hometown</th>
<th>Job</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['FirstName'] . "</td>";
  echo "<td>" . $row['LastName'] . "</td>";
  echo "<td>" . $row['Hometown'] . "</td>";
  echo "<td>" . $row['Job'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

mysqli_close($con);*/
?>