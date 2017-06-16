<?php require '../phpneed.php'; ?>

<?php
  $connect = mysqli_connect($host_name, $user_name, $password, $database);

  $can_edit = false;

  $connect = mysqli_connect($host_name, $user_name, $password, $database);
  $sql = "SELECT * FROM `posts` NATURAL JOIN `users` WHERE post_id = ".$_GET["id"];
  $result = mysqli_query($connect, $sql);

  while ($row = mysqli_fetch_assoc($result)) {
    $title      = htmlspecialchars(addslashes($row["title"]));
    $date_posted = htmlspecialchars(addslashes($row["date_posted"]));
    $category   = htmlspecialchars(addslashes($row["category"]));
    $title      = htmlspecialchars(addslashes($row["title"]));
    $content    = htmlspecialchars(addslashes($row["content"]));
    $likes      = htmlspecialchars(addslashes($row["likes"]));
    $views      = htmlspecialchars(addslashes($row["views"]));
    $username   = htmlspecialchars(addslashes($row["username"]));
    $is_admin   = htmlspecialchars(addslashes($row["is_admin"]));
    $user_id    = htmlspecialchars(addslashes($row["user_id"]));
  }

  if (isAdmin($host_name, $user_name, $password, $database)) {
    $can_edit = true;
  }
  else if ($user_id == $_SESSION["login-id"]) {
    $can_edit = true;
  }

  if ($can_edit == false) {
    echo "<script>window.location.href='../post/?id=".$_GET["id"]."'</script>";
  }
?>

<!DOCTYPE php>

<html>
  <head>
    <?php
      require '../sublogincheck.php';
    ?>

    <meta charset="utf-8">
    <title>Cordial - <?php echo $username." - ".$title?></title>
    <link rel="stylesheet" href="../styles/homepage.css">
    <link href="https://fonts.googleapis.com/css?family=Inconsolata|Roboto|Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="../styles/post.css">
    <link rel="stylesheet" href="../styles/edit_post.css">
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
        <?php
          if (isAdmin($host_name, $user_name, $password, $database)) {
            echo '
              <span class="del-post hoverpointer" onclick="window.location.href=\'delete_post.php/?id='.$_GET["id"].'\'">DELETE</span>
              <span class="edit-post hoverpointer" onclick="window.location.href=\'edit_post.php/?id='.$_GET["id"].'\'">EDIT</span>
            ';
          }
          else if ($user_id == $_SESSION["login-id"]) {
            // This is the user's post
            echo '
              <span class="del-post hoverpointer" onclick="window.location.href=\'delete_post.php/?id='.$_GET["id"].'\'">DELETE</span>
              <span class="edit-post hoverpointer" onclick="window.location.href=\'edit_post.php/?id='.$_GET["id"].'\'">EDIT</span>
            ';
          }
        ?>
      </div>
      <form method="post">
        <input required type="text" name="title" placeholder="Write a new title!" value="<?php echo $title; ?>" />
        <div class="content-wrapper">
          <textarea required name="content" class="mono"><?php echo $content; ?></textarea>
          <input type="hidden" name="id" value=<?php echo '"'.$_GET["id"].'"' ?> />
          <input class="hoverpointer" type="submit" value="Update post" />
        </div>
      </form>
    </div>
    <?php
      if (isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["content"])) {
        $sql = "SELECT * FROM `posts` NATURAL JOIN `users` WHERE post_id = ".$_POST["id"];
        $result = mysqli_query($connect, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
          $title      = htmlspecialchars(addslashes($row["title"]));
          $date_posted = htmlspecialchars(addslashes($row["date_posted"]));
          $category   = htmlspecialchars(addslashes($row["category"]));
          $title      = htmlspecialchars(addslashes($row["title"]));
          $content    = htmlspecialchars(addslashes($row["content"]));
          $likes      = htmlspecialchars(addslashes($row["likes"]));
          $views      = htmlspecialchars(addslashes($row["views"]));
          $username   = htmlspecialchars(addslashes($row["username"]));
          $is_admin   = htmlspecialchars(addslashes($row["is_admin"]));
          $user_id    = htmlspecialchars(addslashes($row["user_id"]));
        }

        $can_edit = false;

        if (isAdmin($host_name, $user_name, $password, $database)) {
          $can_edit = true;
        }
        else if ($user_id == $_SESSION["login-id"]) {
          $can_edit = true;
        }

        $sql =
         'UPDATE
            `posts`
          SET
            `title` = "'.$_POST["title"].'",
            `content` = "'.$_POST["content"].'"
          WHERE
            `posts`.`post_id` = '.$_POST["id"];

        if ($can_edit == true) {
          echo $sql;
          $result = mysqli_query($connect, $sql);
        }
      }
    ?>
  </body>
</html>
