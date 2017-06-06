<!DOCTYPE html>
<html>
  <head>
    <?php
      $host_name  = "localhost";
      $database   = "cordial";
      $user_name  = "root";
      $password   = "";

      $connect = mysqli_connect($host_name, $user_name, $password, $database);

      $sql = 'SELECT post_id, date_posted, category, title, content, likes, views, username, is_admin
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
    <div class="header-wrapper">
      <img class="logo" src="../assets/logobig-white.svg" onclick="location.href='/Cordial'" />

      <span onclick="togglescroll();position == 'up' ? this.innerHTML = 'Categories' : this.innerHTML = 'User';"
            class="label noselect">
        Categories
      </span>

      <div class="scroller-wrapper">
        <div id="panel" class="scroller-panel">
          <a title="All" class="all" href="/Cordial"><b>all</b></a>
          <a title="Software"    href="/Cordial/?cat=swar">swar</a>
          <a title="Hardware"    href="/Cordial/?cat=hwar">hwar</a>
          <a title="Game Dev"    href="/Cordial/?cat=gdev">gdev</a>
          <a title="Web Dev"     href="/Cordial/?cat=wdev">wdev</a>
          <a title="Memes"       href="/Cordial/?cat=meme">meme</a>
          <a title="Photography" href="/Cordial/?cat=pics">pics</a>
          <a title="Politics"    href="/Cordial/?cat=pols">pols</a>
          <a title="Random"      href="/Cordial/?cat=rand">rand</a>
          <a title="Meta"        href="/Cordial/?cat=meta">meta</a>

          <br />

          <a href="#">sign in</a>
          <a href="#">register</a>
          <a href="#">home</a>
        </div>
      </div>

      <span class="compose">+</span>
    </div>

    <!-- POST: -->

    <div class="post-panel">
      <div class="post-panel-top">
        <?php echo ($is_admin == 1 ? '<img src="../assets/admin-icon.png" />' : '<img src="../assets/user-icon.png" />') ?>
        <span><b><?php echo $username; ?></b></span>
        <span><?php echo $date_posted; ?></span>
      </div>

      <h1><?php echo $title; ?></h1>
      <p>
        <?php echo $content; ?>
      </p>
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
