<?

//The sign/desk plate field may beed <br>'s inserted for /r/n's
function nl2br_limit($string, $num){
   
$dirty = preg_replace('/\r/', '', $string);
$clean = preg_replace('/\n{4,}/', str_repeat('<br/>', $num), preg_replace('/\r/', '', $dirty));
   
return nl2br($clean);
}



if (isset($_POST['submitted'])) { 

$sign = nl2br_limit($_POST['Sign-Special']);

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'From: '.$_POST['from']. "\r\n";

//Subject
$subject = $_POST['Type']." Occupant Form";






$msg = "<html><body style='font-family:Verdana, Geneva, sans-serif;font-size:12px;'>";

$msg .= "<table style='font-family:Verdana, Geneva, sans-serif;font-size:12px;'>";
$msg .= "<tr><td colspan='2'><strong>Occupant Name</strong>: ".$_POST['OccupantName']."</td></tr>";
$msg .= "<tr><td colspan='2'><strong>Type</strong>: ".$_POST['Type']."</td></tr>";

$msg .= "<tr><td width='250'><strong>UMID</strong>: ".$_POST['UMID']."</td>";
$msg .= "<td><strong>Occupant Email</strong>: ".$_POST['OccupantEmail']."</td></tr>";
$msg .= "<tr><td width='250'><strong>Department</strong>: ".$_POST['Department']."</td>";
$msg .= "<td><strong>Position</strong>: ".$_POST['Position']."</td></tr>";
$msg .= "<tr><td width='250'><strong>Room Number</strong>: ".$_POST['RoomNumber']."</td>";
$msg .= "<td><strong>Office Phone Number</strong>: ".$_POST['OfficePhoneNumber']."</td></tr>";
$msg .= "<tr><td width='250'><strong>Status</strong>: ".$_POST['Status']."</td>";
$msg .= "<td><strong>Start Date</strong>: ".$_POST['StartDate']."</td></tr>";
$msg .= "<tr><td width='250'><strong>KeyCode</strong>: ".$_POST['KeyCode']."</td>";
$msg .= "<td><strong>After-Hours Access</strong>: ".$_POST['After-Hours-Mcard']."</td></tr>";



if ($_POST['CubicleSign'] || $_POST['DeskNamePlate'] || $_POST['OfficeDoorSign']) {
	$text = "";
	$i = 0;
	
	if ($_POST['CubicleSign']) {
		$text .= "Cubicle Sign";
		$i++;
		}
	if ($_POST['DeskNamePlate']) {
		if ($i > 0) {
		$text .= ", Desk Name Plate";}
		else {$text .= "Desk Name Plate";$i++;}
		}
	if ($_POST['OfficeDoorSign']) {
		if ($i > 0) {
		$text .= ", Office Door Sign";}
		else {$text .= "Office Door Sign";}
		}
	
$msg .= "<tr><td colspan='2'><strong>Signage required</strong>: ".$text."</td></tr>";
}



if ($sign) {
$msg .= "<tr><td colspan='2'><strong>Signage Instructions</strong>: ".$sign."</td></tr>";
}
	
$msg .= "<tr style='padding:4px;background-color:#e6e6e6;'><td colspan='2'>Key(s) Requested:<br />Please list all rooms access needed including main door entry:</td></tr></table>";

$msg .= "<table style='border:1px solid #000;border-collapse:collapse;font-family:Verdana, Geneva, sans-serif;font-size:12px;' cellpadding='5'>";
$msg .= "<tr><td></td><td></td><td>AVPFO USE</td><td></td></tr>";
$msg .= "<tr><td width='250' style='background-color:#e6e6e6;'>Room/Area</td><td style='background-color:#e6e6e6;'>Key Code</td><td style='background-color:#e6e6e6;'>Initials & Date Out</td><td style='background-color:#e6e6e6;'>Initials and Date In</td></tr>";
$row = "<tr style='height:25px;'><td style='background-color:#e6e6e6;border:1px solid #000;'>&nbsp;</td><td style='background-color:#e6e6e6;border:1px solid #000;'>&nbsp;</td><td style='background-color:#e6e6e6;border:1px solid #000;'>&nbsp;</td><td style='background-color:#e6e6e6;border:1px solid #000;'></td></tr>";
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
///flemdoc.staff
      if (mail("mrschlei@umich.edu", $subject, $msg, $headers))
  {
	  header('Location: thanks.html');
		 }
   
      else {
         echo "Form failed to submit - please contact afielek@umich.edu.";
}

} 


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<!--begin-->
<html>
<head>
   <title>Fleming Administration Building</title>
   <link rel="stylesheet" href="styles/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="styles/fleming.css" type="text/css">

</head>
<body>
<p>&nbsp;</p>
<div id="doc" class="yui-t2">
   <a href="http://fleming.bf.umich.edu"><div id="hd" role="banner" style="height:150px;"></div></a>
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

<select name="Type">
<option selected>New
<option>Leaving
<option>Update
</select>


<p>UMID #:
<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="UMID">


<p>Name:
<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="OccupantName">


<!-- The following is a simple example of a text input field.  NOTE:
     htmail *must* have a "from" field.  If you take this out, htmail
     won't work!!! -->
     <p>
Uniqname: <INPUT NAME="OccupantEmail"><br />



<!-- A text field allows the user to type one line of text.  You can
     specify the width of the field and maximum length.  For example,
     the following text field is 20 characters wide, and will accept only
     25 characters --><p>
Department:
<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="Department">
<P>

Position:
<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="Position">
<P>


Office room #
<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="RoomNumber">
<P>


Office phone #
<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="OfficePhoneNumber">
<P>



<!-- You can include a pop-up menu with the SELECT option.  You can
     cause one item to be pre-selected by using the "SELECTED" option. -->
Status:
<select name="Status">
<option selected>Regular
<option>Temporary
<option>Student
</select>
<P>

Start Date:
<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="StartDate">
<P>

Key for Room(s)/Key Code:
<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="KeyCode">
<P>


After-hours building access via M-Card?:<br />
<input type="radio" name="After-Hours-Mcard" value="Yes"> Yes<br />
<input type="radio" name="After-Hours-Mcard" value="No"> No<br />
<P>



<!-- A textarea gives the user a box into which they can type text.
     textareas are useful for open-ended comments.  The COLS= and
     ROWS= options set the width and height of the textarea, but
     do not limit how much text the user can type.  If the textarea
     is named "body", it will be included as the bode of the message.  -->

Signage required:<br>
<input type="checkbox" name="DeskNamePlate" value="Desk Name Plate"> Desk name plate<br>
<input type="checkbox" name="CubicleSign" value="Cubicle Sign"> Cubicle sign<br>
<input type="checkbox" name="OfficeDoorSign" value="Office Door Sign"> Office door sign<br>
<p>Special signage instructions (Name preference, etc.):<P>
<TEXTAREA NAME="Sign-Special" COLS=50 ROWS=5></TEXTAREA><P>




<?php
	$text = $_SERVER['REMOTE_USER'];
	echo "<input name='from' type='hidden' value='".$text."@umich.edu' id='email' >";
?>




<p><input type=submit value="Submit Form" style="padding:7px;"></p>



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
<p>&nbsp;</p>
</body>
</html>
