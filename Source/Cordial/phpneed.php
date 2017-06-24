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

  function dateReformat($dateString) {
    return date_format(date_create_from_format('Y-m-d', $dateString), 'd/m/Y');
  }

  function sendNotification($sender_id, $recipient_id, $type, $post_id) {
    global $host_name, $user_name, $password, $database;
    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    $sql = "INSERT INTO notifications (notification_id, sender_id, recipient_id, date_sent, type, post_id)
      VALUES (NULL, {$sender_id}, {$recipient_id}, '".date("Y-m-d")."', '{$type}', {$post_id})";
    //echo $sql;
    mysqli_query($connect, $sql);
  }

  function removeNotificationsForUserOnPost($post_id) {
    global $host_name, $user_name, $password, $database;
    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    $sql = "DELETE FROM notifications WHERE post_id = ".$post_id." AND recipient_id = ".$_SESSION["login-id"];
    mysqli_query($connect, $sql);
  }

  function doesStringMentionUser($str) {
    preg_match('/@([^ ]+)/', $str, $matches);
    return sizeof($matches) != 0;
  }

  function getTaggedUserFromString($str) {
    preg_match('/@([^ ]+)/', $str, $matches);
    return $matches[1];
  }

  function getTaggedUserIDFromString($str) {
    global $host_name, $user_name, $password, $database;
    $username = getTaggedUserFromString($str);
    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    $sql = 'SELECT user_id FROM users WHERE username = "'.$username.'"';
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      return $row["user_id"];
    }
  }

  function putSpanAroundMentionedUser($str) {
    preg_match('/@([^ ]+)/', $str, $matches);
    return str_replace($matches[0], '<span class="mentioned" onclick="window.location.href=\'../user/?id='.getTaggedUserIDFromString($str).'\'">'.$matches[0].'</span>', $str);
  }
  
  function tryPutSpanAroundMentionedUser($str) {
    if (doesStringMentionUser($str)) {
      return putSpanAroundMentionedUser($str);
    } else {
      return $str;
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
