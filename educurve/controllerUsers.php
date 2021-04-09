<?php
include "dbOps.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $name = $_POST['name'];
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $password = $_POST['password'];
    $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : null;
    $grade = isset($_POST['grade']) ? $_POST['grade'] : null;
    if(!$parent_id) {
      // The new user is a parent
      if(check_user($con, $name, $password))
        echo "2";
      else {
        $sql_query = "insert into users(name, password, mobile_no, email) values('".$name."','".$password."','".$mobile."','".$email."')";
        $result = mysqli_query($con,$sql_query);
        echo "1";
      }
    }
    else {
      //The new user is a child
      $existing_user = false;
      $alphanumeric = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      $child_password = "";
      do {
      $child_password = substr(str_shuffle($alphanumeric),0,6);
      $existing_user = check_user($con, $name, $child_password);
      }while($existing_user);
      
      $sql_query = "insert into users(name, parent, password, grade) values('".$name."',".$parent_id.",'".$child_password."','".$grade."')";
      $result = mysqli_query($con,$sql_query);
      echo $child_password;
    }
  }
  catch(Exception $ex) {
    echo "3";
  }
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  try {
    $name = $_GET['name'];
    $password = $_GET['password'];
    $user_id = check_user($con, $name, $password);
    if($user_id) {
      $_SESSION['user_id'] = $user_id;
      echo $user_id;
    }
    else
      echo "no user";
  }
  catch(Exception $ex) {
    echo $ex;
  }
}
?>.