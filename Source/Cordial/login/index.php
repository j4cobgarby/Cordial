<!DOCTYPE html>
<html>
  <head>
    <?php require '../creds.php'; ?>

    <meta charset="utf-8">
    <title>Cordial - login</title>

    <link href="https://fonts.googleapis.com/css?family=Overpass+Mono|Roboto|Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="../styles/login.css">
  </head>
  <body>
    <div class="sidebar">
      <img src="../assets/logobig-white.svg" />

      <form action="loginprocess.php" method="post">
        <legend>
          Log in
        </legend>
        Username <input name="username" type="text" placeholder="Username" />
        <br /><br />
        Password <input name="password" type="password" placeholder="Password" />
        <br /><br />
        <input type="submit" value="Log in" />
      </form>

      <a href="../register">Or if you don't have an account, <b>register here!</b></a>
    </div>
  </body>
</html>
