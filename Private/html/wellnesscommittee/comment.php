<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Fleming Administration Building</title>
   <link rel="stylesheet" href="/styles/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="/styles/fleming.css" type="text/css">
   
<link type="text/css" media="screen" rel="stylesheet" href="https://fleming.bf.umich.edu/scripts/colorbox/example1/colorbox.css" />

<script type="text/javascript" src="https://fleming.bf.umich.edu/scripts/jquery.js"></script>
<script type="text/javascript" src="https://fleming.bf.umich.edu/scripts/colorbox/colorbox/jquery.colorbox.js"></script>
<script type="text/javascript">
			$(document).ready(function(){
				//Examples of how to assign the ColorBox event to elements
				$(".cardiovid").colorbox({width:"730px", inline:true, href:"#cardiovid"});
				
			});	
</script>

</head>
<body>
<div id="doc" class="yui-t2">
   <?php include "../includes/banner.html" ?>
   <div id="bd" role="main">
	<div id="yui-main">
	<div class="yui-b">
    <div class="yui-g">
<?php include "rss_parser.php"; ?>
<div class="breadcrumbs"><a href="http://fleming.bf.umich.edu">Home</a> &gt; <a href="http://fleming.bf.umich.edu/wellnesscommittee">Wellness Committee</a> &gt; <a href="http://fleming.bf.umich.edu/wellnesscommittee/blog.php">Blog</a> &gt; <?php
		  $xml_filename = "http://mblog.lib.umich.edu/wellnesscommittee/index.xml";
		  if(!empty($_GET["guid"]))  {
			  $raw_guid = $_GET["guid"];
			  $isGuidSafe = true;
			  $isGuidSafe = check_guid_safe($raw_guid);

			 if($isGuidSafe) {
			  $item_id = $_GET["guid"];
			  get_item_title($xml_filename, $item_id);
			  }//end if($isGuidSafe)
			 else {
				echo "Error";

			 }//end else($isGuidSafe)
		 }//end if(!empty($_GET["guid"]))
		 else {
		 	echo "Error";
		 }//end else
	  ?></div>    



     	  <?php
		  $xml_filename = "http://mblog.lib.umich.edu/wellnesscommittee/index.xml";
		  if(!empty($_GET["guid"]))  {
			  $raw_guid = $_GET["guid"];
			  $isGuidSafe = true;
			  $isGuidSafe = check_guid_safe($raw_guid);

			 if($isGuidSafe) {
			  $item_id = $_GET["guid"];
			  get_item($xml_filename, $item_id);
			  }//end if($isGuidSafe)
			 else {
				echo "Announcement not found <br />";
				echo "<a href='javascript:history.back();'>Go Back</a>";

			 }//end else($isGuidSafe)
		 }//end if(!empty($_GET["guid"]))
		 else {
		 	echo "<li>Announcement not found <br />";
			echo "<a href='javascript:history.back();'>Go Back</a></li>";
		 }//end else
	  ?>

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
