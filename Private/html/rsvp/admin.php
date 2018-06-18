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
      
<h1>Fitness Seminar - April 2015</h1>

<?

include "../config.php";


$query = "SELECT * FROM `rsvp` WHERE `event` = 'Fitness Seminar' ORDER BY 'key'";

$result = mysql_query($query);

$count = mysql_num_rows($result);

echo $count." items:<table><tr><th>Name</th><th>email</th><th>department</th><th>phone</th><th>&nbsp;</th></tr>";

while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 

echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['0']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['email']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['department']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['phone']) . "</td>"; 
echo "<td valign='top'><a href='javascript:void(0);' onclick=\"disp_confirm('".$row['key']."')\"><img src='/images/delete.png' alt='delete this registration' border='0' /></a></td>";  
echo "</tr>"; 

}
mysql_free_result($result);

echo "</table>";

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



