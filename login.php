<?php
include_once("header.php")
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
      <input type="username" name="username" placeholder="username" required>
      <input pattern=".{4,}" title="Minimum 4 characters" type="password" name="password" placeholder="password" required>
      <button type="submit" name="login">Login</button>
    </form>
    <?php
    session_start();
    if (isset($_SESSION['messagetwo'])):
    ?>

    <?php
        echo $_SESSION['messagetwo'];
        unset($_SESSION['messagetwo'])
    ?>
    <?php endif ?>
    </div>

  </body>
</html>
