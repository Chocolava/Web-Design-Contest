<?php session_start();	?>
<html>
<head>
<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="js/county.js" type="text/javascript"></script>
<style>
#div1
{				width:180px;
				height:100px;
				text-align:center;
				horizontal-align:middle;
				line-height:100px;
				border-radius:90px;
				background-color:#357ec7;
				color:white;
				position:relative;
				margin-top:100px;
				margin-left:600px;
				font-size:24px;
				font-family:Corbel;
}
			#div1:hover
			{	background-color:#b6b6b4;
			}
			@font-face
			{	font-family: 'Corbel';
				src: url('Fonts/corbel.ttf');
			}
#div2
{
width:500px;
height:400px;
}
#sub
{
cursor:pointer;
position:absolute;
top:5.26em;
left:703;
background:#357ec7;
color:white;
height:40;
width:150;
}
.fl
{

}
#this
{
display:none;
}
table
{
margin-left:25em;
position:absolute;
top:7.2em;
border-top:solid #D1D1C2;
width:40%;
}
td
{
text-align:center;
}
tr
{
background:#F0F0EB;
}
#but
{
cursor:pointer;
margin:0 0 0 500;
position:absolute;
top:70;
background:#357ec7;
color:white;
height:40;
width:90;
}
#but1
{
cursor:pointer;
position:absolute;
top:70;
left:605;
background:#357ec7;
color:white;
height:40;
width:90;
}
body
		{	background-color:#faf9f4;
		}
</style>
<script>
 function display(txt) {
    window.event.srcElement.title = txt;
    window.status = txt;
  }
function sun()
			{	window.location.href="userhome.php";
			
			}
function add()
{
var table=document.getElementById("tableid");
var rowcount=table.rows.length;
var row=table.insertRow(rowcount);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
cell2.innerHTML="<input type='checkbox' name='chk' value=''>";
cell1.innerHTML='<input type="file" name="file[]"  class="fl" multiple="multiple"  >';
}
function del()
{

var len=document.getElementById("tableid").rows.length;

var row=document.getElementsByName("chk");

for(var i=0;i<len;)
{
if(true==row[i].checked)
{
document.getElementById("tableid").deleteRow(i+1);
len=document.getElementById("tableid").rows.length;
}else{
i++;}
}

}
/*function checkbutton(){
 <?php echo $ind ?>==2 || <?php echo $ind ?>==3 )
{
var submitButton = document.getElementById('but1');
submitButton.disabled=true;
return true;
}*/
</script>
</head>
<body>
<div id='div2'>

<button  type="button"name="Del" id="but1" value="Del" onclick="del()"  onmouseover="display('Tick the files you want to delete');" >Delete files</button>
<form action="upload_file.php" method="post"  enctype="multipart/form-data" id="formid">
<input type="button" value="Attach files" id="but" onclick="add()"  onmouseover="display('you must upload after choosing files..first file to be uploaded will be treated as homepage')"/>
<table id="tableid" align="center">
<tr>
<td style="font-size:1.5em"><b><center>Filename</b></center></td>
<td style="font-size:1.5em"><b><center>delete</b></center></td>
</tr>

</table>
<input type="submit" id="sub" value="upload all attachments"  onmouseover="display('upload all the attached files')" \>
</form>
</div>
<div id='div1' onclick='sun()'>Back to home</div>
</body>
</html>
<?php 
$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
if(mysqli_connect_errno()) //For checking any errors
		{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
		}
else
{
$sql = "SELECT * FROM contesttable WHERE contestStatus = 'current'";
	$res = mysqli_query($con, $sql);
	$ans = mysqli_fetch_array($res);
	$start = $ans['startDate'];
	$end = $ans['endDate'];
	date_default_timezone_set('Asia/Kolkata');
	$now = new DateTime();
	$dtA = new DateTime($start);
	$dtB = new DateTime($end);
	
	if ( $now>=$dtA && $now<=$dtB ) 
	{	//$interval = $now->diff($dtB);
		$ind = 1;
		$t = $dtB->format('Y-m-d H:i:s');
	}
	else if( $now<$dtA )
	{	//$interval = $now->diff($dtA);
		$ind = 2;
		$t = $dtA->format('Y-m-d H:i:s');
	}
	else if($now > $dtB)
	{	$ind = 3;
		$t = $now->format('Y-m-d H:i:s');
	}
	$_SESSION['time']=$ind;
}
if($ind==2||$ind==3)
{
header('Location:upload_file.php');
}

 mysqli_close($con);
?>