<?php
  $releasetype = "LOCAL";

  if ($releasetype == "LOCAL") {
    $host_name  = "localhost";
    $database   = "cordial";
    $user_name  = "root";
    $password   = "";
  } elseif ($releasetype == "SERVER") {
    $host_name  = "db684175309.db.1and1.com";
    $database   = "db684175309";
    $user_name  = "dbo684175309";
    $password   = "Jacobg@01";
  }

  function likePost($target_id) {
    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    $sql = 'UPDATE `posts` SET likes = likes + 1 WHERE post_id = '.$target_id;
    mysqli_query($connect, $sql);
  }

  // Start the session so I can use $_SESSION superglobal
  session_start();

  if (isset($_SESSION["login-id"])) {
    $connect = mysqli_connect($host_name, $user_name, $password, $database);

    $sql = 'SELECT user_id, username from `users` WHERE user_id = "'.$_SESSION["login-id"].'" limit 1';

    $result = mysqli_query($connect, $sql);

    if ($result != false) {
      $value = mysqli_fetch_object($result);
      $loggedin_username = $value->username;
    }
  }
?>
