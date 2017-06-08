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
        <input type="text" placeholder="Choose a username" />
        <br /><br />
        <input type="password" name="password" placeholder="Type your password">
        <br />
        <input type="password" placeholder="Repeat your password" />
        <br /><br />
        <input type="submit" value="Create!" />
      </form>
    </div>
  </body>
</html>
