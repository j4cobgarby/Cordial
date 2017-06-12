<?php
  require '../phpneed.php';

  $sql = '
    INSERT INTO `posts`
      (`post_id`, `user_id`, `date_posted`, `category`, `title`, `content`, `likes`, `views`)

    VALUES (
      NULL,
      '.$_SESSION["login-id"].',
      "'.date("Y-m-d").'",
      "' .addslashes($_POST["category"]) .'",
      "' .addslashes($_POST["title"])    .'",
      "' .addslashes($_POST["content"])  .'",
      0, 0
    );
  ';

  $connect = mysqli_connect($host_name, $user_name, $password, $database);

  $result = mysqli_query($connect, $sql);

  echo "<script>window.location.href='../'</script>";
?>
