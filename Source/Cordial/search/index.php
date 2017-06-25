<?php require '../phpneed.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <?php
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
        <input type="text" name="q" placeholder="Search for a user..." <?php
          if (isset($_GET["q"])) {
            if ($_GET["q"] != "") {
              echo 'value="'.$_GET["q"].'"';
            }
          }
         ?>/>
        <input type="submit" value="Go" />
      </form>
    </div>

    <div class="results">
      <?php if (isset($_GET["q"])) {
        $query = htmlspecialchars(addslashes($_GET["q"]));

        $connect = mysqli_connect($host_name, $user_name, $password, $database);
        $sql = 'SELECT * FROM `users` ORDER BY username';

        $result = mysqli_query($connect, $sql);

        $diff_threshold = 8; // Maximum levenshtein distance between the query and
                             // the username for it to be listed

        $cost_ins = 1;
        $cost_rep = 2;
        $cost_del = 1;

        if ($query == "") {
          while ($row = mysqli_fetch_assoc($result)) {
            $sql_posts = 'SELECT * FROM `posts` WHERE `user_id` = '.$row["user_id"];
            $posts_by_user = mysqli_query($connect, $sql_posts);
            $amount_posts = mysqli_num_rows($posts_by_user);

            $sql_comments = 'SELECT * FROM `comments` WHERE `user_id` = '.$row["user_id"];
            $comments_by_user = mysqli_query($connect, $sql_comments);
            $amount_comments = mysqli_num_rows($comments_by_user);

            echo '
            <div class="result hoverpointer" onclick="window.location.href=\'../user/?id='.$row["user_id"].'\'">
              <span class="username">
                '.($row["is_admin"] == 1 ? '<img src="../assets/admin-icon.png" />' : '<img src="../assets/user-icon.png" />').'
                '.$row["username"].'
              </span>
              <br />
              <span class="medium">Joined <b>'.$row["date_joined"].'</b></span>
              <span class="medium"><b>'.$amount_posts.'</b> posts | <b>'.$amount_comments.'</b> comments</span>
            </div>
            ';
          }
        } else {
          // Make an array, where each key is a user_id, and its value is how similar
          // it is to the query string

          $distances = array();
          while ($row = mysqli_fetch_assoc($result)) {
            $distances[$row["user_id"]] = levenshtein($row["username"], $query, $cost_ins, $cost_rep, $cost_del);
          }

          // Sort array by values in ascending order
          asort($distances);

          foreach ($distances as $user_id => $distance) {
            if ($distance <= $diff_threshold) {
              // Display user
              $user_sql = 'SELECT * FROM users WHERE user_id = '.$user_id;
              $user_res = mysqli_query($connect, $user_sql);
              while ($row = mysqli_fetch_assoc($user_res)) {
                $sql_posts = 'SELECT * FROM `posts` WHERE `user_id` = '.$row["user_id"];
                $posts_by_user = mysqli_query($connect, $sql_posts);
                $amount_posts = mysqli_num_rows($posts_by_user);

                $sql_comments = 'SELECT * FROM `comments` WHERE `user_id` = '.$row["user_id"];
                $comments_by_user = mysqli_query($connect, $sql_comments);
                $amount_comments = mysqli_num_rows($comments_by_user);

                echo '
                <div class="result hoverpointer" onclick="window.location.href=\'../user/?id='.$row["user_id"].'\'">
                  <span class="username">
                    '.($row["is_admin"] == 1 ? '<img src="../assets/admin-icon.png" />' : '<img src="../assets/user-icon.png" />').'
                    '.$row["username"].'
                  </span>
                  <br />
                  <span class="medium">Joined <b>'.$row["date_joined"].'</b></span>
                  <span class="medium"><b>'.$amount_posts.'</b> posts | <b>'.$amount_comments.'</b> comments</span>
                </div>
                ';
              }
            }
          }
        }
      } ?>
    </div>
  </body>
</html>
