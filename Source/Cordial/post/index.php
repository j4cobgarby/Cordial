<!DOCTYPE php>

<!-- POST -->

<html>
  <head>
    <?php
      require '../phpneed.php';
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
  </body>
</html>
