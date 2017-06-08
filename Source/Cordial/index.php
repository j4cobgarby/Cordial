<!DOCTYPE php>

<!-- MAIN -->

<html>
  <head>
    <?php
      require 'creds.php';

      $selectallcats = "SELECT user_id, post_id, date_posted, category, title,
      content, likes, views, username, is_admin
      FROM `posts` NATURAL JOIN `users` ORDER BY post_id DESC";

      $connect = mysqli_connect($host_name, $user_name, $password, $database);

      if (!empty($_GET)) {
        $user_category = $_GET["cat"];

        if ($user_category == 'all') {
          $sql = $selectallcats;
        } else {
          $sql = "SELECT user_id, post_id, date_posted, category, title, content,
          likes, views, username, is_admin
          FROM `posts` NATURAL JOIN `users` WHERE category = '".$user_category."'
          ORDER BY post_id DESC";
        }

      } else {
        $sql = $selectallcats;
      }

      $result = mysqli_query($connect, $sql);
    ?>
    <meta charset="utf-8">
    <title>Cordial</title>
    <link href="https://fonts.googleapis.com/css?family=Overpass+Mono|Roboto|Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="styles/homepage.css">
    <script src="scripts/script.js" charset="utf-8"></script>
  </head>
  <body>
    <?php require 'rootheader.php'; ?>

    <div class="postview" id="postview">
      <?php
  		  while($row = mysqli_fetch_assoc($result)) {
          echo '
          <div class="post">
            <div class="post-user hoverpointer" onclick="location.href=\'user?id='.$row["user_id"].'\'">
              '.($row["is_admin"] == 1 ? '<img title="Admin" src="assets/admin-icon.png" />' : '<img title="User" src="assets/user-icon.png" />').'
              <div class="user-info">
                <span class="date-posted">'.$row["date_posted"].'</span>
                <br />
                <span class="username">'.($row["is_admin"] == 1 ? '<b>' : '').$row["username"].($row["is_admin"] == 1 ? '</b>' : '').'</span>
              </div>
            </div>
            <span class="title hoverpointer" onclick="location.href=\'post?id='.$row["post_id"].'\'">'.
            $row["title"]
            .'
            </span>
            <div class="post-status">
              <span class="likes">
                <img class="likes" src="assets/like-icon.png">
                '.$row["likes"].'
              </span>
              <span class="views">
                '.$row["views"].'
                <img class="views" src="assets/views-icon.png" />
              </span>
            </div>
          </div>
          ';
  		  }
      ?>
    </div>
  </body>
</html>
