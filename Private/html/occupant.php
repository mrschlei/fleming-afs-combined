<?
error_reporting(-1);
ini_set('display_errors', 'On');
//The sign/desk plate field may beed <br>'s inserted for /r/n's
function nl2br_limit($string, $num){
   
$dirty = preg_replace('/\r/', '', $string);
$clean = preg_replace('/\n{4,}/', str_repeat('<br/>', $num), preg_replace('/\r/', '', $dirty));
   
return nl2br($clean);
}



if (isset($_POST['submitted'])) { 

$sign = "";
if (isset($_POST['Sign-Special'])) {
 $sign = nl2br_limit($_POST['Sign-Special'],6);
}
// To send HTML mail, the Content-type header must be set
//$headers  = 'MIME-Version: 1.0' . "\n";
$headers  = 'MIME-Version: 1.0' . "\n";
$headers .= 'Content-type: text/html; charset=\"iso-8859-1\"' . "\n";


$from  = "From: 'Apache' <apache@formula1.dsc.umich.edu>\n";
if ($_SERVER['REMOTE_USER']) {
	$from = "From: '".$_SERVER['REMOTE_USER']."@umich.edu' <".$_SERVER['REMOTE_USER']."@umich.edu>\n";
}
// Additional headers
$headers .= $from;



//Subject
$type = "";
if (isset($_POST['Type'])) {$type = $_POST['Type'];}
$subject = $type." Occupant Form";

$msg = "<html><body style='font-family:Verdana, Geneva, sans-serif;font-size:12px;'>";
$msg .= "<table style='font-family:Verdana, Geneva, sans-serif;font-size:12px;'>";

$msg .= "<tr><td colspan='2'><strong>Occupant Name</strong>: ";
if (isset($_POST['OccupantName'])) {
$msg .= $_POST['OccupantName'];
}
$msg .= "</td></tr>";



$msg .= "<tr><td colspan='2'><strong>Status</strong>: ";
if (isset($_POST['Status'])) {
	$msg .= $_POST['Status'];
}
$msg .= "</td></tr>";



$msg .= "<tr><td width='250'><strong>UMID</strong>: ".$_POST['UMID']."</td>";
$msg .= "<td><strong>Occupant Email</strong>: ".$_POST['OccupantEmail']."</td></tr>";
$msg .= "<tr><td width='250'><strong>Department</strong>: ".$_POST['Department']."</td>";
$msg .= "<td><strong>Position</strong>: ".$_POST['Position']."</td></tr>";
$msg .= "<tr><td width='250'><strong>Room Number</strong>: ".$_POST['RoomNumber']."</td>";
$msg .= "<td><strong>Key Code(s)</strong>: ".$_POST['KeyCode']."</td></tr>";
$msg .= "<tr><td colspan='2'><strong>Office Phone Number</strong>: ".$_POST['OfficePhoneNumber']."</td></tr>";
$msg .= "<tr><td width='250'><strong>Date of Start/End</strong>: ".$_POST['StartDate']."</td>";

$msg .= "<td><strong>After-Hours Access</strong>: ";
if (isset($_POST['After-Hours-Mcard'])) {
	$msg .= $_POST['After-Hours-Mcard'];
}
$msg .= "</td></tr>";

if (isset($_POST['CubicleSign']) || isset($_POST['DeskNamePlate']) || isset($_POST['OfficeDoorSign'])) {
	$text = "";
	$i = 0;
	
	if (isset($_POST['CubicleSign'])) {
		$text .= "Cubicle Sign";
		$i++;
		}
	if (isset($_POST['DeskNamePlate'])) {
		if ($i > 0) {
		$text .= ", Desk Name Plate";}
		else {$text .= "Desk Name Plate";$i++;}
		}
	if (isset($_POST['OfficeDoorSign'])) {
		if ($i > 0) {
		$text .= ", Office Door Sign";}
		else {$text .= "Office Door Sign";}
		}
	
$msg .= "<tr><td colspan='2'><strong>Building Signage</strong>: ".$text."</td></tr>";
}



if ($sign) {
$msg .= "<tr><td colspan='2'><strong>Signage Instructions</strong>: ".$sign."</td></tr>";
}

	
$msg .= "<tr style='padding:4px;background-color:#e6e6e6;'><td colspan='2'>Key(s) Requested:<br />Please list all rooms access needed including main door entry:</td></tr></table>";

$msg .= "<table style='border:1px solid #000;border-collapse:collapse;font-family:Verdana, Geneva, sans-serif;font-size:12px;' cellpadding='5'>";
$msg .= "<tr><td></td><td></td><td>AVPFO USE</td><td></td></tr>";
$msg .= "<tr><td width='250' style='background-color:#e6e6e6;'>Room/Area</td><td style='background-color:#e6e6e6;'>Key Code</td><td style='background-color:#e6e6e6;'>Initials & Date Out</td><td style='background-color:#e6e6e6;'>Initials and Date In</td></tr>";
$row = "<tr style='height:25px;'><td style='background-color:#e6e6e6;border:1px solid #000;'>&nbsp;</td><td style='background-color:#e6e6e6;border:1px solid #000;'>&nbsp;</td><td style='background-color:#e6e6e6;border:1px solid #000;'>&nbsp;</td><td style='background-color:#e6e6e6;border:1px solid #000;'>&nbsp;</td></tr>";
$msg .= $row;
$msg .= $row;
$msg .= $row;
$msg .= $row;

$msg .= "</table>";


$msg .= "<ul><li>Keys are NOT transferable.</li>";

$msg .= "<li>Individuals no longer authorized to have Fleming Building access due to termination, change in duties, change in location, etc. <strong>must</strong>:</li>";
$msg .= "<ul><li>Notify the Office of the Associate Vice President for Facilities and Operations (3025 Fleming) and</li>";
$msg .= "<li>Return keys to the Office of the Associate Vice President for Facilities and Operations (3025 Fleming).</li></ul>";
$msg .= "<li>Afterhours building access is via MCard only.</li>";

$msg .= "<li>Access to the building after hours for temporary employees and visitors is to be provided by a regular employee and not by providing or loaning building keys.</li>";

$msg .= "<li>All lost keys and MCards need to be reported to the Office of the Associate Vice President for Facilities and Operations (3025 Fleming) <strong>immediately</strong>.</li></ul>";

$msg .= "<p>Date:  ___________________________________</p>";
$msg .= "<p>Department Administrator / Building Staff Member:<br /><br />_________________________________________________________</p>";

$msg .= "</body></html>";


$msg= wordwrap($msg,900, "\n");
//flemdoc.staff@umich.edu
      if (mail("flemdoc.staff@umich.edu", $subject, $msg, $headers))
  {
	  header('Location: thanks.html');
	  //var_dump($_POST);
	  //echo "<hr />";
	  //var_dump($headers);
	  //echo "<hr />";
	 //var_dump( mail("OHDAnalytics@umich.edu", $subject, $msg, $headers));
		 }
   
      else {
         echo "Form failed to submit - please contact afielek@umich.edu.";
}

} 


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Fleming Administration Building</title>
   <?php include "includes/styles.html"; ?>

</head>
<body>
<div id="doc" class="yui-t2">
<div class="secondwrap">
   <?php include "includes/banner.html"; ?>
   <div id="bd" role="main">
	<div id="yui-main">
	<div class="yui-b">
    <div class="yui-g">
<h1>Building Occupant Form</h1>

<p><strong>Department Key Administrators</strong>: Please complete the below information for building occupant changes.</p>

<!-- The following line is the FORM declaration.  In all cases, the 
     email address at the end (htmail-test-address@umich.edu) will be changed to 
     match the htmail enabled email address.  -->
<FORM METHOD=POST ACTION="<?php echo $_SERVER['PHP_SELF'] ?>">
<!-- flemdoc-staff -->
Type:
<select name="Type">
<option selected>New
<option>Leaving
<option>Update
</select> <span class="smaller">&lt;-- Click down arrow for options</span>


<P>
<!-- You can include a pop-up menu with the SELECT option.  You can
     cause one item to be pre-selected by using the "SELECTED" option. -->
Status:
<select name="Status">
<option selected>Regular
<option>Temporary
<option>Student
</select> <span class="smaller">&lt;-- Click down arrow for options</span>







<table id="formtable">
<tr>
<td width="275">
Name:
<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="OccupantName"></td>
<td>
UMID:</td>
<td align="right">&nbsp;<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="UMID"></p></td>
</tr>
</table>







<table id="formtable">
<tr>
<td width="275"><p>
Uniqname: <INPUT NAME="OccupantEmail" SIZE=16></p></td>
<td><p>
Date (of start, <br />end, leave, update):</p></td>
<td align="right"><br /><br /><INPUT TYPE="text" SIZE=15 MAXLENGTH=25 NAME="StartDate"></p></td>
</tr>
</table>




<!-- A text field allows the user to type one line of text.  You can
     specify the width of the field and maximum length.  For example,
     the following text field is 20 characters wide, and will accept only
     25 characters -->



<table id="formtable">
<tr>
<td width="275">
Department:
<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="Department"></td>
<td>
Position:</td>
<td align="right">&nbsp;<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="Position"> </p></td>
</tr>
</table>




<table id="formtable">
<tr>
<td width="275">
Office room #:
<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="RoomNumber"></td>
<td>
Key Code(s):</td>
<td align="right">&nbsp;<INPUT TYPE="text" SIZE=16 MAXLENGTH=25 NAME="KeyCode"> </p></td>
</tr>
</table>




<P>


Office phone #:
<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="OfficePhoneNumber">


<!--<P>

Key for Room(s)/Key Code(s):
<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="KeyCode">-->
<P>


After-hours building access via M-Card?<br />
<input type="radio" name="After-Hours-Mcard" value="Yes"> Yes<br />
<input type="radio" name="After-Hours-Mcard" value="No"> No<br />
<P>



<!-- A textarea gives the user a box into which they can type text.
     textareas are useful for open-ended comments.  The COLS= and
     ROWS= options set the width and height of the textarea, but
     do not limit how much text the user can type.  If the textarea
     is named "body", it will be included as the bode of the message.  -->

Building Signage:<br>
<input type="checkbox" name="DeskNamePlate" value="Desk Name Plate"> Desk name plate<br>
<input type="checkbox" name="CubicleSign" value="Cubicle Sign"> Cubicle sign<br>
<input type="checkbox" name="OfficeDoorSign" value="Office Door Sign"> Office door sign<br>
<p>Special signage instructions (Name preference, etc.):<P>
<TEXTAREA NAME="Sign-Special" COLS=50 ROWS=5></TEXTAREA><P>




<?php
	$text = $_SERVER['REMOTE_USER'];
	echo "<input name='from' type='hidden' value='".$text."@umich.edu' id='email' >";
?>




<p><input type=submit value="Submit Form" class="button"></p>



<input type="hidden" name="submitted" value="1">


</form>



</div>
</div>
	</div>
    <?php include 'includes/flemingleft.html'; ?>
	<!--#include virtual="includes/flemingleft.html"-->
	
	</div>
    
<?php include 'includes/footer.html'; ?>    
<!--#include virtual="includes/footer.html"-->
</div>
</div>
</body>
</html>
