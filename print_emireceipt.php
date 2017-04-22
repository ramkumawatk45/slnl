<?php
require('common/conn.php');
$d=date('d_m_Y');
$loanId = $_REQUEST['loanId'];
$emiNo = $_REQUEST['emiNo'];
	?>
    <script>							
function myprint()
{
	var mydata=document.getElementById('receipt').innerHTML;
	window.print('mydata'); 
	setTimeout(function(){window.close();},100);
}
</script>
<style type="text/css" media="print">
@page{size:auto; margin:7mm;}
</style>
<style type="text/css">
*{font-family:arial;}
.first, .second, .third{height:74px;float:left; font-family:open-sans;  font-size:12px; }
h2{margin:0px;}
.main{width:850px; margin-top:30px; text-align:center;  font-size:12px; }
.first{width:15%; border-right:none;}
.third{width:200px; text-align:left;  margin-left:73px; padding-left:5px; border:1px solid; border-bottom:none;}
.third span{ margin-top:10px;    line-height:18px;}
.second{width:52%;  border-left:none; border-right:none;}
.second span {font-size:12px;}

.firsttable,.thirdtable{ border-top:none;  font-size:12px !important;}
.firsttable td ,.thirdtable td{width:330px; font-size:16px; line-height:20px;padding-left:10px;  font-size:12px !important;}
.firsttable td{ border:none;  font-size:12px; }
 .sectable tr td{ border:none;  font-size:12px;} 
 .sectable tr td:nth-child(2), .sectable tr td:nth-child(5){width:10px;text-align:center; border:none;}
 .sectable tr td:nth-child(4){}
.sectable{ border-top:none;}
.sectable td{width:250px; font-size:16px; line-height:20px;padding-left:10px;}
.sec{ border-left:1px solid !important;}
.thirdtable{ padding-bottom:10px;  font-size:12px !important;}
</style>
<?php
 function convert_number($number)
{
if (($number < 0) || ($number > 999999999))
{
throw new Exception("Number is out of range");
}
 
$Gn = floor($number / 100000);  /* Millions (giga) */
$number -= $Gn * 100000;
$kn = floor($number / 1000);     /* Thousands (kilo) */
$number -= $kn * 1000;
$Hn = floor($number / 100);      /* Hundreds (hecto) */
$number -= $Hn * 100;
$Dn = floor($number / 10);       /* Tens (deca) */
$n = $number % 10;               /* Ones */
 
$res = "";
 
if ($Gn)
{
$res .= convert_number($Gn) . " Lacs";
}
 
if ($kn)
{
$res .= (empty($res) ? "" : " ") .
convert_number($kn) . " Thousand";
}
 
if ($Hn)
{
$res .= (empty($res) ? "" : " ") .
convert_number($Hn) . " Hundred";
}
 
$ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen",
"Nineteen");
$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty",
"Seventy", "Eigthy", "Ninety");
 
if ($Dn || $n)
{
if (!empty($res))
{
$res .= " and ";
}
 
if ($Dn < 2)
{
$res .= $ones[$Dn * 10 + $n];
}
else
{
$res .= $tens[$Dn];
 
if ($n)
{
$res .= "-" . $ones[$n];
}
}
}
 
if (empty($res))
{
$res = "zero";
}
 
return $res;
}
?>

<body onLoad="myprint()" >
<div id="receipt"> 
<?php
$strSQL = mysql_query("select * from loanemi where loanId='$loanId' and emiNo='$emiNo'");
while($result=mysql_fetch_array($strSQL))
{
	?>   
<div class="main">

<table class="firsttable" cellpadding="0" cellspacing="0" border="1" >
<tr><td style="border-top:1px solid !important;"></td><td style="border-top:1px solid !important;" ></td><td style="border-top:1px solid !important;"></td></tr>
<?php $query2 = mysql_query("select * from loans where loanId='$loanId'");
while($result2=mysql_fetch_array($query2)) {?>
<tr>
<td colspan="2">Name : <?php echo $result2['applicantName'];  ?> </td>
<td class="sec"><span>EMI No. : <?php echo $emiNo; ?> </td></tr>
<tr><td colspan="2">S/D/W/O : <?php echo $result2['gurdianName']; ?> </td>
	<td class="sec"> Receipt No. :<?php echo $result['id']; ?></td></tr>
<tr><td colspan="2">Address :<?php echo $result2['address']; ?> </td><td class="sec">CSC Name : <?php $branchCode = $result['branchCode']; $query4 = mysql_query("select * from branchs where branchId='$branchCode'");
while($result4=mysql_fetch_array($query4)) {echo $result4['branchName']; } ?></td></tr>
<tr><td colspan="2">Contact No : <?php echo $result2['memberMobile']; ?> </td><td class="sec"></td></tr>
<tr><td colspan="3" style="padding:3px; background-color:#eee; border-top:1px solid !important; "> Payment Receipt Details : </td></tr>
</table>
<table class="sectable" cellpadding="0" cellspacing="0" border="1" >
<tr>
<td>1) Loan No.</td><td> :</td><td><?php echo $loanId; ?></td>
<td>5) EMI Amount .</td><td>:</td><td><?php echo $taoi= round($result['emiAmount']); ?></td>
</tr>
<tr>
<td>2) Issued On Date</td><td> :</td><td><?php date_default_timezone_set('Asia/Kolkata');$cdate=date('d-m-Y');  echo $cdate; ?></td><td>6) Penalty</td><td>:</td><td><?php echo $lateFee= round($result['lateFee']);?></td></tr>
<tr><td>3) Plan Name & Term</td><td> :</td><td><?php $loanPlanId = $result2['loanPlanId']; $query3 = mysql_query("select * from loanPlan where id='$loanPlanId'");
while($result3=mysql_fetch_array($query3)) {echo $result3['planName']; }  ?></td><td>7) Total Receipt Amount</td><td>:</td><td><?php $taoi=$taoi+$lateFee+$result['serviceCharge']; echo $taoi; ?></td></tr>
<tr><td>4) Service Charges</td><td> :</td><td> <?php echo $result['serviceCharge']; ?></td><td>8) Due Date</td><td>:</td><td> <?php  echo $result['dueDate']; ?></td></tr>
<tr>
<td>9) Next Due Date</td><td>:</td>
<td>
	<?php $ndd = $ndddate = explode('-', $result['ndd']);
	 $month = $ndddate[1];
	 $day   = $ndddate[2];
	 $year  = $ndddate[0];
	 $joinNddDate = $day.'-'.$month.'-'.$year;  echo $joinNddDate; ?></td>
</tr>
</table>
<table class="thirdtable" cellpadding="0" cellspacing="0" >
<tr><td></td><td ></td><td></td></tr>
<tr><td colspan="2"><strong>Amount In Words :</strong><?php echo convert_number($taoi+$result['serviceCharge']);?> Rupees Only</td><td></td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td><td></td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td><td>Shri Life Nidhi limited</td></tr>
<tr><td >Authorized signature</td><td></td><td>(Cashier signature)</td></tr>
</table>
</div>
<?php } } ?>
</div>
</body>