<?php require '../phpneed.php'; removeNotificationsForUserOnPost($_GET["id"]); ?>

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
    <script src="post.js" charset="utf-8"></script>
  </head>
  <body>
    <?php require '../subheader.php'; ?>

    <!-- POST: -->

    <div class="post-panel">
      <div class="post-panel-top">
        <?php echo ($is_admin == 1 ? '<img src="../assets/admin-icon.png" />' : '<img src="../assets/user-icon.png" />') ?>
        <span class="hoverpointer" onclick="location.href='../user?id= <?php echo $user_id ?> '"><b><?php echo $username; ?></b></span>
        <span><?php echo dateReformat($date_posted).'<span class="category">'.$category_expand[$category].'</span>'; ?></span>
        <?php
          if (isAdmin($host_name, $user_name, $password, $database)) {
            echo '
              <span class="del-post hoverpointer" onclick="window.location.href=\'delete_post.php/?id='.$_GET["id"].'\'">DELETE</span>
              <span class="edit-post hoverpointer" onclick="window.location.href=\'edit_post.php?id='.$_GET["id"].'\'">EDIT</span>
            ';
          }
          else if ($user_id == $_SESSION["login-id"]) {
            // This is the user's post
            echo '
              <span class="del-post hoverpointer" onclick="window.location.href=\'delete_post.php/?id='.$_GET["id"].'\'">DELETE</span>
              <span class="edit-post hoverpointer" onclick="window.location.href=\'edit_post.php?id='.$_GET["id"].'\'">EDIT</span>
            ';
          }
        ?>
      </div>

      <h1 class="title"><?php echo $title; ?></h1>
      <div class="content-wrapper">
        <?php
          $Parsedown = new Parsedown();
          echo $Parsedown->text(htmlspecialchars_decode($content));
        ?>
      </div>
      <div class="post-panel-bottom">
        <input type="image" id="like-icon" src=
          <?php
            echo '"'.(canLike($_GET["id"], $host_name, $user_name, $password, $database) == true ? '../assets/like-icon-greyed.svg' : '../assets/like-icon.svg').'"'
          ?> alt="submit" onclick=<?php echo '"tryLike('.$_GET["id"].')"' ?> />
        <span class="like-count" id="like-count"><?php echo $likes; ?></span>
      </div>
    </div>

    <div class="comment-panel">
      <?php
        $sql = 'SELECT * FROM `comments` NATURAL JOIN `users` WHERE post_id = '.$_GET["id"].' ORDER BY comment_id ASC';
        $result = mysqli_query($connect, $sql);
        $amount_comments = mysqli_num_rows($result);
      ?>

      <h2>Comments for <?php echo "<span class='accent'>Post #".$_GET["id"]."</span>" ?></h2>
      <span class="count">
        <b><?php echo $amount_comments; ?></b>
        <?php echo ($amount_comments == 1 ? "comment" : "comments") ?>
      </span>
      <span <?php echo 'onclick="window.location.href=\'make_comment.php?post_id='.$_GET["id"].'&replyto=0\'"' ?> class="newcommentbutton hoverpointer">
        Comment
      </span>

      <div class="comments">
        <?php
          if ($amount_comments == 0) {
            echo "<span class='nocomments'>No comments found...</span>";
          }

          while ($row = mysqli_fetch_assoc($result)) {
            $c_user_id = $row["user_id"];
            $c_comment_id = $row["comment_id"];
            $c_date_posted = $row["date_posted"];
            $c_content = $row["content"];
            $c_in_reply_to = $row["in_reply_to"];
            $c_username = $row["username"];
            $c_is_admin = $row["is_admin"];
            $c_image_link = $row["image_link"];
            $c_likes = $row["likes"];

            echo '
            <div class="comment" id="comment-'.$c_comment_id.'">
              <span class="info">
                <span onclick="window.location.href=\'make_comment.php?post_id='.$_GET["id"].'&replyto='.$c_comment_id.'\'" class="embed-newcomment hoverpointer">
                  Reply
                </span>
                <span class="like-img-wrapper">
                  <img class="like-img" src="../assets/like-icon.svg" />
                </span>
                <span class="like-count-wrapper">
                  '.$c_likes.'
                </span>
                <span class="id accent hoverpointer hoverunderline" onclick="window.location.href=\'#comment-'.$c_comment_id.'\'">
                  #'.$c_comment_id.'
                </span>
                <span class="reply accent hoverpointer hoverunderline" onclick="window.location.href=\'#comment-'.$c_in_reply_to.'\'">'
                  .($c_in_reply_to != 0 ? ' » #'.$c_in_reply_to.' ' : '').' /
                </span>
                <span class="username" onclick="window.location.href=\'../user/?id='.$user_id.'\'">'.$c_username.($c_user_id == $user_id ? '<span class="op">OP</span>' : '').'</span>
              </span>
              <span class="content">
                '.($c_image_link == NULL ? '' : '<img class="hoverpointer comment-img" onclick="window.location.href=\''.$c_image_link.'\'" src="'.$c_image_link.'" />').'
                '.tryPutSpanAroundMentionedUser($c_content).'
              </span>
            </div>
            ';
          }
        ?>
      </div>
    </div>
  </body>
</html>
