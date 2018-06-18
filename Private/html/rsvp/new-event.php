<?
if (isset($_POST['submitted'])) { 


} 
?>
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

<div class="breadcrumbs"><a href="http://fleming.bf.umich.edu">Home</a> &gt; <a href="admin.php">Administrivia</a> &gt; New Event</div>  
      
<h1>New Event</h1>



<FORM METHOD=POST ACTION="<?php echo $_SERVER['PHP_SELF'] ?>">

<table id="formtable">

<tr><td width="100">Title:</td><td><input type='text' name='title' size="45" value="" /></td></tr>

<tr><td width="100">
Date:</span></td><td><input type='text' name='date' size="45" value="" /></td></tr>


<tr><td width="100">Location:</td><td><input type='text' name='location' size="45" value="" /></td></tr>


<tr><td>PDF location (full URL):</td>
<td>
<input type='text' name='pdf' size="45" value="" />
</td></tr>

<input type="hidden" name="uniqname" value="<? echo $attrs['uid'][0]; ?>" />


<tr><td colspan="2"><br><center><input type='submit' value='Create Event' style='padding:3px 40px 3px 40px;' /></center><input type='hidden' value='1' name='submitted' />
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