<?php

$host = "localhost";
$username = "root";
$db = "mdums";
$pass = "";

//$host = "localhost";
//$username = "infini88_admin";
//$db = "infini88_infinitewisdom";
//$pass = "Eleap2022#"; 
// mdums@2024

$conn = new mysqli($host,$username, $pass, $db) OR DIE("DIE" .mysqli_error());

if(mysqli_connect_errno()){
	echo "It is not connectiong". mysqli_connect_error();
}
global $conn;

?>