<?php
session_start();
$host = "localhost";
$user = "root";
$password = "mysql";
$dbname = "mylocal";
$port = 3307;

$con = mysqli_connect($host, $user, $password,$dbname,$port);
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
function check_user($con, $name, $password) {
  $sql_query =  "select id from users where name = '".$name."' and password = '".$password."'";
  $result = mysqli_query($con,$sql_query);
  $row = mysqli_fetch_array($result);
  if(count($row) > 0)
    return $row['id'];
  else
    return false;
}
?>