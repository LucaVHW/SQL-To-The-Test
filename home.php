<?php
include_once("header.php");

session_start();

if(isset($_SESSION['username'])) {
  echo('Hello, '.$_SESSION['username'] );
}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <br>
    <a href="account.php">Settings</a>

  </body>
</html>
