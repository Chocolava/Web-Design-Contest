<?php
	session_start();
	
	session_destroy();
	
	echo "<center><div id='div1' onclick='sun()'>Thank you</div></center>";
	
?>

<html>
	<head>
		<script>
			function sun()
			{	window.location.href="home3.html";
			}
		</script>
		<style>
			#div1
			{	width:160px;
				height:160px;
				text-align:center;
				vertical-align:middle;
				line-height:160px;
				border-radius:80px;
				border:dashed;
				border-color:white;
				border-width:6px;
				background-color:#43bfc7;
				color:white;
				position:absolute;
				margin-top:200px;
				margin-left:510px;
				font-size:24px;
				font-family:Corbel;
			}
			#div1:hover
			{	background-color:#008080;
			}
			@font-face
			{	font-family: 'Corbel';
				src: url('Fonts/corbel.ttf');
			}
		</style>
	</head>
</html>
