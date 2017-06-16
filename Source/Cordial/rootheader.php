<?php
  // This file should be used to render the header of all files in the root directory of the website.

  echo '
  <div class="header-wrapper">
    <img class="logo" src="assets/logobig-white.svg" onclick="location.href=\'?cat=all\'" />

    <span onclick="togglescroll();position == \'up\' ? this.innerHTML = \'Categories\' : this.innerHTML = \'User\';"
          class="label noselect">
      Categories
    </span>

    <div class="scroller-wrapper">
      <div id="panel" class="scroller-panel">
        <a title="All" class="all" href="?cat=all"><b>all</b></a>
        <a title="Software"    href="?cat=swar">swar</a>
        <a title="Hardware"    href="?cat=hwar">hwar</a>
        <a title="Game Dev"    href="?cat=gdev">gdev</a>
        <a title="Web Dev"     href="?cat=wdev">wdev</a>
        <a title="Science"       href="?cat=sci">sci</a>
        <a title="Memes"       href="?cat=meme">meme</a>
        <a title="Pictures"    href="?cat=pics">pics</a>
        <a title="Politics"    href="?cat=pols">pols</a>
        <a title="Random"      href="?cat=rand">rand</a>
        <a title="Meta"        href="?cat=meta">meta</a>
        <span class="category-show">'.(isset($_GET["cat"]) ? $category_expand[$_GET["cat"]] : "Showing all").'</span>

        <br />

        '.(isset($_SESSION["login-id"]) ? '<a href="log_out">Log out</a>' : '<a href="login">sign in</a>').'
        <a href="register">Register</a>
        <a href="user/?id='.$_SESSION["login-id"].'">You</a>
        <a href="search">Search users</a>';

  if (isset($_SESSION["login-id"])) {
    echo "<span class='login-info'><b>".$loggedin_username."</b>";
  } else {
    echo "<span class='login-info'>You're not logged in.</span>";
  }

  echo '
      </div>!
    </div>
    <span onclick="location.href=\'compose\'" class="hoverpointer compose">compose +</span>
  </div>
  ';
?>
