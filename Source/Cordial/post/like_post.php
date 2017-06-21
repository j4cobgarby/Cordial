<?php
  require '../phpneed.php';
  $id = $_REQUEST["id"];
  $connect = mysqli_connect($host_name, $user_name, $password, $database);

  if (canLike($id, $host_name, $user_name, $password, $database)) {
    $sql = 'UPDATE posts SET likes = likes + 1 WHERE post_id = '.$id;
    mysqli_query($connect, $sql);
    $set_liked = 'INSERT INTO user_liked_posts (user_id, post_id) VALUES ('.$_SESSION["login-id"].', '.$id.')';
    mysqli_query($connect, $set_liked);
    echo "true";
  } else {
    echo "false";
  }
?>
