<?

if (isset($_POST['submitted'])) { 

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\n";
$headers .= 'Content-type: text/html; charset=\"iso-8859-1\"' . "\n";

// Additional headers
$headers .= 'From: '.$_POST['email']. "\n";
$headers .= 'Cc: '.$_POST['email']. "\n";
$headers .= 'Bcc: mrschlei@umich.edu' . "\n";

//Subject
$subject = "Wellness Room Request for Access and Release of Liability Form";


$msg = "<html><body style='font-family:Verdana, Geneva, sans-serif;font-size:12px;'>";

$msg .= "<p>I, <strong>".$_POST['name']."</strong>, request access to the University of Michigan Fleming Administrative Building Wellness Room (“Wellness Room”) for the purpose of voluntarily utilizing its exercise and fitness equipment and facilities.</p>";

$msg .= "<p>I understand there are risks associated with physically strenuous activities and use of exercise equipment and that it is my responsibility to evaluate these risks and consult with my health care provider for guidance prior to undertaking any exercise routine or regimen or utilizing the Wellness Room.  I hereby release and hold harmless the Regents of the University of Michigan, its employees and agents from all claims and liabilities for injury, damage or loss arising from my use of the Wellness Room and its equipment and facilities.  I acknowledge that security and assistance is not present 24 hours a day, 7 days a week.</p>";

$msg .= "<p>I understand the use of the Wellness Room and the equipment and facilities is not a work related activity and my use of the facility and equipment is on my own personal time.<br />";

$msg .= "Initial: <strong>".$_POST['personalTimeInitial']."</strong></p>";

$msg .= "<p>I have been given a copy of the Fleming Building Wellness Room Rules and Guidelines.  I understand the rules and guidelines and understand to whom I should direct questions.  <br />";

$msg .= "Initial: <strong>".$_POST['guidelineInitial']."</strong></p>";

$msg .= "<p>I have viewed the mandatory Wellness Room Orientation Program, and I agree to follow all Wellness Room rules, guidelines, instructions and safety precautions.  Should I notice damaged or defective equipment, I will immediately tag the equipment with an “Out of Order” sign (located by the telephone) and immediately notify the Building Manager.  I understand that failure to abide by the Wellness Room rules, guidelines, instructions and safety precautions may result in injury to me or others and/or a loss of privileges to use the Wellness Room.</p>";

$msg .= "<p>UMID: ".$_POST['umid']."</p>";

$msg .= "<p>Date: ".$_POST['date']."</p>";

$msg .= "<p>Name: ".$_POST['name2']."</p>";

$msg .= "<p>Department: ".$_POST['department']."</p>";

$msg .= "</body></html>";


$msg= wordwrap($msg,900, "\n");
//avpfo-office@umich.edu
      if (mail("avpfo-office@umich.edu", $subject, $msg, $headers))
  {
	  header('Location: wellnessroomthanks.html');
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
    <div class="breadcrumbs"><a href="http://fleming.bf.umich.edu">Home</a> &gt; <a href="http://fleming.bf.umich.edu/video.html">Wellness Room</a> &gt; Request for Access and Release of Liability</div>
<h1>Wellness Room Request for Access and Release of Liability</h1>


<!-- The following line is the FORM declaration.  In all cases, the 
     email address at the end (htmail-test-address@umich.edu) will be changed to 
     match the htmail enabled email address.  -->
<FORM METHOD=POST ACTION="<?php echo $_SERVER['PHP_SELF'] ?>">
<!-- flemdoc-staff -->
<p>I, <INPUT TYPE="text" SIZE=20 NAME="name">, request access to the University of Michigan Fleming Administrative Building Wellness Room (“Wellness Room”) for the purpose of voluntarily utilizing its exercise and fitness equipment and facilities.</p>

<p>I understand there are risks associated with physically strenuous activities and use of exercise equipment and that it is my responsibility to evaluate these risks and consult with my health care provider for guidance prior to undertaking any exercise routine or regimen or utilizing the Wellness Room.  I hereby release and hold harmless the Regents of the University of Michigan, its employees and agents from all claims and liabilities for injury, damage or loss arising from my use of the Wellness Room and its equipment and facilities.  I acknowledge that security and assistance is not present 24 hours a day, 7 days a week.</p>

<p>I understand the use of the Wellness Room and the equipment and facilities is not a work related activity and my use of the facility and equipment is on my own personal time. <br>
<strong>Initial:</strong> <INPUT TYPE="text" SIZE=8 MAXLENGTH=25 NAME="personalTimeInitial"></p>

<p>I have been given a copy of the Fleming Building Wellness Room Rules and Guidelines.  I understand the rules and guidelines and understand to whom I should direct questions.  <br>
<strong>Initial:</strong> <INPUT TYPE="text" SIZE=8 MAXLENGTH=25 NAME="guidelineInitial"></p>

<p>I have viewed the mandatory Wellness Room Orientation Program, and I agree to follow all Wellness Room rules, guidelines, instructions and safety precautions.  Should I notice damaged or defective equipment, I will immediately tag the equipment with an “Out of Order” sign (located by the telephone) and immediately notify the Building Manager.  I understand that failure to abide by the Wellness Room rules, guidelines, instructions and safety precautions may result in injury to me or others and/or a loss of privileges to use the Wellness Room.</p>

<p><strong>UMID:</strong> <INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="umid"> <br />(used for card reader access)</p>

<div class="righter"><strong>Date:</strong> <INPUT TYPE="text" SIZE=20 MAXLENGTH=25 NAME="date" value="<? echo date("n/j/Y"); ?>"></div>
<p><strong>Name:</strong> <INPUT TYPE="text" SIZE=20 NAME="name2"></p>

<p><strong>Department:</strong> <INPUT TYPE="text" SIZE=25 NAME="department"></p>
<?php
	$text = $_SERVER['REMOTE_USER'];
	echo "<input name='email' type='hidden' value='".$text."@umich.edu' id='email' >";
?>




<p><input type=submit value="Submit Form" class="button"></p>

<p style="color:red;">Please allow 48 hours for processing of door access. Confirmation of access to the Wellness room will be verified with returned copy of electronically signed Request for access &amp; Release of Liability form and guidelines. </p>

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
