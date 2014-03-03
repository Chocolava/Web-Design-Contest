<!DOCTYPE html>
<html>
<head>
<style>
#file_container
{
 width:450px;
 height:350px;
 margin-left:400px;
 margin-left:350px;
 margin-top:150px;
 font-family:Corbel;
 font-size:40px;
 backround-color:cyan;
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

</style>
<script>
</script>
</head>
<body>
<form action="uploader.php" method="post" enctype="multipart/form-data" name="mutiple_file_upload_form" id="mutiple_file_upload_form">
    	<div id="file_container">
		<div id="div2" >Upload Files</div>
		<div id="div3"><label style="font-weight:bold;text-align:center;">Upload:<input name="upload" type="file"  style="text-align:center;" value="" multiple><br><br>
		</div>
		<div id="div1"><label style="size:20 px;"><b>Home Page:</b></label><input type="text" name="homepage" id="homepage">
		<div id="div4"><input type="submit" value="submit" onclick()="checkfile()" style="margin-top:50px;width:80px;height:20px;float:left;text-align:center;">
		<input type="reset" value="cancel" style="width:80px;height:20px;float:right;margin-top:50px;">
		
		</div>
		
</form>
</body>
</html>
<!-- <label style="color:white;font-weight:bold;text-align:center;margin-top:60px;">Upload:<input name="filearray" type="file"  style="width:180px;height:30px;text-align:center;" /><br><br></div> -->