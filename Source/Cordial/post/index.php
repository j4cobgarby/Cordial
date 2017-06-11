<?php require '../phpneed.php'; ?>

<!DOCTYPE php>

<!-- POST -->

<html>
  <head>
    <?php
      require '../sublogincheck.php';
      require '../parsedown-1.6.0/Parsedown.php';

      $connect = mysqli_connect($host_name, $user_name, $password, $database);

      $sql = 'SELECT user_id, post_id, date_posted, category, title, content, likes, views, username, is_admin
      FROM `posts` NATURAL JOIN `users` WHERE post_id = '.$_GET["id"];

      $result = mysqli_query($connect, $sql);

      while($row = mysqli_fetch_assoc($result)) {
        $title      = $row["title"];
        $date_posted = $row["date_posted"];
        $category   = $row["category"];
        $title      = $row["title"];
        $content    = $row["content"];
        $likes      = $row["likes"];
        $views      = $row["views"];
        $username   = $row["username"];
        $is_admin   = $row["is_admin"];
        $user_id    = $row["user_id"];
      }
    ?>

    <meta charset="utf-8">
    <title>Cordial - <?php echo $username." - ".$title?></title>
    <link rel="stylesheet" href="../styles/homepage.css">
    <link href="https://fonts.googleapis.com/css?family=Overpass+Mono|Roboto|Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="../styles/post.css">
    <script src="../scripts/script.js" charset="utf-8"></script>
  </head>
  <body>
    <?php require '../subheader.php'; ?>

    <!-- POST: -->

    <div class="post-panel">
      <div class="post-panel-top">
        <?php echo ($is_admin == 1 ? '<img src="../assets/admin-icon.png" />' : '<img src="../assets/user-icon.png" />') ?>
        <span class="hoverpointer" onclick="location.href='../user?id= <?php echo $user_id ?> '"><b><?php echo $username; ?></b></span>
        <span><?php echo $date_posted; ?></span>
      </div>

      <h1 class="title"><?php echo $title; ?></h1>
      <div class="content-wrapper">
        <?php
          $Parsedown = new Parsedown();

          echo $Parsedown->text($content);
        ?>
      </div>
      <div class="post-panel-bottom">
        <span class="post-panel-bottom-likes">
          <img src="../assets/like-icon.png" />
          <span><?php echo $likes; ?></span>
        </span>
        <span class="post-panel-bottom-views">
          <img src="../assets/views-icon.png" />
          <span><?php echo $views; ?></span>
        </span>
      </div>
    </div>

    <div class="comment-panel">
      <?php
        $sql = 'SELECT * FROM `comments` NATURAL JOIN `users` WHERE post_id = '.$_GET["id"];
        $result = mysqli_query($connect, $sql);
        $amount_comments = mysqli_num_rows($result);
      ?>

      <h2>Comments for <?php echo "<span class='accent'>#".$_GET["id"]."</span>" ?></h2>
      <span class="count"><b><?php echo $amount_comments; ?></b>
        <?php echo ($amount_comments == 1 ? "comment" : "comments") ?></span>
      <div class="comments">
        <?php
          while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row["user_id"];
            $comment_id = $row["comment_id"];
            $date_posted = $row["date_posted"];
            $content = $row["content"];
            $in_reply_to = $row["in_reply_to"];
            $username = $row["username"];
            $is_admin = $row["is_admin"];

            echo '
            <div class="comment">
              <span class="id accent">#'.$comment_id.'<span class="reply">'.($in_reply_to != 0 ? ' >> #'.$in_reply_to.' ' : '').' /</span></span>
              <span class="username">'.$username.' -</span>
              <span class="content">
                '.$content.'
              </span>
            </div>
            ';
          }
        ?>
      </div>
    </div>
  </body>
</html>
