<?php require '../phpneed.php'; ?>
<!DOCTYPE html>
<html>
  <head>

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
        required />
        <br /><br />
        Password <input name="password" type="password" placeholder="Password" required />
        <br /><br />
        <input type="submit" value="Log in" />

        <?php
          if (isset($_POST["username"]) and isset($_POST["password"]) and $_POST["username"] != "" and $_POST["password"] != "") {
            $user_password = htmlspecialchars(addslashes($_POST["password"]));
            $user_username = htmlspecialchars(addslashes($_POST["username"]));

            $connect = mysqli_connect($host_name, $user_name, $password, $database);

            $sql = 'SELECT user_id, password from `users` WHERE username = "'.$user_username.'" limit 1';

            $result = mysqli_query($connect, $sql);

            if ($result != false) {
              $value = mysqli_fetch_object($result);
              if ($value != null) {
                if ($value->password == hash("sha256", $user_password)) {
                  $_SESSION["login-id"] = $value->user_id;
                  echo "Logging in as".$user_username;
                  echo "<script>window.location.href='../'</script>";
                } else {
                  echo "<span class='error'>Incorrect password</span>";
                }
              } else {
                echo "<span class='error'>This user doesn't exist</span>";
              }
            }
          }
        ?>
      </form>
      <span class="reg">Or if you don't have an account, register <a href="../register">here!</a></span>

    </div>
  </body>
</html>
