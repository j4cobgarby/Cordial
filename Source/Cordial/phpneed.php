<?php
  $host_name  = "localhost";
  $database   = "cordial";
  $user_name  = "root";
  $password   = "";

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
