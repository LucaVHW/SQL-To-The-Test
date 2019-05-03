<?php
include_once("header.php");
 ?>

 <?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title></title>
  </head>
  <body>

    <div class="panel">
    <form action="auth.php" method="post">
      <input type="username" name="username" placeholder="Username" required>
      <input type="text" name="firstname" placeholder="First name" required>
      <input type="text" name="lastname" placeholder="Last name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input pattern=".{4,}" title="Minimum 4 characters" type="password" name="password"  placeholder="password" required>
      <input pattern=".{4,}" title="Minimum 4 characters" type="password" name="password" placeholder="password" required>
      <button type="submit" name="register">Register</button>
    </form>
    <?php
    session_start();
    if (isset($_SESSION['message'])):
    ?>

    <?php
        echo $_SESSION['message'];
        unset($_SESSION['message'])
    ?>
    <?php endif ?>
    </div>




  </body>
</html>
