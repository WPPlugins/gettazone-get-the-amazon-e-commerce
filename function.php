<?php

function GettoPost($text)
{
	$text = $text;
	if(is_single()){
	global $post, $azone, $public_key, $private_key, $associate_tag;
	$public_key = get_option('getta_key');
	$private_key = get_option('getta_secret');
	$associate_tag = get_option('getta_track');
	$azone = new AmazonProductAPI($public_key, $private_key, $associate_tag);
	//echo $gettazone->public_key;
	$tag_name = wp_get_post_tags( $post->ID, array( 'fields' => 'names' ) );
	$result = $azone->searchProducts($tag_name[0]." ".$tag_name[1],AmazonProductAPI::ALL,"TITLE");
	$value = get_option('getta_css');
	if(!empty($value)){
		$value = $value;
	}else{
		$value = "#gettapost { width: 100%; height: auto; margin: 0; padding: 0; display: inline-block; position: relative;  }\n#gettabox { width: 29%; min-height: 300px; height: auto; margin: 0; padding: 0; float: left;}\n#gettaitem {width: 100%; margin: 3px; }\n.clearfix:after {
   content: \" \";
   visibility: hidden;
   display: block;
   height: 0;
   clear: both;
}\n#price {
	background-color: orange;
	color: #fff;
	padding: 5px;
	margin: 5px;
	border-radius: 4px;
	font-weight: bold;
}\n#titleitem {
	margin: 2px;
	padding: 0;
	display: block;
}
				";
	}
	$text .= "<style>".$value."</style>";
	$text .= "<div id=\"gettapost\" class=\"col-lg-12 clearfix clearfix \">";
	/*
	foreach($result->Items->Item as $item)
	{
		$text .= "<div class=\"col-sx-6 col-sm-3 col-md-4 col-lg-4 clearfix\"><div class=\"thumbnail clearfix\">{$item->ItemAttributes->Title}<br>";
		$text .= "ASIN : {$item->ASIN}<br>";
		$text .= "<br><a href=\"{$item->DetailPageURL}\"><img src=\"" . $item->MediumImage->URL . "\" /></a><br></div></div>";
	}
	*/
	$num = get_option('getta_num');
	if(!empty($num)) $num = $num; else $num = 3;
	for($i=0;$i<$num;$i++)
	{
		$item = $result->Items->Item[$i];
		$text .= "<div id=\"gettabox\" class=\"col-sx-6 col-sm-3 col-md-4 col-lg-4 clearfix\"><div id=\"gettaitem\" class=\"thumbnail clearfix text-center\"><span id=\"titleitem\"><a href=\"{$item->DetailPageURL}\">{$item->ItemAttributes->Title}</a></span>";
		$text .= "<a href=\"{$item->DetailPageURL}\"><img src=\"" . $item->MediumImage->URL . "\" style=\"max-width: 100%\" class=\"img-responsive center-block\"/></a></div>";
		if(isset($item->ItemAttributes->ListPrice->FormattedPrice)) {
		$text .= "<span id=\"price\" class=\"btn btn-warning\">Price : {$item->ItemAttributes->ListPrice->FormattedPrice} {$item->ItemAttributes->ListPrice->CurrencyCode}</span>";
		}else {}
		$text .= "</div>";
	}
	$text .= "</div>";
	}
	//echo"<pre>";print_r($result);echo"</pre>";
	//echo $public_key.$private_key.$associate_tag;
	return $text;
	
}
add_filter('the_content', 'GettoPost');

class MyClass {

  public $param;

  public function __construct($param) {
    $this->param = $param;
  }
}

$myClass = new MyClass($public_key);
//echo $myClass->param; // foobar

?>