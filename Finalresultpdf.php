<?php
session_start(); 
		   if(	$_SESSION['loginstatus']!="true")
			{	exit( "<center><strong>You are not authorised to access this page.<br><a href='home.html'>Go back to home page.</a></strong></center>");
			}
	$con = mysqli_connect("localhost","wd_user", "wd_igdtuw", "wd_db");
	if(mysqli_connect_errno())
	{	echo "Failed to connect to mySQL: ". mysqli_connect_error();
	}	
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
if(	@$_SESSION['loginstatus']!="true")
{	echo "<center>You are not authorised to access this page.<br><a href='userhome.php'>Go back to home page</a></center>";
}
else if($ind!= 3)
{	exit('<center>Results not out yet.<a href=\'userhome.php\'>Go back to home</a></center>');
}
else
{
require('fpdf.php');
$con=mysqli_connect("localhost", "wd_user","wd_igdtuw", "wd_db");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
class PDF extends FPDF
{
	function Header()
	{//$php_url = "http://www.igit.ac.in" ;
	$this->Image('IGDTU.jpg',10,20,40,30);
	//$this->Image('acm.jpg','R');
	$this->SetFont('Arial','B',24);
	$this->Cell(80);
	//$this->Image('Igit.png',100,5,35,);
	$this->Cell(30,10,'Indira Gandhi Delhi Technical University',0,1,'C');
	$this->Image('acm.jpg',150,20,40,30);
	$this->SetFont('Times','IU',30);
	$this->Cell(190,50,'ESPECTRO',0,1,'C');
	$this->ln(20);
	}
	function Footer()
	{	$this->SetFont('Times','B','blue',19);
		$this->SetY(-110);
		$this->Cell(10,10,'Rishabh Kaushal',0,1,'L');
		$this->SetFont('Arial','I',14);
		$this->SetY(-100);
		$this->Cell(0,10,'Assistant Branch Counsellor',0,1,'L');
		$this->SetY(-15);
		$this->SetFont('Arial','I',13);
		$this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
		$this->SetFont('Times','B',19);
		$this->SetY(-110);
		$this->Cell(0,10,'Dr.R.K.Singh',0,1,'R');
		$this->SetFont('Arial','I',14);
		$this->SetY(-100);
		$this->Cell(0,10,'Branch Counsellor',0,1,'R');
	}
}
$pdf =new PDF();
//$pdf->AddPage();
//$pdf->AliasNbPages();
	$result=mysqli_query($con,"SELECT * FROM teamtable ORDER BY teamResult DESC");
	$count=0;
//$que="SELECT * FROM teamtable WHERE teamName='Team5'";
while($row=mysqli_fetch_array($result))
{	
	if($_SESSION['id']==$row['teamName'])
		{ 	
			if($count<3)
			{	
			if($count==0)
				$var="First";
			else if($count==1)
				$var="Second";
			else if($count==2)
				$var="Third";
			$team=$row['teamMembers'];
			$teamMem=explode(",",$team);
			$colleges=$row['collegeName'];
			$excol=explode(",",$colleges);
			$num=count($teamMem);
			for($i=0;$i<$num;$i++)
				{
					if($teamMem[$i]==" ")
					{
							break;
					}
					$pdf->SetFont('Times','I',23);
					$pdf->AddPage();
					$pdf->AliasNbPages();
					//$pdf->SetFont('Times','I',23);
					$pdf->MultiCell(0,11,'This is to certify that Mr/Ms   ' .$teamMem[$i].'',0,1); 
					$pdf->MultiCell(0,11,'of        '.$excol[$i].'',0,1);  
					$pdf->MultiCell(0,11,'has won    '.$var.'',0,1);
					$pdf->MultiCell(0,11,'position in Website Development event in',0,1);
					$pdf->MultiCell(0,11,'ESPECTRO 2013- Annual Technical Fest Of ACM-IGDTU.',0,1);
				}
			}
			else
			{
			$team=$row['teamMembers'];
			$teamMem=explode(",",$team);
			$colleges=$row['collegeName'];
			$excol=explode(",",$colleges);
			$num=count($teamMem);
			for($i=0;$i<$num;$i++)
				{
					if($teamMem[$i]==" ")
					{
							break;
					}
					$pdf->SetFont('Times','I',23);
					$pdf->AddPage();
					$pdf->AliasNbPages();
					//$pdf->SetFont('Times','I',23);
					$pdf->MultiCell(0,11,'This is to certify that Mr/Ms   ' .$teamMem[$i].'',0,1); 
					$pdf->MultiCell(0,11,'of        '.$excol[$i].'',0,1);  
					$pdf->MultiCell(0,11,'has participated',0,1);
					$pdf->MultiCell(0,11,'in Website Development event in',0,1);
					$pdf->MultiCell(0,11,'ESPECTRO 2013- Annual Technical Fest Of ACM-IGDTU.',0,1);	
			}
}
}
$count++;
}
$pdf->Output();
mysqli_close($con);
}
?>
