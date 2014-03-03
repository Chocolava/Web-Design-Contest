<?php
	session_start();
	$_SESSION['loginstatus']="false";
	
	
	//echo "<center><div id='div1' onclick='sun()'>logged out</div></center>";
	
	session_destroy();
	header('Location:home.html');
?>

