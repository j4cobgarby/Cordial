<!DOCTYPE php>

<!-- USER -->

<html>
  <head>
    <?php
      require '../creds.php';

      $connect = mysqli_connect($host_name, $user_name, $password, $database);

      $sql = 'SELECT * FROM `users` WHERE user_id = '.$_GET["id"];

      $result = mysqli_query($connect, $sql);

      while($row = mysqli_fetch_assoc($result)) {
        $user_id     = $row["user_id"];
        $date_joined = $row["date_joined"];
        $username    = $row["username"];
        $is_admin    = $row["is_admin"];
        $bio         = $row["bio"];
      }
    ?>

    <meta charset="utf-8">
    <title>Cordial - <?php echo $username; ?></title>
    <link rel="stylesheet" href="../styles/homepage.css">
    <link rel="stylesheet" href="../styles/user.css">
    <link href="https://fonts.googleapis.com/css?family=Overpass+Mono|Roboto|Roboto+Condensed" rel="stylesheet">
    <script src="../scripts/script.js" charset="utf-8"></script>
  </head>
  <body>
    <?php require '../subheader.php'; ?>

    <div class="user-panel">
      <div class="user-panel-top">
        <span><b><?php echo $username; ?> <img src="../assets/admin-icon.png" /></b></span>
        <span><?php echo 'Joined '.$date_joined; ?></span>
      </div>
      <div class="bio">
        <?php echo $bio; ?>
      </div>
      <div class="user-panel-bottom">
        <span class="user-panel-bottom-likes">
          <img src="../assets/like-icon.png" />
          <span>
            <?php
              $sql = 'SELECT sum(likes) as total_likes FROM `posts` WHERE user_id = '.$user_id;
              $result = mysqli_query($connect, $sql);

              while($row = mysqli_fetch_assoc($result)) {
                echo $row["total_likes"];
              }
            ?>
          </span>
        </span>
      </div>
    </div>

    <div class="postview" id="postview">
      <?php
        $sql = 'SELECT * FROM `posts` NATURAL JOIN `users` WHERE user_id = '.$user_id;
        $result = mysqli_query($connect, $sql);

  		  while($row = mysqli_fetch_assoc($result)) {
          echo '
          <div class="post">
            <div class="post-user hoverpointer" onclick="location.href=\'../user?id='.$row["user_id"].'\'">
              '.($row["is_admin"] == 1 ? '<img title="Admin" src="../assets/admin-icon.png" />' : '<img title="User" src="../assets/user-icon.png" />').'
              <div class="user-info">
                <span class="date-posted">'.$row["date_posted"].'</span>
                <br />
                <span class="username">'.($row["is_admin"] == 1 ? '<b>' : '').$row["username"].($row["is_admin"] == 1 ? '</b>' : '').'</span>
              </div>
            </div>
            <span class="title hoverpointer" onclick="location.href=\'../post?id='.$row["post_id"].'\'">'.
            $row["title"]
            .'
            </span>
            <div class="post-status">
              <span class="likes">
                <img class="likes" src="../assets/like-icon.png">
                '.$row["likes"].'
              </span>
              <span class="views">
                '.$row["views"].'
                <img class="views" src="../assets/views-icon.png" />
              </span>
            </div>
          </div>
          ';
  		  }
      ?>
    </div>
  </body>
</html>
