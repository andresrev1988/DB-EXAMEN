<?php
  session_start();
  if (isset($_SESSION['username'])) {
    session_destroy();
    echo "OK";
    header("Location: http://localhost/DB-EXAMEN/client/index.html");
    die();
  }
 ?>
