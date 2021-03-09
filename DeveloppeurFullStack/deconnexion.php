<?php
  session_start();
  session_destroy();
  header('location: index.php'); // Page auquel l'utilisateur sera redirigé
  ﻿exit;
?>