<?php
include_once("header.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Register page

if(isset($_POST['register'])){

    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $firstname = !empty($_POST['firstname']) ? trim($_POST['firstname']) : null;
    $lastname = !empty($_POST['lastname']) ? trim($_POST['lastname']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;

    $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':username', $username);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['num'] > 0){
        $_SESSION['message'] = "<span>That username already exists!</span>";
        header('location: register.php');
    }

    $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));

    $sql = "INSERT INTO users (username, firstname, lastname, email, password) VALUES (:username, :firstname, :lastname, :email, :password)";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':firstname', $firstname);
    $stmt->bindValue(':lastname', $lastname);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $passwordHash);

    $result = $stmt->execute();

    if($result){
        header('Location: index.php');

        exit;
    }

}

// Login page

if(isset($_POST['login'])){

    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

    $sql = "SELECT id, username, password FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':username', $username);

    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user === false){
      $_SESSION['messagetwo'] = "<span>Incorrect username <br>or password combination!</span>";
      header('location: login.php');
    } else{

        $validPassword = password_verify($passwordAttempt, $user['password']);


        if($validPassword){


            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = time();
            $_SESSION['username'] = $username;

            header('Location: home.php');
            exit;

        } else{

          $_SESSION['messagetwo'] = "<span>Incorrect username <br>or password combination!</span>";
          header('location: login.php');
        }
    }
  }

// Account page

if(isset($_POST['submit'])){

  $username = $_SESSION['username'];
  $new_username = $_POST['username'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];

  $sql = "SELECT * FROM users WHERE username = '  $username'";
  $stmt = $conn->prepare($sql);

  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $sql = "UPDATE users SET username=:username, firstname=:firstname, lastname=:lastname, email=:email WHERE username = '$username'";
  $stmt = $conn->prepare($sql);

  $stmt->bindValue(':username', $new_username);
  $stmt->bindValue(':firstname', $firstname);
  $stmt->bindValue(':lastname', $lastname);
  $stmt->bindValue(':email', $email);

  $result = $stmt->execute();

  if($result){

      $_SESSION['messagethree'] = "Successfully edited!";
       header('location: account.php');

      exit;
  }
}

// Password page

if(isset($_POST['update'])){

  $pass = $_POST['password'];
  $new_pass = $_POST['cpassword'];

  $sql = "SELECT password FROM users WHERE password = '  $pass'";
  $stmt = $conn->prepare($sql);

  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));

  $sql = "UPDATE users SET password=:cpassword WHERE password = '$pass'";
  $stmt = $conn->prepare($sql);

  $stmt->bindValue(':cpassword', $new_pass);

  $result = $stmt->execute();

  if($result){
    $_SESSION['messagefour'] = "Successfully edited!";
     header('location: password.php');

      exit;
  }
}
 ?>
