<?php
  require '../phpneed.php';

  // This file should be sent, using GET, the ID of the post to delete

  $connect = mysqli_connect($host_name, $user_name, $password, $database);

  $can_delete = false;

  $connect = mysqli_connect($host_name, $user_name, $password, $database);
  $sql = "SELECT * FROM `posts` NATURAL JOIN `users` WHERE post_id = ".$_GET["id"];
  $result = mysqli_query($connect, $sql);

  while ($row = mysqli_fetch_assoc($result)) {
    $user_id = $row["user_id"];
  }

  if (isAdmin($host_name, $user_name, $password, $database)) {
    $can_delete = true;
  }
  else if ($user_id == $_SESSION["login-id"]) {
    $can_delete = true;
  }

  if ($can_delete == true) {
    echo "Can delete";
    $sql = 'DELETE FROM `posts` WHERE post_id = '.$_GET["id"];
    mysqli_query($connect, $sql);

    $sql = 'DELETE FROM `comments` WHERE post_id = '.$_GET["id"];
    mysqli_query($connect, $sql);

    echo $_GET["id"];
  } else {
    echo "Cannot delete";
  }

  echo "<script>window.location.href='../../'</script>"
?>
