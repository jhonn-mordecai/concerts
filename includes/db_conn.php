<?php

$db_conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if (!$db_conn) {
	echo "<h1>Database error.</h1>";
	die();
} 

?>