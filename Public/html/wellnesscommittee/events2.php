<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Fleming Administration Building</title>
   <link rel="stylesheet" href="/styles/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="/styles/fleming.css" type="text/css">
<style>
#eventsTable {width:475px;}
#eventsTable td {vertical-align:middle;}
strong {font-size:12px;}
.imgwithlink img {vertical-align:middle;}
</style>

<script src="/scripts/jquery.js"></script>

<script>
 $(document).ready(function() {

	$("#punchcard").css("display","none");

   $("#eventsTable tr").hover(
  function () {
    $(this).css("background-color","#ffffcc");
  },
  function () {
    $(this).css("background-color","transparent");
  }
);

 });


</script>

</head>
<body>
<div id="doc" class="yui-t2">
   <?php include "../includes/banner.html"; ?>
   <div id="bd" role="main">
	<div id="yui-main">
	<div class="yui-b">
    <div class="yui-g">

 <div class="breadcrumbs"><a href="/">Home</a> &gt; <a href="/wellnesscommittee">Wellness Committee</a> &gt; Events</div>

<h1 style="margin-bottom:10px;padding-bottom:0px;">Fleming Wellness Committee Events</h1>


<p style="font-weight:bold;"><a href="javscript:void(0)" onclick="javascript:$('#punchcard').toggle();">Check out the MHealthy Classes punch card</a></p>

<div id="punchcard" style="border-left:1px solid #ccc;padding-left:10px;margin-left:5px;">If your schedule varies, or you want to participate in several different classes, consider purchasing MHealthy's 15-Visit Punch Card. The card is good for any 100 level classes, at any MHealthy location. <a href="http://www.hr.umich.edu/mhealthy/programs/activity/classes/classes.html">Click here for MHealthy Class Descriptions</a>.

<p><strong>This $50 punch card CANNOT be used for Spinning, Yoga, tai Chi, Pilates, or Stability ball Body Sculpting.</strong></p>

<p>Punch Cards are valid for 6 months from the date of purchase at a cost of $50. Please note that we are unable to offer discounts on this option. You can order your punch card by going into the <a href="http://www.hr.umich.edu/mhealthy/programs/activity/classes/reg_info.html">MHealthy registration system</a> and ordering one. We will send the punch card to the address on record, unless you let us know differently by emailing us at <a href="mailto:mhealthy@umich.edu">mhealthy@umich.edu</a>.  For more information and/or to order a punch card, please call 647-7888.</p></div>



<!--<div id="emphasis" style="margin:5px 0 15px 0;"><strong>Wellness Room Availability</strong>
<br />The Fleming Wellness Room is unavailable for general use on Thursdays from 5:15 to 6:00pm and Fridays from 12:15 to 1:00pm, May 6 - August 12, 2011.  This is due to MHealthy Circuit Training Classes.
</div>-->









<!--<h2><a name="sep"></a>September 2012</h2>

<table cellspacing="0" cellpadding="0" id="eventsTable" >
  <tr>
  <th>Date</th>  
  <th width="230">Event</th>
  <th>Details</th></tr>


<tr>
  <td width="67">19th</td> 
  <td><strong>MGames and Torch Relay</strong></td>  
  <td>
<p>~11am-2pm</p>
</td>
</tr>


</table>
-->





<?
include "config.php";
//i will count the # of events
$i = 0;

$currentmonth = date('m');

//initializing arrays....
$Jan = array();
$Feb = array();
$Mar = array();
$Apr = array();
$May = array();
$Jun = array();
$Jul = array();
$Aug = array();
$Sep = array();
$Oct = array();
$Nov = array();
$Dec = array();

$query = "SELECT * FROM `rsvp_events` ORDER BY `date`";

$result = mysql_query($query);
$count = mysql_num_rows($result);


while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 


$thisyear = date("Y");
$year = substr($row['date'], 0, 4);
$month = substr($row['date'], 5, 2);

//M = A short textual representation of a month, three letters (Jan)
$monthcheck = date("M", mktime(0, 0, 0, $month+1, 0, 0));
//echo $monthcheck;


$day = substr($row['date'], 8, 2);

$date = date("jS", mktime(0, 0, 0, $month, $day, $year));



if ($year >= $thisyear) { 

if ($month >= $currentmonth) {
	
$event = "<tr>";

if ($row['specialdate']) {
	$event .= "<td width='67'>".$row["specialdate"]."</td>"; 
}
else {$event .= "<td width='67'>".$date."</td>";}

$event .= "<td><strong>".$row['title']."</strong></td>  
  <td>
<p>".$row['location'];

if ($row['pdf']) {
	$event .= "<br><a href='".$row['pdf']."' target='_blank'><img src='/images/pdficon.gif' alt='PDF' border='0' /></a> <a href='".$row['pdf']."' target='_blank'>Flyer</a></p></td></tr>";
}//end if

if ($oldmonth != $month) {$i = 0;}
if ($i == 0) {array_push($$monthcheck, $year);}

array_push($$monthcheck, $event);
$i++;
$oldmonth = $month;
}//end parent if
}//end parent if 
}//end while
mysql_free_result($result);


for ($k=$currentmonth; $k < 13; $k++) {
	$writtenoutmonth = date("F", mktime(0, 0, 0, $k+1, 0, 0));
	$shortmonth = date("M", mktime(0, 0, 0, $k+1, 0, 0));

	
	if (count($$shortmonth) > 0) {
		
	echo "<h2><a name='$shortmonth'></a>$writtenoutmonth ".${$shortmonth}[0]."</h2>";
	
	if ($writtenoutmonth == "February") {echo "<p><a href='/wellnesscommittee/documents/MHealthyFeb.pdf' target='_blank'>February Mhealthy Events</a></p>";}
	
	echo "<table cellspacing='0' cellpadding='0' id='eventsTable' >
  <tr>
  <th>Date</th>  
  <th width='230'>Event</th>
  <th>Details</th></tr>";

//start at one because the first item in the array is always the year
for ($j=1;$j < count($$shortmonth); $j++) {
	//http://php.net/manual/en/language.variables.variable.php
	//"In order to use variable variables with arrays, you have to resolve an ambiguity problem. 
	//That is, if you write $$a[1] then the parser needs to know if you meant to use $a[1] 
	//as a variable, or if you wanted $$a as the variable and then the [1] index from that variable. 
	//The syntax for resolving this ambiguity is: ${$a[1]} for the first case and ${$a}[1] for the second."
	echo ${$shortmonth}[$j];

}//end for
  
  echo "</table>";
	}//end if

	
	
}//end for

if ($i == 0) {
	echo "<p style='font-weight:bold;margin-top:40px;'>No upcoming events!</p>";
	}
?>






<p>&nbsp;</p>



</div>
</div>
	</div>
    <?php include "../includes/flemingleft.html"; ?>
	

	</div>
    <?php include "../includes/footer.html"; ?>

</div>
<p>&nbsp;</p>
</body>
</html>
