<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Fleming Administration Building</title>
   <link rel="stylesheet" href="/styles/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="/styles/fleming.css" type="text/css">
   

<link type="text/css" media="screen" rel="stylesheet" href="http://fleming.bf.umich.edu/scripts/colorbox/example1/colorbox.css" />

<!-- Blog has been depricated -->
<meta http-equiv="refresh" content="0;url=http://fleming.bf.umich.edu/wellnesscommittee/" />
<!--  -->

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

<div class="breadcrumbs"><a href="/">Home</a> &gt; <a href="/wellnesscommittee">Wellness Committee</a> &gt; Blog</div>    
    
<h1>Fleming Wellness Committee Blog</h1>

<?php include "../includes/blogrightnav.html"; ?>

<?php include "rss_parser.php"; ?>
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
    if ($rs = $rss->get($url)) {
        //echo "<big><b><a href=\"$rs[link]\">$rs[title]</a></b></big><br />\n";
        //echo "$rs[description]<br />\n";

            //echo "<ul>\n";
            foreach ($rs['items'] as $item) {
			
			$category = "$item[category]";
			$comcount = "$item[source]";
			$guid = "$item[guid]";
			$pubdate = "$item[pubDate]";
			$pubdate = format_pubdate($pubdate);
			
			if ($category == "Food/Recipes") {$cattext = "<a href='tasty.php'>Food/Recipes</a>";}
			
			elseif ($category == "Exercise") {$cattext = "<a href='exercise.php'>Exercise</a>";}
			
			else {$cattext = "None";}
			

			if ($comcount > 0) {
                echo "\t<h2><a href=\"item.php?guid=$item[guid]\">$item[title]</a></h2><p>$item[description]<span id='postdate'><!--Posted by <a href=\"http://directory.umich.edu/ldapweb-bin/url?ldap:///uid=$item[author],ou=People,dc=umich,dc=edu\">$item[author]</a><br>-->".$pubdate."<br>Category: ". $cattext ."<p><a href=\"http://fleming.bf.umich.edu/wellnesscommittee/item.php?guid=".$guid."#comments\">Comments (".$comcount.")</a></span><hr>";}
			
			else {
                echo "\t<h2><a href=\"item.php?guid=$item[guid]\">$item[title]</a></h2><p>$item[description]<span id='postdate'><!--Posted by <a href=\"http://directory.umich.edu/ldapweb-bin/url?ldap:///uid=$item[author],ou=People,dc=umich,dc=edu\">$item[author]</a><br>-->".$pubdate."<br>Category: ". $cattext ."<p>No comments for this post.<br><a href=\"https://fleming.bf.umich.edu/wellnesscommittee/comment.php?guid=".$guid."\">Click here to leave a comment</a> (authentication required)</span><hr>";}			
            
			
			
			
			}
            if ($rs['items_count'] <= 0) { echo "<li>Sorry, no items found.</li>"; }
            echo "</ul>";
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
    'http://mblog.lib.umich.edu/wellnesscommittee/index.xml'
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
