<?php
session_start();
	if(	$_SESSION['loginstatus']!='true')
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
		$ans=mysqli_fetch_array($res);
		$teampath=$ans['path'];
		$fileurl=$teampath."".$file;
    if (file_exists($fileurl)) {       
        header('Content-Description: File Transfer'); 
        header('Content-Type: application/octet-stream'); 
        header('Content-Length: ' . filesize($fileurl)); 
		header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' ); 
		header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
		header( 'Cache-Control: post-check=0, pre-check=0', false ); 
		header( 'Pragma: no-cache' ); 
        header('Content-Disposition: attachment; filename='.$file); 
		readfile($fileurl);
        exit();
    }

    // if file is not available send 404
    header( $_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    exit();
	}
	}
?>