<?php
  require '../phpneed.php';
  
  if (isset($_SESSION["login-id"])) {
    session_unset($_SESSION["login-id"]);
  }
  header( 'Location: ../' ) ;
?>
