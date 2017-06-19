<?php require '../phpneed.php'; ?>

<!DOCTYPE php>

<!-- USER -->

<html>
  <head>
    <?php
      require '../sublogincheck.php';

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
        <span><b><?php echo $username; ?>
          <?php
            if ($is_admin == 0) {
              echo '<img src="../assets/user-icon.png" />';
            } else {
              echo '<img src="../assets/admin-icon.png" />';
            }
          ?>
        </b></span>
        <span><?php echo 'Joined '.$date_joined; ?></span>
      </div>
      <div class="bio">
        <?php if ($user_id == $_SESSION["login-id"] && !isset($_GET["edit_bio"])) {
          echo '<img onclick="location.href=\'../user?id='.$user_id.'&edit_bio=1\'" class="edit-icon hoverpointer" src="../assets/pencil.svg" />';
        } ?>
        <?php
          if (!isset($_GET["edit_bio"])) {
            echo $bio;
          } else { // Is set
            if ($_GET["edit_bio"] == 1) {
              echo '
              <form method="get">
                <textarea name="new_bio_text" placeholder="Write a cool new bio! Any programming languages you know, what you like doing, etc.." class="edit-bio">'.$bio.'</textarea>
                <input type="hidden" name="id" value="'.$user_id.'" />
                <input type="submit" value="Change" />
              </form>
              ';
            } else {
                echo $bio;
            }
          }

          if (isset($_GET["new_bio_text"])) {
            if ($user_id == $_SESSION["login-id"]) {


              $change_bio_sql = 'UPDATE `users` SET `bio` = \''.htmlspecialchars(addslashes($_GET["new_bio_text"])).'\' WHERE `users`.`user_id` = '.$user_id;
              $result = mysqli_query($connect, $change_bio_sql);

              echo '<script>window.location.href="../user/?id='.$user_id.'"</script>';
            }
          }
        ?><br />
      </div>
      <div class="user-panel-bottom">
        <span class="user-panel-bottom-likes">
          <img src="../assets/like-icon.svg" />
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
                <span class="username">'.$row["username"].'</span>
              </div>
            </div>
            <span class="title hoverpointer" onclick="location.href=\'../post?id='.$row["post_id"].'\'">'.
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
