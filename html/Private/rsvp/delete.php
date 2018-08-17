<?
header( "refresh:3;url=admin.php" ); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Fleming Administration Building</title>
   <?php include "../includes/styles.html"; ?>

<script type="text/javascript">
function disp_confirm(key)
{

//alert(key);

var msg = "Are you sure you want to delete this registration?";

var r=confirm(msg)
if (r==true)
  {
	var loc = "delete.php?key="+key;
	window.location = loc;
  }
else
  {
  	alert("Nothing deleted.")
  }
}
</script>

</head>
<body>
<div id="doc" class="yui-t2">
<div class="secondwrap">
   <?php include "../includes/banner.html"; ?>
   <div id="bd" role="main">
	<div id="yui-main">
	<div class="yui-b">
    <div class="yui-g">

<div class="breadcrumbs"><a href="http://fleming.bf.umich.edu">Home</a> &gt; <a href="http://fleming.bf.umich.edu/wellnesscommittee">Wellness Committee</a> &gt; Admin</div>  
      
<h1>Fleming RSVP - Delete</h1>

<?

$key = htmlspecialchars($_GET["key"]);
mysql_real_escape_string($key);

include("../config.php");

$query = "DELETE FROM `rsvp` WHERE `key` = '$key'";

$result = mysql_query($query);

if (!$result) {
    die('Invalid query: ' . mysql_error() );
}

else {
	echo "<p style='font-weight:bold;'>Row deleted.</p><p>Redirecting to administration pages now....</p>";	
}

//$count = mysql_num_rows($result);

?>


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