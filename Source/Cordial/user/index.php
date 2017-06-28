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
    <link href="https://fonts.googleapis.com/css?family=Inconsolata|Roboto|Roboto+Condensed" rel="stylesheet">
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
        <span><?php echo 'Joined '.dateReformat($date_joined); ?></span>
      </div>
      <?php if ($user_id == $_SESSION["login-id"] && !isset($_GET["edit_bio"])) {
        echo '<span class="bio-edit" onclick="location.href=\'../user?id='.$user_id.'&edit_bio=1\'">EDIT</span>';
      } ?>
      <div class="bio">

        <?php
          if (!isset($_GET["edit_bio"])) {
            if ($bio != '') {
              echo $bio;
            } else {
              if ($user_id == $_SESSION["login-id"]) {
                echo "<i>You haven't set a bio yet. Bios are a good way of letting people know a bit about you.<br />To set one, click <b>EDIT</b> to the right hand side of this page!</i>";
              } else {
                echo '<i>This user has chosen to not write anything about themself.</i>';
              }
            }
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
            <div class="post-user userpage hoverpointer" onclick="location.href=\'../user?id='.$row["user_id"].'\'">
              '.($row["is_admin"] == 1 ? '<img title="Admin" src="../assets/admin-icon.png" />' : '<img title="User" src="../assets/user-icon.png" />').'
              <div class="user-info">
                <span class="date-posted"><span class="category">'.$category_expand[$row["category"]].'</span> '.dateReformat($row["date_posted"]).'</span>
                <br />
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
