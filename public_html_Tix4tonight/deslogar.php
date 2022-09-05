<?php
  session_start();
  unset($_SESSION['nome']);
  unset($_SESSION['senha']);
  header('location:index.html');
?>