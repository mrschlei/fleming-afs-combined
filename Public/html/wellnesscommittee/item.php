<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Fleming Administration Building</title>
   <link rel="stylesheet" href="/styles/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="/styles/fleming.css" type="text/css">
   
<link type="text/css" media="screen" rel="stylesheet" href="http://fleming.bf.umich.edu/scripts/colorbox/example1/colorbox.css" />

<script type="text/javascript" src="http://fleming.bf.umich.edu/scripts/jquery.js"></script>
<script type="text/javascript" src="http://fleming.bf.umich.edu/scripts/colorbox/colorbox/jquery.colorbox.js"></script>
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
<div class="breadcrumbs"><a href="/">Home</a> &gt; <a href="/wellnesscommittee">Wellness Committee</a> &gt; <a href="blog.php">Blog</a> &gt; <?php
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
				echo "Error - no post with that GUID <br />";
				echo "<a href='javascript:history.back();'>Go Back</a>";

			 }//end else($isGuidSafe)
		 }//end if(!empty($_GET["guid"]))
		 else {
		 	echo "<li>Error - no post with that GUID <br />";
			echo "<a href='javascript:history.back();'>Go Back</a></li>";
		 }//end else
	  ?>

<br><br>

<h2><img src='/images/bubble.gif' alt='comment' /><a name='comments'></a>Comments:</h2>


<?php 

echo "<h3 style='padding-top:0;margin-top:5px;margin-bottom:10px;'><a href='https://fleming.bf.umich.edu/wellnesscommittee/comment.php?guid=".$item_id."'>Comment on this post</a>&nbsp;<span style=\"font-weight:normal;font-size:12px;color:#000;\">(authentication required)</span></h3>";

?> 


<?php
/* 
 ======================================================================
 lastRSS usage DEMO 3 - Simple RSS agregator
 ----------------------------------------------------------------------
 This example shows, how to create simple RSS agregator
     - create lastRSS object
    - set transparent cache
    - show a few RSS files at once
 ======================================================================
*/

function ShowOneRSS($url) {
    global $rss;
	$count = 0;



if(!empty($_GET["guid"]))  {
			  $raw_guid = $_GET["guid"];
			  $isGuidSafe = true;
			  $isGuidSafe = check_guid_safe($raw_guid);

			 if($isGuidSafe) {
			  $item_id = $_GET["guid"];
			  }//end if($isGuidSafe)
			 else {
				echo "Error - no post with that GUID <br />";
				echo "<a href='javascript:history.back();'>Go Back</a>";

			 }//end else($isGuidSafe)
		 }//end if(!empty($_GET["guid"]))
		 else {
		 	echo "<li>Error - no post with that GUID <br />";
			echo "<a href='javascript:history.back();'>Go Back</a></li>";
		 }//end else




    if ($rs = $rss->get($url)) {
	
            foreach ($rs['items'] as $item) {


			$pubdate = "$item[pubDate]";
			$pubdate = format_pubdate($pubdate);


			if ($item[guid] == $item_id) {$count++;}
			else {}

			
			if ($item[guid] == $item_id && $count > 0) {
			echo "<div class=\"comments\">$item[description]<br><br><div id='postdate' align='right'>".$pubdate."</div></div>";
            }

			
			else {}

    		}//end foreach
	
            if ($count <= 0) { echo "<div style='font-size:10px;'>There are no comments for this post yet. All comments are moderated, so if you've submitted a comment recently, it may be a few hours before it appears in this space.</div>"; }
			else {}	
	
	}
	
	
	
    else {
        echo "Sorry: It's not possible to reach RSS file $url\n<br />";
        // you will probably hide this message in a live version
    }
}

// ===============================================================================

// include lastRSS
include "lastRSS.php";

// List of RSS URLs
$rss_left = array(
    'http://mblog.lib.umich.edu/wellnesscommittee/comments.xml'
);


// Create lastRSS object
$rss = new lastRSS;

// Set cache dir and cache time limit (5 seconds)
// (don't forget to chmod cahce dir to 777 to allow writing)
$rss->cache_dir = './temp';
$rss->cache_time = 1200;


// Show all rss files
//echo "<table cellpadding=\"10\" border=\"0\"><tr><td width=\"50%\" valign=\"top\">";
foreach ($rss_left as $url) {
    ShowOneRSS($url);
}
//echo "</td></tr></table>";
?> 



</div>
</div>
	</div>
	<?php include "../includes/flemingleft.html" ?>
	
	</div>
<?php include "../includes/blogfooter.html" ?>
</div>
<p>&nbsp;</p>
</body>
</html>


