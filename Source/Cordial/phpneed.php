<?php
  // This file is imported at the top of all the pages in cordial.

  $host_name  = "localhost";
  $database   = "cordial";
  $user_name  = "root";
  $password   = "";

  // Start the session so I can use $_SESSION superglobal
  session_start();

  echo $_SESSION["login-id"];
?>
