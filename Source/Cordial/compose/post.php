<?php
  $sql = '
    INSERT INTO `posts`
      (`post_id`, `user_id`, `date_posted`, `category`, `title`, `content`, `likes`, `views`)

    VALUES (
      NULL,
      1,
      "6-7-2017",
      "' .addslashes($_POST["category"]) .'",
      "' .addslashes($_POST["title"])    .'",
      "' .addslashes($_POST["content"])  .'",
      0, 0
    );
  ';

  $host_name  = "localhost";
  $database   = "cordial";
  $user_name  = "root";
  $password   = "";

  $connect = mysqli_connect($host_name, $user_name, $password, $database);

  $result = mysqli_query($connect, $sql);

  header( 'Location: ../' ) ;
?>
