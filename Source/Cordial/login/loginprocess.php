<?php
  require '../creds.php';

  $user_password = htmlspecialchars(addslashes($_POST["password"]));
  $user_username = htmlspecialchars(addslashes($_POST["username"]));

  $connect = mysqli_connect($host_name, $user_name, $password, $database);

  $sql = 'SELECT user_id, password from `users` WHERE username = "'.$user_username.'" limit 1';

  $result = mysqli_query($connect, $sql);

  if ($result != false) {
    $value = mysqli_fetch_object($result);

    try {
      if ($value->password == hash("sha256", $user_password)) {
        $_SESSION["login-id"] = $value->user_id;
        echo "Logged in as ".$user_username;
        header( 'Location: ../' ) ;
      } else {
        echo "Incorrect password";
        header( 'Location: index.php' ) ;
      }
    } catch (Exception $e) {
      echo "Exception occured";
      header( 'Location: index.php' ) ;
    }
  }
?>
