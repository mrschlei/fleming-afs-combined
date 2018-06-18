<?php include "../config.php";

if (isset($_POST['submitted'])) { 
//make_current
if (isset($_POST['make_current']) && $_POST['make_current'] == "Yes") {$current = "Yes";}
else {$current = "No";}

//If it's a new entry, we're marking it as current by default
	if ($_POST['submitted'] == "1") {
	
	foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
		$sql = "INSERT INTO `frontpage_announcements` ( `title`, `body`, `submitted_by`, `expires`, `current`, `order`) VALUES( '{$_POST['title']}', '{$_POST['body']}', '{$_POST['submitted_by']}', '{$_POST['expires']}', 'Yes', '{$_POST['order']}' ) "; 
  
		mysql_query($sql) or die(mysql_error()); 
		header('Location: index.php');
	}


	elseif ($_POST['submitted'] == "2") {	
		foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 

		$sql = "UPDATE `frontpage_announcements` SET `title`='{$_POST['title']}', `body`='{$_POST['body']}', `current`='$current', `order`='{$_POST['order']}' WHERE `key` = '{$_POST['key']}'"; 
  
		mysql_query($sql) or die(mysql_error()); 		
		header('Location: index.php');
	}
} 



?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Fleming Administration Building</title>
   <?php include "../includes/styles.html"; ?>
   
<script type="text/javascript" src="/scripts/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">
tinyMCE.init({
        mode : "textareas",
		theme : "advanced"
});
</script>   
   
   
<script type="text/javascript">
function disp_confirm(key)
{

//alert(key);

var msg = "Are you sure you want to remove this announcement?";

var r=confirm(msg)
if (r==true)
  {
	var loc = "index.php?key="+key+"&page=delete";
	window.location = loc;
  }
else
  {
  	alert("Nothing deleted.")
  }
}
</script>   
   <style>
   #formtable td {padding:15px 5px 15px 5px;}
   #body_tbl td {padding:3px;}
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

<div class="breadcrumbs"><a href="http://fleming.bf.umich.edu">Home</a> &gt; <a href="index.php">Front Page Announcements</a>
<? if (isset($_GET["page"])) {echo " &gt; ".$_GET["page"];} ?>
</div>  
      
<h1>Front Page Announcements</h1>


<p style="background:url('/images/plus_icon.png');background-position:left center;background-repeat:no-repeat;"><a href="?page=new" style="margin:10px 10px 10px 20px;">Add an announcement</a></p>

<p style="background:url('/images/archive-icon.png');background-position:left center;background-repeat:no-repeat;"><a href="?page=archive" style="margin:10px 10px 10px 20px;">Announcements archive</a></p>


<? if (htmlspecialchars($_GET["page"]) == "new"): ?>

<form action='' method='POST'> 

<table id="formtable">

<tr><td width="100">Title (optional):</td><td><input type='text' name='title' size="45" /></td></tr>

<tr><td width="100">
Body:</span></td><td><textarea style="width:500px;height:300px;;" name="body"></textarea><p><strong>Note:</strong> to add a new line within a list item, like the list below, use <strong>Shift+Enter</strong>, instead of just Enter: <br /><ul><li>Test item<br />More info<br />Last bit of info</li></ul></p>

<p><strong>Note 2:</strong> images need a full URL ("http://www.umich.edu/~websvcs/projects/vpgc/web/buidingpics_maps/building_fleming.jpg" instead of "building_fleming.jpg") AND those URLs need to start with http://, not http<strong>S</strong>://</p></td></tr>


<tr><td width="100">Order:</td><td><input type='text' name='order' size="45" value="" /></td></tr>

<input type="hidden" name="submitted_by" value="<? echo $_SERVER['REMOTE_USER']; ?>" />


<tr><td colspan="2"><center><input type='submit' value='Submit Front Page Announcement' style='padding:3px 40px 3px 40px;' /></center><input type='hidden' value='1' name='submitted' />
</form> </td></tr>
</table>


<? elseif (htmlspecialchars($_GET["page"]) == "delete"): ?>
<? 
$key = htmlspecialchars($_GET["key"]);
$query = "UPDATE `frontpage_announcements` SET `current`='No' WHERE `current` = 'Yes' AND `key` = '$key'"; 
$result = mysql_query($query);
header('Location: index.php');
?>


<? elseif (htmlspecialchars($_GET["page"]) == "edit"): ?>
<? 
$keyprim = htmlspecialchars($_GET["key"]);

$query = "SELECT * FROM `frontpage_announcements` WHERE `key` = '$keyprim'";

$result = mysql_query($query);
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 

$title = $row['title'];  
$current = $row['current']; 
$body = $row['body'];  

}
mysql_free_result($result);
?>
<form action='' method='POST'> 

<table id="formtable">

<tr><td width="100">Title (optional):</td><td><input type='text' name='title' size="45" value="<? echo $title; ?>"  /></td></tr>

<tr><td width="100">
Body:</span></td><td><textarea style="width:500px;height:300px;;" name="body"><? echo $body; ?></textarea><p><strong>Note:</strong> to add a new line within a list item, like the list below, use <strong>Shift+Enter</strong>, not just Enter: <br /><ul><li>Test item<br />More info<br />Last bit of info</li></ul></p></td></tr>

<tr><td colspan="2"><input type="checkbox" name="make_current" value="Yes" <? if ($current == "Yes") {echo "checked=checked";} ?> /> Add to front page?</td></tr>
<tr><td width="100">Order:</td><td><input type='text' name='order' size="10" value="" /></td></tr>
<input type="hidden" name="submitted_by" value="<? echo $_SERVER['REMOTE_USER']; ?>" />

<input type="hidden" name="key" value="<? echo $keyprim; ?>" />

<tr><td colspan="2"><br><center><input type='submit' value='Edit Announcement' style='padding:3px 40px 3px 40px;' /></center><input type='hidden' value='2' name='submitted' />
</form> </td></tr>
</table>

<!---------------------end editing markup------------------------>





<? elseif (htmlspecialchars($_GET["page"]) == "archive"): ?>
<h2>Archive:</h2>
<table>
<tr>
<th>Title</th>
<th>Body</th>
<th>&nbsp;</th>
</tr>
<? 

$query = "SELECT * FROM `frontpage_announcements` WHERE `current` != 'Yes'";

$result = mysql_query($query);
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 

echo "<tr><td>".$row['title']."</td>";  

echo "<td>".$row['body']."</td>"; 

echo "<td valign='top'><a href='?page=edit&key=".$row['key']."'><img src='/images/edit.png' alt='edit this announcement' border='0' /></a><a href='javascript:void(0);' onclick=\"disp_confirm('".$row['key']."')\"></td>";  

}
mysql_free_result($result);
?>
</table>


<!---------------------end archive markup------------------------>


<?php else: ?>
<h2>Announcements on the Front Page Right Now:</h2>
<table>
<tr>

<?
$query = "SELECT * FROM `frontpage_announcements` WHERE `current` = 'Yes' ORDER BY `order`";

$result = mysql_query($query);

$count = mysql_num_rows($result);

echo $count." items:<table><tr><!--<th>key</th>--><th>title</th><th>body</th><th>created</th><th>order</th><th>&nbsp;</th></tr>";

while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 

echo "<tr>";  
//echo "<td valign='top'>" . nl2br( $row['key']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['title']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['body']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['timestamp']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['order']) . "</td>"; 
echo "<td valign='top'><a href='?page=edit&key=".$row['key']."'><img src='/images/edit.png' alt='edit this announcement' border='0' /></a><a href='javascript:void(0);' onclick=\"disp_confirm('".$row['key']."')\"><br /><img src='/images/delete.png' alt='remove this announcement' border='0' /></a></td>";  
echo "</tr>"; 

}
mysql_free_result($result);
?>


</tr>
</table>

<?php endif; ?>

</div>
</div>
	</div>
    <?php include '../includes/flemingleft.html'; ?>
	
	
	</div>
    
<?php include '../includes/footer.html'; ?>    

</div>
</div>
</body>
</html>