<?php
include("connection.php");
$foodId = $_GET['food_id'];

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}
// Select all the rows in the markers table
$result = mysqli_query($conn, "SELECT * from food, food_location, location WHERE food.food_id = $foodId AND food.food_id = food_location.food_id AND food_location.location_id = location.location_id");

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = mysqli_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'name="' . parseToXML($row['location_name']) . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['lang'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';


?>