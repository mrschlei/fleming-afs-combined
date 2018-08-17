<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Fleming Administration Building</title>
   <link rel="stylesheet" href="/styles/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="/styles/fleming.css" type="text/css">

</head>
<body>
<div id="doc" class="yui-t2">
   <?php include "../includes/banner.html" ?>
   <div id="bd" role="main">
	<div id="yui-main">
	<div class="yui-b">
    <div class="yui-g">

<div class="breadcrumbs"><a href="http://fleming.bf.umich.edu">Home</a> &gt; <a href="http://fleming.bf.umich.edu/wellnesscommittee">Wellness Committee</a> &gt; <a href="https://fleming.bf.umich.edu/wellnesscommittee/potluck">Potluck RSVP form</a> &gt; Dishes</div>  
      
<h1>Potluck Dishes</h1>

<?

include "config.php";

	$result = mysql_query("SELECT * FROM `potluck`");

echo "<table width='350'><tr><th>Dish</th></tr>";

while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 

echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['dish']) . "</td>";  
//echo "<td valign='top'>" . nl2br( $row['email']) . "</td>";  
//echo "<td valign='top'>" . nl2br( $row['department']) . "</td>";  
//echo "<td valign='top'>" . nl2br( $row['dish']) . "</td>";  
echo "</tr>"; 

}
mysql_free_result($result);

echo "</table>";

?>


<?php //phpinfo(); ?>

</div>
</div>
	</div>
	<?php include "../includes/flemingleft.html" ?>
	
	</div>
<?php include "../includes/footer.html" ?>
</div>
<p>&nbsp;</p>
</body>
</html>      



