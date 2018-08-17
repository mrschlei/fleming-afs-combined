<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Fleming Administration Building</title>
   <?php include "../includes/styles.html"; ?>

<script type="text/javascript" src="/scripts/jquery.js"></script>



<style>

/**#formtable {border-top:1px solid #6699cc;}**/

#formtable td {padding:10px;border:none;}

.yui-g input {padding:3px;}

.info {width:150px;font-weight:bold;display:inline-block;padding-bottom:8px;}

</style>

</head>
<body>
<div id="doc" class="yui-t2">
<div class="secondwrap">
   <?php include "../includes/banner.html"; ?>
   <div id="bd" role="main">
	<div id="yui-main">
	<div class="yui-b">
    <div class="yui-g">

<div class="breadcrumbs"><a href="http://fleming.bf.umich.edu">Home</a> &gt; <a href="http://fleming.bf.umich.edu/wellnesscommittee">Wellness Committee</a> &gt; Nutrition Seminar</div>  
      
<h1>Nutrition Seminar</h1>


<p>
<span class="info">Date:</span> March 4th, 2015, 12:00-12:45
<br><span class="info">Location:</span> Fleming Building, Regent's Room
<?
include "../config.php";
$query = "SELECT * FROM `rsvp` WHERE `event` = 'Nutrition Seminar'";

$result = mysql_query($query);

$count = mysql_num_rows($result);

$count = (int)$count;

$left = 20 - $count;

//echo "<br /><span class='info'>Seat that still<br />need to be filled:</span> $left";


	//echo "<h2>Registration Closed</h2>";
	//echo "<p style='color:red;font-weight:bold;'>This event has reached it's registration limit and is currently closed.</p><p>Please email <a href='mailto:flemingwellnesschampions@umich.edu'>flemingwellnesschampions@umich.edu</a> if you have any questions or concerns.</p>";		
	


?>

<!--<br><span class="info">Speakers:</span> Lewis Morgenstern and Kati Bauer -->
</p>

<p><a href="http://fleming.bf.umich.edu/wellnesscommittee/documents/nutrition-seminar-032015.pdf" target="_blank"><img src="/images/pdficon.gif" alt="PDF" border="0" /></a> <a href="http://fleming.bf.umich.edu/wellnesscommittee/documents/nutrition-seminar-032015.pdf" target="_blank">More Information</a></p>

<p>
<h2>Your Information:</h2>



<form action='thanks.php' method='POST'> 

<table id="formtable">

<tr><td width="100">Name:</td><td><input type='text' name='name' size="45" value=""  /></td></tr>

<tr><td width="100">
Email Address:</span></td><td><input type='text' name='email' size="45" value="" /></td></tr>


<tr><td width="100">Department:</td><td><input type='text' name='department' size="45" value="" /></td></tr>


<tr><td>Phone Number:</td>
<td>
<input type='text' name='phone' size="45" value="" />
</td></tr>

<input type="hidden" name="uniqname" value="" />
<input type="hidden" name="event" value="Nutrition Seminar" />


<tr><td colspan="2"><br><center><input type='submit' value='Submit RSVP' style='padding:3px 40px 3px 40px;' /></center><input type='hidden' value='1' name='submitted' />
</form> </td></tr>
</table>


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