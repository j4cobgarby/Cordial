<!DOCTYPE html>
<html>
  <head>
    <?php require '../phpneed.php'; ?>

    <meta charset="utf-8">
    <title>Cordial - login</title>

    <link href="https://fonts.googleapis.com/css?family=Overpass+Mono|Roboto|Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="../styles/login.css">
  </head>
  <body>
    <div class="sidebar">
      <img src="../assets/logobig-white.svg" />

      <form action="" method="post">
        <legend>
          Log in
        </legend>
        Username <input name="username" type="text" placeholder="Username"
          <?php
            if (isset($_POST["username"])) {
              echo 'value="'.$_POST["username"].'"';
            }
          ?>
        />
        <br /><br />
        Password <input name="password" type="password" placeholder="Password" />
        <br /><br />
        <input type="submit" value="Log in" />

        <?php
          if (isset($_POST["username"]) and isset($_POST["password"])) {
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
                  echo "<span class='error'>Incorrect password</span>";
                }
              } catch (Exception $e) {
                echo "Exception occured";
              }
            }
          }
        ?>
      </form>

      <a href="../register">Or if you don't have an account, <b>register here!</b></a>
    </div>
  </body>
</html>
