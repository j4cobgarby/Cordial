<?php require '../phpneed.php'; ?>

<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <title>Cordial - register</title>

    <link href="https://fonts.googleapis.com/css?family=Inconsolata|Roboto|Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="../styles/register.css">
  </head>
  <body>
    <div class="wrapper">
      <div class="logo">
        <img src="../assets/logobig-white.svg" />
      </div>
      <form autocomplete="off" method="post">
        <legend>
          Create account
        </legend>
        <input type="text" name="username" pattern="[A-Za-z0-9]{3,25}" title="An alphanumeric string between the lengths of 3 - 30 characters inclusive" placeholder="Choose a username"
          <?php
            if (isset($_POST["username"])) {
              echo 'value="'.$_POST["username"].'"';
            }
          ?>
        required />
        <br /><br />
        <input type="password" name="password" pattern=".{6,50}" title="Between 6 and 50 characters in length inclusive" placeholder="Type your password" required />
        <br />
        <input type="password" name="password-rep" pattern=".{6,50}" title="Between 6 and 50 characters in length inclusive" placeholder="Repeat your password" required />
        <br /><br />

        <br />
        <input type="text" name="beta-key" placeholder="What's the beta access key?" required />
        <br />

        <input type="submit" value="Go!" />

        <?php
          if (isset($_POST["username"]) and isset($_POST["password"])) {
            $user_password = htmlspecialchars(addslashes($_POST["password"]));
            $user_username = htmlspecialchars(addslashes($_POST["username"]));
            $user_password_rep = htmlspecialchars(addslashes($_POST["password-rep"]));

            $valid_username = False;
            $valid_password = False;
            $valid_beta_key = False;

            $connect = mysqli_connect($host_name, $user_name, $password, $database);

            $sql = 'SELECT user_id from `users` WHERE username = "'.$user_username.'" limit 1';
            $result = mysqli_query($connect, $sql);

            if (mysqli_num_rows($result) == 0) {
              $valid_username = True;
            }

            if ($user_password == $user_password_rep) {
              $valid_password = True;
            }

            if ($_POST["beta-key"] == $beta_key) {
              $valid_beta_key = True;
            }

            if ($valid_password and $valid_username and $valid_beta_key) {
              // Make the user
              $sql = '
              INSERT INTO `users` (
                `user_id`, `username`, `password`, `date_joined`, `is_admin`, `bio`
              )
              VALUES (
                NULL, "'.$user_username.'", "'.hash('sha256', $user_password).'", "'.date("Y-m-d").'", "0", ""
              );
              ';
              mysqli_query($connect, $sql);

              $get_user_id = 'SELECT user_id, username FROM users WHERE username = "'.$user_username.'"';
              echo $get_user_id;
              $result = mysqli_query($connect, $get_user_id);
              while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION["login-id"] = $row["user_id"];
              }

              echo "<script>window.location.href='../user/?id=".$_SESSION["login-id"]."'</script>";
              die();
            }
            elseif (!$valid_beta_key) {
              echo "<span class='error'>Invalid beta key</span>";
            }
            elseif ($valid_password and !$valid_username) {
              echo "<span class='error'>Someone already goes by this name</span>";
            }
            elseif (!$valid_password and $valid_username) {
              echo "<span class='error'>The passwords must match</span>";
            }
            else {
              echo "<span class='error'>The passwords don't match and this user already exists</span>";
            }
          }
        ?>
      </form>

      <span class="signin">Or alternatively, sign in <a href="../login">here!</a></span>
    </div>
  </body>
</html>
