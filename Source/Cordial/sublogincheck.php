<?php
  
  if (!isset($_SESSION["login-id"])) {
    echo "<script>window.location.href='../login'</script>";
  }
?>
