<?php
	session_start();
	if(!isset($_SESSION['start']))
		{	exit('<center>You are not authorised to access this page<br><a href="home.html">Go back to home page</a></center>');
		}
	$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
	if(mysqli_connect_errno())
	{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
	}	
	$sql = "SELECT * FROM contesttable WHERE contestStatus = 'Current'";
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
?>
<html>
	<head>
		<link href="css/county.css" rel="stylesheet" type="text/css" />
		<link href="evalstyling.css" rel="stylesheet" type="text/css" />
		<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
		<script src="js/county.js" type="text/javascript"></script>
		<script type="text/javascript">
		 $(document).ready(function () {
            $('#cdown').county({ endDateTime: new Date('<?php echo $t;?>'), reflection: false, animation: 'scroll', theme: 'blacky' });
        });
		</script>
		<script>
			function timer()
			{
			var x = <?php echo $ind ?> ;
			if(x == 1)
			{	
			document.getElementById('cind').innerHTML = 'Contest will end in';
				document.getElementById('submit').style.display='block';
			}
			else if(x == 2)
			{	document.getElementById('cind').innerHTML = 'Contest will begin in';
				document.getElementById('tab').style.display='none';

			}
			else
			{	
				document.getElementById('cind').innerHTML = 'Contest has ended';
				document.getElementById('submit').style.display='block';
			}
			}
			
			function check(err)
			{	
				var myForm = document.forms[0];
				var myControls = myForm.elements['marks[]'];
				for(var i=0;i<myControls.length;i++)
				{
					if(myControls[i].value>100)
						{
							alert("marks cannot be more than 100");
							break;
						}
				}
			}
			function hide()
			{
			document.getElementById('check1').innerHTML='';
			}
			function hide1()
			{
			document.getElementById('check3').innerHTML="";
			}
			function button1()
			{
			document.getElementById("1").innerHTML="<form action='updateevalpass.php' onsubmit='return validate()' method='post'><table><tr><td><pre> </pre></tr><tr><td>Enter current Password: </td><td><input type='password' onblur='ajax1(this.value)' id='pass' onkeydown='hide()' \></td><td><div id='check1'></div></td></tr><tr><td>Enter New password: </td><td><input type='password'  id='pass1' onblur='ajax2(this.value)'\></td><td><div id='check2'></div></td></tr><tr><td>Conirm New Password: </td><td><input type='password' id='pass2' onkeydown='hide1()' name='pass2' '\></td><td><div id='check3' >&nbsp;</div></td></tr><tr><td><input id='id3' type='submit' value='Go'  ></td></tr></table></form>";
			}
			function my()
			{
			document.getElementById("1").innerHTML=""
			}
			function button2()
			{
			window.location="logouteval.php";
			}
			function ajax1(str)
			{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("check1").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","evalajax.php?q="+str,true);
xmlhttp.send();

}
function ajax2(str)
{
				var alphaExp = /^[0-9a-zA-Z]+$/;
				
				if((str=="" )|| (!(str.match(alphaExp))))
				{	   
					document.getElementById("check2").innerHTML="<font size='0.3em' color='maroon'>Password can include only numbers or characters</font>";
					return false;
				}
}
function ajax3(str)
{
if(str!=document.getElemenById("pass1").value)
{
document.getElemenById("check3").display='block';
}
}
function validate()
{
var a=document.getElementById("pass1").value;
if(a!=document.getElementById("pass2").value||a=="")
{
ajax2(a);
document.getElementById("check3").innerHTML="<font color='maroon' >! Passwords donot match</font>";
return false;
}
else if((document.getElementById("check1").innerHTML=="")&&(document.getElementById("pass").value=="")||document.getElementById("check1").innerHTML!="")
{var a=document.getElementById("pass").value;
ajax1(a);
document.getElementById("check1").innerHTML="<font color='maroon' >Incorrect Password</font>";
return false;
}
return true;
}
		</script>
		<style>
			
		</style>
		
		
	</head>
	<body onload="timer()">
	<?php
	$count = 1;
	$con=mysqli_connect("localhost","root","","database")or die("failed to connect");
	$sel="SELECT *FROM teamtable";
	$result=mysqli_query($con,$sel);?>
	<div id="titlediv"><img src="acm.jpg" style="float:left;"><img src="igit.jpg" style="float:right;">Evaluate Submissions</div>
	
	<div id="Div10" style="float:left;width:100%;height:120px;text-align:center;">
			<div id="cind" style="width:50%;height:100%;font-size:26px;text-align:center;float:left;line-height:120px;vertical-align:middle;"></div>
			<div id="cdown" style="width:30%;height:100%;float:left;margin-left:20px;"></div>
	</div>
			<div id="Div" style="float:left;width:25%;height:100%;">
	<button type="button" class="button" onmouseover= "button1()" onclick="my()">Change Password</button>
	
			<button type="button" class="button" onclick= "button2()"  />Logout</button> 
	</div>
	<div id="1" style="background:#F0F0EB; padding-left:8px;margin-left:500px;width:400px;margin-top:140px ;border-radius:25px; border:3px solid white;margin-bottom:-100px;width:500px;" align="left"  ; >

	
	</div>
	<table id="tab">
	<tr>
	<th>Serial #</th><th>Team Name</th><th>Team Url</th><th>Team marks(100)</th>
	</tr>
	<form action="evalresult.php" method="post">
	<?php	while($row=mysqli_fetch_array($result)){?>
	
	<tr>
	<td id="col1"><?php echo $count; $count = $count + 1;?></td>
	<td id="col2"><?php echo $row['teamName'];?></td>
	<td id="col3"><a href="<?php echo "upload/".$row['teamName']."/".$row['teamURL'];?>" ><?php echo $row['teamURL'];?></a></td>
	<td><input type="text" name="marks[]" id="marks" value="<?php echo $row['teamResult']?>" onkeydown="my(this.value)"></td>
	<span id="txt"></span>
	</tr>
	<?php }?>
	</table>
	<br><br>
		<input type="submit" name="submit" id="submit" value="Submit" >
	</form>
			
	</body>
</html>
