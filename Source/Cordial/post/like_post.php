<?php
  require '../phpneed.php';
  $id = $_REQUEST["id"];
  $connect = mysqli_connect($host_name, $user_name, $password, $database);

  if (canLike($id, $host_name, $user_name, $password, $database)) {
    $sql = 'UPDATE posts SET likes = likes + 1 WHERE post_id = '.$id;
    mysqli_query($connect, $sql);
    $set_liked = 'INSERT INTO user_liked_posts (user_id, post_id) VALUES ('.$_SESSION["login-id"].', '.$id.')';
    mysqli_query($connect, $set_liked);

    $get_recip = 'SELECT user_id FROM posts WHERE post_id = '.$id;
    $recip_result = mysqli_query($connect, $get_recip);
    while ($row = mysqli_fetch_assoc($recip_result)) {
      $recip_id = $row["user_id"];
    }
    sendNotification($_SESSION["login-id"], $recip_id, 'like', $id);

    echo "true";
  } else {

    $sql = 'UPDATE posts SET likes = likes - 1 WHERE post_id = '.$id;
    mysqli_query($connect, $sql);
    $set_liked = 'DELETE FROM user_liked_posts WHERE post_id = '.$id.' AND user_id = '.$_SESSION["login-id"];
    mysqli_query($connect, $set_liked);

    echo "false";
  }
?>
