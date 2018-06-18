<?

//The schedule field may beed <br>'s inserted for /r/n's
function nl2br_limit($string, $num){
   
$dirty = preg_replace('/\r/', '', $string);
$clean = preg_replace('/\n{4,}/', str_repeat('<br/>', $num), preg_replace('/\r/', '', $dirty));
   
return nl2br($clean);
}



if (isset($_POST['submitted'])) { 

$schedule = nl2br_limit($_POST['schedule']);

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\n";
$headers .= 'Content-type: text/html; charset=\"iso-8859-1\"' . "\n";

// Additional headers
$headers .= 'From: '.$_POST['from']. "\n";

//Subject
$subject = "New Fleming Meeting Request";



$msg = "<html><body style='font-family:Verdana, Geneva, sans-serif;font-size:12px;'>";

$msg .= "<table style='font-family:Verdana, Geneva, sans-serif;font-size:12px;'>";
//$msg .= "<tr><td colspan='2'><strong>Key Administrator</strong>: ".$_POST['KeyAdmin']."</td></tr>";
$msg .= "<tr><td colspan='2'><strong>Department</strong>: ".$_POST['Department']."</td></tr>";
$msg .= "<tr><td width='250'><strong>Meeting Name</strong>: ".$_POST['MeetingName']."</td></tr>";
$msg .= "<tr><td colspan='2'><strong>Schedule</strong>: ".$schedule."</td></tr>";

$msg .= "<tr><td colspan='2'><strong>Start Date</strong>: ".$_POST['StartDate']."</td></tr>";
$msg .= "<tr><td colspan='2'><strong>End Date</strong>: ".$_POST['EndDate']."</td></tr>";

$msg .= "</table>";
$msg .= "<p><strong>Attendees:</strong></p>";
$msg .= "<table style='border:1px solid #000;border-collapse:collapse;font-family:Verdana, Geneva, sans-serif;font-size:12px;' cellpadding='5'>";

$msg .= "<tr><td width='250' style='background-color:#e6e6e6;'>Name</td><td style='background-color:#e6e6e6;'>Department</td><td style='background-color:#e6e6e6;'>UMID</td></tr>";

//loop attendees
$count = $_POST['count'];
//echo "<td>$count</td>";
for ($i=1; $i <= $count; $i++) {
$attname = "attName".$i;	
$attdept = "attDept".$i;
$attid = "attID".$i;
	
	$msg .= "<tr style='height:25px;'><td>".$_POST[$attname]."</td><td>".$_POST[$attdept]."</td><td>".$_POST[$attid]."</td></tr>";
}

//end loop attendees


$msg .= "</table>";


$msg .= "</body></html>";


$msg= wordwrap($msg,900, "\n");


      if (mail("flemdoc-staff@umich.edu", $subject, $msg, $headers)) {//mailed
	  header('Location: meeting_thanks.html');
	  }
   
      else {
         echo "Form failed to submit - please contact afielek@umich.edu."; }

} 


?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Fleming Administration Building</title>
   <?php include "includes/styles.html"; ?>

<script src="/scripts/jquery.js"></script>
<script>
var i = 5;

function makerow() {

$("#attendees").append("<tr id='"+i+"'><td><INPUT TYPE='text' SIZE=25 MAXLENGTH=25 NAME='attName"+i+"'></td><td><INPUT TYPE='text' SIZE=15 MAXLENGTH=25 NAME='attDept"+i+"'></td><td><INPUT TYPE='text' SIZE=15 MAXLENGTH=25 NAME='attID"+i+"'></td></tr>");

$("#count").attr("value",i);

i++;
}

</script>

</head>
<body>
<div id="doc" class="yui-t2">
<div class="secondwrap">
   <?php include "includes/banner.html"; ?>
   <div id="bd" role="main">
	<div id="yui-main">
	<div class="yui-b">
    <div class="yui-g">
<h1>Building Meeting Request Form</h1>

<p>Key administrators may request after hour access for <strong>recurring</strong> meetings that will be considered by the Fleming Building Manager based upon meeting information.  Including but not limited to a Fleming Building staff member(s) is in attendance, attendees must be UM Faculty or staff.  Allow at least 3 business days for processing of door access.</p>

<p>Please fill in meeting and attendee information below.</p>

<!-- The following line is the FORM declaration.  In all cases, the 
     email address at the end (htmail-test-address@umich.edu) will be changed to 
     match the htmail enabled email address.  -->
<FORM METHOD=POST ACTION="<?php echo $_SERVER['PHP_SELF'] ?>">
<!-- flemdoc-staff -->



<!--<p>Key Administrator:
<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="KeyAdmin">-->

<p>
Department:
<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="Department">


<p>Meeting name:
<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="MeetingName">

<p>Meeting schedule (day, dates &amp; time):<p>
<TEXTAREA NAME="schedule" COLS=50 ROWS=5></TEXTAREA><P>


Start Date:
<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="StartDate">
<P>

End Date:
<INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="EndDate">
<P>




<!-- A textarea gives the user a box into which they can type text.
     textareas are useful for open-ended comments.  The COLS= and
     ROWS= options set the width and height of the textarea, but
     do not limit how much text the user can type.  If the textarea
     is named "body", it will be included as the bode of the message.  -->
Attendees:<P>
<table id="attendees">
<tr>
<th>Name (last, first)</th>
<th>UM Department</th>
<th>UM ID # (8-digit #)</th>
</tr>
<tr id="1">
<td><INPUT TYPE="text" SIZE=25 MAXLENGTH=25 NAME="attName1"></td>
<td><INPUT TYPE="text" SIZE=15 MAXLENGTH=25 NAME="attDept1"></td>
<td><INPUT TYPE="text" SIZE=15 MAXLENGTH=25 NAME="attID1"></td>
</tr>

<tr id="2">
<td><INPUT TYPE="text" SIZE=25 MAXLENGTH=25 NAME="attName2"></td>
<td><INPUT TYPE="text" SIZE=15 MAXLENGTH=25 NAME="attDept2"></td>
<td><INPUT TYPE="text" SIZE=15 MAXLENGTH=25 NAME="attID2"></td>
</tr>

<tr id="3">
<td><INPUT TYPE="text" SIZE=25 MAXLENGTH=25 NAME="attName3"></td>
<td><INPUT TYPE="text" SIZE=15 MAXLENGTH=25 NAME="attDept3"></td>
<td><INPUT TYPE="text" SIZE=15 MAXLENGTH=25 NAME="attID3"></td>
</tr>

<tr id="4">
<td><INPUT TYPE="text" SIZE=25 MAXLENGTH=25 NAME="attName4"></td>
<td><INPUT TYPE="text" SIZE=15 MAXLENGTH=25 NAME="attDept4"></td>
<td><INPUT TYPE="text" SIZE=15 MAXLENGTH=25 NAME="attID4"></td>
</tr>
</table>
<A href="javascript:void(0);" onclick="makerow();"><strong style="text-decoration:none;">[+] </strong>Add an Attendee</A>



<?php
	$text = $_SERVER['REMOTE_USER'];
	echo "<input name='from' type='hidden' value='".$text."@umich.edu' id='email' >";
?>




<p><input type=submit value="Submit Form"></p>



<input type="hidden" name="submitted" value="1">
<input type="hidden" name="count" value="4" id="count">

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
