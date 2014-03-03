<html>
<head>
<style>
#file_container
{
 width:450px;
 height:350px;
 margin-left:400px;
 margin-left:350px;
 margin-top:80px;
 font-family:Corbel;
 font-size:40px;
 background-color:white;
 font-color:#34561C;
 border:2px solid #87CEEB;
 text-align:center;
}
#div2
{
width:450px;
height:100px;
color:white;
background-color:#7171C6;
font-family:Corbel;
font-size:60px;
}
#div3
{
width:400px;
height:100px;
color:#33A1C9;
background-color:white;
font-family:Corbel;
font-size:20px;
margin-top:20px;
margin-left:40px;
}
#div1
{
width:450px;
height:50px;
margin-top:0px;
margin-left:0px;
font-family:Corbel;
font-size:20px;
color:#33A1C9;
text-align:center;
}
#div4
{
width:350px;
height:100px;
margin-top:0px;
margin-left:50px;
}

#div5
{	
width:180px;
height:100px;
text-align:center;
horizontal-align:middle;
line-height:100px;
border-radius:90px;
background-color:#7171C6;
color:white;
position:absolute;
margin-top:80px;
margin-left:180px;
font-size:24px;
font-family:Corbel;
}
</style>
<script>
			function sun()
			{	window.location.href="userhome.php";
			
			}
</script>
</head>
<body>
<form action="uploading.php" method="post" enctype="multipart/form-data" name="mutiple_file_upload_form" id="mutiple_file_upload_form">
<div id="file_container">
<div id="div2" >Upload Files</div>

<div id="div3"><label style="font-weight:bold;text-align:center;">Upload<input type="file" webkitdirectory directory multiple accept="text/plain" style="text-align:center;" value="" ><br><br></div>
<div id="div1"><label style="size:20px;"><b>Home Page:</b></label><input type="text" name="homepage" id="homepage"></div>
		<div id="div4"><input type="submit" value="submit" onclick()="checkfile()" style="margin-top:50px;width:80px;height:20px;float:left;text-align:center;">
		<input type="reset" value="cancel" style="width:80px;height:20px;float:right;margin-top:50px;"></div>
</div>
</form>
<div id="div5" onclick='sun()'>Go Back To Home</div>
</body>
</html>		