<?php
  require '../phpneed.php';

  if (isset($_SESSION["login-id"])) {
    session_unset($_SESSION["login-id"]);
  }
  echo "<script>window.location.href='../'</script>";
?>
