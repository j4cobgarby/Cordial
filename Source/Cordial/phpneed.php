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

  $beta_key = 'dev';

  // Start the session so I can use $_SESSION superglobal
  session_start();

  // Returns 1 if the current user, denoted by $_SESSION["login-id"], is an
  // admin. Otherwise, it returns 0.
  function isAdmin($host_name, $user_name, $password, $database) {
    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    $sql = 'SELECT * FROM users WHERE is_admin = 1 AND user_id = '.$_SESSION["login-id"].' LIMIT 1';
    $result = mysqli_query($connect, $sql);

    return mysqli_num_rows($result);
  }

  // Returns true if the current user can like the post of the given $id, otherwise
  // returns false.
  // This is done based on the user_liked_posts table in the database, and checks
  // if there is a record of this user already liking the post with post_id $id
  function canLike($id, $host_name, $user_name, $password, $database) {
    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    $check_liked = "SELECT * FROM user_liked_posts WHERE user_id = ".$_SESSION["login-id"]." AND post_id = ".$id;
    $is_liked_result = mysqli_query($connect, $check_liked);
    $can_like = (mysqli_num_rows($is_liked_result) == 0 ? true : false);
    return $can_like;
  }

  // Likes or unlikes a post based on if it's already liked
  function likePost($id, $host_name, $user_name, $password, $database) {
    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    if (canLike($id, $host_name, $user_name, $password, $database) == true) {
      $sql = 'UPDATE posts SET likes = likes + 1 WHERE post_id = '.$id;
      mysqli_query($connect, $sql);
      $set_liked = 'INSERT INTO user_liked_posts (user_id, post_id) VALUES ('.$_SESSION["login-id"].', '.$id.')';
      mysqli_query($connect, $set_liked);
      echo "<script>window.location.href='../post/?id=".$id."'</script>";
    }
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
