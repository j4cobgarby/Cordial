<?php
  // This file should be used to render the header for all files NOT in the root directory.
  echo '
  <div class="header-wrapper">
    <img class="logo" src="../assets/logobig-white.svg" onclick="location.href=\'../\'" />
    <span onclick="togglescroll();position == \'up\' ? this.innerHTML = \'Categories\' : this.innerHTML = \'User\';"
          class="label noselect">
      Categories
    </span>
    <div class="scroller-wrapper">
      <div id="panel" class="scroller-panel">
        <a title="All" class="all" href="../?cat=all"><b>all</b></a>
        <a title="Software"    href="../?cat=swar">swar</a>
        <a title="Hardware"    href="../?cat=hwar">hwar</a>
        <a title="Game Dev"    href="../?cat=gdev">gdev</a>
        <a title="Web Dev"     href="../?cat=wdev">wdev</a>
        <a title="Science"       href="../?cat=sci">sci</a>
        <a title="Memes"       href="../?cat=meme">meme</a>
        <a title="Photography" href="../?cat=pics">pics</a>
        <a title="Politics"    href="../?cat=pols">pols</a>
        <a title="Random"      href="../?cat=rand">rand</a>
        <a title="Meta"        href="../?cat=meta">meta</a>
        <br />
        '.(isset($_SESSION["login-id"]) ? '<a href="../log_out">Log out</a>' : '<a href="../login">sign in</a>').'
        <a href="../register">Register</a>
        <a href="../user/?id='.$_SESSION["login-id"].'">Your profile</a>
        <a href="../search">Search users</a>';
  if (isset($_SESSION["login-id"])) {
    echo "<span class='login-info'><b>".$loggedin_username."</b>";
  } else {
    echo "<span class='login-info'>You're not logged in.</span>";
  }
?>

</div>
  </div>
  <div class="notification-wrapper">
    <span class="notification-count" onclick="toggleVis('n-dropdown')">
      <?php
        $sql = 'SELECT * FROM notifications WHERE recipient_id = '.$_SESSION["login-id"];
        $all_notifs = mysqli_query($connect, $sql);
        $num_notifs = mysqli_num_rows($all_notifs);
        echo $num_notifs;
      ?>
    </span>
  </div>
  <span onclick="location.href=\'../compose\'" class="hoverpointer compose">compose +</span>
</div>

<div id="n-dropdown" class="notification-dropdown">
  <h3><?php echo $num_notifs; ?> NOTIFICATIONS</h3>
  <div class="notifications">
    <?php
    $sql = 'SELECT
	   u1.user_id AS sender,
     u1.username AS sender_username,
     u2.user_id AS recip,
     u2.username AS recip_username,
     p.post_id AS post_id,
     notifications.type AS type,
     notifications.date_sent AS date_sent
    FROM `notifications`

    INNER JOIN users AS u1
    ON notifications.sender_id = u1.user_id

    INNER JOIN users AS u2
    ON notifications.recipient_id = u2.user_id

    INNER JOIN posts AS p
    ON notifications.post_id = p.post_id

    WHERE u2.user_id = '.$_SESSION["login-id"]
    .' ORDER BY notifications.date_sent DESC';

    $all_notifs_full = mysqli_query($connect, $sql);

    while ($row = mysqli_fetch_assoc($all_notifs_full)) {
      echo '<div class="notification">';

      switch ($row["type"]) {
        case 'reply':
          echo "<span class='sender' onclick='window.location.href=\"../user/?id={$row['sender']}\"'>{$row['sender_username']}</span> replied to <span class='on-comment' onclick='window.location.href=\"../post/?id={$row['post_id']}\"'>your comment</span>";
          break;

        case 'comment':
          echo "<span class='sender' onclick='window.location.href=\"../user/?id={$row['sender']}\"'>{$row['sender_username']}</span> commented on <span class='on-post' onclick='window.location.href=\"../post/?id={$row['post_id']}\"'>your post</span>";
          break;

        case 'mention':
          echo "<span class='sender' onclick='window.location.href=\"../user/?id={$row['sender']}\"'>{$row['sender_username']}</span> mentioned you in <span class='on-comment' onclick='window.location.href=\"../post/?id={$row['post_id']}\"'>a comment</span>";
          break;

        case 'like':
          echo "<span class='sender' onclick='window.location.href=\"../user/?id={$row['sender']}\"'>{$row['sender_username']}</span> liked <span class='on-post' onclick='window.location.href=\"../post/?id={$row['post_id']}\"'>your post</span>";
          break;

        default:
          echo "Notification type not valid...";
          break;
      }

      echo '</div>';
    }
    ?>
  </div>
</div>

<script>
  document.body.addEventListener('click', hideDropdown, true);
</script>
