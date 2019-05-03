<?php
include_once("header.php");

session_start();
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
      <button type="submit" name="submit">Submit</button>
    </form>
    <?php
    session_start();
    if (isset($_SESSION['messagethree'])) {
      echo $_SESSION['messagethree'];
      unset($_SESSION['messagethree']);
    } ?>
</div>

  </body>
</html>
