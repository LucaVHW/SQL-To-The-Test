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
      <input pattern=".{4,}" title="Minimum 4 characters" type="password" name="password"  placeholder="password" required>
      <input pattern=".{4,}" title="Minimum 4 characters" type="password" name="cpassword" placeholder="password" required>
      <button type="submit" name="update">Submit</button>
    </form>
    <?php
    session_start();
    if (isset($_SESSION['messagefour'])) {
      echo $_SESSION['messagefour'];
      unset($_SESSION['messagefour']);
    } ?>
</div>

  </body>
</html>
