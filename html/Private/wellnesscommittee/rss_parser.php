<?
define ("FIRSTITEMCHOICE", 25);
define ("SECONDITEMCHOICE", 50);
define ("THIRDITEMCHOICE", 100);
define ("RSSUNAVAILABLEERROR", "Content not available. Please try back shortly.If you have an immediate need, please contact the <a href='http://www.mais.umich.edu/help/index.html'>MAIS Help Desk</a>");
define ("SINGLEDETAILERROR", "This announcement may have been moved or deleted. You can try <a href='http://www.mais.umich.edu/project_infocenter/search_page.html'>searching</a> for it, or going to the <a href='all_announcements.php'>All Announcements</a> page.");
define ("PAGEBOUNDERROR", " You can try <a href='http://www.mais.umich.edu/main/search.html'>searching</a> for it, or going to the <a href='announcements_all.php'>All Announcements</a> page.");
define ("ITEMERROR", " items is not an allowed choice. Resetting to 5 items per page.");
define ("ITEMSVERBIAGE1","View&nbsp;");
define ("ITEMSVERBIAGE2","&nbsp;Items");

/**
* transforms XML using XSL and prints result to screen
*
* Uses XSLTProcessor to transform $xml_param using $xsl_param. Prints result
* to screen.
*
* @param string $xsl_param
* @param string $xml_param
*/
function get_feed($xsl_param, $xml_param) {
	$doc = new DOMDocument();
	$xsl = new XSLTProcessor();

	$doc->load($xsl_param);
	$xsl->importStyleSheet($doc);
	$xsl->registerPHPFunctions();//needed because PHPFunctions are used in the XSL
	try {
		if($doc->load($xml_param)==FALSE) {
			throw new Exception(RSSUNAVAILABLEERROR);
		} //end if($doc->load($xml_param)==FALSE)
		else{
			$doc->load($xml_param);
			echo $xsl->transformToXML($doc);
		}//end else if($doc->load($xml_param)==FALSE)
	}//end try
	catch (Exception $e) {
		echo $e->getMessage();
	}//end catch
}//end get_feed()

/**
* prints HTML representing a single <item> from the RSS feed
*
* Uses SimpleXml and XPath to transform a single <item> from the RSS feed into
* HTML.Prints result to screen.
*
* @param string $xml_param
* @param string $item_param
*/
function get_item($xml_param, $item_param) {
		
		$username = $_SERVER['REMOTE_USER'];
		$doc = new SimpleXmlElement($xml_param, NULL, TRUE);
		$path = "//item[guid='$item_param']";

		try{
			$item = $doc->xpath($path);

			if(count($item)==0) {
				throw new Exception(SINGLEDETAILERROR);
			}//end if(is_object($item))

			else {
			echo "<h1>" . $item[0]->title . "</h1>";

			/* @see function format_pubdate() */
			$unformatted_pubdate = $item[0]->pubDate;
			$formatted_pubdate = format_pubdate($unformatted_pubdate);
			
			echo "<p>";
			//echo $item[0]->description;
			
			$desc1 = $item[0]->description;
			echo preg_replace("/http\:\/\/fleming\.bf\.umich\.edu\/images\//","https://fleming.bf.umich.edu/images/", $desc1);
			
			$title = $item[0]->title;
			$author = $item[0]->author;
			$category = $item[0]->category;
			$guid = $item[0]->guid;
			
			if ($category == "Food/Recipes") {$cattext = "<a href='http://fleming.bf.umich.edu/wellnesscommittee/tasty.php'>Food/Recipes</a>";}
			
			elseif ($category == "Exercise") {$cattext = "<a href='http://fleming.bf.umich.edu/wellnesscommittee/exercise.php'>Exercise</a>";}
			
			else {$cattext = "None";}
			
			echo "<span id='postdate'><!--Posted by <a href='http://directory.umich.edu/ldapweb-bin/url?ldap:///uid=".$author.",ou=People,dc=umich,dc=edu'>" . $author. "</a>-->" . $formatted_pubdate. "<br>Category: ".$cattext."</span><table width=485><tr><th colspan=2>Your Comment</th></tr><form method=\"post\" method=POST action=\"/cgi-bin/htmail/wellnessblog@umich.edu\"><input type=hidden name=\"successURL\" value=\"https://fleming.bf.umich.edu/wellnesscommittee/thanks.php?guid=".$guid."\">  

<tr><td>

<label for=\"comment\">Body:</label></td><td>

<TEXTAREA name=\"comment\" rows=\"10\" id=\"comment\" style='width:430px;'></textarea>

</td></tr></table>

<input type=\"hidden\" name=\"from\" value=\"".$username."@umich.edu\">

<input type=\"hidden\" name=\"postTitle\" value=\"".$title."\">

<input type=\"hidden\" name=\"postURL\" value=\"http://fleming.bf.umich.edu/wellnesscommittee/item.php?guid=".$guid."\">

<input type=\"hidden\" name=\"LinkToMblog\" value=\"http://mblog.lib.umich.edu/wellnesscommittee/\">

<input type=\"hidden\" name=\"LinkToMblogAdmin\" value=\"https://mblog.lib.umich.edu/mt-bin/mt.cgi?__mode=menu&blog_id=8653\">

<input type=\"hidden\" name=\"subject\" value=\"Fleming Wellness Blog Comment ".$guid."\" >

<input type=\"submit\" name=\"submit\" id=\"submit\" value=\"Submit Comment\"></form></table>";
			}//end else (is_object($item))
		}//end try

		catch(Exception $e) {
			echo $e->getMessage();
			return 0;
		}//end catch

}//end get_item()






/**
* prints HTML representing a single <item> from the RSS feed
*
* Uses SimpleXml and XPath to transform a single <item> from the RSS feed into
* HTML.Prints result to screen.
*
* @param string $xml_param
* @param string $item_param
*/
function get_item_title($xml_param, $item_param) {

		$doc = new SimpleXmlElement($xml_param, NULL, TRUE);
		$path = "//item[guid='$item_param']";

		try{
			$item = $doc->xpath($path);

			if(count($item)==0) {
				throw new Exception(SINGLEDETAILERROR);
			}//end if(is_object($item))

			else {
			$test = $item[0]->title;
			echo $test;
			/* @see function format_pubdate() */
			//$unformatted_pubdate = $item[0]->pubDate;
			//$formatted_pubdate = format_pubdate($unformatted_pubdate);
			//echo "<span id='postdate'>" . $formatted_pubdate. "</span>";
			//echo "<br>";
			//echo $item[0]->description;
			}//end else (is_object($item))
		}//end try

		catch(Exception $e) {
			echo $e->getMessage();
			return 0;
		}//end catch

}//end get_item_title()




/**
* validates $guid_input from URL querystring
*
* Uses regular expression to check that $guid_input is well-formed
* input from URL querystring.
*
* @param string $guid_input
* @return bool true if $guid_input is well-formed
*/
function check_guid_safe($guid_input){
	$isSafe = ereg("2[0-9]{13}", $guid_input);
	return $isSafe;
}//end check_guid_safe()

/**
* validates $item_input from URL querystring
*
* Uses regular expression to check that $item_input is well-formed
* input from URL querystring, and that $item_input is either FIRSTITEMCHOICE,
* SECONDITEMCHOICE, or THIRDITEMCHOICE
*
* @param string $item_input
* @return bool true if $item_input is well-formed
*/
function check_item_safe($item_input) {
	$isSafe = false;
	$regexp_check = ereg("[0-9]{1,}", $item_input);
	if($regexp_check != 0) {
		$isSafe = true;
		//echo "regular expression check on " . $item_input . " " . $regexp_check . "<br />";
	}
	else {
		$isSafe = false;
	}
	if(($item_input != FIRSTITEMCHOICE) and ($item_input != SECONDITEMCHOICE) and ($item_input != THIRDITEMCHOICE) ) {
		$isSafe = false;
		echo " <br /><strong>" . $item_input .  ITEMERROR . "</strong><br />";
	}

	//echo $isSafe;
	return $isSafe;
}//end check_item_safe()

/**
* validates $page_input from URL querystring
*
* Uses regular expression to check that $page_input is well-formed
* input from URL querystring.
*
* @param string $page_input
* @return bool true if $page_input is well-formed
*/
function check_page_safe($page_input) {
	$regexp_check = ereg("[0-9]{1,4}", $page_input); //assuming that pages won't go above 9999
	if($regexp_check != 0) {
		$isSafe = true;
		//echo "regular expression check on " . $page_input . " " . $regexp_check . "<br />";
	}
	else {
		$isSafe = false;
		//echo " <br />page not an a number, resetting to 1 <br />";
	}
	return $isSafe;
}//end check_page_safe()

/**
* counts $totalNumItems per feed
*
* Uses XSLTProcessor and count.xsl to count the number of items in the feed passed in
* via $xml_paramregular.
* @todo refactor function name to use underscore instead of camel case.
*
* @param string $xml_param
* @return int total number items in feed
*/
function get_total_items($xml_param) {

		$doc = new DOMDocument();
		$xsl = new XSLTProcessor();
		$doc->load("count.xsl");
		$xsl->importStyleSheet($doc);
		try{
			if($doc->load($xml_param)==FALSE) {
				throw new Exception("");
			}
			else{
			$doc->load($xml_param);
			$result = $xsl->transformToXML($doc);
			$result = (int)(strip_tags($result));
			//echo "total items: " . $result;
			//echo "<br>";
			return $result;
			}//end else if($doc->load($xml_param)==false)
		}//end try
		catch(Exception $e) {
				//echo $e->getMessage();
				return 0;
		}//end catch
}//end get_total_items()

/**
* calculates the number of pages needed to display feed
*
* Calculates number of pages needed to display feed, based on $total ( @see function
* get_total_items()), $itemsPerPage (verified safe by @see function check_item_safe() )
* and $query (verified safe by @see function check_page_safe() ).
* @todo refactor function name to use underscore instead of camel case.
*
* @param int $total
* @param int $itemsPerPage
* @param int $query
* @return int number of pages needed
*/
function calc_numPages($total, $itemsPerPage, $query) {

	$remainder = $total % $itemsPerPage;
	//echo  "remainder: " .$remainder . "<br>";
	if($remainder == 0)
	{
		$numPages = (int)($total / $itemsPerPage);
	}
	else $numPages = ceil($total / $itemsPerPage);

	return $numPages;

}//end calc_numPages()

/**
* Converts date from RFC822 format to MM/DD/YY format
*
* Uses string-to-array functions and then PHP date functions to convert a date from
* RFC822 format ("Thu, 21 Aug 2008 01:14:36 PDT") to MM/DD/YY format. Called from
* within XSL as php:function. Found and
* modified slightly from this source:
* http://us3.php.net/manual/en/function.date.php#85973
*
* @param string $time
* @return string date in MM/DD/YY format
*/
function format_pubdate($time) {

   $time = explode(' ', $time);
   $chrono = explode(':', $time[4]);

   $month = array('Jan' => 1, 'Feb' => 2, 'Mar' => 3, 'Apr' => 4, 'May' => 5,
                  'Jun' => 6, 'Jul' => 7, 'Aug' => 8, 'Sep' => 9, 'Oct' => 10,
                  'Nov' => 11, 'Dec' => 12);

   $mktime = mktime($chrono[0], $chrono[1], $chrono[2], $month[$time[2]], $time[1], $time[3], $time[5]);

	$format_date = date("F d, Y, h:i:s A", $mktime);

   return $format_date;
}//end format_pubdate()

/**
* counts the number of words in RSS description
*
* Uses str_word_count() function to count the number of words in an RSS description. Called from XSL as php:function.
* @todo refactor function name to use underscore instead of camel case.
*
* @param string $i
* @return int number of words in description
*/
function checkNumWords($i){

	$no_html = strip_tags($i);
	return str_word_count($no_html, 0);

}//end checkNumWords()

/**
* return the first $n words of RSS description $input
*
* Returns the first $n words of RSS description $input. Called from XSL as
php:function. $n is XSL variable wordLimit.
* @todo refactor function name to use underscore instead of camel case.
*
* @param string $input
* @param int $n
* @return string first $n words in $input
*/
function getFirstN($input, $n, $guid, $page){

     	$outputarr = explode(" ", $input);
    	$output = "";

		$input_no_html = strip_tags($input);
		$num_words = str_word_count($input_no_html, 0);

		if($n > $num_words)
		{
			for($i = 0; $i < $num_words; $i++) {
				$output .= " " . $outputarr[$i];
			}
		}
		if($n <= $num_words)
		{
			for($i = 0; $i < $n; $i++) {
				$output .= " " . $outputarr[$i];
			}
		}

		$output .= write_more_link($guid, $page);

		$cleaned_output = tidy_clean($output);

		return $cleaned_output;

}//end getFirstN()

/**
* writes the More link leading to single item
*
* Writes the link that leads users to the single item. Called from XSL and uses $guid_in from the RSS guid.
* Parameterized for different pages via $page_in.
* RSS description.
*
* @param string $guid_id
* @param string $page_in
*/
function write_more_link($guid_in, $page_in){
	if($page_in == "all")
	{
		$moreLink = "... <a href='announcement.php?guid=" . $guid_in . "'>More</a>";
	}
	else{
		$moreLink = "... <a href='announcement_" . $page_in . ".php?guid=" . $guid_in . "'>More</a>";
	}
	return $moreLink;
}

/**
* Returns HTML for feed items given page number and items per page
*
* Edits XSL $xsl_param based on page and items per page needed, then applies XSL
* transformation to $xml_param RSS feed via XSLTProcessor in order to return
* an HTML string containing the selected items.
*
* @param int $numPages
* @param string $currPageNum
* @param string $itemsPerPage
* @param string $total
* @param string $xml_param
* @param string $xsl_param
* @return string feed items formatted as HTML for the called page and number of items
*/
function get_items_this_page($numPages, $currPageNum, $itemsPerPage, $total, $xml_param, $xsl_param){

	$itemIndexStart = ($currPageNum - 1) * $itemsPerPage;
	$itemIndexEnd = $itemIndexStart + $itemsPerPage;

	 if($itemIndexEnd >= $total){
		$itemIndexEnd = $total;
	}

	if($itemIndexStart >= $total){
		if($total!=0){
			echo "<strong>Page " . $currPageNum . " is not available. " . PAGEBOUNDERROR . "</strong><br />";
		}
		//$itemIndexStart = 1;
	}

	//echo "<br>" . "itemIndexStart: " . $itemIndexStart . "<br>";
	//echo "itemIndexEnd: " . $itemIndexEnd . "<br>";

	/* edit XSL on the fly to select the particular items needed	*/
	$xslstring = "rss/channel/item[(position() >" . $itemIndexStart . ") and (position()&lt;= ". $itemIndexEnd .")]";

	//echo "xslstring: " . $xslstring . "<br>";

	$xsldoc = new DOMDocument();
	$xsldoc->load($xsl_param);

	/* use xpath to find the node you want to edit and then simply supply a new value to its data property */
	$xpath = new DomXPath($xsldoc);
	$xpath->registerNamespace('xsl','http://www.w3.org/1999/XSL/Transform' );
	$xpathstring = "//xsl:for-each";
	$result = $xpath->query($xpathstring);
	$node = $result->item(0);
	$attributevalue = $node->attributes->getNamedItem("select")->nodeValue;
	//echo "node pre-edit: ". $attributevalue . "<br>";
	$node->attributes->getNamedItem("select")->nodeValue = $xslstring;
	//echo "node post-edit: ". $node->attributes->getNamedItem("select")->nodeValue . "<br>";

	$xsl = new XSLTProcessor();
	$xsl->importStyleSheet($xsldoc);

	$xsl->registerPHPFunctions();
	try {
			if($xsldoc->load($xml_param)==FALSE) {
				throw new Exception(RSSUNAVAILABLEERROR);
			}//end if($xsldoc->load($xml_param)==FALSE)
			else{
				//Tidy here?
				$xsldoc->load($xml_param);
				return $xsl->transformToXML($xsldoc);
			}//end else if($xsldoc->load($xml_param)==FALSE)
		}//end try

	catch (Exception $e) {

		//echo "Im a website- from within get_items_this_page()<br />";
		return $e->getMessage();
	}//end catch

}//end get_items_this_page()

/**
* Returns HTML for feed items given page number and items per page for links archive.
*
* Edits XSL $xsl_param based on page and items per page needed, then applies XSL
* transformation to $xml_param RSS feed via XSLTProcessor in order to return
* an HTML string containing the selected items.
*
* @param int $numPages
* @param string $currPageNum
* @param string $itemsPerPage
* @param string $total
* @param string $xml_param
* @param string $xsl_param
* @return string feed items formatted as HTML for the called page and number of items
*/
function get_items_this_page_links($numPages, $currPageNum, $itemsPerPage, $total, $xml_param, $xsl_param){

	$itemIndexStart = ($currPageNum - 1) * $itemsPerPage;
	$itemIndexEnd = $itemIndexStart + $itemsPerPage;

	 if($itemIndexEnd >= $total){
		$itemIndexEnd = $total;
	}

	if($itemIndexStart >= $total){
		if($total!=0){
			echo "<strong>Page " . $currPageNum . " is not available. " . PAGEBOUNDERROR . "</strong><br />";
		}
		//$itemIndexStart = 1;
	}

	//echo "<br>" . "itemIndexStart: " . $itemIndexStart . "<br>";
	//echo "itemIndexEnd: " . $itemIndexEnd . "<br>";

	/* edit XSL on the fly to select the particular items needed	*/
	$xslstring = "rss/channel/item[(position() >" . $itemIndexStart . ") and (position()&lt;= ". $itemIndexEnd .")]";

	//echo "xslstring: " . $xslstring . "<br>";

	$xsldoc = new DOMDocument();
	$xsldoc->load($xsl_param);

	/* use xpath to find the node you want to edit and then simply supply a new value to its data property */
/*	$xpath = new DomXPath($xsldoc);
	$xpath->registerNamespace('xsl','http://www.w3.org/1999/XSL/Transform' );
	$xpathstring = "//xsl:item";
	$result = $xpath->query($xpathstring);
	$node = $result->item(0);
	$attributevalue = $node->attributes->getNamedItem("select")->nodeValue;
*/
	//echo "node pre-edit: ". $attributevalue . "<br>";

//	$node->attributes->getNamedItem("select")->nodeValue = $xslstring;
	//echo "node post-edit: ". $node->attributes->getNamedItem("select")->nodeValue . "<br>";

	$xsl = new XSLTProcessor();
	$xsl->importStyleSheet($xsldoc);

	$xsl->registerPHPFunctions();
	try {
			if($xsldoc->load($xml_param)==FALSE) {
				throw new Exception(RSSUNAVAILABLEERROR);
			}//end if($xsldoc->load($xml_param)==FALSE)
			else{
				//Tidy here?
				$xsldoc->load($xml_param);
				return $xsl->transformToXML($xsldoc);
			}//end else if($xsldoc->load($xml_param)==FALSE)
		}//end try

	catch (Exception $e) {

		//echo "Im a website- from within get_items_this_page()<br />";
		return $e->getMessage();
	}//end catch

}//end get_items_this_page_links()


/**
* uses Tidy to clean HTML
*
* Uses methods from PHP version of HTML Tidy class http://php.net/manual/en/book.tidy.php to clean $unclean HTML string embedded in the
* RSS description.  Called from @see function getFirstN. Uses webmaster-suggested code to check for availability of
* PHP Tidy extension. @todo replace dl() function, since dl() is deprecated as of PHP 5.3.0 and
* gone in PHP 6.0.0 http://us2.php.net/manual/en/function.dl.php
*
* @param string $unclean
*/
function tidy_clean($unclean){
	$tidy_config = array(
						'output-html' => true,
						'show-body-only' => true,
						'wrap' => 0
						);

	$return_string = ""; //declaring here for proper scope

	if(!extension_loaded('tidy')){
			$return_string = $unclean;

			if(!dl('tidy.so')) {
			$return_string = $unclean;

			}//end if(!dl('tidy.so')
		}//end !extension_loaded('tidy')

	else {
		$tidy = new tidy();
		$return_string = $tidy->repairString($unclean,$tidy_config, 'UTF8');

	}


	return $return_string;
}//end tidy_clean()

/**
* prints out HTML containing next page link
*
* Calculates page number of next page based on $query (verified safe by @see function
* check_page_safe() ), $numPages (@see function get_total_items($xml_param). Uses
* $pageURL and $itemsPerPage to construct URL and retain user's items per page
* selection.
*
* @param string $query
* @param int $numPages
* @param int $itemsPerPage
* @param string $pageURL
*/
function set_next_link($query, $numPages, $itemsPerPage, $pageURL){

	if($query < $numPages) {

		$nextPage = $query + 1;
		$url = $pageURL . "?page=" . $nextPage . "&amp;items=" . $itemsPerPage;
		//$encoded_url = urlencode($url);
		echo "<a href='" . $url . "'>" . "Next Page" . "</a>";
	}
	else {
	echo "<strong>Last Page</strong>&nbsp;";
	}

}//end set_next_link()

/**
* prints out HTML containing previous page link
*
* Calculates page number of previous page based on $query (verified safe by @see
* function check_page_safe() ). Uses $pageURL and $itemsPerPage to construct URL and
* retain users items per page selection.
*
* @param string $query
* @param int $itemsPerPage
* @param int $totalItems
* @param string $pageURL
*/
function set_prev_link( $query,$itemsPerPage, $totalItems, $pageURL) {
	/**
	* @todo get rid of $totalItems parameter, its not used
    */
	if($query != 1){
		$prevPage = $query - 1;
		$url = $pageURL . "?page=" . $prevPage . "&amp;items=" . $itemsPerPage ;
		//$encoded_url = urlencode($url);
		echo "<a href='" . $url . "'>" . "Previous Page" . "</a>";
	}
	else {
		echo "<strong>First Page</strong>&nbsp;";
	}
}//end set_prev_link()

/**
* prints out HTML containing items per page links
*
* Prints out CSS-styled HTML containing items per page links. Uses constants defined for items per page choices. Always sets page back to 1.
* @todo refactor function name to use underscore instead of camel case.
*
* @param string $currPage
* @param string $itemsPerPage
* @param string $totalItems
* @param string $pageURL
*/
function set_itemsPerPage_links($currPage, $itemsPerPage, $totalItems, $pageURL) {
/**
* @todo get rid of $currPage and $totalItems parameters; theyre not needed
*/
$pointPage = 1;
echo "<div class='itemsperpage'>";
echo ITEMSVERBIAGE1;
if($itemsPerPage == FIRSTITEMCHOICE) {
	echo "<span class='selected'>" . $itemsPerPage. "</span>";
	echo  "<span><a href='" . $pageURL . "?page=" . $pointPage . "&amp;items=" . SECONDITEMCHOICE . "'>" . SECONDITEMCHOICE . "</a></span>";
	echo  "<span><a href='".  $pageURL ."?page=" . $pointPage . "&amp;items=" . THIRDITEMCHOICE . "'>" . THIRDITEMCHOICE . "</a></span>";

}//end if($itemsPerPage == FIRSTITEMCHOICE)

if($itemsPerPage == SECONDITEMCHOICE) {
	echo  "<span><a href='" . $pageURL . "?page=" . $pointPage . "&amp;items=" . FIRSTITEMCHOICE . "'>" . FIRSTITEMCHOICE . "</a></span>";
	echo "<span class='selected'>" . $itemsPerPage. "</span>";
	echo  "<span><a href='". $pageURL . "?page=" . $pointPage . "&amp;items=" . THIRDITEMCHOICE . "'>" . THIRDITEMCHOICE . "</a></span>";

}//end if($itemsPerPage == SECONDITEMCHOICE

if($itemsPerPage == THIRDITEMCHOICE) {
	echo  "<span><a href='". $pageURL . "?page=" . $pointPage . "&amp;items=" . FIRSTITEMCHOICE. "'>" . FIRSTITEMCHOICE ."</a></span>";
	echo  "<span><a href='". $pageURL . "?page=" . $pointPage . "&amp;items=" . SECONDITEMCHOICE . "'>" . SECONDITEMCHOICE . "</a></span>";
	echo "<span class='selected'>" . $itemsPerPage. "</span>";

}//end if($itemsPerPage == THIRDITEMCHOICE)
echo ITEMSVERBIAGE2;
echo "</div>";

}//end set_itemsPerPage_links()



?>