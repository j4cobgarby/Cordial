<?php
  require '../phpneed.php';

  // This file should be sent, using GET, the ID of the post to delete

  $connect = mysqli_connect($host_name, $user_name, $password, $database);

  $can_delete = false;

  if (isAdmin($host_name, $user_name, $password, $database)) {
    $can_delete = true;
  }
  else if ($user_id == $_SESSION["login-id"]) {
    $can_delete = true;
  }

  if ($can_delete == true) {
    $sql = 'DELETE FROM `posts` WHERE post_id = '.$_GET["id"];
    mysqli_query($connect, $sql);

    $sql = 'DELETE FROM `comments` WHERE post_id = '.$_GET["id"];
    mysqli_query($connect, $sql);

    echo $_GET["id"];
  }

  echo "<script>window.location.href='../../'</script>"
?>
