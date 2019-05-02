<?php
$dbname            ='seven_elevengeography'; 
$dbuser            ='root'; 
$dbpass            =''; 
$dbserver          ='localhost';
$conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

function parseToXML($htmlStr)
{
	$xmlStr=str_replace('<','&lt;',$htmlStr);
	$xmlStr=str_replace('>','&gt;',$xmlStr);
	$xmlStr=str_replace('"','&quot;',$xmlStr);
	$xmlStr=str_replace("'",'&#39;',$xmlStr);
	$xmlStr=str_replace("&",'&amp;',$xmlStr);
	return $xmlStr;
}

if(isset($_GET['island'])){
  if($_GET['island']){
    $sql = "SELECT * FROM 7_eleven";
    $result = $conn->query($sql); 
  }elseif($_GET['island'] == 'Luzon'){
    $sql = "SELECT * FROM 7_eleven WHERE island = 'Luzon'";
    $result = $conn->query($sql); 
  }elseif($_GET['island'] == 'Visayas'){
    $sql = "SELECT * FROM 7_eleven WHERE island = 'Visayas'";
    $result = $conn->query($sql); 
  }elseif($_GET['island'] == 'Mindanao'){
    $sql = "SELECT * FROM 7_eleven WHERE island = 'Mindanao'";
    $result = $conn->query($sql); 
}
}else{
  $sql = "SELECT * FROM 7_eleven";
  $result = $conn->query($sql); 
}


header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = $result->fetch_assoc()){
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'store_name="' . parseToXML($row['store_name']) . '" ';
  echo 'address="' . parseToXML($row['address']) . '" ';
  echo 'island="' . ($row['island']) . '" ';
  echo 'lat="' . $row['latitude'] . '" ';
  echo 'lng="' . $row['longitude'] . '" ';
  echo 'img="' . $row['img'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>