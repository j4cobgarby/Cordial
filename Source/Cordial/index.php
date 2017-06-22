<?php require 'phpneed.php'; ?>

<!DOCTYPE php>

<!-- MAIN -->

<html>
  <head>
    <?php
      require 'rootlogincheck.php';

      $selectallcats = "SELECT *
      FROM `posts` NATURAL JOIN `users` WHERE pinned != 1 ORDER BY post_id DESC LIMIT 500";

      $connect = mysqli_connect($host_name, $user_name, $password, $database);

      if (isset($_GET["cat"])) {
        $user_category = $_GET["cat"];

        if ($user_category == 'all') {
          $sql = $selectallcats;
        } else {
          $sql = "SELECT *
          FROM `posts`
          NATURAL JOIN `users`
          WHERE pinned != 1 AND category = '".$user_category."'
          ORDER BY post_id DESC";
        }

      } else {
        $user_category = 'all';
        $sql = $selectallcats;
      }

      if (isset($_GET["order"])) {
        $order = $_GET["order"];

        switch ($order) {
          case 'date':
            $sql = "SELECT * FROM `posts` NATURAL JOIN `users` WHERE pinned != 1".($user_category == 'all' ? '' : " AND category = '".$user_category."'")." ORDER BY date_posted DESC";
            break;

          case 'likes':
            $sql = "SELECT * FROM `posts` NATURAL JOIN `users` WHERE pinned != 1".($user_category == 'all' ? '' : " AND category = '".$user_category."'")." ORDER BY likes DESC";
            break;

          case 'admin':
            $sql = "SELECT * FROM `posts` NATURAL JOIN `users` WHERE pinned != 1".($user_category == 'all' ? '' : " AND category = '".$user_category."'")." ORDER BY is_admin DESC";
            break;

          default:
            $sql = "SELECT * FROM `posts` NATURAL JOIN `users` WHERE pinned != 1".($user_category == 'all' ? '' : " AND category = '".$user_category."'")." ORDER BY post_id DESC";
            break;
        }
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

    <ul class="navbar">
      <li class='newest <?php
        if (isset($_GET["order"])) {
          if ($_GET["order"] == 'date') {
            echo 'selected';
          }
        } else {
          echo 'selected';
        }
      ?>' onclick='window.location.href="<?php
        echo '?order=date';
        if (isset($_GET["cat"])) {
          echo '&cat='.$_GET["cat"];
        }
      ?>"'>Newest</li>
      <li class='likes <?php
        if (isset($_GET["order"])) {
          if ($_GET["order"] == 'likes') {
            echo 'selected';
          }
        }
      ?>' onclick='window.location.href="<?php
        echo '?order=likes';
        if (isset($_GET["cat"])) {
          echo '&cat='.$_GET["cat"];
        }
      ?>"'>Most liked</li>
      <li class='admin <?php
        if (isset($_GET["order"])) {
          if ($_GET["order"] == 'admin') {
            echo 'selected';
          }
        }
      ?>' onclick='window.location.href="<?php
        echo '?order=admin';
        if (isset($_GET["cat"])) {
          echo '&cat='.$_GET["cat"];
        }
      ?>"'>Admins first</li>
    </ul>

    <div class="postview" id="postview">
      <div class="postview-pinned">
        <h5>PINNED</h5>
        <!-- Get and render pinned posts -->
        <?php
          $pinned_sql = 'SELECT * FROM posts NATURAL JOIN users WHERE pinned = 1';
          $pinned_result = mysqli_query($connect, $pinned_sql);
          while ($row = mysqli_fetch_assoc($pinned_result)) {
            echo '
            <div class="post">
              <div class="post-user hoverpointer" onclick="location.href=\'user?id='.$row["user_id"].'\'">
                '.($row["is_admin"] == 1 ? '<img title="Admin" src="assets/admin-icon.png" />' : '<img title="User" src="assets/user-icon.png" />').'
                <div class="user-info">
                  <span class="date-posted"><span class="category">'.$category_expand[$row["category"]].'</span> | '.$row["date_posted"].'</span>
                  <br />
                  <span class="username">'.$row["username"].'</span>
                </div>
              </div>
              <span class="title hoverpointer" onclick="location.href=\'post?id='.$row["post_id"].'\'">'.
              $row["title"]
              .'
              </span>
            </div>
            ';
          }
        ?>
      </div>
      <h5>OTHER</h5>
      <?php
  		  while($row = mysqli_fetch_assoc($result)) {
          echo '
          <div class="post">
            <div class="post-user hoverpointer" onclick="location.href=\'user?id='.$row["user_id"].'\'">
              '.($row["is_admin"] == 1 ? '<img title="Admin" src="assets/admin-icon.png" />' : '<img title="User" src="assets/user-icon.png" />').'
              <div class="user-info">
                <span class="date-posted"><span class="category">'.$category_expand[$row["category"]].'</span> | '.$row["date_posted"].'</span>
                <br />
                <span class="username">'.$row["username"].'</span>
              </div>
            </div>
            <span class="title hoverpointer" onclick="location.href=\'post?id='.$row["post_id"].'\'">'.
            $row["title"]
            .'
            </span>
          </div>
          ';
  		  }
      ?>
    </div>
  </body>
</html>
