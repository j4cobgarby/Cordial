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
        Commenting on: <input type="text" name="post_id" <?php
          if (isset($_GET["post_id"])) {
            echo 'value="'.$_GET["post_id"].'"';
          }
        ?>/><br />
        Replying to: <input type="text" name="replyto" <?php
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
        $connect = mysqli_connect($host_name, $user_name, $password, $database);
        $sql = 'INSERT INTO `comments`
          (`comment_id`, `date_posted`, `content`, `in_reply_to`, `user_id`, `post_id`)
        VALUES (
          NULL, \''.date("Y-m-d").'\', \''.$_GET["text"].'\', \''.$_GET["replyto"].'\', \''.$_SESSION["login-id"].'\', \''.$_GET["post_id"].'\'
        )';
        $result = mysqli_query($connect, $sql);
        echo "<script>window.location.href='../post/?id=".$_GET["post_id"]."'</script>";
      }
    ?>
  </body>
</html>
