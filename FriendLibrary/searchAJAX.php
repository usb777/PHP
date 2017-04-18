<?php
		
include_once "/admin/Model/db_config.php";

$mysqli = new MySQLi(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
/* Connect to database and set charset to UTF-8 */
if($mysqli->connect_error) 
 {
  echo 'Database connection failed...' . 'Error: ' . $mysqli->connect_errno . ' ' . $mysqli->connect_error;
  exit;
 } 
  else 
  {
   $mysqli->set_charset('utf8');
  }
/* retrieve the search term that autocomplete sends */
$term = trim(strip_tags($_GET['term'])); 

$a_json = array();
$a_json_row = array();
if ($data = $mysqli->query("SELECT * FROM books WHERE b_name LIKE '$term%' ORDER BY b_name")) 
{
	while($row = mysqli_fetch_array($data)) 
	{
		$name = htmlentities(stripslashes($row['b_name']));
		$a_json_row[] = $name;		
		
	}
}
// jQuery wants JSON data
echo json_encode($a_json_row);
flush();

$mysqli->close();




?>