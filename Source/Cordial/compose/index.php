<!DOCTYPE html>

<!-- COMPOSE -->

<html>
  <head>
    <meta charset="utf-8">
    <title>Compose</title>
    <link rel="stylesheet" href="../styles/homepage.css">
    <link href="https://fonts.googleapis.com/css?family=Overpass+Mono|Roboto|Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="../styles/post.css">
    <script src="../scripts/script.js" charset="utf-8"></script>
  </head>
  <body>
    <div class="header-wrapper">
      <img class="logo" src="../assets/logobig-white.svg" onclick="location.href='/Cordial/Source/Cordial'" />

      <span onclick="togglescroll();position == 'up' ? this.innerHTML = 'Categories' : this.innerHTML = 'User';"
            class="label noselect">
        Categories
      </span>

      <div class="scroller-wrapper">
        <div id="panel" class="scroller-panel">
          <a title="All" class="all" href="/Cordial/Source/Cordial"><b>all</b></a>
          <a title="Software"    href="/Cordial/Source/Cordial/?cat=swar">swar</a>
          <a title="Hardware"    href="/Cordial/Source/Cordial/?cat=hwar">hwar</a>
          <a title="Game Dev"    href="/Cordial/Source/Cordial/?cat=gdev">gdev</a>
          <a title="Web Dev"     href="/Cordial/Source/Cordial/?cat=wdev">wdev</a>
          <a title="Memes"       href="/Cordial/Source/Cordial/?cat=meme">meme</a>
          <a title="Photography" href="/Cordial/Source/Cordial/?cat=pics">pics</a>
          <a title="Politics"    href="/Cordial/Source/Cordial/?cat=pols">pols</a>
          <a title="Random"      href="/Cordial/Source/Cordial/?cat=rand">rand</a>
          <a title="Meta"        href="/Cordial/Source/Cordial/?cat=meta">meta</a>

          <br />

          <a href="#">sign in</a>
          <a href="#">register</a>
          <a href="#">home</a>
        </div>
      </div>
    </div>
  </body>
</html>
