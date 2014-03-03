<?php 
session_start();
 if(!isset($_SESSION['start']))
 {	exit("<center>You are not authorised to access this page<br><a href='home.html'>Go back to home page</a></center>");
 }
session_destroy();
 ?>
<html>
<head>
<style>
a:hover{
background-color:orange;
}
body
{
font-size:1.5em;
}
img
{
height:70;
width:70;
}
</style>
</head>
<body>
<br>
<br>
<br>
<br>
<p align="center">
You are logged out.
<br><br>
Go back to homepage here
<br><br>
<a href="home.html">
<img src="home.png" \></a>
</p>
</body>

</html>
