<?php
// Content of database.php
 
$mysqli = new mysqli('localhost', 'shin', '123789', 'petdb');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

?>
