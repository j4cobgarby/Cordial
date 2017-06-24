<?php require '../phpneed.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Make comment</title>
    <link rel="stylesheet" href="../styles/homepage.css">
    <link rel="stylesheet" href="../styles/post.css">
    <link rel="stylesheet" href="../styles/comment.css">
    <link href="https://fonts.googleapis.com/css?family=Overpass+Mono|Roboto|Roboto+Condensed" rel="stylesheet">
    <script src="../scripts/script.js" charset="utf-8"></script>
  </head>
  <body>
    <?php require '../subheader.php'; ?>

    <div class="comment-form-wrapper">
      <span class="title">
        Commenting on <span class="accent">Post #<?php if (isset($_GET["post_id"])) {echo $_GET["post_id"];} ?></span>
        <?php
          if (isset($_GET["replyto"])) {
            if ($_GET["replyto"] != 0) {
              $connect = mysqli_connect($host_name, $user_name, $password, $database);

              $sql = 'SELECT * FROM `comments` NATURAL JOIN `users` WHERE comment_id = '.$_GET["replyto"];

              $result = mysqli_query($connect, $sql);

              while($row = mysqli_fetch_assoc($result)) {
                $date_posted = $row["date_posted"];
                $content    = $row["content"];
                $username   = $row["username"];
                $is_admin   = $row["is_admin"];
                $user_id    = $row["user_id"];
              }

              echo "<span class='replywho'>Replying to <span class='accent'>Comment #".$_GET["replyto"]."</span></span>";
            }
          }
        ?>
      </span>
      <?php
        if (isset($_GET["replyto"])) {
          if ($_GET["replyto"] != 0) {
            echo '
              <div class="info">
                <span class="top-info">'.$username.', on '.$date_posted.', said</span><br />
                <span class="comment-preview">'.$content.'</span>
              </div>
            ';
          }
        }
      ?>
      <form action="" method="get">
        <legend>
          Comment
        </legend>
        <textarea name="text" placeholder="What do you want to say?" required></textarea>
        <span class="label">Additionally, you can copy in an image URL</span><input type="text" name="image_link" placeholder="Optional" />
        <input type="hidden" name="post_id" <?php
          if (isset($_GET["post_id"])) {
            echo 'value="'.$_GET["post_id"].'"';
          }
        ?>/><br />
        <input type="hidden" name="replyto" <?php
          if (isset($_GET["replyto"])) {
            echo 'value="'.$_GET["replyto"].'"';
          } else {
            echo 'value="0"';
          }
        ?>/><br />
        <input class="hoverpointer" type="submit" value="Reply" />
      </form>
    </div>
    <?php
      if (isset($_GET["text"])) {
        // Check if they're mentioning anyone in the comment
        if (doesStringMentionUser($_GET["text"])) {
          $tagged_user = getTaggedUserFromString($_GET["text"]);
          $tagged_id   = getTaggedUserIDFromString($_GET["text"]);

          if ($_SESSION["login-id"] != $tagged_id) {
            sendNotification($_SESSION["login-id"], $tagged_id, 'mention', $_GET["post_id"]);
          }
        }

        $connect = mysqli_connect($host_name, $user_name, $password, $database);
        if ($_GET["image_link"] == '') {
          $sql = 'INSERT INTO `comments`
            (`comment_id`, `date_posted`, `content`, `in_reply_to`, `user_id`, `post_id`)
          VALUES (
            NULL, \''.date("Y-m-d").'\',
            \''.htmlspecialchars(addslashes($_GET["text"])).'\',
            \''.$_GET["replyto"].'\',
            \''.$_SESSION["login-id"].'\',
            \''.$_GET["post_id"].'\'
          )';
        } else {
          $sql = 'INSERT INTO `comments`
            (`comment_id`, `date_posted`, `content`, `image_link`, `in_reply_to`, `user_id`, `post_id`)
          VALUES (
            NULL, \''.date("Y-m-d").'\',
            \''.htmlspecialchars(addslashes($_GET["text"])).'\',
            \''.htmlspecialchars(addslashes($_GET["image_link"])).'\',
            \''.$_GET["replyto"].'\',
            \''.$_SESSION["login-id"].'\',
            \''.$_GET["post_id"].'\'
          )';
        }
        $result = mysqli_query($connect, $sql);

        // Send the notification
        if (isset($_GET["replyto"])) {
          if ($_GET["replyto"] != 0) {
            // Reply notification
            $get_recip = 'SELECT user_id FROM comments WHERE comment_id = '.$_GET["replyto"];
            $recip_result = mysqli_query($connect, $get_recip);
            while ($row = mysqli_fetch_assoc($recip_result)) {
              $recip_id = $row["user_id"];
            }

            if ($recip_id != $_SESSION["login-id"]) sendNotification($_SESSION["login-id"], $recip_id, 'reply', $_GET["post_id"]);
          } else {
            // Comment notification
            $get_recip = 'SELECT user_id FROM posts WHERE post_id = '.$_GET["post_id"];
            $recip_result = mysqli_query($connect, $get_recip);
            while ($row = mysqli_fetch_assoc($recip_result)) {
              $recip_id = $row["user_id"];
            }

            if ($recip_id != $_SESSION["login-id"]) sendNotification($_SESSION["login-id"], $recip_id, 'comment', $_GET["post_id"]);
          }
        } else {
          // Comment notification
          $get_recip = 'SELECT user_id FROM posts WHERE post_id = '.$_GET["post_id"];
          $recip_result = mysqli_query($connect, $get_recip);
          while ($row = mysqli_fetch_assoc($recip_result)) {
            $recip_id = $row["user_id"];
          }

          if ($recip_id != $_SESSION["login-id"]) sendNotification($_SESSION["login-id"], $recip_id, 'comment', $_GET["post_id"]);
        }

        echo "<script>window.location.href='../post/?id=".$_GET["post_id"]."'</script>";
      }
    ?>
  </body>
</html>
