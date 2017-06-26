<?php
  require '../phpneed.php';
  $id = $_REQUEST["id"];
  $connect = mysqli_connect($host_name, $user_name, $password, $database);

  if (canLikeComment($id)) {
    $sql = 'UPDATE comments SET likes = likes + 1 WHERE comment_id = '.$id;
    mysqli_query($connect, $sql);
    $set_liked = 'INSERT INTO user_liked_comments (user_id, comment_id) VALUES ('.$_SESSION["login-id"].', '.$id.')';
    mysqli_query($connect, $set_liked);

    echo "true";
  } else {

    $sql = 'UPDATE comments SET likes = likes - 1 WHERE comment_id = '.$id;
    mysqli_query($connect, $sql);
    $set_liked = 'DELETE FROM user_liked_comments WHERE comment_id = '.$id.' AND user_id = '.$_SESSION["login-id"];
    mysqli_query($connect, $set_liked);

    echo "false";
  }
?>
