<!DOCTYPE html>
<html>
  <head>
    <?php
      require '../phpneed.php';
      require '../sublogincheck.php';
    ?>

    <meta charset="utf-8">
    <title>Cordial - Search</title>
    <link rel="stylesheet" href="../styles/homepage.css">
    <link rel="stylesheet" href="../styles/search.css">
    <link href="https://fonts.googleapis.com/css?family=Overpass+Mono|Roboto|Roboto+Condensed" rel="stylesheet">
    <script src="../scripts/script.js" charset="utf-8"></script>
  </head>
  <body>
    <?php require '../subheader.php'; ?>

    <div class="search-wrapper">
      <form method="get">
        <input type="text" name="q" placeholder="Search for a user..."/>
        <input type="submit" value="Go" />
      </form>
    </div>

    <?php if (isset($_GET["q"])) {
      $query = htmlspecialchars(addslashes($_GET["q"]));

      $connect = mysqli_connect($host_name, $user_name, $password, $database);
      $sql = 'SELECT * FROM `users`';

      $result = mysqli_query($connect, $sql);


    } ?>
  </body>
</html>
