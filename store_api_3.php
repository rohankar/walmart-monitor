<?php
 
//$q = $_GET["q"]; // query string
//$request = "http://search.twitter.com/search.json?q=".urlencode($q);

 $cities = array("Newark", "Los+Angeles", "Chicago", "Houston", "Philadelphia", "Phoenix", "San+Antonio", "San+Diego"," Dallas"," San+Jose", "Austin", "Indianapolis", "Jacksonville", "San+Francisco", "Columbus", "Charlotte", "Fort+Worth", "Detroit", "El+Paso", "Memphis", "Seattle", "Denver", "Washington+DC", "Boston", "Nashville", "Baltimore", "Oklahoma+City", "Louisville", "Portland", "Las+Vegas", "Milwaukee", "Albuquerque", "Tucson", "Fresno", "Sacramento", "Long+Beach", "Kansas+City", "Mesa", "Virginia+Beach", "Atlanta", "Colorado+Springs", "Omaha", "Raleigh", "Oakland", "Minneapolis", "Tulsa", "Cleveland", "Wichita", "Arlington");

    $arrlength = count($cities);

    for($x = 0; $x <  $arrlength; $x++) {
    $city_name=$cities[$x];
    insert_store_data($city_name);
    }
//$response = file_get_contents($request);
//$jsonobj = json_decode($response);
 
if($jsonobj != null){
 
	$con = mysql_connect('', '', '');
 
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
 
	foreach($jsonobj->results as $item){
 
		$id = $item->id;
		$created_at = $item->created_at;
		$created_at = strtotime($created_at);
		$mysqldate = date('Y-m-d H:i:s',$created_at);
		$from_user = mysql_real_escape_string($item->from_user);
		$from_user_id = $item->from_user_id;
		$text = mysql_real_escape_string($item->text);
		$source = mysql_real_escape_string($item->source);
		$geo = $item->geo;
		$iso_language_code = $item->iso_language_code;
		$profile_image_url = mysql_real_escape_string($item->profile_image_url);
		$to_user_id = $item->to_user_id;
		if($to_user_id==""){ $to_user_id = 0; }
		$query = mysql_real_escape_string($query);
 
		mysql_select_db("database", $con);
                // SQL query to create table available at http://snipplr.com/view/56995/sql-query-to-create-a-table-in-mysql-to-store-tweets/
		$query = "INSERT into tweets VALUES ($id,'$mysqldate','$from_user',$from_user_id,'$text','$source','$geo','$iso_language_code','$profile_image_url',$to_user_id,'$q')";
		$result = mysql_query($query);
 
	}
 
	mysql_close($con);
}
 
?>