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

.info {width:80px;font-weight:bold;display:inline-block;}

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

<div class="breadcrumbs"><a href="http://fleming.bf.umich.edu">Home</a> &gt; <a href="http://fleming.bf.umich.edu/wellnesscommittee">Wellness Committee</a> &gt; Fleming Nutrition Cooking Demo</div>  
      
<h1>Fleming Nutrition Cooking Demo</h1>


<p>
<span class="info">Date:</span> February 24 from 12-1pm 
<br><span class="info">Location:</span> 5075 FAB Conf Rm.  
<!--<br><span class="info">Speakers:</span> Lewis Morgenstern and Kati Bauer -->
</p>

<p><a href="http://fleming.bf.umich.edu/documents/HealthyCookingDemo.0212.pdf" target="_blank"><img src="/images/pdficon.gif" alt="PDF" border="0" /></a> <a href="http://fleming.bf.umich.edu/documents/HealthyCookingDemo.0212.pdf" target="_blank">More Information</a></p>  

<p>
<h2>Your Information:</h2>

<?php include "../ldap.php"; ?>

<form action='thanks.php' method='POST'> 

<table id="formtable">

<tr><td width="100">First Name:</td><td><input type='text' name='name' size="45" value="<? echo $name; ?>"  /></td></tr>

<tr><td width="100">
Email Address:</span></td><td><input type='text' name='email' size="45" value="<? echo $attrs['mail'][0]; ?>" /></td></tr>


<tr><td width="100">Department:</td><td><input type='text' name='department' size="45" value="" /></td></tr>


<tr><td>Phone Number:</td>
<td>
<input type='text' name='phone' size="45" value="<? echo $attrs['telephoneNumber'][0]; ?>" />
</td></tr>

<input type="hidden" name="uniqname" value="<? echo $attrs['uid'][0]; ?>" />
<input type="hidden" name="event" value="Feb 24 Fitness Consult" />


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