<?php 	

$localhost = "localhost";
$username = "efreinal_inventa";
$password = "inventario2018*";
$dbname = "efreinal_inventario";

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>