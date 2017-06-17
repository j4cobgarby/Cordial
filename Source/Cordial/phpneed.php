<?php
  $host_name  = "localhost";
  $database   = "cordial";
  $user_name  = "root";
  $password   = "";

  $category_expand = array(
    'swar' => 'Software',
    'hwar' => 'Hardware',
    'gdev' => 'Game Development',
    'wdev' => 'Web Development',
     'sci' => 'Science',
    'meme' => 'Memes',
    'pics' => 'Pictures',
    'pols' => 'Politics',
    'rand' => 'Random',
    'meta' => 'Meta',

    'all'  => 'Showing all'
  );

  // Start the session so I can use $_SESSION superglobal
  session_start();

  // Returns true if the current user, denoted by $_SESSION["login-id"], is an
  // admin.
  function isAdmin($host_name, $user_name, $password, $database) {
    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    $sql = 'SELECT * FROM users WHERE is_admin = 1 AND user_id = '.$_SESSION["login-id"].' LIMIT 1';
    $result = mysqli_query($connect, $sql);

    return mysqli_num_rows($result);
  }

  // Likes a post based on its post_id
  function likePost($id, $host_name, $user_name, $password, $database) {
    
  }

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
