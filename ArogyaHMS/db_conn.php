<?php

$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "hospital_ms";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}