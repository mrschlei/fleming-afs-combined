<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Fleming Administration Building</title>
   <link rel="stylesheet" href="/styles/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="/styles/fleming.css" type="text/css">
<?php include "rss_parser.php"; ?>


<?php 
		  $xml_filename = "http://mblog.lib.umich.edu/wellnesscommittee/index.xml";
		  if(!empty($_GET["guid"]))  {
			  $raw_guid = $_GET["guid"];
			  $isGuidSafe = true;
			  $isGuidSafe = check_guid_safe($raw_guid);

			 if($isGuidSafe) {
			  $item_id = $_GET["guid"];
			  
			  echo "<meta http-equiv=\"refresh\" content=\"6;url=http://fleming.bf.umich.edu/wellnesscommittee/item.php?guid=".$item_id."\" />";
			  
			  }//end if($isGuidSafe)
			 else {
				echo "Error";

			 }//end else($isGuidSafe)
		 }//end if(!empty($_GET["guid"]))
		 else {
		 	echo "Error";
		 }//end else
	  ?>



</head>
<body>
<div id="doc" class="yui-t2">
   <?php include "../includes/banner.html" ?>
   <div id="bd" role="main">
	<div id="yui-main">
	<div class="yui-b">
    <div class="yui-g">

<div class="breadcrumbs"><a href="http://fleming.bf.umich.edu">Home</a> &gt; <a href="http://fleming.bf.umich.edu/wellnesscommittee">Wellness Committee</a> &gt; <a href="http://fleming.bf.umich.edu/wellnesscommittee/blog.php">Blog</a> &gt; Thanks!</div>  
      
<h1>Thanks for That!</h1>

<p>All comments are moderated, so it may take a few hours for your comment to show up on that post's page. 

<p style="font-weight:bold;">You will be redirected to 

<?php 
		  $xml_filename = "http://mblog.lib.umich.edu/wellnesscommittee/index.xml";
		  if(!empty($_GET["guid"]))  {
			  $raw_guid = $_GET["guid"];
			  $isGuidSafe = true;
			  $isGuidSafe = check_guid_safe($raw_guid);

			 if($isGuidSafe) {
			  $item_id = $_GET["guid"];
			  //$title = get_item_title($xml_filename, $item_id);
			  
			  echo "<a href=\"http://fleming.bf.umich.edu/wellnesscommittee/item.php?guid=".$item_id."\">the post you came from</a>";
			  }//end if($isGuidSafe)
			 else {
				echo "Error";

			 }//end else($isGuidSafe)
		 }//end if(!empty($_GET["guid"]))
		 else {
		 	echo "Error";
		 }//end else
	  ?> shortly...

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