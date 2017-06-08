<!DOCTYPE html>
<html>
  <head>
    <?php require '../creds.php'; ?>

    <meta charset="utf-8">
    <title>Cordial - register</title>

    <link href="https://fonts.googleapis.com/css?family=Overpass+Mono|Roboto|Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="../styles/register.css">
  </head>
  <body>
    <div class="wrapper">
      <div class="logo">
        <img src="../assets/logobig-white.svg" />
      </div>
      <form autocomplete="off" method="post">
        <legend>
          New user
        </legend>
        <input type="text" name="username" pattern="[A-Za-z0-9]{3,30}" title="An alphanumeric string between the lengths of 3 - 30 characters inclusive" placeholder="Choose a username"
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
        <input type="submit" value="Go!" />

        <?php
          if (isset($_POST["username"]) and isset($_POST["password"])) {
            $user_password = htmlspecialchars(addslashes($_POST["password"]));
            $user_username = htmlspecialchars(addslashes($_POST["username"]));
            $user_password_rep = htmlspecialchars(addslashes($_POST["password-rep"]));

            $valid_username = False;
            $valid_password = False;

            $connect = mysqli_connect($host_name, $user_name, $password, $database);

            $sql = 'SELECT user_id from `users` WHERE username = "'.$user_username.'" limit 1';
            $result = mysqli_query($connect, $sql);

            if (mysqli_num_rows($result) == 0) {
              $valid_username = True;
            }

            if ($user_password == $user_password_rep) {
              $valid_password = True;
            }

            if ($valid_password and $valid_username) {
              // Make the user
              $sql = '
              INSERT INTO `users` (
                `user_id`, `username`, `password`, `date_joined`, `is_admin`, `bio`
              )
              VALUES (
                NULL, "'.$user_username.'", "'.hash('sha256', $user_password).'", "'.date("Y-m-d").'", "0", "This particular person hasn\'t written a bio! :("
              );
              ';
              mysqli_query($connect, $sql);
              header("Location: ../login");
              die();
            }
            elseif ($valid_password and !$valid_username) {
              echo "<br /><span class='error'>Someone already goes by this name</span>";
            }
            elseif (!$valid_password and $valid_username) {
              echo "<br /><span class='error'>The passwords must match</span>";
            }
            else {
              echo "<br /><span class='error'>The passwords don't match and this user already exists</span>";
            }
          }
        ?>
      </form>
    </div>
  </body>
</html>
