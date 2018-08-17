<?php include "../config.php";


//make sure they aren't aleady registered
//$user = $_SERVER['REMOTE_USER'];
//$query = "SELECT * FROM `rsvp` WHERE `event` = 'Aug 21 Healthy Cooking' AND `uniqname` = '$user'";

//$result = mysql_query($query);

//$count = mysql_num_rows($result);
$count = 0;
if ($count == 0) {

if (isset($_POST['submitted'])) { 

foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 

$sql = "INSERT INTO `rsvp` ( `name`, `email`, `department`, `phone`, `uniqname`, `event` ) VALUES( '{$_POST['name']}', '{$_POST['email']}', '{$_POST['department']}', '{$_POST['phone']}', '{$_POST['uniqname']}', '{$_POST['event']}' ) "; 
  
mysql_query($sql) or die(mysql_error()); 

} 
}
$message = implode(", ",$_POST);
$headers = 'From: Fleming Website Registration <mrschlei@umich.edu>' . "\r\n" .
mail("mrschlei@umich.edu",'Fleming Website Registration',$message);
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Fleming Administration Building</title>
   <?php include "../includes/styles.html"; ?>

</head>
<body>
<div id="doc" class="yui-t2">
<div class="secondwrap">
   <?php include "../includes/banner.html"; ?>
   <div id="bd" role="main">
	<div id="yui-main">
	<div class="yui-b">
    <div class="yui-g">

<div class="breadcrumbs"><a href="http://fleming.bf.umich.edu">Home</a> &gt; <a href="http://fleming.bf.umich.edu/wellnesscommittee">Wellness Committee</a> &gt; <a href="http://fleming.bf.umich.edu/wellnesscommittee/events.php">Events</a> &gt; Thanks</div>  

<?php

//$query = "SELECT * FROM `rsvp` WHERE `event` = 'Aug 21 Healthy Cooking'";

//$result = mysql_query($query);

//$count = mysql_num_rows($result);

//$count = (int)$count;

//if ($count > 115) {
	//echo "<h1>This Event is Currently Waitlisted</h1>";
	//echo "<p style='color:red;font-weight:bold;'>This event has reached it's registration limit and is currently waitlisted.  You have been added to the waitlist and will be contacted shortly before the event.</p><p>Please email <a href='mailto:flemingwellnesschampions@umich.edu'>flemingwellnesschampions@umich.edu</a> if you have any questions or concerns.</p>";	
//}

//else {
	//echo "<h1>Your RSVP was Successful!</h1>";
	//echo "<p>We look forward to seeing you at this event!</p>";	
//}

?>
<h1>Your RSVP was Successful!</h1>
<p>We look forward to seeing you at this event!</p>
</div>
</div>
	</div>
	<?php include "../includes/flemingleft.html" ?>
	
	</div>
<?php include "../includes/footer.html" ?>
</div>
</div>
</body>
</html>      



